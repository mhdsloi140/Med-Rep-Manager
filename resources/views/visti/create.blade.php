@extends('layouts.app') {{-- Assuming you have a main layout file --}}
@section('title',__('locale.create_new_visit'))
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-14">
                <div class="card">
                    <div class="card-header">{{ __('locale.create_new_visit') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('visit.store') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="doctor_id" class="form-label">{{ __('locale.doctor_name') }}</label>
                                <select style="background-color: white" id="doctor_id" class="form-select @error('doctor_id') is-invalid @enderror" name="doctor_id" required>
                                    <option value=""> {{ __('locale.select_doctor') }} </option>
                                    @foreach ($doctors as $doctor)
                                        <option value="{{ $doctor->id }}">{{ $doctor->name}}</option>
                                    @endforeach
                                </select>
                                @error('doctor_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="delegate_id" class="form-label">{{ __('locale.delegate_name') }}</label>
                                <select style="background-color: white" id="delegate_id" class="form-select @error('delegate_id') is-invalid @enderror" name="delegate_id" required>
                                    <option value="">  {{ __('locale.select_delegate') }} </option>
                                    @foreach ($delegates as $delegate)
                                        <option value="{{ $delegate->id }}">{{ $delegate->name}}</option>
                                    @endforeach
                                </select>
                                @error('delegate_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="region_id" class="form-label">{{ __('locale.region_name') }}</label>
                                <select style="background-color: white" id="region_id" class="form-select @error('region_id') is-invalid @enderror" name="region_id" required>
                                    <option value="">{{ __('locale.select_region') }}</option>
                                    @foreach ($regions as $region)
                                        <option value="{{ $region->id }}">{{ $region->name }}</option>
                                    @endforeach
                                </select>
                                @error('region_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label for="visit_date" class="form-label">{{ __('locale.viste_data') }}</label>
                                <input style="background-color: white" id="visit_date" type="date" class="form-control @error('visit_date') is-invalid @enderror" name="visit_date" value="{{ old('visit_date') }}" required>
                                @error('visit_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="visti_time" class="form-label">{{__('locale.viste_time') }}</label>
                                <input style="background-color: white" id="visti_time" type="time" class="form-control "name="visti_time" value="{{ old('visit_time') }}">
                                @error('visti_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="note" class="form-label"> {{ __('locale.notes') }}</label>
                                <textarea style="background-color: white" id="note" class="form-control @error('note') is-invalid @enderror" name="note">{{ old('note') }}</textarea>
                                @error('note')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">{{ __('الأدوية/العينات') }}</label>
                                <table class="table table-striped table-bordered" >
                                    <thead>
                                   <tr>
                                    <th scope="col">{{ __('locale.check') }}</th>
                                    <th scope="col"> {{ __('locale.sample_name') }}</th>
                                    {{-- <th scope="col"> Quantity</th> --}}
                                    <th scope="col">{{ __('locale.notes') }}</th>
                                   </tr>
                                    </thead>
                                    <tbody>

                                   @foreach($samples as  $sample)
                                    <tr>
                                    <th><input class="form-check-input" type="checkbox" name="sample_ids[]" value="{{ $sample->id }}" id="sample_{{ $sample->id }}"></th>
                                    <th>{{ $sample->name }}</th>
                                    {{-- <th>{{ $sample->visti_samples->quantity }}</th> --}}
                                    {{-- <td><input class="form-control" style="background-color: white" type="number" name="sample_quantities[{{ $sample->id }}]" ></td> --}}
                                    <td><input class="form-control" style="background-color: white" type="text" name="sample_notes[{{ $sample->id }}]" ></td>
                                    </tr>
                                    @endforeach

                                    </tbody>
                                 </table>

                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">{{ __('locale.crate_visti') }}</button>
                                <a href="{{ route('visit.index') }}" class="btn btn-secondary">{{ __('locale.back_visti_main') }}</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
