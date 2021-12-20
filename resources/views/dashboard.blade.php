@extends('layouts.app')
@section('content')
<h1>dash</h1>
<a href="{{ route('user.create') }}">create</a>
<div style="overflow-x: auto;">
    <table class="table">
        <thead>
            <tr>
                <th class="text-center">ID</th>
                <th>Имя</th>
                <th>Фамилия</th>
                <th>Должность</th>
                <th>E-mail</th>
                <th>Телефон</th>
                <th class="text-right"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td class="text-center">{{ $user['id'] }}</td>
                <td>{{ $user['name'] }}</td>
                <td>{{ $user['surname'] }}</td>
                <td>{{ $user->role['role_name'] }}</td>
                <td>{{ $user['email'] }}</td>
                <td>{{ $user['phone_number'] }}</td>
                <td class="td-actions text-right">
                    <button type="button" rel="tooltip" class="btn btn-primary btn-link">
                        <a href="{{ route('user.edit', $user['id']) }}">Редактировать</a>
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection