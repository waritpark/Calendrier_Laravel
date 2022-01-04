@if ($message = Session::get('error'))
{{-- Connexion au dashboard --}}
<div class="row justify-content-center mt-4">
    <div class="col-6">
        <div class="alert alert-danger d-flex justify-content-center">
            <div>{{ $message }}</div>
        </div>
    </div>
</div>
@endif

@if ($message = Session::get('update'))
{{-- modification d'un event --}}
<div class="modal d-block" id="modal-success-event">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Information :</h5>
                <button onclick="removeSuccess();" type="button" class="btn-close" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Votre événement a été modifié !</p>
            </div>
            <div class="modal-footer">
                <button onclick="removeSuccess();" type="button" class="btn btn-secondary">Fermer</button>
            </div>
        </div>
    </div>
</div>
@endif
@if ($message = Session::get('create'))
{{-- creation d'un event --}}
<div class="modal d-block" id="modal-success-event">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Information :</h5>
                <button onclick="removeSuccess();" type="button" class="btn-close" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Votre événement a été enregistré !</p>
            </div>
            <div class="modal-footer">
                <button onclick="removeSuccess();" type="button" class="btn btn-secondary ?>">Fermer</button>
            </div>
        </div>
    </div>
</div>
@endif
@if ($message = Session::get('destroy'))
{{-- suppression d'un event --}}
<div class="modal d-block" id="modal-success-event">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Information :</h5>
                <button onclick="removeSuccess();" type="button" class="btn-close" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Votre événement a été supprimé !</p>
            </div>
            <div class="modal-footer">
                <button onclick="removeSuccess();" type="button" class="btn btn-secondary">Fermer</button>
            </div>
        </div>
    </div>
</div>
@endif
@if ($message = Session::get('update_user'))
{{-- modification d'un utilisateur --}}
<div class="modal d-block" id="modal-success-event">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Information :</h5>
                <button onclick="removeSuccess();" type="button" class="btn-close" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>L'utilisateur a bien été modifié !</p>
            </div>
            <div class="modal-footer">
                <button onclick="removeSuccess();" type="button" class="btn btn-secondary">Fermer</button>
            </div>
        </div>
    </div>
</div>
@endif
@if ($message = Session::get('destroy_user'))
{{-- Suppression d'un utilisateur --}}
<div class="modal d-block" id="modal-success-event">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Information :</h5>
                <button onclick="removeSuccess();" type="button" class="btn-close" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>L'utilisateur a bien été supprimé !</p>
            </div>
            <div class="modal-footer">
                <button onclick="removeSuccess();" type="button" class="btn btn-secondary">Fermer</button>
            </div>
        </div>
    </div>
</div>
@endif
@if ($message = Session::get('update_compte'))
{{-- Modification du compte --}}
<div class="modal d-block" id="modal-success-event">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Information :</h5>
                <button onclick="removeSuccess();" type="button" class="btn-close" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>La modification de vos informations a été enregistré !</p>
            </div>
            <div class="modal-footer">
                <button onclick="removeSuccess();" type="button" class="btn btn-secondary">Fermer</button>
            </div>
        </div>
    </div>
</div>
@endif
