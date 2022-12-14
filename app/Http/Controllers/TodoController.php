<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function view(Request $request)
    {
        $data = Todo::all();
        return view('view',['data'=>$data,'message'=>'']);
    }

    public function addTodo(Request $request)
    {
        $request->validate([
            'todo' => 'required',
        ]);

        $todo = new Todo;
        $todo->todo = $request->todo;
        $todo->save();

        return redirect('/');
    }

    public function deleteTodo(Request $request)
    {
        if($request->id){
            $todo = Todo::find($request->id);
            $todo->delete();
            return redirect('/')->with(['message'=>'delete']);
        }
    }

    public function updateTodo(Request $request)
    {
        if($request->id){
            $todo = Todo::find($request->id);
            $todo->todo = $request->todo;
            $todo->save();
            return redirect('/');
        }
    }
}
