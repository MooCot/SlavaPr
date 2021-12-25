@extends('layouts.app')
@section('content')
<div class="dashboard-container">
    <div class="container-title">
        <h1 class="container-title__text">Admins</h1>
        <a class="container-title__button-text" href="{{ route('admin.create') }}">Добавить администратора</a>
    </div>    
    <div class="container__content" style="overflow-x: auto;">
        <table class="table">
            <thead>
                <tr class="table__thead">
                    <th class="table__text-center table__text-id">ID</th>
                    <th class="table__text-name ">Имя Фамилия</th>
                    {{-- <th class="table__text-surname admins-text-surname">Фамилия</th> --}}
                    <th class="table__text-email admins-text-email">E-mail</th>
                    <th class="table__text-edit"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($admins as $admin)
                <tr class="table__border-top">
                    <td class="table__text-center table__text-number">{{ $admin['id'] }}</td>
                    <td class="table__tbody-namesur">{{ $admin['name'] }} {{ $admin['surname'] }}</td>
                    {{-- <td></td> --}}
                    <td class="">{{ $admin['email'] }}</td>
                    <td class="table__text-edit-button">
                        <a href="{{ route('admin.edit', $admin['id']) }}">
                            <i class="table__edit-icon-pencil"></i>
                        </a>
                        <form action="{{ route('admin.destroy', $admin['id']) }}" method="POST" style="display: inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" rel="tooltip" class="table__delete-button"><i class="table__delete-icon-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection