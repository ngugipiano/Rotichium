@extends('admin.layouts.app')
@section('title','Newsletter')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-body">
                        <form class="form-horizontal" action="{{ route('newsletters.send') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label class="col-sm-2 col-from-label" for="name">{{__('Emails')}} ({{__('Users')}})</label>
                                <div class="col-sm-10">
                                    <select class="form-control aiz-selectpicker" name="user_emails[]" multiple data-selected-text-format="count" data-actions-box="true">
                                        @foreach($users as $user)
                                            <option value="{{$user->email}}">{{$user->email}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-from-label" for="name">{{__('Emails')}} ({{__('Subscribers')}})</label>
                                <div class="col-sm-10">
                                    <select class="form-control aiz-selectpicker" name="subscriber_emails[]" multiple data-selected-text-format="count" data-actions-box="true">
                                        @foreach($subscribers as $subscriber)
                                            <option value="{{$subscriber->email}}">{{$subscriber->email}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-from-label" for="subject">{{__('Newsletter subject')}}</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="subject" id="subject" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-from-label" for="name">{{__('Newsletter content')}}</label>
                                <div class="col-sm-10">
                                    <textarea rows="8" class="form-control aiz-text-editor" data-buttons='[["font", ["bold", "underline", "italic"]],["para", ["ul", "ol"]], ["insert", ["link", "picture"]],["view", ["undo","redo"]]]' name="content" required></textarea>
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
