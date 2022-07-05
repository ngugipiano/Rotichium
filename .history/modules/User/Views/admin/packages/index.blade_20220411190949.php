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
            <div class="panel-body">
                @foreach ($row as $key => $user_package)
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <div class="card">
                            <div class="card-body text-center">
                                <img alt="{{ translate('Package Logo')}}" src="{{ custom_asset($user_package->logo) }}" class="mw-100 mx-auto mb-4" height="150px">
                                <p class="mb-3 h6 fw-600">{{ $user_package->getTranslation('name') }}</p>
                                <p class="h4">{{format_price($user_package->amount)}}</p>
                                <p class="fs-15">{{translate('Item Upload Limit') }}:
                                    <b class="text-bold">{{$user_package->item_upload_limit}}</b>
                                </p>
                                <p class="fs-15">{{translate('Commission') }}:
                                    <b class="text-bold">{{$user_package->commission}}%</b>
                                </p>
                                <p class="fs-15">{{translate('Package Duration') }}:
                                    <b class="text-bold">{{$user_package->duration}} {{translate('days')}}</b>
                                </p>
                                <div class="mar-top">
                                    <a href="{{route('user_packages.edit', ['id'=>$user_package->id, 'lang'=>env('DEFAULT_LANGUAGE')] )}}" class="btn btn-sm btn-info">{{translate('Edit')}}</a>
                                    <a href="#" data-href="{{route('user_packages.destroy', $user_package->id)}}" class="btn btn-sm btn-danger confirm-delete">{{translate('Delete')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach                
            </div>
        </div>
    </div>
@endsection
