@extends('layouts.app')
@section('bodyClass', 'h-screen')

@section('content')

<div class="flex items-center flex-col justify-center h-full">
    <div class="text-grey-darkest py-6">
        <img src="/images/logo.png" alt="Pcasa" title="Pcasa" />
    </div>
    <div class="w-1/3 bg-white shadow p-6">
        <form method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            <div class="w-full mb-6">
                <label class="text-grey-darker block mb-2">Email</label>
                <input type="email" name="email" class="shadow border rounded w-full px-3 py-2" />
            </div> 
            <div class="w-full mb-6">
                <label class="text-grey-darker block mb-2">Password</label>
                <div class="relative">
                    <input type="password" name="password" class="shadow border rounded w-full px-3 py-2" />
                    <span class="absolute pin-t pin-r mt-2 mr-2">
                        <a href="{{ route('password.request') }}" class="text-grey-darker no-underline text-xs">Forgot password?</a>
                    </span>
                </div>
            </div> 
            <div class="w-full mb-6">
                <label>
                    <input type="checkbox" name="remember" class="mr-1" />
                    <span class="text-grey-darker">Remember me</span>
                </label>
            </div>            
            <div class="w-full text-left">
                <button type="submit" class="text-white bg-gold hover:bg-black rounded px-4 py-2">Login</button>
                <a href="{{ route('register') }}" class="text-grey-darker px-4 py-2 no-underline">Register</button>
            </div> 
        </form>
    </div>
</div>

<?php /*
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
*/ ?>

@endsection
