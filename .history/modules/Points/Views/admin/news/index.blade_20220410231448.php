@extends('admin.layouts.app')
@section('title','News')
@section('content')
    <div class="container-fluid">
        @include('admin.message')
        <div class="filter-div d-flex justify-content-between ">
            <div class="col-left">
                @if(!empty($rows))
                    <form method="post" action="{{route('news.admin.bulkEdit')}}"
                          class="filter-form filter-form-left d-flex justify-content-start">
                        {{csrf_field()}}
                        <select name="action" class="form-control">
                            <option value="">{{__(" Bulk Actions ")}}</option>
                            <option value="delete">{{__(" Delete ")}}</option>
                        </select>
                        <button data-confirm="{{__("Do you want to delete?")}}" class="btn-info btn btn-icon dungdt-apply-form-btn" type="button">{{__('Apply')}}</button>
                    </form>
                @endif
            </div>
        </div>
        <div class="text-right">
            <p><i>{{__('Found :total items',['total'=>$rows->total()])}}</i></p>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-body">
                        <form action="" class="bravo-form-item">
                            <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th width="30px"><input type="checkbox" class="check-all"></th>
                                    <th width="200px"> {{ __('User Name')}}</th>
                                    <th width="130px"> {{ __('Points')}}</th>
                                    <th width="100px"> {{ __('Convert Status')}}</th>
                                    <th width="100px">{{  __('Earned At')}}</th>
                                    <th width="100px"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($rows->total() > 0)
                                    @foreach($rows as $row)
                                        <tr>
                                            <td>
                                                <input type="checkbox" class="check-item" name="ids[]" value="{{$row->id}}">
                                            </td>
                                            <td>{{$row->user->name ?? '' }}</td>
                                            <td>{{ $row->points }}</td>
                                            <td>
                                                @if ($row->convert_status == 1)
                                                  <span class="badge badge-inline badge-success">{{translate('Converted')}}</span>
                                                @else
                                                  <span class="badge badge-inline badge-info">{{translate('Pending')}}</span>
                                                @endif
                                            </td>
                                            <td> {{ display_date($row->created_at)}}</td>
                                            <td>
                                                <a href="{{route('points.admin.edit',['id'=>$row->id])}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> {{__('Edit')}}</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6">{{__("No data")}}</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                            </div>
                        </form>
                        {{$rows->appends(request()->query())->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
