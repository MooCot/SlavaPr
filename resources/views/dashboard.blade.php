@extends('layouts.app')
@section('content')
<h1>dash</h1>
<a href="{{ route('user.create') }}">create</a>
<a href="{{ route('user.edit') }}">edit</a>
@endsection