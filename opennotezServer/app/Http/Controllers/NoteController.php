<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Note;
use App\User;

class NoteController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function create(Request $request)
  {
    //validate incoming request 
    $this->validate($request, [
      'title' => 'required|string',
      'body' => 'required|string',
    ]);

    $user = Auth::user();
    try {

      $note = new Note;
      $note->title = $request->input('title');
      $note->body = $request->input('body');
      $note->user_id = $user->id;

      $note->save();

      //return successful response
      return response()->json(['note' => $note, 'message' => 'CREATED'], 201);

    } catch (\Exception $e) {
      //return error message
      error_log($e);
      return response()->json(['message' => 'Note creation failed!'], 409);
    }

  }


  //
}
