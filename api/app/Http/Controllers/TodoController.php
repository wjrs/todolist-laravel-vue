<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoStoreRequest;
use App\Http\Requests\TodoTaskStoreRequest;
use App\Http\Resources\TodoResource;
use App\Http\Resources\TodoTaskResource;
use App\Models\Todo;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TodoController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return TodoResource::collection(auth()->user()->todos);
    }

    /**
     * @param Todo $todo
     * @return TodoResource
     */
    public function show(Todo $todo)
    {
        $todo->load('tasks');
        return new TodoResource($todo);
    }

    /**
     * @param TodoStoreRequest $request
     * @return TodoResource
     */
    public function store(TodoStoreRequest $request)
    {
        $data = $request->validated();

        $todo = auth()->user()->todos()->create($data);

        return new TodoResource($todo);
    }

    /**
     * @param Todo $todo
     * @param TodoStoreRequest $request
     * @return TodoResource
     */
    public function update(Todo $todo, TodoStoreRequest $request)
    {
        $data = $request->validated();

        $todo->fill($data);
        $todo->save();

        return new TodoResource($todo->fresh());
    }

    /**
     * @param Todo $todo
     * @return void
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();
    }

    /**
     * @param Todo $todo
     * @param TodoTaskStoreRequest $request
     * @return TodoTaskResource
     */
    public function addTask(Todo $todo, TodoTaskStoreRequest $request)
    {
        $data = $request->validated();
        $todoTask = $todo->tasks()->create($data);

        return new TodoTaskResource($todoTask);
    }
}
