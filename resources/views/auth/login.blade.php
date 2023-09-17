@extends('layout.app')
@section('title', 'LogIn Page')

@section('content')
    <section class="sign-in mt-3">
        <div class="container">
            <div class="signin-content">
                <div class="signin-image">
                    <figure><img src="{{ asset('assets/img/signin-image.jpg') }}" alt="sing up image"></figure>
                    <a href="{{ route('register') }}" class="signup-image-link">Create an account</a>
                </div>

                <div class="signin-form">
                    <h2 class="form-title">SignIn YourSelf</h2>
                    @if ($errorMsg = Session::get('LoginErrorMessage'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong class="me-2">Error</strong>{{ $errorMsg }}.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if ($userErrorMsg = Session::get('LoginNotFoundMessage'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong class="me-2">Error</strong>{{ $userErrorMsg }}.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <form action="{{ route('LoginData') }}" method="POST" class="register-form" id="register-form">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="email" id="email" value="{{ old('email') }}"
                                class="form-control @error('email') is-invalid @enderror" placeholder="Your Email" />
                            <span class="text-danger mt-2">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" value="{{ old('password') }}" id="pass"
                                class="form-control @error('password') is-invalid @enderror" placeholder="Password" />
                            <span class="text-danger mt-2">
                                @error('password')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group form-button">
                            <input type="submit" name="signin" id="signin" class="form-submit btn btn-primary"
                                value="SignIn" />
                        </div>
                    </form>
                    <div class="social-login">
                        <span class="social-label">Or login with</span>
                        <ul class="socials">
                            <li><a href="#"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
                            <li><a href="#"><i class="display-flex-center zmdi zmdi-twitter"></i></a></li>
                            <li><a href="#"><i class="display-flex-center zmdi zmdi-google"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')

@endsection
