<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Language" content="en">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>NTG Hub Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
<link href="{{ asset('css/main.css') }}" rel="stylesheet">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>
<body>

<div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header fixed-footer">
	<div class="app-header header-shadow bg-royal header-text-light">
		<div class="app-header__logo">
			<div class="logo-src" style="height:35px !important;width:105px !important;"></div>
			<div class="header__pane ml-auto">
				<div>
					<button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
						<span class="hamburger-box">
							<span class="hamburger-inner"></span>
						</span>
					</button>
				</div>
			</div>
		</div>
		<div class="app-header__mobile-menu">
			<div>
				<button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
					<span class="hamburger-box">
						<span class="hamburger-inner"></span>
					</span>
				</button>
			</div>
		</div>
		<div class="app-header__menu">
			<span>
				<button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
					<span class="btn-icon-wrapper">
						<i class="fa fa-ellipsis-v fa-w-6"></i>
					</span>
				</button>
			</span>
		</div>    
		<div class="app-header__content">
			<div class="app-header-right">
				<div class="header-btn-lg pr-0">
					<div class="widget-content p-0">
						<div class="widget-content-wrapper">
							<div class="widget-content-left">
								<div class="btn-group">
									<a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
										<i class="fa fa-angle-down ml-2 opacity-8"></i>
									</a>
									<div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
										<button type="button" tabindex="0" class="dropdown-item">User Account</button>
										<div tabindex="-1" class="dropdown-divider"></div>
                    <button type="button" tabindex="0" class="dropdown-item">Change Password</button>
                    <div tabindex="-1" class="dropdown-divider"></div>
                    <form action="{{route('logout')}}" method="post">
                      @csrf
										  <button tabindex="0" class="dropdown-item">Logout</button>
                    </form>
									</div>
								</div>
							</div>
							<div class="widget-content-left  ml-3 header-user-info">
								<div class="widget-heading">
									{{ Auth::user()->name }}
								</div>
								<div class="widget-subheading">
									@if(Auth::user()->user_type == 1)
									 Administrator
									@elseif(Auth::user()->user_type == 0)
									 Staff
									@else
									 Unknown Type
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>        
			</div>
		</div>
	</div>
 	<div class="app-main">
	  <div class="app-sidebar sidebar-shadow bg-royal sidebar-text-light">
	    <div class="app-header__logo">
	      <div class="logo-src"></div>
	      <div class="header__pane ml-auto">
	        <div>
	          <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
	            <span class="hamburger-box">
	              <span class="hamburger-inner"></span>
	            </span>
	          </button>
	        </div>
	      </div>
	    </div>
	    <div class="app-header__mobile-menu">
	      <div>
	        <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
	          <span class="hamburger-box">
	            <span class="hamburger-inner"></span>
	          </span>
	        </button>
	      </div>
	    </div>
	    <div class="app-header__menu">
	      <span>
	        <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
	          <span class="btn-icon-wrapper">
	            <i class="fa fa-ellipsis-v fa-w-6"></i>
	          </span>
	        </button>
	      </span>
	    </div>    <div class="scrollbar-sidebar">
	      <div class="app-sidebar__inner">
	        <ul class="vertical-nav-menu">
	          <li class="app-sidebar__heading">
	          	CRM Tools
	        	</li>

	          <li>
	            <a href="{{route('home')}}" class="{{ ($header == 'dashboard') ? 'mm-active' : '' }}">
	              <i class="metismenu-icon pe-7s-note2"></i>
	              Dashboard
	            </a>
	          </li>

            <li class="app-sidebar__heading">
              Customer
            </li>

	          <li>
	            <a href="{{route('getRegisterCustomer')}}" class="{{ ($header == 'rc') ? 'mm-active' : '' }}">
	              <i class="metismenu-icon pe-7s-add-user"></i>
	              Customer Register
	            </a>
	          </li>

            <li>
              <a href="#" class="">
                <i class="metismenu-icon pe-7s-id"></i>
                Customer List
              </a>
            </li>

	          <li>
	            <a href="{{route('getVerification')}}" class="{{ ($header == 'verification') ? 'mm-active' : '' }}">
	              <i class="metismenu-icon pe-7s-check"></i>
	              Customer Verification
	            </a>
	          </li>

            <li class="app-sidebar__heading">
              Report
            </li>

	          <li class="{{($header == 'report') ? 'mm-active' : ''}}">
	            <a href="#">
                <i class="metismenu-icon pe-7s-file"></i>
                Report List
                <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
              </a>
              <ul class="">
                <li>
                  <a href="#">
                    <i class="metismenu-icon"></i>
                    Report 1
                  </a>
                </li>
                <li>
                  <a href="#">
                    <i class="metismenu-icon"></i>
                    Report 2
                  </a>
                </li>
              </ul>
	          </li>



          </ul>
	      </div>
	    </div>
	  </div>   
	  <div class="app-main__outer">
	  	<div class="app-main__inner">
  			@yield('content')
			</div>
		</div>
	</div>
</div>

</body>
<script type="text/javascript" src="{{ asset('scripts/main.js') }}"></script>
</html>
