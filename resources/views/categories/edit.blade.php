
@extends('admin.layouts.app')

@section('content')
    <h1>Create Category</h1>
    {!! Form::open(['action' => ['CategoriesController@update', $category], 'method'=> 'PUT', 'autocomplete'=> 'off']) !!}
        <div class="form-group">
            {{Form::label('name', 'Name')}}
            {{Form::text('name', $category->name, ['class' => 'form-control', 'placeholder' => 'Name'])}}
        </div>
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection
