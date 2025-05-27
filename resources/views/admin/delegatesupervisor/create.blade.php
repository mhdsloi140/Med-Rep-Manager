@extends('layouts.app')
@section('title', __('locale.create_delegatesupervisor'))
@section( 'content')
  <h1  style="text-align: center">{{ __('locale.create_delegatesupervisor') }}</h1>
<form action="{{ route('delegateSupervisor.store') }}" method="POST"  enctype="multipart/form-data" >
    @csrf
    <div class="row">
        <div class="col-md-12 mb-4" style="">
            <label for="name " style="margin-top: 80px"> {{ __('locale.name') }}</label>
            <input type="text" name="name"  class="form-control" id="name" placeholder="{{ __('locale.name') }}" required style="background-color: white; ">
            @error('name')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-12 mb-3">
            <label for="name"> {{ __('locale.email') }}</label>
            <input type="text" name="email" class="form-control" id="email" placeholder="{{ __('locale.email') }}" style="background-color: white"  required>
            @error('email')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        {{-- <div class="col-md-12 mb-3">
            <label for="name"> Password</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
            @error('email')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div> --}}
        <div class="col-md-12 mb-3">
            <label for="name"> {{ __('locale.phone') }}</label>
            <input type="text" name="phone"  class="form-control" id="phone" style="background-color: white"  placeholder="{{ __('locale.phone') }}" required>
            @error('phone')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
           <div class="col-md-12 mb-4" style="">
            <label for="image" > </label>
            <input type="file" name="image" class="form-control" id="image" placeholder="Doctor Image"  style="background-color: white; ">
            @error('image')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>


             <div class="row mg-b-20">
           <div class="col-xs-12 col-md-12">
            <div class="form-group" >
                 <label class="form-lable" for="">{{ __('locale.user-permissions') }}</label>
            {!! Form::select('roles[]', $roles, [], ['class' => 'form-control', 'multiple' => true, 'id' => 'roles']) !!}
            </div>

           </div>

       </div>






        <div class="col-md-12 mb-3">
            <button type="submit" class="btn btn-primary">{{ __('locale.create') }}</button>
        </div>
    </div>
</form>

@endsection
