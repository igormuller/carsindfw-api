@extends('layout.app')
@section('title', '')
@section('content')

<div class="breadcrumbs1_wrapper">
    <div class="container">
      <div class="title1"><h1>SELL YOUR CAR WITH US!</h1></div>
    </div>
</div>

<section class="bg-light">
    <div class="container card-dealer-plan">
        <div class="section-heading">
            <div class="row g-xl-5 mt-n1-9">
                <div class="col-md-4 col-lg-4 mt-1-9">
                    <div class="card card-style2 border-radius-10">
                        <div class="card-header">
                            <h3 class="title-font text-secondary mb-0 h4">Dealer Plan</h3>
                            <div class="d-flex align-items-start justify-content-center mb-0">
                                <span class="mt-sm-2 fw-bolder display-30 display-sm-28 display-lg-26 me-1">$</span>
                                <h4 class="display-3 mb-0 font-weight-600 text-line-through mr-2">999</h4>
                                <span class="mt-sm-2 fw-bolder display-30 display-sm-28 display-lg-26 me-1">$</span>
                                <h4 class="display-3 mb-0 font-weight-600">499</h4>
                            </div>
                            <span class="align-self-end fw-bolder display-30 display-sm-28">For the dealer, very advertisements in one place.</span>
                        </div>
                        <div class="card-body">
                            <ul class="list-style1">
                                <li>Benefits for all categories</li>
                                <li>Advertisement avalable</li>
                                <li>Exclusive focus on the DFW market</li>
                                <li>Access for one user or more</li>
                                <li>Exclusive page</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-lg-8 mt-1-9">

                    <div class="">
                        <div class="card-dealer-plan-title">
                            <span class="">Dealer Plan</span>
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (session('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif
                        <h4>Join us and became a dealer! Request an account filling below</h4>
                        <form class="contact quform" action="{{route('new-company')}}" method="post" enctype="multipart/form-data" onclick="">
                            @csrf
                            <input type="hidden" name="plan_type_id" value="7">
                            <div class="quform-elements">
                                <div class="row">
                                    <!-- Begin Text input element -->
                                    <div class="col-md-4">
                                        <div class="quform-element form-group">
                                            <label for="name">Dealership Name <span class="quform-required">*</span></label>
                                            <div class="quform-input">
                                                <input class="form-control" id="dealership_name" type="text" name="name" placeholder="Dealership Name" value="{{ old('name') }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="quform-element form-group">
                                            <label for="name">Dealership Phone <span class="quform-required">*</span></label>
                                            <div class="quform-input">
                                                <input class="form-control" id="dealership_phone" type="text" name="phone" placeholder="Dealership Phone" value="{{ old('phone') }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="quform-element form-group">
                                            <label for="name">Dealership ZIP <span class="quform-required">*</span></label>
                                            <div class="quform-input">
                                                <input class="form-control" id="dealership_zip" type="text" name="zipcode" placeholder="Dealership ZIP" value="{{ old('zipcode') }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Text input element -->
                                </div>
                                <div class="row">
                                    <!-- Begin Text input element -->
                                    <div class="col-md-3">
                                        <div class="quform-element form-group">
                                            <label for="name">User Name <span class="quform-required">*</span></label>
                                            <div class="quform-input">
                                                <input class="form-control" id="user_name" type="text" name="user_name" placeholder="User Name" value="{{ old('user_name') }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="quform-element form-group">
                                            <label for="name">User E-Mail <span class="quform-required">*</span></label>
                                            <div class="quform-input">
                                                <input class="form-control" id="user_email" type="text" name="user_email" placeholder="User E-mail" value="{{ old('user_email') }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="quform-element form-group">
                                            <label for="name">Password <span class="quform-required">*</span></label>
                                            <div class="quform-input">
                                                <input class="form-control" id="user_password" type="password" name="password" placeholder="User Password" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="quform-element form-group">
                                            <label for="name">Repeat Password <span class="quform-required">*</span></label>
                                            <div class="quform-input">
                                                <input class="form-control" id="user_repeat_password" type="password" name="re_password" placeholder="Repeat User Password" />
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Text input element -->
                                </div>

                                <div class="row">
                                    <!-- Begin Text input element -->
                                    <div class="col-md-3">
                                        <div class="quform-element form-group">
                                            <label for="name">Card Number <span class="quform-required">*</span></label>
                                            <div class="quform-input">
                                                <input class="form-control" id="user_card_number" type="text" name="card_number" placeholder="User Card Number" value="{{ old('card_number') }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="quform-element form-group">
                                            <label for="name">Card Holder <span class="quform-required">*</span></label>
                                            <div class="quform-input">
                                                <input class="form-control" id="user_card_holder" type="text" name="card_name" placeholder="User Card Holder" value="{{ old('card_name') }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="quform-element form-group">
                                            <label for="name">Expiration Date <span class="quform-required">*</span></label>
                                            <div class="quform-input">
                                                <input class="form-control" id="user_card_expiration" type="text" name="card_expiration_date" placeholder="User Card Expiration" value="{{ old('card_expiration_date') }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="quform-element form-group">
                                            <label for="name">CVV <span class="quform-required">*</span></label>
                                            <div class="quform-input">
                                                <input class="form-control" id="user_card_cvv" type="text" name="card_cvv" placeholder="User Card CVV" value="{{ old('card_cvv') }}" />
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
