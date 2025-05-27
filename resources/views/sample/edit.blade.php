@extends('layouts.app')
@section('title', 'Update Sample')
@section( 'content')
  <h1  style="text-align: center">{{ __('locale.update_sample') }}</h1>
<form action="{{ route('sample.update',$sample->id) }}" method="POST" id="create-product" enctype="multipart/form-data" >
    @csrf
    @method('PUT')
        <div class="row"style="margin-top: 80px">

            @foreach($available_locales as $index => $locale)

            <div class="col-md-12 mb-4" style="">
                <label for="name " > {{ __('locale.name').'('.$locale. ')'}}</label>
                <input type="text" name="{{ $locale }}[name]" class="form-control" id="name_{{ $locale }}"
                value="{{ old($locale.'.name', $sample->translateOrNew($locale)->name) }}"
                placeholder="{{ __('locale.name_lang') }} {{ strtoupper($locale) }}"
                required
                style="background-color: white;">
                @error('name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        <div class="col-md-12 mb-4" style="">
            <label for="description" > {{ __('locale.description').'('.$locale. ')'}}</label>
            <textarea    class="form-control" id="{{ $locale }}_description"  rows="3"   style="background-color: white;"   placeholder="Description" name="{{ $locale }}[description]"
        >{{ old($locale.'.description', $sample->translateOrNew($locale)->description ?? '') }}</textarea>
                    @error('description')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        @endforeach

        <div class="form-floating mb-3">
            <select name="company_id" class="form-select" id="company_id"
                aria-label="Floating label select example">
                <option selected name>{{ __('company_name') }}</option>
                @foreach($companies as $comapny)
                <option value="{{ $comapny->id }}">{{ $comapny->name }}</option>
                @endforeach

            </select>
        </div>
        <div class="col-md-12 mb-4" style="">
            <label for="image" > </label>
            <input type="file" name="image" class="form-control" id="image" placeholder="Sample Image"  style="background-color: white; ">
            @error('image')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>







        <div class="col-md-12 mb-3"style="text-align: center;">
            <button type="submit" class="btn btn-primary" >{{ __('locale.update') }}</button>
        </div>

    </div>
</form>

@endsection
