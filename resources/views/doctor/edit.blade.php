@extends('layouts.app')
@section('title', __('locale.update_doctor'))
@section( 'content')

  <h1  style="text-align: center">{{ __('locale.updata_doctor') }}</h1>
<form action="{{ route('doctor.update',$doctor->id) }}" method="POST" id="create-product" enctype="multipart/form-data" >
    @csrf
    @method('put')
    <div class="row"style="margin-top: 80px">
        <div class="col-md-12 mb-4" style="">
            <label for="name " > {{ __('locale.doctor_name') }}</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="{{ __('locale.doctor_name') }}" required style="background-color: white; " value="{{ old('name', $doctor->name) }}">
            @error('name')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-12 mb-4" style="">
            <label for="name " > {{ __('locale.phone') }}</label>
            <input type="text" name="phone" class="form-control" id="name" placeholder="{{ __('locale.phone') }}" required style="background-color: white; " value="{{ old('phone',$doctor->phone) }}">
            @error('phone')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-12 mb-4" style="">
            <label for="image" >{{ __('locale.image') }} </label>
            <input type="file" name="image" class="form-control" id="image" placeholder="{{ __('locale.mage') }}" required style="background-color: white; ">
            @error('image')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-12 mb-3"style="text-align: center;">
            <button type="submit" class="btn btn-primary" >{{ __('locale.update') }}</button>
        </div>

    </div>
</form>

@endsection
