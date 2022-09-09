<div class="car-view3-wrapper">
    <div class="car-view1 clearfix">
    <figure>@if (isset($dealer->image))
        <img src="{{Storage::url($dealer->profile_path)}}" alt="{{$dealer->name}}" class="img-responsive">
        @else
        <img src="{{url('images/car-placeholder.png')}}" alt="{{$dealer->name}}" class="img-responsive">
        @endif
    </figure>
    <div class="caption dealer">
        <div class="top-info clearfix">
        <div class="info1">
            <div class="txt1">{{$dealer->name}}</div>
            <div class="txt2">
                Document {{$dealer->document}}
            </div>
            <div class="txt4">
                {{$dealer->description}}
            </div>
        </div>
        <div class="info2">
            <div class="txt4"><span aria-hidden="true" class="ei icon_phone"></span>{{$dealer->phone}}</div>
            <div class="txt4"><span aria-hidden="true" class="ei icon_mail"></span>{{$dealer->email}}</div>
            <div class="txt4"><span aria-hidden="true" class="ei icon_link"></span>{{$dealer->site}}</div>
        </div>
        </div>
        <div class="bot-info clearfix">
        <div class="info3">
            @if (isset($dealer->address))
            <span aria-hidden="true" class="ei icon_pin"></span>{{$dealer->address->city->name}} - {{$dealer->address->city->county_name}}
            <div class="txt6">
                {{$dealer->address->street}}, {{$dealer->address->number}} - {{$dealer->address->complements}}&nbsp; /&nbsp;ZIP CODE: {{$dealer->address->zipcode}}
            </div>
            @endif
        </div>
        <div class="info4">
            <div class="txt7">
                <a href="{{route('dealer-detail',['dealer' => $dealer->id])}}" class="btn-default btn3">VIEW DETAILS</a>
            </div>
        </div>
        </div>
    </div>
    </div>
</div>