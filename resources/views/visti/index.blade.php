@extends('layouts.app')
@section('title', __('locale.view_visti'))
@section('content')
@if(session('success'))

<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
    @can('create_visti')
    <div class="d-flex justify-content-end" style="margin-top: 50px">
        <a href="{{ route('visit.create') }}" class="btn btn-primary">{{ __('locale.create') }}</a>
    </div>
    @endcan
<div class="card-header">
    <form action="{{ route('visit.index') }}" method="GET">
        <div class="row">


            <div class="col-md-4">
                <select name="city_id" class="form-select" id="city_id"   aria-label="Floating label select example" style="size: 500px ;background-color: rgb(204, 218, 230)">
                <option value="" >{{ __('locale.city_name') }}</option>
                    @foreach($cities as $city)
                    <option value="{{ $city->id }}" {{ isset($filters['city_id']) && $filters['city_id'] == $city->id ? 'selected' : '' }}>
                        {{ $city->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
            <select name="region_id" class="form-select" id="region_id"   aria-label="Floating label select example" style="size: 500px ;background-color: rgb(204, 218, 230)">
                <option value="">{{ __('locale.region_name') }}</option>
                @foreach($regions as $region)
                <option value="{{ $region->id }}" {{ isset($filters['region_id']) && $filters['region_id'] == $region->id ? 'selected' : '' }}>
                    {{ $region->name }}
                </option>
                @endforeach
            </select>
            </div>
            <div class="col-md-4">
                <select name="delegate_id" class="form-select" id="delegate_id"   aria-label="Floating label select example" style="size: 500px ;background-color: rgb(204, 218, 230)">
                    <option value="">{{ __('locale.delegate_name') }}</option>
                    @foreach($delegates as $delegate)
                    <option value="{{ $delegate->id }}" {{ isset($filters['delegate_id']) && $filters['delegate_id'] == $delegate->id ? 'selected' : '' }}>
                        {{ $delegate->name }}
                    </option>
                   @endforeach
                </select>
            </div>
            <br>
            <div class="col-md-4" style="margin-top: 20px">
                <select name="doctor_id" class="form-select" id="doctor_id"   aria-label="Floating label select example" style="size: 500px ;background-color: rgb(204, 218, 230)">
                    <option value="">{{ __('locale.doctor_name') }}</option>
                    @foreach($doctors as $doctor)
                    <option value="{{ $doctor->id }}" {{ isset($filters['doctor_id']) && $filters['doctor_id'] == $doctor->id ? 'selected' : '' }}>
                        {{ $doctor->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <a href="{{ route('visit.index') }}" class="btn btn-outline-secondary" style="margin-top: 20px; margin-left: 10px">
                {{ __('locale.clear_filters') }}
            </a>

            <div class="col-md-8"  style="margin-top: 20px; margin-left: 10px">
                <button type="submit" class="btn btn-outline-success" >Filter</button>
            </div>
        </div>
    </form>

</div>
<div class="card-body" style="margin-top: 50px">
    <div class="row mb-3 admins-div">
        <div class="col-md-10">
            <table class="table table-striped table-bordered" >
                <thead>
                    <tr>
                        <th scope="col">{{ __('locale.id') }}</th>

                        <th scope="col">{{ __('locale.doctor_name') }}</th>
                        <th scope="col">{{ __('locale.visti_date') }}</th>
                        <th scope="col">{{ __('locale.visti_time') }}</th>
                        <th scope="col">{{ __('locale.status') }}</th>

                        <th scope="col">{{ __('locale.delegate_name') }}</th>
                        <th scope="col">{{ __('locale.show') }}</th>
                        @can('delete_visti')
                        <th scope="col">{{ __('locale.delete') }}</th>
                        @endcan

                    </tr>
                </thead>
                <tbody>
                    @foreach ($visits as $visit)
                        <tr>
                            <th scope="row">{{ $visit->id }}</th>


                            <td>{{ $visit->doctor->name }}</td>
                            <td>{{ $visit->visit_date }}</td>
                            <td>{{ $visit->visti_time }}</td>
                            <td class="">{{ $visit->status->name }}</td>
                            <td>{{ $visit->delegate->name }}</td>
                            <td><a class="btn btn-outline-info m-" href="{{ route('visit.show',$visit->id) }}" role="button">{{ __('locale.show') }}</a></td>
                            @can('delete_visti')
                            <td>
                                <form action="{{ route('visit.destroy', $visit->id) }}" method="POST" >
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger">{{ __('locale.delete') }}</button>
                                </form>
                            </td>
                            @endcan

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>


@endsection
