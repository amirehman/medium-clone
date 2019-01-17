<?php

namespace Tests\Feature;

use App\Article;
use App\Thumbnail;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Session;

class ThumbnailsTest extends TestCase
{

    // use RefreshDatabase;

    /** @test */
    public function a_user_can_add_multi_thumbnails_with_article()
    {
        Session::start();

        // $this->withExceptionHandling();

        $this->actingAs(factory('App\User')->create());
        $article = factory('App\Article')->create();
   
        $credentials = array(
            'blur' => "dummy name",
            'small' => "dummy name",
            'medium' => "dummy name",
            'large' => "dummy name",
            'article_id' => $article->id,
            'article_type' => 'post',
            '_token' => csrf_token()
        );
        
        $this->call('post', '/manage/articles/1/thumbnails', $credentials)
        ->assertJson([
            'message' => 'Thumbnail submitted!',
        ]);



    }


    
}
