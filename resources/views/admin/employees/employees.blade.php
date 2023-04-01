@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">All Employees</h5>
                        </div>
                        <form action="{{ route('employees.index') }}" method="GET">
                            <div class="input-group-sm">
                                {{-- Submit when enter pressed --}}
                                <input type="text" name="search" class="form-control" placeholder="Search . . ." value="{{ request()->query('search') }}" onkeypress="if(event.keyCode == 13) { event.preventDefault(); this.form.submit(); }">
                            </div>
                        </form>
                        <a href={{ route('employees.create') }} class="btn btn-primary btn-sm">+&nbsp;Add Employee</a>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Author</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Function</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Employed</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>
                                <div class="d-flex px-2 py-1">
                                    <div>
                                        <img src="{{ $user->image_path }}" class="avatar avatar-sm me-3">
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">{{ $user->name }}</h6>
                                    <p class="text-xs text-secondary mb-0">{{ $user->email }}</p>
                                    </div>
                                </div>
                                </td>
                                <td>
                                <p class="text-xs font-weight-bold mb-0">{{ str($user->getRoleNames()[0])->title() }}</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                @if ($user->is_active == '1')
                                <span class="badge badge-sm bg-gradient-success">ACTIVE</span>
                                @elseif ($user->is_active == '0')
                                <span class="badge badge-sm bg-gradient-danger">INACTIVE</span>
                                @endif
                                </td>
                                <td class="align-middle text-center">
                                <span class="text-secondary text-xs font-weight-bold">{{ $user->created_at }}</span>
                                </td>
                                <td>
                                <div class="d-flex justify-content-center">
                                    <div class="me-3">
                                        <a href="{{ route('employees.edit', $user->id) }}" class="btn btn-link text-danger p-0 m-0" data-bs-toggle="tooltip" data-bs-original-title="Edit user">
                                            <i class="fas fa-user-edit text-secondary"></i>
                                        </a>
                                    </div>
                                    <div class="me-3">
                                        <span>
                                            <form action="{{ route('employees.destroy', $user->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link text-danger p-0 m-0" data-bs-toggle="tooltip" data-bs-original-title="Delete user">
                                                    <i class="fas fa-trash text-secondary"></i>
                                                </button>
                                            </form>
                                        </span>
                                    </div>
                                    <div>
                                        <span>
                                            <form action="{{ route('employees.status', $user->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                @if ($user->is_active == 1)
                                                <button type="submit" class="btn btn-link text-danger p-0 m-0" data-bs-toggle="tooltip" data-bs-original-title="Change status">
                                                    <i class="fas fa-toggle-on text-secondary"></i>
                                                </button>
                                                @elseif ($user->is_active == 0)
                                                <button type="submit" class="btn btn-link text-danger p-0 m-0" data-bs-toggle="tooltip" data-bs-original-title="Change status">
                                                    <i class="fas fa-toggle-off text-secondary"></i>
                                                </button>
                                                @endif
                                            </form>
                                        </span>
                                    </div>
                                </div>
                            </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- Pagination to the right --}}
                <div class="d-flex justify-content-end mx-4">
                    {{ $users->links('vendor.pagination.bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection
