@extends('layouts.app')
@section('title', 'Company List')
@section('content')
@if(session('success'))

<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<div class="d-flex justify-content-end" style="margin-top: 50px">
    <a href="{{ route('company.create') }}" class="btn btn-primary">{{ __('locale.create') }}</a>
</div>

<div class="card-body" style="margin-top: 50px">
    <div class="row mb-3 admins-div">
        <div class="col-md-12">
            <table class="table table-striped table-bordered" >
                <thead>
                    <tr>
                        <th scope="col">{{ __('locale.id') }}</th>
                        <th scope="col">{{ __('locale.name') }}</th>
                        <th scope="col">{{ __('locale.description') }}</th>
                        @can('delete_company')
                        <th scope="col">{{ __('locale.delete') }}</th>
                        @endcan
                        @can('update_company')
                        <th scope="col">{{ __('locale.update') }}</th>
                        @endcan

                    </tr>
                </thead>
                <tbody>
                    @foreach ($companies as $company)
                        <tr>
                            <th scope="row">{{ $company->id }}</th>
                            <td>{{ $company->name }}</td>
                            <td>{{ $company->description }}</td>
                            @can('delete_company')
                            <th>
                                <form action="{{ route('company.destroy',$company->id) }}" method="POST">
                                    @csrf
                                     @method('DELETE')
                                    <button type="submit" class="btn btn-danger">{{ __('locale.delete') }}</button>
                                </form>
                            </th>
                            @endcan
                           @can('update_company')
                            <th>
                                <a href="{{ route('company.edit', $company->id) }}" class="btn btn-warning">
                                    {{ __('locale.update') }}
                                </a>
                            </th>
                           @endcan




                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>


@endsection
