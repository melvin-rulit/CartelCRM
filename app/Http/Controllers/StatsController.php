<?php

namespace App\Http\Controllers;

use alhimik1986\PhpExcelTemplator\params\CallbackParam;
use alhimik1986\PhpExcelTemplator\params\ExcelParam;
use alhimik1986\PhpExcelTemplator\PhpExcelTemplator;
use alhimik1986\PhpExcelTemplator\setters\CellSetterArray2DValue;
use App\Http\Resources\ActiveStatsResource;
use App\Http\Resources\ExcelActiveStatsResource;
use App\Http\Resources\OperationStatsResource;
use App\Http\Resources\PaymentStatsResource;
use App\Models\Active;
use App\Models\Operation;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Border;

class StatsController extends Controller
{
    private Operation $operations;
    private Payment $payments;
    private Active $actives;

    public function __construct(Operation $operations, Payment $payments, Active $actives)
    {
        $this->operations = $operations;
        $this->payments = $payments;
        $this->actives = $actives;
    }

    public function finOperationsStats(Request $request): JsonResponse
    {
        $operationsQuery = $this->operations->newQuery();
        $paymentsQuery = $this->payments->newQuery();

        if ($request->get('incomes') === 'true' && $request->get('outgoings') !== 'true') {
            $operationsQuery->where('type', Operation::TYPE_POSITIVE);
        }

        if ($request->get('outgoings') === 'true' && $request->get('incomes') !== 'true') {
            $operationsQuery->where('type', Operation::TYPE_NEGATIVE);
            $paymentsQuery->where('id', -1);
        }

        if ($dateFrom = $request->get('dateFrom')) {
            $dateFrom = Carbon::parse($dateFrom)->startOfDay();
            $operationsQuery->where('date', '>=', $dateFrom);
            $paymentsQuery->where('created_at', '>=', $dateFrom);
        }

        if ($dateTo = $request->get('dateTo')) {
            $dateTo = Carbon::parse($dateTo)->endOfDay();
            $operationsQuery->where('date', '<=', $dateTo);
            $paymentsQuery->where('created_at', '<=', $dateTo);
        }

        if ($branchName = $request->get('branchName')) {
            $operationsQuery->whereHas('active', function ($q) use ($branchName) {
                $q->whereHas('branch', function ($q) use ($branchName) {
                    $q->where('name', 'like', "%{$branchName}%");
                });
            });
            $paymentsQuery->whereHas('deal', function ($q) use ($branchName) {
                $q->whereHas('branch', function ($q) use ($branchName) {
                    $q->where('name', 'like', "%{$branchName}%");
                });
            });
        }

        if ($clientName = $request->get('clientName')) {
            //у операций по активу нет клиента
            $operationsQuery->where("type", 99999999);

            $paymentsQuery->whereHas('deal', function ($q) use ($clientName) {
                $q->whereHas('client', function ($q) use ($clientName) {
                    $parts = explode(' ', $clientName);
                    foreach ($parts as $part) {
                        $q->where('first_name', 'like', "%{$part}%");
                        $q->orWhere('middle_name', 'like', "%{$part}%");
                        $q->orWhere('last_name', 'like', "%{$part}%");
                    }
                });
            });
        }

        if ($investorName = $request->get('investorName')) {
            $operationsQuery->whereHas('active', function ($q) use ($investorName) {
                $q->whereHas('investor', function ($q) use ($investorName) {
                    $parts = explode(' ', $investorName);
                    foreach ($parts as $part) {
                        $q->where('first_name', 'like', "%{$part}%");
                        $q->orWhere('middle_name', 'like', "%{$part}%");
                        $q->orWhere('last_name', 'like', "%{$part}%");
                    }
                });
            });

            $paymentsQuery->whereHas('deal', function ($q) use ($investorName) {
                $q->whereHas('active', function ($q) use ($investorName) {
                    $q->whereHas('investor', function ($q) use ($investorName) {
                        $parts = explode(' ', $investorName);
                        foreach ($parts as $part) {
                            $q->where('first_name', 'like', "%{$part}%");
                            $q->orWhere('middle_name', 'like', "%{$part}%");
                            $q->orWhere('last_name', 'like', "%{$part}%");
                        }
                    });
                });
            });
        }

        if ($activeName = $request->get('activeName')) {
            $operationsQuery->whereHas('active', function ($q) use ($activeName) {
                $q->where('model', 'like', "%{$activeName}%");
                $q->orWhere('reg_number', 'like', "%{$activeName}%");
            });
            $paymentsQuery->whereHas('deal', function ($q) use ($activeName) {
                $q->whereHas('active', function ($q) use ($activeName) {
                    $q->where('model', 'like', "%{$activeName}%");
                    $q->orWhere('reg_number', 'like', "%{$activeName}%");
                });
            });
        }

        $operations = $operationsQuery->get();
        $payments = $paymentsQuery->get();

        $operationsResources = OperationStatsResource::collection($operations);
        $paymentsResources = PaymentStatsResource::collection($payments);

        $operations = json_decode($operationsResources->toJson());
        $payments = json_decode($paymentsResources->toJson());

        $results = array_merge($operations, $payments);

        usort($results, static function ($a, $b) {
            return $a->timestamp <=> $b->timestamp;
        });

        return new JsonResponse(['payments' => $results]);
    }

    public function activesStats(Request $request): JsonResponse
    {
        $activesQuery = $this->actives->newQuery();

        if ($branchName = $request->get('branchName')) {
            $activesQuery->whereHas('branch', function ($q) use ($branchName) {
                $q->where('name', 'like', "%{$branchName}%");
            });
        }

        if ($clientName = $request->get('clientName')) {
            $activesQuery->whereHas('deal', function ($q) use ($clientName) {
                $q->whereHas('client', function ($q) use ($clientName) {
                    $parts = explode(' ', $clientName);
                    foreach ($parts as $part) {
                        $q->where('first_name', 'like', "%{$part}%");
                        $q->orWhere('middle_name', 'like', "%{$part}%");
                        $q->orWhere('last_name', 'like', "%{$part}%");
                    }
                });
            });
        }

        if ($investorName = $request->get('investorName')) {
            $activesQuery->whereHas('investor', function ($q) use ($investorName) {
                $parts = explode(' ', $investorName);
                foreach ($parts as $part) {
                    $q->where('first_name', 'like', "%{$part}%");
                    $q->orWhere('middle_name', 'like', "%{$part}%");
                    $q->orWhere('last_name', 'like', "%{$part}%");
                }
            });
        }

        if ($activeName = $request->get('activeName')) {
            $activesQuery->where('model', 'like', "%{$activeName}%");
            $activesQuery->orWhere('reg_number', 'like', "%{$activeName}%");
        }

        $actives = $activesQuery->get();

        return new JsonResponse(['actives' => ActiveStatsResource::collection($actives)]);
    }

    public function exportPayments(Request $request)
    {
        $paymentsIds = $request->input('payments');
        $operationsIds = $request->input('operations');

        $payments = $this->payments->newQuery()->whereIn('id', $paymentsIds)->get();
        $operations = $this->operations->newQuery()->whereIn('id', $operationsIds)->get();

        $payments = PaymentStatsResource::collection($payments);
        $operations = OperationStatsResource::collection($operations);

        $payments = json_decode($payments->toJson(), true);
        $operations = json_decode($operations->toJson(), true);

        $records = array_merge($operations, $payments);

        usort($records, static function ($a, $b) {
            return $a['timestamp'] <=> $b['timestamp'];
        });

        foreach ($records as $key => $record) {
            unset($records[$key]['id'], $records[$key]['timestamp'], $records[$key]['kind']);
        }

        $date = (Carbon::parse($request->query('date'))->format('d.m.Y')) ?? (Carbon::now())->format('d.m.Y');

        $template = IOFactory::load(storage_path('templates/payments.xlsx'));

        $commonVars = [
            '{date}'   => $date,
        ];

        foreach ($records as $key => $record) {
            $records[$key] = array_values($record);
        }

        $recs = [
            '[payments]' => new ExcelParam(CellSetterArray2DValue::class, $records, function (CallbackParam $param) {
                $sheet = $param->sheet;
                $coordinate = $param->coordinate;
                $sheet->getStyle($coordinate)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

                foreach (range('A', 'Z') as $colName) {
                    $sheet->getColumnDimension($colName)->setWidth(25);
                }
            })
        ];

        foreach ($template->getAllSheets() as $sheet) {
            PhpExcelTemplator::renderWorksheet($sheet, $sheet->toArray(), array_merge($commonVars, $recs));
        }

        $writer = IOFactory::createWriter($template, 'Xlsx');

        ob_start();
        $writer->save('php://output');
        $ret = ob_get_clean();
        ob_end_clean();

        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename=' . $date . '-summary.xlsx');

        return $ret;
    }

    public function exportActives(Request $request)
    {
        $ids = $request->input('ids');
        $actives = $this->actives->newQuery()->whereIn('id', $ids)->get();

        $actives = ExcelActiveStatsResource::collection($actives);
        $actives = json_decode($actives->toJson(), true);

        $date = (Carbon::parse($request->query('date'))->format('d.m.Y')) ?? (Carbon::now())->format('d.m.Y');

        $template = IOFactory::load(storage_path('templates/actives.xlsx'));

        $commonVars = [
            '{date}'   => $date,
        ];

        foreach ($actives as $key => $active) {
            $actives[$key] = array_values($active);
        }

        $recs = [
            '[actives]' => new ExcelParam(CellSetterArray2DValue::class, $actives, function (CallbackParam $param) {
                $sheet = $param->sheet;
                $coordinate = $param->coordinate;
                $sheet->getStyle($coordinate)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

                foreach (range('A', 'Z') as $colName) {
                    $sheet->getColumnDimension($colName)->setWidth(45);
                }
            })
        ];

        foreach ($template->getAllSheets() as $sheet) {
            PhpExcelTemplator::renderWorksheet($sheet, $sheet->toArray(), array_merge($commonVars, $recs));
        }

        $writer = IOFactory::createWriter($template, 'Xlsx');

        ob_start();
        $writer->save('php://output');
        $ret = ob_get_clean();
        ob_end_clean();

        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename=' . $date . '-actives.xlsx');

        return $ret;
    }
}
