@extends('layouts.app')

@section('content')
    <h1>Edit User</h1>

    {!! Form::open(['action' => ['UsersController@update', $user], 'method'=> 'PUT', 'autocomplete'=> 'off']) !!}
        <div class="form-group">
            {{Form::label('name', 'Name')}}
            {{Form::text('name', $user->name, ['class' => 'form-control', 'placeholder' => 'Name'])}}
        </div>

        <div class="form-group">
          {{Form::label('admin', 'Admin')}}
          {{Form::checkbox('admin', (1 - $user->admin), $user->admin)}}
        </div>
        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection
