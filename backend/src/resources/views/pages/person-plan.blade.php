@extends('layout.app')
@section('title', '')
@section('content')

<div class="breadcrumbs1_wrapper">
    <div class="container">
      <div class="title1"><h1>SELL YOUR CAR WITH US!</h1></div>
    </div>
</div>

<section class="bg-light">
    <div class="container card-person-plan ">
        <div class="section-heading">
            <div class="row g-xl-5 mt-n1-9">
                <div class="col-md-4 col-lg-4 mt-1-9">
                    <div class="card card-style2 border-radius-10">
                        <div class="card-header">
                            <h3 class="title-font text-secondary mb-0 h4">Person Plan</h3>
                            <div class="d-flex align-items-start justify-content-center mb-0">
                                <span class="mt-sm-2 fw-bolder display-30 display-sm-28 display-lg-26 me-1">$</span>
                                <h4 class="display-3 mb-0 font-weight-600">FREE</h4>
                            </div>
                            <span class="align-self-end fw-bolder display-30 display-sm-28">For you to sell your car.</span>
                        </div>
                        <div class="card-body">
                            <ul class="list-style1">
                                <li>Benefits for all categories</li>
                                <li>Advertisement avalable</li>
                                <li>Exclusive focus on the DFW market</li>
                                <li>Access for one user or more</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-lg-8 mt-1-9">
                    <div class="">
                        <div class="card-person-plan-title">
                            <span class="">Person Plan</span>
                        </div>
                        <h4>Join us and sell your car! Request an account filling below</h4>
                        <form class="contact quform" action="{{route('new-company')}}" method="post" enctype="multipart/form-data" onclick="">
                            @csrf
                            <input type="hidden" name="plan_type_id" value="8">
                            <div class="quform-elements">
                                <div class="row">
                                    <!-- Begin Text input element -->
                                    <div class="col-md-6">
                                        <div class="quform-element form-group">
                                            <label for="name">User Name <span class="quform-required">*</span></label>
                                            <div class="quform-input">
                                                <input class="form-control" id="user_name" type="text" name="user_name" placeholder="User Name" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="quform-element form-group">
                                            <label for="name">User E-Mail <span class="quform-required">*</span></label>
                                            <div class="quform-input">
                                                <input class="form-control" id="user_email" type="text" name="user_email" placeholder="User E-mail " />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="quform-element form-group">
                                            <label for="name">User ZIP <span class="quform-required">*</span></label>
                                            <div class="quform-input">
                                                <input class="form-control" id="user_zip" type="text" name="zipcode" placeholder="Dealership ZIP" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="quform-element form-group">
                                            <label for="name">Password <span class="quform-required">*</span></label>
                                            <div class="quform-input">
                                                <input class="form-control" id="user_password" type="text" name="password" placeholder="User Password" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="quform-element form-group">
                                            <label for="name">Repeat Password <span class="quform-required">*</span></label>
                                            <div class="quform-input">
                                                <input class="form-control" id="user_repeat_password" type="text" name="re_password" placeholder="Repeat User Password" />
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Text input element -->
                                </div>
                                <div class="row">
                                    <!-- Begin Submit button -->
                                    <div class="col-md-12">
                                        <div class="quform-submit-inner">
                                            <button class="btn-form1-submit1" type="submit">Register</button>
                                        </div>
                                        <div class="quform-loading-wrap text-start"><span class="quform-loading"></span></div>
                                    </div>
                                    <!-- End Submit button -->
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
