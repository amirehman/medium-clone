@extends('guest.app')

@section('content')

        <form method="POST" action="{{ route('login') }}">
                        @csrf

        <div class="container mx-auto h-screen flex justify-center items-center">
            <div class="w-1/3">
                <h3 class="font-hairline mb-6 text-center">{{ __('Login to Medium Clone') }}</h3>
                <div class="border-teal p-8 border-t-12 bg-white mb-6 rounded-lg shadow">
                    <div class="mb-4">
                        <label class="font-bold text-grey-darker block mb-2">{{ __('E-Mail Address') }}</label>
                        <input type="email" id="email" class="block appearance-none w-full bg-white border border-grey-light hover:border-grey px-2 py-2 rounded {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                    </div>

                    <div class="mb-4">
                        <label class="font-bold text-grey-darker block mb-2">{{ __('Password') }}</label>
                        <input type="password" id="password" class="block appearance-none w-full bg-white border border-grey-light hover:border-grey px-2 py-2 rounded {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                    </div>


                    <div class="mb-4">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>

                    <div class="flex items-center justify-between">
                        <button class="bg-teal-dark hover:bg-teal text-white font-bold py-2 px-4 rounded">
                            Login
                        </button>

                        @if (Route::has('password.request'))
                            <a class="no-underline inline-block align-baseline font-bold text-sm text-blue hover:text-blue-dark float-right" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                        @if ($errors->has('email'))
                            <div class="bg-red-lightest border border-red-light text-red-dark mt-5 px-4 py-3 rounded relative" role="alert">
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            </div>                    
                        @endif
                        @if ($errors->has('password'))
                            <div class="bg-red-lightest border border-red-light text-red-dark mt-5 px-4 py-3 rounded relative" role="alert">
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            </div>                    
                        @endif
                </div>
                <div class="text-center">
                
                    <p class="text-grey-dark text-sm">Don't have an account? <a href="/register" class="no-underline text-blue font-bold">Create an Account</a>.</p>
                </div>
            </div>
    </div>
        </form>

@endsection
