@extends('layouts.app')

@section('title', __('locale.doctor_list'))
@section('content')
@if(session('success'))

<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif





<div class="card-body" style="margin-top: 50px">
    <div class="row mb-3 admins-div">
        <div class="col-md-12 text-center">
            <a href="{{ route('doctor.create') }}"  class="btn btn-primary">{{ __('locale.create') }}</a>
        </div>
        <div class="col-md-12">
            <table class="table table-striped table-bordered" b>

                    <tr>
                        <th scope="col">{{ __('locale.id') }}</th>
                        <th scope="col">{{ __('locale.image') }}</th>
                        <th scope="col">{{ __('locale.name') }}</th>
                        <th scope="col">{{ __('locale.phone') }}</th>
                        @can('delete_doctor')
                        <th scope="col">{{ __('locale.status') }}</th>
                        @endcan
                        <th scope="col">{{ __('locale.show') }}</th>
                        @can('update_doctor')
                        <th scope="col"> {{ __('locale.update') }}</th>
                        @endcan
                        <th scope="col"> {{ __('locale.add_comment') }}</th>



                    </tr>
                </thead>
                <tbody>
                    @foreach ($doctors as $doctor)
                        <tr>

                            <th scope="row">{{ $doctor->id }}</th>

                            <td style="width: 80px;height: 80px;"> <img  style="size: 80%; object-fit: cover;"
                                class="img-thumbnail"  src="{{ asset('storage/'. $doctor->image) }}" alt="صورة "></td>

                            <td>{{ $doctor->name }}</td>
                            <td>{{ $doctor->phone }}</td>
                            @can('delete_doctor')
                            <td>
                                <form id="doctor-{{ $doctor->id }}"
                                    action="{{ route('doctor.destroy', $doctor->id) }}"
                                    method="POST">
                                  @csrf
                                  @method('DELETE')

                                  <div class="form-check form-switch">
                                      <input class="form-check-input"
                                             type="checkbox"
                                             id="toggle-{{ $doctor->id }}"
                                             {{ $doctor->deleted_at ? '' : 'checked' }}
                                             onchange="if(confirm('هل أنت متأكد من تغيير حالة الطبيب؟')) this.form.submit();">
                                      <label class="form-check-label" for="toggle-{{ $doctor->id }}">
                                          {{ $doctor->deleted_at ? '' : '' }}
                                      </label>
                                  </div>
                              </form>
                        </td>
                        @endcan
                        <td>
                            <a href="{{ route('doctor.show', $doctor->id) }}" class="btn btn-sm btn-info">{{ __('locale.show') }}</a>
                        </td>
                         @can('update_doctor')
                        <td><a href="{{ route('doctor.edit',$doctor->id) }}" class="btn btn-sm btn-warning">{{ __('locale.update') }}</a></td>
                        @endcan
                        <td>
                            <a href="{{ route('comment.create', $doctor->id) }}" class="btn btn-sm btn-success">
                                {{ __('locale.comment') }}
                            </a>
                        </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

    </div>

</div>
<div class="mt-6">
    {!! $doctors->links() !!}
</div>
</div>

@endsection

