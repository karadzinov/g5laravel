@extends('layouts.dashboard')
@section('content')
    <div class="row">

        <div class="col-4">
            <a href="{{ route('users.create') }}" class="btn btn-primary">Add User</a>
        </div>
    </div>
    <div class="row">

        <div class="col-12">


            <div class="table table-striped">
                <table>
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td><a href="/users/{{ $user->id }}">{{ $user->id }}</a></td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role->name }}</td>
                            <td><a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Edit</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script>

    </script>
@endsection
