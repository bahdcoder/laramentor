@extends('layouts.app')

@section('content')
<div class="grid-container">
    <div class="grid-item grid-item-right mt-3 px-3">
        <vue-request-pool :initial_requests="{{ $mentorshipRequests }}"></vue-request-pool>
        <vue-single-request :auth_id="{{ auth()->id() }}"></vue-single-request>
    </div>
    <div class="grid-item ml-2 grid-item-left">
        <vue-request-filters></vue-request-filters>
    </div>
</div>
@endsection
