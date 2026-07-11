@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <h2 class="mb-4">
        Create User
    </h2>

    <div class="card shadow">

        <div class="card-body">

            <form action="{{ route('users.store') }}"
                  method="POST">

                @csrf

                <div class="mb-3">

                    <label>Name</label>

                    <input type="text"
                           name="name"
                           class="form-control">

                </div>

                <div class="mb-3">

                    <label>Email</label>

                    <input type="email"
                           name="email"
                           class="form-control">

                </div>

                <div class="mb-3">

                    <label>Password</label>

                    <input type="password"
                           name="password"
                           class="form-control">

                </div>

                <div class="mb-3">

                    <label>Role</label>

                    <select name="role"
                            class="form-control">

                        <option value="admin">
                            Admin
                        </option>

                        <option value="staff">
                            Staff
                        </option>

                    </select>

                </div>

                <button class="btn btn-primary">
                    Save User
                </button>

            </form>

        </div>

    </div>

</div>

@endsection