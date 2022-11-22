@extends('layouts.app')
@section('content')
    <p class="nav_title">{{ $nav_title = 'Profil' }}</p>
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title text-center">{{ auth()->user()->name }}</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-center">
                                <img src="{{ asset('storage/' . Auth::user()->avatar) }}"
                                    class="img rounded-circle mx-auto d-block" width="100px" height="100px"
                                    alt="Profile Picture">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-md-12">
                            <div class="text-center">
                                <h6>{{ auth()->user()->bio }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-md-12">
                            <div class="text-center">
                                <h6>{{ auth()->user()->email }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-md-12">
                            <div class="text-center">
                                <h6>Počet příspěvků: {{ auth()->user()->posts->count() }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="text-center">
                                <h6>Členem od {{ date('d.m.Y', strtotime(auth()->user()->created_at)) }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title text-center">Nastavení</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="/profile" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="avatar" class="form-label">Profilová fotka</label>
                                    <input class="form-control" type="file" id="avatar" name="avatar">
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Jméno</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ auth()->user()->name }}">
                                </div>
                                <div class="mb-3">
                                    <label for="bio" class="form-label">Bio</label>
                                    <textarea class="form-control" id="bio" name="bio" rows="3" placeholder="Napište něco o sobě...">{{ auth()->user()->bio }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-primary mb-3"><i
                                        class="fa-solid fa-cloud-arrow-up me-2"></i>Uložit</button>
                            </form>
                        </div>
                        <hr class="divider">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#deleteModal">
                                <i class="fa-solid fa-trash me-2"></i>Smazat účet
                            </button>

                            <div class="modal fade text-dark" id="deleteModal" tabindex="-1"
                                aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel"><i
                                                    class="fa-solid fa-trash me-2"></i>Smazat účet</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                            Opravdu chcete smazat účet?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Zavřít</button>
                                            <form action="/profile/delete" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Smazat</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
