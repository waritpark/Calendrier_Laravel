@extends('template')

@section('content')
<div class="height-body container mt-4">
    <div class="col-12 mt-4" id="container-form-ajout-event">
        <h2 class="w-100 d-flex justify-content-center color-green m-0 fw-bold">Ajout d'un nouvel événement</h2>
        <div class="col-8 col-xl-5 mx-auto">
            <form action="{{{  route('store.event.dashboard')  }}}" method="post" class="mt-4">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="name" name="name">
                    @error('name')
                        <div class="alert alert-danger">{{{  $message  }}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea type="text" class="form-control" name="description" id="description"></textarea>
                </div>
                <div class="mb-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" class="form-control" name="date" id="date">
                    @error('date')
                        <div class="alert alert-danger">{{{  $message  }}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="start" class="form-label">Début de l'événement</label>
                    <input type="time" class="form-control" name="start" id="start">
                    @error('start')
                        <div class="alert alert-danger">{{{  $message  }}}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="end" class="form-label">fin de l'événement</label>
                    <input type="time" class="form-control" name="end" id="end">
                    @error('end')
                        <div class="alert alert-danger">{{{  $message  }}}</div>
                    @enderror
                </div>
                <button type="submit" class="box-shadow-submit btn bg-color-white px-4 py-2 w-auto mb-4">Ajouter</button>
            </form>
        </div>
    </div>
</div>
@endsection
