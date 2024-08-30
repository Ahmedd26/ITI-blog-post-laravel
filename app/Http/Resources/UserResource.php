<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Str;
class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = parent::toArray($request);
        if (Str::startsWith($this->image, 'http')) {
            $data['image'] = $this->image;
        } else {
            $data['image'] = asset("images/posts/$this->image");
        }
        unset($data['created_at']);
        unset($data['updated_at']);
        unset($data['email_verified_at']);
        return $data;
    }
}
