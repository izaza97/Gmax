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
                    <div class="avatar avatar-xl">
                        <img src="{{ $packageTour->image_path }}" alt="..." class="avatar avatar-xl me-3">
                    </div>
                </div>

                <div class="d-flex justify-content-center mt-3">
                    <div class="btn-group">
                        <form action="{{ route('package-tour.image', $packageTour->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="image" id="image" class="d-none" accept="image/*" onchange="document.getElementById('upload').click()">
                            {{-- Upload button --}}
                            <button type="button" class="btn btn-sm btn-link" onclick="document.getElementById('image').click()">
                                {{ __('Change Avatar') }}
                            </button>
                            {{-- Disable until image inputed --}}
                            <button type="submit" class="d-none" id="upload">
                                {{ __('Upload') }}
                            </button>
                        </form>
                        <span>
                            <form action="{{ route('package-tour.destroyImage', $packageTour->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link text-danger p-0 m-0" data-bs-toggle="tooltip" data-bs-original-title="Delete profil">
                                    <i class="fas fa-trash text-secondary"></i>
                                </button>
                            </form>
                        </span>
                    </div>
                </div>

                <form action="{{ route('user.update', $packageTour->id) }}" method="POST">
                    @csrf
                    @if($errors->any())
                        <div class="mt-3  alert alert-primary alert-dismissible fade show" role="alert">
                            <span class="alert-text text-white">
                            {{$errors->first()}}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="fa fa-close" aria-hidden="true"></i>
                            </button>
                        </div>
                    @endif
                    @if(session('success'))
                        <div class="m-3  alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
                            <span class="alert-text text-white">
                            {{ session('success') }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="fa fa-close" aria-hidden="true"></i>
                            </button>
                        </div>
                    @endif
                    {{-- Name --}}
                    <div class="form-group">
                        <label for="name" class="form-control-label">{{ __('Name') }}</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="{{ __('Name') }}" value="{{ $packageTour->name }}" required>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- Desc --}}
                    <div class="form-group">
                        <label for="desc" class="form-control-label">{{ __('Desc') }}</label>
                        <input type="desc" name="desc" id="desc" class="form-control" placeholder="{{ __('desc') }}" value="{{ $packageTour->desc }}" required>
                        @error('desc')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="facility" class="form-control-label">{{ __('Facility') }}</label>
                        <input type="facility" name="facility" id="facility" class="form-control" placeholder="{{ __('facility') }}" value="{{ $packageTour->facility }}" required>
                        @error('facility')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- Back and Update button --}}
                    <div class="d-flex justify-content-end">
                        <div class="me-3">
                            <a href="{{ route('user-management.index') }}" class="btn bg-gradient-secondary btn-md mt-2 mb-2">{{ __('Back') }}</a>
                        </div>
                        <button type="submit" class="btn bg-gradient-dark btn-md mt-2 mb-2">{{ 'Save Changes' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
