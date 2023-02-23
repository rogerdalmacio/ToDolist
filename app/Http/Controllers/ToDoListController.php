<?php

namespace App\Http\Controllers;

use App\Models\ToDoList;
use App\Services\ToDoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ToDoListController extends Controller
{

    protected $toDoService;

    public function __construct(ToDoService $toDoService)
    {
        $this->toDoService = $toDoService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $user = Auth::user();
        
        $todolist = $this->toDoService->getToDos($user->id);

        $response = [
            'To do' => $todolist
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

        $todo = $this->toDoService->addToDo($user->id, $request['title'], $request['todo']);

        if(!$todo) {

            $response = [
                'Error'
            ];

            return response($response, 404);

        }

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
        $todo = $this->toDoService->showTodo($id);

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

        $todo = $this->toDoService->updateTodo($id, $request['title'], $request['todo']);

        if(!$todo) {

            $response = [
                'Error'
            ];

            return response($response, 404);

        }

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
        
        $todo = $this->toDoService->deleteTodo($id, $user->id);

        if(!$todo) {

            return response(['Restricted'], 404);

        }

        $response = [
            'To do successfully deleted'
        ];

        return response($response, 202);

    }
}
