@extends('layouts.app')
@section('content')
<h1>Create a project</h1>

<form>
    <form method="post" action="/projects">
        @csrf
        <label for="title">Title</label>
        <input type="text" name="title" placeholder="Title">

        <label for="title">Description</label>
        <input type="text" name="description" placeholder="Description">

        <button type="submit"> Create Project</button>
        <a href="/projects"> Back</a>
    </form>
</form>
@endsection

