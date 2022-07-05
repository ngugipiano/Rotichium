@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between mb20">
        <h1 class="title-bar">{{ __('Update Package Information')}}</h1>
    </div>
    @include('admin.message')
    @include('Language::admin.navigation')
    <div class="col-lg-9">         
    <div class="panel">
        <div class="panel-body">                                     
            <form class="p-4" action="{{ route('user_packages.update', $row->id) }}" method="POST">
                <input type="hidden" name="_method" value="PATCH">
            	@csrf
                <div class="col-md-9">
                    <div class="form-group">
                        <label for="name">{{__('Package Name')}}</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" value="{{ $row->getTranslation('name') }}" placeholder="{{__('Name')}}" id="name" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="amount">{{__('Amount')}}</label>
                        <div class="col-sm-10">
                            <input type="number" name="amount" value="{{ $row->amount }}" min="0" step="0.01" placeholder="{{__('Amount')}}" id="amount" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="item_upload_limit">{{__('Item Upload Limit')}}</label>
                        <div class="col-sm-10">
                            <input type="number" name="item_upload_limit" value="{{ $row->item_upload_limit }}" min="0" step="1" placeholder="{{__('Item Upload Limit')}}" id="item_upload_limit" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="commission">{{__('Commission')}}</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input type="number" name="commission" value="{{ $row->commission }}" min="0" step=".1" placeholder="{{__('Eg. 5')}}" id="commission"  class="form-control" required>
                                <div class="input-group-append">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="duration">{{__('Duration')}}</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input type="number" name="duration" value="{{ $row->duration }}" min="0" step="1" placeholder="{{__('Validity in number of days')}}" id="duration" class="form-control" required>
                                <div class="input-group-append">
                                    <span class="input-group-text">{{ __('Days') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-2 col-form-label" for="signinSrEmail">{{__('Package Logo')}}</label>
                        <div class="col-md-10">
                            <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="false">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ __('Browse')}}</div>
                                </div>
                                <div class="form-control file-amount">{{ __('Choose File') }}</div>
                                <input type="hidden" name="logo" value="{{ $row->logo }}" class="selected-files">
                            </div>
                            <div class="file-preview box sm">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-0 text-right">
                    <button type="submit" class="btn btn-sm btn-primary">{{__('Save')}}</button>
                </div>
            </form>
            </div> 
        </div>
    </div>
</div>

@endsection
