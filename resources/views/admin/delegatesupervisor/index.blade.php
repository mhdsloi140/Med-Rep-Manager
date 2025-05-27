@extends('layouts.app')
@section('title', __('locale.supervisor_list'))
@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@can('create_supervisor')

<div class="d-flex justify-content-end" style="margin-top: 20px">
    <a href="{{ route('delegateSupervisor.create') }}" class="btn btn-primary">{{ __('locale.create') }}</a>
</div>
@endcan

        <div class="card-body">
            <div class="row mb-3 admins-div">
                <div class="col-md-12">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                    <th scope="col">{{ __('locale.id') }}</th>
                                    <th scope="col">{{ __('locale.image') }}</</th>
                                    <th scope="col">{{ __('locale.name') }}</th>
                                    <th scope="col">{{ __('locale.email') }}</</th>
                                    <th scope="col">{{ __('locale.phone') }}</</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($supervisors as $supervisor)
                                <tr>
                                    <th scope="row">{{ $supervisor->id }}</th>
                                    {{-- @dd( $supervisor->getFirstMediaUrl('image') ) --}}
                                    <td><img src="{{ $supervisor->getFirstMediaUrl('image') }}" alt="Image" /></td>
                                    <td>{{ $supervisor->name }}</td>
                                    <td>{{ $supervisor->email  }}</td>
                                    <td >{{ $supervisor->userable->phone }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    @endsection
