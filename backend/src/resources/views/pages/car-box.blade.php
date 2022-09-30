<div class="car-view4-wrapper">
  <a href="{{route('car-detail',['car' => $car->id])}}">
    <div class="car-view2 clearfix">
      <figure>
        @if (isset($car->image))
        <img src="{{Storage::disk('s3')->url($car->image->path)}}" alt="{{$car->trim}}" class="img-responsive">
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
        </div>
        <div class="txt3">{{substr($car->description,0,300)}}</div>
        <div class="txt4">
          <ul>
            <li>{{$car->body_type}}</li>
            <li>{{$car->type}}</li>
            <li>{{$car->color_ext}}</li>
            <li>{{$car->transmission_type}}</li>
            <li>{{$car->fuel_type}}</li>
          </ul>
        </div>
        <div class="txt5">{{$car->miles}} Miles</div>
        <div class="bot-info clearfix">
          <div class="info2">
            <div class="txt6">${{$car->value}}</div>
          </div>
          <div class="info3">
            <div class="txt7">
              <a href="#" class="btn-default btn3">VIEW DETAILS</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </a>
  </div>
