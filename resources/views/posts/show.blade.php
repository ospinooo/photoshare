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
        height: 500px;
        width: auto;
      }
    </style>

    <a href="/posts" class="btn btn-default">Go Back</a>
    <h1>{{$post->title}}
      @if (True)
        <button id="like" value="True" onclick="changeLike()"class="btn"><i class="far fa-heart fa-2x"></i></button>
      @else
        <button id="like" value="False" class="btn"><i class="fas fa-heart fa-2x"></i></button>
      @endif
    </h1>

    <script>
      var like_button = document.getElementById('like');
      function changeLike() {
          if (like_button.value == "True") {
            like_button.value = "False";
            like_button.innerHTML = '<i class="fas fa-heart fa-2x"></i>';
          } else {
            like_button.value = "True";
            like_button.innerHTML = '<i class="far fa-heart fa-2x"></i>';
          }
      }

    </script>

    <div>
        {{$post->body}}
    </div>

    @if (count($post->getMedia('document')) > 0)
      <hr>
      <div class="feature">
        <img id="0" class="featured-item" src="{{$post->getMedia('document')[0]->getUrl('medium')}}"></img>
      </div>
      <!--Carousel Wrapper-->
      <div id="multi-item-example" class="carousel slide carousel-multi-item carousel-multi-item-2" data-ride="carousel" align="center">
        @if (count($post->getMedia('document')) > 4)
          <!--Controls-->
          <div class="controls-top">
            <a class="black-text text-center" href="#multi-item-example" data-slide="prev"><i class="fas fa-angle-left fa-3x pr-3">></i></a>
            <a class="black-text text-center" href="#multi-item-example" data-slide="next"><i class="fas fa-angle-right fa-3x pl-3"><</i></a>
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
                <img class="img-fluid" id="{{$i}}" src="{{$post->getMedia('document')[$i]->getUrl('small')}}"
                alt="Card image cap" width="100%" height="50%">
              </div>
            </div>
            @if ((($i + 1) % 4 == 0) && (($i+1) < count($post->getMedia('document'))))
              </div>
              <div class="carousel-item">
            @endif
          @endfor
          </div>
          <!--First slide-->
          {{-- <div class="carousel-item active">

            <div class="col-md-3 mb-3">
              <div class="card">
                <img class="img-fluid" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(38).jpg"
                  alt="Card image cap">
              </div>
            </div>

            <div class="col-md-3 mb-3">
              <div class="card">
                <img class="img-fluid" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(19).jpg"
                  alt="Card image cap">
              </div>
            </div>

            <div class="col-md-3 mb-3">
              <div class="card">
                <img class="img-fluid" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(42).jpg"
                  alt="Card image cap">
              </div>
            </div>

            <div class="col-md-3 mb-3">
              <div class="card">
                <img class="img-fluid" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(8).jpg"
                  alt="Card image cap">
              </div>
            </div>

          </div>
          <!--/.First slide--> --}}

          <!--Second slide-->
          {{-- <div class="carousel-item">

            <div class="col-md-3 mb-3">
              <div class="card">
                <img class="img-fluid" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(53).jpg"
                  alt="Card image cap">
              </div>
            </div>

            <div class="col-md-3 mb-3">
              <div class="card">
                <img class="img-fluid" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(25).jpg"
                  alt="Card image cap">
              </div>
            </div>

            <div class="col-md-3 mb-3">
              <div class="card">
                <img class="img-fluid" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(47).jpg"
                  alt="Card image cap">
              </div>
            </div>

            <div class="col-md-3 mb-3">
              <div class="card">
                <img class="img-fluid" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(26).jpg"
                  alt="Card image cap">
              </div>
            </div>

          </div> --}}
          <!--/.Second slide-->

          <!--Third slide-->
          {{-- <div class="carousel-item">

            <div class="col-md-3 mb-3">
              <div class="card">
                <img class="img-fluid" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(64).jpg"
                  alt="Card image cap">
              </div>
            </div>

            <div class="col-md-3 mb-3">
              <div class="card">
                <img class="img-fluid" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(51).jpg"
                  alt="Card image cap">
              </div>
            </div>

            <div class="col-md-3 mb-3">
              <div class="card">
                <img class="img-fluid" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(59).jpg"
                  alt="Card image cap">
              </div>
            </div>

            <div class="col-md-3 mb-3">
              <div class="card">
                <img class="img-fluid" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(63).jpg"
                  alt="Card image cap">
              </div>
            </div>

          </div> --}}
          <!--/.Third slide-->

        </div>
        <!--/.Slides-->
        <!--/.Carousel Wrapper-->
      </div>
    @endif
    <hr>
    <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
    <a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a>
    {{Form::open(['action' => ['PostsController@destroy', $post], 'method' => 'POST', 'class' => 'pull-right'])}}
        {{Form::hidden('_method', 'DELETE')}}
        {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
    {{Form::close()}}

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
        max-width: 700px;
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
            <div class="col-sm-3"><div class="arrow arrow-left text-center"><<</div></div>
            <div class="col-sm-6"><img class="modal-content" id="img01"></div>
            <div class="col-sm-3"><div class="arrow arrow-right text-center">>></div></div>
          </div>
        <!-- Modal Content (The Image) -->


        <!-- Modal Caption (Image Text) -->
        <div id="caption"></div>
      </div>

    <script>
      // Post data
      var post = {!! json_encode($post); !!};

      var galleryItems = document.querySelectorAll('.img-fluid');
      var featured = document.querySelector('.featured-item');
      var domain = '{{ config("app.url") }}';

      // Get the modal
      var modal = document.getElementById('myModal');

      // Get the image and insert it inside the modal - use its "alt" text as a caption
      var modalImg = document.getElementById("img01");
      var captionText = document.getElementById("caption");


      var arrow_left = document.querySelector('.arrow-left');
      var arrow_right = document.querySelector('.arrow-right');

      arrow_left.onclick = function () {
        var id;
        if (featured.id == 0) {
          id = galleryItems.length-1;
        } else {
          id = (parseInt(featured.id) - 1) % galleryItems.length;
        }
        featured.id = parseInt(id);
        const media = post.media[id];
        modalImg.src = domain + '/storage/'+ media.id + '/conversions/'+ media.name.split(' ').join('-') + '-big.jpg';
      }

      arrow_right.onclick = function () {
        var id;
        if (featured.id === galleryItems.length - 1) {
          id = 0;
        } else {
          id = (parseInt(featured.id) + 1) % galleryItems.length;
        }
        featured.id = parseInt(id);
        const media = post.media[id];
        modalImg.src = domain + '/storage/'+ media.id + '/conversions/'+ media.name.split(' ').join('-') + '-big.jpg';
      }


      featured.onclick = function(){
        modal.style.display = "block";
        const media = post.media[this.id];
        modalImg.src = domain + '/storage/'+ media.id + '/conversions/'+ media.name.split(' ').join('-') + '-big.jpg';
        captionText.innerHTML = this.alt;
      }



      // Get the <span> element that closes the modal
      var span = document.getElementsByClassName("close")[0];

      // When the user clicks on <span> (x), close the modal
      span.onclick = function() {
        modal.style.display = "none";
      }

      function selectItem(e) {
        const id = e.target.id;
        const media = post.media[id];
        featured.id = id
        featured.src = domain + '/storage/'+ media.id + '/conversions/'+ media.name.split(' ').join('-') + '-medium.jpg';
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
