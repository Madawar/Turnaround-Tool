<li class="nav-item">
    <a href="{{action('DashboardController@index')}}" class="nav-link {{Helper::isCurrent('dashboard')}}"><i class="fe fe-compass"></i> Dashboard</a>
</li>

<li class="nav-item">
    <a href="{{action('FlightController@index')}}" class="nav-link {{Helper::isCurrent('flight')}}"><i class="fe fe-list"></i> Flights</a>
</li>
@can('create', \App\User::class)
<li class="nav-item">
    <a href="{{action('CarrierController@index')}}" class="nav-link {{Helper::isCurrent('carrier')}}"><i class="fe fe-send"></i> Carrier</a>
</li>
@endcan
<li class="nav-item">
    <a href="{{action('ReportController@index')}}" class="nav-link {{Helper::isCurrent('report')}}"><i class="fe fe-file-text"></i> Reports</a>
</li>

@can('create', \App\User::class)
    <li class="nav-item">
        <a href="{{action('UserController@index')}}" class="nav-link {{Helper::isCurrent('user')}}"><i
                    class="fe fe-users"></i> User Management</a>
    </li>
@endcan


