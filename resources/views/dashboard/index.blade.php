@extends('layouts.app')
@section('title', 'Dashboard Page')
@section('content')
@if(session('success'))

<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-4">
             @if(auth()->user()->userable_type != 'App\Models\Delegate')
            <div class="bg-secondary text-center rounded p-4">
                <h6 class="mb-2">{{ __('locale.total_visti') }}</h6>
                <h2 class="text-light">{{ $totalVisits }}</h2>
            </div>
            <br>
            <div class="bg-secondary text-center rounded p-4">
                <h6 class="mb-2">{{ __('locale.doctors') }}</h6>
                <h2 class="text-light">{{ $doctor }}</h2>
            </div>
            <br>
            <div class="bg-secondary text-center rounded p-4">
                <h6 class="mb-2">{{ __('locale.delegates') }}</h6>
                <h2 class="text-light">{{ $delegate }}</h2>
            </div>
            @endif
            <br>
            @if(auth()->user()->userable_type == 'App\Models\Delegate')
                    <div class="bg-secondary text-center rounded p-4">
                        <h6 class="mb-2">{{ __('locale.your_visti') }}</h6>
                        <h2 class="text-light">{{ $vistidelegatetoday }}</h2>
                    </div>
                    <br>
                      <div class="bg-secondary text-center rounded p-4">
                        <h6 class="mb-2">{{ __('locale.your_doctor') }}</h6>

                        <h2 class="text-light">{{ $doctorcount }}</h2>
                    </div>
                    <br>
                    <div class="bg-secondary text-center rounded p-4">
                        <h6 class="mb-2">{{ __('locale.your_visti_done') }}</h6>
                        <h2 class="text-light">{{ $vistidone }}</h2>
                    </div>
            @endif
        </div>

     @if(auth()->user()->userable_type != 'App\Models\Delegate')
        <div class="col-sm-12 col-xl-8">
            <div class="bg-secondary rounded h-100 p-4">
                {{-- <h6 class="mb-4">نسبة الزيارات اليومية (آخر 7 أيامخ)</h6> --}}
                <canvas id="visitsChart" height="100"></canvas>
                <canvas id="visitChart"></canvas>
            </div>
        </div>
        @endif
    </div>
</div>
  {{-- <div class="bg-secondary text-center rounded p-4" style="margin-top: 20px">
             <table class="table table-bordered">
    <thead>
        <tr>
            <th>{{ __('locale.doctor') }}</th>
            <th>{{ __('locale.number-visti') }} </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($visitsPerDoctor as $visit)
            <tr>
                <td>{{ $visit->doctor->name ?? 'غير معروف' }}</td>
                <td>{{ $visit->total }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
</div> --}}

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('visitsChart').getContext('2d');

    const visitsChart = new Chart(ctx, {
        type: 'bar', // يمكنك تغييره إلى 'line' إذا أردت
        data: {
            labels: @json($labels), // الأيام
            datasets: [{
                label: 'عدد الزيارات (تمت)',
                data: @json($counts), // عدد الزيارات لكل يوم
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
                borderRadius: 5
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'عدد الزيارات'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'اليوم'
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const value = context.parsed.y;
                            const index = context.dataIndex;
                            const percentage = @json($percentages)[index];
                            return `عدد الزيارات: ${value} (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });
</script>





@endsection


