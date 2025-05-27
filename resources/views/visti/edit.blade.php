@extends('layouts.app')
@section('title', 'Cit List')
@section('content')





  <h1  style="text-align: center">{{ __('locale.visitadd') }}</h1>
<form action="{{ route('visti.update') }}" method="POST" id="create-product" enctype="multipart/form-data" >
    @csrf
    @method('PUT')
  
</form>



@endsection
