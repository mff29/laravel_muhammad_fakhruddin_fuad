@extends('layouts.app')
@section('title','Login')
@section('content')
<div class="row justify-content-center mt-5">
     <div class="col-md-5">
          <div class="card shadow-sm">
               <div class="card-header text-center">
                    <h3>Login</h3>
               </div>
               <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                         @csrf

                         <!-- username -->
                         <div class="mb-3">
                         <label for="username" class="form-label">Username</label>
                         <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" required autofocus>
                         @error('username')
                              <span class="invalid-feedback" role="alert">
                                   <strong>{{ $message }}</strong>
                              </span>
                         @enderror
                         </div>

                         <!-- Password -->
                         <div class="mb-3">
                         <label for="password" class="form-label">Password</label>
                         <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
                         @error('password')
                              <span class="invalid-feedback" role="alert">
                                   <strong>{{ $message }}</strong>
                              </span>
                         @enderror
                         </div>

                         <!-- Remember Me -->
                         <div class="mb-3 form-check">
                         <input type="checkbox" name="remember" id="remember" class="form-check-input" {{ old('remember') ? 'checked' : '' }}>
                         <label for="remember" class="form-check-label">Remember Me</label>
                         </div>

                         <div class="mb-3">
                         <button type="submit" class="btn btn-primary w-100">Login</button>
                         </div>

                         @if (Route::has('password.request'))
                         <div class="text-center">
                              <a href="{{ route('password.request') }}">Forgot Your Password?</a>
                         </div>
                         @endif

                         <div class="text-center mt-3">
                         Belum punya akun? <a href="{{ route('register') }}">Register</a>
                         </div>
                    </form>
               </div>
          </div>
     </div>
</div>
@endsection
