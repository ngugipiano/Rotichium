@extends('admin.layouts.app')

@section('content')
<div class="aiz-titlebar mt-2 mb-3">
    <h5 class="mb-0 h6">{{translate('Update Package Information')}}</h5>
</div>

<div class="col-lg-10 mx-auto">
    <div class="card">
        <div class="card-body p-0">
            <ul class="nav nav-tabs nav-fill border-light">
                @foreach (\Modules\Settings\Entities\Language::all() as $key => $language)
                    <li class="nav-item">
                        <a class="nav-link text-reset @if ($language->code == $lang) active @else bg-soft-dark border-light border-left-0 @endif py-3" href="{{ route('user_packages.edit', ['id'=>$package->id, 'lang'=> $language->code] ) }}">
                            <img src="{{ my_asset('assets/img/flags/'.$language->code.'.png') }}" height="11" class="mr-1">
                            <span>{{ $language->name }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
            <form class="p-4" action="{{ route('user_packages.update', $package->id) }}" method="POST">
                <input type="hidden" name="_method" value="PATCH">
                <input type="hidden" name="lang" value="{{ $lang }}">
            	@csrf
                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">{{translate('Package Name')}}</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" value="{{ $package->getTranslation('name', $lang) }}" placeholder="{{translate('Name')}}" id="name" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="amount">{{translate('Amount')}}</label>
                    <div class="col-sm-10">
                        <input type="number" name="amount" value="{{ $package->amount }}" min="0" step="0.01" placeholder="{{translate('Amount')}}" id="amount" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="item_upload_limit">{{translate('Item Upload Limit')}}</label>
                    <div class="col-sm-10">
                        <input type="number" name="item_upload_limit" value="{{ $package->item_upload_limit }}" min="0" step="1" placeholder="{{translate('Item Upload Limit')}}" id="item_upload_limit" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="commission">{{translate('Commission')}}</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <input type="number" name="commission" value="{{ $package->commission }}" min="0" step=".1" placeholder="{{translate('Eg. 5')}}" id="commission"  class="form-control" required>
                            <div class="input-group-append">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="duration">{{translate('Duration')}}</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <input type="number" name="duration" value="{{ $package->duration }}" min="0" step="1" placeholder="{{translate('Validity in number of days')}}" id="duration" class="form-control" required>
                            <div class="input-group-append">
                                <span class="input-group-text">{{ translate('Days') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label" for="signinSrEmail">{{translate('Package Logo')}}</label>
                    <div class="col-md-10">
                        <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="false">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                            </div>
                            <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                            <input type="hidden" name="logo" value="{{ $package->logo }}" class="selected-files">
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
