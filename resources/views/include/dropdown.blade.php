
@if (count($categories) > 0)
    @foreach ($categories as $category)
        <a class="dropdown-item" href="/category/{{$category->id}}">{{$category->name}}</a>
    @endforeach
@else
    <a class="dropdown-item">Not found</a>
@endif

