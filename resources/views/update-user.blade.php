@extends('template')

@section('content')

<?php

?>
<div class="height-body container mt-4">
    <div class="col-12 mt-4" id="container-form-ajout-event">
        <h2 class="w-100 d-flex justify-content-center color-green m-0 fw-bold">Modifier l'événement : </h2>
        <div class="col-8 col-xl-5 mx-auto">
            <form action="{{ route('update.user.dashboard', $user->id) }}" method="POST" class="mt-4">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="email" class="form-label">Mail</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="prenom" class="form-label">Prénom</label>
                    <input type="text" class="form-control" id="prenom" name="prenom" value="{{ $user->prenom }}">
                    @error('prenom')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="role_user" class="form-label">Role</label>
                    <input type="text" class="form-control" id="role_user" name="role_user" value="{{ $user->role_user }}">
                    @error('role_user')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary mb-4">Modifier</button>
            </form>
        </div>
    </div>
</div>
@endsection
