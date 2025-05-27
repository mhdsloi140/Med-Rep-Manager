@extends('layouts.app')
@section('title', 'Cit List')
@section('content')
@if(session('success'))

<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="card-header">
    <form action="{{ route('region.index') }}" method="GET">
        <div class="row">
            <div class="col-md-3">
                <input type="text" name="search" value="{{ request()->search }}" class="form-control" id="search"
                    placeholder="Search" style="background-color: rgb(204, 218, 230)">
            </div>

            <div class="col-md-3">
                <select name="city_id" class="form-select" id="city_id"  aria-label="Floating label select example" style="size: 500px">
                <option selected name>{{ __('locale.city_name') }}</option>
                @foreach($cities as $city)
                <option value="{{ $city->id }}">{{ $city->name }}</option>
                @endforeach
            </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary">{{ __('locale.filter') }}</button>
            </div>
        </div>
    </form>

</div>

<div class="d-flex justify-content-end" style="margin-top: 50px">
    <a href="{{ route('region.create') }}" class="btn btn-primary">{{ __('locale.create') }}</a>
</div>

<div class="card-body" style="margin-top: 50px">
    <div class="row mb-3 admins-div">
        <div class="col-md-12">
            <table class="table table-striped table-bordered" border="1">
                <thead>
                    <tr>
                        <th scope="col">{{ __('locale.id') }}</th>
                        <th scope="col">{{ __('locale.name_region') }}</th>
                        <th scope="col">{{ __('locale.delete') }}</th>
                        <th scope="col">{{ __('locale.update') }}</th>


                    </tr>
                </thead>
                <tbody>
                    @foreach ($regions as $region)
                        <tr>
                            <th scope="row">{{ $region->id }}</th>
                            <td>{{ $region->name }}</td>
                            <td>
                                <form action="{{ route('region.destroy', $region->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">{{ __('locale.delete') }}</button>
                                </form>
                            </td>
                            <td>
                                <a href="{{ route('region.edit', $region->id) }}" class="btn btn-warning">
                                    {{ __('locale.update') }}
                                </a>
                            </td>


                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>


@endsection
