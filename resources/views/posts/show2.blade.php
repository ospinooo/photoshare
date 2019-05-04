@extends('layouts.app')

@section('content')
    
  <style>

  </style>

  <div>
    @if (count($post->getMedia('document')) > 0)  
      <div id="carousel" class="carousel slide"  data-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="{{$post->getMedia('document')[0]->getUrl('small')}}" alt="Image">
            </div>
            @for ($i = 1; $i < count($post->getMedia('document')); $i++)
              <div class="carousel-item">
                  <img class="d-block w-100" src="{{$post->getMedia('document')[$i]->getUrl('small')}}" alt="Image">
              </div>
            @endfor
          </div>
          <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
    @endif
  </div>
    

    <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
@endsection