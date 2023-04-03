@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Edit Package Tour') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                {{-- Show image in center and two buttons below for upload and delete image --}}
                <div class="d-flex justify-content-center">
                    @foreach ($packageTour->images as $image)
                    <div class="avatar avatar-xl me-3">
                            {{-- <img src="http://localhost:8000/{{ $image->path }}" class="avatar avatar-xl me-3"> --}}
                            <img src="{{ asset($image->path) }}" class="avatar avatar-xl me-3">
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
