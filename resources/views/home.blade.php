@extends('layouts.app')
@section('title','Home')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header text-center">
                <h3>Welcome</h3>
            </div>
            <div class="card-body text-center">
                @auth
                    <h5>Hello, {{ auth()->user()->name }}!</h5>
                    <p>Selamat datang di aplikasi Laravel kamu.</p>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                       class="btn btn-danger mt-3">
                        Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @else
                    <p>Selamat datang! Silakan <a href="{{ route('login') }}">Login</a> atau <a href="{{ route('register') }}">Register</a>.</p>
                @endauth
            </div>
        </div>
    </div>
</div>
@endsection
