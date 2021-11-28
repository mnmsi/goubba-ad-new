<!doctype html>
<html lang="en" dir="ltr">
	<head>
        <?php
            header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
            header("Cache-Control: post-check=0, pre-check=0", false);
            header("Pragma: no-cache");
        ?>

		<!-- META DATA -->
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="keywords" content="analytics dashboard, bootstrap 4 web app admin template, bootstrap admin panel, bootstrap admin template, bootstrap dashboard, bootstrap panel, Application dashboard design, dashboard design template, dashboard jquery clean html, dashboard template theme, dashboard responsive ui, html admin backend template ui kit, html flat dashboard template, it admin dashboard ui, premium modern html template">
        <meta name="csrf-token" content="{{ csrf_token() }}">

		<!-- FAVICON -->
		<link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/brand/favicon.ico') }}" />

		<!-- TITLE -->
		<title>Goubba Ad - @yield('title')</title>

		<!-- BOOTSTRAP CSS -->
		<link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />

		<!-- STYLE CSS -->
		<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet"/>
		<link href="{{ asset('assets/css/dark-style.css') }}" rel="stylesheet"/>
		<link href="{{ asset('assets/css/skin-modes.css') }}" rel="stylesheet"/>

		<!-- SIDE-MENU CSS -->
		<link href="{{ asset('assets/css/closed-sidemenu.css') }}" rel="stylesheet">

		<!-- P-scroll bar css-->
		<link href="{{ asset('assets/plugins/p-scroll/perfect-scrollbar.css') }}" rel="stylesheet" />

		<!--- FONT-ICONS CSS -->
		<link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet"/>

		<!-- SIDEBAR CSS -->
		<link href="{{ asset('assets/plugins/sidebar/sidebar.css') }}" rel="stylesheet">

		<!-- COLOR SKIN CSS -->
		<link id="theme" rel="stylesheet" type="text/css" media="all" href="{{ asset('assets/colors/color1.css') }}" />

        <!-- FILE UPLODE CSS -->
        <link href="{{ asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css"/>

        <!-- MULTI SELECT CSS -->
		<link rel="stylesheet" href="{{ asset('assets/plugins/multipleselect/multiple-select.css') }}">

        <!-- SELECT2 CSS -->
		<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet"/>

        <!-- ANIMATION CSS -->
		<link href="{{ asset('assets/plugins/dreyanim/dreyanim.css') }}" rel="stylesheet"/>

        <!-- TOASTR CSS -->
		<link href="{{ asset('assets/plugins/toastr/toastr.min.css') }}" rel="stylesheet"/>

        <!-- MORRIS CSS-->
		<link href="{{ asset('assets/plugins/morris/morris.css') }}" rel="stylesheet"/>

        <!-- DRAGGABLE ELEMENT-->
		<link href="{{ asset('assets/plugins/draggable-element/draggable-element.css') }}" rel="stylesheet"/>

        <!--C3 CHARTS CSS -->
		{{-- <link href="{{ asset('assets/plugins/charts-c3/c3-chart.css') }}" rel="stylesheet"/> --}}

        <style>
            .modal-custom {
                position: fixed;
                z-index: 9999;
                padding-top: 100px;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: rgb(0, 0, 0);
                background-color: rgba(0, 0, 0, 0.4);
            }

            .modal-content-custom {
                background-color: #fff;
                width: 90%;
                padding: 15px;
                overflow: hidden;
                position: relative;
                box-sizing: border-box;
                max-width: 500px;
                max-height: auto;
                margin: auto;
                border: 0px solid #fcfcfc;
                padding: 15px;
                border-radius: 20px;
                font-family: "Libre Franklin", "Helvetica Neue", helvetica, arial, sans-serif;
            }

            .modal-close-custom {
                font-size: 40px;
                float: right;
                font-weight: 200;
                color: rgba(0, 0, 0, 0.6);
                margin-top: -10px;
                transition: all .2s;
                cursor: pointer;
                width: auto;
            }

            .modal-close-custom:hover {
                color: #3b3b3b;
            }

            .modal-img-custom svg {
                width: 60%;
                margin: -0px auto;
            }

            .modal-footer-custom {
                padding: 20px 30px;
                color: #fff;
                width: auto;
                text-align: center;
                background-color: #fc801c;
                margin: -15px;
                line-height: 1em;
            }

            .modal-footer-custom h2 {
                font-size: 25px;
            }

            .modal-footer-custom p {
                font-weight: 200;
                width: 70%;
                margin: auto;
                font-size: 15px;
            }

            @media screen and (max-width: 27em) {
                .modal-content-custom {
                    width: 90%;
                }
                .modal-footer-custom h2 {
                    font-size: 15px;
                }
                .modal-footer-custom p {
                    font-weight: 200;
                    width: 100%;
                    font-size: 10px;
                }
            }
            .st0 {
                fill: #F4E552;
            }
            .st1 {
                fill: none;
                stroke: #fc801c;
                stroke-width: 0.75;
                stroke-linecap: round;
                stroke-linejoin: round;
                stroke-miterlimit: 10;
            }
            .st2 {
                fill: none;
                stroke: #111111;
                stroke-width: 0.75;
                stroke-linecap: round;
                stroke-linejoin: round;
                stroke-miterlimit: 10;
            }
            .st3 {
                fill: #FFFFFF;
                stroke: #111111;
                stroke-width: 0.75;
                stroke-linecap: round;
                stroke-linejoin: round;
                stroke-miterlimit: 10;
            }
            .st4 {
                fill: #fc801c;
            }
            .st5 {
                fill: #FFFFFF;
            }
            .st6 {
                font-family: 'roboto';
                font-weight: 500;
            }
            .st7 {
                font-size: 22.7015px;
            }
            .st8 {
                fill: none;
                stroke: #F4E552;
                stroke-width: 0.75;
                stroke-linecap: round;
                stroke-linejoin: round;
                stroke-miterlimit: 10;
            }
            .st9 {
                fill: #fc801c;
                stroke: #111111;
                stroke-width: 0.75;
                stroke-linecap: round;
                stroke-linejoin: round;
                stroke-miterlimit: 10;
            }
            .st10 {
                fill: #fc801c;
            }
            .st11 {
                fill: #FCEED0;
            }
        </style>

        <script type="text/javascript">
            window.adblockEnabled = true;
            var BASE_URL = '{{ env('APP_URL') }}';
        </script>

        <script type="text/javascript" src="{{ asset('assets/ads/ads.js') }}"></script>

        <!-- Verify in some script if adblock is enabled -->
        <script type="text/javascript">
            window.onload = function() {
                setTimeout(function() {
                    if(window.adblockEnabled) {
                        var modal = document.getElementById("myModal");
                        modal.style.display = "block";
                    }
                }, 1000);
            };
        </script>

        @yield('style')
	</head>

	<body class="app sidebar-mini">

        {{-- ADD BLOCKER MODAL --}}
        @include('components.adBlockerModal')
        {{--END ADD BLOCKER MODAL --}}


		<!-- GLOBAL-LOADER -->
		<div id="global-loader">
			<img src="{{ asset('assets/images/loader.svg') }}" class="loader-img" alt="Loader">
		</div>
		<!-- /GLOBAL-LOADER -->

		<!-- PAGE -->
		<div id="app" class="page">
			<div class="page-main">

				<!--APP-SIDEBAR-->
				<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
				<aside class="app-sidebar">
					<div class="side-header">
						<a class="header-brand1" href="index.html">
							<img src="{{ asset('assets/images/brand/logo.png') }}" class="header-brand-img desktop-logo" alt="logo">
							<img src="{{ asset('assets/images/brand/logo-1.png') }}" class="header-brand-img toggle-logo" alt="logo">
							<img src="{{ asset('assets/images/brand/logo-2.png') }}" class="header-brand-img light-logo" alt="logo">
							<img src="{{ asset('assets/images/brand/logo-3.png') }}" class="header-brand-img light-logo1" alt="logo">
						</a><!-- LOGO -->
						<a aria-label="Hide Sidebar" class="app-sidebar__toggle ml-auto" data-toggle="sidebar" href="#"></a><!-- sidebar-toggle-->
					</div>
					<div class="app-sidebar__user">
						<div class="dropdown user-pro-body text-center">
							<div class="user-pic">
								<img src="{{ asset('assets/images/users/10.jpg') }}" alt="user-img" class="avatar-xl rounded-circle">
							</div>
							<div class="user-info">
								<h6 class=" mb-0 text-dark">Elizabeth Dyer</h6>
								<span class="text-muted app-sidebar__user-name text-sm">Administrator</span>
							</div>
						</div>
					</div>
					<div class="sidebar-navs">
						<ul class="nav  nav-pills-circle">
							<li class="nav-item" data-toggle="tooltip" data-placement="top" title="Settings">
								<a class="nav-link text-center m-2">
									<i class="fe fe-settings"></i>
								</a>
							</li>
							<li class="nav-item" data-toggle="tooltip" data-placement="top" title="Chat">
								<a class="nav-link text-center m-2">
									<i class="fe fe-mail"></i>
								</a>
							</li>
							<li class="nav-item" data-toggle="tooltip" data-placement="top" title="Followers">
								<a class="nav-link text-center m-2">
									<i class="fe fe-user"></i>
								</a>
							</li>
							<li class="nav-item" data-toggle="tooltip" data-placement="top" title="Logout">
                                <form method="POST" action="{{ route('logout') }}" id="logoutform">
                                    @csrf
                                    <a href="javascript:void(0)" onclick="logoutform.submit()" class="nav-link text-center m-2" form="logoutForm">
                                        <i class="fe fe-power"></i>
                                    </a>
                                </form>
							</li>
						</ul>
					</div>
					<ul class="side-menu">
						<li><h3>Main</h3></li>
						<li class="slide">
							<a class="side-menu__item"  data-toggle="slide" href="{{ route('dashboard') }}"><i class="side-menu__icon ti-home"></i><span class="side-menu__label">Dashboard</span><i class="angle fa fa-angle-right"></i></a>
						</li>

                        @if (Auth::user()->role_id == 1)
                            <li class="slide">
                                <a class="side-menu__item"  data-toggle="slide" href="#">
                                    <i class="side-menu__icon ti-home"></i><span class="side-menu__label">Advertiser Manager</span><i class="angle fa fa-angle-right"></i>
                                </a>
                                <ul class="slide-menu">
                                    <li>
                                        <a class="slide-item"  href="{{ route('users.list') }}"><span>Advertisers</span></a>
                                    </li>
                                    <li>
                                        <a class="slide-item" href="{{ route('users.create') }}"><span>Add Advertiser</span></a>
                                    </li>
                                </ul>
                            </li>
                        @endif

                        <li class="slide">
                            <a class="side-menu__item"  data-toggle="slide" href="#">
                                <i class="side-menu__icon ti-home"></i><span class="side-menu__label">Campaign Management</span><i class="angle fa fa-angle-right"></i>
                            </a>
                            <ul class="slide-menu">
                                <li>
                                    <a class="slide-item"  href="{{route('adv.list')}}"><span>Campaigns</span></a>
                                </li>
                                <li>
                                    <a class="slide-item" href="{{route('adv.create')}}"><span>Create Campaign</span></a>
                                </li>
                            </ul>
                        </li>

					</ul>
				</aside>
				<!--/APP-SIDEBAR-->

				<!-- Mobile Header -->
				<div class="mobile-header">
					<div class="container-fluid">
						<div class="d-flex">
							<a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-toggle="sidebar" href="#"></a><!-- sidebar-toggle-->
							<a class="header-brand" href="index.html">
								<img src="{{ asset('assets/images/brand/logo.png') }}" class="header-brand-img desktop-logo" alt="logo">
								<img src="{{ asset('assets/images/brand/logo-3.png') }}" class="header-brand-img desktop-logo mobile-light" alt="logo">
							</a>
							<div class="d-flex order-lg-2 ml-auto header-right-icons">
								<button class="navbar-toggler navresponsive-toggler d-md-none" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4"
									aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
									<span class="navbar-toggler-icon fe fe-more-vertical text-white"></span>
								</button>
								<div class="dropdown profile-1">
									<a href="#" data-toggle="dropdown" class="nav-link pr-2 leading-none d-flex">
										<span>
											<img src="{{ asset('assets/images/users/10.jpg') }}" alt="profile-user" class="avatar  profile-user brround cover-image">
										</span>
									</a>
									<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
										<div class="drop-heading">
											<div class="text-center">
												<h5 class="text-dark mb-0">Elizabeth Dyer</h5>
												<small class="text-muted">Administrator</small>
											</div>
										</div>
										<div class="dropdown-divider m-0"></div>
										<a class="dropdown-item" href="#">
											<i class="dropdown-icon mdi mdi-account-outline"></i> Profile
										</a>
										<a class="dropdown-item" href="#">
											<i class="dropdown-icon  mdi mdi-settings"></i> Settings
										</a>
										<a class="dropdown-item" href="#">
											<span class="float-right"></span>
											<i class="dropdown-icon mdi  mdi-message-outline"></i> Inbox
										</a>
										<a class="dropdown-item" href="#">
											<i class="dropdown-icon mdi mdi-comment-check-outline"></i> Message
										</a>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="#">
											<i class="dropdown-icon mdi mdi-compass-outline"></i> Need help?
										</a>
										<a class="dropdown-item" href="login.html">
											<i class="dropdown-icon mdi  mdi-logout-variant"></i> Sign out
										</a>
									</div>
								</div>
								<div class="dropdown d-md-flex header-settings">
									<a href="#" class="nav-link icon " data-toggle="sidebar-right" data-target=".sidebar-right">
										<i class="fe fe-align-right"></i>
									</a>
								</div><!-- SIDE-MENU -->
							</div>
						</div>
					</div>
				</div>

				<div class="mb-1 navbar navbar-expand-lg  responsive-navbar navbar-dark d-md-none bg-white">
					<div class="collapse navbar-collapse" id="navbarSupportedContent-4">
						<div class="d-flex order-lg-2 ml-auto">
							<div class="dropdown d-sm-flex">
								<a href="#" class="nav-link icon" data-toggle="dropdown">
									<i class="fe fe-search"></i>
								</a>
								<div class="dropdown-menu header-search dropdown-menu-left">
									<div class="input-group w-100 p-2">
										<input type="text" class="form-control " placeholder="Search....">
										<div class="input-group-append ">
											<button type="button" class="btn btn-primary ">
												<i class="fa fa-search" aria-hidden="true"></i>
											</button>
										</div>
									</div>
								</div>
							</div><!-- SEARCH -->
							<div class="dropdown d-md-flex">
								<a class="nav-link icon full-screen-link nav-link-bg">
									<i class="fe fe-maximize fullscreen-button"></i>
								</a>
							</div><!-- FULL-SCREEN -->
							<div class="dropdown d-md-flex notifications">
								<a class="nav-link icon" data-toggle="dropdown">
									<i class="fe fe-bell"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
									<div class="notifications-menu">
										<a class="dropdown-item d-flex pb-3" href="#">
											<div class="fs-16 text-success mr-3">
												<i class="fa fa-thumbs-o-up"></i>
											</div>
											<div class="">
												<strong>Someone likes our posts.</strong>
											</div>
										</a>
										<a class="dropdown-item d-flex pb-3" href="#">
											<div class="fs-16 text-primary mr-3">
												<i class="fa fa-commenting-o"></i>
											</div>
											<div class="">
												<strong>3 New Comments.</strong>
											</div>
										</a>
										<a class="dropdown-item d-flex pb-3" href="#">
											<div class="fs-16 text-danger mr-3">
												<i class="fa fa-cogs"></i>
											</div>
											<div class="">
												<strong>Server Rebooted</strong>
											</div>
										</a>
									</div>
									<div class="dropdown-divider"></div>
									<a href="#" class="dropdown-item text-center">View all Notification</a>
								</div>
							</div>

                            <!-- NOTIFICATIONS -->
							<div class="dropdown d-md-flex message">
								<a class="nav-link icon text-center" data-toggle="dropdown">
									<i class="fe fe-mail"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
									<div class="message-menu">
										<a class="dropdown-item d-flex pb-3" href="#">
											<span class="avatar avatar-md brround mr-3 align-self-center cover-image" data-image-src="{{ asset('assets/images/users/1.jpg') }}"></span>
											<div>
												<strong>Madeleine</strong> Hey! there I' am available....
												<div class="small text-muted">
													3 hours ago
												</div>
											</div>
										</a>
										<a class="dropdown-item d-flex pb-3" href="#">
											<span class="avatar avatar-md brround mr-3 align-self-center cover-image" data-image-src="{{ asset('assets/images/users/12.jpg') }}"></span>
											<div>
												<strong>Anthony</strong> New product Launching...
												<div class="small text-muted">
													5 hour ago
												</div>
											</div>
										</a>
										<a class="dropdown-item d-flex pb-3" href="#">
											<span class="avatar avatar-md brround mr-3 align-self-center cover-image" data-image-src="{{ asset('assets/images/users/4.jpg') }}"></span>
											<div>
												<strong>Olivia</strong> New Schedule Realease......
												<div class="small text-muted">
													45 mintues ago
												</div>
											</div>
										</a>
										<a class="dropdown-item d-flex pb-3" href="#">
											<span class="avatar avatar-md brround mr-3 align-self-center cover-image" data-image-src="{{ asset('assets/images/users/15.jpg') }}"></span>
											<div>
												<strong>Sanderson</strong> New Schedule Realease......
												<div class="small text-muted">
													2 days ago
												</div>
											</div>
										</a>
									</div>
									<div class="dropdown-divider"></div>
									<a href="#" class="dropdown-item text-center">See all Messages</a>
								</div>
							</div><!-- MESSAGE-BOX -->
						</div>
					</div>
				</div>
				<!-- /Mobile Header -->

                <!--app-content open-->
				<div class="app-content">
                    <div class="side-app">

                        <!-- PAGE-HEADER -->
                        <div class="page-header">
                            <a aria-label="Hide Sidebar" class="app-sidebar__toggle close-toggle" data-toggle="sidebar" href="#"></a><!-- sidebar-toggle-->
                            <div>
                               @yield('breadcrumb')
                            </div>

                            <div class="d-flex  ml-auto header-right-icons header-search-icon">
                                @yield('campaigns')

                                <div class="dropdown d-sm-flex">
                                    <a href="#" class="nav-link icon" data-toggle="dropdown">
                                        <i class="fe fe-search"></i>
                                    </a>
                                    <div class="dropdown-menu header-search dropdown-menu-left">
                                        <div class="input-group w-100 p-2">
                                            <input type="text" class="form-control " placeholder="Search....">
                                            <div class="input-group-append ">
                                                <button type="button" class="btn btn-primary ">
                                                    <i class="fa fa-search" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- SEARCH -->
                                <div class="dropdown d-md-flex">
                                    <a class="nav-link icon full-screen-link nav-link-bg">
                                        <i class="fe fe-maximize fullscreen-button"></i>
                                    </a>
                                </div><!-- FULL-SCREEN -->
                                <div class="dropdown d-md-flex notifications">
                                    <a class="nav-link icon" data-toggle="dropdown">
                                        <i class="fe fe-bell"></i>
                                        <span class="nav-unread badge badge-success badge-pill">2</span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                        <div class="notifications-menu">
                                            <a class="dropdown-item d-flex pb-3" href="#">
                                                <div class="fs-16 text-success mr-3">
                                                    <i class="fa fa-thumbs-o-up"></i>
                                                </div>
                                                <div class="">
                                                    <strong>Someone likes our posts.</strong>
                                                </div>
                                            </a>
                                            <a class="dropdown-item d-flex pb-3" href="#">
                                                <div class="fs-16 text-primary mr-3">
                                                    <i class="fa fa-commenting-o"></i>
                                                </div>
                                                <div class="">
                                                    <strong>3 New Comments.</strong>
                                                </div>
                                            </a>
                                            <a class="dropdown-item d-flex pb-3" href="#">
                                                <div class="fs-16 text-danger mr-3">
                                                    <i class="fa fa-cogs"></i>
                                                </div>
                                                <div class="">
                                                    <strong>Server Rebooted</strong>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="dropdown-divider"></div>
                                        <a href="#" class="dropdown-item text-center">View all Notification</a>
                                    </div>
                                </div><!-- NOTIFICATIONS -->
                                <div class="dropdown d-md-flex message">
                                    <a class="nav-link icon text-center" data-toggle="dropdown">
                                        <i class="fe fe-mail"></i>
                                        <span class="nav-unread badge badge-danger badge-pill">3</span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                        <div class="message-menu">
                                            <a class="dropdown-item d-flex pb-3" href="#">
                                                <span class="avatar avatar-md brround mr-3 align-self-center cover-image" data-image-src="{{ asset('assets/images/users/1.jpg') }}"></span>
                                                <div>
                                                    <strong>Madeleine</strong> Hey! there I' am available....
                                                    <div class="small text-muted">
                                                        3 hours ago
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item d-flex pb-3" href="#">
                                                <span class="avatar avatar-md brround mr-3 align-self-center cover-image" data-image-src="{{ asset('assets/images/users/12.jpg') }}"></span>
                                                <div>
                                                    <strong>Anthony</strong> New product Launching...
                                                    <div class="small text-muted">
                                                        5 hour ago
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item d-flex pb-3" href="#">
                                                <span class="avatar avatar-md brround mr-3 align-self-center cover-image" data-image-src="{{ asset('assets/images/users/4.jpg') }}"></span>
                                                <div>
                                                    <strong>Olivia</strong> New Schedule Realease......
                                                    <div class="small text-muted">
                                                        45 mintues ago
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item d-flex pb-3" href="#">
                                                <span class="avatar avatar-md brround mr-3 align-self-center cover-image" data-image-src="{{ asset('assets/images/users/15.jpg') }}"></span>
                                                <div>
                                                    <strong>Sanderson</strong> New Schedule Realease......
                                                    <div class="small text-muted">
                                                        2 days ago
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="dropdown-divider"></div>
                                        <a href="#" class="dropdown-item text-center">See all Messages</a>
                                    </div>
                                </div><!-- MESSAGE-BOX -->
                                <div class="dropdown profile-1">
                                    <a href="#" data-toggle="dropdown" class="nav-link pr-2 leading-none d-flex">
                                        <span>
                                            <img src="{{ asset('assets/images/users/10.jpg') }}" alt="profile-user" class="avatar  profile-user brround cover-image">
                                        </span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                        <div class="drop-heading">
                                            <div class="text-center">
                                                <h5 class="text-dark mb-0">Elizabeth Dyer</h5>
                                                <small class="text-muted">Administrator</small>
                                            </div>
                                        </div>
                                        <div class="dropdown-divider m-0"></div>
                                        <a class="dropdown-item" href="#">
                                            <i class="dropdown-icon mdi mdi-account-outline"></i> Profile
                                        </a>
                                        <a class="dropdown-item" href="#">
                                            <i class="dropdown-icon  mdi mdi-settings"></i> Settings
                                        </a>
                                        <a class="dropdown-item" href="#">
                                            <span class="float-right"></span>
                                            <i class="dropdown-icon mdi  mdi-message-outline"></i> Inbox
                                        </a>
                                        <a class="dropdown-item" href="#">
                                            <i class="dropdown-icon mdi mdi-comment-check-outline"></i> Message
                                        </a>
                                        <div class="dropdown-divider mt-0"></div>
                                        <a class="dropdown-item" href="#">
                                            <i class="dropdown-icon mdi mdi-compass-outline"></i> Need help?
                                        </a>
                                        <a class="dropdown-item" href="login.html">
                                            <i class="dropdown-icon mdi  mdi-logout-variant"></i> Sign out
                                        </a>
                                    </div>
                                </div>
                                <div class="dropdown d-md-flex header-settings">
                                    <a href="#" class="nav-link icon " data-toggle="sidebar-right" data-target=".sidebar-right">
                                        <i class="fe fe-align-right"></i>
                                    </a>
                                </div><!-- SIDE-MENU -->
                            </div>
                        </div>
                        <!-- PAGE-HEADER END -->

                        @yield('content')
                    </div>

				</div>
				<!-- CONTAINER END -->
            </div>

			<!-- SIDE-BAR -->
			<div class="sidebar sidebar-right sidebar-animate">
			   <div class="p-4 border-bottom">
			        <span class="fs-17">Notifications</span>
					<a href="#" class="sidebar-icon text-right float-right" data-toggle="sidebar-right" data-target=".sidebar-right"><i class="fe fe-x"></i></a>
				</div>
				<div class="list d-flex align-items-center border-bottom p-4">
					<div class="">
						<span class="avatar bg-primary brround avatar-md">CH</span>
					</div>
					<div class="wrapper w-100 ml-3">
						<p class="mb-0 d-flex">
							<b>New Websites is Created</b>
						</p>
						<div class="d-flex justify-content-between align-items-center">
							<div class="d-flex align-items-center">
								<i class="mdi mdi-clock text-muted mr-1"></i>
								<small class="text-muted ml-auto">30 mins ago</small>
								<p class="mb-0"></p>
							</div>
						</div>
					</div>
				</div><!-- LIST END -->
				<div class="list d-flex align-items-center border-bottom p-4">
					<div class="">
						<span class="avatar bg-danger brround avatar-md">N</span>
					</div>
					<div class="wrapper w-100 ml-3">
						<p class="mb-0 d-flex">
							<b>Prepare For the Next Project</b>
						</p>
						<div class="d-flex justify-content-between align-items-center">
							<div class="d-flex align-items-center">
								<i class="mdi mdi-clock text-muted mr-1"></i>
								<small class="text-muted ml-auto">2 hours ago</small>
								<p class="mb-0"></p>
							</div>
						</div>
					</div>
				</div><!-- LIST END -->
				<div class="list d-flex align-items-center border-bottom p-4">
					<div class="">
						<span class="avatar bg-info brround avatar-md">S</span>
					</div>
					<div class="wrapper w-100 ml-3">
						<p class="mb-0 d-flex">
							<b>Decide the live Discussion Time</b>
						</p>
						<div class="d-flex justify-content-between align-items-center">
							<div class="d-flex align-items-center">
								<i class="mdi mdi-clock text-muted mr-1"></i>
								<small class="text-muted ml-auto">3 hours ago</small>
								<p class="mb-0"></p>
							</div>
						</div>
					</div>
				</div><!-- LIST END -->
				<div class="list d-flex align-items-center border-bottom p-4">
					<div class="">
						<span class="avatar bg-warning brround avatar-md">K</span>
					</div>
					<div class="wrapper w-100 ml-3">
						<p class="mb-0 d-flex">
							<b>Team Review meeting</b>
						</p>
						<div class="d-flex justify-content-between align-items-center">
							<div class="d-flex align-items-center">
								<i class="mdi mdi-clock text-muted mr-1"></i>
								<small class="text-muted ml-auto">4 hours ago</small>
								<p class="mb-0"></p>
							</div>
						</div>
					</div>
				</div><!-- LIST END -->
				<div class="list d-flex align-items-center border-bottom p-4">
					<div class="">
						<span class="avatar bg-success brround avatar-md">R</span>
					</div>
					<div class="wrapper w-100 ml-3">
						<p class="mb-0 d-flex">
							<b>Prepare for Presentation</b>
						</p>
						<div class="d-flex justify-content-between align-items-center">
							<div class="d-flex align-items-center">
								<i class="mdi mdi-clock text-muted mr-1"></i>
								<small class="text-muted ml-auto">1 days ago</small>
								<p class="mb-0"></p>
							</div>
						</div>
					</div>
				</div><!-- LIST END -->
				<div class="list d-flex align-items-center border-bottom p-4">
					<div class="">
						<span class="avatar bg-pink brround avatar-md">MS</span>
					</div>
					<div class="wrapper w-100 ml-3">
						<p class="mb-0 d-flex">
							<b>Prepare for Presentation</b>
						</p>
						<div class="d-flex justify-content-between align-items-center">
							<div class="d-flex align-items-center">
								<i class="mdi mdi-clock text-muted mr-1"></i>
								<small class="text-muted ml-auto">1 days ago</small>
								<p class="mb-0"></p>
							</div>
						</div>
					</div>
				</div><!-- LIST END -->
				<div class="list d-flex align-items-center border-bottom p-4">
					<div class="">
						<span class="avatar bg-purple brround avatar-md">L</span>
					</div>
					<div class="wrapper w-100 ml-3">
						<p class="mb-0 d-flex">
							<b>Prepare for Presentation</b>
						</p>
						<div class="d-flex justify-content-between align-items-center">
							<div class="d-flex align-items-center">
								<i class="mdi mdi-clock text-muted mr-1"></i>
								<small class="text-muted ml-auto">1 day ago</small>
								<p class="mb-0"></p>
							</div>
						</div>
					</div>
				</div><!-- LIST END -->
				<div class="list d-flex align-items-center border-bottom p-4">
					<div class="">
						<span class="avatar bg-warning brround avatar-md">L</span>
					</div>
					<div class="wrapper w-100 ml-3">
						<p class="mb-0 d-flex">
							<b>Prepare for Presentation</b>
						</p>
						<div class="d-flex justify-content-between align-items-center">
							<div class="d-flex align-items-center">
								<i class="mdi mdi-clock text-muted mr-1"></i>
								<small class="text-muted ml-auto">1 day ago</small>
								<p class="mb-0"></p>
							</div>
						</div>
					</div>
				</div><!-- LIST END -->
				<div class="list d-flex align-items-center p-4">
					<div class="">
						<span class="avatar bg-blue brround avatar-md">U</span>
					</div>
					<div class="wrapper w-100 ml-3">
						<p class="mb-0 d-flex">
							<b>Prepare for Presentation</b>
						</p>
						<div class="d-flex justify-content-between align-items-center">
							<div class="d-flex align-items-center">
								<i class="mdi mdi-clock text-muted mr-1"></i>
								<small class="text-muted ml-auto">2 days ago</small>
								<p class="mb-0"></p>
							</div>
						</div>
					</div>
				</div><!-- LIST END -->
			</div>
			<!-- SIDE-BAR CLOSED -->

			<!-- FOOTER -->
			<footer class="footer">
				<div class="container">
					<div class="row align-items-center flex-row-reverse">
						<div class="col-md-12 col-sm-12 text-center">
							Copyright © 2021 <a href="http://goubba.com/" target="blank">Goubba</a>. Designed by <a href="https://iotait.tech/" target="blank"> IOTA IT </a> All rights reserved.
						</div>
					</div>
				</div>
			</footer>
			<!-- FOOTER END -->
		</div>

		<!-- BACK-TO-TOP -->
		<a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>

		<!-- JQUERY JS -->
		<script src="{{ asset('assets/js/jquery-3.4.1.min.js') }}"></script>

		<!-- BOOTSTRAP JS -->
		<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
		<script src="{{ asset('assets/plugins/bootstrap/js/popper.min.js') }}"></script>

		<!-- CHARTJS CHART JS-->
		{{-- <script src="{{ asset('assets/plugins/chart/Chart.bundle.js') }}"></script>
		<script src="{{ asset('assets/plugins/chart/utils.js') }}"></script> --}}

		<!-- PIETY CHART JS-->
		{{-- <script src="{{ asset('assets/plugins/peitychart/jquery.peity.min.js') }}"></script>
		<script src="{{ asset('assets/plugins/peitychart/peitychart.init.js') }}"></script> --}}

		<!-- ECHART JS-->
		{{-- <script src="{{ asset('assets/plugins/echarts/echarts.js') }}"></script> --}}

		<!-- SIDE-MENU JS-->
		<script src="{{ asset('assets/plugins/sidemenu/sidemenu.js') }}"></script>

		<!-- SIDEBAR JS -->
		<script src="{{ asset('assets/plugins/sidebar/sidebar.js') }}"></script>

        <!-- CUSTOM SCROLLBAR JS-->
		{{-- <script src="{{ asset('assets/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js') }}"></script> --}}

		<!-- Perfect SCROLLBAR JS-->
		<script src="{{ asset('assets/plugins/p-scroll/perfect-scrollbar.js') }}"></script>
		<script src="{{ asset('assets/plugins/p-scroll/pscroll.js') }}"></script>
		<script src="{{ asset('assets/plugins/p-scroll/pscroll-1.js') }}"></script>

		<!-- APEXCHART JS -->
		{{-- <script src="{{ asset('assets/js/apexcharts.js') }}"></script> --}}

		<!-- INDEX JS -->
		{{-- <script src="{{ asset('assets/js/index1.js') }}"></script> --}}

        <!-- SWEET-ALERT JS -->
        <script src="{{ asset('assets/plugins/sweet-alert/sweetalert2.all.min.js') }}"></script>

        <!-- FILE UPLOADES JS -->
        <script src="{{ asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
        <script src="{{ asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>

        <!-- SELECT2 JS -->
		<script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}"></script>

        <!-- MULTI SELECT JS-->
		<script src="{{ asset('assets/plugins/multipleselect/multiple-select.js') }}"></script>
		<script src="{{ asset('assets/plugins/multipleselect/multi-select.js') }}"></script>

        <!-- ANIMATION JS -->
		<script src="{{ asset('assets/plugins/dreyanim/dreyanim.js') }}"></script>

        <!-- TOASTR JS -->
		<script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>

        <!-- FORMELEMENTS JS -->
		<script src="{{ asset('assets/js/form-elements.js') }}"></script>

        <!-- INPUT MASK JS-->
		<script src="{{ asset('assets/plugins/input-mask/jquery.mask.min.js') }}"></script>

        <!-- RATING STARJS -->
		<script src="{{ asset('assets/plugins/rating/jquery.rating-stars.js') }}"></script>

        <!-- CHART-CIRCLE JS-->
		<script src="{{ asset('assets/js/circle-progress.min.js') }}"></script>

        <!--MORRIS js-->
		<script src="{{ asset('assets/plugins/morris/morris.js') }}"></script>
		<script src="{{ asset('assets/plugins/morris/raphael-min.js') }}"></script>

        <!-- SPARKLINE JS-->
		{{-- <script src="{{ asset('assets/js/jquery.sparkline.min.js') }}"></script> --}}

        <!-- ECharts JS -->
	    {{-- <script src="{{ asset('assets/plugins/echarts/echarts.js') }}"></script> --}}

        <!-- PIETY CHART JS-->
		{{-- <script src="{{ asset('assets/plugins/peitychart/jquery.peity.min.js') }}"></script> --}}
		{{-- <script src="{{ asset('assets/plugins/peitychart/peitychart.init.js') }}"></script> --}}

        <!-- CHARTJS CHART JS -->
		{{-- <script src="{{ asset('assets/plugins/chart/Chart.bundle.js') }}"></script> --}}
		{{-- <script src="{{ asset('assets/plugins/chart/utils.js') }}"></script> --}}

        <!-- CHARTJS CHART JS-->
		{{-- <script src="{{ asset('assets/plugins/chart/Chart.bundle.js') }}"></script> --}}
		{{-- <script src="{{ asset('assets/plugins/chart/utils.js') }}"></script> --}}

		<!-- C3.JS CHART JS -->
		{{-- <script src="{{ asset('assets/plugins/charts-c3/d3.v5.min.js') }}"></script> --}}
		{{-- <script src="{{ asset('assets/plugins/charts-c3/c3-chart.js') }}"></script> --}}

        <!-- INDEX JS-->
        <script src="{{ asset('assets/js/index4.js') }}"></script>

        <!-- CUSTOM JS-->
		<script src="{{ asset('assets/js/custom.js') }}"></script>

        <!-- DRAGGABLE ELEMENT-->
		<script src="{{ asset('assets/plugins/draggable-element/draggable-element.js') }}"></script>

        <script>

            @if(Session::has('message'))
                var type = "{{Session::get('alertType', 'info')}}";

                switch (type) {
                    case 'info':
                        toastr.info("{{Session::get('message')}}");
                        break;
                    case 'success':
                        toastr.success("{{Session::get('message')}}");
                        break;
                    case 'warning':
                        toastr.warning("{{Session::get('message')}}");
                        break;
                    case 'error':
                        toastr.error("{{Session::get('message')}}");
                        break;
                }
            @endif


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('table').dreyanim({
                animationType : 'wipeInVertical',
                animationTime : 2000
            });

            $('.totalViewStats').dreyanim({
                animationType : 'slideInFromLeft',
                animationTime : 2000
            });

            $('.totalClicksStats').dreyanim({
                animationType : 'slideInFromRight',
                animationTime : 2000
            });

            function deleteData(deleteUrl) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'

                }).then((result) => {

                    if (result.isConfirmed) {
                        location.href = deleteUrl;
                    }
                })
            }
        </script>

        @yield('script')
	</body>
</html>
