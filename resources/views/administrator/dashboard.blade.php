@extends('administrator.layouts.app')
@section('content')
	<div class="row">
		<div class="col-lg-8 mb-4 order-0">
			<div class="card">
				<div class="d-flex align-items-end row">
					<div class="col-sm-7">
						<div class="card-body">
							<h5 class="card-title text-primary">Congratulations John! 🎉</h5>
							<p class="mb-4">
								You have done <span class="fw-bold">72%</span> more sales today. Check your new badge in
								your profile.
							</p>
							<button type="button" class="btn btn-outline-primary">View Badges</button>
						</div>
					</div>
					<div class="col-sm-5 text-center text-sm-left">
						<div class="card-body pb-0 px-0 px-md-4">
							<img
								src="{{ url('assets/administrator/images/wemon-with-laptop-light.webp') }}"
								height="140"
								alt="View Badge User"
								data-app-dark-img="{{ url('assets/administrator/images/wemon-with-laptop-light.webp') }}"
								data-app-light-img="{{ url('assets/administrator/images/wemon-with-laptop-light.webp') }}"
							/>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
@section('script')
@endsection

