@extends('app')

@section('content')
    <section class="section-1 t-mt-4 t-flex-grow t-flex t-items-center t-justify-center">
        <div class="t-w-full t-max-w-lg t-px-4">
            <div class="card">
                <div class="card-header"><i class="fas fa-user-plus"></i> {{ __('Register') }}</div>

                <div class="card-body">
                    <form class="t-grid t-grid-cols-1 t-gap-4 t-mt-4" action="{{ route('register') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div>
                            <label class="form-label">{{ __('Name') }}</label>

                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label">{{ __('Email Address') }}</label>

                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>

                        <div>
                            <label for="password" class="form-label">{{ __('Password') }}</label>

                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" required autocomplete="new-password">

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
                                <i class="fas fa-user-plus"></i> {{ __('Register') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
