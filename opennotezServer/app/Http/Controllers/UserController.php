<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }

  public function profile()
  {
    $user = Auth::user();
    $user->notes;
    return response()->json(['user' => $user], 201);
  }

}
