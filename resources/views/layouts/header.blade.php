</script>
<div class="header-container fixed-top" >
    <header class="header navbar navbar-expand-sm bg-warning navbar-light "  >

        <ul class="navbar-item theme-brand flex-row  text-center "  >
            <li class="nav-item theme-logo">
                <a>
                    <img src="{{URL('assets/img/logo.svg')}}" class="navbar-logo" alt="logo">
                </a>
            </li>
            <li class="nav-item theme-text">
                <a class="nav-link"> DrivSri </a>
            </li>
            <li></li>
            <li class="nav-item theme-text" >
                <a class="nav-link">&nbsp;&nbsp;&nbsp;&nbsp;Motor Traffic Fine and
                    Driver Point Management System </a>
            </li>
        </ul>

        <ul class="navbar-item flex-row ml-md-auto" >

            <li class="nav-item dropdown user-profile-dropdown">

                <a href="{{ route('logout') }}" class="dropdown-item ai-icon bg-transparent " onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                                <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger"  width="18"
                                height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4">
                                    </path><polyline points="16 17 21 12 16 7">
                                    </polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                                <span class="ml-2" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();"> Logout</span>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </a>



                    </div>
                </div>
            </li>

        </ul>
    </header>
</div>




<!--  BEGIN NAVBAR  -->
<div class="sub-header-container fixed-top">
    <header class="header navbar navbar-expand-sm">
                <ul class="navbar-nav flex-row ">
            <li>
                <div class="nav justify-content-center" >

                    {{--  <nav class="breadcrumb-one" aria-label="breadcrumb">
                                                 <li class="breadcrumb-item" style="font-size:20px"><b><a href="javascript:void(0);"><p class="text-success">
                                &nbsp; &nbsp;&nbsp; &nbsp; Welcome {{ Auth::user()->user_name}} </b></p></a></li>
                        </ol>
                    </nav>  --}}

                </div>
            </li>
        </ul>

    </header>
</div>
<!--  END NAVBAR  -->


