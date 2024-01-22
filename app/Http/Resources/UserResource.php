<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;
use App\Http\Resources\ProductResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'full_name' => $this->name,
            'email' => $this->email,
            'role' => $this->role->name,
            'products' => ProductResource::collection($this->products),
            'created_at' => Carbon::parse($this->created_at)->format('m-d-Y'),
            'update_at' => Carbon::parse($this->created_at)->diffForHumans(),

        ];
    }
}
