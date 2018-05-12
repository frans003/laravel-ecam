<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Note extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'course_id' => $this->course_id,
            'title' => $this->title,
            'body' => $this->body,
            'file_name' => $this->file_name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
