<?php

namespace App\Http\Resources;
use App\Http\Resources\ImagesRecource;
use App\Http\Resources\TagsRecource;

use Illuminate\Http\Resources\Json\JsonResource;

class SingeArticleRecource extends JsonResource
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
            'title' => $this->title,
            'body' => $this->body,
            'status' => $this->status,
            'thumbnails' => $this->images,
            'tags' => TagsRecource::collection($this->tags)
        ];
    }
}
