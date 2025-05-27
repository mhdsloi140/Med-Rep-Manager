@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ __('locale.create_new_ticket') }}</h1>
        <form action="{{ route('tickets.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="subject" class="form-label">{{ __('locale.title') }}</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">{{ __('locale.description') }}</label>
                <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">{{ __('locale.create_ticket') }}</button>
        </form>
    </div>
@endsection
