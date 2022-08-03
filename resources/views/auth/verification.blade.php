@extends('auth.layout')
@section('page-content')

                <h4 class="text-center">{{ __("Verify your account" )}}</h4>
                <form action="" method="post">
                    @csrf
             
                    <div class="form-outline mb-4">
                        <label class="form-label" for="email">Verification code</label>
                        <input type="text" name="code" class="form-control" />
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-block mb-4">Login</button>
                  
                 
                  </form>
         
@endsection