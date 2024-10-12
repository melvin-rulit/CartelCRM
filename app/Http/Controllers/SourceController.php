<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSourceRequest;
use App\Http\Requests\UpdateSourceRequest;
use App\Http\Resources\SourceResource;
use App\Models\Source;
use Illuminate\Http\JsonResponse;

class SourceController extends Controller
{
    private Source $sources;

    public function __construct(Source $sources)
    {
        $this->sources = $sources;
    }

    public function index(): JsonResponse
    {
        if ($this->getUser()->isAdmin()) {
            $sources = $this->sources->all();
            return new JsonResponse(['sources' => SourceResource::collection($sources)]);
        }

        return new JsonResponse(['sources' => []]);
    }

    public function store(CreateSourceRequest $request): JsonResponse
    {
        $source = new Source();

        $source->name = $request->getName();
        $source->amount = $request->getAmount();
        $source->percent = $request->getPercent();
        $source->investor_id = $request->getInvestorId();

        $source->save();

        return new JsonResponse(['source' => SourceResource::make($source)]);
    }

    public function update(UpdateSourceRequest $request, int $id): JsonResponse
    {
        $source = $this->sources->find($id);

        $source->name = $request->getName();
        $source->amount = $request->getAmount();
        $source->percent = $request->getPercent();
        $source->investor_id = $request->getInvestorId();

        $source->save();

        return new JsonResponse(['source' => SourceResource::make($source)]);
    }

    public function show(int $id): JsonResponse
    {
        $source = $this->sources->find($id);
        return new JsonResponse(['source' => SourceResource::make($source)]);
    }
}
