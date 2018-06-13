
<li class="nav-item">
    <a href="{{action('FlightController@index')}}" class="nav-link {{Helper::isCurrent('flight')}}"><i class="fe fe-box"></i> Flights</a>
</li>

<li class="nav-item">
    <a href="{{action('CarrierController@index')}}" class="nav-link {{Helper::isCurrent('carrier')}}"><i class="fal fa-helicopter"></i> Carrier</a>
</li>

<li class="nav-item">
    <a href="{{action('ReportController@index')}}" class="nav-link {{Helper::isCurrent('report')}}"><i class="fal fa-file"></i> Reports</a>
</li>


