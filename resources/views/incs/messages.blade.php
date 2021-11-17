@if ($message = Session::get('update'))
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