@extends('layout.app')
@section('title', '')
@section('content')

<section class="bg-light">
    <div class="container">
        <div class="row g-0">
            <div class="col-lg-7">
                <div class="">
                    <div class="title1">
                        <h1 class="">Get In Touch</h1>
                    </div>
                    @if($success)
                        <div class="text-center">
                            <h3>Contact sent successfully!!!</h3>
                        </div>
                    @endif
                    <form class="contact quform" action="{{route('contact-post')}}" method="post" enctype="multipart/form-data" onclick="">
                        @csrf
                        <div class="quform-elements">
                            <div class="row">

                                <!-- Begin Text input element -->
                                <div class="col-md-6">
                                    <div class="quform-element form-group">
                                        <label for="name">Your Name <span class="quform-required">*</span></label>
                                        <div class="quform-input">
                                            <input class="form-control" id="name" type="text" name="name" placeholder="Your name here" />
                                        </div>
                                    </div>
                                </div>
                                <!-- End Text input element -->

                                <!-- Begin Text input element -->
                                <div class="col-md-6">
                                    <div class="quform-element form-group">
                                        <label for="email">Your Email <span class="quform-required">*</span></label>
                                        <div class="quform-input">
                                            <input class="form-control" id="email" type="text" name="email" placeholder="Your email here" />
                                        </div>
                                    </div>
                                </div>
                                <!-- End Text input element -->

                                <!-- Begin Text input element -->
                                <div class="col-md-6">
                                    <div class="quform-element form-group">
                                        <label for="subject">Your Subject <span class="quform-required">*</span></label>
                                        <div class="quform-input">
                                            <input class="form-control" id="subject" type="text" name="subject" placeholder="Your subject here" />
                                        </div>
                                    </div>
                                </div>
                                <!-- End Text input element -->

                                <!-- Begin Text input element -->
                                <div class="col-md-6">
                                    <div class="quform-element form-group">
                                        <label for="phone">Contact Number</label>
                                        <div class="quform-input">
                                            <input class="form-control" id="phone" type="text" name="phone" placeholder="Your phone here" />
                                        </div>
                                    </div>
                                </div>
                                <!-- End Text input element -->

                                <!-- Begin Textarea element -->
                                <div class="col-md-12">
                                    <div class="quform-element form-group">
                                        <label for="message">Message <span class="quform-required">*</span></label>
                                        <div class="quform-input">
                                            <textarea class="form-control" id="message" name="message" rows="3" placeholder="Tell us a few words"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Textarea element -->

                                <!-- Begin Submit button -->
                                <div class="col-md-12">
                                    <div class="quform-submit-inner">
                                        <button class="btn-form1-submit1" type="submit">Send Message</button>
                                    </div>
                                    <div class="quform-loading-wrap text-start"><span class="quform-loading"></span></div>
                                </div>
                                <!-- End Submit button -->

                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-5 bg-img cover-background theme-overlay" data-overlay-dark="9" data-background="img/content/contact-image.jpg">
                <div class="p-1-9 p-lg-2-9 position-relative z-index-1 h-100">
                    <h2 class="mb-3 text-white">Our Contact Detail</h2>
                    <p class="mb-2-2 text-white display-sm-28">Need any consultations contact with us</p>
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
