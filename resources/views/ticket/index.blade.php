@extends('layouts.app')
@section('script')
<script src="https://js.pusher.com/8.4.0/pusher.min.js"></script>
<script>
    Pusher.logToConsole = true;

    var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
        cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
        encrypted: true
    });

    var channel = pusher.subscribe('tickets-list');
    channel.bind('new.ticket', function(data) {
        console.log('تم إنشاء تذكرة جديدة:', data);

        let newRow = $(`
                 <tr class="table-success">
                    <td>${data.id}</td>
                    <td>${data.title}</td>
                    <td>${data.status ?? 'جديد'}</td>
                    <td>${data.created_at}</td>
                    <td><a href="${data.view_url}" class="btn btn-sm btn-info">عرض</a></td>
                </tr>
`);

$('tbody').prepend(newRow);

setTimeout(() => {
    newRow.removeClass('table-success');
}, 3000);
    });
</script>
@endsection

@section('content')
     <div class="container">
     <h1>{{ __('locale.myticket') }}</h1>
     <a href="{{ route('tickets.create') }}" class="btn btn-primary mb-3">{{ __('locale.create_ticket') }}</a>

     @if ($tickets->isEmpty())
        <p>{{ __('locale.ticket_message') }}</p>
     @else
         <table class="table">
                    <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('locale.subject') }}</th>
                                <th>{{ __('locale.status') }}</th>
                                <th> {{ __('locale.created_at') }}</th>
                                <th></th>
                            </tr>
                   </thead>
                    <tbody>
                        @foreach ($tickets as $ticket)
                            <tr>
                                  <td>{{ $ticket->id }}</td>
                                  <td>{{ $ticket->title }}</td>
                                  <td>{{ $ticket->status }}</td>
                                  <td>{{ $ticket->created_at->format('Y-m-d H:i') }}</td>
                                  <td><a href="{{ route('tickets.show', $ticket->id) }}" class="btn btn-sm btn-info">عرض</a></td>
                             </tr>
                    @endforeach
                    </tbody>
         </table>
  @endif
 </div>
@endsection
