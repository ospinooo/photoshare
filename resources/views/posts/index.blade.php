@extends('layouts.app')

@section('content')
    <h1>Posts</h1>
    @if (count($posts) > 0)
        <ul class="list-group">
        @foreach ($posts as $post)
          <li class="list-group-item">
            <div class="well text-center">
                <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                <h6>Likes {{$post->likes}}</h6>
                @if (count($post->getMedia('document')) > 0)
                  <img class="rounded mx-auto" src='{{$post->getMedia('document')[0]->getUrl()}}' width="20%" height="20%">
                @endif

                {{-- @foreach ($post->getMedia('document') as $media)
                    <img class="rounded mx-auto" src='{{$media->getUrl()}}' width="20%" height="20%">
                @endforeach --}}
            </div>
            <div class="text-center">Posted by {{$post->user->name}}</div>
          </li>
        @endforeach
        {{$posts->links()}}
    @else
        <p>No Posts Found</p>
    @endif
@endsection
