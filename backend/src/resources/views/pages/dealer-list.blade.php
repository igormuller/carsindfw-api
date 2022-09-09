@extends('layout.app')
@section('title', '')
@section('content')


<div class="breadcrumbs1_wrapper">
<div class="container">
  <div class="title1"><h1>Our Dealers</h1></div>
</div>
</div>

<div id="content" class="bg-light mt-2">
<div class="container">
  <div class="row">
    <div class="col-md-3 col-sm-12">
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
    </div>
    <div class="col-md-9 col-sm-12">

      <div class="row mb-2">
        <div class="col-sm-12 col-md-12 box-filter-dealer">
          <label>Filter City
          </label>
        <select class="form-control-filter form-control" id="filter_dealer_city">
          <option value="">All Cities</option>
          @foreach ($listCities as $city)
          <option value="{{$city->id}}" @if(isset($citySelected) && $citySelected == $city->id) {{'selected'}} @endif>{{$city->name}}</option>
          @endforeach
        </select>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-12 col-md-12 column-content">
            <div class="row">
            @foreach ($listDealers as $dealer)
            @include('pages.dealer-column', ['dealer' =>$dealer])
            @endforeach
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
    $(document).on('change','#filter_dealer_city',function(){

      location.href="{{route('find-dealer')}}/" + $(this).val();

    });
});
</script>
@endpush