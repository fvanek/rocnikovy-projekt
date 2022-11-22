@extends('layouts.app')
@section('content')
    <p class="nav_title">{{ $nav_title = 'Subfora' }}</p>

    @auth
        <div class="row">
            <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#createSubforumModal">
                Vytvořit subforum
            </button>
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
                                <form action="subforum/create" method="POST">
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
            @endauth
            @foreach ($subforums as $subforum)
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title text-center">{{ $subforum->name }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="text-center">
                                    <img src="{{ asset('storage/' . $subforum->image) }}"
                                        class="img rounded-circle mx-auto d-block" width="100px" height="100px"
                                        alt="Profile Picture">
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
                                    <h6>Počet příspěvků: {{ $subforum->posts->count() }}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-md-12">
                                <div class="text-center">
                                    <h6>Členem od {{ date('d.m.Y', strtotime($subforum->created_at)) }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endsection
