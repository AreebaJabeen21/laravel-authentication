@extends('auth.layout')
@section('page-content')

<h4 class="text-center">{{ __("Register" )}}</h4>
<form action="{{ route('register.store') }}" method="post">
  @csrf
  @if(session()->has('message'))
  <div class="alert alert-info">
    {{ session('message') }}
  </div>
  @endif
  <div class="form-outline mb-4">
    <label class="form-label" for="name">Name</label>
    <input type="text" id="name" name="name" class="form-control" />
    @error('name')
    <div class="mt-1 text-danger">{!! $message !!}</div>
    @enderror
  </div>
  
  <div class="form-outline mb-4">
    <label class="form-label" for="email">Email address</label>
    <input type="email" id="email" name="email" class="form-control" />
    @error('email')
    <div class="mt-1 text-danger">{!! $message !!}</div>
    @enderror
  </div>

  <div class="form-outline mb-4">
    <label class="form-label" for="password">Password</label>
    <input type="password" id="password" name="password" class="form-control" />
    @error('password')
    <div class="mt-1 text-danger">{!! $message !!}</div>
    @enderror
  </div>

  <div class="row mb-4">

    <div class="col">
      <a href="#!">Forgot password?</a>
    </div>
  </div>

  <button type="submit" class="btn btn-primary btn-block mb-4">Register</button>

  <div class="text-center">
    <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>

  </div>
</form>

@endsection