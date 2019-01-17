<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\UserResource;

class Article extends Model
{
    protected $guarded = ['user_id','title', 'body'];

    
    public function tags () {
        return $this->belongsToMany(Tag::class);
    }
    
    public function user () {
        return $this->belongsTo(User::class);
    }
    
    public function images () {
        return $this->hasMany(Thumbnail::class);
    }

    
    public function thumbnail () {
        
        return $this->images->first();
    }

    public function readtime () {
        $word = str_word_count(strip_tags($this->body));
        $m = floor($word / 100);
        return $est = $m . ' minute' . ($m == 1 ? '' : 's');
    }




    
}
