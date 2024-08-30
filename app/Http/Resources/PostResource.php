<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Str;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    // public function toArray(Request $request): array
    // {
    //     $image_path = null;
    //     if (Str::startsWith($this->image, 'http')) {
    //         $image_path = $this->image;
    //     } else {
    //         $image_path = asset("images/posts/$this->image");
    //     }
    //     // return parent::toArray($request);
    //     return [
    //         "id" => $this->id,
    //         "title" => $this->title,
    //         "description" => $this->description,
    //         "created_at" => $this->created_at,
    //         "updated_at" => $this->updated_at,
    //         "image" => $image_path,
    //         "creator_name" => $this->user ? $this->user->name : null;
    //     ];
    // }
    public function toArray(Request $request): array
    {
        $data = parent::toArray($request);

        if (Str::startsWith($this->image, 'http')) {
            $data['image'] = $this->image;
        } else {
            $data['image'] = asset("images/posts/$this->image");
        }
        unset($data['creator_id']);
        // $data['creator_name'] = $this->user ? $this->user->name : null;
        $data['creator'] = new UserResource($this->user);
        return $data;
    }
}
