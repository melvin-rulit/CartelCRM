<?php

namespace App\Http\Controllers;

use App\Http\Requests\Company\CreateCompanyRequest;
use App\Http\Requests\Company\UpdateCompanyRequest;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use Illuminate\Http\JsonResponse;

class CompanyController extends Controller
{
    public function __construct(private Company $companies)
    {

    }

    public function index(): JsonResponse
    {
        $companies = $this->companies->all();
        return new JsonResponse(['companies' => CompanyResource::collection($companies)]);
    }

    public function store(CreateCompanyRequest $request): JsonResponse
    {
        $company = $this->companies->newInstance();

        $company->name = $request->getName();
        $company->save();

        return new JsonResponse(['company' => CompanyResource::make($company)]);
    }

    public function show(int $id): JsonResponse
    {
        $company = $this->companies->find($id);

        if (!$company) {
            return $this->error('Company not found');
        }

        return new JsonResponse(['company' => CompanyResource::make($company)]);
    }

    public function update(UpdateCompanyRequest $request, int $id): JsonResponse
    {
        $company = $this->companies->find($id);

        if (!$company) {
            return $this->error('Company not found');
        }

        $company->name = $request->getName();
        $company->save();

        return new JsonResponse(['company' => CompanyResource::make($company)]);
    }

    public function delete(int $id): JsonResponse
    {
        $company = $this->companies->find($id);

        if (!$company) {
            return $this->error('Company not found');
        }

        $company->delete();

        return $this->success();
    }
}
