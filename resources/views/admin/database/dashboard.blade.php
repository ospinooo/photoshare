
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



  <form action="{{ route('admin.'.$table.'.import_csv') }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="file" name="file" />
    <input type="submit" value=" Submit " />
  </form>

{{-- <a href='/{{ $models[0]->getTable() }}/pdf'><i class="fas fa-file-pdf"></i></a> --}}
@if (count($models) > 0)
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

            <button class="btn btn-danger" data-toggle="modal" data-target="#confirm-delete-{{$model->id}}">
                Delete
            </button>
          </td>
        </tr>

        <div class="modal fade" id="confirm-delete-{{$model->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel" style="text-align: center">Confirm Delete</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>

                    <div class="modal-body">
                        <p>You are about to delete one track, this procedure is irreversible.</p>
                        <p>Do you want to proceed?</p>
                        <p class="debug-url"></p>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        {{Form::open(['action' => [$modelController . "@destroyAdmin" . $table, $model], 'method' => 'POST', 'class' => 'pull-right'])}}
                          {{Form::hidden('_method', 'DELETE')}}
                          {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                        {{Form::close()}}
                    </div>
                </div>
            </div>
        </div>
      @endforeach
    </tbody>
  </table>
  {{$models->links()}}

@else
  <hr>
  <p> No {{ $table }} found.</p>
  <hr>
@endif


@endsection
