<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Wizard V1</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="{{ asset('assets/form-wizard/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/form-wizard/css/bootstrap-datepicker.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/form-wizard/css/animate.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/form-wizard/css/fontawesome-all.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/form-wizard/css/style_main.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/form-wizard/css/colors/switch.css') }}">
	<!-- Color Alternatives -->

</head>
<body>
	<div class="wrapper">
		<div class="steps-area steps-area-fixed">
			<div class="image-holder">
				<img src="{{ asset('assets/form-wizard/img/side-img.jpg') }}" alt="">
			</div>
			<div class="steps clearfix">
				<ul class="tablist multisteps-form__progress">
					<li class="multisteps-form__progress-btn js-active current">
						<span>1</span>
					</li>
					<li class="multisteps-form__progress-btn">
						<span>2</span>
					</li>
					<li class="multisteps-form__progress-btn">
						<span>3</span>
					</li>
					<li class="multisteps-form__progress-btn">
						<span>4</span>
					</li>
					<li class="multisteps-form__progress-btn last">
						<span>5</span>
					</li>
				</ul>
			</div>
		</div>
		<form class="multisteps-form__form" action="#" id="wizard" method="POST">
			<div class="form-area position-relative">
				<!-- div 1 -->
				<div class="multisteps-form__panel js-active" data-animation="slideHorz">
					<div class="wizard-forms">
						<div class="inner pb-100 clearfix">
							<div class="form-content pera-content">
								<div class="step-inner-content">
									<span class="step-no">Step 1</span>
									<h2>What kind of Services You need?</h2>
									<p>Tation argumentum et usu, dicit viderer evertitur te has. Eu dictas concludaturque usu, facete detracto patrioque an per, lucilius pertinacia eu vel.</p>
									<div class="step-box">
										<div class="row">
											<div class="col-md-4">
												<label class="step-box-content bg-white text-center relative-position active">
													<span class="step-box-icon">
														<img src="{{ asset('assets/form-wizard/img/d1.png') }}" alt="">
													</span>
													<span class="step-box-text">
														Corporate Services
													</span>
													<span class="service-check-option">
														<span><input type="radio" name="service_name" value="Corporate Services" checked></span>
													</span>
												</label>
											</div>
											<div class="col-md-4">
												<label class="step-box-content bg-white text-center relative-position">
													<span class="step-box-icon">
														<img src="{{ asset('assets/form-wizard/img/d2.png') }}" alt="">
													</span>
													<span class="step-box-text">
														Freelancing Serivces
													</span>
													<span>conditional</span>
													<span class="service-check-option">
														<span><input id="condition1" type="radio" name="service_name" value="Freelancing Services"></span>
													</span>
												</label>
											</div>
											<div class="col-md-4">
												<label class="step-box-content bg-white text-center relative-position">
													<span class="step-box-icon">
														<img src="{{ asset('assets/form-wizard/img/d3.png') }}" alt="">
													</span>
													<span class="step-box-text">
														Development
													</span>
													<span class="service-check-option">
														<span><input type="radio" name="service_name" value="Development Services"></span>
													</span>
												</label>
											</div>
										</div>
										<div class="row conditional" data-condition="#condition1 && service_name == 'Freelancing Services'">
											<div class="col-md-12 form-inner-area">
												<label for="field"><h3>Which Sector</h3></label>
												<input type="text" name="field" class="form-control" minlength="2" placeholder="Write Here">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- /.inner -->
						<div class="actions">
							<ul>
								<li class="disable" aria-disabled="true"><span class="js-btn-next" title="NEXT">Backward <i class="fa fa-arrow-right"></i></span></li>
								<li><span class="js-btn-next" title="NEXT">NEXT <i class="fa fa-arrow-right"></i></span></li>
							</ul>
						</div>
					</div>
				</div>
				<!-- div 2 -->
				<div class="multisteps-form__panel" data-animation="slideHorz">
					<div class="wizard-forms">
						<div class="inner pb-100 clearfix">
							<div class="form-content pera-content">
								<div class="step-inner-content">
									<span class="step-no bottom-line">Step 2</span>
									<div class="step-progress float-right">
										<span>2 of 5 completed</span>
										<div class="step-progress-bar">
											<div class="progress">
												<div class="progress-bar"></div>
											</div>
										</div>
									</div>
									<h2>What kind of services you are quiz?</h2>
									<p>Tation argumentum et usu, dicit viderer evertitur te has. Eu dictas concludaturque usu, facete detracto patrioque an per, lucilius pertinacia eu vel.</p>
									<div class="form-inner-area">
										<input type="text" name="full_name" class="form-control required" minlength="2" placeholder="First and last name *" required>
										<input type="email" name="email" class="form-control required" placeholder="Email Address *" required>
										<input type="text" name="phone" placeholder="Phone">
									</div>
									<div class="gender-selection">
										<h3>Gender:</h3>
										<label>
											<input type="radio" name="gender" value="Male">
											<span class="checkmark"></span>Male
										</label>
										<label>
											<input type="radio" name="gender" value="Female">
											<span class="checkmark"></span>Female
										</label>
									</div>
									<div class="upload-documents">
										<h3>Upload Documents:</h3>
										<div class="upload-araa bg-white">
											<input type="hidden" value="" name="fileContent" id="fileContent">
											<input type="hidden" value="" name="filename" id="filename">
											<div class="upload-icon float-left">
												<i class="fas fa-cloud-upload-alt"></i>
											</div>
											<div class="upload-text">
												<span>( File accepted: pdf. doc/ docx -
												Max file size : 150kb for demo limit )</span>
											</div>
											<div class="upload-option text-center">
												<label for="attach">Upload The Documents</label>
												<input id="attach" style="visibility:hidden;" type="file">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- /.inner -->
						<div class="actions">
							<ul>
								<li><span class="js-btn-prev" title="BACK"><i class="fa fa-arrow-left"></i> BACK </span></li>
								<li><span class="js-btn-next" title="NEXT">NEXT <i class="fa fa-arrow-right"></i></span></li>
							</ul>
						</div>
					</div>
				</div>
				<!-- div 3 -->
				<div class="multisteps-form__panel" data-animation="slideHorz">
					<div class="wizard-forms">
						<div class="inner pb-100 clearfix">
							<div class="form-content pera-content">
								<div class="step-inner-content">
									<span class="step-no bottom-line">Step 3</span>
									<div class="step-progress float-right">
										<span>3 of 5 completed</span>
										<div class="step-progress-bar">
											<div class="progress">
												<div class="progress-bar" style="width:40%"></div>
											</div>
										</div>
									</div>
									<h2>What kind of services You Need</h2>
									<p>Tation argumentum et usu, dicit viderer evertitur te has. Eu dictas concludaturque usu, facete detracto patrioque an per, lucilius pertinacia eu vel.</p>
									<div class="services-select-option">
										<ul>
											<li class="bg-white active"><label>Web Design <input type="radio" id="condition2" name="web_service" value="Web Design" checked></label></li>
											<li class="bg-white"><label>Web Development <input type="radio" name="web_service" value="Web Development"></label></li>
											<li class="bg-white"><label>Graphics Design <input type="radio" name="web_service" value="Graphics Design"></label></li>
											<li class="bg-white"><label>SEO <input type="radio" name="web_service" value="SEO"></label></li>
										</ul>
									</div>
									<div class="conditional" data-condition="#condition2 && web_service == 'Web Design'">
										<div class="form-inner-area">
										<label> <h3>Details</h3></label>
											<input type="text" name="web_service_detail">
										</div>
									</div>
									<div class="language-select">
										<p>I want to browse projects in the following languages: </p>
										<select name="languages">
											<option>English</option>
											<option>Arabic</option>
											<option>Spanish</option>
											<option>French</option>
										</select>
									</div>
									<div class="comment-box">
										<p><i class="fas fa-comments"></i> Write Somthing note</p>
										<textarea name="full_comments" placeholder="Write here"></textarea>
									</div>
								</div>
							</div>
						</div>
						<!-- ./inner -->
						<div class="actions">
							<ul>
								<li><span class="js-btn-prev" title="BACK"><i class="fa fa-arrow-left"></i> BACK </span></li>
								<li><span class="js-btn-next" title="NEXT">NEXT <i class="fa fa-arrow-right"></i></span></li>
							</ul>
						</div>
					</div>
				</div>
				<!-- div 4 -->
				<div class="multisteps-form__panel" data-animation="slideHorz">
					<div class="wizard-forms">
						<div class="inner pb-100 clearfix">
							<div class="form-content pera-content">
								<div class="step-inner-content">
									<span class="step-no bottom-line">Step 4</span>
									<div class="step-progress float-right">
										<span>4 of 5 completed</span>
										<div class="step-progress-bar">
											<div class="progress">
												<div class="progress-bar" style="width:70%"></div>
											</div>
										</div>
									</div>
									<h2>What kind of services You Need</h2>
									<p>Tation argumentum et usu, dicit viderer evertitur te has. Eu dictas concludaturque usu, facete detracto patrioque an per, lucilius pertinacia eu vel.</p>
									<div class="step-content-area">
										<div class="budget-area">
											<p><i class="fas fa-dollar-sign"></i> Budget</p>
											<select name="budget">
												<option>$390 - $600</option>
												<option>$390 - $600</option>
												<option>$390 - $600</option>
												<option>$390 - $600</option>
												<option>$390 - $600</option>
											</select>
										</div>
										<div class="budget-area">
											<p><i class="fas fa-comments"></i> Required Support</p>
											<select name="support_period">
												<option>2 to 6 month</option>
												<option>2 to 6 month</option>
												<option>2 to 6 month</option>
												<option>2 to 6 month</option>
												<option>2 to 6 month</option>
											</select>
										</div>
										<div class="budget-area">
											<p>Optimization and Accessibility</p>
											<div class="opti-list">
												<ul class="d-flex">
													<li class="bg-white active"><input type="checkbox" name="code_opti1" value="Semantic coding" checked>Semantic coding</li>
													<li class="bg-white"><input type="checkbox" name="code_opti2" value="Mobile APP">Mobile APP</li>
													<li class="bg-white"><input type="checkbox" name="code_opti3" value="Mobile Design">Mobile Design</li>
												</ul>
											</div>
										</div>
										<div class="comment-box">
											<p><i class="fas fa-comments"></i> Write Somthing note</p>
											<textarea name="comments-note" placeholder="Your Content Here"></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- /.inner -->
						<div class="actions">
							<ul>
								<li><span class="js-btn-prev" title="BACK"><i class="fa fa-arrow-left"></i> BACK </span></li>
								<li><span class="js-btn-next" title="NEXT">NEXT <i class="fa fa-arrow-right"></i></span></li>
							</ul>
						</div>
					</div>
				</div>
				<!-- div 5 -->
				<div class="multisteps-form__panel" data-animation="slideHorz">
					<div class="wizard-forms">
						<div class="inner pb-100 clearfix">
							<div class="form-content pera-content">
								<div class="step-inner-content">
									<span class="step-no bottom-line">Step 5</span>
									<div class="step-progress float-right">
										<span>5 of 5 completed</span>
										<div class="step-progress-bar">
											<div class="progress">
												<div class="progress-bar" style="width:100%"></div>
											</div>
										</div>
									</div>
									<h2>Complete Final Step</h2>
									<p>Tation argumentum et usu, dicit viderer evertitur te has. Eu dictas concludaturque usu, facete detracto patrioque an per, lucilius pertinacia eu vel.</p>
									<div class="step-content-field">
										<div class="date-picker date datepicker">
											<input type="text" name="date" class="form-control">
											<div class="input-group-append"><span>ADD TIME</span></div>
										</div>
										<div class="plan-area">
											<div class="plan-icon-text text-center active">
												<div class="plan-icon">
													<i class="fas fa-chess-queen"></i>
												</div>
												<div class="plan-text">
													<h3>Unlimited Plan</h3>
													<p>Tation argumentum et usu, dicit viderer evertitur te has. Eu dictas concludaturque usu, dicit viderer evertitur</p>
													<input type="radio" name="your_plan" value="Unlimited Plan" checked="">
												</div>
											</div>
											<div class="plan-icon-text text-center">
												<div class="plan-icon">
													<i class="fas fa-cubes"></i>
												</div>
												<div class="plan-text">
													<h3>Limited Plan</h3>
													<p>Tation argumentum et usu, dicit viderer evertitur te has. Eu dictas concludaturque usu, dicit viderer evertitur</p>
													<input type="radio" name="your_plan" value="Unlimited Plan">
												</div>
											</div>
										</div>
										<div class="budget-area">
											<p>Optimization and Accessibility</p>
											<div class="opti-list">
												<ul class="d-flex">
													<li class="bg-white active"><input type="checkbox" name="code_opti1" value="Semantic coding" checked>Semantic coding</li>
													<li class="bg-white"><input type="checkbox" name="code_opti2" value="Mobile APP">Mobile APP</li>
													<li class="bg-white"><input type="checkbox" name="code_opti3" value="Mobile Design">Mobile Design</li>
												</ul>
											</div>
										</div>
										<div class="comment-box">
											<textarea name="extra-message" placeholder="Some Note"></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- /.inner -->
						<div class="actions">
							<ul>
								<li><span class="js-btn-prev" title="BACK"><i class="fa fa-arrow-left"></i> BACK </span></li>
								<li><button type="submit" title="NEXT">SUBMIT <i class="fa fa-arrow-right"></i></button></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>

	<script src="{{ asset('assets/form-wizard/js/jquery-3.3.1.min.js') }}"></script>
	<script src="{{ asset('assets/form-wizard/js/jquery.validate.min.js') }}"></script>
	<script src="{{ asset('assets/form-wizard/js/bootstrap-datepicker.min.js') }}"></script>
	<script src="{{ asset('assets/form-wizard/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('assets/form-wizard/js/conditionize.flexible.jquery.min.js') }}"></script>
	<script src="{{ asset('assets/form-wizard/js/main.js') }}"></script>

    <script>
		$("#files").change(function() {
			filename = this.files[0].name
		});

		function UploadFile() {
			var reader = new FileReader();
			var file = document.getElementById('attach').files[0];
			reader.onload = function() {
				document.getElementById('fileContent').value = reader.result;
				document.getElementById('filename').value = file.name;
				document.getElementById('wizard').submit();
			}
			reader.readAsDataURL(file);
		}

		$(document).ready(function() {
			$('.conditional').conditionize();
		});
	</script>
</body>
</html>
