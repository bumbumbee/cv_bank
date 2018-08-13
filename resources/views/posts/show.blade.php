@extends('layouts.app')

@section('content')
    <div class="container show">
        <button><a href="/cv_task/public">Back</a></button>
        <h2>{{$post->name}}</h2>
        <ul>
            <li><a target="_blank" href="storage/uploads/{{$post->cv}}">Read the resume</a></li>
            <li class="group">
            <div>Created: {{$post->created_at}}</div>
            <button><a href="/cv_task/public/{{$post->id}}/edit" class="btn">Edit</a></button>
            </li>

        </ul>
    </div>
@endsection