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

                @foreach($project->tasks as $tasks)
                    <div class="card mb-3">{{$tasks->body}}</div>
                @endforeach
                {{--<div class="card mb-3">Lorem ipsum.</div>
                <div class="card mb-3">Lorem ipsum.</div>
                <div class="card mb-3">Lorem ipsum.</div>--}}
            </div>

            <h2 class="text-gray text-lg font-normal mb-3">General notes</h2>

            <textarea class="card w-full" style="min-height: 200px">Lorem ipsum.</textarea>
        </div>
        <div class="lg:w-1/4 px-3">
            @include('projects.card')
        </div>
    </div>
</main>
@endsection
