    <div id="first-tab-group" class="tabgroup">
      <div id="tabs2-1">
        <div class="row">
          @foreach ($listAds as $ad)
            @include('pages.car-column', ['car' => $ad])
          @endforeach
        </div>


        <div class="pager_wrapper">
          <ul class="pager clearfix">
            <li class="prev"><a href="#"></a></li>
            <li class="active"><a href="#">1</a></li>
            <li class="li"><a href="#">2</a></li>
            <li class="li"><a href="#">3</a></li>
            <li class="li"><a href="#">4</a></li>
            <li class="dots">....</li>
            <li class="next"><a href="#"></a></li>
          </ul>
        </div>

      </div>
      <div id="tabs2-2">

        <div class="row">
          @foreach ($listAds as $ad)
          <div class="col-sm-4">
            @include('pages.car-box', ['car' => $ad])
          </div>
          @endforeach

        </div>


        <div class="pager_wrapper">
          <ul class="pager clearfix">
            <li class="prev"><a href="#"></a></li>
            <li class="active"><a href="#">1</a></li>
            <li class="li"><a href="#">2</a></li>
            <li class="li"><a href="#">3</a></li>
            <li class="li"><a href="#">4</a></li>
            <li class="dots">....</li>
            <li class="next"><a href="#"></a></li>
          </ul>
        </div>

      </div>

    </div>