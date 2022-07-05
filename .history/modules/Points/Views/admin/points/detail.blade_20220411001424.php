@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        @include('admin.message')
        @include('Language::admin.navigation')
        <div class="lang-content-box">
            <div class="row">
                <div class="col-md-9">
                    <div class="panel">
                        <div class="panel-body">
                            <form action="" class="bravo-form-item">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th width="30px"><input type="checkbox" class="check-all"></th>
                                                <th>{{ translate('Name') }}</th>
                                                <th data-breakpoints="lg">{{ translate('Owner') }}</th>
                                                <th data-breakpoints="lg">{{ translate('Price') }}</th>
                                                <th data-breakpoints="lg">{{ translate('Point') }}</th>
                                                <th>{{ translate('Options') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($rows->total() > 0)
                                                @foreach ($rows as $row)
                                                    <tr>
                                                        <td>
                                                            <a href="{{ route('space', $row->slug) }}" target="_blank">
                                                                <div class="form-group row">
                                                                    <div class="col-auto">
                                                                        <img src="{{ custom_asset($row->thumbnail_img) }}"
                                                                            alt="Image" class="size-50px">
                                                                    </div>
                                                                    <div class="col">
                                                                        <span
                                                                            class="text-muted text-truncate-2">{{ $row->getTranslation('name') }}</span>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            @if ($row->user != null)
                                                                {{ $row->user->name }}
                                                            @endif
                                                        </td>
                                                        <td>{{ number_format($row->unit_price, 2) }}</td>
                                                        <td>{{ $row->earn_point }}</td>
                                                        <td class="text-right">
                                                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm"
                                                                href="{{ route('item_club_point.edit', encrypt($row->id)) }}"
                                                                title="{{ translate('Edit') }}">
                                                                <i class="las la-edit"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="6">{{ __('No data') }}</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                            {{ $rows->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="panel">
                        <div class="panel-title"><strong>{{ __('Publish') }}</strong></div>
                        <div class="panel-body">
                            @if (is_default_lang())
                                <div>
                                    <label><input @if ($row->status == 'publish') checked @endif type="radio"
                                            name="status" value="publish"> {{ __('Publish') }}
                                    </label>
                                </div>
                                <div>
                                    <label><input @if ($row->status == 'draft') checked @endif type="radio"
                                            name="status" value="draft"> {{ __('Draft') }}
                                    </label>
                                </div>
                            @endif
                            <div class="text-right">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i>
                                    {{ __('Save Changes') }}</button>
                            </div>
                        </div>
                    </div>

                    @if (is_default_lang())
                        <div class="panel">
                            <div class="panel-body">
                                <div class="form-group">
                                    <label>{{ __('Category') }} </label>
                                    <select name="cat_id" class="form-control">
                                        <option value="">{{ __('-- Please Select --') }} </option>
                                        <?php
                                        $traverse = function ($categories, $prefix = '') use (&$traverse, $row) {
                                            foreach ($categories as $category) {
                                                $selected = '';
                                                if ($row->cat_id == $category->id) {
                                                    $selected = 'selected';
                                                }
                                                printf("<option value='%s' %s>%s</option>", $category->id, $selected, $prefix . ' ' . $category->name);
                                                $traverse($category->children, $prefix . '-');
                                            }
                                        };
                                        $traverse($categories);
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label"> {{ __('Tag') }}</label>
                                    <div class="">
                                        <input type="text" data-role="tagsinput" value="{{ $row->tag }}"
                                            placeholder="{{ __('Enter tag') }}" name="tag" class="form-control tag-input">
                                        <br>
                                        <div class="show_tags">
                                            @if (!empty($tags))
                                                @foreach ($tags as $tag)
                                                    <span class="tag_item">{{ $tag->name }}<span
                                                            data-role="remove"></span>
                                                        <input type="hidden" name="tag_ids[]" value="{{ $tag->id }}">
                                                    </span>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (is_default_lang())
                        <div class="panel">
                            <div class="panel-body">
                                <h3 class="panel-body-title"> {{ __('Feature Image') }}</h3>
                                <div class="form-group">
                                    {!! \Modules\Media\Helpers\FileHelper::fieldUpload('image_id', $row->image_id) !!}
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
