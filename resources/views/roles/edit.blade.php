@extends('layouts.app')

@section('css')
<!--Internal  Font Awesome -->
<link href="{{ URL::asset('assets/plugins/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
<!--Internal  treeview -->
<link href="{{ URL::asset('assets/plugins/treeview/treeview-rtl.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('title', 'تعديل الصلاحيات')

@section('content')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">الصلاحيات</h4>
            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل الصلاحيات</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>خطأ!</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}
<div class="row">
    <div class="col-md-12">
        <div class="card mg-b-20">
            <div class="card-body">
                <div class="main-content-label mg-b-5">
                    <div class="form-group">
                        <p>اسم الصلاحية :</p>
                        {!! Form::text('name', null, ['placeholder' => 'Name','class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <ul id="treeview1">
                            <li><a href="#">الصلاحيات</a>
                                <ul>
                                    <li>
                                        @foreach($permission as $value)
                                            <label>
                                                {{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions), ['class' => 'name']) }}
                                                {{ $value->name }}
                                            </label>
                                            <br />
                                        @endforeach
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-main-primary">تحديث</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
@endsection

@section('js')
<!-- Internal Treeview js -->
<script src="{{ URL::asset('assets/plugins/treeview/treeview.js') }}"></script>
@endsection
