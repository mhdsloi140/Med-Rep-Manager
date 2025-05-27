@extends('layouts.app')
@section('title', 'Cit List')
@section('content')
@if(session('success'))

<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<div class="d-flex justify-content-end" style="margin-top: 50px">
    <a href="{{ route('city.create') }}" class="btn btn-primary">{{ __('locale.create') }}</a>
</div>

<div class="card-body" style="margin-top: 50px">
    <div class="row mb-3 admins-div">
        <div class="col-md-12">
            <table class="table table-striped table-bordered" border="1">
                <thead>
                    <tr>
                        <th scope="col">{{ __('locale.id') }}</th>
                        <th scope="col">{{ __('locale.name') }}</th>
                        <th scope="col">{{ __('locale.delete') }}</th>
                        <th scope="col">{{ __('locale.update') }}</th>


                    </tr>
                </thead>
                <tbody>
                    @foreach ($cities as $city)
                        <tr>
                            <th scope="row">{{ $city->id }}</th>

                            <td>{{ $city->name }}</td>
                            <td>
                                <form action="{{ route('city.destroy', $city->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">{{ __('locale.delete') }}</button>
                                </form>
                            </td>
                             <td>
                                <a href="{{ route('city.edit', $city->id) }}" class="btn btn-warning">
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
