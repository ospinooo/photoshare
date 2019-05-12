@extends('layouts.app')

@section('content')
    <h1>{{$user->name}}</h1>
    @if (count($posts) > 0)
        <ul class="list-group">
        @foreach ($posts as $post)
            <li class="list-group-item">
                <div class="well">
                    <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a><h5>Likes : {{$post->likes}}</h5></h3>
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
        <p>No Posts</p>
    @endif
@endsection
