@extends('layouts.app')

@section('content')
    <style>
      @media (min-width: 768px) {
      .carousel-multi-item-2 .col-md-3 {
        float: left;
        width: 25%;
        max-width: 100%; }
      }

      .carousel-multi-item-2 .card img {
        border-radius: 2px;
      }

      .feature>img {
        height: 400px;
        width: auto;
      }
    </style>

    <script src="{{ asset('js/like.js')}}"></script>
    <script>
      function alertNotRegistered () {
        Swal.fire({
          type: 'error',
          title: 'Oops...',
          text: 'You are not registered!',
          footer: '<a href="/register">Register</a>'
        });
      }
    </script>
    <h1>{{$post->title}}
      @if (Auth::check())
        @if ($like)
          <button id="like" value="{{$post->id . ','. Auth::user()->id}}" class="btn"><i class="fas fa-heart fa-2x"></i></button>
        @else
          <button id="like" value="{{$post->id . ','. Auth::user()->id}}" class="btn"><i class="far fa-heart fa-2x"></i></button>
        @endif
      @else
        <button id="like_not_register" onclick="alertNotRegistered()" class="btn"><i class="far fa-heart fa-2x"></i></button>
      @endif
    </h1>

    <div>
        {{$post->body}}
    </div>

    @if (count($post->getMedia('document')) > 0)
      <hr>
      <div class="feature">
        <img id="0" class="featured-item" src="{{ asset($post->getMedia('document')[0]->getUrl()) }}"></img>
      </div>
      <!--Carousel Wrapper-->
      <div id="multi-item-example" class="carousel slide carousel-multi-item carousel-multi-item-2" data-ride="carousel" align="center">
        @if (count($post->getMedia('document')) > 4)
          <!--Controls-->
          <div class="controls-top">
            <a class="black-text text-center" href="#multi-item-example" data-slide="prev"><i class="fas fa-caret-left fa-3x pl-3"></i></a>
            <a class="black-text text-center" href="#multi-item-example" data-slide="next"><i class="fas fa-caret-right fa-3x pl-3"></i></a>
          </div>
          <!--/.Controls-->
        @endif
        <!--Slides-->
        <div class="carousel-inner" role="listbox">

          <div class="carousel-item active">
          {{-- <p>{{count($post->getMedia('document'))}} </p> --}}
          @for ($i = 0; $i < count($post->getMedia('document')); $i++)
            <div class="col-md-3 mb-3">
              <div class="card">
                <img class="img-fluid" id="{{$i}}" src="{{ asset($post->getMedia('document')[$i]->getUrl()) }}"
                alt="Card image cap" width="100%" height="50%">
              </div>
            </div>
            @if ((($i + 1) % 4 == 0) && (($i+1) < count($post->getMedia('document'))))
              </div>
              <div class="carousel-item">
            @endif
          @endfor
          </div>
        </div>
        <!--/.Slides-->
        <!--/.Carousel Wrapper-->
      </div>
    @endif
    <hr>
    <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>


    @if (Auth::check())
      @if ($post->user_id == Auth::user()->id || Auth::user()->admin)
      <a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a>
        {{Form::open(['action' => ['PostsController@destroy', $post], 'method' => 'POST', 'class' => 'pull-right'])}}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
        {{Form::close()}}
      @endif
    @endif
    <style>
      /* Style the Image Used to Trigger the Modal */
      #myImg {
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
      }

      .arrow {
        color: #f1f1f1;
      }

      .arrow:hover {
        cursor: pointer;
      }

      #myImg:hover {opacity: 0.7;}

      /* The Modal (background) */
      .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 100px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
      }

      /* Modal Content (Image) */
      .modal-content {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 800px;
      }

      /* Caption of Modal Image (Image Text) - Same Width as the Image */
      #caption {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
        text-align: center;
        color: #ccc;
        padding: 10px 0;
        height: 150px;
      }

      /* Add Animation - Zoom in the Modal */
      .modal-content, #caption {
        animation-name: zoom;
        animation-duration: 0.6s;
      }

      @keyframes zoom {
        from {transform:scale(0)}
        to {transform:scale(1)}
      }

      /* The Close Button */
      .close {
        position: absolute;
        top: 15px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        transition: 0.3s;
      }

      .close:hover,
      .close:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
      }

      /* 100% Image Width on Smaller Screens */
      @media only screen and (max-width: 700px){
        .modal-content {
          width: 100%;
        }
      }
    </style>

    <div id="myModal" class="modal">

        <!-- The Close Button -->
        <span class="close">&times;</span>
        <div class="row">
            <div class="col-sm-1"><div class="arrow arrow-left text-center"><<</div></div>
            <div class="col-sm-10"><img class="modal-content" name="img01"></div>
            <div class="col-sm-1"><div class="arrow arrow-right text-center">>></div></div>
          </div>
        <!-- Modal Content (The Image) -->


        <!-- Modal Caption (Image Text) -->
        <div id="caption"></div>
      </div>
    <script>
      var like = document.getElementById('like_not_register');
      // Post data
      var post = {!! json_encode($post); !!};

      var galleryItems = document.querySelectorAll('.img-fluid');
      var featured = document.querySelector('.featured-item');
      var domain = '{{ config("medialibrary.s3.domain") }}' + '/';

      // Get the modal
      var modal = document.getElementById('myModal');

      // Get the image and insert it inside the modal - use its "alt" text as a caption
      var modalImg = document.getElementsByName("img01")[0];
      var captionText = document.getElementById("caption");


      var arrow_left = document.querySelector('.arrow-left');
      var arrow_right = document.querySelector('.arrow-right');

      arrow_left.onclick = function () {
        var id;
        if (modalImg.id == 0) {
          id = galleryItems.length-1;
        } else {
          id = (parseInt(modalImg.id) - 1) % galleryItems.length;
        }
        modalImg.id = parseInt(id);
        const media = post.media[id];
        modalImg.src = domain + media.id + '/' + media.file_name;
      }

      arrow_right.onclick = function () {
        var id;
        if (modalImg.id === galleryItems.length - 1) {
          id = 0;
        } else {
          id = (parseInt(modalImg.id) + 1) % galleryItems.length;
        }
        modalImg.id = parseInt(id);
        const media = post.media[id];
        modalImg.src = domain +  media.id + '/' + media.file_name;
      }
      console.log(post.media);

      featured.onclick = function(){
        modal.style.display = "block";
        const media = post.media[this.id];
        modalImg.id = this.id;
        modalImg.src = domain +  media.id + '/' + media.file_name;
        captionText.innerHTML = this.alt;
      }



      // Get the <span> element that closes the modal
      var span = document.getElementsByClassName("close")[0];

      // When the user clicks on <span> (x), close the modal
      span.onclick = function() {
        modal.style.display = "none";
        featured.id = featured.id
      }

      function selectItem(e) {
        const id = e.target.id;
        const media = post.media[id];
        featured.id = id
        featured.src = domain +  media.id + '/' + media.file_name;
      }

      (function init() {
        // span.addEventListener('click', spanClick);
        // featured.addEventListener('click', selectFeatureItem);
        for (var i = 0; i < galleryItems.length; i++) {
            galleryItems[i].addEventListener('click', selectItem);
        }
      })();

    </script>
@endsection
