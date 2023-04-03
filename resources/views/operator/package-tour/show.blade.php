@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('view Package Tour') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                {{-- Show image in center and two buttons below for upload and delete image --}}
                <div>
                    <p><h2>{{ $PackageTour->name }}</h2></p>
                    @foreach ($PackageTour->images as $image)
                    <div class="avatar avatar-xl me-3">
                            <img src="{{ asset($image->path) }}" class="avatar avatar-xl me-3">
                    </div>
                    @endforeach
                    <p>
                        {!! $PackageTour->desc !!}
                    </p>
                    <p>
                        ~~ Facility ~~
                    </p>
                    <p>
                        {!! $PackageTour->facility !!}
                    </p>
                    <p>
                        {!! $PackageTour->route !!}
                    </p>
                    <p>
                        {!! $PackageTour->discount !!}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
