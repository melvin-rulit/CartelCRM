<?php

namespace App\Http\Controllers;

use App\Http\Requests\Client\CreateClientRequest;
use App\Http\Requests\Client\CreateLegalPersonRequest;
use App\Http\Requests\Client\UpdateClientRequest;
use App\Http\Requests\ClientAmount\CreateClientAmountRequest;
use App\Http\Resources\ClientAmountResource;
use App\Http\Resources\ClientFileResource;
use App\Http\Resources\ClientResource;
use App\Http\Resources\LegalPersonResource;
use App\Models\Client;
use App\Models\ClientAmount;
use App\Models\File;
use App\Models\LegalPerson;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function __construct(private Client $client)
    {
    }

    public function index(Request $request): JsonResponse
    {
        $user = $this->getUser();

        if ($user->isAdmin()) {
            $clientsQuery = $this->client->newQuery();
        } else {
            $clientsQuery = $this->client->newQuery()->where('branch_id', $user->getBranchId());
        }

        if ($query = $request->query('query')) {
            $clientsQuery->where('phone_number', 'like', "%{$query}%")
                ->orWhere('first_name', 'like', "%{$query}%")
                ->orWhere('middle_name', 'like', "%{$query}%")
                ->orWhere('last_name', 'like', "%{$query}%");
        }

        $clients = $clientsQuery->get();

        return new JsonResponse(['clients' => ClientResource::collection($clients)]);
    }

    public function store(CreateClientRequest $request): JsonResponse
    {
        /** @var User $user */
        $user = auth()->user();

        $client = $this->client->newInstance();

        $client->first_name = $request->getFirstName();
        $client->middle_name = $request->getMiddleName();
        $client->last_name = $request->getLastName();
        $client->birthday = $request->getBirthday();
        $client->passport_series = $request->getPassportSeries();
        $client->passport_number = $request->getPassportNumber();
        $client->passport_notes = $request->getPassportNotes();
        $client->registration_address = $request->getRegistrationAddress();
        $client->residence_address = $request->getResidenceAddress();
        $client->phone_number = $request->getPhone();
        $client->email = $request->getEmail();
        $client->comment = $request->getComment();
        $client->branch_id = $user->getBranchId();
        $client->resident_card = $request->getResidentCard();
        $client->personnel_number = $request->getPersonnelNumber();

        $client->save();

        return new JsonResponse(['client' => ClientResource::make($client)]);
    }

    public function show(int $id): JsonResponse
    {
        /** @var User $user */
        $user = auth()->user();
        $client = $this->client->find($id);

        if (!$client || $client->branch_id !== $user->getBranchId()) {
            return $this->error('Клиент не найден');
        }

        return new JsonResponse(
            [
                'client' => ClientResource::make($client),
                'files'  => ClientFileResource::collection($client->files()->get())
            ]
        );
    }

    public function deleteFile(Request $request, int $id, int $fileId): JsonResponse
    {
        $user = $this->getUser();
        $client = $this->client->find($id);

        if (!$client || $client->branch_id !== $user->getBranchId()) {
            return $this->error('Вы не можете удалять файлы клиента другого филиала');
        }

        $file = File::find($fileId);

        if (!$file) {
            return $this->error('Файл не найден');
        }

        try {
            \Storage::disk('public')->delete($file->path);
            $file->delete();
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }

        $client->refresh();

        return new JsonResponse(
            [
                'client' => ClientResource::make($client),
                'files'  => ClientFileResource::collection($client->files()->get())
            ]
        );
    }

    public function update(UpdateClientRequest $request, int $id): JsonResponse
    {
        /** @var User $user */
        $user = auth()->user();
        $client = $this->client->find($id);

        if (!$client || $client->branch_id !== $user->getBranchId()) {
            return $this->error('Клиент не найден');
        }

        $client->first_name = $request->getFirstName();
        $client->middle_name = $request->getMiddleName();
        $client->last_name = $request->getLastName();
        $client->birthday = $request->getBirthday();
        $client->passport_series = $request->getPassportSeries();
        $client->passport_number = $request->getPassportNumber();
        $client->passport_notes = $request->getPassportNotes();
        $client->registration_address = $request->getRegistrationAddress();
        $client->residence_address = $request->getResidenceAddress();
        $client->phone_number = $request->getPhone();
        $client->email = $request->getEmail();
        $client->comment = $request->getComment();
        $client->branch_id = $user->getBranchId();
        $client->resident_card = $request->getResidentCard();
        $client->personnel_number = $request->getPersonnelNumber();

        $client->save();

        return new JsonResponse(
            [
                'client' => ClientResource::make($client),
                'files'  => ClientFileResource::collection($client->files()->get())
            ]
        );
    }

    public function upload(Request $request, int $id)
    {
        $file = $request->file('file');
        $parts = explode('.', $file->getClientOriginalName());
        $ext = end($parts);
        $filename = sha1($file->getClientOriginalName() . Carbon::now()) . '.' . $ext;

        \Storage::disk('public')->put($filename, $file->getContent());

        $model = new File();

        $model->client_id = $id;
        $model->filename = $file->getClientOriginalName();
        $model->path = $filename;
        $model->filesize = $file->getSize();

        $model->save();

        return new JsonResponse(['file' => ClientFileResource::make($model)]);
    }

    public function delete(int $id): JsonResponse
    {
        $user = $this->getUser();
        $client = $this->client->find($id);

        if (!$client || $user->getBranchId() !== $client->branch_id) {
            return $this->error('Клиент не найден или он находится в другой филиале');
        }

        $clientDeals = $client->deals;

        if ($clientDeals) {
            foreach ($clientDeals as $deal) {
                $dealPayments = $deal->payments;
                if ($dealPayments) {
                    foreach ($dealPayments as $payment) {
                        $payment->delete();
                    }
                }
                $deal->delete();
            }
        }

        $client->phone_number = '';
        $client->save();
        $client->delete();

        return $this->success();
    }
}
