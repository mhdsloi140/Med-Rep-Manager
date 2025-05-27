@extends('layouts.app')
@section('title', __('locale.update_city'))
@section( 'content')
    <h1  style="text-align: center">{{ __('locale.update_city') }}</h1>
<form action="{{ route('city.update',$city->id) }}" method="POST" id="create-product" enctype="multipart/form-data" >
        @csrf
        @method('PUT')
        <div class="row"style="margin-top: 80px">

        @foreach($available_locales as $index => $locale)

        <div class="col-md-12 mb-4" style="">
            <label for="name " > {{ __('locale.name').'('.$locale. ')'}}</label>
            <input type="text" name="{{ $locale }}[name]" class="form-control" id="name_{{ $locale }}"
            value="{{ old($locale.'.name', $city->translateOrNew($locale)->name) }}"
            placeholder="{{ __('locale.name_lang') }}{{ strtoupper($locale) }}"
            required
            style="background-color: white;">
            @error('name')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
           @endforeach


        <div class="col-md-12 mb-3">
            <button type="submit" class="btn btn-primary">{{ __('locale.update') }}</button>
        </div>
        </div>

</form>
@endsection
