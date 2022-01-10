@extends('layouts.app')
@section('title')Администраторы MH Task Planer @endsection
@section('content')
<div class="dashboard-container">
    <div class="container-title">
        <a class="container-title__button-text" href="{{ route('admin.create') }}">Добавить администратора</a>
    </div>    
    <div class="container__content" style="overflow-x: auto;">
        <table class="table">
            <thead>
                <tr class="table__thead">
                    <th class="table__text-center table__text-id">ID</th>
                    <th class="table__text-name ">Имя Фамилия</th>
                    <th class="table__text-email admins-text-email">E-mail</th>
                    <th class="table__text-edit"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($admins as $admin)
                <tr class="table__border-top">
                    <td class="table__text-center table__text-number">{{ $admin['id'] }}</td>
                    <td class="table__tbody-namesur">{{ $admin['name'] }} {{ $admin['surname'] }}</td>
                    <td class="">{{ $admin['email'] }}</td>
                    <td class="table__text-edit-button">
                        <a href="{{ route('admin.edit', $admin['id']) }}">
                            <i class="table__edit-icon-pencil"></i>
                        </a>
                        <a href="{{ route('admin.showdelete', $admin['id']) }}">
                            <i class="table__delete-icon-trash"></i>
                        </a>    
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@if(!empty($admindelete))
    <div id="alert-form" style="display: flex;" class="alert-back">
        <form action="{{ route('admin.destroy', $admindelete['id']) }}" class="alert-form" method="POST">
            @csrf
            @method('DELETE')
            <div class="alert-block-icon">
                <i id="closeform" class="icon-close alert-icon"></i>
            </div>
            <img class="alert-img" src="/assets/images/alert.png" alt="">
            <div class="alert-title">Удаление пользователя</div>
            <div class="alert-text">Вы уверены что хотите удалить</br> пользователя?</div>
            <div class="alert-button-block">
                <button id="closeform2" type="button" class="form__button form__button_save">{{ __('Отмена') }}</button>
                <button type="submit" class="form__button form__button_delete">{{ __('Удалить') }}</button>
            </div>
        </form>
    </div>
@endif
@endsection