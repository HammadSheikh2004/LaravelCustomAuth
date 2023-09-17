@extends('layout.app')
@section('title', 'Register Page')

@section('content')
    <section class="signup mt-3">
        <div class="container">
            <div class="signup-content">
                <div class="signup-form">
                    <h2 class="form-title">Register YourSelf</h2>
                    @if ($msg = Session::get('InsertMessage'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Congratulation!</strong>{{ $msg }}.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <form action="{{ route('SaveData') }}" method="POST" class="register-form" id="register-form">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                class="form-control @error('name') is-invalid @enderror" placeholder="Your Name" />
                            <span class="text-danger mt-2">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
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
                        <div class="form-group">
                            <input type="password" name="cpassword" value="{{ old('cpassword') }}" id="c_pass"
                                class="form-control @error('cpassword') is-invalid @enderror"
                                placeholder="Confirm password" />
                            <span class="text-danger mt-2">
                                @error('cpassword')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group form-button">
                            <input type="submit" name="signup" id="signup" class="form-submit btn btn-primary"
                                value="Register" />
                        </div>
                    </form>
                </div>
                <div class="signup-image">
                    <figure><img src="{{ asset('assets/img/signup-image.jpg') }}" alt="sing up image"></figure>
                    <a href="{{ route('login') }}" class="signup-image-link">You Have an Account, SignIn Here</a>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')

@endsection
