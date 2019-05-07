
@extends('admin.layouts.app')
@section('content')

<style>

i  {
  color: gray;
  background-color: white;
}

</style>
<div class="row">
    <div class="col-sm-3"><h1>{{$title}}</h1></div>
    <div class="col-sm-6"></div>
    <div class="col-sm-3">
      <h1><a href='/admin/{{ $models[0]->getTable() }}/pdf'><i class="fas fa-file-pdf"></i></a>
      <a href='/admin/{{ $models[0]->getTable() }}/json'><i class="fas fa-file-code"></i></a>
      <a href='/admin/{{ $models[0]->getTable() }}/csv'><i class="fas fa-file-csv"></i></a></h1>
    </div>
  </div>

{{-- <a href='/{{ $models[0]->getTable() }}/pdf'><i class="fas fa-file-pdf"></i></a> --}}

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
