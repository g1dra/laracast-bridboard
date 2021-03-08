@extends('layouts.app')
@section('content')
    <header class="flex items-center mb-3 py-4 justify-between">
        <h2 class="text-gray text-sm font-normal">My projects</h2>
        <a href="/projects/create" class="button">Create new project</a>
    </header>

    <div class="lg:flex lg:flex-wrap -mx-3">
        @forelse($projects as $project)
            <div class="w-1/3 px-3 pb-6 ">
                <div class="bg-white rounded-lg shadow p-2 " style="height: 200px">
                    <h3 class="font-normal text-xl py-4 mb-3 border-l-4 border-blue-300 pl-4 -ml-2">
                        <a href="{{$project->path() }}">{{ Str::limit($project->title,40) }} </a>

                    </h3>
                    <div class="text-gray-400">
                        {{Str::limit($project->description,250)}}
                    </div>
                </div>
            </div>
        @empty
            <div> No projects</div>
        @endforelse
    </div>
@endsection
