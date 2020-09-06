<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CommentCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $user = auth()->guard('api')->user();

        return [
            'data' => CommentResource::collection($this->collection),
            'hasAuth' => $user ? true : false
        ];
    }
}
