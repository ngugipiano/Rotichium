@extends('Email::layout')
@section('content')
    <div class="b-container">
        <div class="b-panel">
            @php
                echo $array['content'];
            @endphp
        </div>
    </div>
@endsection
