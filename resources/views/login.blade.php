
<form class="form" method="post" action="{{ route('admin.login') }}">
    @csrf
    <div class="input-group{{ $errors->has('email') ? ' has-danger' : '' }}">
        <div class="input-group-prepend">
            <div class="input-group-text">
                <i class="tim-icons icon-email-85"></i>
            </div>
        </div>
        <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}">
    </div>
    <div class="input-group{{ $errors->has('password') ? ' has-danger' : '' }}">
        <div class="input-group-prepend">
            <div class="input-group-text">
                <i class="tim-icons icon-lock-circle"></i>
            </div>
        </div>
        <input type="password" placeholder="{{ __('Password') }}" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}">
    </div>

    <button type="submit" href="" class="btn btn-primary btn-lg btn-block mb-3">{{ __('Get Started') }}</button>
</form>

