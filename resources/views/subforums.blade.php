@extends('layouts.app')
@section('content')
    <p class="nav_title">
        {{ $nav_title = 'Subfora' }}</p>
    @auth
        <div class="mb-2">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createSubforumModal">
                Vytvořit subforum
            </button>
            <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#createCategoryModal">
                Moje Subfora
            </button>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="modal fade text-dark" id="createSubforumModal" tabindex="-1"
                    aria-labelledby="createSubforumModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="createSubforumModalLabel">Vytvořit subforum</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                <form action="subforum/create" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Název</label>
                                        <input type="text" class="form-control" id="name" name="name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Popis</label>
                                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Obrázek</label>
                                        <input class="form-control" type="file" id="image" name="image">
                                    </div>
                                    <input type="submit" class="btn btn-primary" value="Vytvořit">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    @endauth
    @if ($subforums->count() == 0)
        <div class="card mb-2">
            <div class="card-header">
                <h5 class="card-title">Žádné subfora</h5>
            </div>
        </div>
    @endif
    @foreach ($subforums as $subforum)
        <div class="card mb-2">
            <div class="card-header">
                <h5 class="card-title text-center"><a href="subforum/{{ $subforum->id }}">{{ $subforum->name }}</a></h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-center">
                            <img src="{{ asset('storage/' . $subforum->image) }}" class="img rounded-circle mx-auto d-block"
                                width="100px" height="100px" alt="Profile Picture">
                        </div>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-md-12">
                        <div class="text-center">
                            <h6>{{ $subforum->description }}</h6>
                        </div>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-md-12">
                        <div class="text-center">
                            <h6>{{ $subforum->posts->count() }}
                                @if ($subforum->posts->count() == 1)
                                    příspěvek
                                @elseif($subforum->posts->count() >= 2 && $subforum->posts->count() <= 4)
                                    příspěvky
                                @else
                                    příspěvků
                                @endif
                            </h6>
                        </div>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-md-12">
                        <div class="text-center">
                            <h6>Vytvořeno {{ date('d.m.Y', strtotime($subforum->created_at)) }}</h6>
                        </div>
                    </div>
                </div>
                @if ($subforum->user_id == Auth::id())
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#editSubforumModal">
                        Upravit
                    </button>
                    <div class="modal fade text-dark" id="editSubforumModal" tabindex="-1"
                        aria-labelledby="editSubforumModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editSubforumModalLabel"><i
                                            class="fa-solid fa-pen-to-square me-1"></i>Upravit subforum</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <form action="subforum/{{ $subforum->id }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Název</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                value="{{ $subforum->name }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Popis</label>
                                            <textarea class="form-control" id="description" name="description" rows="3">{{ $subforum->description }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Obrázek</label>
                                            <input class="form-control" type="file" id="image" name="image">
                                        </div>
                                        <input type="submit" class="btn btn-primary" value="Aktualizovat">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                        data-bs-target="#deleteSubforumModal">
                        Smazat
                    </button>
                    <div class="modal fade text-dark" id="deleteSubforumModal" tabindex="-1"
                        aria-labelledby="deleteSubforumModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteSubforumModalLabel"><i
                                            class="fa-solid fa-trash me-2"></i>Smazat subforum</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-center">
                                    Opravdu chcete smazat subforum?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Zavřít</button>
                                    <form action="subforum/{{ $subforum->id }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Smazat</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endforeach
    </div>
    </div>
@endsection
