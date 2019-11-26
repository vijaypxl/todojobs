<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;

class TodosController extends Controller
{
    /**
     * Return todos list
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $todos = Todo::latest()->pluck('title');
        return response()->json(['status' => 'success', 'todos' => $todos]);
    }
    /**
     * Save new todo
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => "required|string|min:3|max:130|alpha_dash"
        ]);
        $todo = new Todo;
        $todo->title = $request->title;
        $todo->save();
        return response()->json(['status' => 'success']);
    }
}
