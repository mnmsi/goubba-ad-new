<!doctype html>
<html lang="en" dir="ltr">
  <head>
		<!-- META DATA -->
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="Volgh –  Bootstrap 4 Responsive Application Admin panel Theme Ui Kit & Premium Dashboard Design Modern Flat HTML Template">
		<meta name="author" content="Spruko Technologies Private Limited">
		<meta name="keywords" content="analytics dashboard, bootstrap 4 web app admin template, bootstrap admin panel, bootstrap admin template, bootstrap dashboard, bootstrap panel, Application dashboard design, dashboard design template, dashboard jquery clean html, dashboard template theme, dashboard responsive ui, html admin backend template ui kit, html flat dashboard template, it admin dashboard ui, premium modern html template">

		<!-- FAVICON -->
		<link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/brand/favicon.ico') }}" />

		<!-- TITLE -->
		<title>Goubba ad - Login</title>

		<!-- BOOTSTRAP CSS -->
		<link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet') }}" />

		<!-- STYLE CSS -->
		<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet"/>
		<link href="{{ asset('assets/css/dark-style.css') }}" rel="stylesheet"/>
		<link href="{{ asset('assets/css/skin-modes.css') }}" rel="stylesheet"/>

		<!-- SIDE-MENU CSS -->
		<link href="{{ asset('assets/css/closed-sidemenu.css') }}" rel="stylesheet">

		<!-- SINGLE-PAGE CSS -->
		<link href="{{ asset('assets/plugins/single-page/css/main.css') }}" rel="stylesheet" type="text/css">

		<!--C3 CHARTS CSS -->
		<link href="{{ asset('assets/plugins/charts-c3/c3-chart.css') }}" rel="stylesheet"/>

		<!-- P-scroll bar css-->
		<link href="{{ asset('assets/plugins/p-scroll/perfect-scrollbar.css') }}" rel="stylesheet" />

		<!--- FONT-ICONS CSS -->
		<link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet"/>

		<!-- COLOR SKIN CSS -->
		<link id="theme" rel="stylesheet" type="text/css" media="all" href="{{ asset('assets/colors/color1.css') }}" />

        <style>
            .modal {
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

            .modal-content {
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

            .modal-close {
                font-size: 40px;
                float: right;
                font-weight: 200;
                color: rgba(0, 0, 0, 0.6);
                margin-top: -10px;
                transition: all .2s;
                cursor: pointer;
                width: auto;
            }

            .modal-close:hover {
                color: #3b3b3b;
            }

            .modal-img svg {
                width: 60%;
                margin: -0px auto;
            }

            .modal-footer {
                padding: 20px 30px;
                color: #fff;
                width: auto;
                text-align: center;
                background-color: #fc801c;
                margin: -15px;
                line-height: 1em;
            }

            .modal-footer h2 {
                font-size: 25px;
            }

            .modal-footer p {
                font-weight: 200;
                width: 70%;
                margin: auto;
                font-size: 15px;
            }

            @media screen and (max-width: 27em) {
                .modal-content {
                    width: 90%;
                }
                .modal-footer h2 {
                    font-size: 15px;
                }
                .modal-footer p {
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
        </script>

        <script type="text/javascript" src="{{ asset('assets/ads/ads.js') }}"></script>

        <!-- Verify in some script if adblock is enabled -->
        <script type="text/javascript">
            window.onload = function() {
                setTimeout(function() {
                    var modal = document.getElementById("myModal");
                    if(window.adblockEnabled) {
                        var modal = document.getElementById("myModal");
                        modal.style.display = "block";
                    }
                }, 1000);
            };
        </script>
	</head>
	<body>

        {{-- ADD BLOCKER MODAL --}}
        <div id="myModal" class="modal">
            <div class="modal-content animated bounce">
                <a class="modal-close">×</a>
                <center class="modal-img">
                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                    viewBox="0 0 200 200" style="enable-background:new 0 0 200 200;" xml:space="preserve">
                    <g>
                    <path class="st0" d="M61.3,79.1c-3.3,4.6-6,9.6-10.6,13.3c-7.7,6.4-19.5,8-25.9,15.7c-6.9,8.2-3.9,19.9,3.5,26.8
                        c4.9,4.6,11.6,7.5,18.5,9.3c15,3.8,114.9-0.4,119.8-2.6c6.6-2.9,9.6-8.5,9.1-14.9c-0.8-10.4-9.6-18.8-19.4-24.6
                        c-9.7-5.7-20.8-9.7-29.9-16.2c-5.2-3.7-9.6-8.2-14.6-12.2c-4.1-3.3-8.7-6.2-14-8C84.6,61.1,68.6,68.9,61.3,79.1z" />
                    <circle class="st1" cx="14.9" cy="132.8" r="2" />
                    <circle class="st1" cx="168.8" cy="76.3" r="2" />
                    <line class="st2" x1="98.4" y1="88.8" x2="98.4" y2="25.6" />
                    <path class="st3" d="M98.4,25.3c6.9-5,15.8-3.9,23.8-1.9c6,1.5,12.1,3.3,18.1,3.2c2.1-0.1,6-0.1,6-0.1s0,5.6,0,7v28.6
                        c0,2,0,6.3,0,6.3s-4.2,0.6-5.7,0.6c-6.1,0.2-12.3-1.7-18.4-3.2c-8-2-16.8-3.1-23.8,1.9V25.3z" />
                    <circle class="st4" cx="120.9" cy="44.5" r="16.6" />
                    <text transform="matrix(1 0 0 1 107.5 52.0444)" class="st5 st6 st7">AD</text>
                    <polyline class="st3" points="106.6,59 122.8,45.5 124.5,44.1 136.9,33.7 	" />
                    <path class="st2" d="M77,69.9c-0.8,0-1.5,0.3-2.1,0.9c-0.3-1.9-1.9-3.3-3.7-3.3c-1.9,0-3.4,1.5-3.7,3.4c-0.6-0.4-1.4-0.7-2.2-0.7
                        c-1.9,0-3.5,1.4-3.9,3.3c0,0.2,0.1,0.3,0.3,0.3h6.4h1.2h4.7h0.4h5.7c0,0,0,0,0,0C80.4,71.7,78.9,69.9,77,69.9z" />
                    <path class="st2" d="M153.9,78.1c-0.8,0-1.5,0.3-2.1,0.9c-0.3-1.9-1.9-3.3-3.7-3.3c-1.9,0-3.4,1.5-3.7,3.4
                        c-0.6-0.4-1.4-0.7-2.2-0.7c-1.9,0-3.5,1.4-3.9,3.3c0,0.2,0.1,0.3,0.3,0.3h6.4h1.2h4.7h0.4h5.7c0,0,0,0,0,0
                        C157.3,79.9,155.8,78.1,153.9,78.1z" />
                    <circle class="st8" cx="151.1" cy="104.7" r="2" />
                    <circle class="st8" cx="45.9" cy="112.9" r="2" />
                    <circle class="st1" cx="38.2" cy="89.6" r="2.9" />
                    <circle class="st1" cx="185.4" cy="121" r="2.9" />
                    <g>
                        <line class="st2" x1="168.8" y1="95.2" x2="179.9" y2="95.2" />
                        <line class="st2" x1="185.4" y1="99.7" x2="199" y2="99.7" />
                        <line class="st2" x1="178.6" y1="99.7" x2="181.9" y2="99.7" />
                    </g>
                    <line class="st2" x1="49.1" y1="64.9" x2="60.1" y2="64.9" />
                    <line class="st2" x1="42.2" y1="69.4" x2="54.6" y2="69.4" />
                    <line class="st2" x1="34.2" y1="69.4" x2="38.2" y2="69.4" />
                    <line class="st2" x1="9.2" y1="111.7" x2="21.6" y2="111.7" />
                    <line class="st2" x1="1.2" y1="111.7" x2="5.2" y2="111.7" />
                    <path class="st2" d="M90.7,158.7L73.1,125l-8.9-17c-0.8-1.4-2.8-1.4-3.5,0l-6.6,13.1l-18.8,37.5" />
                    <path class="st3" d="M161.4,158.7l-18.2-34.9l-8.3-15.8c-0.7-1.4-2.8-1.4-3.5,0l-5.9,11.8L106,158.7" />
                    <path class="st9" d="M136,153l-21.1-40.5l-12.3-23.5c-1-1.8-3.6-1.8-4.5,0L87.7,110L66.2,153" />
                    <path class="st10" d="M136,153h-6.6L110,115.9L97.7,92.4c-0.2-0.4-0.5-0.7-0.8-0.9l1.2-2.4c0.9-1.8,3.5-1.9,4.5,0l12.3,23.5
                        L136,153z" />
                    <path class="st2" d="M136,153l-21.1-40.5l-12.3-23.5c-1-1.8-3.6-1.8-4.5,0L87.7,110L66.2,153" />
                    <path class="st5" d="M22.3,149c6.9,0,6.9,3.5,13.7,3.5c6.9,0,6.9-3.5,13.8-3.5c6.9,0,6.9,3.5,13.7,3.5c6.9,0,6.9-3.5,13.7-3.5
                        c6.9,0,6.9,3.5,13.7,3.5c6.9,0,6.9-3.5,13.7-3.5c6.9,0,6.9,3.5,13.8,3.5c6.9,0,6.9-3.5,13.8-3.5c6.9,0,6.9,3.5,13.8,3.5
                        c6.9,0,6.9-3.5,13.8-3.5c6.9,0,6.9,3.5,13.8,3.5v20.7H22.3V149z" />
                    <path class="st2" d="M150,152.1c3.4-1,4.6-3,9.9-3c6.9,0,6.9,3.5,13.8,3.5" />
                    <path class="st2" d="M146,152.6c0.6,0,1.1,0,1.6-0.1" />
                    <path class="st2" d="M22.3,149c6.9,0,6.9,3.5,13.7,3.5c6.9,0,6.9-3.5,13.8-3.5c6.9,0,6.9,3.5,13.7,3.5c6.9,0,6.9-3.5,13.7-3.5
                        c6.9,0,6.9,3.5,13.7,3.5c6.9,0,6.9-3.5,13.7-3.5c6.9,0,6.9,3.5,13.8,3.5c6.9,0,6.9-3.5,13.8-3.5c5.6,0,6.6,2.4,10.6,3.2" />
                    <path class="st2" d="M108.3,159.5c3.7,0.9,4.8,3.2,10.2,3.2c6.9,0,6.9-3.5,13.8-3.5c6.9,0,6.9,3.5,13.8,3.5c6.9,0,6.9-3.5,13.8-3.5
                        c6.9,0,6.9,3.5,13.8,3.5" />
                    <path class="st2" d="M103.3,159.2c0.5,0,1-0.1,1.5-0.1" />
                    <path class="st2" d="M55.8,160.5c2,1,3.7,2.2,7.7,2.2c6.9,0,6.9-3.5,13.7-3.5c6.9,0,6.9,3.5,13.7,3.5c5.4,0,6.6-2.2,10.2-3.2"
                        />
                    <path class="st2" d="M22.3,159.1c6.9,0,6.9,3.5,13.7,3.5c6.9,0,6.9-3.5,13.8-3.5" />
                    <path class="st3" d="M114.9,112.5c-4,2.4-9.4,2.4-13.4,0c-3.2-1.9-5.6-4.7-9.7-3.9c-1.1,0.2-2.6,0.9-4.1,1.2l10.4-20.9
                        c0.9-1.8,3.5-1.9,4.5,0L114.9,112.5z" />
                    <path class="st3" d="M73.1,125c-3.2,1.3-7,1-9.9-0.7c-2.7-1.6-4.8-4-8.3-3.3c-0.2,0-0.5,0.1-0.8,0.2l6.6-13.1
                        c0.7-1.5,2.8-1.5,3.5,0L73.1,125z" />
                    <path class="st3" d="M143.2,123.8c-2.4,0.3-4.9-0.2-7-1.5c-2.7-1.6-4.8-4-8.3-3.3c-0.7,0.1-1.5,0.5-2.4,0.8l5.9-11.8
                        c0.7-1.5,2.8-1.5,3.5,0L143.2,123.8z" />
                    <path class="st3" d="M106.9,100.9c0.8,0,1.5,0.3,2.1,0.9c0.3-1.9,1.9-3.3,3.7-3.3c1.9,0,3.4,1.5,3.7,3.4c0.6-0.4,1.4-0.7,2.2-0.7
                        c1.9,0,3.5,1.4,3.9,3.3c0,0.2-0.1,0.3-0.3,0.3h-6.4h-1.2h-4.7h-0.4h-5.7c0,0,0,0,0,0C103.5,102.7,105,100.9,106.9,100.9z"
                        />
                    <line class="st2" x1="80.1" y1="134.8" x2="75.9" y2="145.3" />
                    <line class="st2" x1="82.3" y1="130" x2="81.3" y2="132.3" />
                    <path class="st11" d="M86.4,120.7c-0.2,0.6-0.3,1.3,0.2,1.6c0.3,0.2,0.7,0.1,1-0.1c0.3-0.2,0.5-0.5,0.7-0.7
                        c1.5-2.2,2.6-4.7,3.1-7.3c0.1-0.6,0.2-1.2,0-1.8c-0.2-0.6-0.9-1.2-1.5-0.6c-0.6,0.6-1,2-1.4,2.8C87.8,116.6,87,118.6,86.4,120.7z"
                        />
                    <line class="st2" x1="128" y1="122.7" x2="125.9" y2="126.9" />
                    <line class="st2" x1="54.1" y1="130" x2="52.1" y2="134.2" />
                    <line class="st2" x1="55.3" y1="128.3" x2="56.1" y2="126.6" />
                    <g>
                        <path class="st3" d="M64.9,140.7c0.1-0.5,0.2-1,0.2-1.6c0-2.2-1.2-4.1-2.8-4.1c-1.5,0-2.8,1.8-2.8,4.1c0,0.5,0.1,1,0.2,1.4
                        c-0.6,0.9-1,2.2-1,3.6c0,2.8,1.6,5.1,3.5,5.1c1.9,0,3.5-2.3,3.5-5.1C65.8,142.8,65.5,141.6,64.9,140.7z" />
                        <line class="st2" x1="62.3" y1="152.4" x2="62.3" y2="145.6" />
                    </g>
                    <g>
                        <ellipse class="st3" cx="139.3" cy="140.6" rx="3.2" ry="4.7" />
                        <line class="st2" x1="139.3" y1="150.4" x2="139.3" y2="142" />
                    </g>
                    <g>
                        <path class="st3" d="M152.9,130.9c0.1-0.5,0.2-1,0.2-1.5c0-2.5-1.4-4.5-3-4.5c-1.7,0-3,2-3,4.5c0,0.3,0,0.6,0.1,0.8
                        c-1,1.2-1.6,2.9-1.6,4.8c0,3.5,1.9,6.3,4.3,6.3c2.4,0,4.3-2.8,4.3-6.3C154.1,133.4,153.6,132,152.9,130.9z" />
                        <line class="st2" x1="149.8" y1="152.2" x2="149.8" y2="136.6" />
                    </g>
                    <path class="st2" d="M67.3,94.6c0,0,2.5-0.4,4,3.7c0,0,2.1-4.1,4-4" />
                    <path class="st2" d="M75.4,100.4c0,0,2.5-0.4,4,3.7c0,0,2.1-4.1,4-4" />
                    <path class="st3" d="M101.7,27.8c0,0,1.4-2,4.5-1.2" />
                    <path class="st3" d="M139.7,66.3c1,0,2.2-0.1,3.3-0.4" />
                    </g>
                </svg>
                </center>
                <div class="modal-footer">
                    <h2>Ads Blocker Detected</h2>
                    <p>We have noticed that have you an adblocker enabled. To continue this site you need to turnoff adblocker and refresh the page.</p>
                </div>
            </div>
        </div>
        {{--END ADD BLOCKER MODAL --}}

		<!-- BACKGROUND-IMAGE -->
		<div class="login-img">

			<!-- GLOABAL LOADER -->
			<div id="global-loader">
				<img src="{{ asset('assets/images/loader.svg') }}" class="loader-img" alt="Loader">
			</div>
			<!-- /GLOABAL LOADER -->

			<!-- PAGE -->
			<div class="page">
				<div class="">
				    <!-- CONTAINER OPEN -->
					<div class="col col-login mx-auto">
						<div class="text-center">
							{{-- <img src="{{ asset('assets/images/brand/logo.png') }}" class="header-brand-img" alt=""> --}}
						</div>
					</div>
					<div class="container-login100">
						<div class="wrap-login100 p-6">
							<form class="login100-form validate-form" action="{{ url('/login') }}" method="post">
                                @csrf
								<span class="login100-form-title">
									Login
								</span>

                                @foreach($errors->all() as $error)
                                    <div class="alert alert-danger" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        {{ $error }}
                                    </div>
                                @endforeach

								<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
									<input class="input100" type="text" id="inputEmail" name="email" placeholder="Email">
									<span class="focus-input100"></span>
									<span class="symbol-input100">
										<i class="zmdi zmdi-email" aria-hidden="true"></i>
									</span>
								</div>

								<div class="wrap-input100 validate-input" data-validate = "Password is required">
									<input class="input100" type="password" name="password" placeholder="Password">
									<span class="focus-input100"></span>
									<span class="symbol-input100">
										<i class="zmdi zmdi-lock" aria-hidden="true"></i>
									</span>
								</div>
								<div class="text-right pt-1">
									<p class="mb-0"><a href="{{url('forgot-password')}}" class="text-primary ml-1">Forgot Password?</a></p>
								</div>
								<div class="container-login100-form-btn">
									<button type="submit" class="login100-form-btn btn-primary">
										Login
									</button>
								</div>
								{{-- <div class="text-center pt-3">
									<p class="text-dark mb-0">Not a member?<a href="register.html" class="text-primary ml-1">Sign UP now</a></p>
								</div>
								<div class=" flex-c-m text-center mt-3">
								    <p>Or</p>
									<div class="social-icons">
										<ul>
											<li><a class="btn  btn-social btn-block"><i class="fa fa-google-plus text-google-plus"></i> Sign up with Google</a></li>
											<li><a class="btn  btn-social btn-block mt-2"><i class="fa fa-facebook text-facebook"></i> Sign in with Facebook</a></li>
										</ul>
									</div>
								</div> --}}
							</form>
						</div>
					</div>
					<!-- CONTAINER CLOSED -->
				</div>
			</div>
			<!-- End PAGE -->

		</div>
		<!-- BACKGROUND-IMAGE CLOSED -->

		<!-- JQUERY JS -->
		<script src="{{ asset('assets/js/jquery-3.4.1.min.js') }}"></script>

		<!-- BOOTSTRAP JS -->
		<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
		<script src="{{ asset('assets/plugins/bootstrap/js/popper.min.js') }}"></script>

		<!-- SPARKLINE JS -->
		<script src="{{ asset('assets/js/jquery.sparkline.min.js') }}"></script>

		<!-- CHART-CIRCLE JS -->
		<script src="{{ asset('assets/js/circle-progress.min.js') }}"></script>

		<!-- RATING STAR JS -->
		<script src="{{ asset('assets/plugins/rating/jquery.rating-stars.js') }}"></script>

		<!-- INPUT MASK JS -->
		<script src="{{ asset('assets/plugins/input-mask/jquery.mask.min.js') }}"></script>

		<!-- Perfect SCROLLBAR JS-->
		<script src="{{ asset('assets/plugins/p-scroll/perfect-scrollbar.js') }}"></script>
		<script src="{{ asset('assets/plugins/p-scroll/pscroll.js') }}"></script>
		<script src="{{ asset('assets/plugins/p-scroll/pscroll-1.js') }}"></script>

		<!-- CUSTOM JS-->
		<script src="{{ asset('assets/js/custom.js') }}"></script>

	</body>
</html>
