{{--
    Categories = 0
    Users = 1
    Posts = 2
--}}
@if (count($items[0]) > 0 || (count($items[1]) > 0) || (count($items[2]) > 0))

    @if (count($items[1]) > 0)
        @foreach ($items[1] as $user)
            <a class="dropdown-item" href="/user/{{$user->id}}">
                <i class="fas fa-user"></i>
                {{$user->name}}
            </a>
        @endforeach
    @else
        <a class="dropdown-item">No users found <i class="far fa-frown"></i></a>
    @endif

    <div class="dropdown-divider"></div>

    @if (count($items[2]) > 0)
        @foreach ($items[2] as $post)
            <a class="dropdown-item" href="/posts/{{$post->id}}">
                <i class="fas fa-images"></i>
                {{$post->title}}
            </a>
        @endforeach
    @else
        <a class="dropdown-item">No posts found <i class="far fa-frown"></i></a>
    @endif

    <div class="dropdown-divider"></div>

    @if (count($items[0]) > 0)
        @foreach ($items[0] as $category)
            <a class="dropdown-item" href="/categories/{{$category->id}}">
                <i class="fas fa-layer-group"></i>
                {{$category->name}}
            </a>
        @endforeach
    @else
        <a class="dropdown-item">No categories found <i class="far fa-frown"></i></a>
    @endif

@else
    <a class="dropdown-item">Nothing found <i class="far fa-frown"></i></a>
@endif

