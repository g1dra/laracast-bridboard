@extends('layouts.app')
@section('content')
    <header class="flex items-end mb-3 py-4 justify-between">
        <p class="text-gray text-sm font-normal">
            <a href="/projects">My projects </a> / {{ $project->title }}
        </p>
        <a href="/projects/create" class="text-gray text-sm font-normal button">Create new project</a>
    </header>

    <main>
        <div class="lg:flex -mx-3">
            <div class="lg:w-3/4 px-3 mb-6">
                <div class="mb-8">
                    <h2 class="text-gray text-lg font-normal mb-3">Tasks</h2>

                    @foreach($project->tasks as $task)
                        <div class="card mb-3">
                            <form method="post" action="{{ $task->path() }}">
                                @method('PATCH')
                                @csrf
                                <div class="flex items-center">
                                    <input name="body" value="{{$task->body}}"
                                           class="w-full" {{ $task->completed ? 'text-grey' : '' }}>
                                    <input type="checkbox"
                                           name="completed"
                                           onChange="this.form.submit()"
                                        {{ $task->completed ? 'checked' : '' }}>
                                </div>
                            </form>
                        </div>
                    @endforeach
                    <div class="card mb-3">
                        <form action="{{ $project->path() . '/tasks' }}" method="post">
                            @csrf
                            <input class="w-full" placeholder="Add a new task" name="body">
                        </form>
                    </div>
                </div>

                <h2 class="text-gray text-lg font-normal mb-3">General notes</h2>

                <form method="POST" action="{{ $project->path() }}">
                    @csrf
                    @method('PATCH')
                    <textarea
                        name="notes"
                        class="card w-full mb-4"
                        style="min-height: 200px"
                        placeholder="Make a note">
                    {{ $project->notes }}
                </textarea>
                    <button type="submit" class="button">Save</button>
                </form>
            </div>
            <div class="lg:w-1/4 px-3">
                @include('projects.card')
            </div>
        </div>
    </main>
@endsection
