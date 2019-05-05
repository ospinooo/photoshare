
@extends('admin.layouts.app')
@section('content')


<h1>{{$title}}</h1>
<table class="table table-striped table-hover table-users">
  <thead>
    <tr>
    @foreach (array_keys($models[0]->getAttributes()) as $title)
      @if ($title != 'password')
        <th class="hidden-phone">{{$title}}</th>
      @endif
    @endforeach
    <th></th>
    <th></th>
    </tr>
  </thead>

  <tbody>
    @foreach ($models as $model)
      <tr>
        @foreach ($model->getAttributes() as $key => $value)
          @if ($key != 'password')
            <td class="hidden-phone">{{$value}}</td>
          @endif
        @endforeach

        <td>
          <a class="btn btn-primary blue-stripe" href='{{config('app.url')}}/{{$model->getTable()}}/{{$model->id}}'>Edit</a>
        </td>

        <td>
          {{Form::open(['action' => [$modelController . "@destroy", $model], 'method' => 'POST', 'class' => 'pull-right'])}}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
          {{Form::close()}}
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
@endsection
