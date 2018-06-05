<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class TastasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        if (\Auth::check()) {
            $user = \Auth::user();
            $tastasks = $user->tastasks()->orderBy('created_at', 'desc')->paginate(10);

            $data = [
                'user' => $user,
                'tastasks' => $tastasks,
            ];
            $data += $this->counts($user);
            return view('users.show', $data);
        }else {
            return view('welcome');
        }
    }
    
     public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required|max:191',
        ]);

        $request->user()->tastasks()->create([
            'content' => $request->content,
        ]);

        return redirect('/');
    }
    
    
     public function destroy($id)
    {
        $tastask = \App\tastask::find($id);

        if (\Auth::user()->id === $tastask->user_id) {
            $tastask->delete();
        }

        return redirect()->back();
    }
    
}