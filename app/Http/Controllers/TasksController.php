<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Task; 

class TasksController extends Controller
{
    /**
    //  * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   if (\Auth::check()) {
        $user = \Auth::user();
        $tasks = Task::all()->where("user_id",$user->id);

        return view('tasks.index', [
            'tasks' => $tasks,
        ]);}
        else{return view('welcome');
        }
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $task = new Task;

        return view('tasks.create', [
            'task' => $task,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *s
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request, [
            'status' => 'required|max:10',   
            'content' => 'required|max:191',
        ]);
        
        /*
        $request->user()->tasks()->create([
            'content' => $request->content,
            'status' => $request->status,
        ]);
        */
        $task = new Task;
        $task ->status = $request->status;
        $task->content = $request->content;
        $task->user_id = \Auth::user()->id;  //BY寺田//
        $task->save();
        
        return redirect('/');
        
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        if(\Auth::check()){
            $task = task::find($id);
            
         if(\Auth::user()->id == $task->user_id){

        return view('tasks.show', [
            'task' => $task,
        ]);
        
        }else{return redirect('/');
        }
        
        }else{ return redirect('welcome');
         }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $task = task::find($id);

        return view('tasks.edit', [
            'task' => $task,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $this->validate($request, [
            'status' => 'required|max:10',  
            'content' => 'required|max:191',
        ]);
        
        $task = Task::find($id);
        $task->content = $request->content;
        $task->status = $request->status;
        $task->save();
        

        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = \App\Task::find($id);

        if (\Auth::user()->id === $task->user_id) {
            $task->delete();
         }

        return redirect()->back();
    }
    
}
