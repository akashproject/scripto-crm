@extends('administrator.layouts.app')
@section('content')
<div class="row">
	<div class="col-md-12">
		@if ($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
		@if(session()->has('message'))
			<div class="alert alert-success" role="alert">{{ session()->get('message') }}</div>
		@endif
		<form id="formAccountSettings" method="POST" action="{{ route('admin-save-settings') }}" enctype="multipart/form-data" >
			@csrf
			<div class="nav-align-top mb-4">
				<ul class="nav nav-pills flex-column flex-md-row mb-3" role="tablist">
					<li class="nav-item">
						<button
							type="button"
							class="nav-link active"
							role="tab"
							data-bs-toggle="tab"
							data-bs-target="#navs-pills-justified-home"
							aria-controls="navs-pills-justified-home"
							aria-selected="true"
						>
							<i class="tf-icons bx bx-home"></i> General Settings
						</button>
					</li>
					<li class="nav-item">
						<button
							type="button"
							class="nav-link"
							role="tab"
							data-bs-toggle="tab"
							data-bs-target="#navs-pills-justified-profile"
							aria-controls="navs-pills-justified-profile"
							aria-selected="false"
						>
							<i class="tf-icons bx bx-user"></i> Contact Settings
						</button>
					</li>
					<li class="nav-item">
						<button
							type="button"
							class="nav-link"
							role="tab"
							data-bs-toggle="tab"
							data-bs-target="#navs-pills-justified-messages"
							aria-controls="navs-pills-justified-messages"
							aria-selected="false"
						>
							<i class="tf-icons bx bx-message-square"></i> Social Settings
						</button>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane fade show active" id="navs-pills-justified-home" role="tabpanel">
						<!-- Account -->
						<div class="card-body">
							<div class="d-flex align-items-start align-items-sm-center gap-4">
								<img
									src="../assets/img/avatars/1.png"
									alt="user-avatar"
									class="d-block rounded"
									height="100"
									width="100"
									id="uploadedAvatar"
								/>
								<div class="button-wrapper">
									<label for="header_logo" class="btn btn-primary me-2 mb-4" tabindex="0">
									<span class="d-none d-sm-block">Upload Header Logo</span>
									<i class="bx bx-upload d-block d-sm-none"></i>
									<input
										type="file"
										id="header_logo"
										name="header_logo"
										class="account-file-input"
										hidden
										accept="image/png, image/jpeg"
									/>
									</label>
									<p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
								</div>
							</div>
							<div class="d-flex align-items-start align-items-sm-center gap-4">
								<img
									src="../assets/img/avatars/1.png"
									alt="user-avatar"
									class="d-block rounded"
									height="100"
									width="100"
									id="uploadedAvatar"
								/>
								<div class="button-wrapper">
									<label for="footer_logo" class="btn btn-primary me-2 mb-4" tabindex="0">
									<span class="d-none d-sm-block">Upload Footer Logo</span>
									<i class="bx bx-upload d-block d-sm-none"></i>
									<input
										type="file"
										id="footer_logo"
										name="footer_logo"
										class="account-file-input"
										hidden
										accept="image/png, image/jpeg"
									/>
									</label>
									<p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
								</div>
							</div>
						</div>
						<hr class="my-0" />
						<div class="card-body">
							<div class="row">
								<div class="mb-3 col-12">
									<label for="firstName" class="form-label">Website Title</label>
									<input
										class="form-control"
										type="text"
										name="web_title"
										id="web_title" 
										value="{{ (isset($settings['web_title']))?$settings['web_title']:'Admin Panel | Laravel' }}"
										autofocus
									/>
								</div>
								<div class="mb-3 col-12">
									<label for="timezone" class="form-label">Timezone</label>
									<select class="form-control" name="timezone" id="timezone">
										@foreach($timezones as $timezone)
										<option value="{{$timezone->value}}" {{ (isset($settings["timezone"]) && $settings["timezone"] == $timezone->value)?"selected":"" }}> {{$timezone->name}}</option>
										@endforeach
									</select>
								</div>
								<div class="mb-3 col-12">
									<label for="enable_otp" class="form-label">Enable Otp</label>
									<select id="enable_otp" name="enable_otp" class="select2 form-select">
										<option value="">Enable Otp</option>
										<option value="1" {{ (isset($settings["enable_otp"]) && $settings["enable_otp"] == "1")?"selected":"" }}> Yes</option>
										<option value="0" {{ (isset($settings["enable_otp"]) && $settings["enable_otp"] == "0")?"selected":"" }}> No </option>
									</select>
								</div>
								<div class="mb-3 col-12">
									<label for="firstName" class="form-label">Pegination Count</label>
									<input
										class="form-control"
										type="number"
										name="pagination" 
										id="pagination"
										value="{{ (isset($settings['pagination']))?$settings['pagination']:'10' }}"
										autofocus
									/>
								</div>
								<div class="mb-3 col-12">
									<label for="firstName" class="form-label">Razorpay Key</label>
									<input
										class="form-control"
										type="text"
										name="razorpay_key" 
										id="razorpay_key"
										value="{{ (isset($settings['razorpay_key']))?$settings['razorpay_key']:'' }}"
										autofocus
									/>
								</div>
								<div class="mb-3 col-12">
									<label for="firstName" class="form-label">Razorpay Secret</label>
									<input
										class="form-control"
										type="text"
										name="razorpay_secret"
										id="razorpay_secret" 
										value="{{ (isset($settings['razorpay_secret']))?$settings['razorpay_secret']:'' }}"
										autofocus
									/>
								</div>
								<div class="mb-3 col-12">
									<label for="footer_about" class="form-label">Footer About</label>
									<textarea
										class="form-control"
										name="footer_about"
										id="footer_about" 
										autofocus
									>{{ (isset($settings['footer_description']))?$settings['footer_about']:'' }}</textarea>
								</div>
								<div class="mb-3 col-12">
									<label for="footer_description" class="form-label">Footer Description</label>
									<textarea
										class="form-control editor"
										name="footer_description"
										id="footer_description" 
										autofocus
									>{{ (isset($settings['footer_description']))?$settings['footer_description']:'' }}</textarea>
								</div>
							</div>
						</div>
						<!-- /Account -->
					</div>
					<div class="tab-pane fade" id="navs-pills-justified-profile" role="tabpanel">
						<h5 class="card-header">Contact Information</h5>
						<div class="card-body">
							<div class="row">
								<div class="mb-3 col-md-6">
									<label for="firstName" class="form-label">Mobile Number</label>
									<input
										class="form-control"
										type="text"
										name="mobile" id="mobile" value="{{ (isset($settings['mobile']))?$settings['mobile']:'' }}" 
										autofocus
									/>
								</div>
								<div class="mb-3 col-md-6">
									<label for="firstName" class="form-label">Alternative Mobile Number</label>
									<input
										class="form-control"
										type="text"
										name="alternative_mobile" id="alternative_mobile" value="{{ (isset($settings['alternative_mobile']))?$settings['alternative_mobile']:'' }}" 
										autofocus
									/>
								</div>		
								<div class="mb-3 col-md-6">
									<label for="firstName" class="form-label">Email Address</label>
									<input
										class="form-control"
										type="text"
										name="email" id="email" value="{{ (isset($settings['email']))?$settings['email']:'' }}" 
										autofocus
									/>
								</div>		
								<div class="mb-3 col-md-6">
									<label for="firstName" class="form-label">Whatsapp Number</label>
									<input
										class="form-control"
										type="text"
										name="whatsapp" id="whatsapp" value="{{ (isset($settings['whatsapp']))?$settings['whatsapp']:'' }}" 
										autofocus
									/>
								</div>	
								<div class="mb-3 col-md-6">
									<label for="address" class="form-label">Office Address</label>
									<textarea
										class="form-control"
										name="address"
										id="address" 
										autofocus
									>{{ (isset($settings['address']))?$settings['address']:'' }}</textarea>
								</div>
								<div class="mb-3 col-md-6">
									<label for="gmap" class="form-label">Office Google Map</label>
									<textarea
										class="form-control"
										name="gmap"
										id="gmap" 
										autofocus
									>{{ (isset($settings['gmap']))?$settings['gmap']:'' }}</textarea>
								</div>
							</div>
						</div>
                    </div>
					<div class="tab-pane fade" id="navs-pills-justified-messages" role="tabpanel">
						<div class="card-body">
							<div class="row">
								<div class="mb-3 col-md-6">
									<label for="firstName" class="form-label">Facebook</label>
									<input
										class="form-control"
										type="text"
										name="facebook" id="facebook" placeholder="Enter Facebook Link Here" value="{{ (isset($settings['facebook']))?$settings['facebook']:'' }}" 
										autofocus
									/>
								</div>		
								<div class="mb-3 col-md-6">
									<label for="firstName" class="form-label">Twitter</label>
									<input
										class="form-control"
										type="text"
										name="twitter" id="twitter" placeholder="Enter Twitter Link Here" value="{{ (isset($settings['twitter']))?$settings['twitter']:'' }}"
										autofocus
									/>
								</div>		
								<div class="mb-3 col-md-6">
									<label for="firstName" class="form-label">LinkedIn</label>
									<input
										class="form-control"
										type="text"
										name="linkedin" id="linkedin" placeholder="Enter Linkedin Link Here" value="{{ (isset($settings['linkedin']))?$settings['linkedin']:'' }}"
										autofocus
									/>
								</div>	
								<div class="mb-3 col-md-6">
									<label for="firstName" class="form-label">Youtube</label>
									<input
										class="form-control"
										type="text"
										name="youtube" id="youtube" placeholder="Enter YouTube Link Here" value="{{ (isset($settings['youtube']))?$settings['youtube']:'' }}"
										autofocus
									/>
								</div>
							</div>
						</div>
					</div>
				</div>	
				<div class="mt-2">
					<button type="submit" class="btn btn-primary me-2">Save changes</button>
				</div>

			</div>
		</form>
	</div>
</div>
@endsection

@section('script')

<!-- ============================================================== -->

<!-- CHARTS -->

@endsection