@extends('layouts.app')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form method="post" action="{{ route('admin.store') }}" enctype="multipart/form-data" autocomplete="off" class="form-horizontal">
                    @csrf
                    <div class="card ">
                        @include('alerts.success')
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">{{ __('Create admin') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <label class="col-sm-2 col-form-label">name</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                        <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="input-name" type="name" placeholder="name" value="" required />
                                        @if ($errors->has('name'))
                                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">surname</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('surname') ? ' has-danger' : '' }}">
                                        <input class="form-control{{ $errors->has('surname') ? ' is-invalid' : '' }}" name="surname" id="input-surname" type="surname" placeholder="surname" value="" required />
                                        @if ($errors->has('surname'))
                                        <span id="surname-error" class="error text-danger" for="input-surname">{{ $errors->first('surname') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">email</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                        <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="input-email" type="email" placeholder="email" value="" required />
                                        @if ($errors->has('email'))
                                        <span id="email-error" class="error text-danger" for="input-email">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">username</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('username') ? ' has-danger' : '' }}">
                                        <input class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" id="input-username" type="username" placeholder="username" value="" required />
                                        @if ($errors->has('username'))
                                        <span id="username-error" class="error text-danger" for="input-username">{{ $errors->first('username') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">password</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                        <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="input-password" placeholder="password" value="" required />
                                        @if ($errors->has('password'))
                                        <span id="password-error" class="error text-danger" for="input-password">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ml-auto mr-auto">
                            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection