@extends('layouts.app')
@section('title', __('locale.create_new_region'))
@section( 'content')
  <h1  style="text-align: center">{{ __('locale.create_city') }}</h1>
<form action="{{ route('region.store') }}" method="POST" id="create-product" enctype="multipart/form-data" >
    @csrf
    <div class="row"style="margin-top: 80px">

        @foreach($available_locales as $index => $locale)

        <div class="col-md-12 mb-4" style="">
            <label for="name " > {{ __('locale.name').'('.$locale. ')'}}</label>
            <input type="text" name="{{$locale}}[name])}}" class="form-control" id="name" placeholder="{{ __('locale.region_name') }}" required style="background-color: white; ">
            @error('name')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        @endforeach
        <div class="form-floating mb-3">
            <select name="city_id" class="form-select" id="city_id"
                aria-label="Floating label select example" style="background-color: white">
                <option selected  name>{{ __('locale.city_name') }}</option>
                @foreach($cities as $city)
                <option value="{{ $city->id }}">{{ $city->name }}</option>
                @endforeach

            </select>
        </div>







        <div class="col-md-12 mb-3"style="text-align: center;">
            <button type="submit" class="btn btn-primary" >{{ __('locale.create') }}</button>
        </div>

    </div>
</form>

@endsection
