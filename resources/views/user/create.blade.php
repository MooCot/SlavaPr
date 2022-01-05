@extends('layouts.app')
@section('title')Добавление Пользователя @endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <form method="post" action="{{ route('user.store') }}" enctype="multipart/form-data" autocomplete="off" class="form__create">
                @csrf
                <div class="form__create-text-style">
                    @include('alerts.success')
                    <div class="form__create_title">
                        <h4 class="">{{ __('Добавление пользователя') }}</h4>
                    </div>                    
                    <div class="form__create-container">
                        <div class="form__create-user_title">*Все поля обязательны для заполнения</div>
                        <div class="form__create-user_double">
                            <div class="form__input_block">
                                <label class="form__label-title">Имя</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                        <input class="form__input_indent form__input form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="input-name" type="name" placeholder="" value="" required />
                                        @if ($errors->has('name'))
                                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form__input_block">
                                <label class="form__label-title">Фамилия</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('surname') ? ' has-danger' : '' }}">
                                        <input class="form__input_indent form__input form-control{{ $errors->has('surname') ? ' is-invalid' : '' }}" name="surname" id="input-surname" type="surname" placeholder="" value="" required />
                                        @if ($errors->has('surname'))
                                        <span id="surname-error" class="error text-danger" for="input-surname">{{ $errors->first('surname') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form__create-user_double">
                            <div class="form__input_block">
                                <label class="form__label-title">E-mail</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                        <input class="form__input_indent form__input form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="input-email" type="email" placeholder="" value="" required />
                                        @if ($errors->has('email'))
                                        <span id="email-error" class="error text-danger" for="input-email">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form__input_block">
                                <label class="form__label-title">Разрешить доступ</label>
                                    <div class="form_toggle form__input_indent">
                                        <div class="form_toggle-item item-2">
                                            <input id="access-2" type="radio" name="access" value="1">
                                            <label for="access-2">Да</label>
                                        </div>
                                        <div class="form_toggle-item item-1">
                                            <input id="access-1" type="radio" name="access" value="0">
                                            <label for="access-1">Нет</label>
                                        </div>                                    
                                    </div>                               
                            </div>
                        </div>
                        <div class="form__create-user_double">
                            <div class="form__input_block">
                                <label class="form__label-title">Телефон</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('phone_number') ? ' has-danger' : '' }}">
                                        <input class="form__input_indent form__input rupiah form-control{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" name="phone_number" id="input-phone_number" type="text" placeholder="+380 _ _  _ _ _  _ _  _ _" value="" required />
                                        @if ($errors->has('phone_number'))
                                        <span id="phone_number-error" class="error text-danger" for="input-phone_number">{{ $errors->first('phone_number') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form__input_block">
                                <label class="form__label-title">Роль</label>
                                <div class="form_toggle form__input_indent">
                                    @foreach ($roles as $role)
                                    <div class="form_toggle-item item-{{ $role['id'] }}">
                                        <input id="role-{{ $role['id'] }}" type="radio" name="role" value="{{ $role['id'] }}">
                                        <label for="role-{{ $role['id'] }}">{{ $role['role_name'] }}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="form__create-user_double">
                            <div class="form__input_block">
                                <label class="form__label-title" for="input-password">{{ __('Пароль') }}</label>
                                <div class="col-sm-7">
                                    <div class="form__input_position form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                        <input class="form__input_indent form__input form__input_password form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="input-password" type="password" placeholder="" value="" required />
                                        <button type="button" id="form__input-password__button-visible" class="input-group__img-visible"></button> 
                                        @if ($errors->has('password'))
                                            <span id="password-error" class="error text-danger" for="input-password">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form__input_block">
                                <label class="form__label-title" for="input-password-confirmation">{{ __('Повторить пароль') }}</label>
                                <div class="col-sm-7">
                                    <div class="form__input_position form-group">
                                        <input class="form__input_indent form__input form-control" name="password_confirmation" id="input-password-confirmation" type="password" placeholder="" value="" required />
                                        <button type="button" id="form__input-password-confirm__button-visible" class="input-group__img-visible"></button> 
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            @if (session('status_password'))
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="alert alert-success">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <i class="material-icons">close</i>
                                        </button>
                                        <span>{{ session('status_password') }}</span>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>   
                        <div class="card-footer ml-auto mr-auto">
                            <button type="submit" class="form__button form__button_save">{{ __('Сохранить') }}</button>
                        </div>             
                    </div>                   
                    
                </div>
            </form>
        </div>
    </div>
</div>
@endsection