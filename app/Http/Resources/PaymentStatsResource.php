<?php

namespace App\Http\Resources;

use App\Models\Operation;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @property Payment $resource */
class PaymentStatsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->resource->id,
            'createdAt'     => $this->resource->created_at->format('d.m.Y'),
            'type'          => Operation::getOperationName(Operation::TYPE_POSITIVE),
            'amount'        => $this->resource->rent + $this->resource->buyout,
            'operationName' => 'Оплата аренды + выкупа',
            'activeName'    => $this->resource->deal->active->getName(),
            'branchName'    => $this->resource->deal->branch->getName(),
            'clientName'    => $this->resource->deal->client->getFullname(),
            'timestamp'     => $this->resource->created_at->format('U'),
            'kind'          => 'payment'
        ];
    }
}
