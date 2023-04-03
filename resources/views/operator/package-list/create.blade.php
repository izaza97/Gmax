@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Create Package Tour') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="{{ route('package-list.store') }}" method="POST" enctype="multipart/form-data">
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
                        <input type="text" name="name" id="name" class="form-control" placeholder="{{ __('Name') }}" value="{{ old('name') }}" required>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- Name --}}
                    <div class="form-group">
                        <label for="package_tour_id" class="form-control-label">{{ __('package-tour') }}</label>
                        <select class="form-control" name="package_tour_id" id="package_tour_id">
                            @foreach ($packageTour as $packageTour)
                                <option value="{{ $packageTour->id }}">{{ $packageTour->name }}</option>
                            @endforeach
                        </select>
                        @error('package_tour_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- quantity --}}
                    <div class="form-group">
                        <label for="quantity" class="form-control-label">{{ __('quantity') }}</label>
                        <input type="number" name="quantity" id="quantity" class="ckeditor form-control" placeholder="{{ __('quantity') }}" value="{{ old('quantity') }}">
                        @error('quantity')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- price --}}
                    <div class="form-group">
                        <label for="price" class="form-control-label">{{ __('price') }}</label>
                        <input type="number" name="price" id="price" class="form-control" placeholder="{{ __('price') }}" value="{{ old('price') }}">
                        @error('price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- Back and Update button --}}
                    <div class="d-flex justify-content-end">
                        <div class="me-3">
                            <a href="{{ route('package-tour.index') }}" class="btn bg-gradient-secondary btn-md mt-2 mb-2">{{ __('Back') }}</a>
                        </div>
                        <button type="submit" class="btn bg-gradient-dark btn-md mt-2 mb-2">{{ 'Add package tour' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
