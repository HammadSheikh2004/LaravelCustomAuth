@extends('layout.app')
@section('title', 'Profile Page')

@section('content')
    <div class="container">
        <div class="row my-5">
            <div class="col-lg-12 bg-white">
                <div class="card border-0">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h2 class="text-secondary fw-bold">User Profile</h2>
                        <a href="{{ route('LogoutData') }}" class="btn btn-dark">LogOut</a>
                    </div>
                    <div class="card-body p-5">
                        <form action="{{ route('ProfileImage') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-4 text-center right_border">
                                    @if ($userInfo->image)
                                        <img src="{{ asset('assets/User_Image/' . $userInfo->image) }}" alt=""
                                            id="img_pre" class="img-fluid rounded-circle img-thumbnail">
                                    @else
                                        <img src="{{ asset('assets/img/images.png') }}" alt="" id="img_pre"
                                            width="200" class="img-fluid rounded-circle img-thumbnail">
                                    @endif
                                    <div>
                                        <input type="file" name="image" class="form-control rounded-pill w-100 mt-2"
                                            id="img_select">
                                    </div>
                                </div>

                                <div class="col-lg-8 px-2">
                                    <div class="form-group">
                                        <input type="hidden" name="user_id" value="{{ $userInfo->id }}">
                                        <input type="text" name="name" id="name" value="{{ $userInfo->name }}"
                                            class="form-control @error('name') is-invalid @enderror"
                                            placeholder="Your Name" />
                                        <span class="text-danger mt-2">
                                            @error('name')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="email" id="email" value="{{ $userInfo->email }}"
                                            class="form-control @error('email') is-invalid @enderror"
                                            placeholder="Your Email" />
                                        <span class="text-danger mt-2">
                                            @error('email')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <input type="number" name="number" id="number" value="{{ $userInfo->number }}"
                                            class="form-control @error('number') is-invalid @enderror"
                                            placeholder="Your Number" />
                                        <span class="text-danger mt-2">
                                            @error('number')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <input type="date" name="dob" id="dob" value="{{ $userInfo->dob }}"
                                            class="form-control @error('email') is-invalid @enderror"
                                            placeholder="Your Date Of Birth" />
                                        <span class="text-danger mt-2">
                                            @error('date')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" name="signup" id="signup"
                                            class="form-submit btn btn-primary" value="Update" style="margin-top: 0px" />
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('script')
    <script>
        const image = document.querySelector('#img_pre'),
            input = document.querySelector('#img_select');

        input.addEventListener("change", () => {
            image.src = URL.createObjectURL(input.files[0]);
        });
    </script>
@endsection
