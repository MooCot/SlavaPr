@extends('layouts.app')
@section('title')Пользователи MH Task Planer @endsection
@section('content')
<div class="dashboard-container">
    <div class="container-title">
        <a class="container-title__button-text" href="{{ route('user.create') }}">Добавить пользователя</a>
    </div>
    <div class="container__content" style="overflow-x: auto;">
        <table class="table table__tasks">
            <thead>
                <tr class="table__thead">
                    <th class="table__text-center table__text-id">ID</th>
                    <th class="table__text-name">Имя</th>
                    <th class="table__text-surname">Фамилия</th>
                    <th class="table__text-position">Должность</th>
                    <th class="table__text-email">E-mail</th>
                    <th class="table__text-phone">Телефон</th>
                    <th class="table__text-edit"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr class="table__border-top">
                    <td class="table__text-center table__text-number">{{ $user['id'] }}</td>
                    <td class="table__tbody-namesur">{{ $user['name'] }}</td>
                    <td class="table__tbody-namesur">{{ $user['surname'] }}</td>
                    <td class="table__tbody-pos-em-num">{{ $user->role['role_name'] }}</td>
                    <td class="table__tbody-pos-em-num">{{ $user['email'] }}</td>
                    <td class="table__tbody-pos-em-num">{{ $user['phone_number'] }}</td>
                    <td class="">
                        <a class="" href="{{ route('user.edit', $user['id']) }}">
                            <i class="table__edit-icon-pencil"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="container__pagination">
            {{ $users->links() }}  
        </div>
    </div>
</div>
@endsection