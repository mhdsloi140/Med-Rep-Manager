@extends('layouts.app')
@section('title', __('locale.sample_list'))
@section('content')
@if(session('success'))

<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
{{-- create btn --}}
@can('create_sample', )
<div class="d-flex justify-content-end" style="margin-top: 50px">
    <a href="{{ route('sample.create') }}" class="btn btn-primary">{{ __('locale.create') }}</a>
</div>
@endcan
{{-- Search inpute --}}
<form action="{{ route('sample.index') }}" class="d-none d-md-flex ms-4" method="GET">
    <input class="form-control bg-dark border-0" type="search" placeholder="Search" id="search"  name="search"style="width:400px ;height: 40px;"  value="{{ request()->search }}">
    <button type="submit" class="btn btn-primary" style="margin-left: 20px">{{ __('locale.search') }}</button>
</form>
<div class="card-body" style="margin-top: 50px">
    <div class="row mb-3 admins-div">
        <div class="col-md-12">
            <table class="table table-striped table-bordered" >
                <thead>
                    <tr>
                        <th scope="col">{{ __('locale.id') }}</th>
                        <th  scope="col">{{ __('locale.image') }}</th>
                        <th scope="col">{{ __('locale.name') }}</th>
                        <th scope="col">{{ __('locale.quantity') }}</th>
                        @can('update_sample')
                        <th scope="col">{{ __('locale.update') }}</th>
                        @endcan
                        @can('delete_sample', )
                        <th scope="col">{{ __('locale.delete') }}</th>
                        @endcan


                    </tr>
                </thead>
                <tbody>
                    @foreach ($samples as $sample)
                        <tr>

                            <th scope="row">{{ $sample->id }}</th>
                            <td> <img  style="width: 90px; height: 90px; object-fit: cover;"
                                class="img-thumbnail"  src="{{ asset('storage/'. $sample->image) }}" alt="صورة المنتج"></td>
                            <td > <span style="text-align: center">{{ $sample->name }}</span></td>
                            <td><span style="text-align: center">{{ $sample->quantity }}</span></td>
                            @can('update_sample', )
                            <td> <a class="btn btn-outline-warning" href="{{ route('sample.edit',$sample->id) }}">{{ __('locale.update') }}</a></td>
                            @endcan
                            @can('delete_sample')
                            <td><a href="" class="btn btn-outline-danger">{{ __('locale.delete') }}</a></td>
                            @endcan

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>


@endsection
