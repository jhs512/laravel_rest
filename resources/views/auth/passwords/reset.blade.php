@extends('app')

@section('content')
    <section class="section-1 t-mt-4 t-flex-grow t-flex t-items-center t-justify-center">
        <div class="t-w-full t-max-w-lg t-px-4">
            <div class="card">
                <div class="card-header"><i class="fas fa-lock-open"></i> {{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}"
                        class="t-grid t-grid-cols-1 t-gap-4 t-mt-4">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div>
                            <label class="form-label">{{ __('Email Address') }}</label>

                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label">{{ __('Password') }}</label>

                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>

                        <div>
                            <label class="form-label">{{ __('Confirm Password') }}</label>

                            <input type="password" class="form-control" name="password_confirmation" required
                                autocomplete="new-password">
                        </div>

                        <div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-lock-open"></i> {{ __('Reset Password') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
