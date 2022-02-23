@extends('app')

@section('content')
    <section class="section-1 t-mt-4 t-flex-grow t-flex t-items-center t-justify-center">
        <div class="t-w-full t-max-w-lg t-px-4">
            <div class="card">
                <div class="card-header"><i class="fas fa-lock-open"></i> {{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="t-grid t-grid-cols-1 t-gap-4 t-mt-4" method="POST" action="{{ route('password.email') }}">
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
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-lock-open"></i>
                                {{ __('Send Password Reset Link') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
