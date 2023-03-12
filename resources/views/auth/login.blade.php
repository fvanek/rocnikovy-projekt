<x-layout>
    <x-slot name="title">
        Přihlášení
    </x-slot>
    <form action="{{ route('user/auth') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <section class="vh-100">
            <div class="container">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card shadow-lg" style="border-radius: 1rem;">
                            <div class="card-body p-5 text-center">

                                <div class="mt-md-4 pb-5">

                                    <h2 class="fw-bold mb-2 text-uppercase">Přihlášení</h2>
                                    <p class="text-50 mb-5">Zadejte prosím váš email a heslo</p>

                                    <div class="form-outline form-dark mb-4">
                                        <input type="email" id="email" name="email"
                                            class="form-control form-control-lg"
                                            @if (Cookie::has('remember_email')) value="{{ Cookie::get('remember_email') }}"
                                            @else value="{{ old('email') }} " /> @endif
                                            <label class="form-label" for="email">Email</label>
                                    </div>

                                    <div class="form-outline form-dark mb-2">
                                        <input type="password" id="password" name="password"
                                            class="form-control form-control-lg"
                                            @if (Cookie::has('remember_password')) value="{{ Cookie::get('remember_password') }}"
                                            @else value="{{ old('password') }}" @endif />
                                        <label class="form-label mt-1" for="password">Heslo</label>
                                    </div>
                                    <div class="form-check d-flex justify-content-center mb-4">
                                        <input class="form-check-input" type="checkbox" id="remember" name="remember"
                                            value="" @if (Cookie::has('remember_email')) checked @endif />
                                        <label class="form-check label text-50" for="remember">
                                            Zapamatovat si mě
                                        </label>
                                    </div>
                                    <button class="btn btn-outline-dark btn-lg px-5" type="submit">Přihlásit</button>
                                    <a class="btn btn-outline-dark btn-lg mt-3" href="{{ route('googlelogin') }}"
                                        role="button" name="google_login" style="text-transform:none">
                                        <img width="20px" style="margin-bottom:3px; margin-right:5px"
                                            alt="Google sign-in"
                                            src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/512px-Google_%22G%22_Logo.svg.png" />
                                        Přihlásit se přes Google
                                    </a>
                                </div>
                                <p>Nemáte účet? <a href="{{ route('register') }}" class="text-50 fw-bold">Zaregistrovat
                                        se</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
</x-layout>
