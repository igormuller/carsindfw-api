<div class="car-view3-wrapper">
    <div class="car-view1 clearfix">
    <figure>@if (isset($car->image))
        <img src="{{Storage::url($car->image->path)}}" alt="{{$car->trim}}" class="img-responsive">
        @endif
    </figure>
    <div class="caption">
        <div class="top-info clearfix">
        <div class="info1">
            <div class="txt1">{{$car->trim}}</div>
            <div class="txt2">
                Registered {{$car->year}}
            </div>
        </div>
        <div class="info2">
            <div class="txt3">${{$car->value}}</div>
        </div>
        </div>
        <div class="txt4">
            {{$car->description}}
        </div>
        <div class="bot-info clearfix">
        <div class="info3">
            <div class="txt5">{{$car->miles}} Miles</div>
            <div class="txt6">
                {{$car->body_type}}</li>&nbsp; /&nbsp;{{$car->type}}&nbsp; /&nbsp;{{$car->color_ext}}&nbsp; /&nbsp;{{$car->transmission_type}}&nbsp; /&nbsp;{{$car->fuel_type}}
            </div>
        </div>
        <div class="info4">
            <div class="txt7">
                <a href="{{route('car-detail',['car' => $car->id])}}" class="btn-default btn3">VIEW DETAILS</a>
            </div>
        </div>
        </div>
    </div>
    </div>
</div>