@extends('layouts.app')
@section('title')Тестовый пуш @endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <form method="post" action="{{ route('admin.notification') }}" enctype="multipart/form-data" autocomplete="off" class="form-horizontal">
                @csrf
                <div class="form__create-text-style">
                    @include('alerts.success')
                    <div class="form__create_title">
                        <h4 class="card-title">{{ __('Добавление администратора') }}</h4>
                    </div>
                    <div class="form__create-container">
                        <div class="form__input_block form__input_block-admin">
                            <label class="form__label-title">Телефон</label>
                            <div class="col-sm-7">
                                <div class="form-group{{ $errors->has('phone') ? ' has-danger' : '' }}">
                                    <input class="form__input_indent form__input form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" id="input-phone" type="phone" placeholder="" value="" required />
                                    @if ($errors->has('phone'))
                                    <span id="phone-error" class="error text-danger" for="input-phone">{{ $errors->first('phone') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ml-auto mr-auto">
                            <button type="submit" class="form__button form__button_save">{{ __('Отправить') }}</button>
                        </div>
                    </div>
                    
                </div>
            </form>
            <form method="post" action="{{ route('admin.active') }}" enctype="multipart/form-data" autocomplete="off" class="form-horizontal">
                @csrf
                <div class="form__create-text-style">
                    @include('alerts.success')
                    <div class="form__create_title">
                        <h4 class="card-title">{{ __('активные push') }}</h4>
                    </div>
                    <div class="form__create-container">
                        <div class="card-footer ml-auto mr-auto">
                            <button type="submit" class="form__button form__button_save">{{ __('Отправить') }}</button>
                        </div>
                    </div>
                </div>
            </form>
            <form method="post" action="{{ route('admin.overdue') }}" enctype="multipart/form-data" autocomplete="off" class="form-horizontal">
                @csrf
                <div class="form__create-text-style">
                    @include('alerts.success')
                    <div class="form__create_title">
                        <h4 class="card-title">{{ __('просроченые push') }}</h4>
                    </div>
                    <div class="form__create-container">
                        <div class="card-footer ml-auto mr-auto">
                            <button type="submit" class="form__button form__button_save">{{ __('Отправить') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection