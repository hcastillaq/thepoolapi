<?php

use Illuminate\Http\Request;
use App\Post;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


$router->post('/posts/new', function (Request $request) {
    
    $input = $request->all();

    if($request->hasFile('files'))
    {
        $post = Post::create($input);
        $files = $request->file('files');
        foreach ($files as $file) {
            $path = '../public/uploads';
            $fileName = str_shuffle('abcdefghijklmnopqrstuvwxyz'.$file->getClientOriginalName());
            $fileExt = $file->getClientOriginalExtension();
            $fileName = $fileName.'.'.$fileExt;
            $file->move($path, $fileName);
            $post->files()->create(['name'=>$fileName, 'ext'=>$fileExt]);
            $post = Post::with('files')->find($post->id);
        }
        return response()->json($post);
    }

   return "hello i am test route";
});

$router->post('/posts', function(){
    $results = Post::all();
    return response()->json(compact("results"));
});
$router->post('/posts/query', function(Request $request){
    try{
        $query = $request->input('query');
        #$results = Post::where('description', 'LIKE', "%$query%")->get();
        $sql = "match(title, description) against('$query*' in boolean mode)";
        $posts = Post::whereRaw($sql)->get();
        return response()->json(compact("posts"));
    }catch(Exception $e){
        return response()->json(['error'=> 'invalid request'], 400);
    }
});