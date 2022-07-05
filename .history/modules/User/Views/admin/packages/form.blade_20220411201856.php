<div class="form-group">
    <label>{{ __('Package Name')}}</label>
    <input type="text" value="{{ $translation->name ?? 'New Post' }}" placeholder="Package Name" name="name" class="form-control">
</div>
<div class="form-group">
    <label>{{ __('Amount')}}</label>
    <input type="number" name="amount" min="0" step="0.01" value="{{ $translation->amount ?? 'New Post' }}" placeholder="Amount" class="form-control">
</div>
<div class="form-group">
    <label>{{ __('Item Upload Limit')}}</label>
    <input type="number" name="item_upload_limit" min="0" step="1" value="{{ $translation->item_upload_limit ?? 'New Post' }}" placeholder="Item Upload Limit" class="form-control">
</div>
<div class="form-group">
    <label>{{ __('Commission')}}</label>
    <input type="number" name="commission" min="0" step=".1" value="{{ $translation->commission ?? 'New Post' }}" placeholder="{{__('Eg. 5')}}" class="form-control">
    <div class="input-group-append">
        <span class="input-group-text">%</span>
    </div>
</div>
<div class="form-group">
    <label>{{ __('Item Upload Limit')}}</label>
    <input type="number" name="duration" min="0" step="1" value="{{ $translation->duration ?? 'New Post' }}" placeholder="{{__('Validity in number of days')}}" class="form-control">
    <div class="input-group-append">
        <span class="input-group-text">{{ __('Days') }}</span>
    </div>
</div>
 