@extends('template')

@section('content')
<div class="height-body container mt-4">
    <h2 class="color-green fw-bold mb-4">Administration</h2>
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
                            <a class="a-img-day-event btn bg-color-yellow me-2" href="{{ route('edit.user.dashboard', $user->id) }}"><img class="img-day-event" src="{{ asset('images/edit.png') }}" alt="edit"></a>
                            <a class="a-img-day-event btn bg-color-red" href="{{ route('destroy.user.dashboard', $user->id) }}"><img class="img-day-event" src="{{ asset('images/trash.png') }}" alt="trash"></a>
                        </td>
                    @else
                        <td></td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
