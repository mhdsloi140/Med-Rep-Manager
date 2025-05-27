@extends('layouts.app')

@section('title', 'Create Doctor')

@section('content')
<div class="container" style="background-color: white">
    <h1 class="text-center">{{ __('locale.crate_doctor') }}</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('doctor.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mt-4">
            <div class="col-md-6 mb-3">
                <label for="name">{{ __('locale.doctor-name') }}</label>
                <input type="text" name="name" class="form-control" style="background-color: white" required>
                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="phone">{{ __('locale.phone') }}</label>
                <input type="text" name="phone" class="form-control" style="background-color: white" required>
                @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="image">{{  __('locale.image')}}</label>
                <input type="file" name="image" class="form-control" style="background-color: white" required>
                @error('image') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="city_id" style="background-color: white">{{ __('locale.choose_city') }} </label>
                <select name="city_id" style="background-color: white" id="city_id" class="form-select" required>
                    <option value="">--{{ __('locale.choose_city') }}--</option>
                    @foreach($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                    @endforeach
                </select>
                @error('city_id') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
               <div class="col-md-6 mb-3">
                <label for="delegate_id" style="background-color: white">{{ __('locale.choose_delegate') }} </label>
                <select name="delegate_id" style="background-color: white" id="delegate_id" class="form-select" required>
                    <option value="">--{{ __('locale.choose_delegate') }}--</option>
                    @foreach($delegates as $delegate)
                        <option value="{{ $delegate->id }}">{{ $delegate->name }}</option>
                    @endforeach
                </select>
                @error('delegate_id')
                <span class="text-danger">{{ $message }}</span>
                 @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="region_id">{{ __('locale.region_name') }}</label>
                <select name="region_id" style="background-color: white" id="region_id" class="form-select" required>
                    <option value="">-- {{ __('locale.choose_region') }}--</option>
                </select>
                @error('region_id') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <input type="hidden" id="latitude" name="latitude">
            <input type="hidden" id="longitude" name="longitude">

            <div class="col-md-12 mb-4">
                <label>{{ __('locale.locate_doctor') }}</label>
                <div id="map-container">
                    {{-- <input id="map-search" class="form-control mb-2" type="text" placeholder="ابحث عن الموقع"> --}}
                    <div id="map" style="height: 400px;"></div>
                </div>
            </div>

            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-primary">{{ __('locale.create') }}</button>
            </div>
        </div>
    </form>
</div>

{{-- Map & AJAX --}}
{{-- @include('doctor.partials.map-script') --}}
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBKIs4mk3qem62afEj4LQjbjbWMiXXSwmQ&libraries=places"></script>
<script>
    let map;
    let marker;

    function initMap() {
        const defaultLocation = { lat: 33.5138, lng: 36.2765 }; // دمشق

        map = new google.maps.Map(document.getElementById("map"), {
            center: defaultLocation,
            zoom: 10,
        });

        // Search Box
        const input = document.getElementById("map-search");
        const searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener("bounds_changed", function () {
            searchBox.setBounds(map.getBounds());
        });

        // Marker placement
        searchBox.addListener("places_changed", function () {
            const places = searchBox.getPlaces();

            if (places.length === 0) return;

            const place = places[0];

            if (!place.geometry || !place.geometry.location) return;

            // Reposition map and place marker
            map.setCenter(place.geometry.location);
            map.setZoom(15);
            placeMarker(place.geometry.location);
        });

        map.addListener("click", function (e) {
            placeMarker(e.latLng);
        });
    }

    function placeMarker(location) {
        if (marker) {
            marker.setPosition(location);
        } else {
            marker = new google.maps.Marker({
                position: location,
                map: map,
            });
        }

        document.getElementById("latitude").value = location.lat();
        document.getElementById("longitude").value = location.lng();
    }

    window.onload = initMap;
</script>

{{-- CSRF Meta --}}
<meta name="csrf-token" content="{{ csrf_token() }}">

{{-- AJAX --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#city_id').on('change', function () {
            let cityId = $(this).val();
            if (cityId) {
                $.ajax({
                    url: '/get-areas/' + cityId,
                    type: 'GET',
                    dataType: 'json',
                    success: function (regions) {
                        $('#region_id').empty().append('<option value="">-- اختر المنطقة --</option>');
                        $.each(regions, function (index, region) {
                            $('#region_id').append('<option value="' + region.id + '">' + region.name + '</option>');
                        });
                    },
                    error: function () {
                        alert('حدث خطأ أثناء تحميل المناطق.');
                    }
                });
            } else {
                $('#region_id').empty().append('<option value="">-- اختر المنطقة --</option>');
            }
        });
    });
</script>
@endsection
