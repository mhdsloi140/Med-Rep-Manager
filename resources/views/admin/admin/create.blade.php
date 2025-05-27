@extends('layouts.app')


@section( 'content')
  <h1  style="text-align: center">{{ __('locale.crate_admin') }}</h1>
<form action="{{ route('admin.store') }}" method="POST" id="create-product" enctype="multipart/form-data" >
    @csrf
    <div class="row">
        <div class="col-md-12 mb-4" style="">
            <label for="name " style="margin-top: 80px"> {{ __('locale.name') }}</label>
            <input type="text" name="name" value="{{old('name')}}" class="form-control" id="name" placeholder="{{ __('locale.name') }}" required style="background-color: white; ">
            @error('name')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-12 mb-3">
            <label for="name"> {{ __('locale.email') }}</label>
            <input type="text" name="email" value="{{old('email')}}" class="form-control" id="email" placeholder="{{ __('locale.email') }}" required>
            @error('email')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-12 mb-3">
            <label for="name"> {{ __('locale.password') }}</label>
            <input type="password" name="password" value="{{old('password')}}" class="form-control" id="password" placeholder="{{ __('locale.password') }}" required>
            @error('email')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-12 mb-3">
            <label for="name"> {{ __('locale.phone') }}</label>
            <input type="text" name="phone" value="{{old('phone')}}" class="form-control" id="phone" placeholder="{{ __('locale.phone') }}" required>
            @error('phone')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>







        <div class="col-md-12 mb-3">
            <button type="submit" class="btn btn-primary">{{ __('locale.create') }}</button>
        </div>
    </div>
</form>

@endsection
