@extends('layouts.app')
@section('title')Редактирование Пользователя @endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <form method="post" action="{{ route('user.update', $user['id']) }}" autocomplete="off" class="form-horizontal">
                @csrf
                @method('put')
                <div class="form__create-text-style">
                    <div class="form__create_title">
                        <h4 class="card-title">{{ __('Редактирование пользователя') }}</h4>
                    </div>
                    @include('alerts.success')
                    <div class="form__create-container">
                        <div class="form__create-user_title">*Все поля обязательны для заполнения</div>
                        <div class="form__create-user_double">
                            <div class="form__input_block">
                                <label class="form__label-title">{{ __('Имя') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                        <input class="form__input_indent form__input form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="input-name" type="text" placeholder="" value='{{$user["name"]}}' required="true" aria-required="true" />
                                        @if ($errors->has('name'))
                                            <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form__input_block">
                                <label class="form__label-title">{{ __('Фамилия') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('surname') ? ' has-danger' : '' }}">
                                        <input class="form__input_indent form__input form-control{{ $errors->has('surname') ? ' is-invalid' : '' }}" name="surname" id="input-surname" type="surname" placeholder="" value="{{$user['surname']}}" required />
                                        @if ($errors->has('surname'))
                                            <span id="surname-error" class="error text-danger" for="input-surname">{{ $errors->first('surname') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form__create-user_double">
                            <div class="form__input_block">
                                <label class="form__label-title" for="input-password">{{ __('E-mail') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                        <input class="form__input_indent form__input form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="input-email" type="email" placeholder="{{ __('New Password') }}" value="{{$user->email}}" required />
                                        @if ($errors->has('email'))
                                            <span id="email-error" class="error text-danger" for="input-email">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form__input_block">
                                <label class="form__label-title">Разрешить доступ</label>
                                <div class="form-group{{ $errors->has('access1') ? ' has-danger' : '' }}">
                                    <div class="form_toggle form__input_indent">
                                        <div class="form_toggle-item item-2">
                                            <input id="access-2" type="radio" name="access" value="1"  {{ $user->access==1 ? 'checked' : '' }}>
                                            <label class="error-label" for="access-2">Да</label>
                                        </div>
                                        <div class="form_toggle-item item-1">
                                            <input id="access-1" type="radio" name="access" value="0"  {{ $user->access==0 ? 'checked' : '' }}>
                                            <label class="error-label" for="access-1">Нет</label>
                                        </div>  
                                        @if ($errors->has('email'))
                                            <span id="access-error" class="error text-danger" for="input-access">{{ $errors->first('access') }}</span>
                                        @endif                                  
                                    </div>                               
                                </div>                               
                            </div>
                        </div>
                        <div class="form__create-user_double">
                            <div class="form__input_block">
                                <label class="form__label-title">Телефон</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('phone_number') ? ' has-danger' : '' }}">
                                        <input class="form__input_indent form__input rupiah form-control{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" name="phone_number" id="input-phone_number" type="phone_number" placeholder="phone_number" value="{{$user->phone_number}}" required />
                                        @if ($errors->has('phone_number'))
                                            <span id="phone_number-error" class="error text-danger" for="input-phone_number">{{ $errors->first('phone_number') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form__input_block">
                                <label class="form__label-title">Роль</label>
                                <div class="form-group{{ $errors->has('role1') ? ' has-danger' : '' }}">
                                    <div class="form_toggle form__input_indent">
                                        @foreach ($roles as $role)
                                        <div class="form_toggle-item item-{{ $role['id'] }}">
                                            <input id="role-{{ $role['id'] }}" type="radio" name="role" value="{{ $role['id'] }}" {{ $user->role_id==$role['id'] ? 'checked' : '' }}>
                                            <label class="error-label" for="role-{{ $role['id'] }}">{{ $role['role_name'] }}</label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @if ($errors->has('role'))
                                    <span id="role-error" class="error text-danger" for="input-role">{{ $errors->first('role') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form__create-user_double">
                            <div class="form__input_block">
                                <label class="form__label-title" for="input-password">{{ __('Пароль') }}</label>
                                <div class="col-sm-7">
                                    <div class="form__input_position form-group{{ $errors->has('password1') ? ' has-danger' : '' }}">
                                        <input class="form__input_indent form__input form-control{{ $errors->has('password1') ? ' is-invalid' : '' }}" name="password1" id="input-password" type="password" placeholder="" value="111111" required />
                                        <button type="button" id="form__input-password__button-visible" class="input-group__img-visible"></button> 
                                        @if ($errors->has('password1'))
                                            <span id="password-error" class="error text-danger" for="input-password">{{ $errors->first('password1') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form__input_block">
                                <label class="form__label-title" for="input-password-confirmation">{{ __('Повторить пароль') }}</label>
                                <div class="col-sm-7">
                                    <div class="form__input_position form-group{{ $errors->has('password_confirmation1') ? ' has-danger' : '' }}">
                                        <div class="form__input_position form-group">
                                            <input class="form__input_indent form__input form-control" name="password_confirmation1" id="input-password-confirmation" type="password" placeholder="" value="111111" required />
                                            <button type="button" id="form__input-password-confirm__button-visible" class="input-group__img-visible"></button> 
                                            @if ($errors->has('password_confirmation1'))
                                                <span id="password-error" class="error text-danger" for="input-password">{{ $errors->first('password_confirmation1') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form__create-user_double form__create_buttons">
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
    <form action="{{ route('user.destroy', $user['id']) }}" class="alert-form" method="POST">
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