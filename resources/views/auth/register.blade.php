@extends('layouts.app')

@section('bodyClass', 'h-screen')

@section('content')

<div class="flex items-center flex-col justify-center h-full">
    <div class="text-grey-darkest py-6">
        <img src="/images/logo.png" alt="Pcasa" title="Pcasa" />
    </div>
    <div class="w-1/3 bg-white shadow p-6">
        <form method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}
            <div class="w-full mb-6">
                <label class="text-grey-darker block mb-2">Name</label>
                <input name="name" class="shadow border rounded w-full px-3 py-2" />
            </div> 
            <div class="w-full mb-6">
                <label class="text-grey-darker block mb-2">Email</label>
                <input type="email" name="email" class="shadow border rounded w-full px-3 py-2" />
            </div> 
            <div class="w-full mb-6">
                <label class="text-grey-darker block mb-2">Password</label>
                <input type="password" name="password" class="shadow border rounded w-full px-3 py-2" />
            </div> 
            <div class="w-full mb-6">
                <label class="text-grey-darker block mb-2">Password Confirmation</label>
                <input type="password" name="password_confirmation" class="shadow border rounded w-full px-3 py-2" />
            </div>             
            <div class="w-full text-left">
                <button type="submit" class="text-white bg-gold hover:bg-black rounded px-4 py-2">Register</button>
                <a href="{{ route('login') }}" class="text-grey-darker px-4 py-2 no-underline">Login</a>
            </div> 
        </form>
    </div>
</div>

<?php /*
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

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
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
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
