@extends('layouts.app')
@section('content')

    <form action="{{ route('users.update',  $user->id) }}" method="post">
        @csrf
        @method('put')
        <div class="row mt-4">
            <div class="mb-3 row">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="password" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="password" name="password">
                </div>
            </div>

            <div class="mb-3 row">
                <button type="submit" class="btn btn-warning">Edit User</button>
            </div>
        </div>
    </form>
@endsection
