<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'created_at' => Carbon::parse($this->resource->created_at)->format('d.m.Y h:m:s'),
            'sum' => $this->resource->sum,
            'user' => new UserResource($this->resource->user),
        ];

    }
}
