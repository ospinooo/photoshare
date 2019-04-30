@extends('layouts.app')
@section('content')
    <h1>Top 10 posts</h1>
    <h4>These are the most liked posts in Photoshare</h4>
    @if (count($posts) > 0)
        <ul class="list-group">
        @foreach ($posts as $post)
            <li class="list-group-item">
                <div class="well text-center">
                    <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                    @foreach ($post->getMedia('document') as $media)
                    {{-- <div> --}}
                        <img class="rounded mx-auto" src='{{$media->getUrl()}}' width="20%" height="20%">
                    {{-- </div> --}}
                    @endforeach                                     
                </div>
                <div class="text-center">Posted by {{$post->user->name}}</div>
            </li>
        @endforeach
        {{$posts->links()}}
    @else
        <p>No Posts Found</p>
    @endif
@endsection