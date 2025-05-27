@extends('layouts.app')
@section('title', 'create copmany')
@section( 'content')
  <h1  style="text-align: center">{{ __('locale.company_create') }}</h1>
<form action="{{ route('company.store') }}" method="POST"  enctype="multipart/form-data" >
    @csrf
   
    <div class="row"style="margin-top: 80px">
        <div class="col-md-12 mb-4" style="">
            <label for="name " > {{ __('locale.company_name') }}</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="{{ __('locale.company_name') }}" required style="background-color: white; ">
            @error('name')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group" style="margin-bottom: 30px" >
            <label for="description">{{ __('locale.description') }}</label>
            <textarea class="form-control" id="description" name="description" rows="3" style="background-color:white " placeholder="{{ __('locale.description') }}"></textarea>
         </div>



        <div class="col-md-12 mb-3 "style="text-align: center; ">
            <button type="submit" class="btn btn-primary" >{{ __('locale.create') }}</button>
        </div>

    </div>
</form>

@endsection
