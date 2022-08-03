@extends('auth.layout')
@section('page-content')

                <h4 class="text-center">{{ __("Register" )}}</h4>
                <form class="register-form" action="{{ route('register.store') }}" method="POST">
                    @csrf
                    <div class="form-outline mb-4">
                        <label class="form-label" for="name">Name </label>
                        <input type="text" id="name" class="form-control" name="name"/>
                        @error('name')
                            <div class="mt-1 text-danger"> {!! $message !!} </div>
                        @enderror
                    </div>
                    
                    <div class="form-outline mb-4">
                        <label class="form-label" for="email">Email address</label>
                        <input type="email" id="email" class="form-control" name="email"/>
                        @error('email')
                            <div class="mt-1 text-danger">{!! $message !!}</div>
                        @enderror
                    </div>
                  
                    <div class="form-outline mb-4">
                        <label class="form-label" for="password">Password</label>
                        <input type="password" id="password" class="form-control" name="password"/>
                        @error('password')
                         <div class="mt-1 text-danger">{!! $message !!}</div>
                        @enderror
                    </div>
                  
                  
                    <button type="submit" class="btn btn-primary w-100">Sign in</button>
                  
                    <div class="text-center">
                      <p>Already have an account? <a href="{{ route('login') }}">sign Up</a></p>
                
                    </div>
                  </form>
          
@endsection