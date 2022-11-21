<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">


    <link rel="shortcut icon" type="image/x-icon" href="{{asset('frontend/assets/img/logo1update.jpg')}}">


                            <!--     Template Link -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap-datetimepicker.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap-datetimepicker.css')}}">


    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/dataTables.bootstrap4.min.css')}}">

    {{-- <link rel="stylesheet" type="text/css" href="http://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css"> --}}

    <script src="https://unpkg.com/sweetalert@2.1.2/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    {{-- Signature --}}
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.css">    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" integrity="sha512-aOG0c6nPNzGk+5zjwyJaoRUgCdOrfSDhmMID2u4+OIslr0GjpLKo7Xm0Ao3xmpM4T8AmIouRkqwj1nrdVsLKEQ==" crossorigin="anonymous" />     
    <link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.signature.css">

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"></script>  --}}
    <style>
        /* .preloader{
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url('../image/Profile/loader.gif') 50%50% no-repeat rgb(249, 249, 249);
            opacity: 0.9;
        } */
        .kbw-signature { width: 100%; height: 200px;}
        #sig canvas{ width: 100% !important; height: auto;}
    </style>
    <title>@yield('title') </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body>
    {{-- <div class="preloader" id="preloaders"></div> --}}

    @include('sweet::alert')
    <div class="main-wrapper">
        <div class="header">
            <div class="header-left">
                <div class="logo">
                    <img src="{{asset('frontend/assets/img/logo10.jpg')}}" width="100" height="40" alt=""> <span>HS Cargo Services</span>
                </div>
            </div>
            <a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars mt-3"></i></a>
            <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="pinkcolor fa fa-bars"></i></a>

            <ul class="nav user-menu float-right">
                <li class="nav-item dropdown has-arrow">
                    <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                        <span class="user-img">
                            <img class="rounded-circle" src="{{ asset('/image/'.session('profile_pic')) }}" width="24" alt="Admin">
                        </span>
                        <span>{{session('profile_name')}}</span>

                    </a>
                    <div class="dropdown-menu">
                        @if(session()->get('user')->hasRole('Employee') || session()->get('user')->hasRole('EmployeeC'))

                        <a class="dropdown-item" href="{{route('admin_profile')}}">My Profile</a>

                        <a class="dropdown-item" href="{{route('change_admin_pw_ui')}}">Change Password</a>

                        @elseif(session()->get('user')->hasRole('Doctor') || session()->get('user')->hasRole('Rider') || session()->get('user')->hasRole('Operator') || session()->get('user')->hasRole('Manager')) 
                        <a class="dropdown-item" href="">My Profile</a>

                        {{-- <a class="dropdown-item" href="{{route('change_doc_pw_ui')}}">Change Password</a> --}}
                        <a class="dropdown-item" href="">Change Password</a>

                        @else

                        <a class="dropdown-item" href="{{route('patient_profile')}}">My Profile</a>

                        <a class="dropdown-item" href="{{route('change_pw_ui')}}">Change Password</a>

                        @endif
                        <a class="dropdown-item" href="{{route('logout')}}">Logout</a>
                    </div>
                </li>
            </ul>
            <div class="dropdown mobile-user-menu float-right">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <i class="pinkcolor fa fa-ellipsis-v mt-2"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    @if(session()->get('user')->hasRole('Employee') || session()->get('user')->hasRole('EmployeeC'))

                    <a class="dropdown-item" href="{{route('admin_profile')}}">My Profile</a>

                    <a class="dropdown-item" href="{{route('change_admin_pw_ui')}}">Change Password</a>

                    @elseif(session()->get('user')->hasRole('Doctor') || session()->get('user')->hasRole('DoctorC'))

                    <a class="dropdown-item" href="">My Profile</a>

                    {{-- <a class="dropdown-item" href="{{route('change_doc_pw_ui')}}">Change Password</a> --}}
                    <a class="dropdown-item" href="">Change Password</a>

                    @else

                    <a class="dropdown-item" href="">My Profile</a>
                    {{-- <a class="dropdown-item" href="{{route('patient_profile')}}">My Profile</a> --}}

                    {{-- <a class="dropdown-item" href="{{route('change_pw_ui')}}">Change Password</a> --}}
                    <a class="dropdown-item" href="">Change Password</a>

                    @endif

                    <a class="dropdown-item" href="{{route('logout')}}">Logout</a>
                </div>
            </div>
        </div>

        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        @if(session()->get('user')->hasRole('Employee') || session()->get('user')->hasRole('EmployeeC'))

                        <li class="menu-title">Admin Panel</li>

                        @elseif(session()->get('user')->hasRole('Doctor') || session()->get('user')->hasRole('DoctorC'))

                        <li class="menu-title">Doctor Panel</li>

                        @else

                        <li class="menu-title">Admin Panel</li>

                        @endif


                        @if(session()->get('user')->hasRole('Employee') || session()->get('user')->hasRole('EmployeeC'))

                        <li>
                            <a href="{{route('admin_dashboard')}}"><i class="bluecolor fa fa-dashboard"></i> <span>Dashboard</span></a>
                        </li>




                        @if(session()->get('user')->hasRole('Employee'))
                        <li>
                            <a href="{{route('admin_booking_list')}}"><i class="pinkcolor fa fa-calendar"></i><span>Check Booking List</span></a>
                        </li>
                        <li>
                            <a href="{{route('get_token')}}"><i class="pinkcolor fa fa-plus"></i><span>Get Booking Token</span></a>
                        </li>
                        <li class="submenu ">
                            <a href="#"><i class="pinkcolor fa fa-user-md"></i> <span> Sale</span> <span class="menu-arrow"></span></a>

                            <ul style="display: none;">
                                <li><a href="{{route('sale_page')}}">Sale Page</a></li>

                                <li><a href="{{route('sale_history')}}">Sale Record</a></li>


                                <li><a href="{{route('stock_count')}}">Stocks</a></li>

                                <li><a href="{{route('stock_reorder_page')}}">Reorder Lists</a></li>


                            </ul>
                        </li>
                        @endif

                        @if(session()->get('user')->hasRole('EmployeeC'))

                        <li>
                            <a href="{{route('patientregister')}}"><i class="pinkcolor fa fa-plus"></i><span>Patient Register</span></a>
                        </li>
                        <li>
                            <a href="{{route('today.appointments')}}"><i class="pinkcolor fa fa-calendar"></i><span>Appointments</span></a>
                        </li>
                        <li>
                            <a href="{{route('history')}}"><i class="pinkcolor fas fa-file-medical-alt"></i><span> Clinic Patient History</span></a>
                        </li>
                        <li>
                            <a href="{{route('sale_history')}}"><i class="pinkcolor fas fa-file-signature"></i><span> Sale History</span></a>
                        </li>

                        @endif


                        @if(session()->get('user')->hasRole('Employee'))

                        <li class="submenu">
                            <a href="#"><i class="pinkcolor fa fa-user-md"></i> <span> Doctors</span> <span class="menu-arrow"></span></a>

                            <ul style="display: none;">
                                <li><a href="{{route('doctor_list')}}">Doctors List</a></li>

                                <li><a href="{{route('schedule_list')}}">Doctor Schedule</a></li>

                                <li><a href="{{route('change_sch_list')}}">Change Doctor Schedule</a></li>

                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="#"><i class="pinkcolor fas fa-store-alt"></i><span>Inventory</span> <span class="menu-arrow"></span></a>

                            <ul style="display: none;">
                                <li><a href="{{route('show_category_lists')}}">Category</a></li>

                                <li><a href="{{route('show_sub_category_lists')}}">Sub Category</a></li>

                                <li><a href="{{route('show_brand_lists')}}">Brand</a></li>

                                <li><a href="{{route('show_type_lists')}}">Type</a></li>

                                <li><a href="{{route('show_item_lists')}}">Items</a></li>

                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="#"><i class="pinkcolor fa fa-user-md"></i> <span> Admin</span> <span class="menu-arrow"></span></a>

                            <ul style="display: none;">

                                <li><a href="{{route('services.lists')}}">Services</a></li>

                                <li><a href="{{route('packages.lists')}}">Packages</a></li>

                                <li><a href="{{route('state_list')}}">State and Town</a></li>

                                <li><a href="{{route('buidling_info')}}">Building</a></li>


                                <li><a href="{{route('advertisement.index')}}">Advertisements</a></li>

                                <li><a href="{{route('announcement.index')}}">Announcement Lists</a></li>

                            </ul>
                        </li>
                        @endif
                        @endif
                        @if(session()->get('user')->hasRole('Doctor') || session()->get('user')->hasRole('DoctorC') || session()->get('user')->hasRole('Manager'))
                        <li>
                            <a href="{{route('manager_dashboard')}}"><i class="bluecolor fa fa-dashboard"></i> <span>Dashboard</span></a>
                        </li>
                        {{-- <li>
                            <a href="{{route('doc.profile')}}"><i class="bluecolor fas fa-table"></i><span>Master Data</span></a>
                        </li> --}}
                        <li class="submenu">
                            <a href="#"><i class="bluecolor fas fa-table"></i><span>Master Data</span> <span class="menu-arrow"></span></a>

                            <ul style="display: none;">
                                <li><a href="{{route('township')}}"><i class="bluecolor fas fa-angle-right"></i>Township Charges</a></li>

                                <li><a href="#"><i class="bluecolor fas fa-angle-right"></i>State and Town Register</a></li>

                                <li><a href="#"><i class="bluecolor fas fa-angle-right"></i>Client Register</a></li>

                            </ul>
                        </li>
                        {{-- <li>
                            <a href="{{route('doctor.schedulelist')}}"><i class="bluecolor fas fa-map-signs"></i><span>Way Management</span></a>
                        </li> --}}
                        <li class="submenu">
                            <a href="#"><i class="bluecolor fas fa-map-signs"></i><span>Way Management</span> <span class="menu-arrow"></span></a>

                            <ul style="display: none;">

                                <li><a href="{{route('schedule')}}"><i class="bluecolor fas fa-cube mr-1"></i>Wayplan Register<i class="float-right  bluecolor fas fa-angle-right"></i></a></li>


                                <li><a href="{{route('wayplan_list')}}"><i class="bluecolor fas fa-cube mr-1"></i>Wayplan Lists<i class="float-right  bluecolor fas fa-angle-right"></i></a></li>

                                <li><a href="{{route('reject_way_list')}}"><i class="bluecolor fas fa-cube mr-1"></i> Reject Way<i class="float-right  bluecolor fas fa-angle-right"></i></a></li>

                                <li><a href="{{route('wayplanning')}}"><i class="bluecolor fas fa-cube mr-1"></i>Way Planning<i class="float-right  bluecolor fas fa-angle-right"></i></a></li>

                                {{-- rider --}}

                            </ul>
                        </li>
                        {{-- <li>
                            <a href="{{route('rider_way')}}"><i class="bluecolor fa fa-dashboard"></i> <span>Check Way Lists</span></a>
                        </li> --}}
                        @if (session()->get('user')->hasRole('Doctor') || session()->get('user')->hasRole('Manager'))

                        <li class="submenu">
                            <a href="#"><i class="bluecolor fas fa-user"></i><span>Admin </span> <span class="menu-arrow"></span></a>

                            <ul style="display: none;">
                        <li>

                            <a href="{{route('employee_list')}}"><i class="bluecolor fas fa-users mr-1"></i><span>Employee List</span><i class="float-right  bluecolor fas fa-angle-right"></i></a>
                        </li>
                        <li>
                            <a href="{{route('news_list')}}">
 
 
                                <i class="bluecolor fas fa-newspaper mr-1"></i><span>News List</span><i class="float-right  bluecolor fas fa-angle-right"></i></a>
                        </li>
                        <li>
                            <a href="{{route('contact_list')}}">
 
 
                                <i class="bluecolor fas fa-address-card mr-1"></i><span>Contact List</span><i class="float-right  bluecolor fas fa-angle-right"></i></a>
                        </li>
                         
                    </ul>
                </li>
               
                        {{-- <li>
                            <a href="{{route('doctor.onlinebookings')}}"><i class="pinkcolor fas fa-laptop-medical"></i><span>Online Booking</span></a>
                        </li>
                        <li>
                            <a href="{{route('doctor.patientHistory')}}"><i class="pinkcolor fas fa-file-signature"></i><span>Patient History</span></a>
                        </li> --}}


                        @elseif(session()->get('user')->hasRole('DoctorC'))
                        <li class="submenu">
                            <a href="#"><i class="bluecolor fas fa-history"></i><span>History</span> <span class="menu-arrow"></span></a>

                            <ul style="display: none;">

                                <li><a href="#"><i class="bluecolor fas fa-cube mr-2"></i>Way History<i class="float-right  bluecolor fas fa-angle-right"></i></a></li>

                                <li><a href="#"><i class="bluecolor fas fa-cube mr-2"></i>Pickup History<i class="float-right  bluecolor fas fa-angle-right"></i></a></li>

                                <li><a href="#"><i class="bluecolor fas fa-cube mr-2"></i>Client Payment<i class="float-right  bluecolor fas fa-angle-right"></i></a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="#"><i class="bluecolor fas fa-user-lock"></i><span>Owner Authentication</span> <span class="menu-arrow"></span></a>

                            <ul style="display: none;">

                                <li><a href="#"><i class="bluecolor fas fa-lock mr-2"></i>Authentication<i class="float-right  bluecolor fas fa-angle-right"></i></a></li>

                                <li><a href="#"><i class="bluecolor fas fa-lock mr-2"></i>Employee<i class="float-right  bluecolor fas fa-angle-right"></i></a></li>

                                <li><a href="#"><i class="bluecolor far fa-clock mr-2"></i>Total<i class="float-right  bluecolor fas fa-angle-right"></i></a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="#"><i class="bluecolor fas fa-coins"></i><span>Finicial</span> <span class="menu-arrow"></span></a>

                            <ul style="display: none;">

                                <li><a href="#"><i class="bluecolor far fa-clock mr-2"></i>Total Income<i class="float-right  bluecolor fas fa-angle-right"></i></a></li>

                                <li><a href="#"><i class="bluecolor far fa-clock mr-2"></i>Expenses Asset<i class="float-right  bluecolor fas fa-angle-right"></i></a></li>
                            </ul>
                        </li>
                        {{-- <li>
                            <a href="{{route('history')}}"><i class="pinkcolor fas fa-file-medical-alt"></i><span> Clinic Patient History</span></a>
                        </li> --}}
                        {{-- @if (session()->get('user')->isOwner(1))
                        <li>
                            <a href="{{route('sale_history')}}"><i class="pinkcolor fas fa-file-signature"></i><span> Sale History</span></a>
                        </li>

                        <li class="submenu">
                            <a href="#"><i class="pinkcolor fa fa-user-md"></i> <span> Doctors & Counter</span> <span class="menu-arrow"></span></a>

                            <ul style="display: none;">
                                <li><a href="{{route('doctor_list')}}">Doctors & Counter List</a></li>

                                <li><a href="{{route('schedule_list')}}">Doctor Schedule</a></li>

                                <li><a href="{{route('change_sch_list')}}">Change Doctor Schedule</a></li>

                            </ul>
                        </li>

                        <li class="submenu">
                            <a href="#"><i class="pinkcolor fas fa-store-alt"></i><span>Inventory</span> <span class="menu-arrow"></span></a>

                            <ul style="display: none;">
                                <li><a href="{{route('show_category_lists')}}">Category</a></li>

                                {{-- <li><a href="{{route('show_sub_category_lists')}}">Sub Category</a></li> --}}

                                {{-- <li><a href="{{route('show_brand_lists')}}">Brand</a></li> --}}

                                {{-- <li><a href="{{route('show_type_lists')}}">Type</a></li>

                                <li><a href="{{route('show_item_lists')}}">Items</a></li>

                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="#"><i class="pinkcolor fa fa-user-md"></i> <span> Admin</span> <span class="menu-arrow"></span></a>

                            <ul style="display: none;">

                                <li><a href="{{route('services.lists')}}">Services</a></li>

                                <li><a href="{{route('packages.lists')}}">Packages</a></li>

                                {{-- <li><a href="{{route('state_list')}}">State and Town</a></li> --}}

                                {{-- <li><a href="{{route('buidling_info')}}">Building</a></li> --}}


                                {{-- <li><a href="{{route('advertisement.index')}}">Advertisements</a></li>

                                <li><a href="{{route('announcement.index')}}">Announcement Lists</a></li>

                                <li><a href="{{route('getDiagnosis')}}">Diagnosis Lists</a></li>

                                <li><a href="{{route('department_list')}}">Clinics</a></li>

                            </ul>
                        </li>
                        @endif
                        @if (session()->get('user')->hasRole('DoctorC') && session()->get('user')->isOwner(0))
                        <li>
                            <a href="{{route('getDiagnosis')}}"><i class="pinkcolor fas fa-file-signature"></i><span> Diagnosis Lists</span></a>
                        </li>
                        @endif  --}}

                        @endif

                        @endif
                        @if(session()->get('user')->hasRole('Operator'))
                        <li class="submenu">
                            <a href="#"><i class="bluecolor fas fa-map-signs"></i><span>Way Management</span> <span class="menu-arrow"></span></a>

                            <ul style="display: none;">

                                <li><a href="{{route('schedule')}}"><i class="bluecolor fas fa-cube mr-1"></i>Wayplan Register<i class="float-right  bluecolor fas fa-angle-right"></i></a></li>


                                <li><a href="{{route('wayplan_list')}}"><i class="bluecolor fas fa-cube mr-1"></i>Wayplan Lists<i class="float-right  bluecolor fas fa-angle-right"></i></a></li>

                                <li><a href="{{route('reject_way_list')}}"><i class="bluecolor fas fa-cube mr-1"></i> Reject Way<i class="float-right  bluecolor fas fa-angle-right"></i></a></li>

                            </ul>
                        </li>
    

                        @endif
                        @if(session()->get('user')->hasRole('Rider'))
                        <li>
                            <a href="{{route('rider_way')}}"><i class="bluecolor fa fa-dashboard"></i> <span>Check Way Lists</span></a>
                        </li>
                        @endif

                        <li>
                            <a href="{{route('logout')}}"><i class="bluecolor fa fa-power-off"></i> <span>Logout</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="page-wrapper">
            <div class="content">

                @yield('content')


            </div>
        </div>
    </div>


    <div class="sidebar-overlay" data-reff=""></div>

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script> --}}

    <script src="{{asset('assets/js/moment.min.js')}}"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>

    <script src="{{asset('assets/js/jquery.dataTables1.min.js')}}"></script>

    <script src="{{asset('assets/js/select2.min.js')}}"></script>

    <script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>

    <script src="{{asset('assets/js/bootstrap-datetimepicker.min.js')}}"></script>

    <script src="{{asset('assets/js/jquery.slimscroll.js')}}"></script>

    <script src="{{asset('assets/js/app.js')}}"></script>

    <script src="{{asset('assets/js/validation.js')}}"></script>

    <script src="{{asset('assets/js/Chart.bundle.min.js')}}"></script>

    {{-- Signature --}}
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script> 
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="http://keith-wood.name/js/jquery.signature.js"></script>

    {{-- Barchart --}}
    
    <!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.bundle.min.js'></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->

    @yield('js')

</body>


</html>

<script type="text/javascript">

  //loader
    // $(window).on('load', function(){
    //     $("#preloaders").fadeOut(100);
    // });
    // $(document).ajaxStart(function(){
    //     $("#preloaders").show();
    // });
    // $(document).ajaxComplete(function(){
    //     $("#preloaders").hide();
    // });
//link active
    $(function() {
        var url = window.location.pathname; //sets the variable "url" to the pathname of the current window
//    alert(url);
        var activePage = url.substring(url.lastIndexOf('/') + 1); //sets the variable "activePage" as the substring after the last "/" in the "url" variable
        $('.sidebar-menu li a').each(function() { //looks in each link item within the primary-nav list
            var linkPage = this.href.substring(this.href.lastIndexOf('/') + 1); //sets the variable "linkPage" as the substring of the url path in each &lt;a&gt;
            if (activePage == linkPage) { //compares the path of the current window to the path of the linked page in the nav item
                $(this).parent().addClass('active'); //if the above is true, add the "active" class to the parent of the &lt;a&gt; which is the &lt;li&gt; in the nav list
            }
        });

        $('.sidebar-menu li ul li a').each(function() { //looks in each link item within the primary-nav list
            var linksubPage = this.href.substring(this.href.lastIndexOf('/') + 1); //sets the variable "linkPage" as the substring of the url path in each &lt;a&gt;
            if (activePage == linksubPage) { //compares the path of the current window to the path of the linked page in the nav item
                console.log($(this).parent().parent());

                $(this).parent().parent().css("display","block"); //if the above is true, add the "active" class to the parent of the &lt;a&gt; which is the &lt;li&gt; in the nav list
                }
        });
    })

    function showType(value) {
var subcategory_id= $('#sub_category').val();
var brand_id = value;

$('#type').empty();

$.ajax({
    type: 'POST',
    url: '/showType',
    dataType: 'json',
    data: {
        "_token": "{{ csrf_token() }}",
        "subcategory_id": subcategory_id,
        "brand_id": brand_id,
    },

    success: function(data) {

        console.log(data);

        $('#type').append($('<option>').text("Select"));

        $.each(data, function(i, value) {

            $('#type').append($('<option>').text(value.name).attr('value', value.id));
        });

    }

});

}

function showRelatedSubCategoryFrom(value) {

console.log(value);

$('#subcategory').prop("disabled", false);

var category_id = value;
var from_id = $('#from_id option:selected').val();

$('#subcategory').empty();

$.ajax({
    type: 'POST',
    url: '/showSubCategoryFrom',
    dataType: 'json',
    data: {
        "_token": "{{ csrf_token() }}",
        "category_id": category_id,

    },

    success: function(data) {

        console.log(data);
        $('#subcategory').append($('<option>').text('Select Subcategory'));
        $.each(data, function(i, value) {

            $('#subcategory').append($('<option>').text(value.name).attr('value', value.id));
        });
    }
});
}

function showRelatedBrandFrom(value) {
var subcategory_id = value;
$('#also_brand').empty();
var from_id = $('#from_id option:selected').val();
$.ajax({
    type: 'POST',
    url: '/showBrandFrom',
    dataType: 'json',
    data: {
        "_token": "{{ csrf_token() }}",
        "subcategory_id": subcategory_id,
        "from_id":from_id,
    },

    success: function(data) {

        console.log(data);
        $('#also_brand').append($('<option>').text('Select Brand'));

        $.each(data, function(i, value) {

            $('#also_brand').append($('<option>').text(value.name).attr('value', value.id));
        });
    }
});
}

function showRelatedTypeFrom(value) {
var subcategory_id= $('#subcategory').val();
var brand_id = value;
var from_id = $('#from_id option:selected').val();


$('#also_type').empty();

$.ajax({
    type: 'POST',
    url: '/showTypeFrom',
    dataType: 'json',
    data: {
        "_token": "{{ csrf_token() }}",
        "subcategory_id": subcategory_id,
        "brand_id": brand_id,
        "from_id":from_id,
    },

    success: function(data) {

        console.log(data);

        if(data.length==0){
            $('#also_type').append($('<option>').text("No Found"));
        }else{
            $('#also_type').append($('<option>').text("Select Type"));
            $.each(data, function(i, value) {
            $('#also_type').append($('<option>').text(value.name).attr('value', value.id));
        });
        }
    }

});

}

$('.advenced_search_btn').click(function(){
    $('.advenced_search').toggle();
});

function showRelatedItemFrom(value){

    var brand_id = $('#also_brand').val();
    var type_id = value;
var from_id = $('#from_id option:selected').val();
    $('#also_item').empty();
$.ajax({
    type: 'POST',
    url: '/showItemFrom',
    dataType: 'json',
    data: {
        "_token": "{{ csrf_token() }}",
        "type_id": type_id,
        "brand_id": brand_id,
        "from_id":from_id,

    },
    success: function(data) {

$('#also_item').append($('<option>').text('Select Item'));

$.each(data, function(i, value) {
    $('#also_item').append($('<option>').text(value.item_name).attr('value', value.id));
});

}

});

}

            function editTown(id, name, age, phone ,action) {

            $("#booking_id").attr('value', id);

            $("#booking_name").attr('value', name);

            $("#booking_age").attr('value', age);

            $("#booking_phone").attr('value', phone);
            $("#withdateOrnodate").attr('value', action);


            $("#edit_booking_record").modal("show");

            }

            $("#ajaxSubmitUpdate").click(function(e) {
                e.preventDefault();
                let booking_id = $("#booking_id").val();
                let name = $("#booking_name").val();
                let age = $("#booking_age").val();
                let phone = $("#booking_phone").val();
                let withdateOrnodate = $("#withdateOrnodate").val();
                $.ajax({

                    type: 'POST',

                    url: '{{route('edit_booking_record')}}',

                    data: {
                        "_token": "{{ csrf_token() }}",
                        "booking_id": booking_id,
                        "name": name,
                        "age": age,
                        "phone": phone,
                        "withdateOrnodate": withdateOrnodate,

                    },
                    success: function(data) {
                        if (data) {
                            swal({
                                title: "Success",
                                text: "Successfully Changed!",
                                icon: "info",
                                timer: 3000,
                            });
                            if(data[1]=='nodate'){
                                window.location.reload();
                            }
                            else{
                            $('#edit_booking_record').modal('hide');

                            $("#table_body").empty();
                            $("#online_table_body").empty();
                            myat('withdate');
                            }
                        }
                    }
                });
            });

            $("#table_body").on('click', '.doctor_book_done_btn', function() {
                let booking_id = $(this).data("id");
                let withdateOrnodate = $(this).data("dateorno");
                $('#done_booking_id').val(booking_id);
                $('#donedateOrnodate').val(withdateOrnodate);
                $('#done_booking_record').modal('show');
            })

            $("#my_form").on('submit', function(e){
                e.preventDefault();
                var description = $('#add_description').val();

                var formdata = new FormData(this);
                var diagnosis = $('#diagnosiss').val();
                // alert(diagnosis);
                formdata.append('description',description);
                formdata.append('diagonsis',diagnosis);
                console.log(formdata.getAll('remark_date'));
                console.log(formdata.getAll('description'));
                console.log(formdata.getAll('diagnosis'));
                console.log(formdata.getAll('patienthistory'));
                console.log(formdata.getAll('donedateOrnodate'));
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({

                    type: 'POST',
                    url: '{{route('doctor_done_booking')}}',
                    processData: false,
                    contentType: false,
                    cache:false,
                    data:formdata,
                    success: function(data) {
                        // alert(data);
                        if (data['status']) {
                            console.log(data);
                            swal({
                                title: "Success",
                                text: "Successfully Changed!",
                                icon: "info",
                                timer: 3000,
                            });

                            if(data['withdateOrnodate']=='nodate'){
                                myat('nodate');
                            }else
                            {
                                $("#table_body").empty();
                                $('#done_booking_record').modal('hide');
                                myat('withdate');

                            }


                        }
                    }
                });
            })

            //clinic patient search


</script>
