@extends('layout.app')
@section('title', '')
@section('content')
<div id="dealer-detail">
    <div id="slides_wrapper">
        <div id="slides">
            <ul class="slides-container">
                <li >
                <img src="{{url($dealer->profile_path)}}" alt="" class="img">
                <div class="caption">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-offset-7 col-lg-5">
                                <div class="feature-car-rent-box-1">
                                    <h3>{{$dealer->name}}</h3>
                                    <ul class="list-unstyled">
                                        <li>
                                            <span>Street</span>
                                            <span class="spec">{{$dealer->address->street}}, {{$dealer->address->number}} - {{$dealer->address->complements}}&nbsp; /&nbsp;ZIP CODE: {{$dealer->address->zipcode}}</span>
                                        </li>
                                        <li>
                                            <span>City</span>
                                            <span class="spec">{{$dealer->address->city->name}} - {{$dealer->address->city->county_name}}</span>
                                        </li>
                                        <li>
                                        <span>Phone</span>
                                        <span class="spec">{{$dealer->phone}}</span>
                                        </li>
                                        <li>
                                        <span>E-mail</span>
                                        <span class="spec">{{$dealer->email}}</span>
                                        </li>
                                        <li>
                                        <span>Site</span>
                                        <span class="spec">{{$dealer->site}}</span>
                                        </li>
                                    </ul>
                                    <div class="row">
                                        <div class="col-md-6">
                                        <a href="{{route('contact')}}" class="ml-auto btn btn-primary">Ver no Mapa</a>
                                        </div>
                                        <div class="col-md-6 social-network text-right">
                                        <a href="{{$dealer->facebook}}" class="mr-2"><span aria-hidden="true" class="ei social_facebook_square"></span></a>
                                        <a href="{{$dealer->instagram}}"><span aria-hidden="true" class="ei social_instagram_square"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </li>
            </ul>
            <nav class="slides-navigation">
                <a href="#" class="next"></a>
                <a href="#" class="prev"></a>
            </nav>
        </div>
    </div>
<!-- Category Start -->
<div class="featured-category category">
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-12">
                    
                </div>
                <div class="col-md-9 col-sm-12">
                    <div class="section-header">
                        <h2>STOCK CARS</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 col-sm-12">
                    <div class="sidebar-form-wrapper">
                        <div class="sidebar-form">
                          <form action="{{route('search-cars')}}" method="POST" class="form2">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <input type="hidden" name="dealer_id" value="{{ $dealer->id }}" />
                            @include('pages.car-filter')
                            <button type="submit" class="btn-default btn-form2-submit">SUBMIT FILTERS</button>
                            <div class="reset-filters"><a href="#">RESET ALL FILTERS</a></div>
                          </form>
                        </div>
                      </div>
                </div>
                <div class="col-md-9 col-sm-12">
                    <div class="row align-items-center category-slider category-slider-4">
                    @foreach($dealer->advertisements as $itemFeaturedAds)
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12">
                            @include('pages.car-box', ['car' => $itemFeaturedAds])
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>            
  <!-- Category End -->


</div>
</div>
@endsection