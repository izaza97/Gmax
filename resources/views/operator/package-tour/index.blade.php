@extends('layouts.user_type.auth')

@section('content')

<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">package tour</h5>
                        </div>
                        <a href="/package-tour/create" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp; New Package Tour</a>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        ID
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Photo
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Name
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Description
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        facilitas
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        itinerary
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Creation Date
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($PackageTour as $packageTour)
                                <tr>
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">{{ $packageTour->id }}</p>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="{{ $packageTour->image_path }}" class="avatar avatar-sm me-3">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $packageTour->name }}</p>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ substr($packageTour->desc, 0, 50) }} ...</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $packageTour->facility }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $packageTour->itinerary }}</p>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $packageTour->discount }}</span>
                                    </td>
                                    <td class="text-center">
                                    <div class="d-flex justify-content-center">
                                        <div class="me-3">
                                            <a href="{{ route('package-tour.edit', $packageTour->id) }}" class="btn btn-link text-danger p-0 m-0" data-bs-toggle="tooltip" data-bs-original-title="Edit user">
                                                <i class="fas fa-user-edit text-secondary"></i>
                                            </a>
                                        </div>
                                        <div class="me-3">
                                            <form action="{{ route('package-tour.destroy', $packageTour->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link text-danger p-0 m-0" data-bs-toggle="tooltip" data-bs-original-title="Delete user">
                                                    <i class="fas fa-trash text-secondary"></i>
                                                </button>
                                            </form>
                                        </div>
                                        {{-- <div>
                                            <form action="{{ route('user.status', $user->id) }}" method="POST">
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
                                                @endif --}}
                                            </form>
                                        </div>
                                    </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div>
                    <div class="d-flex justify-content-center">
                        {{ $PackageTour->links("vendor.pagination.bootstrap-4") }}
                    </div>
            </div>
        </div>
    </div>
</div>

@endsection
