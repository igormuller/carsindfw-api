@extends('layout.app')
@section('title', '')
@section('content')
<div id="home" class="">
        <div id="slides_wrapper" class="">
          <div id="slides">
            <ul class="slides-container">
              <li class="nav1">
                <img src="images/slide03.jpg" alt="" class="img">
                <div class="caption">
                  <div class="container">
                    <div class="txt1"><span>FIND YOUR DREAM CAR</span></div>
                    <div class="txt2">CAR M5 GRAN TURISMO</div>
                    <div class="txt4">MODEL 2017 <!--<span>$64,000</span>--></div>
                    <div class="link2"><a href="details.html" class="slider-link2"><span>SEE DETAILS</span></a></div>
                  </div>
                </div>
              </li>
              <li class="nav2">
                <img src="images/slide04.jpg" alt="" class="img">
                <div class="caption">
                  <div class="container">
                    <div class="txt1"><span>DEALER - SELL YOUR CARS</span></div>
                    <div class="txt2">MAKE GREAT BUSINNES WITH US</div>
                    <div class="link2"><a href="details.html" class="slider-link2"><span>SEE DETAILS</span></a></div>
                  </div>
                </div>
              </li>
            </ul>
            <nav class="slides-navigation">
              <a href="#" class="next" title="Cars in DFW - Próximo Slide"></a>
              <a href="#" class="prev" title="Cars in DFW - Slide Anterior"></a>
            </nav>
          </div>
        </div>
    </div>


    <div id="intro">
    <div class="container">
      <div class="booking-wrapper">
        <div class="booking">
          <form action="{{route('search-cars')}}" method="POST" class="form1">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <div class="row">
              <div class="col1">
                <div class="select1_wrapper">
                  <label>Manufacture</label>
                  <div class="select1_inner">
                    <select class="select2 select" id="filter_make" name="filter_make" style="width: 100%">
                      <option value="">Any Make</option>
                      @foreach ($listMakes as $make)
                      <option value="{{$make->id}}">{{$make->name}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="col1">
                <div class="select1_wrapper">
                  <label>Model</label>
                  <div class="select1_inner">
                    <select class="select2 select" id="filter_model" name="filter_model" style="width: 100%">
                      <option value="">Any Model</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col1">
                <div class="select1_wrapper">
                  <label>Fuel</label>
                  <div class="select1_inner">
                    <select class="select2 select" id="filter_fuel" name="filter_fuel" style="width: 100%">
                      <option value="">Vehicle Fuel</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col1">
                <div class="select1_wrapper">
                  <label>Min Year</label>
                  <div class="select1_inner">
                    <select class="select2 select" id="filter_min_year" name="filter_min_year" style="width: 100%">
                      <option value="">Min Year</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col1">
                <div class="select1_wrapper">
                  <label>Max Year</label>
                  <div class="select1_inner">
                    <select class="select2 select" id="filter_max_year" name="filter_max_year" style="width: 100%">
                      <option value="">Max Year</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col2">
                <div id="slider-range-wrapper">
                  <div class="txt" for="amount_min">PRICE RANGE</div>
                  <div id="slider-range"></div>
                  <div class="clearfix">
                    <input type="text" id="amount_min" name="amount_min" title="Valor Mínimo" readonly>
                    <input type="text" id="amount_max" name="amount_max" title="Valor Máximo" readonly>
                  </div>
                </div>
              </div>
              <div class="col3">
                <!--<div class="adv-serach"><a href="#">ADVANCED SEARCH</a></div>-->
                <button type="submit" class="btn-default btn-form1-submit1"><span>SEARCH THE VEHICLE</span></button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
</div>


<!-- Category Start -->
<div class="featured-category category">
  <div class="container-fluid">
      <div class="container">
          <div class="section-header">
              <h2>Destaques</h2>
          </div>
          <div class="row align-items-center category-slider category-slider-4">
            @foreach($listFeaturedAds as $itemFeaturedAds)
              <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-12">
                  @include('pages.car-box', ['car' => $itemFeaturedAds->advertisement])
              </div>
            @endforeach
          </div>    
      </div>
  </div>
</div>            
<!-- Category End -->


<div class="parallax-container parallax1" data-parallax-img="images/bg-01-1600x600.jpg">
  <div class="parallax-content">
    <div class="section">
      <div class="container">
        <div class="row row-fix">
          <div class="col-sm-12">
            <div class="figure-section">
              <div class="section-title">
                DALLAS LEADING CAR DEALER
              </div>
              <h3>Why People Choose Us</h3>
              <div class="row">
                <div class="col-md-6">
                  <div class="figure-section-text">
                    <p>CARSINDFW was created with the intention of connecting people who want to buy a car with those who are selling their car.
                      It is even better to find the business you are looking for near your home, as our website is focused on DFW, that prosperous and authentic region in the state of Texas.
                    </p>

                  </div>
                </div>
                <div class="col-md-6">
                  <ul class="list-marked-left">
                    <li>Benefits for all categories</li>
                                <li>Advertisement avalable</li>
                                <li>Exclusive focus on the DFW market</li>
                                <li>Access for one user or more</li>
                                <li>Exclusive page</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

</div>



<div class="counter-section">
  <div class="container">
    <div class="row counter-list">
      <div class="col-sm-6 col-md-3 counter-list-item">
        <div class="counter-classic">
          <div class="counter-classic-inner animated" data-animation="fadeInDown" data-animation-delay="200">
            <img src="images/ic1.png" alt="" class="counter-img">
            <div class="caption">
              <div class="counter">
                <span class="animated-number" data-duration="2000" data-animation-delay="0">1250</span>
              </div>
              <div class="counter-title">NEW CARS IN STOCK</div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-3 counter-list-item">
        <div class="counter-classic">
          <div class="counter-classic-inner animated" data-animation="fadeInDown" data-animation-delay="200">
            <img src="images/ic2.png" alt="" class="counter-img">
            <div class="caption">
              <div class="counter">
                <span class="animated-number" data-duration="2000" data-animation-delay="0">2120</span>+
              </div>
              <div class="counter-title">USED CARS IN STOCK</div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-3 counter-list-item">
        <div class="counter-classic">
          <div class="counter-classic-inner animated" data-animation="fadeInDown" data-animation-delay="200">
            <img src="images/ic3.png" alt="" class="counter-img">
            <div class="caption">
              <div class="counter">
                <span class="animated-number" data-duration="2000" data-animation-delay="0">9753</span>
              </div>
              <div class="counter-title">HAPPY CUSTOMERS</div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-3 counter-list-item">
        <div class="counter-classic">
          <div class="counter-classic-inner animated" data-animation="fadeInDown" data-animation-delay="200">
            <img src="images/ic4.png" alt="" class="counter-img">
            <div class="caption">
              <div class="counter">
                <span class="animated-number" data-duration="2000" data-animation-delay="0">1022</span>
              </div>
              <div class="counter-title">CAR DEALERS</div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

@endsection

@push('after-scripts')
<script>
  
$(document).ready(function(){
    $(document).on('change','#filter_model',function(){
        console.log( $( this ).val() );
        $('#filter_fuel, #filter_max_year, #filter_min_year').val(null).trigger('change');
    });

    $(document).on('change','#filter_make',function(){
      console.log( $( this ).val() );
      $('#filter_model, #filter_fuel, #filter_max_year, #filter_min_year').val(null).trigger('change');
    });

    var userAgent = navigator.userAgent.toLowerCase(),
isNoviBuilder = window.xMode,
$window = $(window),
isIE = userAgent.indexOf("msie") !== -1 ? parseInt(userAgent.split("msie")[1], 10) : userAgent.indexOf("trident") !== -1 ? 11 : userAgent.indexOf("edge") !== -1 ? 12 : false,
isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);


    let plugins = {
      materialParallax: $(".parallax-container")
    }

    if (plugins.materialParallax.length) {
      if (!isNoviBuilder && !isIE && !isMobile) {
        plugins.materialParallax.parallax();

        // heavy pages fix
        $window.on('load', function () {
          setTimeout(function () {
            $window.scroll();
          }, 500);
        });
      } else {
        for (var i = 0; i < plugins.materialParallax.length; i++) {
          var parallax = $(plugins.materialParallax[i]),
            imgPath = parallax.data("parallax-img");

          parallax.css({
            "background-image": 'url(' + imgPath + ')',
            "background-size": "cover"
          });
        }
      }
    }

    // Category Slider 4 Column
    $('.category-slider-4').slick({
        //prevArrow: '<button type="button" class="slick-prev btn-default btn-form1-submit1">Previous</button>',
        //nextArrow: '<button type="button" class="slick-next btn-default btn-form1-submit1">Next</button>',
        autoplay: true,
        infinite: true,
        dots: false,
        slidesToShow: 4,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 4,
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                }
            },
        ]
    });

  });
  </script>
@endpush