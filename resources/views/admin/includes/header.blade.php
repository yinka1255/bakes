<div class="row">
		
    <!-- Profile Info and Notifications -->
    <div class="col-xs-9 clearfix">

        <ul class="user-info pull-left pull-none-xsm">

            <!-- Profile Info -->
            <li class="profile-info dropdown"><!-- add class "pull-right" if you want to place this from right -->

                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="{{asset('public/staff/images/profile.png')}}" alt="" class="img-circle" width="44" />
                    {{$loggedInUser->name}}
                </a>

                <ul class="dropdown-menu">

                    <!-- Reverse Caret -->
                    <li class="caret"></li>

                    <!-- Profile sub-links -->
                    <li>
                        <a href="{{url('staff/profile')}}">
                            <i class="entypo-user"></i>
                            Edit Profile
                        </a>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
    <!-- Raw Links -->
    <div class="col-xs-3 clearfix">

        <ul class="list-inline links-list pull-right">

            <li class="sep"></li>

            <li>
                <a href="{{url('logout')}}">
                    Log Out <i class="entypo-logout right"></i>
                </a>
            </li>
        </ul>

    </div>
</div>

@if(Session::has('success'))
<script type="text/javascript">
    jQuery(document).ready(function($)
    {
        // Sample Toastr Notification
        setTimeout(function()
        {
            var opts = {
                "closeButton": true,
                "debug": false,
                "positionClass": rtl() || public_vars.$pageContainer.hasClass('right-sidebar') ? "toast-top-left" : "toast-top-right",
                "toastClass": "black",
                "onclick": null,
                "showDuration": "3000",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
    
            toastr.success("{{Session::get('success')}}", opts);
        }, 0);
    });
</script>
@endif

@if(Session::has('error'))
<script type="text/javascript">
    jQuery(document).ready(function($)
    {
        // Sample Toastr Notification
        setTimeout(function()
        {
            var opts = {
                "closeButton": true,
                "debug": false,
                "positionClass": rtl() || public_vars.$pageContainer.hasClass('right-sidebar') ? "toast-top-left" : "toast-top-right",
                "toastClass": "black",
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
    
            toastr.success("{{Session::get('error')}}", opts);
        }, 10);
    });
</script>
@endif