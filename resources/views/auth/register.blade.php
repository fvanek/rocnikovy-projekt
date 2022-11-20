@extends('layouts.app')
@section('content')
    <p class="nav_title">{{ $nav_title = 'Registrace' }}</p>
    <form action="register" method="POST" enctype="multipart/form-data">
        @csrf
        <section class="vh-100">
            <div class="container">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-dark text-white" style="border-radius: 1rem;">
                            <div class="card-body p-5 text-center">
                                <div class="mt-md-4">
                                    <h2 class="fw-bold mb-2 text-uppercase">Registrace</h2>
                                    <p class="text-white-50 mb-5">Registrace je rychlá a snadná</p>

                                    <div class="form-outline form-white mb-4">
                                        <input type="text" id="name" name="name"
                                            class="form-control form-control-lg" value="{{ old('name') }}" />
                                        <label class="form-label" for="name">Uživatelské jméno</label>
                                        @error('name')
                                            <p class="text-danger">{{ $messsage }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <input type="email" id="email" name="email"
                                            class="form-control form-control-lg" value="{{ old('email') }}" />
                                        <label class="form-label" for="email">Email</label>
                                        @error('email')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <input type="password" id="password" name="password"
                                            class="form-control form-control-lg" />
                                        <label class="form-label" for="password">Heslo</label>
                                        @error('password')
                                            <p class="text-danger ">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <input type="password" id="password_confirmation" name="password_confirmation"
                                            class="form-control form-control-lg" />
                                        <label class="form-label" for="password_confirmation">Heslo znovu</label>
                                        @error('password_confirmation')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <button class="btn btn-outline-light btn-lg px-5" type="submit">Zaregistrovat
                                        se</button>
                                    <a class="btn btn-outline-light btn-lg mt-3" href="{{ route('googlelogin') }}"
                                        role="button" style="text-transform:none">
                                        <img width="20px" style="margin-bottom:3px; margin-right:5px" alt="Google sign-in"
                                            src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/512px-Google_%22G%22_Logo.svg.png" />
                                        Zaregistrovat přes Google
                                    </a>
                                    <p class="small mt-3"><a class="text-white-50" href="{{ url()->previous() }}">Zpět</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
@endsection
