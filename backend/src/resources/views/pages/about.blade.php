@extends('layout.app')
@section('title', '')
@section('content')

<div class="breadcrumbs1_wrapper">
    <div class="container">
      <div class="title1"><h1>About CARSINDFW</h1></div>
    </div>
</div>

<div class="parallax-container parallax1 about" data-parallax-img="images/bg-01-1600x600.jpg"><div class="material-parallax parallax"><img src="images/bg-01-1600x600.jpg" alt="" style="display: block; transform: translate3d(-50%, 161px, 0px);"></div>
  <div class="parallax-content">
    <div class="section">
      <div class="container">
        <div class="row row-fix">
          <div class="col-sm-12">
            <div class="figure-section">
              <div class="row">
                <div class="col-md-6">
                  <div class="figure-section-text">
                    <p>
                        CARSINDFW was created with the intention of connecting people who want to buy a car with those who are selling their car.<br/> 
                        It is even better to find the business you are looking for near your home, as our website is focused on DFW, that prosperous and authentic region in the state of Texas.
                    </p>
                    <p class="font-weight-bold"> We want to provide an online meeting and at the same time strengthen local businesses, being a showcase for dealers in the region! </p>
                    <p class="font-weight-bold"> In a clear and objective way we want to be your car portal, for you who like cars and also for those who are passionate about cars like us! </p>
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
    
<section class="bg-light">
    <div class="container">
        <div class="section-heading">
            <div class="title1"><h1>Our Team</h1></div>

            <div class="d-flex justify-content-center">
                <div class="text-center mx-5">
                    <div class="v-avatar" style="min-width: 150px; width: 150px;">
                        <img src="{{ url('images/tiago_back.jpg')}}" />
                        <h3 class="font-weight-bold mt-2" >Tiago Back</h3>
                        <h4 class="font-weight-bold mt-n5" >Owner</h4>
                    </div>
                </div>
                <div class="text-center mx-5">
                    <div class="v-avatar" style="min-width: 150px; width: 150px;">
                        <img src="{{ url('images/lilian.jpeg')}}" />
                        <h3 class="font-weight-bold mt-2" > Lilian Müller </h3>
                        <h4 class="font-weight-bold mt-n5" >Owner</h4>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <div class="text-center mx-10">
                    <div class="v-avatar" style="min-width: 150px; width: 150px;">
                        <img src="{{ url('images/igor_muller.jpeg')}}" />
                        <h3 class="font-weight-bold mt-2"> Igor Müller </h3>
                        <h4 class="font-weight-bold mt-n5"> Developer Manager </h4>
                    </div>
                </div>
                <div class="text-center mx-10">
                    <div class="v-avatar" style="min-width: 150px; width: 150px;">
                        <img src="{{ url('images/davi.jpeg')}}" />
                        <h3 class="font-weight-bold mt-2"> Davi </h3>
                        <h4 class="font-weight-bold mt-n5"> Marketing </h4>
                    </div>
                    
                </div>
                <div class="text-center mx-10">
                    <div class="v-avatar" style="min-width: 150px; width: 150px;">
                        <img src="{{ url('images/renato.jpeg')}}" />
                        <h3 class="font-weight-bold mt-2"> Renato </h3>
                        <h4 class="font-weight-bold mt-n5"> Graphic Designer / Social Media </h4>
                    </div>
                    
                </div>
            </div>

        </div>
        <div class="row">
        </div>
    </div>
</section>

<section class="about-contact">
  <div class="container-fluid">
      <div class="row g-0">
          <div class="col-lg-12 bg-img cover-background theme-overlay" data-overlay-dark="5">
              <img src="https://carsindfw.com/img/gif_cars_in_dallas_at_night.f8af9cfc.gif">
              <div class="p-1-9 p-lg-2-9 position-relative z-index-1 h-100">
                  <h2 class="pt-6 mb-3 text-white">Our Contact Detail</h2>
                  <p class="mb-5 text-white display-sm-28">Need any consultations contact with us</p>
                  <div class="d-flex mb-4 pb-3 border-bottom border-color-light-white">
                      <div class="flex-shrink-0 mt-2">
                          <i class="fas fa-phone-alt text-secondary fs-2"></i>
                      </div>
                      <div class="contact-info">
                          <h3 class="h5 text-white">Phone Number</h3>
                          <span class="text-white d-block mb-1">+1 (469) 456-4082</span>
                      </div>
                  </div>
                  <div class="d-flex mb-4 pb-3 border-bottom border-color-light-white">
                      <div class="flex-shrink-0 mt-2">
                          <i class="far fa-envelope-open text-secondary fs-2"></i>
                      </div>
                      <div class="contact-info">
                          <h3 class="h5 text-white">Email Address</h3>
                          <span class="text-white d-block mb-1">adm.carsindfw@gmail.com</span>
                      </div>
                  </div>
                  <div class="d-flex mb-4 pb-3 border-bottom border-color-light-white">
                      <div class="flex-shrink-0 mt-2">
                          <i class="fas fa-map-marker-alt text-secondary fs-2"></i>
                      </div>
                      <div class="contact-info">
                          <h3 class="h5 text-white">Location</h3>
                          <address class="text-white d-block mb-0 w-md-80 w-xl-70">777 FAIRWAY Dr Coppell, Dallas TX 75006</address>
                      </div>
                  </div>
                 
              </div>
          </div>
      </div>
  </div>
</section>


@endsection