@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between mb20">
        <h1 class="title-bar">{{ __('Update Package Information')}}</h1>
    </div>
    @include('admin.message')
    @include('Language::admin.navigation')        
    <div class="lang-content-box">
        <div class="row">           
            <form class="p-4" action="{{ route('user_packages.update', $row->id) }}" method="POST">
                <input type="hidden" name="_method" value="PATCH">
                <input type="hidden" name="lang" value="{{ $lang }}">
            	@csrf
                <div class="form-group">
                    <label class="col-sm-2 col-from-label" for="name">{{translate('Package Name')}}</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" value="{{ $row->getTranslation('name', $lang) }}" placeholder="{{translate('Name')}}" id="name" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-from-label" for="amount">{{translate('Amount')}}</label>
                    <div class="col-sm-10">
                        <input type="number" name="amount" value="{{ $row->amount }}" min="0" step="0.01" placeholder="{{translate('Amount')}}" id="amount" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-from-label" for="item_upload_limit">{{translate('Item Upload Limit')}}</label>
                    <div class="col-sm-10">
                        <input type="number" name="item_upload_limit" value="{{ $row->item_upload_limit }}" min="0" step="1" placeholder="{{translate('Item Upload Limit')}}" id="item_upload_limit" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-from-label" for="commission">{{translate('Commission')}}</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <input type="number" name="commission" value="{{ $row->commission }}" min="0" step=".1" placeholder="{{translate('Eg. 5')}}" id="commission"  class="form-control" required>
                            <div class="input-group-append">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-from-label" for="duration">{{translate('Duration')}}</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <input type="number" name="duration" value="{{ $row->duration }}" min="0" step="1" placeholder="{{translate('Validity in number of days')}}" id="duration" class="form-control" required>
                            <div class="input-group-append">
                                <span class="input-group-text">{{ translate('Days') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 col-form-label" for="signinSrEmail">{{translate('Package Logo')}}</label>
                    <div class="col-md-10">
                        <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="false">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                            </div>
                            <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                            <input type="hidden" name="logo" value="{{ $row->logo }}" class="selected-files">
                        </div>
                        <div class="file-preview box sm">
                        </div>
                    </div>
                </div>
                <div class="form-group mb-0 text-right">
                    <button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
