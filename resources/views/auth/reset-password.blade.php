@extends('auth.layout')

@section('title', __('Forgot Password'))

@section('page-content')

<h4 class="text-center">{{ __("Reset Password") }}</h4>
<p class="text-center py-1">{{ __("Write your new password") }}.</p>
<form class="forgot-password-form" action="{{ route('password.update')}}" method="POST">
    @csrf
    <div class="col-12 form-group">
        <input 
            type="email" name="email" class="form-control" placeholder="{{ __('Email') }}" 
            value="{{ old('email') ?? request('email') }}" required readonly
        >
        @error('email')
            <div class="text-danger mt-2">{{ $message }}</div>
        @enderror
    </div>

    <input name="token" type="hidden" value="{{ $token ?? old('token') }}" required>

    <div class="col-12 form-group my-3">
        <input type="password" name="password" class="form-control" placeholder="{{ __("Password") }}" required autofocus>
        @error('password')
            <div class="text-danger mt-2">{{ $message }}</div>
        @enderror
    </div>

    <div class="mt-3">
        <button class="btn btn-primary w-100">{{ __("Reset Password") }}</button>
    </div>
</form>

@endsection