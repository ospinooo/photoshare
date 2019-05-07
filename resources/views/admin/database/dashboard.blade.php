
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
        <a href='/admin/{{ $models[0]->getTable() }}/pdf'><i class="fas fa-file-pdf"></i></a>
        <a href='/admin/{{ $models[0]->getTable() }}/json'><i class="fas fa-file-code"></i></a>
        <a href='/admin/{{ $models[0]->getTable() }}/csv'><i class="fas fa-file-csv"></i></a>
      @endif
      {{-- <a href='/admin/{{ $table }}/import_csv'><i class="fas fa-file-import"></i></a> --}}
    </h1>
    </div>
  </div>

  <form action="/admin/{{ $table }}/import_csv"
      class="dropzone"
      id="my-awesome-dropzone">
      <button type="submit" id="button" class="btn btn-primary">Submit</button>
  </form>
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


@section('scripts')
<script>
  var uploadedDocumentMap = {}
  Dropzone.options.documentDropzone = {
    url: '{{ route('admin.posts.import_csv') }}',
    maxFilesize: 2, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="document[]" value="' + response.name + '">')
      uploadedDocumentMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedDocumentMap[file.name]
      }
      $('form').find('input[name="document[]"][value="' + name + '"]').remove()
    },
    init: function () {
      // UPDATE
      @if(isset($post) && $post->document)
        var files =
          {!! json_encode($post->document) !!}
        for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="document[]" value="' + file.file_name + '">')
        }
      @endif
    }
  }
</script>
@stop
