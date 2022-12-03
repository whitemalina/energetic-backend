<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $user = Auth::user();

        return $this->handleResponse(PostResource::collection(Post::all()), 'Объекты получены успешно');

    }


    public function byProject($id)
    {
        $user = Auth::user();


        if ($user->is_admin) {
            return $this->handleResponse(PostResource::collection(Post::all()), 'Объекты получены успешно');
        }
        return $this->handleResponse(Project::find($id)->objects, 'Объекты получены успешно');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $user = Auth::user();
        if (!$user->is_admin) {
            return $this->handleError('Unauthenticated', '401', '401');
        }
        $validated = $request->validated();


        $file = $request->file('photo');


        $photo_url = null;
        if ($file) {
            $upload_folder = 'public/photo';
            $filename = uniqid() . '.' . $file->getClientOriginalName();
            Storage::putFileAs($upload_folder, $file, $filename);
            $photo_url = 'storage/photo/' . $filename;
        }

        $file2 = $request->file('scheme');

        $scheme_url = null;
        if ($file2) {
            $upload_folder = 'public/scheme';
            $filename = uniqid() . '.' . $file2->getClientOriginalName();
            Storage::putFileAs($upload_folder, $file2, $filename);
            $scheme_url = 'storage/scheme/' . $filename;
        }


        return $this->handleResponse(Post::create([
            'name' => $request->name,
            'description' => $this->formatString($request->description),
            'photo_url' => $photo_url,
            'scheme_url' => $scheme_url,
            'risks' => $this->formatString($request->risks),
            'security' => $this->formatString($request->security),
            'geotag' => $request->geotag,
            'project_id' => $request->project_id,
        ]), 'Объект добавлен', 200);

    }

    public function formatString($str)
    {
        $str = str_replace(array("\n"), ' ', $str);
        $str = str_replace(array(' ', ' ', ' '), "\n", $str);

        return trim($str, "\n");
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);

        if ($post) {
            return $this->handleResponse(PostResource::make($post), 'Объект получен успешно');
        }
        return $this->handleError('Объект не существует', '404', 404);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
