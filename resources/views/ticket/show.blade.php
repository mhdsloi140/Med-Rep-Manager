@extends('layouts.app')
@section('script')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BiKtVeHHrzg+MXQDGLcmjIJzN05SU=" crossorigin="anonymous"></script>
<script src="https://js.pusher.com/8.4.0/pusher.min.js"></script>
<script>
    Pusher.logToConsole = true;

  // var pusher = new Pusher("{{ env('PUSHER_APP_KEY') }}", {
    var pusher = new Pusher("{{ env('PUSHER_APP_KEY') }}", {
                authEndpoint: "{{ url('broadcasting/auth') }}",
                broadcaster: 'pusher',
                forceTLS: true,
                cluster: 'mt1',
                auth: {
                headers: {
                'Authorization': "Bearer {{ csrf_token() }}",
                }
                  }

            });

    var channel = pusher.subscribe('private-ticket-replay.{{ $ticket->id }}');
    channel.bind('new.replay', function(data) {
        console.log('تعليق جديد', data);

        let newComment = $(`
        <li class="list-group-item">
            <strong>${data.user}</strong> <small class="text-muted">${data.created_at}</small><br>
            ${data.message}
        </li>
    `);

    $('ul.list-group').append(newComment);


    });
</script>
@endsection

@section('content')
    <div class="container">
        <h1>التذكرة رقم: {{ $ticket->id }}</h1>
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $ticket->title }}</h5>
                <p class="card-text">{{ $ticket->description }}</p>
                <p class="card-text"><small class="text-muted">تم إنشاؤها في: {{ $ticket->created_at->format('Y-m-d H:i') }}</small></p>
                <p class="card-text">الحالة: {{ $ticket->status }}</p>

                @if (auth()->check() && auth()->user()->is_admin) {{-- مثال لدور المسؤول --}}
                    <form action="{{ route('tickets.updateStatus', $ticket->id) }}" method="POST" class="mt-3">
                        @csrf
                        @method('PATCH')
                        <div class="mb-3">
                            <label for="status" class="form-label">تغيير الحالة</label>
                            <select class="form-select" id="status" name="status">
                                <option value="open" {{ $ticket->status === 'open' ? 'selected' : '' }}>مفتوحة</option>
                                <option value="in_progress" {{ $ticket->status === 'in_progress' ? 'selected' : '' }}>قيد التقدم</option>
                                <option value="closed" {{ $ticket->status === 'closed' ? 'selected' : '' }}>مغلقة</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-sm btn-success">تحديث الحالة</button>
                    </form>
                @endif
            </div>
        </div>

        <h3>{{ __('locale.comments') }}</h3>
        @if ($ticket->ticketReplies->isEmpty())
            <p> {{ __('locale.comment_message') }}   </p>
        @else
            <ul class="list-group mb-3">
                @foreach ($ticket->ticketReplies as $replay)
                    <li class="list-group-item">
                        <strong>{{ $replay->user->name }}</strong> <small class="text-muted">{{ $replay->created_at->format('Y-m-d H:i') }}</small><br>
                        {{ $replay->reply }}
                    </li>
                @endforeach
            </ul>
        @endif

        <h4>{{ __('locale.add_comment') }}</h4>
        <form action="{{ route('replay.store', $ticket->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                <label for="body" class="form-label">{{ __('locale.comment') }}</label>
                <textarea class="form-control" id="reply" name="reply" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary"> {{ __('locale.add_comment') }}</button>
        </form>
    </div>
@endsection
