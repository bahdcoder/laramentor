@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <vue-request-pool :initial_requests="{{ $mentorshipRequests }}"></vue-request-pool>
            <vue-single-request :auth_id="{{ auth()->id() }}"></vue-single-request>
        </div>
    </div>
</div>
@endsection
