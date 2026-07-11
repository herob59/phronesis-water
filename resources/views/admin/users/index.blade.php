@extends('layouts.admin')

@section('content')

<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Users</li>
</ol>

<div class="container-fluid">

    <div class="d-flex justify-content-between mb-4">

        <h2>User Management</h2>

        <a href="{{ route('users.create') }}"
           class="btn btn-primary">

            Add User

        </a>

    </div>

    <div class="card shadow">

        <div class="card-body p-0">

            <table class="table table-bordered mb-0">

                <thead>

                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Date</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($users as $user)

                    <tr>

                        <td>{{ $user->name }}</td>

                        <td>{{ $user->email }}</td>

                        <td>

                            <span class="badge bg-primary">
                                {{ ucfirst($user->role) }}
                            </span>

                        </td>

                        <td>
                            {{ $user->created_at->format('d M Y') }}
                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="4"
                            class="text-center">

                            No users found

                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="card-footer">

            {{ $users->links() }}

        </div>

    </div>

</div>

@endsection