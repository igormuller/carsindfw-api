<div class="bot1-wrapper">
    <div class="container">
      <div class="bot1 clearfix">
        <div class="row">
          <div class="col-sm-3">
  
            <div class="bot1-title"><span>LATEST NEWS</span></div>
  
            <div class="news-block">
              <div class="news1">
                <div class="txt1">Duis scelerisque aliquet ante donec
  libero pede porttitor dacu</div>
                <div class="txt2"><a href="{{url('')}}">Read More</a></div>
              </div>
              <div class="news1">
                <div class="txt1">Duis scelerisque aliquet ante donec
  libero pede porttitor dacu</div>
                <div class="txt2"><a href="{{url('')}}">Read More</a></div>
              </div>
              <div class="news1">
                <div class="txt1">Duis scelerisque aliquet ante donec
  libero pede porttitor dacu</div>
                <div class="txt2"><a href="{{url('')}}">Read More</a></div>
              </div>
            </div>
          </div>
          <div class="col-sm-5">

            <div class="bot1-title"><span>LATEST CARS</span></div>
            <div class="autos-block">
              @foreach ($latestAds as $footerAds)
              <div class="autos1 clearfix">
                <div class="col-md-5">
                <figure><img src="{{Storage::disk('s3')->url($footerAds->image->path)}}" alt="{{$footerAds->trim}}" class="img-responsive"></figure>
                </div>
                <div class="col-md-7 caption">
                  <div class="txt1">{{$footerAds->trim}}</div>
                  <div class="txt2">{{$footerAds->miles}} KM</div>
                  <div class="txt3"><a href="{{route('car-detail',['car' => $footerAds->id])}}">View Details</a></div>
                </div>
              </div>
              @endforeach
            </div>
          </div>

          <div class="col-sm-3">
            <div class="bot1-title"><span>CONTACT US</span></div>
            <div class="address2"><span aria-hidden="true" class="ei icon_pin"></span>777 FAIRWAY Dr Coppell, Dallas TX 75006</div>
            <div class="bot1-map-wrapper">
              <div class="phone2"><span aria-hidden="true" class="ei icon_phone"></span>Phone:   +1 (469) 456-4082</div>
              <div class="email2"><span aria-hidden="true" class="ei icon_mail"></span>Email:  <a href="mailto:adm.carsindfw@gmail.com">adm.carsindfw@gmail.com</a></div>
              <div class="open-loaction-map"><a href="https://goo.gl/maps/Kr15vDuEaLJbJVTg6" target="_blank">Open Location Map</a></div>
            </div>
  
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="bot2-wrapper">
    <div class="container">
      <div class="bot2 clearfix">
        <div class="right-block">
          <div class="social2_wrapper">
            <ul class="social2 clearfix">
              <li><a title="Facebook Cars in DFW" href="https://www.facebook.com/carsindfw"><span aria-hidden="true" class="ei social_facebook_square"></span></a></li>
              <li><a title="Instagram Cars in DFW" href="https://instagram.com/cars.indfw?igshid=YmMyMTA2M2Y="><span aria-hidden="true" class="ei social_instagram_square"></span></a></li>
              <li><a title="LinkedIn Cars in DFW" href="https://www.linkedin.com/company/cars-in-dfw/"><span aria-hidden="true" class="ei social_linkedin_square"></span></a></li>
            </ul>
          </div>
          <div class="menu2_wrapper">
            <ul class="menu2 clearfix">
              <li><a href="{{route('about')}}">Cars in DFW</a></li>
              <?php /*
              <li><a href="{{route('about')}}">Cars in DFW</a></li>
              <li><a href="{{route('benefits')}}">Benefits</a></li>
              <li><a href="{{route('dallas-history')}}">Dallas History</a></li>
              */
              ?>
              
              <li class=""><a href="{{route('find-car')}}">Find Your Car</a></li>
              <li class=""><a href="{{route('find-dealer')}}">Find a Dealership</a></li>
              <?php /*
              <li><a href="{{route('terms-of-service')}}">Terms of Use</a></li>
              <li><a href="{{route('privacy-police')}}">Privacy Police</a></li>
              <li><a href="{{route('fraud-awareness')}}">Fraud Awareness</a></li>
              */ ?>
              <li><a href="{{route('contact')}}">Contact Us</a></li>
              <li class="iam_dealer"><a href="{{route('dealer-plan')}}">I Am a Dealer</a></li>
              <li class="sell_car"><a href="{{route('person-plan')}}">Sell My Car</a></li>
            </ul>
          </div>
        </div>
        <div class="left-block">
          <div class="logo2_wrapper">
            <a href="{{url('')}}" class="logo2">
              <img src="images/logo.png" alt="Cars in DFW" class="img-responsive">
            </a>
          </div>
          <div class="copyrights">© 2022 Designed &amp; Powered by CarsInDFW</div>
        </div>
  
      </div>
    </div>
  </div>
