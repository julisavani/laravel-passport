<!DOCTYPE html>
<html>
	<head>
		<!-- Basic Page Info -->
		<meta charset="utf-8" />
		<title>Andor</title>

		<meta name="csrf-token" content="{{ csrf_token() }}" />
		<!-- Site favicon -->
		<link
			rel="apple-touch-icon"
			sizes="180x180"
			href="vendors/images/apple-touch-icon.png"
		/>
		<link
			rel="icon"
			type="image/png"
			sizes="32x32"
			href="vendors/images/favicon-32x32.png"
		/>
		<link
			rel="icon"
			type="image/png"
			sizes="16x16"
			href="vendors/images/favicon-16x16.png"
		/>

		<!-- Mobile Specific Metas -->
		<meta
			name="viewport"
			content="width=device-width, initial-scale=1, maximum-scale=1"
		/>

		<!-- Google Font -->
		<link
			href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
			rel="stylesheet"
		/>
		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="{{ url('assets/vendors/styles/core.css') }}" />
		<link
			rel="stylesheet"
			type="text/css"
			href="{{ url('assets/vendors/styles/icon-font.min.css') }}"
		/>
		<link
			rel="stylesheet"
			type="text/css"
			href="{{ url('assets/src/styles/jquery.toast.min.css') }}"
		/>
		<link
			rel="stylesheet"
			type="text/css"
			href="{{ url('assets/src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}"
		/>
		<link
			rel="stylesheet"
			type="text/css"
			href="{{ url('assets/src/plugins/datatables/css/responsive.bootstrap4.min.css') }}"
		/>
		<link rel="stylesheet" type="text/css" href="{{ url('assets/vendors/styles/style.css') }}" />
		<link rel="stylesheet" type="text/css" href="{{ url('assets/src/styles/style.css') }}" />
		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />
		

		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script
			async
			src="https://www.googletagmanager.com/gtag/js?id=G-GBZ3SGGX85"
		></script>
		<script
			async
			src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2973766580778258"
			crossorigin="anonymous"
		></script>
		
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script>
			var web_url = "{{ url('/') }}";
			var token = $('meta[name="csrf-token"]').attr("content");
			// $.validator.setDefaults({
			// 	ignore: ":hidden, 	[contenteditable='true']:not([name])"
			// });
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
		</script>
		@yield('css')
		<!-- Google Tag Manager -->
		
		<!-- End Google Tag Manager -->
	</head>
	<body>
		{{-- <div class="pre-loader"> --}}
			{{-- <div class="pre-loader-box">
				<div class="loader-logo">
					<img src="vendors/images/deskapp-logo.svg" alt="" />
				</div> --}}
				{{-- <div class="loader-progress" id="progress_div">
					<div class="bar" id="bar1"></div>
				</div> --}}
				{{-- <div class="percent" id="percent1">0%</div> --}}
				{{-- <div class="loading-text">Loading...</div> --}}
			{{-- </div> --}}
		{{-- </div> --}}

    @include('admin.elements.header-menu')
    @include('admin.elements.sidebar')
   
    {{-- header --}}
    {{-- sidebar --}}

		<div class="mobile-menu-overlay"></div>
    @yield('content')
		
		<!-- welcome modal end -->
		<!-- js -->
		<script src="{{ url('assets/vendors/scripts/core.js') }}"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"></script>
		<link rel="stylesheet" href="https://kendo.cdn.telerik.com/2022.3.913/styles/kendo.default-main.min.css">
		  {{-- CKEditor CDN --}}
		  <script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>
		  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
	
		<script src="{{ url('assets/vendors/scripts/script.min.js') }}"></script>
		<script src="{{ url('assets/vendors/scripts/process.js') }}"></script>
		<script src="{{ url('assets/vendors/scripts/layout-settings.js') }}"></script>
		<script src="{{ url('assets/src/plugins/apexcharts/apexcharts.min.js') }}"></script>
		<script src="{{ url('assets/src/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
		<script src="{{ url('assets/src/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
		<script src="{{ url('assets/src/plugins/datatables/js/dataTables.responsive.min.js') }}"></script>
		<script src="{{ url('assets/src/plugins/datatables/js/responsive.bootstrap4.min.js') }}"></script>
		{{-- <script src="{{ url('assets/vendors/scripts/dashboard3.js') }}"></script> --}}
		<script src="{{ url('assets/src/scripts/jquery.toast.min.js') }}"></script>
		{{-- <script src="https://kendo.cdn.telerik.com/2022.3.913/js/jquery.min.js"></script> --}}
		<script src="https://kendo.cdn.telerik.com/2022.3.913/js/kendo.all.min.js"></script>
		<script src="https://kendo.cdn.telerik.com/2022.3.913/js/pako_deflate.min.js"></script>
		<script src="{{ url('assets/src/scripts/common.js') }}"></script>
		@yield('script')
	
		<!-- Google Tag Manager (noscript) -->
		
		<!-- End Google Tag Manager (noscript) -->
	</body>
</html>
