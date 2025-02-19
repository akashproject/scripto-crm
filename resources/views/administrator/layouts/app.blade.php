<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Akash Dutta">
    <!-- CSRF Token -->

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Admin Panel') }}</title>

    <!-- Scripts -->
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
    <!-- Core CSS -->
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ url('assets/administrator/css/theme.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.4/css/boxicons.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.css" />
    
    
    <link rel="stylesheet" href="{{ url('assets/administrator/css/style.css') }}" />
    @yield('style')
</head>

<body class="">
    
        @if(auth()->check())
            <!-- Layout wrapper -->
            <div class="layout-wrapper layout-content-navbar">
            <div class="layout-container">
            @include('administrator.includes.sidebar')
        @else

		@endif
        
       
          @if(auth()->check())
            <!-- Layout container -->
            <div class="layout-page">
            <!-- Navbar -->
            @include('administrator.includes.navbar')
          @endif
          <!-- / Navbar -->
            @if(auth()->check())
            <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- Content -->
                <div class="container-xxl flex-grow-1 container-p-y">
                @include('administrator.includes.breadcrumbs')
            @else
            <div class="container-xxl">
            @endif
            @yield('content')
            </div>
            <!-- / Content -->
            @include('administrator.includes.footer')
            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>
      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
<!-- All Jquery -->
<script>
    let globalUrl = "{{ env("APP_URL") }}"
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.0/dropzone.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.6/perfect-scrollbar.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.10.0/tinymce.min.js"></script>
<script async defer src="https://buttons.github.io/buttons.js"></script>

<script src="{{ url('assets/administrator/js/theme.js') }}"></script>
<script src="{{ url('assets/administrator/js/main.js') }}"></script>

<script>
    tinymce.init({
        selector : ".editor",
        plugins: 'emoticons wordcount help code lists',
        menubar : true,
        toolbar: "undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media pageembed template link anchor codesample | a11ycheck"
    });
</script>

<script>
    Dropzone.options.dropzonewidget = { 
        maxFilesize: 150, // 2 MB
        success: function(file, response){ // Dropzone upload response
            var html = '<div class="file-content text-center"><a href="#imageBox" class="image-thumbnail open-popup-link" data-id="'+response.id+'"><img src="'+`${globalUrl}`+response.path+'/thumb_'+response.filename+'" alt="" style="width:100%"></a><a target="_blank" href="'+`${globalUrl}`+'administrator/view-file/'+response.id+'" style="display:block">Edit</a></div>';
            $(".image-thumbnail-container").prepend(html);
        }
    };
</script>
@yield('script')
</body>
</html>