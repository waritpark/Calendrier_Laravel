@extends('template')

@section('content')

<table class="table table-striped align-middle table-hover" id="table-stats">
    <caption></caption>
    <thead>
        <tr>
            <th>ID</th>
            <th>Mails</th>
            <th>Noms</th>
            <th>Prénoms</th>
            <th>Roles</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td><?= $user->id; ?></td>
                <td><?= $user->email; ?></td>
                <td><?= $user->name; ?></td>
                <td><?= $user->prenom; ?></td>
                <td><?= $user->role_user; ?></td>
                @if ($user->email != 'arthur@arthur.fr')
                    <td>
                        <a class="btn btn-warning" href="{{ route('edit.user.dashboard', $user->id) }}">Modifier</a>
                        <a class="btn btn-danger" href="{{ route('destroy.user.dashboard', $user->id) }}">Supprimer</a>
                    </td>
                @else
                    <td></td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>

@endsection