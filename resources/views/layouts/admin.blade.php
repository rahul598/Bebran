@if(Auth::check())
<?php $user = Auth::user(); ?>

<!--login-->
@if($user->role_id!='1')
<script type="text/javascript">
  window.location = "{{ url('/') }}";
</script>
<?php die();?>
@endif

@else

<!--not login-->
<script type="text/javascript">
  window.location = "{{ url('/admin') }}";
</script>
<?php die();?>
@endif
<?php 
if (config('site.logo') && File::exists(public_path('uploads/'.config('site.logo')))) {
  $site_logo = asset('uploads/'.config('site.logo'));
}else{
  $site_logo = config('site.title');
}
if (config('site.mobilelogo') && File::exists(public_path('uploads/'.config('site.mobilelogo')))) {
  $site_mobilelogo = asset('uploads/'.config('site.mobilelogo'));
}else{
  $site_mobilelogo = $site_logo;
}
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>{{config('site.title')}} | Dashboard</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
	
	<!-- Boostrap Icon -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="{{ asset('admin_lte/plugins/fontawesome-free/css/all.min.css') }}">
	<!-- Ionicons -->
	<link rel="stylesheet" href="//code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- Tempusdominus Bbootstrap 4 -->
	<link rel="stylesheet" href="{{ asset('admin_lte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
	<!-- iCheck -->
	<link rel="stylesheet" href="{{ asset('admin_lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
	<!-- JQVMap -->
	<link rel="stylesheet" href="{{ asset('admin_lte/plugins/jqvmap/jqvmap.min.css') }}">
	<!-- Select2 -->
	<link rel="stylesheet" href="{{ asset('admin_lte/plugins/select2/css/select2.min.css') }}">
	<link rel="stylesheet" href="{{ asset('admin_lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
	<!-- Theme style -->
	<link rel="stylesheet" href="{{ asset('admin_lte/dist/css/adminlte.min.css') }}">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="{{ asset('admin_lte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
	<!-- Daterange picker -->
	<link rel="stylesheet" href="{{ asset('admin_lte/plugins/daterangepicker/daterangepicker.css') }}">
	<!-- summernote -->
	<link rel="stylesheet" href="{{ asset('admin_lte/plugins/summernote/summernote-bs4.css') }}">
	<!-- Google Font: Source Sans Pro -->
	<link href="//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('admin_lte/custom.css') }}"> 
	<link rel="stylesheet" href="{{ asset('admin_lte/datatable_css/datatableBootstrap4.css') }}"> 
	<link rel="stylesheet" href="{{ asset('admin_lte/datatable_css/datatable.min.css') }}"> 
	 <link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">  

    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <style>
        .btn-light {
            background-color: #06D001 !important;
        }
        .ck-content br {
            display: block;
            margin-bottom: 0; /* Adjust margin between lines */
        }
        
        .ck-content {
            line-height: 1.2; /* Adjust line-height if necessary */
        }
    </style>
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
        $( function() {
          var dateFormat = "mm/dd/yy",
            from = $( "#from" )
              .datepicker({
                defaultDate: "+1w",
                changeMonth: true,
                numberOfMonths: 1
              })
              .on( "change", function() {
                to.datepicker( "option", "minDate", getDate( this ) );
              }),
            to = $( "#to" ).datepicker({
              defaultDate: "+1w",
              changeMonth: true,
              numberOfMonths: 1
            })
            .on( "change", function() {
              from.datepicker( "option", "maxDate", getDate( this ) );
            });

          function getDate( element ) {
            var date;
            try {
              date = $.datepicker.parseDate( dateFormat, element.value );
            } catch( error ) {
              date = null;
            }

            return date;
          }
        } );
        </script>
	@yield('more-css')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">
		<nav class="main-header navbar navbar-expand navbar-white navbar-light">
			<!-- Left navbar links -->
			<ul class="navbar-nav">
				<li class="nav-item"><a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a></li>
		        <!-- <li class="nav-item d-none d-sm-inline-block">
		          <a href="index3.html" class="nav-link">Home</a>
		        </li>
		        <li class="nav-item d-none d-sm-inline-block">
		          <a href="#" class="nav-link">Contact</a>
		        </li> -->
			</ul>
			<!-- Right navbar links -->
			<ul class="navbar-nav ml-auto">
				<!-- Navbar Search -->
				<!-- <li class="nav-item">
				  <a class="nav-link" data-widget="navbar-search" href="#" role="button">
				    <i class="fas fa-search"></i>
				  </a>
				  <div class="navbar-search-block">
				    <form class="form-inline">
				      <div class="input-group input-group-sm">
				        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
				        <div class="input-group-append">
				          <button class="btn btn-navbar" type="submit">
				            <i class="fas fa-search"></i>
				          </button>
				          <button class="btn btn-navbar" type="button" data-widget="navbar-search">
				            <i class="fas fa-times"></i>
				          </button>
				        </div>
				      </div>
				    </form>
				  </div>
				</li> -->
				<li class="nav-item"><a class="nav-link" href="{{ config('site.url') ? config('site.url') : url('/') }}" target="_blank">Visit Site</a> </li>

				<!-- Messages Dropdown Menu -->

				<!-- Notifications Dropdown Menu -->
				<li class="nav-item dropdown">
				  <a class="nav-link" data-toggle="dropdown" href="javascript:void(0);">
				  <i class="fa fa-user" aria-hidden="true"></i>
				    <!-- <span class="badge badge-warning navbar-badge">15</span> -->
				  </a>
				  <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
				    <!-- <span class="dropdown-item dropdown-header">15 Notifications</span> -->
				    <!-- <div class="dropdown-divider"></div> -->
				     <a href="{{ url('/profile') }}" class="dropdown-item">
						<i class="fas fa-user"></i> Profile
				      <!-- <span class="float-right text-muted text-sm">3 mins</span> -->
				    </a>
				     <a href="{{ url('/admin/logout') }}" class="dropdown-item">
						<i class="fas fa-sign-out-alt"></i> Logout
				      <!-- <span class="float-right text-muted text-sm">3 mins</span> -->
				    </a>
				    <!-- <div class="dropdown-divider"></div>
				    <a href="#" class="dropdown-item">
				      <i class="fas fa-users mr-2"></i> 8 friend requests
				      <span class="float-right text-muted text-sm">12 hours</span>
				    </a>
				    <div class="dropdown-divider"></div>
				    <a href="#" class="dropdown-item">
				      <i class="fas fa-file mr-2"></i> 3 new reports
				      <span class="float-right text-muted text-sm">2 days</span>
				    </a>
				    <div class="dropdown-divider"></div>
				    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
				  </div> -->
				</li>
				<li class="nav-item">
				  <a class="nav-link" data-widget="fullscreen" href="javascript:;" role="button">
				    <i class="fas fa-expand-arrows-alt"></i>
				  </a>
				</li>
				<!-- <li class="nav-item">
				  <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
				    <i class="fas fa-th-large"></i>
				  </a>
				</li> -->
			</ul>
		</nav>
		<aside class="main-sidebar sidebar-dark-primary elevation-4">
			<a href="{{url('admin')}}" class="brand-link">
				@if(config('site.logo2') && File::exists(public_path('uploads/'.config('site.logo2'))))
		          <img src="{!! asset('/uploads/'.config('site.logo2')) !!}" alt="{{config('site.title')}}" class="brand-image img-circle elevation-3" style="opacity: .8">
		        @else
				<img src="{{ $site_mobilelogo }}" alt="{!! config('site.title') !!}" class="brand-image img-circle elevation-3" style="opacity: .8">
		        @endif
				<span class="brand-text font-weight-light">{{config('site.title')}}</span>
			</a>
			<div class="sidebar">
				@include('admin.sidebar')
			</div>
		</aside>
		<div class="content-wrapper">
			@yield('content')
		</div>
		<!-- /.content-wrapper -->
		<footer class="main-footer">
			<strong>Copyright &copy; {{ date('Y') }}-{{ date('Y') + 1 }} <a href="{{url('/')}}" target="_blank">{{ config('site.title', 'Laravel') }}</a></strong>
			All rights reserved.
		</footer>
	</div>
	<!-- jQuery -->
	<script src="{{ asset('admin_lte/plugins/jquery/jquery.min.js') }}"></script>
	<!-- jQuery UI 1.11.4 -->
	<script src="{{ asset('admin_lte/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	<script>
	  $.widget.bridge('uibutton', $.ui.button)
	</script>
	<!-- Bootstrap 4 -->
	<script src="{{ asset('admin_lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
	<!-- Select2 -->
	<script src="{{ asset('admin_lte/plugins/select2/js/select2.full.min.js') }}"></script>
	<!-- ChartJS -->
	<script src="{{ asset('admin_lte/plugins/chart.js/Chart.min.js') }}"></script>
	<!-- Sparkline -->
	<script src="{{ asset('admin_lte/plugins/sparklines/sparkline.js') }}"></script>
	<!-- JQVMap -->
	<script src="{{ asset('admin_lte/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
	<script src="{{ asset('admin_lte/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
	<!-- jQuery Knob Chart -->
	<script src="{{ asset('admin_lte/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
	<!-- daterangepicker -->
	<script src="{{ asset('admin_lte/plugins/moment/moment.min.js') }}"></script>
	<script src="{{ asset('admin_lte/plugins/daterangepicker/daterangepicker.js') }}"></script>
	<!-- Tempusdominus Bootstrap 4 -->
	<script src="{{ asset('admin_lte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
	<!-- Bootstrap Switch -->
	<script src="{{ asset('admin_lte/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
	<!-- Summernote -->
	<script src="{{ asset('admin_lte/plugins/summernote/summernote-bs4.min.js') }}"></script>
	<!-- overlayScrollbars -->
	<script src="{{ asset('admin_lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
	<!-- AdminLTE App -->
	<script src="{{ asset('admin_lte/dist/js/adminlte.js') }}"></script>
	<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
	<script src="{{ asset('admin_lte/dist/js/pages/dashboard.js') }}"></script>
	<!-- AdminLTE for demo purposes --> 
	<script src="{{ asset('admin_lte/dist/js/demo.js') }}"></script>
	<script src='//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js'></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="{{ asset('admin_lte/dist/js/cool.js') }}"></script>
	 <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

	<!-- CK Editor -->
	<!--<script src="{{ asset('/admin_lte/plugins/ckeditor/ckeditor.js') }}"></script>-->
	<!--<script src="{{ asset('/admin_lte/ckfinder/ckfinder.js') }}"></script> -->
	<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/ckfinder/ckfinder.js"></script>


	<!-- include summernote css/js -->
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.19.3/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
	<script type="text/javascript">
// 	$(function () { 
//         CKFinder.setupCKEditor(null, '{{ asset("/admin_lte/ckfinder/") }}');
      
//         $("input[data-bootstrap-switch]").each(function(){
//             $(this).bootstrapSwitch('state', $(this).prop('checked'));
//         });
    
//         CKEDITOR.replace('.editorck', {    
//             filebrowserImageUploadUrl: '{{ route("ckeditorImageUpload") }}?type=Images&_token={{ csrf_token() }}',   
//             filebrowserUploadUrl: '{{ route("ckeditorFileUpload") }}?type=Files&_token={{ csrf_token() }}', 
//             filebrowserUploadMethod: 'form',
//             extraPlugins: 'image2, colorbutton',
//             removeDialogTabs: 'link:upload;image:advanced',
//         });  
//     }); 
	</script>
    <script> 

    document.querySelectorAll('.ckeditor').forEach((editorElement) => {
    ClassicEditor
        .create(editorElement, {
            toolbar: {
                items: [
                    'heading', '|',
                    'undo', 'redo', '|', 'bold', 'italic', 'underline', 'strikethrough', 'subscript', 'superscript', '|',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', '|',
                    'link', 'bulletedList', 'numberedList', 'blockQuote', '|',
                    'alignment', '|',
                    'insertTable', 'imageUpload', 'mediaEmbed', 'ckfinder', '|',
                    'indent', 'outdent', '|', 'code', 'codeBlock', '|', 
                    'removeFormat', '|',
                    'highlight', '|',
                    'horizontalLine', '|',
                    'pageBreak', '|',
                    'sourceEditing'
                ]
            },
            ckfinder: {
                uploadUrl: '{{ route("ckeditorImageUpload", ["_token"=>csrf_token()]) }}',
                onUpload: (files) => {
                    const validExtensions = ['webp'];
                    const file = files[0]; // Get the first file from the upload
                    const fileExtension = file.name.split('.').pop().toLowerCase();
                    
                    if (!validExtensions.includes(fileExtension)) {
                        alert('Only .webp files are allowed for upload.');
                        return false; // Prevent upload
                    }
                    
                    return true; // Allow upload if valid
                }
            },
            codeBlock: {
            languages: [
                { language: 'plaintext', label: 'Plain text' },
                { language: 'javascript', label: 'JavaScript' },
                { language: 'html', label: 'HTML' },
                { language: 'css', label: 'CSS' }
            ]
        },
            image: {
                toolbar: [
                    'imageTextAlternative', 'imageStyle:inline', 'imageStyle:block', 'imageStyle:side',
                    '|', 'linkImage'
                ]
            },
            table: {
                contentToolbar: [
                    'tableColumn', 'tableRow', 'mergeTableCells'
                ]
            },
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                    { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                    { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                    { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                    { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
                ]
            },
            mediaEmbed: {
                previewsInData: true
            },
            typing: {
                transformations: {
                    remove: [
                        'typography',
                        'symbols',
                        'ellipsis'
                    ]
                }
            },
            language: 'en',
            codeBlock: {
                languages: [
                    { language: 'plaintext', label: 'Plain text' }, // You can add more languages here
                    { language: 'javascript', label: 'JavaScript' },
                    { language: 'html', label: 'HTML' },
                    { language: 'css', label: 'CSS' }
                ]
            }
        })
        .then(editor => {
            console.log('Editor was initialized', editor);
        })
        .catch(error => {
            console.error('There was a problem initializing the editor.', error);
        });
});


// Define the custom plugin to handle the Enter key
function MyCustomEnterPlugin(editor) {
    editor.model.schema.extend('$text', { allowAttributes: 'br' });

    // Handle Enter keypress to insert <br> instead of <p>
    editor.keystrokes.set('Enter', (data, stop) => {
        editor.model.change(writer => {
            const insertPosition = editor.model.document.selection.getFirstPosition();
            writer.insertElement('br', insertPosition); // Insert <br> element
        });
        stop();
    });
}

</script>
 

	<script>
	$(document).ready(function(){
	    //   summernote
        $('.summernote').summernote({
            placeholder: 'Write your text here...',
            height: 300, // Change the height as needed
            toolbar: [
                ['style', ['style', 'bold', 'italic', 'underline', 'strikethrough', 'clear']],
                ['fonts', ['fontsize', 'fontname']],
                ['color', ['forecolor', 'backcolor']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video', 'hr', 'audio']],
                ['view', ['fullscreen', 'codeview', 'undo', 'redo']],
                ['help', ['help']]
            ],
            onInit: function() {
            var editor = this;
            $(editor).on('summernote.keydown', function(e) {
                if (e.keyCode === 13) { // Enter key
                    var range = $(editor).summernote('createRange');
                    var startContainer = range.sc;
                    var parentNode = startContainer.parentNode;

                    // Check if the current selection is within a list item (LI)
                    if (parentNode && parentNode.nodeName === 'LI') {
                        e.preventDefault();
                        
                        // Check if the list item is empty (excluding the bullet point)
                        if (parentNode.innerHTML === '<br>' || parentNode.innerHTML === '') {
                            // If the list item is empty, outdent the current list item (simulate removing a list item)
                            document.execCommand('outdent');
                        } else {
                            // If the list item is not empty, add a new list item
                            document.execCommand('insertHTML', false, '<li><br></li>');
                            // Move the cursor to the new list item
                            range = $(editor).summernote('createRange');
                            range.collapse(false);
                            range.select();
                        }
                    }
                }
            });
        }
        });
	});
	
	$(document).ready(function() {
        @if(Session::has('error'))
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: '{{ Session::get('error') }}',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });
        @endif

        @if(Session::has('success'))
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: '{{ Session::get('success') }}',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });
        @endif

        @if ($errors->any())
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: 'There were some errors with your submission',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });
        @endif
    });
	</script>
	@yield('more-scripts')
</body>
</html>
