@extends('layouts.app')

@section('title', __('locale.view_roles'))


@section('content')
<!-- breadcrumb -->
{{-- <div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">المستخدمين</h4>
            <span class="text-muted mt-1 tx-13 mr-2 mb-0"> / صلاحيات المستخدمين</span>
        </div>
    </div>
</div> --}}
<!-- breadcrumb -->



@if (session()->has('Add'))
    <script>
        window.onload = function () {
            notif({ msg: " تم اضافة الصلاحية بنجاح", type: "success" });
        };
    </script>
@endif

@if (session()->has('edit'))
    <script>
        window.onload = function () {
            notif({ msg: " تم تحديث بيانات الصلاحية بنجاح", type: "success" });
        };
    </script>
@endif

@if (session()->has('delete'))
    <script>
        window.onload = function () {
            notif({ msg: " تم حذف الصلاحية بنجاح", type: "error" });
        };
    </script>
@endif

<div class="row row-sm">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-right">
                            @can('create_role')
                                <a class="btn btn-primary btn-sm" href="{{ route('roles.create') }}">{{ __('locale.create') }}</a>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mg-b-0 text-md-nowrap table-hover ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('locale.name') }}</th>
                                <th>{{ __('locale.operations') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $key => $role)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        @can('view_permission')
                                            <a class="btn btn-success btn-sm"
                                               href="{{ route('roles.show', $role->id) }}">{{ __('locale.show') }}</a>
                                        @endcan

                                        @can('update_permission')
                                            <a class="btn btn-warning btn-sm"
                                               href="{{ route('roles.edit', $role->id) }}">{{ __('locale.update') }}</a>
                                        @endcan

                                        @if ($role->name !== 'owner')
                                            @can('delete_permission')
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id], 'style' => 'display:inline']) !!}
                                                {!! Form::submit('حذف', ['class' => 'btn btn-danger btn-sm']) !!}
                                                {!! Form::close() !!}
                                            @endcan
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- تأكد من وجود الروابط في حالة التصفح --}}
                    {{ $roles->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
