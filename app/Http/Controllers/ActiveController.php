<?php

namespace App\Http\Controllers;

use App\Http\Requests\Client\UpdateClientRequest;
use App\Http\Requests\CreateActiveRequest;
use App\Http\Requests\UpdateActiveRequest;
use App\Http\Resources\ActiveResource;
use App\Http\Resources\OperationResource;
use App\Models\Active;
use App\Models\Operation;
use Illuminate\Http\JsonResponse;

class ActiveController extends Controller
{
    public function __construct(private Active $active, private Operation $operation)
    {
    }

    public function list(): JsonResponse
    {
        $user = $this->getUser();

        if ($user->isAdmin()) {
            $actives = $this->active::all();
        } else {
            $actives = $this->active::where('branch_id', $user->getBranchId())->get();
        }

        return new JsonResponse(['actives' => ActiveResource::collection($actives)]);
    }

    public function store(CreateActiveRequest $request): JsonResponse
    {
        $active = $this->active->newInstance();

        $active->model = $request->getModel();
        $active->body_number = $request->getBodyNumber();
        $active->reg_number = $request->getRegNumber();
        $active->year = $request->getYear();
        $active->color_id = $request->getColorId();
        $active->cost = $request->getCost();
        $active->cost_of_rent = $request->getCostOfRent();
        $active->cost_of_buyout = $request->getCostOfBuyout();
        $active->investor_id = $request->getInvestorId();
        $active->branch_id = $request->getBranchId();
        $active->osago = $request->getOsago();
        $active->osago_number = $request->getOsagoNumber();
        $active->document_series = $request->getDocumentSeries();
        $active->document_number = $request->getDocumentNumber();
        $active->document_date = $request->getDocumentDate();
        $active->document_notes = $request->getDocumentNotes();

        $active->save();

        return new JsonResponse(['active' => ActiveResource::make($active)]);
    }

    public function show(int $id): JsonResponse
    {
        $active = $this->active->find($id);

        if (!$active) {
            return $this->error('Актив не найден');
        }

        return new JsonResponse(
            [
                'active' => ActiveResource::make($active)
            ]
        );
    }

    public function update(UpdateActiveRequest $request, int $id): JsonResponse
    {
        $active = $this->active->find($id);

        if (!$active) {
            return $this->error('Актив не найден');
        }

        $active->model = $request->getModel();
        $active->body_number = $request->getBodyNumber();
        $active->reg_number = $request->getRegNumber();
        $active->year = $request->getYear();
        $active->color_id = $request->getColorId();
        $active->cost = $request->getCost();
        $active->cost_of_rent = $request->getCostOfRent();
        $active->cost_of_buyout = $request->getCostOfBuyout();
        $active->investor_id = $request->getInvestorId();
        $active->branch_id = $request->getBranchId();
        $active->osago = $request->getOsago();
        $active->osago_number = $request->getOsagoNumber();
        $active->document_series = $request->getDocumentSeries();
        $active->document_number = $request->getDocumentNumber();
        $active->document_date = $request->getDocumentDate();
        $active->document_notes = $request->getDocumentNotes();

        $active->save();

        return new JsonResponse(['active' => ActiveResource::make($active)]);
    }

    public function delete(int $id): JsonResponse
    {
        $user = $this->getUser();
        $active = $this->active->find($id);

        if (!$active || $user->getBranchId() !== $active->branch_id) {
            return $this->error('Актив не найден или находится в другом филиале');
        }

        if ($activeDeals = $active->deals) {
            foreach ($activeDeals as $activeDeal) {
                $activeDeal->delete();
            }
        }

        $active->delete();

        return $this->success();
    }

    public function credits(int $id): JsonResponse
    {
        $total = 0;
        $operations = $this->operation->where('active_id', $id)
            ->where('type', Operation::TYPE_NEGATIVE)
            ->get();

        foreach ($operations as $operation) {
            $total += $operation->amount;
        }

        return new JsonResponse([
            'operations' => OperationResource::collection($operations),
            'total'      => $total
        ]);
    }
}
