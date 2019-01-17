<?php

namespace App\Http\Resources;
use App\Http\Resources\UserResource;

use Illuminate\Http\Resources\Json\JsonResource;

class GuestArticlesListRecource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {   
        $body = substr($this->body, 0, 45);


        $word = str_word_count(strip_tags($this->body));
        $m = floor($word / 100);
        $est = $m . ' minute' . ($m == 1 ? '' : 's');
        
        

        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'body' =>$body,
            'author' => new UserResource($this->user),
            'read' => $est,
            'tags' => $this->tags,
            'thumbnail' => $this->thumbnail(),
            'date' => date('M d', strtotime($this->created_at)),

        ];
    }
}
