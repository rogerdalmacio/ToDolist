<?php

namespace App\Services;

use App\Models\ToDoList;

class ToDoService {


    public function getToDos(int $user_id) {

        return ToDoList::where('user_id', $user_id)->get();

    }

    public function addToDo(int $user_id, string $title, string $todo) {

        return ToDoList::create([
            'user_id' => $user_id,
            'title' => $title,
            'todo' => $todo
        ]);

    }

    public function showTodo(int $todo_id) {

        return ToDoList::find($todo_id);

    }

    public function updateTodo(int $todo_id, string $title, string $todo) {

        $todolist = ToDoList::find($todo_id);

        if(!$todolist) {

            return false;

        }

        return $todolist->update([
            'title' => $title,
            'todo' => $todo
        ]);

    }

    public function deleteTodo(int $todo_id, int $user_id) {

        $todo = ToDoList::find($todo_id);

        if($todo->user_id != $user_id) {

            return false;

        }

        return $todo->delete();

    }


}