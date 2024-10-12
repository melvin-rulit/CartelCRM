<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRemainRequest;
use App\Http\Resources\RemainResource;
use App\Models\Remain;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RemainController extends Controller
{
    private const PER_PAGE = 50;
    private Remain $remains;

    public function __construct(Remain $remains)
    {
        $this->remains = $remains;
    }

    public function list(Request $request): JsonResponse
    {
        $user = $this->getUser();

        $query = $this->remains
            ->where('company_id', $user->getCompanyId())
            ->orderBy('created_at', 'desc');

        if ($date = $request->query('date')) {
            if ($date !== 'null') {
                $query->where('created_at', '<=', Carbon::parse($date));
            }
        }

        $remains = $query->paginate(self::PER_PAGE);

        return new JsonResponse([
            'remains' => RemainResource::collection($remains),
            'limit'   => self::PER_PAGE,
            'total'   => $remains->total(),
            'url'     => route('remains.list')
        ]);
    }

    public function store(CreateRemainRequest $request): JsonResponse
    {
        $user = $this->getUser();

        $remain = new Remain();

        $remain->amount = $request->getAmount();
        $remain->created_at = $request->getCreatedAt();
        $remain->company_id = $user->getCompanyId();

        $remain->save();

        return new JsonResponse(['remain' => RemainResource::make($remain)]);
    }

    public function remove(int $id): JsonResponse
    {
        $user = $this->getUser();
        $remain = $this->remains->find($id);

        if ($remain && $remain->company_id === $user->getCompanyId()) {
            $remain->delete();
        }

        return $this->success();
    }
}
