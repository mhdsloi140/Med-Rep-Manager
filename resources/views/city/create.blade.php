@extends('layouts.app')
@section( 'content')
  <h1  style="text-align: center">{{ __('locale.create_city') }}</h1>
<form action="{{ route('city.store') }}" method="POST" id="create-product" enctype="multipart/form-data" >
    @csrf
    <div class="row"style="margin-top: 80px">

        @foreach($available_locales as $index => $locale)

        <div class="col-md-12 mb-4" style="">
            <label for="name " > {{ __('locale.name').'('.$locale. ')'}}</label>
            <input type="text" name="{{$locale}}[name])}}" class="form-control" id="name" placeholder="{{ __('locale.city_name') }}" required style="background-color: white; ">
            @error('name')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        @endforeach







        <div class="col-md-12 mb-3"style="text-align: center;">
            <button type="submit" class="btn btn-primary" >{{ __('locale.create') }}</button>
        </div>

    </div>
</form>

@endsection
