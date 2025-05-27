@extends('layouts.app')

@section('title', __('locale.update_company'))
@section('content')

     <form method="POST" action="{{ route('company.update', $company->id) }}">
    @csrf
    @method('PUT')
    <div class="row"style="margin-top: 80px">
        <div class="col-md-12 mb-4" style="">
            <label for="name " > {{ __('locale.company_name') }}</label>
                <input type="text" name="name" value="{{old('name') ?? $company->name}}" class="form-control" style="background-color:white "   id="name" placeholder="{{ __('locale.name') }}" required>            @error('name')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group" style="margin-bottom: 30px" >
            <label for="description">{{ __('locale.description') }}</label>
            <textarea class="form-control" id="description" name="description" rows="3" style="background-color:white " placeholder="{{ __('locale.description') }}"></textarea>
         </div>



        <div class="col-md-12 mb-3 "style="text-align: center; ">
            <button type="submit" class="btn btn-primary" >{{ __('locale.update') }}</button>
        </div>

    </div>
</form>
@endsection
