@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar">{{ __('All User Packages')}}</h1>
            <div class="title-actions">
                <a href="{{route('user_packages.create')}}" class="btn btn-primary">{{ __('Add new Package')}}</a>                
            </div>
        </div>
        @include('admin.message')        
        <div class="panel">
            <div class="row">
                @foreach ($rows as $key => $user_package)
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <div class="card">
                            <div class="card-body text-center">
                                <img alt="{{ __('Package Logo')}}" src=" " class="mw-100 mx-auto mb-4" height="150px">
                                <p class="mb-3 h6 fw-600">{{ $user_package->getTranslation('name') }}</p>
                                <p class="h4">{{format_money($user_package->amount)}}</p>
                                <p class="fs-15">{{__('Item Upload Limit') }}:
                                    <b class="text-bold">{{$user_package->item_upload_limit}}</b>
                                </p>
                                <p class="fs-15">{{__('Commission') }}:
                                    <b class="text-bold">{{$user_package->commission}}%</b>
                                </p>
                                <p class="fs-15">{{__('Package Duration') }}:
                                    <b class="text-bold">{{$user_package->duration}} {{__('days')}}</b>
                                </p>
                                <div class="mar-top">
                                    <a href="{{route('user_packages.edit', ['id'=>$user_package->id, 'lang'=>env('DEFAULT_LANGUAGE')] )}}" class="btn btn-sm btn-info">{{__('Edit')}}</a>
                                    <a href="#" data-href="{{route('user_packages.destroy', $user_package->id)}}" class="btn btn-sm btn-danger confirm-delete">{{__('Delete')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach                
            </div>
        </div>
    </div>
@endsection
