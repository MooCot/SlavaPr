@extends('layouts.app')
@section('title')Редактирование Администратора @endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <form method="post" action="{{ route('admin.update', $admin['id']) }}" autocomplete="off" class="form-horizontal">
                @csrf
                @method('put')
                <div class="form__create-text-style">
                    <div class="form__create_title">
                        <h4 class="card-title">{{ __('Редактирование администратора') }}</h4>
                    </div>
                    @include('alerts.success')
                    <div class="form__create-container">
                        <div class="form__input_block form__input_block-admin">
                            <label class="form__label-title">{{ __('Имя') }}</label>
                            <div class="col-sm-7">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <input class="form__input_indent form__input form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="input-name" type="text" placeholder="" value='{{ $admin["name"] }}' required="true" aria-required="true" />
                                    @if ($errors->has('name'))
                                    <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form__input_block form__input_block-admin">
                            <label class="form__label-title">{{ __('Фамилия') }}</label>
                            <div class="col-sm-7">
                                <div class="form-group{{ $errors->has('surname') ? ' has-danger' : '' }}">
                                    <input class="form__input_indent form__input form-control{{ $errors->has('surname') ? ' is-invalid' : '' }}" name="surname" id="input-surname" type="surname" placeholder="{{ __('surname') }}" value="{{$admin['surname']}}" required />
                                    @if ($errors->has('surname'))
                                    <span id="surname-error" class="error text-danger" for="input-surname">{{ $errors->first('surname') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form__input_block form__input_block-admin">
                            <label class="form__label-title" for="input-password">{{ __('Логин (E-mail)') }}</label>
                            <div class="col-sm-7">
                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <input class="form__input_indent form__input form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="input-email" type="email" placeholder="{{ __('New Password') }}" value="{{$admin->email}}" required />
                                    @if ($errors->has('email'))
                                    <span id="email-error" class="error text-danger" for="input-email">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form__input_block form__input_block-admin">
                            <label class="form__label-title">Пароль</label>
                            <div class="col-sm-7">
                                <div class="form__input_position form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                    <input class="form__input_indent form__input form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" type="password" id="input-password" placeholder="" value="******" required />
                                    <button type="button" id="form__input-password__button-visible" class="input-group__img-visible"></button>                                    
                                    @if ($errors->has('password'))
                                    <span id="password-error" class="error text-danger" for="input-password">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form__input_block form__input_block-admin">
                            <label class="form__label-title" for="input-password-confirmation">{{ __('Повторить пароль') }}</label>
                            <div class="col-sm-7">
                                <div class="form__input_position form-group">
                                    <input class="form__input_indent form__input form-control" name="password_confirmation" id="input-password-confirmation" type="password" placeholder="" value="******" required />
                                    <button type="button" id="form__input-password-confirm__button-visible" class="input-group__img-visible"></button> 
                                </div>
                            </div>
                        </div>
                        <div class="form__admin_buttons">
                            <button type="submit" class="form__button form__button_save">{{ __('Сохранить') }}</button>
                            <button type="button" id="showform" class="form__button form__button_delete">{{ __('Удалить') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="alert-form" class="alert-back">
    <form action="{{ route('admin.destroy', $admin['id']) }}" class="alert-form" method="POST">
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
@endsection