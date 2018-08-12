@extends('layouts.app')

@section('content')
<div class="container home">
    <h2>Posts</h2>
    @if(count($posts)>0)
        @foreach($posts as $post)
            <div class="post-list-item">
                <h3><a href="/cv_task/public/{{$post->id}}">{{$post->name}}</a></h3>
                <h4>{{$post->category}}</h4>

                <div class="bottom-items">
                    <small>Created: {{$post->created_at}}</small>
                    <form action="/cv_task/public/{{$post->id}}" method="post">
                        @csrf
                        <input type="hidden" name="_method" value="delete">
                        <button type="submit">Delete</button>
                    </form>
                </div>
            </div>


        @endforeach
        {{$posts->links()}}
    @else
        <p>No posts yet</p>
    @endif
</div>
@endsection