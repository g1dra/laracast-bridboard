@extends('layouts.app')
@section('content')
<h2> Show Project </h2>

<ul>
    <li>{{$project->id}}</li>
    <li>{{$project->title}}</li>
    <li>{{$project->description}}</li>
    <a href="/projects">Go Back</a>
</ul>
@endsection
