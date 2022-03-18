@extends('layouts.app')
@section('title')Добавление администратора @endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <form method="post" action="{{ route('admin.store') }}" enctype="multipart/form-data" autocomplete="off" class="form-horizontal">
                @csrf
                <div class="form__create-text-style">
                    @include('alerts.success')
                    <div class="form__create_title">
                        <h4 class="card-title">{{ __('Добавление администратора') }}</h4>
                    </div>
                    <div class="form__create-container">
                        <div class="form__input_block form__input_block-admin">
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
                        <div class="form__input_block form__input_block-admin">
                            <label class="form__label-title">Фамилия</label>
                            <div class="col-sm-7">
                                <div class="form-group{{ $errors->has('surname') ? ' has-danger' : '' }}">
                                    <input class="form__input_indent form__input form-control{{ $errors->has('surname') ? ' is-invalid' : '' }}" name="surname" id="input-surname" type="password" placeholder="" value="" required />
                                    @if ($errors->has('surname'))
                                    <span id="surname-error" class="error text-danger" for="input-surname">{{ $errors->first('surname') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form__input_block form__input_block-admin">
                            <label class="form__label-title">Логин (E-mail)</label>
                            <div class="col-sm-7">
                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <input class="form__input_indent form__input form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="input-email" type="email" placeholder="" value="" required />
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
                                    <input class="form__input_indent form__input form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" name="password" id="input-password" placeholder="" value="" required />
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
                                    <input class="form__input_indent form__input form-control" name="password_confirmation" id="input-password-confirmation" type="password" placeholder="" value="" required />
                                    <button type="button" id="form__input-password-confirm__button-visible" class="input-group__img-visible"></button> 
                                </div>
                            </div>
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