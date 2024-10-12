<?php

namespace App\Http\Controllers;

use App\Http\Resources\LegalPersonResource;
use App\Models\LegalPerson;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class LegalPersonController extends Controller
{
    public function __construct(private LegalPerson $legalPersons)
    {

    }

    public function index(): JsonResponse
    {
        /** @var User $user */
        $user = auth()->user();

        $persons = $this->legalPersons->whereHas('client', function ($q) use ($user) {
            return $q->where('company_id', '=', $user->getCompanyId());
        })->get();

        return new JsonResponse(['persons' => LegalPersonResource::collection($persons)]);
    }

    public function types(): JsonResponse
    {
        return new JsonResponse([
            'types' => [
                ['id' => 'positive', 'name' => 'Приход'],
                ['id' => 'negative', 'name' => 'Расход']
            ]
        ]);
    }
}
