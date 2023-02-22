<?php

namespace App\Http\Controllers;

use App\Models\ToDoList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ToDoListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $user = Auth::user();
        
        $todolist = ToDoList::where('user_id', $user->id)->get();

        $response = [
            'To do lists' => $todolist
        ];

        return response($response, 200);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $user = Auth::user();
        
        $request->validate([
            'title' => 'required|string',
            'todo' => 'required|string',
        ]);

        $todo = ToDoList::create([
            'user_id' => $user->id,
            'title' => $request['title'],
            'todo' => $request['todo'],
        ]);

        $response = [
            'To do successfully added'
        ];

        return response($response, 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $todo = ToDoList::find($id);

        $response = [
            'To do' => $todo
        ];

        return response($response, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'title' => 'required|string',
            'todo' => 'required|string'
        ]);

        $todo = ToDoList::find($id);

        $todo->update([
            'title' => $request['title'],
            'todo' => $request['todo']
        ]);

        $response = [
            'To do successfully updated'
        ];

        return response($response, 201);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $user = Auth::user();
        
        $todo = ToDoList::find($id);

        if($todo->user_id != $user->id) {

            return response(['Restricted'], 404);

        }

        $todo->delete();

        $response = [
            'To do successfully deleted'
        ];

        return response($response, 202);

    }
}
