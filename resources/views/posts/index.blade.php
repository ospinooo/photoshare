@extends('layouts.app')

@section('content')
    <h1>Posts</h1>
    @if (count($posts) > 0)
        @foreach ($posts as $post)
            <div class="well">
                <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
                @foreach ($post->getMedia('document') as $media)
                <div>
                    <img src='./storage/{{$post->id}}/{{$media->file_name}}' width="400px" height="400px">
                </div>
                @endforeach
            </div>
        @endforeach
        {{$posts->links()}}
    @else
        <p>No Posts Found</p>
    @endif
@endsection