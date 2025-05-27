@extends('layouts.app')

@section('title', __('locale.view_doctor'))

@section('content')
<div class="container" style="background-color: white">
    <h2 class="text-center mb-4">{{ __('locale.date_doctor') }}</h2>

    <div class="row">
        <div class="col-md-4">
            <img src="{{ asset('storage/' . $doctor->image) }}" class="img-fluid img-thumbnail" alt="صورة الطبيب">
        </div>
        <div class="col-md-8">
            <ul class="list-group">
                <li class="list-group-item"><strong>{{ __('locale.name') }}</strong> {{ $doctor->name }}</li>
                <li class="list-group-item"><strong>{{ __('locale.phone') }}</strong> {{ $doctor->phone }}</li>
                <li class="list-group-item"><strong>{{ __('locale.city') }}</strong> {{ $doctor->region->city->name ?? 'غير محددة' }}</li>
                <li class="list-group-item"><strong>{{ __('locale.region') }}</strong> {{ $doctor->region->name ?? 'غير محددة' }}</li>
                {{-- <li class="list-group-item"><strong>الموقع:</strong> <span id="latlng">{{ $doctor->latitude }}, {{ $doctor->longitude }}</span></li> --}}
                <br>
                  
            </ul>
        </div>
     <div class="col-md-8">
    <form action="{{ route('comment.store') }}" method="POST" enctype="multipart/form-data">
        @csrf 
        <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">

        <div class="mb-3">
            <label for="comment">{{ __('locale.add_comment') }}</label>
            <input type="text" name="comment" class="form-control" style="background-color: white" required>
            @error('comment') 
                <span class="text-danger">{{ $message }}</span> 
            @enderror
        </div> 

        <div class="text-center">
            <button type="submit" class="btn btn-primary">{{ __('locale.add_comment') }}</button>
        </div>
    </form>
  </div>
    </div>
   
</div>
@endsection