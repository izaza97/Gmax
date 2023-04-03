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
                            <h5 class="mb-0">package list</h5>
                        </div>
                        <a href="/package-list/create" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp; New Package List</a>
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
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Name
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        package tour
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        quantity
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Price
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
                                @foreach ($PackageList as $packageList)
                                <tr>
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">{{ $packageList->id }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $packageList->name }}</p>
                                    {{-- <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ substr($packageList->desc, 0, 20) }} ...</p>
                                    </td> --}}
                                    <td class="text-center">
                                        @foreach ($packageTour as $packageTour)
                                            @if ($packageTour->id == $packageList->package_tour_id)
                                                <p class="text-xs font-weight-bold mb-0">{{ $packageTour->name }}</p>
                                            @endif
                                        @endforeach
                                        {{-- <p class="text-xs font-weight-bold mb-0">{{ $packageList->facility }}</p> --}}
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $packageList->quantity }}</p>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $packageList->price }}</span>
                                    </td>
                                    <td class="text-center">
                                    <div class="d-flex justify-content-center">
                                        {{-- <div class="me-3">
                                            <a href="{{ route('package-tour.edit', $packageTour->id) }}" class="btn btn-link text-danger p-0 m-0" data-bs-toggle="tooltip" data-bs-original-title="Edit package tour">
                                                <i class="fas fa-user-edit text-secondary"></i>
                                            </a>
                                        </div>
                                        <div>
                                            <form action="{{ route('package-tour.destroy', $packageTour->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link text-danger p-0 m-0" data-bs-toggle="tooltip" data-bs-original-title="Delete package tour">
                                                    <i class="fas fa-trash text-secondary"></i>
                                                </button>
                                            </form>
                                        </div> --}}
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
                                                @endif
                                            </form> --}}
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
                        {{ $PackageList->links("vendor.pagination.bootstrap-4") }}
                    </div>
            </div>
        </div>
    </div>
</div>

@endsection
