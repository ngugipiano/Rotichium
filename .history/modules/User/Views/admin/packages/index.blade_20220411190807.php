@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar">{{ __('All User Packages')}}</h1>
            <div class="title-actions">
                <a href="{{route('user.admin.create')}}" class="btn btn-primary">{{ __('Add new Package')}}</a>                
            </div>
        </div>
        @include('admin.message')        
        <div class="panel">
            <div class="panel-body">
                
            </div>
        </div>
    </div>
@endsection
