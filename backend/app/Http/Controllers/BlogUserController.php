<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogUser;
class BlogUserController extends Controller
{
    //
    public function index(){
        $users = BlogUser::all();
        return $users;
    }
}
