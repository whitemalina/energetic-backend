<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Http\Requests\StoreOrganizationRequest;
use App\Http\Resources\PostResource;
use App\Models\Organization;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OrganizationController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();


        return $this->handleResponse($user->organizations, 'Организации получены успешно');

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrganizationRequest $request)
    {
        $user = Auth::user();
        if(!$user->is_admin){
            return $this->handleError('Unauthorized', '401', 401);
        }

        $validated = $request->validated();


        $file = $request->file('photo');


        $photo_url = null;
        if ($file) {
            $upload_folder = 'public/profile';
            $filename = uniqid() . '.' . $file->getClientOriginalName();
            Storage::putFileAs($upload_folder, $file, $filename);
            $photo_url = 'storage/profile/' . $filename;
        }
        return $this->handleResponse(Organization::create([
            'name' => $request->name,
            'photo_url' => $photo_url,
        ]), 'Объект добавлен', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function show(Organization $organization)
    {

        return $this->handleResponse(Organization::all(), 'Организации получены успешно');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function edit(Organization $organization)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Organization $organization)
    {


        return $this->handleResponse($organization->update($request), 'Организация обновлена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function destroy(Organization $organization)
    {
        //
    }
}
