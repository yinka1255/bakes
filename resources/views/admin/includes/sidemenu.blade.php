<div class="sidebar-menu">

    <div class="sidebar-menu-inner">
        
        <header class="logo-env">

            <!-- logo -->
            <div class="logo">
                <a href="index.html">
                    <img src="{{asset('public/staff/images/logo.jpg')}}" width="80" alt="" />
                </a>
            </div>

            <!-- logo collapse icon -->
            <div class="sidebar-collapse">
                <a href="#" class="sidebar-collapse-icon"><!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
                    <i class="entypo-menu"></i>
                </a>
            </div>

                            
            <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
            <div class="sidebar-mobile-menu visible-xs">
                <a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
                    <i class="entypo-menu"></i>
                </a>
            </div>

        </header>
        
                                
        <ul id="main-menu" class="main-menu">
            <!-- add class "multiple-expanded" to allow multiple submenus to open -->
            <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
            <li @if(Request::segment(2) == "index") class="active" @endif>
                <a href="{{url('admin/index')}}">
                    <i class="entypo-gauge"></i>
                    <span class="title">Dashboard </span>
                </a>
            </li>
            
            <li class="active" >
                <a href="{{url('admin/jobs')}}">
                    <i class="entypo-briefcase"></i>
                    <span class="title">Jobs </span>
                </a>
            </li>
            
        </ul>
        
    </div>
</div>
