@extends('auth.layout')
@section('page-content')

                <h4 class="text-center">{{ __("Login" )}}</h4>
                @if($email_verification_sending_libk = session('email-verification-sending-link'))
                <div class="form-group">
                  Please check you email for a verification link. If you did not receive the email,
                  <form action="{{ $email_verification_sending_libk }}" method="post">
                    @csrf
                    
                    <button class="btn text-primary px-0">Click here to request a new one</button>
                  </form>
                </div>
              @endif
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
                      <div class="col">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
                          <label class="form-check-label" for="form2Example31"> Remember me </label>
                        </div>
                      </div>
                  
                      <div class="col">
                        <a href="{{ route('password.request')}}">Forgot password?</a>
                      </div>
                    </div>
                  
                    <button type="submit" class="btn btn-primary w-100">Sign Up</button>
                  
                    <div class="text-center">
                      <p>Not a member? <a href="{{ route('register') }}">Sign in</a></p>
                
                    </div>
                  </form>
          
@endsection