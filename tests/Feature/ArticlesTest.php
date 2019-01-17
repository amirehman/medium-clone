<?php

namespace Tests\Feature;

use App\User;
use App\Article;
use App\Tag;
use Tests\TestCase;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Session;


class ArticlesTest extends TestCase
{

    use RefreshDatabase;


    /** @test */
    function a_user_can_see_all_the_articles()
    {
        $this->actingAs(factory('App\User')->create());
        $this->get('/manage/articles')->assertViewIs('admin.layouts.articles.index');
    }

    /** @test */
    function a_guest_may_not_see_all_the_articles()
    {
        $this->get('/manage/articles')->assertRedirect('/login');
    }

    /** @test */
    public function a_user_can_create_article()
    {
        Session::start();

        $this->actingAs($user = factory('App\User')->create());

        $attributes = factory(\App\Article::class)->raw([
            'title' => 'Title',
            'body' => 'Body content',
            'tags' => factory(\App\Tag::class)->create()
            ]);

        $attributes['_token'] = csrf_token();

        $this->call('post', '/manage/articles', $attributes)
            ->assertJson([
                'message' => 'Article submitted!',
            ]);
    }


    /** @test */
    public function guest_may_not_create_article()
    {
        Session::start();
        $credentials = array(
            '_token' => csrf_token()
        );
        $this->call('post', '/manage/articles' ,$credentials)->assertRedirect('/login');


    }

    /** @test */
    public function a_user_can_update_article()
    {

        Session::start();

        $this->withoutExceptionHandling();

        $this->actingAs(factory(\App\User::class)->create());

        $article = factory(\App\Article::class)->create();

        $attributes = factory(\App\Article::class)->raw([
            'title' => 'Updated',
            'body' => 'Updated',
            'tags' => factory(\App\Tag::class)->create()
            ]);

        $attributes['_token'] = csrf_token();

        $response = $this->put("/manage/articles/{$article->id}", $attributes)->assertStatus(200);


    }


    /** @test */
    function a_user_can_see_the_show_page()
    {

        $this->actingAs(factory('App\User')->create());

        $article = factory(Article::class)->create();

        $response = $this->get("/manage/articles/{$article->id}");

        $response->assertStatus(302);
    }


    /** @test */
    function a_guest_may_not_see_the_show_page()
    {
        $article = factory(Article::class)->create();
        $response = $this->get("/manage/articles/{$article->id}")->assertRedirect('/login');

    }



    /** @test */
    function a_user_can_see_the_edit_page()
    {

        $this->actingAs(factory('App\User')->create());

        $article = factory(Article::class)->create();
        $response = $this->get("/manage/articles/{$article->id}/edit");
        $response->assertStatus(200);
    }



    /** @test */
    function a_guest_may_not_see_the_edit_page()
    {
        $article = factory(Article::class)->create();
        $response = $this->get("/manage/articles/{$article->id}/edit")->assertRedirect('/login');

    }

    /** @test */
    function a_user_can_delete_post()
    {   
        $this->withoutExceptionHandling();
        $this->withoutMiddleware();
        $this->actingAs(factory('App\User')->create());
        $articles = factory(Article::class)->create();
        $response = $this->call('delete', "/manage/articles/{$articles->id}", ['_token' => csrf_token()]);
        $response->assertRedirect('/articles');
    }



    
}
