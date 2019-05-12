@extends('layouts.app')

@section('content')
    <h1>Category</h1>
    @if (count($posts) > 0)
        <ul class="list-group">
        @foreach ($posts as $post)
            <li class="list-group-item">
                <div class="well">
                    <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                    <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
                    {{-- @foreach ($post->getMedia('document') as $media)
                    <div>
                        <img src='{{$media->getUrl()}}' width="400px" height="400px">
                    </div>
                    @endforeach --}}
                </div>
            </li>
        @endforeach
        {{$posts->links()}}
    @else
        <p>No Posts Found</p>
    @endif
@endsection
