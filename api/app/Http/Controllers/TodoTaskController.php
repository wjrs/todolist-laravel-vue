<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoTaskUpdateRequest;
use App\Http\Resources\TodoTaskResource;
use App\Models\TodoTask;

class TodoTaskController extends Controller
{
    /**
     * @param TodoTask $todoTask
     * @param TodoTaskUpdateRequest $request
     * @return TodoTaskResource
     */
    public function update(TodoTask $todoTask, TodoTaskUpdateRequest $request)
    {
        $this->authorize('update', $todoTask);

        $data = $request->validated();

        $todoTask->fill($data);
        $todoTask->save();

        return new TodoTaskResource($todoTask);
    }

    /**
     * @param TodoTask $todoTask
     * @return void
     */
    public function destroy(TodoTask $todoTask)
    {
        $this->authorize('update', $todoTask);

        $todoTask->delete();
    }
}
