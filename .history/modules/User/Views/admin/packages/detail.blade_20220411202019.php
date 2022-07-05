@extends('admin.layouts.app')

@section('content')
    <form action="{{route('user_packages.store',['id'=>($row->id) ? $row->id : '-1','lang'=>request()->query('lang')])}}" method="post" class="dungdt-form">
        <div class="container-fluid">
            <div class="d-flex justify-content-between mb20">
                <div class="">
                    <h1 class="title-bar">{{$row->id ? __('Edit package: ').$row->name : __('Add new Package')}}</h1>                    
                </div>                
            </div>
            @include('admin.message')
            @include('Language::admin.navigation')
            <div class="lang-content-box">
                <div class="row">
                    <div class="col-md-9">
                        <div class="panel">
                            <div class="panel-title"><strong>{{ __('Package Content')}}</strong></div>
                            <div class="panel-body">
                                @csrf
                                @include('User::admin/packages/form',['row'=>$row])
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </form>
@endsection
