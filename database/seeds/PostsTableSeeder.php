<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Post::class, 50)->create()->each( function($u){
            for($i=0; $i< 5;$i++){
                $u->files()->save(factory(App\File::class)->make());
            }
        });
    }
}
