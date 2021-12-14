@extends('layouts.app')
@section('content')
<h1>admins</h1>
<a href="{{ route('admin.create') }}">create</a>
<div style="overflow-x: auto;">
    <table class="table">
        <thead>
            <tr>
                <th class="text-center">ID</th>
                <th>Имя</th>
                <th>Фамилия</th>
                <th>E-mail</th>
                <th class="text-right"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($admins as $admin)
            <tr>
                <td class="text-center">{{ $admin['id'] }}</td>
                <td>{{ $admin['name'] }}</td>
                <td>{{ $admin['surname'] }}</td>
                <td>{{ $admin['email'] }}</td>
                <td class="td-actions text-right">
                    <button type="button" rel="tooltip" class="btn btn-primary btn-link">
                        <a href="{{ route('admin.edit', $admin['id']) }}">Редактировать</a>
                    </button>
                    <form action="{{ route('admin.destroy', $admin['id']) }}" method="POST" style="display: inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" rel="tooltip" class="btn btn-primary btn-link">удалить</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection