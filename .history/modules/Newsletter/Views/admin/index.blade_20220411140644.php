@extends('admin.layouts.app')
@section('title','Newsletter')
@section('content')
    <div class="container-fluid">
        <div class="row ">
            <div class="col-md-9 align-items-center">
                <div class="panel">
                    <div class="panel-body">
                        <form class="form-horizontal" action="{{ route('newsletters.send') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>{{ __('Email Users')}}</label>
                                <div class="">
                                    <select class="form-control aiz-selectpicker" name="user_emails[]" multiple data-selected-text-format="count" data-actions-box="true">
                                        @foreach($rows as $row)
                                            <option value="{{$row->email}}">{{$row->email}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>{{ __('Email Subscribers')}}</label>
                                <div class="">
                                    <select class="form-control aiz-selectpicker" name="subscriber_emails[]" multiple data-selected-text-format="count" data-actions-box="true">
                                        @foreach($subscribers as $subscriber)
                                            <option value="{{$subscriber->email}}">{{$subscriber->email}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>{{ __('Subject')}}</label>
                                <input type="text" placeholder="Subject" name="subject" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="control-label">{{ __('Content')}} </label>
                                <div class="">
                                    <textarea name="content" class="d-none has-ckeditor" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                            <div class="form-group mb-0 text-right">
                                <button type="submit" class="btn btn-primary">{{__('Send')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
