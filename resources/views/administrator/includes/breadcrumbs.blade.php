<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<h4 class="fw-bold">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			@php
				$link = ""
			@endphp
			@for($i = 1; $i <= count(Request::segments()); $i++)
				@if($i < count(Request::segments()) & $i > 0)
					@php
						$link .= "/dashboard/" . Request::segment($i);
					@endphp
					<li class="breadcrumb-item">
						<a href="{{route('admin-dashboard')}}">{{ ucwords(str_replace('-',' ',Request::segment($i))) }}</a>
					</li>
				@else
					<li class="breadcrumb-item active">
						{{ ucwords(str_replace('-',' ',Request::segment($i))) }}
					</li>
				@endif
			@endfor
		</ol>
	</nav>
</h4>