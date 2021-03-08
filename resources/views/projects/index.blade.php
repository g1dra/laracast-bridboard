@extends('layouts.app')
@section('content')
    <header class="flex items-end mb-3 py-4 justify-between">
        <h2 class="text-gray text-sm font-normal">My projects</h2>
        <a href="/projects/create" class="button">Create new project</a>
    </header>

    <div class="lg:flex lg:flex-wrap -mx-3">
        @forelse($projects as $project)
            <div class="w-1/3 px-3 pb-6">
                @include('projects.card')
            </div>
        @empty
            <div> No projects</div>
        @endforelse
    </div>
@endsection
