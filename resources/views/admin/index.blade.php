@extends('layouts.app')
@section('content')
<h1>admins</h1>
<a href="{{ route('admin.edit') }}">create</a>
<a href="{{ route('admin.create') }}">edit</a>
@endsection