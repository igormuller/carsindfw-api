@extends('layout.app')
@section('title', '')
@section('content')

<div class="top3-wrapper">
<div class="container">
  <div class="top3 clearfix">

    <div class="tabs-wrapper">
      <div class="txt">SELECT VIEW</div>
      <div class="tabs1-wrapper">
        <ul class="tabs clearfix" data-tabgroup="first-tab-group">
          <li><a href="#tabs2-1"><i class="fa fa-list"></i></a></li>
          <li class="active"><a href="#tabs2-2"><i class="fa fa-th"></i></a></li>
        </ul>
      </div>
    </div>
<!--
    <div class="sort-wrapper">
      <div class="txt">sort by</div>
      <div class="select1_wrapper">
        <label>Sort</label>
        <div class="select1_inner">
          <select class="select2 select" style="width: 100%">
            <option value="1">Last Added</option>
            <option value="2">Popular</option>
            <option value="3">Price</option>
          </select>
        </div>
      </div>
    </div>
  -->


  </div>
</div>
</div>

<div class="breadcrumbs1_wrapper">
<div class="container">
  <div class="breadcrumbs1"><a href="index.html">Home</a><span></span>Search Results</div>
</div>
</div>

<div id="content">
<div class="container">

  <div class="row">
    <div class="col-sm-12 col-md-3 column-sidebar">

      <div class="sidebar-form-wrapper">
        <div class="sidebar-form">
          <form action="{{route('search-cars')}}" method="POST" class="form2">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            @include('pages.car-filter')
            <button type="submit" class="btn-default btn-form2-submit">SUBMIT FILTERS</button>
            <div class="reset-filters"><a href="#">RESET ALL FILTERS</a></div>
          </form>
        </div>
      </div>

      <div class="banner">
        <figure><img src="images/banner.jpg" alt="" class="img-responsive"></figure>
        <div class="caption">
          <div class="txt1">SELL YOUR CAR</div>
          <div class="txt2">The best place to advertise your car in the Dallas Fort Worth area.</div>
          <div class="txt3"><a href="{{route('person-plan')}}" class="btn-default btn2">REGISTER NOW</a></div>
        </div>
      </div>




    </div>
    <div class="col-sm-12 col-md-9 column-content">
    @include('pages.car-list-content', ['listAds' =>$listAds])
    </div>
  </div>

</div>
</div>
@endsection
@push('after-scripts')
<script>
  
$(document).ready(function(){
  @if (request('filter_make'))
  var option = new Option('', {{request('filter_make')}}, true, true);
  $('#filter_make').append(option).trigger('change');
    
  @endif

  });

 
</script>
@endpush
