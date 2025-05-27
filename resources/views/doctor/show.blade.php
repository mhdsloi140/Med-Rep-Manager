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
                <ul class="list-group">
                    @foreach($vistis as $visti)
                    <li class="list-group-item"><strong>{{ __('lcoale.visti_id') }} :</strong>{{ $visti->id }}</li>
                    <li class="list-group-item"><strong>{{ __('locale.visti_date') }}</strong>{{$visti->visit_date }} </li>
                    <li class="list-group-item"><strong>{{ __('locale.visti_time') }}</strong>{{ $visti->visit_time }} </li>

                    @endforeach
              </ul>
              @if($comments->count() > 0) 
             
                @foreach($comments as $comment)
                <ul class="list-group">
                    <li class="list-group-item"><strong>{{ __('locale.comment') }}:</strong>{{ $comment->comment }} </li>
                    <li class="list-group-item"><strong>{{ __('locale.delegate_name') }}:</strong>{{ $comment->delegate->name }} </li>

                </ul>
                @endforeach
                
              @endif
            </ul>
        </div>
        <div class="col-md-8" style="ma">


        </div>
    </div>



    <div class="mt-4">
        <h5> {{ __('locale.location_doctor') }}</h5>
        <div id="map" style="height: 400px;"></div>
    </div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBKIs4mk3qem62afEj4LQjbjbWMiXXSwmQ&libraries=places"></script>
<script>
    function initMap() {
        const doctorLocation = {
            lat: parseFloat("{{ $doctor->latitude }}"),
            lng: parseFloat("{{ $doctor->longitude }}")
        };

        const map = new google.maps.Map(document.getElementById('map'), {
            center: doctorLocation,
            zoom: 14
        });

        new google.maps.Marker({
            position: doctorLocation,
            map: map,
            title: "{{ $doctor->name }}"
        });
    }

    window.onload = initMap;
</script>
@endsection
