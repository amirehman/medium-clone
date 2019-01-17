<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Thumbnail;
use App\Article;
use App\Tag;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        //Seed Users table with 50 entries 
        factory(User::class, 10)->create();

        //Seed Articles table with 50 entries 
        factory(Article::class, 10)->create();

        //Seed Tags table with 15 entries 
        factory(Tag::class, 10)->create();

        //Seed Images table with 50 entries 
        factory(Thumbnail::class, 10)->create();

        //Get array of ids of Users and Tags
        $articleIds = DB::table('articles')->pluck('id')->all();
        $tagsIds = DB::table('tags')->pluck('id')->all();


        //Seed article_tag table with 50 entries
        foreach ((range(1, 10)) as $index) {
            DB::table('article_tag')->insert(
                [
                'article_id' => $articleIds[array_rand($articleIds)],
                'tag_id' => $tagsIds[array_rand($tagsIds)]
                ]
            );
        }        

    }
}

