<?php

namespace App\Http\Controllers;

use App\Http\Requests\Operation\CreateOperationRequest;
use App\Http\Requests\Operation\UpdateOperationRequest;
use App\Http\Resources\OperationResource;
use App\Models\Operation;
use Illuminate\Http\JsonResponse;

class OperationController extends Controller
{
    public function __construct(private Operation $operations)
    {
    }

    public function index(): JsonResponse
    {
        $operations = $this->operations::all();
        return new JsonResponse(['operations' => OperationResource::collection($operations)]);
    }

    public function store(CreateOperationRequest $request): JsonResponse
    {
        $operation = $this->operations->newInstance();

        $operation->active_id = $request->getActiveId();
        $operation->date = $request->getDate();
        $operation->name = $request->getName();
        $operation->type = $request->getType();
        $operation->amount = $request->getAmount();

        $operation->save();

        return new JsonResponse(['operation' => OperationResource::make($operation)]);
    }

    public function show(int $id): JsonResponse
    {
        $operation = $this->operations->find($id);

        if (!$operation) {
            return $this->error('Статья расходов не найдена');
        }

        return new JsonResponse(['operation' => OperationResource::make($operation)]);
    }

    public function update(UpdateOperationRequest $request, int $id): JsonResponse
    {
        $operation = $this->operations->find($id);

        if (!$operation) {
            return $this->error('Статья расходов не найдена');
        }

        $operation->name = $request->getName();
        $operation->enabled = $request->isEnabled();
        $operation->type = $request->getType();

        $operation->save();

        return new JsonResponse(['operation' => OperationResource::make($operation)]);
    }

    public function types(): JsonResponse
    {
        return new JsonResponse(
            [
                'types' => [
                    ['id' => Operation::TYPE_POSITIVE, 'name' => 'Приход'],
                    ['id' => Operation::TYPE_NEGATIVE, 'name' => 'Расход']
                ]
            ]
        );
    }
}
