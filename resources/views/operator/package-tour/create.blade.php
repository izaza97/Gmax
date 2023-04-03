@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Create Package Tour') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="{{ route('package-tour.store') }}" method="POST" enctype="multipart/form-data">
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
                    {{-- Description --}}
                    <div class="form-group">
                        <label for="desc" class="form-control-label">{{ __('Description') }}</label>
                        <textarea type="textarea" id="desc" class="ckeditor form-control" placeholder="{{ __('desciption') }}" value="{{ old('desc') }}" required name="desc"></textarea>
                        @error('desc')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- facility --}}
                    <div class="form-group">
                        <label for="facility" class="form-control-label">{{ __('Facility') }}</label>
                        <textarea type="facility" name="facility" id="facility" class="ckeditor form-control" placeholder="{{ __('Facility') }}" value="{{ old('facility') }}"></textarea>
                        @error('facility')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- route --}}
                    <div class="form-group">
                        <label for="route" class="form-control-label">{{ __('Route') }}</label>
                        <input type="text" name="route" id="route" class="form-control" placeholder="{{ __('Route') }}" value="{{ old('route') }}">
                        @error('route')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- discount --}}
                    <div class="form-group">
                        <label for="discount" class="form-control-label">{{ __('Discount') }}</label>
                        <input type="text" name="discount" id="discount" class="form-control" placeholder="{{ __('Discount') }}" value="{{ old('discount') }}">
                        @error('discount')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- foto --}}
                    <div class="mb-3">
                        <label for="images" class="form-label">Foto</label>
                        <input type="file" class="form-control" id="images" name="images[]" multiple>
                        @error('images')
                            <div class="alert alert-danger">{{ $message }}</div>
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
