@php
    $club_point_convert_rate = setting_item('club_point_convert_rate');
@endphp
<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__("Page Search")}}</h3>
        <p class="form-group-desc">{{__('Config page search of your website')}}</p>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-title"><strong>{{__("Convert Point To Wallet")}}</strong></div>
            <div class="panel-body">
                <div class="form-group row">
                    <div class="col-lg-4">
                        <label class="col-from-label">{{'Set Point For '}} {{ format_money(1) }}</label>
                    </div>
                    <div class="col-lg-5">
                        <input type="number" min="0" step="0.01" class="form-control" name="club_point_convert_rate" @if ($club_point_convert_rate != null) value="{{ $club_point_convert_rate }}" @endif placeholder="100" required>
                    </div>
                    <div class="col-lg-3">
                        <label class="col-from-label">{{'Points'}}</label>
                    </div>
                </div>

            </div>
        </div>
        <i class="fs-12"><b>{{ 'Note: You need to activate wallet option first before using club point addon.' }}</b></i>
    </div>
</div>
<hr>

<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__("Disable club points module?")}}</h3>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-title"><strong>{{__("Disable club points module")}}</strong></div>
            <div class="panel-body">
                <div class="form-group">
                    <div class="form-controls">
                    <label><input type="checkbox" name="event_disable" value="1" @if(setting_item('event_disable')) checked @endif > {{__('Yes, please disable it')}}</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

