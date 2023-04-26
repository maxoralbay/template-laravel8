<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = $request->has('deleted') 
            ? User::with('role')->onlyTrashed() 
            : User::with('role');

        return view('pages.users.index', [
            'users' => $users->paginate(self::PER_PAGE),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.users.create', [
            'roles' => Role::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        if (User::create($request->validated())) {
            $request->session()->flash('msg_success', 'Entrée créée avec succès');
        } else {
            $request->session()->flash('msg_error', 'Erreur! Merci d\'essayer plus tard.');
        }

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user =  User::with(['role', 'challengeLogs'])->findOrFail($id);

        return view('pages.users.show', [
            'user' => $user,
            'challengeLogs' => $user->challengeLogs()->with(['challenge', 'challenge.category'])->paginate(self::PER_PAGE)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('pages.users.edit', [
            'user' => User::with('role')->findOrFail($id),
            'roles' => Role::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $user = User::findOrFail($id);

        if ($user->update($request->validated())) {
            $request->session()->flash('msg_success', 'Enregistrement mis à jour avec succès');
        } else {
            $request->session()->flash('msg_error', 'Erreur! Réessayer plus tard');
        }

        return redirect()->route('users.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request, $id)
    {
        if (!$user = User::withTrashed()->where('id', $id)->first()) {
            abort(404, 'User not found!');
        }

        if ($user->restore()) {
            $request->session()->flash('msg_success', 'Enregistrement restauré avec succès !');
        } else {
            $request->session()->flash('msg_error', 'Erreur! Réessayer plus tard');
        }


        return redirect()->route('users.index', ['deleted' => 1]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if ($user->delete()) {
            $request->session()->flash('msg_success', 'Message supprimé avec succès !');
        } else {
            $request->session()->flash('msg_error', 'Erreur! Réessayer plus tard');
        }


        return redirect()->route('users.index');
    }
}
