
@extends('admin.layouts.app')
@section('content')

<style>

i  {
  color: #212529;
  background-color: white;
}

</style>
<div class="row">
    <div class="col-sm-2"><h1>{{$title}}</h1></div>
    <div class="col-sm-8"></div>
    <div class="col-sm-2">
      <h1>
      @if (count($models) > 0)
        <a href='/admin/{{ $table }}/pdf'><i class="fas fa-file-pdf"></i></a>
        <a href='/admin/{{ $table }}/json'><i class="fas fa-file-code"></i></a>
        <a href='/admin/{{ $table }}/csv'><i class="fas fa-file-csv"></i></a>
      @endif
      {{-- <a href='/admin/{{ $table }}/import_csv'><i class="fas fa-file-import"></i></a> --}}
    </h1>
    </div>
  </div>


@if ($table != 'users')
  <form action="{{ route('admin.'.$table.'.import_csv') }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="file" name="file" />
    <input type="submit" value=" Submit " />
  </form>
@endif
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
          <a class="btn btn-primary blue-stripe" href='{{config('app.url')}}/admin/{{$table}}/{{$model->id}}/edit'>Edit</a>
        </td>

        <td>
          {{Form::open(['action' => [$modelController . "@destroyAdmin" . $table, $model], 'method' => 'POST', 'class' => 'pull-right'])}}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
          {{Form::close()}}
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
{{$models->links()}}
@endsection
