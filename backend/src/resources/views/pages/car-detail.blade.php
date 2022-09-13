@extends('layout.app')
@section('title', '')
@section('content')
<div class="top4-wrapper">
    <div class="container">
      <div class="top4"></div>
    </div>
  </div>
  
  <div class="breadcrumbs1_wrapper">
    <div class="container">
      <div class="breadcrumbs1"><a href="index.html">Home</a><span></span>Details</div>
    </div>
  </div>
  
  <div id="content">
    <div class="container">
  
      <div class="row">
        <div class="col-sm-12 col-md-8 column-content">
  
          <div class="gslider-wrapper">
            <div id="gslider" class="flexslider">
              <ul class="slides">
                @foreach ($car->gallery as $carImage)
                <li>
                  <img src="{{Storage::url($carImage->path)}}" alt="{{$carImage->name}}" class="img-responsive">
                </li>
                @endforeach
              </ul>
            </div>
            <div id="carousel" class="flexslider">
              <ul class="slides">
                @foreach ($car->gallery as $carImage)
                <li>
                  <img src="{{Storage::url($carImage->path)}}" alt="{{$carImage->name}}" class="img-responsive">
                </li>
                @endforeach
              </ul>
            </div>
          </div>

          
            <div id="banner3">
              <div class="title2">VEHICLE OVERVIEW</div>
                  <div class="row">
                    <div class="col-sm-6">
                      <ul class="ul3">
                        <li><a href="#"><b>Body Type:</b> {{$car->body_type}}</a></li>
                        <li><a href="#"><b>Type:</b>{{$car->type}}</a></li>
                        <li><a href="#"><b>Transmission:</b>{{$car->transmission}}</a></li>
                        <li><a href="#"><b>Transmission Type:</b>{{$car->transmission_type}}</a></li>
                        <li><a href="#"><b>Fuel Type:</b>{{$car->fuel_type}}</a></li>
                      </ul>
                    </div>
                    <div class="col-sm-6">
                      <ul class="ul3">
                        <li><a href="#"><b>Drive Type:</b>{{$car->drive_type}}</a></li>
                        <li><a href="#"><b>Extern Color:</b>{{$car->color_ext}}</a></li>
                        <li><a href="#"><b>Intern Color:</b>{{$car->color_int}}</a></li>
                        <li><a href="#"><b>Seats:</b>{{$car->seats}}</a></li>
                        <li><a href="#"><b>Doors:</b>{{$car->doors}}</a></li>                        
                      </ul>
                    </div>
                  </div>
                <div class="title2">DESCRIPTION</div>
                {{$car->description}}
            </div>

            <div class="banner3-wrapper">
              <div class="banner3">
                <div class="top-info clearfix">
                  <div class="info1">
                    <div class="txt1">Estimate Financing</div>
                  </div>
                </div>
                <div class="txt2"></div>
                <div class="txt3"></div>
                <div class="form-wrapper">
                  <div id="note1"></div>
                  <div id="fields1">
                    <form id="ajax-contact-form1" class="form-horizontal" action="javascript:;">
    
                      <div class="row">
                        <div class="col-xs-6 col-sm-6">
                          <div class="form-group">
                              <label for="inputName">Value car ($)</label>
                              <input type="text" class="form-control" id="inputName" name="name" value="{{$car->value}}">
                          </div>
                        </div>
                        <div class="col-xs-6 col-sm-6">
                          <div class="form-group">
                              <label for="inputEmail">Running time</label>
                              <select class="form-control">
                                <option>60 months</option>
                                <option>48 months</option>
                                <option>36 months</option>
                                <option>24 months</option>
                                <option>12 months</option>
                              </select>
                          </div>
                        </div>
                      </div>
  
                      <div class="row">
                        <div class="col-xs-6 col-sm-6">
                          <div class="form-group">
                              <label for="inputName">Down Payment ($)</label>
                              <input type="text" class="form-control" id="inputName" name="name" value="{{$car->value}}">
                          </div>
                        </div>
                        <div class="col-xs-6 col-sm-6">
                          <div class="form-group">
                            <label for="inputName">Trade-in Value ($)</label>
                            <input type="text" class="form-control" id="inputName" name="name" value="{{$car->value}}">
                          </div>
                        </div>
                      </div>
  
                      <div class="row">
                        <div class="col-xs-6 col-sm-6">
                          <div class="form-group">
                              <label for="inputName">Interest Rate (APR)</label>
                              <input type="text" class="form-control" id="inputName" name="name" value="4.33">
                          </div>
                        </div>
                        <div class="col-xs-6 col-sm-6">
                          <div class="form-group">
                            <label for="inputName">Sales Tax (%)</label>
                            <input type="text" class="form-control" id="inputName" name="name" value="">
                          </div>
                        </div>
                      </div>
    
                      <div class="txt4"></div>
    
                      <button type="submit" class="btn-default btn-cf-submit1">CALCULATE NOW</button>
    
    
                    </form>
                  </div>
                </div>
              </div>
            </div>

        </div>
        <div class="col-sm-12 col-md-4 column-sidebar">
          <div class="banner2-wrapper">
            <div class="banner2">
              <div class="top-info clearfix">
                <div class="info1">
                  <div class="txt1">{{$car->trim}}</div>
                </div>
                <div class="txt2">
                  <div class="row options">
                    <div class="col-xs-6 col-sm-6">
                      <span class="mileage-icon">{{$car->miles}} Miles</span>
                    </div>
                    <div class="col-xs-6 col-sm-6">
                      <span class="text-right">Registered {{$car->year}}</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="txt3">$ {{$car->value}}</div>

            </div>
          </div>

          <div class="dealer-question banner2">
            <div class="info1">
              <div class="txt1">QUESTION OR BID</div>
            </div>
            <div class="form-wrapper">
              <div id="note2"></div>
              <div id="fields2">
                <form id="ajax-contact-form2" class="form-horizontal" action="javascript:;">

                <div class="customer-form form-group">
                  <div class="first-name">
                    <label for="inputMessage">First Name</label>
                    <input name="lead-first-name" class="form-control" value=""/>
                  </div>
                  <div class="last-name">
                    <label for="inputMessage">Last Name</label>
                    <input name="lead-last-name" class="form-control" value=""/>
                  </div>
                  <div class="email">
                    <label for="inputMessage">Email</label>
                    <input type="email" name="lead-email" class="form-control" value=""/>
                  </div>
                  <div class="phone">
                    <label for="inputMessage">Phone</label>
                    <input type="tel" name="lead-phone" class="form-control" value=""/>
                  </div>
        
                  <div class="subject">
                    <label for="inputMessage">Subject</label>
                        <select name="lead-subject" required="" class="form-control" >
                              <option value="Check availability">Check availability</option>
                              <option value="Check home delivery options">Check home delivery options</option>
                              <option value="Request virtual appointment">Request virtual appointment</option>
                              <option value="Get a price quote">Get a price quote</option>
                              <option value="Schedule a test drive">Schedule a test drive</option>
                              <option value="Discuss financing">Discuss financing</option>
                              <option value="Ask a question">Ask a question</option>
                        </select>
                      </div>
        
                  <div class="comments">
                    <label for="inputMessage">Comments</label>
                    <textarea name="lead-comments" class="form-control"></textarea>
                  </div>
                </div>
                  <button type="submit" class="btn-default btn-cf-submit2">SEND THE MESSAGE</button>


                </form>
              </div>
            </div>
          </div>

          
          <div class="banner2-wrapper">
            <div class="banner2">
              <div class="top-info clearfix">
                <div class="info1">
                  <div class="txt1">{{ $car->company->dealer->name }}</div>
                </div>
                <div class="info2">
                  <div class="txt4"><span aria-hidden="true" class="ei icon_phone"></span>{{$car->company->dealer->phone}}</div>
                  <div class="txt4"><span aria-hidden="true" class="ei icon_mail"></span>{{$car->company->dealer->email}}</div>
                  <div class="txt4"><span aria-hidden="true" class="ei icon_link"></span>{{$car->company->dealer->site}}</div>
                </div>

                @if (isset($car->company->dealer->address))
                <div class="info3">
                  <span aria-hidden="true" class="ei icon_pin"></span>{{$car->company->dealer->address->city->name}} - {{$car->company->dealer->address->city->county_name}}
                  <div class="txt6">
                      {{$car->company->dealer->address->street}}, {{$car->company->dealer->address->number}} - {{$car->company->dealer->address->complements}}&nbsp; /&nbsp;ZIP CODE: {{$car->company->dealer->address->zipcode}}
                  </div>
                </div>
                @endif

                

              </div>
              <div id="google_map"></div>
              <div class="info4">
                <div class="txt7 m-2">
                    <a href="{{route('dealer-detail',['dealer' => $car->company->dealer->id])}}" class="btn-default btn2">VIEW DEALER DETAILS</a>
                </div>
              </div>

              
            </div>
          </div>
  
          
  
  
          <div class="banner">
            <figure><img src="images/banner.jpg" alt="" class="img-responsive"></figure>
            <div class="caption">
              <div class="txt1">SELL YOUR CAR</div>
              <div class="txt2">Nam tellus enimds eleifend dignis lsim biben edum tristique sed metus fusce Maecenas lobortis.</div>
              <div class="txt3"><a href="#" class="btn-default btn2">REGISTER NOW</a></div>
            </div>
          </div>
  
  
  
  
        </div>
  
      </div>
  
  
  
      <div class="row">
        @foreach ($relateds as $carRelated)
        <div class="col-sm-3">
          @include('pages.car-box', ['car' => $carRelated])
        </div>
        @endforeach
        
  
    </div>
  </div>
@endsection

@push('after-styles')
<link href="{{url('css/gflexslider.css')}}" rel="stylesheet">
@endpush
@push('after-scripts')
    
<script src="{{url('js/jquery.flexslider-min.js')}}"></script>
<script src="https://maps.googleapis.com/maps/api/js?sensor=false.js"></script>
<script src="{{url('js/googlemap1.js')}}"></script>

@endpush