<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Http\Resources\System\EntityDeletedSuccessfullyResource;
use App\Http\Resources\System\EntityNotFoundResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\User;
use App\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return UserResource
     */
    public function index()
    {
        return UserResource::collection(
            User::with('role')->paginate(20)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserCreateRequest  $request
     * @return UserResource
     */
    public function create(UserCreateRequest $request)
    {
        return new UserResource(
            User::create($request->validated())
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResource
     */
    public function show($id)
    {
        if (!$user = User::with('role')->find($id)) {
            return new EntityNotFoundResource(null);
        }

        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserUpdateRequest  $request
     * @param  int  $id
     * @return JsonResource
     */
    public function update(UserUpdateRequest $request, $id)
    {
        if (!$user = User::find($id)) {
            return new EntityNotFoundResource(null);
        }

        $user->update($request->validated());

        return new UserResource(
            User::with('role')->find($id)
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return EntityDeletedSuccessfullyResource
     */
    public function destroy($id)
    {
        if (!$user = User::find($id)) {
            return new EntityNotFoundResource(null);
        }

        $user->delete();

        return new EntityDeletedSuccessfullyResource(null);
    }
}
