@extends('layouts.app') {{-- Assuming you have a main layout file --}}
@section('title', __('locale.list_visti'))
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"> {{ __('locale.number_visti').'('.$vistis->id.')' }} </div>

                    <div class="card-body">
                        <div class="mb3">
                            <p>{{ __('locale.doctor_information') }}</p>
                         <table class="table table-striped table-bordered" >
                            <thead>
                           <td>
                            <th scope="col">{{ __('locale.doctor_name') }}</th>
                            <th scope="col">{{ __('locale.phone') }}</th>
                           </td>
                            </thead>
                            <tbody>
                           <td>
                            <td>{{ $vistis->doctor->name }}</td>
                            <td>{{ $vistis->doctor->phone }}</td>
                           </td>
                            </tbody>
                         </table>

                        </div>
                        <div class="mb3">
                            <p>{{ __('locale.delegate_information') }}</p>
                         <table class="table table-striped table-bordered" >
                            <thead>
                           <tr>
                            <th scope="col">{{ __('locale.delegate_name') }}</th>
                            <th scope="col">{{ __('locale.phone') }}</th>
                           </tr>
                            </thead>
                            <tbody>
                           <tr>
                            <td>{{ $vistis->delegate->name }}</td>
                            <td>{{ $vistis->delegate->phone }}</td>
                           </tr>
                            </tbody>
                         </table>
                        </div>
                        <div class="mb3">
                           <p>{{ __('locale.date_time') }} </p>
                         <table class="table table-striped table-bordered" >
                            <thead>
                           <tr>
                            <th scope="col">{{ __('locale.date') }}</th>
                            <th scope="col">{{ __('locale.time') }}</th>
                           </tr>
                            </thead>
                            <tbody>
                           <tr>
                            <td>{{ $vistis->visit_date }}</td>
                            <td>{{ $vistis->visti_time }}</td>
                           </tr>
                            </tbody>
                         </table>
                        </div>
                        <div class="mb3">
                            <p>{{ __('locale.Sample_information') }}</p>
                         <table class="table table-striped table-bordered" >
                            <thead>
                           <tr>
                            <th scope="col"> {{ __('locale.name') }}</th>
                            {{-- <th scope="col"> {{ __('locale.quantity') }}</th> --}}
                            <th scope="col">{{ __('locale.notes') }}</th>
                           </tr>
                            </thead>
                            <tbody>

                           @foreach($vistis->samples as  $sample)
                            <tr>
                            <th>{{ $sample->name }}</th>
                            {{-- <th>{{ $sample->visti_samples->quantity }}</th> --}}
                            {{-- <td>{{ $sample->pivot->quantity }}</td> --}}
                            <td>{{ $sample->pivot->note }}</td>
                            </tr>
                            @endforeach

                            </tbody>
                         </table>
                        </div>



                        <div class="d-grid gap-2">
                            <form action="{{ route('uptata_visti', $vistis->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <input type="hidden" name="id" value="{{ $vistis->id }}">
                                @foreach(\App\Enums\VisitsStatusEnum::cases() as $index => $case)
                                @if($index!=0 )
                                <div class="form-check">
                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        name="status"
                                        id="status_{{ $case->value }}"
                                        value="{{ $case->value }}"
                                        {{ old('status', $vistis->status ?? '') === $case->value ? 'checked' : '' }}
                                    >
                                    <label class="form-check-label" for="status_{{ $case->value }}">
                                        {{ __($case->name) }}
                                    </label>
                                </div>
                                @endif
                            @endforeach

                                <button type="submit" class="btn btn-primary">{{ __('تحديث الزيارة') }}</button>
                                <a href="{{ route('visit.index') }}" class="btn btn-secondary">{{ __('العودة إلى قائمة الزيارات') }}</a>
                            </form>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
