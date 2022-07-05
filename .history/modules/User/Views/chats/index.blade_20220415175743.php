@extends('admin.layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <form class="" id="chat_list" action="" method="GET">
                <div class="card-header row gutters-5">
                    <div class="col text-center text-md-left">
                        <h5 class="mb-md-0 h6">{{__('Chat Lists')}}</h5>
                    </div>
                    <div class="col-md-3">
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
            </form>
            <div class="card-body">
                <table class="table aiz-table mb-0">
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
                        @foreach($rows as $key => $row)
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
                    </tbody>
                </table>
                <div class="aiz-pagination aiz-pagination-center">
                    {{ $rows->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('modal')
    @include('admin.partials.delete_modal')
@endsection
