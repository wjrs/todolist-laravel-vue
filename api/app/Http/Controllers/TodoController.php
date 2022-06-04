<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoStoreRequest;
use App\Http\Resources\TodoResource;
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

    public function destroy(Todo $todo)
    {
        $todo->delete();
    }
}
