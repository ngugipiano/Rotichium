<div class="form-group">
    <label>{{ __('Package Name')}}</label>
    <input type="text" value="{{ $translation->name ?? 'New Post' }}" placeholder="Package Name" name="name" class="form-control">
</div>
<div class="form-group">
    <label>{{ __('Amount')}}</label>
    <input type="number" name="amount" value="{{ $translation->amount ?? 'New Post' }}" placeholder="Amount" class="form-control">
</div>
<div class="form-group">
    <label>{{ __('Item Upload Limit')}}</label>
    <input type="number" name="item_upload_limit" value="{{ $translation->item_upload_limit ?? 'New Post' }}" placeholder="Item Upload Limit" class="form-control">
</div>

 