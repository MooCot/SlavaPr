@extends('layouts.app')

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <form method="post" action="{{ route('admin.store', $admin['id']) }}" autocomplete="off" class="form-horizontal">
          @csrf
          @method('put')

          <div class="card ">
            <div class="card-header card-header-primary">
              <h4 class="card-title">{{ __('Edit admin') }}</h4>
              <p class="card-category">{{ __('admin information') }}</p>
            </div>
            @include('alerts.success')
            <div class="card-body ">
              <div class="row">
                <label class="col-sm-2 col-form-label">{{ __('Сode') }}</label>
                <div class="col-sm-7">
                  <div class="form-group{{ $errors->has('code') ? ' has-danger' : '' }}">
                    <input class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}" name="code" id="input-code" type="text" placeholder="" value='{{$admin["code"]}}' required="true" aria-required="true" />
                    @if ($errors->has('code'))
                    <span id="code-error" class="error text-danger" for="input-code">{{ $errors->first('code') }}</span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="row">
                <label class="col-sm-2 col-form-label">{{ __('admins_text') }}</label>
                <div class="col-sm-7">
                  <div class="form-group{{ $errors->has('admins_text') ? ' has-danger' : '' }}">
                    <input class="form-control{{ $errors->has('admins_text') ? ' is-invalid' : '' }}" name="admins_text" id="input-admins_text" type="admins_text" placeholder="{{ __('admins_text') }}" value="{{$admin['admins_text']}}" required />
                    @if ($errors->has('admins_text'))
                    <span id="admins_text-error" class="error text-danger" for="input-admins_text">{{ $errors->first('admins_text') }}</span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="row">
                <label class="col-sm-2 col-form-label" for="input-password">{{ __('App_name') }}</label>
                <div class="col-sm-7">
                  <div class="form-group{{ $errors->has('app_name') ? ' has-danger' : '' }}">
                    <input class="form-control{{ $errors->has('app_name') ? ' is-invalid' : '' }}" name="app_name" id="input-app_name" type="app_name" placeholder="{{ __('New Password') }}" value="{{$admin->app->app_name}}" required />
                    @if ($errors->has('app_name'))
                    <span id="app_name-error" class="error text-danger" for="input-app_name">{{ $errors->first('app_name') }}</span>
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