@extends('admin.layouts.app')
@section('title','User Chats')
@section('content')
    <div class="container-fluid">
        @include('admin.message')
        <div class="filter-div d-flex justify-content-between ">
            <div class="col-left">
                <h1 class="title-bar">{{__("User Chats")}}</h1>
            </div>
            <div class="col-left">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="{{ __('Search by Name') }}" name="search" @isset($sort_search) value="{{ $sort_search }}" @endisset>
                    <div class="input-group-append">
                        <button class="btn btn-light" type="submit">
                            <i class="las la-search la-rotate-270"></i>
                        </button>
                    </div>
                </div>
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
                                        <th>#</th>
                                        <th>{{__('Guest')}}</th>
                                        <th>{{__('Host')}}</th>
                                        <!-- <th data-breakpoints="md">{{__('Chat Status')}}</th> -->
                                        <!-- <th data-breakpoints="md">{{__('Blocked by')}}</th> -->
                                        <th data-breakpoints="md">{{__('Chat Started')}}</th>
                                        <th class="text-right">{{__('Options')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if($rows->total() > 0)
                                    @foreach($rows as $row)
                                    <tr>
                                        <td>{{ ($key+1) + ($rows->currentPage() - 1)*$rows->perPage() }}</td>
                                        @if ($row->sender != null)
                                            <td>
                                                {{$row->sender->name}}
                                            </td>
                                        @else
                                            <td>
                                                {{__('Not Found')}}
                                            </td>
                                        @endif

                                        @if ($row->receiver != null)
                                            <td>
                                                {{$row->receiver->name}}
                                            </td>
                                        @else
                                            <td>
                                                {{__('Not Found')}}
                                            </td>
                                        @endif
                                        <!-- @if ($row->active != 0)
                                            <td>
                                                <span class="badge badge-primary badge-inline">{{__('Active')}}</span>
                                            </td>
                                        @else
                                            <td>
                                                <span class="badge badge-danger badge-inline">{{__('Blocked')}}</span>
                                            </td>
                                        @endif -->
                                        <!-- @if ($row->blocked_by_user != null)
                                            <td>
                                                {{$row->blocked_by->name}}
                                            </td>
                                        @else
                                            <td>
                                                <span class="badge badge-secondary badge-inline">{{__('Running')}}</span>
                                            </td>
                                        @endif -->
                                        <td>
                                            {{$row->created_at}}
                                        </td>
                                        <td class="text-right">
                                            @can ('single user chat details')
                                                <a href="{{ route('chat_details_for_admin', encrypt($row->id)) }}" class="btn btn-sm btn-icon btn-circle btn-soft-primary" title="{{ __('Edit') }}">
                                                    <i class="las la-eye"></i>
                                                </a>
                                            @endcan
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
