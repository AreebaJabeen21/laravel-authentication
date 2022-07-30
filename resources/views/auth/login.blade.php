@extends('auth.layout')
@section('page-content')

                <h4 class="text-center">{{ __("Login" )}}</h4>
                <form action="" method="post">
                    @csrf
                    @if(session()->has('message'))
                    <div class="alert alert-info">
                        {{ session('message') }}
                    </div>
                 @endif
                    <div class="form-outline mb-4">
                        <label class="form-label" for="email">Email address</label>
                        <input type="email" id="email" name="email" class="form-control" />
                    </div>
                  
                    <div class="form-outline mb-4">
                        <label class="form-label" for="password">Password</label>
                        <input type="password" id="password" name="password" class="form-control" />
                    </div>
                  
                    <div class="row mb-4">
                      <div class="col d-flex justify-content-center">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
                          <label class="form-check-label" for="form2Example31"> Remember me </label>
                        </div>
                      </div>
                  
                      <div class="col">
                        <a href="{{ route('forgot-password') }}">Forgot password?</a>
                      </div>
                    </div>
                  
                    <button type="submit" class="btn btn-primary btn-block mb-4">Login</button>
                  
                    <div class="text-center">
                      <p>Not a member? <a href="{{ route('register') }}">Register</a></p>
                
                    </div>
                  </form>
     
@endsection