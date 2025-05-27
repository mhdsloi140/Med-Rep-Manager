@extends('layouts.app')
@section('title', 'Admin List')
@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="d-flex justify-content-end">
    <a href="{{ route('delegate.create') }}" class="btn btn-primary">{{__('locale.create') }}</a>
</div>

        <div class="card-body">
            <div class="row mb-3 admins-div">
                <div class="col-md-10">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">{{ __('locale.id') }}</th>
                                <th scope="col">{{ __('locale.image') }}</th>
                                <th scope="col">{{ __('locale.name') }}</th>
                                <th scope="col">{{ __('locale.email') }}</th>
                                <th scope="col">{{ __('locale.phone') }}</th>
                                <td scope="col">##</td>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($delegates as $delegate)
                            <tr>
                                <td>{{ $delegate->id }}</td>
                                   <td>....</td>
                                <td>{{$delegate->name  }}</td>
                                <td>{{ $delegate->email }}</td>
                                <td>{{ $delegate->userable->phone ?? '-' }}</td>
                               <td>
                                <form
                                    action="{{ route('delegate.destroy', $delegate->id) }}"
                                    method="POST">
                                  @csrf
                                  @method('DELETE')

                                  <div class="form-check form-switch">
                                      <input class="form-check-input"
                                             type="checkbox"
                                             id="toggle-{{ $delegate->id }}"
                                             {{ $delegate->deleted_at ? '' : 'checked' }}
                                             onchange=" this.form.submit();">
                                      <label class="form-check-label" for="toggle-{{ $delegate->id }}">
                                          {{ $delegate->deleted_at ? '' : '' }}
                                      </label>
                                  </div>
                              </form>
                        </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
<div class="mt-6">
    {!! $delegates->links() !!}
</div>
        </div>
    @endsection
