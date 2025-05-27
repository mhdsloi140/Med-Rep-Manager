@extends('layouts.app')
@section('title', 'Profile Page')
@section('content')






<div class="container" style="background-color: white">
    <h2 class="text-center mb-4"></h2>

    <div class="row">
        <div class="col-md-4">
            <img src="{{ asset('storage/' . $profiles->userable->image) }}" class="img-fluid img-thumbnail" alt="صورة الطبيب">
        </div>
        <div class="col-md-8">
            <ul class="list-group">
                <li class="list-group-item"><strong>{{ __('locale.name') }}</strong> {{ $profiles->userable->name }}</li>
                <li class="list-group-item"><strong>{{ __('locale.phone') }}</strong> {{ $profiles->userable->phone }}</li>
                <li class="list-group-item"><strong>{{ __('locale.email') }}</strong> {{ $profiles->email }}</li>
                {{-- <li class="list-group-item"><strong>الموقع:</strong> <span id="latlng">{{ $doctor->latitude }}, {{ $doctor->longitude }}</span></li> --}}
                <br>

            </ul>
        </div>

    </div>
    <div class="row">
        <form action="{{ route('profile.update',$profiles->id) }}" method="POST" enctype="multipart/form-data" >
            @csrf
            @method('put')
            <input type="hidden" name="user_id" id="" value="{{ $profiles->id }}">
            <div class="row">
                <div class="col-md-12 mb-4" style="">
                    <label for="name " style="margin-top: 80px"> {{ ('locale.password') }}</label>
                    <input type="text" name="name" value="{{ old('name', $profiles->userable->name) }}" class="form-control" id="name" placeholder="{{ ('locale.name') }}" required style="background-color: white; ">
                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-12 mb-3">
                    <label for="name"> {{ __('locale.email') }}</label>
                    <input type="text" name="email" value="{{old('email', $profiles->email)}}" class="form-control" id="email" placeholder="{{ __('locale.email') }}" required style="background-color: white; ">
                    @error('email')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-12 mb-3">
                    <label for="name"> {{ __('locale.phone') }}</label>
                    <input type="text" name="phone" value="{{old('phone', $profiles->userable->phone)}}" class="form-control" id="phone" placeholder="{{ __('locale.phone') }}"  style="background-color: white; ">
                    @error('phone')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-12 mb-3">
                    <label for="passowrd"> {{ __('locale.password') }}</label>
                    <input type="password" name="password" value="{{old('password')}}" class="form-control" id="password" placeholder="{{ __('locale.password') }}"  style="background-color: white; ">
                    @error('phone')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-12 mb-3">
                    <label for="image"> {{ __('locale.image') }}</label>
                    <input type="file" name="image"  class="form-control" id="phone" placeholder="{{ __('locale.image') }}"  style="background-color: white; ">
                    @error('image')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-12 mb-3">
                    <button type="submit" class="btn btn-primary">{{ __('locale.update') }}</button>
                </div>
            </div>
        </form>



    </div>




</div>




@endsection
