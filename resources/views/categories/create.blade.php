@extends('admin.layouts.app')

@section('content')
    <h1>Create Category</h1>
    {!! Form::open(['action' => 'CategoriesController@store', 'method'=> 'POST', 'enctype'=>'multipart/form-data', 'autocomplete'=> 'off']) !!}
        <div class="form-group">
            {{Form::label('name', 'Name')}}
            {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Name'])}}
        </div>

        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection
