@extends('layouts.app')
@section('title', __('locale.create_sample'))
@section( 'content')
  <h1  style="text-align: center">{{ __('locale.create_sample') }}</h1>
<form action="{{ route('sample.store') }}" method="POST" id="create-product" enctype="multipart/form-data">
    @csrf
    <div class="row" style="margin-top: 80px">
        @foreach($available_locales as $locale)
            <div class="col-md-12 mb-4">
                <label>{{ __('locale.name').' ('.$locale.')' }}</label>
                <input type="text" name="{{ $locale }}[name]" class="form-control" value="{{ old($locale.'.name') }}" placeholder="{{ __('locale.sample_name') }}" required style="background-color: white;">
                @error($locale.'.name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-12 mb-4">
                <label>{{ __('locale.description').' ('.$locale.')' }}</label>
                <textarea name="{{ $locale }}[description]" class="form-control" rows="3" style="background-color: white;" placeholder="{{ __('locale.description') }}">{{ old($locale.'.description') }}</textarea>
                @error($locale.'.description')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        @endforeach

        <div class="form-floating mb-3">
            <select name="company_id" class="form-select" id="company_id">
                <option selected disabled>{{ __('locale.company_name') }}</option>
                @foreach($companies as $company)
                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-12 mb-4">
            <label>{{ __('locale.quantity') }}</label>
            <input type="number" name="quantity" class="form-control" placeholder="{{ __('locale.quantity') }}" required style="background-color: white;">
            @error('quantity')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-12 mb-4">
            <label>{{ __('locale.image') }}</label>
            <input type="file" name="image" class="form-control" style="background-color: white;">
            @error('image')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-12 mb-3 text-center">
            <button type="submit" class="btn btn-primary">{{ __('locale.create') }}</button>
        </div>
    </div>
</form>

@endsection
