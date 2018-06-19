
<li class="nav-item">
    <a href="{{action('FlightController@index')}}" class="nav-link {{Helper::isCurrent('flight')}}"><i class="fe fe-list"></i> Flights</a>
</li>

<li class="nav-item">
    <a href="{{action('CarrierController@index')}}" class="nav-link {{Helper::isCurrent('carrier')}}"><i class="fe fe-send"></i> Carrier</a>
</li>

<li class="nav-item">
    <a href="{{action('ReportController@index')}}" class="nav-link {{Helper::isCurrent('report')}}"><i class="fe fe-file-text"></i> Reports</a>
</li>


