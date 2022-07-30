@extends('auth.layout')

@section('title', __('Forgot Password'))

@section('page-content')

<h4 class="text-center">{{ __("Forgot Password") }}</h4>
<p class="text-center py-1">{{ __("You can reset your password here") }}.</p>

<form class="forgot-password-form" action="#" method="POST">
    @csrf
    <div class="col-12 form-group">
        <input type="email" name="email" class="form-control" placeholder="{{ __('Email') }}" required autofocus>
        @error('email')
        <p class="text-danger">{!! $message !!}</p>
        @enderror
    </div>

    <div class="mt-3">
        <button class="btn btn-light-green w-100">{{ __("Reset Password") }}</button>
    </div>
</form>

@endsection