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
                                                <th>{{ 'Title' }}</th>
                                                <th data-breakpoints="lg">{{ 'Owner'}}</th>
                                                <th data-breakpoints="lg">{{ 'Price'}}</th>
                                                <th data-breakpoints="lg">{{ 'Point'}}</th>
                                                <th>{{ 'Options'}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($rows->total() > 0)
                                                @foreach ($rows as $row)
                                                    <tr>
                                                        <td>
                                                            <input type="checkbox" class="check-item" name="ids[]" value="{{$row->id}}">
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('space.detail', $row->slug) }}" target="_blank">
                                                                <div class="form-group row">
                                                                    @if($image_url = get_file_url($row->image_id, 'thumb'))
                                                                    <div class="thumb">
                                                                        <img src="https://bookingcore.test/uploads/demo/space/space-10.jpg" alt="Image" class="thumb">

                                                                    </div>
                                                                    @endif
                                                                    {{--  <div class="col-auto">
                                                                        {!! get_image_tag($row->image_id,'thumb',['class'=>'','alt'=>$row->title]) !!}
                                                                     <img src="{!! \Modules\Media\Helpers\FileHelper::fieldUpload('image_id',$row->thumbnail_img) !!}"
                                                                            alt="Image" class="size-50px">
                                                                    </div>  --}}
                                                                    <div class="col">
                                                                        <span
                                                                            class="text-muted text-truncate-2">{{ $row->title}}</span>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            @if(!empty($row->author))
                                                                {{$row->author->getDisplayName()}}
                                                            @else
                                                                {{__("[Author Deleted]")}}
                                                            @endif
                                                        </td>
                                                        <td>{{ number_format($row->price, 2) }}</td>
                                                        <td>{{ $row->earn_point }}</td>
                                                        <td>
                                                            <a href="{{route('space.admin.edit',['id'=>$row->id])}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> {{__('Edit')}}
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="6">{{ __('No data')}}</td>
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
                        <div class="panel-title"><strong>{{ __('Set Point for Property Within a Range')}}</strong></div>
                        <div class="panel-body">
                            <div class="mb-3 text-muted">
                                <small>{{ 'Set any specific point for those properties what are between Min-price and Max-price. Min-price should be less than Max-price'}}</small>
                            </div>
                            <form action="{{route('points.admin.item_point.store',['id'=>($row->id) ? $row->id : '-1','lang'=>request()->query('lang')])}}" method="post" class="dungdt-form">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label class="col-from-label">{{'Set Point for multiple properties'}}</label>
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="number" min="0" step="0.01" class="form-control" name="point" placeholder="100" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label class="col-from-label">{{'Min Price'}}</label>
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="number" min="0" step="0.01" class="form-control" name="min_price" value="{{ \Modules\Space\Models\Space::min('price')}}" placeholder="50" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label class="col-from-label">{{'Max Price'}}</label>
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="number" min="0" step="0.01" class="form-control" name="max_price" value="{{ \Modules\Space\Models\Space::max('price')}}" placeholder="110" required>
                                    </div>
                                </div>
                                <div class="form-group mb-0 text-right">
                                    <button type="submit" class="btn btn-sm btn-primary">{{'Save'}}</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
