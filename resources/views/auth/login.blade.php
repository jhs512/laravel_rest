@extends('app')

@section('content')
    <section class="section-1 t-mt-4 t-flex-grow t-flex t-items-center t-justify-center">
        <div class="t-w-full t-max-w-lg t-px-4">
            <div class="card">
                <div class="card-header"><i class="fas fa-sign-in-alt"></i> {{ __('Login') }}</div>

                <div class="card-body">
                    <form class="t-grid t-grid-cols-1 t-gap-4 t-mt-4" method="POST" action="{{ route('login') }}">
                        @csrf

                        <div>
                            <label class="form-label">{{ __('Email Address') }}</label>

                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>

                        <div>
                            <label class="form-label">{{ __('Password') }}</label>

                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div>
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>

                                {{ __('Remember Me') }}
                            </label>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-sign-in-alt"></i> {{ __('Login') }}
                            </button>

                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
