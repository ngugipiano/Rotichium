<div class="form-group">
    <label>{{ __('Package Name')}}</label>
    <input type="text" value="{{ $translation->title ?? 'New Post' }}" placeholder="Package Name" name="name" class="form-control">
</div>
<div class="form-group">
    <label>{{ __('Amount')}}</label>
    <input type="number" name="amount" value="{{ $translation->title ?? 'New Post' }}" placeholder="Amount" class="form-control">
</div>
<div class="form-group">
    <label>{{ __('Title')}}</label>
    <input type="text" value="{{ $translation->title ?? 'New Post' }}" placeholder="News title" name="title" class="form-control">
</div>

 