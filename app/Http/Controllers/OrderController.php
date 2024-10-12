<?php

namespace App\Http\Controllers;

use App\Http\Requests\Deal\CreateDealRequest;
use App\Http\Requests\Deal\UpdateDealRequest;
use App\Http\Resources\Counterparties\Orders\OrderResource;
use App\Models\CounterpartiesOrders;
use App\Models\Deal;
use App\Models\Payday;
use App\Models\Schedule;
use App\Services\CustomTemplateProcessor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\Element\Table;
use PhpOffice\PhpWord\SimpleType\TblWidth;
use PhpOffice\PhpWord\TemplateProcessor;

class OrderController extends Controller
{
    private const PER_PAGE = 20;

    public function __construct(private Deal $deals)
    {
    }

    public function index(Request $request): JsonResponse
    {
//        $user = auth()->user();
//
//        if ($user->isAdmin()) {
//            $query = $this->CounterpartiesOrders->whereNull('in_arhive');
//        } else {
//            $query = $this->CounterpartiesOrders->where('branch_id', $user->getBranchId());
//        }
//
//        //client name filter
//        if ($clientName = $request->query('clientName')) {
//            $query->whereHas('client', function ($q) use ($clientName) {
//                $q->whereRaw('1 = 1');
//                $parts = explode(' ', $clientName);
//                foreach ($parts as $part) {
//                    $q->where('first_name', 'like', "%{$part}%");
//                    $q->orWhere('middle_name', 'like', "%{$part}%");
//                    $q->orWhere('last_name', 'like', "%{$part}%");
//                }
//            });
//        }
//
//        //owner name filter
//        if ($ownerName = $request->query('ownerName')) {
//            $query->whereHas('owner', function ($q) use ($ownerName) {
//                $q->whereRaw('1 = 1');
//                $parts = explode(' ', $ownerName);
//                foreach ($parts as $part) {
//                    $q->where('first_name', 'like', "%{$part}%");
//                    $q->orWhere('middle_name', 'like', "%{$part}%");
//                    $q->orWhere('last_name', 'like', "%{$part}%");
//                }
//            });
//        }
//
//        //active name filter
//        if ($activeName = $request->query('activeName')) {
//            $query->whereHas('active', function ($q) use ($activeName) {
//                $q->where('model', 'like', "%{$activeName}%");
//            });
//        }
//
//        //deal date filter
//        if ($dealDate = $request->query('dealDate')) {
//            $dealDate = Carbon::parse($dealDate);
//            $query->where('created_at', $dealDate->startOfDay());
//        }

        $orders = CounterpartiesOrders::all();
//        $orders = $query->paginate(self::PER_PAGE);

        return new JsonResponse(
            [
                'orders' => OrderResource::collection($orders),
//                'deal_static_type' => ['1' => Deal::KIND_WITH_OWNER, '2' => Deal::KIND_WITH_PROXY],
                'limit' => self::PER_PAGE,
//                'total' => $orders->total(),
                'url'   => route('orders.list')
            ]
        );
    }

    public function arhiveDeals( int $id): JsonResponse
    {
        $deal = $this->deals->find($id);


        $deal->in_arhive = 1;

        $deal->save();

        // return new JsonResponse(['deal' => OrderResource::make($deal)]);
    }

    public function types(): JsonResponse
    {
        return new JsonResponse(
            [
                'types' => [
                    ['id' => Deal::TYPE_RENT, 'name' => 'Аренда под выкуп'],
                    ['id' => Deal::TYPE_CREDIT, 'name' => 'Автокредитование'],
                ]
            ]
        );
    }

    public function kinds(): JsonResponse
    {
        return new JsonResponse(
            [
                'kinds' => [
                    ['id' => Deal::KIND_WITH_PROXY, 'name' => 'По доверенности'],
                    ['id' => Deal::KIND_WITH_OWNER, 'name' => 'С арендодателем'],
                ]
            ]
        );
    }

    public function show(int $id): JsonResponse
    {
        $user = $this->getUser();

        if ($user->isAdmin()) {
            $deal = $this->deals->find($id);
        } else {
            $deal = $this->deals->where('branch_id', $user->getBranchId())->where('id', $id)->first();
        }

        if (!$deal) {
            return $this->error('Сделка не найдена');
        }

        return new JsonResponse(
            [
//                'deal' => OrderResource::make($deal),
            ]
        );
    }

    public function delete(int $id): JsonResponse
    {
        $user = $this->getUser();
        $deal = $this->deals->find($id);

        if (!$deal || ($deal->branch_id !== $user->getBranchId() && !$user->isAdmin())) {
            return $this->error('Сделка не найдена или находится в другом филиале');
        }

        if ($dealPayments = $deal->payments) {
            foreach ($dealPayments as $dealPayment) {
                $dealPayment->delete();
            }
        }

        $deal->delete();

        return $this->success();
    }

    public function activeDeals(int $id): JsonResponse
    {
        $deals = $this->deals->where('active_id', $id)
            ->orderBy('created_at', 'asc')
            ->get();

        return new JsonResponse(
            [
//                'CounterpartiesOrders' => OrderResource::collection($CounterpartiesOrders)
            ]
        );
    }

    public function store(CreateDealRequest $request): JsonResponse
    {
        $deal = new Deal();

        $deal->type = $request->getType();
        $deal->kind = $request->getKind();
        $deal->proxy_id = $request->getProxyId();
        $deal->owner_id = $request->getOwnerId();
        $deal->branch_id = $request->getBranchId();
        $deal->client_id = $request->getClientId();
        $deal->active_id = $request->getActiveId();
        $deal->remain = $request->getRemain();
        $deal->valid_until = $request->getValidUntil();
        $deal->cost_of_rent = $request->getCostOfRent();
        $deal->cost_of_buyout = $request->getCostOfBuyout();
        $deal->initial = $request->getInitial();
        $deal->redemption_period = $request->getRedemptionPeriod();
        $deal->comment = $request->getComment();
        $deal->citizenship = $request->getCitizenship();
        $deal->created_at = $request->getCreatedAt();

        $deal->save();

        $schedule = new Schedule();
        $schedule->deal_id = $deal->id;
        $schedule->save();

        $now = $deal->created_at;

        $remain = $deal->remain;

        if ($deal->type === Deal::TYPE_CREDIT) {
            $remain -= $deal->initial;
        }

        if ($deal->type === Deal::TYPE_RENT) {
            for ($i = 1; $i <= 1000; $i++) {
                if ($remain <= 0) {
                    break;
                }
                $nextDate = clone($now);
                $nextDate = $nextDate->addWeeks($i);

                $payday = new Payday();

                $payday->schedule_id = $schedule->id;
                $payday->date = $nextDate->toDate();

                $payday->save();
                $remain -= $deal->cost_of_buyout;
            }
        } else {
            for ($i = 1; $i <= 1000; $i++) {
                if ($remain <= 0) {
                    break;
                }
                $nextDate = clone($now);
                $nextDate = $nextDate->addMonths($i);

                $payday = new Payday();

                $payday->schedule_id = $schedule->id;
                $payday->date = $nextDate->toDate();

                $payday->save();
                $remain -= $deal->cost_of_buyout;
            }
        }

        return new JsonResponse(['deal' => OrderResource::make($deal)]);
    }

    public function update(UpdateDealRequest $request, int $id): JsonResponse
    {
        $deal = $this->deals->find($id);

        if (!$deal) {
            return $this->error('Сделка не найдена');
        }

        $deal->type = $request->getType();
        $deal->kind = $request->getKind();
        $deal->proxy_id = $request->getProxyId();
        $deal->owner_id = $request->getOwnerId();
        $deal->branch_id = $request->getBranchId();
        $deal->client_id = $request->getClientId();
        $deal->active_id = $request->getActiveId();
        $deal->remain = $request->getRemain();
        $deal->valid_until = $request->getValidUntil();
        $deal->cost_of_rent = $request->getCostOfRent();
        $deal->cost_of_buyout = $request->getCostOfBuyout();
        $deal->redemption_period = $request->getRedemptionPeriod();
        $deal->initial = $request->getInitial();
        $deal->comment = $request->getComment();
        $deal->citizenship = $request->getCitizenship();
        $deal->created_at = $request->getCreatedAt();

        $deal->save();

        return new JsonResponse(['deal' => OrderResource::make($deal)]);
    }

    public function contract(int $dealId)
    {
        $deal = $this->deals->find($dealId);

        if (!$deal) {
            return $this->error('Сделка не найдена');
        }

        if ($this->getUser()->isAdmin() || $this->getUser()->getBranchId() === $deal->branch->id) {
            if ($deal->kind === Deal::KIND_WITH_PROXY) {
                return $this->fillProxyContract($deal);
            } else {
                return $this->fillContract($deal);
            }
        }

        return $this->error('Недостаточно прав');
    }

    public function act(int $dealId)
    {
        $deal = $this->deals->find($dealId);

        if (!$deal) {
            return $this->error('Сделка не найдена');
        }

        if ($this->getUser()->isAdmin() || $this->getUser()->getBranchId() === $deal->branch->id) {
            $template = new TemplateProcessor(storage_path('templates/act.docx'));

            $template->setValue('dealDate', $deal->created_at->format('d.m.Y'));
            $template->setValue('dealTime', $deal->created_at->format('H:i'));
            $template->setValue('branchName', $deal->branch->name);
            $template->setValue('branchAddress', $deal->branch->address);

            if (!$deal->client->resident_card) {
                $template->replaceBlock('block_resident_card', '');
            } else {
                $template->replaceBlock('block_passport', '');
                $template->replaceBlock('block_personnel_number', '');
            }

            if (!$deal->client->personnel_number) {
                $template->replaceBlock('block_personnel_number', '');
            }

            $template->setValue('block_resident_card', '');
            $template->setValue('/block_resident_card', '');
            $template->setValue('block_passport', '');
            $template->setValue('/block_passport', '');
            $template->setValue('block_personnel_number', '');
            $template->setValue('/block_personnel_number', '');

            $template->setValue('clientFullName', $deal->client->getFullName());
            $template->setValue('clientBirthday', $deal->client->birthday->format('d.m.Y'));
            $template->setValue('clientPassportSeries', $deal->client->passport_series);
            $template->setValue('clientPassportNumber', $deal->client->passport_number);
            $template->setValue('clientPassportNotes', $deal->client->passport_notes);
            $template->setValue('clientRegistrationAddress', $deal->client->registration_address);
            $template->setValue('clientResidenceAddress', $deal->client->residence_address);
            $template->setValue('clientResidentCard', $deal->client->resident_card);
            $template->setValue('clientPersonnelNumber', $deal->client->personnel_number);
            $template->setValue('clientPhone', $deal->client->phone_number);
            $template->setValue('citizenship', $deal->citizenship);

            if ($deal->owner) {
                $template->setValue('ownerFullName', $deal->owner->getFullName());
                $template->setValue('ownerBirthday', $deal->owner->birthday->format('d.m.Y'));
                $template->setValue('ownerPassportSeries', $deal->owner->passport_series);
                $template->setValue('ownerPassportNumber', $deal->owner->passport_number);
                $template->setValue('ownerPassportNotes', $deal->owner->passport_notes);
                $template->setValue('ownerRegistrationAddress', $deal->owner->registration_address);
            } elseif ($deal->proxy) {
                $template->setValue('ownerFullName', $deal->proxy->owner->getFullName());
                $template->setValue('ownerBirthday', $deal->proxy->owner->birthday->format('d.m.Y'));
                $template->setValue('ownerPassportSeries', $deal->proxy->owner->passport_series);
                $template->setValue('ownerPassportNumber', $deal->proxy->owner->passport_number);
                $template->setValue('ownerPassportNotes', $deal->proxy->owner->passport_notes);
                $template->setValue('ownerRegistrationAddress', $deal->proxy->owner->registration_address);
            }

            $template->setValue('activeModel', $deal->active->model);
            $template->setValue('activeRegNumber', $deal->active->reg_number);
            $template->setValue('activeBodyNumber', $deal->active->body_number);
            $template->setValue('activeYear', $deal->active->year);
            $template->setValue('activeColor', $deal->active->getColor());
            $template->setValue('activeDocumentSeries', $deal->active->document_series);
            $template->setValue('activeDocumentNumber', $deal->active->document_number);
            $template->setValue('activeDocumentDate', $deal->active->document_date->format('d.m.Y'));
            $template->setValue('activeOsago', $deal->active->osago_number);

            $template->setValue('activeDocumentNotes', $deal->active->document_notes);
            ob_start();
            $template->saveAs('php://output');
            $ret = ob_get_contents();
            ob_end_clean();

            header("Content-Type: application/force-download");
            header("Content-Type: application/octet-stream");
            header("Content-Type: application/download");
            header('Content-Disposition: attachment; filename=' . $deal->id . '-act.docx');

            return $ret;
        }

        return $this->error('Недостаточно прав');
    }

    public function payments(int $dealId)
    {
        $deal = $this->deals->find($dealId);

        if (!$deal) {
            return $this->error('Сделка не найдена');
        }

        if ($this->getUser()->isAdmin() || $this->getUser()->getBranchId() === $deal->branch->id) {
            $template = new TemplateProcessor(storage_path('templates/payments.docx'));

            $template->setValue('dealDate', $deal->created_at->format('d.m.Y'));
            $template->setValue('branchName', $deal->branch->name);

            if (!$deal->client->resident_card) {
                $template->replaceBlock('block_resident_card', '');
            } else {
                $template->replaceBlock('block_passport', '');
                $template->replaceBlock('block_personnel_number', '');
            }

            if (!$deal->client->personnel_number) {
                $template->replaceBlock('block_personnel_number', '');
            }

            $template->setValue('block_resident_card', '');
            $template->setValue('/block_resident_card', '');
            $template->setValue('block_passport', '');
            $template->setValue('/block_passport', '');
            $template->setValue('block_personnel_number', '');
            $template->setValue('/block_personnel_number', '');

            $template->setValue('clientFullName', $deal->client->getFullName());
            $template->setValue('clientBirthday', $deal->client->birthday->format('d.m.Y'));
            $template->setValue('clientPassportSeries', $deal->client->passport_series);
            $template->setValue('clientPassportNumber', $deal->client->passport_number);
            $template->setValue('clientPassportNotes', $deal->client->passport_notes);
            $template->setValue('clientRegistrationAddress', $deal->client->registration_address);
            $template->setValue('clientResidenceAddress', $deal->client->residence_address);
            $template->setValue('clientResidentCard', $deal->client->resident_card);
            $template->setValue('clientPersonnelNumber', $deal->client->personnel_number);
            $template->setValue('clientPhone', $deal->client->phone_number);
            $template->setValue('citizenship', $deal->citizenship);

            $template->setValue('activeModel', $deal->active->model);
            $template->setValue('activeRegNumber', $deal->active->reg_number);
            $template->setValue('activeBodyNumber', $deal->active->body_number);
            $template->setValue('activeYear', $deal->active->year);
            $template->setValue('activeColor', $deal->active->getColor());
            $template->setValue('activeDocumentSeries', $deal->active->document_series);
            $template->setValue('activeDocumentNumber', $deal->active->document_number);
            $template->setValue('activeDocumentDate', $deal->active->document_date->format('d.m.Y'));
            $template->setValue('activeOsago', $deal->active->osago_number);

            $table = new Table(['unit' => TblWidth::TWIP, 'width' => '9500']);

            $cellStyle = [
                'borderColor' => '000000',
                'borderSize'  => 9,
                'valign'      => 'center'
            ];

            $table->addRow();
            $table->addCell(1500, $cellStyle)->addText('Дата платежа');
            $table->addCell(1350, $cellStyle)->addText('Аренда');
            $table->addCell(1350, $cellStyle)->addText('Выкуп');
            $table->addCell(1350, $cellStyle)->addText('Остаток');
            $table->addCell(1350, $cellStyle)->addText('Дата просрочки');
            $table->addCell(1350, $cellStyle)->addText('Примечание');
            $table->addCell(1250, $cellStyle)->addText('Подпись');

            $dealRemain = $deal->remain;

            if ($deal->type === Deal::TYPE_CREDIT) {
                $dealRemain -= $deal->inital;
            }

            foreach ($deal->payments as $payment) {
                $dealRemain -= $payment->buyout;
                $table->addRow();
                $table->addCell(1500, $cellStyle)->addText($payment->created_at->format('d.m.Y'));
                $table->addCell(1350, $cellStyle)->addText($payment->rent);
                $table->addCell(1350, $cellStyle)->addText($payment->buyout);
                $table->addCell(1350, $cellStyle)->addText($dealRemain);
                $table->addCell(1350, $cellStyle)->addText(' ');
                $table->addCell(1350, $cellStyle)->addText(' ');
                $table->addCell(1250, $cellStyle)->addText(' ');
            }

            $template->setComplexBlock('{table}', $table);

            ob_start();
            $template->saveAs('php://output');
            $ret = ob_get_contents();
            ob_end_clean();

            header("Content-Type: application/force-download");
            header("Content-Type: application/octet-stream");
            header("Content-Type: application/download");
            header('Content-Disposition: attachment; filename=' . $deal->id . '-payments.docx');

            return $ret;
        }

        return $this->error('Недостаточно прав');
    }

    private function costAsString(float $cost, $needFractions = false): string
    {
        $parts = explode('.', $cost);

        if (!$needFractions) {
            return sprintf('%s', number2string($parts[0]));
        }

        return sprintf('%s рублей %s копеек', number2string($parts[0]), number2string($parts[1]));
    }

    private function fillContract(Deal $deal)
    {
        $divisor = 7;

        if ($deal->type === Deal::TYPE_CREDIT) {
            $divisor = 30;
            $template = new CustomTemplateProcessor(storage_path('templates/contract-credit.docx'));
        } else {
            $template = new CustomTemplateProcessor(storage_path('templates/contract.docx'));
        }

        $template->setValue('dealDate', $deal->created_at->format('d.m.Y'));
        $template->setValue('branchName', $deal->branch->name);

        if (!$deal->client->resident_card) {
            $template->replaceBlock('block_resident_card', '');
        } else {
            $template->replaceBlock('block_passport', '');
            $template->replaceBlock('block_personnel_number', '');
        }

        if (!$deal->client->personnel_number) {
            $template->replaceBlock('block_personnel_number', '');
        }

        $template->setValue('clientFullName', $deal->client->getFullName());
        $template->setValue('clientBirthday', $deal->client->birthday->format('d.m.Y'));
        $template->setValue('clientPassportSeries', $deal->client->passport_series);
        $template->setValue('clientPassportNumber', $deal->client->passport_number);
        $template->setValue('clientPassportNotes', $deal->client->passport_notes);
        $template->setValue('clientRegistrationAddress', $deal->client->registration_address);
        $template->setValue('clientResidenceAddress', $deal->client->residence_address);
        $template->setValue('clientResidentCard', $deal->client->resident_card);
        $template->setValue('clientPersonnelNumber', $deal->client->personnel_number);
        $template->setValue('clientPhone', $deal->client->phone_number);
        $template->setValue('citizenship', $deal->citizenship);
        $template->setValue('block_resident_card', '');
        $template->setValue('/block_resident_card', '');
        $template->setValue('block_passport', '');
        $template->setValue('/block_passport', '');
        $template->setValue('block_personnel_number', '');
        $template->setValue('/block_personnel_number', '');

        $template->setValue('ownerFullName', $deal->owner->getFullName());
        $template->setValue('ownerBirthday', $deal->owner->birthday->format('d.m.Y'));
        $template->setValue('ownerPassportSeries', $deal->owner->passport_series);
        $template->setValue('ownerPassportNumber', $deal->owner->passport_number);
        $template->setValue('ownerPassportNotes', $deal->owner->passport_notes);
        $template->setValue('ownerRegistrationAddress', $deal->owner->registration_address);

        $template->setValue('activeModel', $deal->active->model);
        $template->setValue('activeRegNumber', $deal->active->reg_number);
        $template->setValue('activeBodyNumber', $deal->active->body_number);
        $template->setValue('activeYear', $deal->active->year);
        $template->setValue('activeColor', $deal->active->getColor());
        $template->setValue('activeDocumentSeries', $deal->active->document_series);
        $template->setValue('activeDocumentNumber', $deal->active->document_number);
        $template->setValue('activeDocumentDate', $deal->active->document_date->format('d.m.Y'));
        $template->setValue('activeDocumentNotes', $deal->active->document_notes);

        $template->setValue('costOfRentInDay', round($deal->cost_of_rent / $divisor));
        $template->setValue('costOfRentInDayAsString', $this->costAsString(round($deal->cost_of_rent / $divisor), 0));
        $template->setValue('costOfRent', round($deal->cost_of_rent));
        $template->setValue('costOfRentAsString', $this->costAsString(round($deal->cost_of_rent)));
        $template->setValue('dealRemain', round($deal->remain));
        $template->setValue('dealRemainAsString', $this->costAsString(round($deal->remain)));
        $template->setValue('costOfBuyoutInDay', round($deal->cost_of_buyout / $divisor));
        $template->setValue('costOfBuyoutInDayAsString', $this->costAsString(round($deal->cost_of_buyout / $divisor), 0));
        $template->setValue('costOfBuyout', round($deal->cost_of_buyout));
        $template->setValue('costOfBuyoutAsString', $this->costAsString(round($deal->cost_of_buyout)));
        $template->setValue('penalty', round($deal->cost_of_buyout / $divisor * 2));
        $template->setValue('penaltyAsString', $this->costAsString(round($deal->cost_of_buyout / $divisor * 2)));

        $template->setValue('nextPayday', $deal->created_at->addMonth()->format('d.m.Y'));
        $template->setValue('payday', $deal->created_at->day);
        $template->setValue('paydayAsString', $this->costAsString($deal->created_at->day));
        $template->setValue('initial', $deal->getInitial());
        $template->setValue('initialAsString', $this->costAsString($deal->getInitial()));
        $template->setValue('cost', $deal->remain - $deal->getInitial());
        $template->setValue('costAsString', $this->costAsString($deal->remain - $deal->getInitial()));
        $template->setValue('summa', $deal->cost_of_buyout + $deal->cost_of_rent);
        $template->setValue('summaAsString', $this->costAsString($deal->cost_of_buyout + $deal->cost_of_rent));
        $template->setValue('summaInDay', round(($deal->cost_of_buyout + $deal->cost_of_rent) / $divisor));

        ob_start();
        $template->saveAs('php://output');
        $ret = ob_get_contents();
        ob_end_clean();

        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header('Content-Disposition: attachment; filename=' . $deal->id . '-contract.docx');

        return $ret;
    }

    private function fillProxyContract(Deal $deal)
    {
        $divisor = 7;

        if ($deal->type === Deal::TYPE_CREDIT) {
            $divisor = 30;
        }

        $template = new TemplateProcessor(storage_path('templates/proxy.docx'));

        $template->setValue('dealDate', $deal->created_at->format('d.m.Y'));
        $template->setValue('branchName', $deal->branch->name);

        if (!$deal->client->resident_card) {
            $template->replaceBlock('block_resident_card', '');
        } else {
            $template->replaceBlock('block_passport', '');
            $template->replaceBlock('block_personnel_number', '');
        }

        if (!$deal->client->personnel_number) {
            $template->replaceBlock('block_personnel_number', '');
        }

        $template->setValue('block_resident_card', '');
        $template->setValue('/block_resident_card', '');
        $template->setValue('block_passport', '');
        $template->setValue('/block_passport', '');
        $template->setValue('block_personnel_number', '');
        $template->setValue('/block_personnel_number', '');

        $template->setValue('clientFullName', $deal->client->getFullName());
        $template->setValue('clientBirthday', $deal->client->birthday?->format('d.m.Y'));
        $template->setValue('clientPassportSeries', $deal->client->passport_series);
        $template->setValue('clientPassportNumber', $deal->client->passport_number);
        $template->setValue('clientPassportNotes', $deal->client->passport_notes);
        $template->setValue('clientRegistrationAddress', $deal->client->registration_address);
        $template->setValue('clientResidenceAddress', $deal->client->residence_address);
        $template->setValue('clientResidentCard', $deal->client->resident_card);
        $template->setValue('clientPersonnelNumber', $deal->client->personnel_number);
        $template->setValue('clientPhone', $deal->client->phone_number);
        $template->setValue('citizenship', $deal->citizenship);

        $template->setValue('delegateFullName', $deal->proxy->delegate->getFullName());
        $template->setValue('delegateBirthday', $deal->proxy->delegate->birthday?->format('d.m.Y'));
        $template->setValue('delegatePassportSeries', $deal->proxy->delegate->passport_series);
        $template->setValue('delegatePassportNumber', $deal->proxy->delegate->passport_number);
        $template->setValue('delegatePassportNotes', $deal->proxy->delegate->passport_notes);
        $template->setValue('delegateRegistrationAddress', $deal->proxy->delegate->registration_address);
        $template->setValue('delegateResidenceAddress', $deal->proxy->delegate->registration_address);

        $template->setValue('proxyNumber', $deal->proxy->number);
        $template->setValue('proxyDate', $deal->proxy->valid_until->format('d.m.Y'));
        $template->setValue('proxyNotes', $deal->proxy->issued_by);
        $template->setValue('proxyIssuedNumber', $deal->proxy->issued_number);

        $template->setValue('ownerFullName', $deal->proxy->owner->getFullName());
        $template->setValue('ownerBirthday', $deal->proxy->owner->birthday->format('d.m.Y'));
        $template->setValue('ownerPassportSeries', $deal->proxy->owner->passport_series);
        $template->setValue('ownerPassportNumber', $deal->proxy->owner->passport_number);
        $template->setValue('ownerPassportNotes', $deal->proxy->owner->passport_notes);
        $template->setValue('ownerRegistrationAddress', $deal->proxy->owner->registration_address);
        $template->setValue('ownerResidenceAddress', $deal->proxy->owner->residence_address);

        $template->setValue('activeModel', $deal->active->model);
        $template->setValue('activeRegNumber', $deal->active->reg_number);
        $template->setValue('activeBodyNumber', $deal->active->body_number);
        $template->setValue('activeYear', $deal->active->year);
        $template->setValue('activeColor', $deal->active->getColor());
        $template->setValue('activeDocumentSeries', $deal->active->document_series);
        $template->setValue('activeDocumentNumber', $deal->active->document_number);
        $template->setValue('activeDocumentDate', $deal->active->document_date->format('d.m.Y'));
        $template->setValue('activeDocumentNotes', $deal->active->document_notes);

        $template->setValue('costOfRentInDay', round($deal->cost_of_rent / $divisor));
        $template->setValue('costOfRentInDayAsString', $this->costAsString(round($deal->cost_of_rent / $divisor), 0));
        $template->setValue('costOfRent', round($deal->cost_of_rent));
        $template->setValue('costOfRentAsString', $this->costAsString(round($deal->cost_of_rent)));
        $template->setValue('dealRemain', round($deal->remain));
        $template->setValue('dealRemainAsString', $this->costAsString(round($deal->remain)));
        $template->setValue('costOfBuyoutInDay', round($deal->cost_of_buyout / $divisor));
        $template->setValue('costOfBuyoutInDayAsString', $this->costAsString(round($deal->cost_of_buyout / $divisor), 0));
        $template->setValue('costOfBuyout', round($deal->cost_of_buyout));
        $template->setValue('costOfBuyoutAsString', $this->costAsString(round($deal->cost_of_buyout)));
        $template->setValue('penalty', round($deal->cost_of_buyout / $divisor * 2));
        $template->setValue('penaltyAsString', $this->costAsString(round($deal->cost_of_buyout / $divisor * 2)));

        ob_start();
        $template->saveAs('php://output');
        $ret = ob_get_contents();
        ob_end_clean();

        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header('Content-Disposition: attachment; filename=' . $deal->id . '-contract.docx');

        return $ret;
    }
}
