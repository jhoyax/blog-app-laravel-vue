<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
            ],
            'parent_id' => $this->parent_id,
            'content' => $this->content,
            'date' => $this->created_at->format('Y-m-d H:i:s'),
            'timestamp' => $this->created_at->timestamp,
            'comments' => $this->childrenComments,
        ];
    }
}
