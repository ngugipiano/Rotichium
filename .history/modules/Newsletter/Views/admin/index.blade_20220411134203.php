@extends('admin.layouts.app')
@section('title','Newsletter')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar">{{__("All news")}}</h1>
            <div class="title-actions">
                <a href="{{route('news.admin.create')}}" class="btn btn-primary">{{__("Add new Post")}}</a>
            </div>
        </div>
    </div>
@endsection
