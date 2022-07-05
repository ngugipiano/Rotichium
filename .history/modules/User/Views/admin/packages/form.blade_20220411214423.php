<div class="form-group">
    <label>{{ __('Package Name')}}</label>
    <input type="text" value="{{ $translation->name ?? '' }}" placeholder="Package Name" name="name" class="form-control">
</div>
<div class="form-group">
    <label>{{ __('Amount')}}</label>
    <input type="number" name="amount" min="0" step="0.01" value="{{ $translation->amount ?? '' }}" placeholder="Amount" class="form-control">
</div>
<div class="form-group">
    <label>{{ __('Item Upload Limit')}}</label>
    <input type="text" name="item_upload_limit" min="0" step="1" value="{{ $translation->item_upload_limit ?? '' }}" placeholder="Item Upload Limit" class="form-control">
</div>
<div class="form-group">
    <label>{{ __('Commission')}}</label>
    <div class="input-group">
        <input type="number" name="commission" min="0" step=".1" value="{{ $translation->commission ?? '' }}" placeholder="{{__('Eg. 5')}}" class="form-control">
        <div class="input-group-append">
            <span class="input-group-text">%</span>
        </div>
    </div>
</div>
<div class="form-group">
    <label>{{ __('Duration')}}</label>
    <div class="input-group">
        <input type="number" name="duration" min="0" step="1" value="{{ $translation->duration ?? '' }}" placeholder="{{__('Validity in number of days')}}" class="form-control">
        <div class="input-group-append">
            <span class="input-group-text">{{ __('Days') }}</span>
        </div>
    </div>
</div>
 