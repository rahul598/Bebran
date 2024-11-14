@extends('layouts.admin')

<style>
	.dropzone .dz-message {
		height: 90% !important;
		top: 150px !important;
	}

	.col_inst ol,
	.for_inst ul {
		margin-left: -25px;
	}

	.stock_out hr {
		margin-top: 0rem;
	}

	.for_inst p,
	.for_inst ul {
		margin-bottom: .3rem;
	}

	.stock_out .dropzone {
		min-height: 320px;
	}

	#for_ins strong {
		color: #1b749e;
	}

	section.content:before {
		content: "";
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 50px;
	}


	.upload_3rd_bx {
    display: flex;
}

.upload_3rd_bx .upload_card {
    width: 30%;
}

.upload_3rd_bx .upload_card:nth-child(1) {
    width: 40%;
}

.upload_3rd_bx .step_heading {
    border-bottom: 1px solid rgba(255, 255, 255, 0.5);
    padding-bottom: 10px;
}
.upload_3rd_bx .body_upload h5{
   all: unset;
   display: flex;
   align-items: center;
   text-align: left;
   font-size: 13px;
   padding: 0 15px;
   margin-top: 8px;
} 
.upload_3rd_bx .body_upload h5 span:nth-child(1){
   font-weight: 900;
   color: rgb(27, 116, 158);
   margin-right: 5px;
} 
.upload_3rd_bx .body_upload h5 span:nth-last-child(1){
   font-weight: 600;
   margin-left: 5px;
   color: red;
} 
.upload_3rd_bx .pra {
   all: unset;
   text-align: left;
   padding: 0 0 0 15px;
   display: flex;
   align-items:start;
   margin-top: 3px;
   font-size: 13px;
} 
.upload_3rd_bx .pra:nth-child(6) {
   margin-top: 15px;
} 
.upload_3rd_bx .pra:nth-last-child(1) {
   padding-bottom: 20px;
} 
.upload_3rd_bx .pra span {
    font-weight: 900;
   color: rgb(27, 116, 158);
   margin-right: 5px;
} 
.body_upload {
	height: unset;
    min-height: 200px;
    max-height: initial;
}
.body_upload {
    padding: 0px 0px;
    border-radius:0 0 10px 10px !important;
}
.chosen-container {
    top: 10px;
}
.heading_upload {
	text-align: center;
	font-size: 18px;
	font-weight: 600;
	color: #fff;
	/* background-color: #3b5998; */
	background-color: #8c99e0;
	padding: 10px 10px;
	border-radius: 10px 10px 0px 0px;
	line-height: 20px;
	height: 89px;
}
.upload_card {
	margin: 10px;
	font-weight: 500;
	text-align: center;
	width: 20%;
}

.upload_card:nth-child(1) {
	width: 40%;
}

.card_upload {
	border-radius: 10px !important;
	/* height: 300px; */
}

.heading_upload {
	text-align: center;
	font-size: 18px;
	font-weight: 600;
	color: #fff;
	/* background-color: #3b5998; */
	background-color: #8c99e0;
	padding: 10px 10px;
	border-radius: 10px 10px 0px 0px;
	line-height: 20px;
	height: 89px;
}

.step_heading {
	border-bottom: 1px dashed rgba(255, 255, 255, 0.5);
	width: 94%;
	margin: 0px auto;
	margin-bottom: 8px;
}

.body_upload {
	padding: 20px 0px;
	/* position: relative; */
	height: 200px;
}

.icon_card {
	position: absolute;
	top: 50%;
	left: 50%;
	transform: translate(-50%, -50%);
	width: 100%;
}

.icon_card:nth-child(2) {
	position: absolute;
	top: 63% !important;
	left: 50%;
	transform: translate(-50%, -50%);
	width: 100%;
}

.step1_instruction {
	padding: 10px 10px 10px 30px;
	font-weight: 500;
	text-align: left;
}

.upload_content_bottom {
	position: absolute;
	bottom: 10px;
	left: 50%;
	transform: translate(-50%);
	width: 100%;
}

.browse_file {
	position: absolute;
	bottom: 20%;
	left: 50%;
	transform: translate(-50%);
}

.project_action_icons {
	margin: 2px;
}

table td {
	vertical-align: middle !important;
}
.upload_heading:before {
    background: #6572b8;
}
.instruction_list {
    display: flex;
    justify-content: start;
    background-color: rgba(0, 0, 0, 0.07);
    padding: 20px;
    border-radius: 10px;
    margin-bottom: 10px;
}
.card_if_else {
    background: none !important;
    padding-bottom: 40px;
} 
.card {
    -moz-transition: all 0.5s;
    -o-transition: all 0.5s;
    -webkit-transition: all 0.5s;
    transition: all 0.5s;
    background: #fff;
    border-radius: 0.1875rem;
    margin-bottom: 30px;
    border: 0;
    display: inline-block;
    position: relative;
    width: 100%;
    box-shadow: none !important;
     border:0 !important;
}
.card .body {
    color: #000;
    font-weight: 500;
    /* font-weight: 500; */
    font-size: 13px;
    padding: 20px 20px 0px 20px;
}
.upload_heading {
    color: #6572b8;
    font-size: 15px;
    font-weight: 600;
    margin-bottom: 10px;
}
.instruction_items {
    margin-right: 50px;
}
.instruction_list_items {
    padding-top: 5px;
    padding-bottom: 5px;
}
.instruction_list_items span:nth-child(1) {
    width: 15px;
    text-align: left;
}
.instruction_list_items span:nth-child(1) {
    display: flex;
}
.instruction_list_items span:nth-child(1) {
    display: flex;
}
.instruction_list_items span:nth-child(2) {
    text-align: left;
}
.font-weight-bold{
    margin-right:5px;
}
.mainColor{
    background-color:#181e4e !important;
}
.secondColor{
    background-color:#facc15 !important;
}
.error_table.table {
    width: 100%;
    margin-bottom: 1rem;
    color: #212529;
}

.error_table.table-bordered {
    border: 1px solid #dee2e6;
}

.error_table.table-bordered th,
.table-bordered td {
    border: 1px solid #dee2e6;
}

.error_table.table th,
.error_table.table td {
    padding: 0.75rem;
    vertical-align: top;
    border-top: 1px solid #dee2e6;
}

.error_table.table thead th {
    vertical-align: bottom;
}

</style>
@section('content')
<section class="content margin-custom">
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">{{ __('Price Widget') }} </h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item btn btn-sm bg-primary text-dark"><a href="{{ route('price_widget_list') }}">{{ __('Back') }}</a></li>
        </ol>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex upload_3rd_bx">
                <div class="upload_card">
                    <div class="card card_upload shadow">
                        <div class="heading_upload mainColor">
                            <div class="small step_heading">
                                <small><b>Guide</b></small>
                            </div>
                            File guidelines
                        </div>
                        <div class="body_upload">
                            <ol class="step1_instruction">
                                <li style="margin-top: 5px; font-size: 13px; font-weight:600;">
                                   Price Upload for the Pricing Service on Bebran.com.
                                </li>
                                <li class="d-none" style="margin-top: 5px; font-size: 13px; font-weight:600;">
                                    If the store is not present in VMX, send an email to Regional MIS in the given format.
                                </li>
                                <li style="margin-top:20px !important;list-style:none;margin-top: 5px; font-size: 12px; font-weight:600;">
                                    Also, no column should contain any <span style="color:#1b749e;">commas(,)</span> / 
                                    <span style="color:#1b749e;">apostrophe(')</span> / 
                                    <span style="color:#1b749e;">Double Quotes (")</span>
                                </li>
                                <li style="list-style:none;margin-top: 0px; font-size: 12px; font-weight:600;">
                                    File size limit: 10MB
                                </li>
                                <li style="list-style:none;margin-top: 0px; font-size: 12px; font-weight:600;">
                                    Number of rows limit: 5000 <span style="color:#1b749e;">While Uploading keep .csv file open</span>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="upload_card">
                    <div class="card card_upload shadow">
                        <div class="heading_upload mainColor">
                            <div class="small step_heading">
                                <small><b>Step 2</b></small>
                            </div> 
                            Download Sample and Exist data CSV
                        </div>
                        <div class=" body_upload">  
                            <div class="upload_content_bottom mb-2" style="bottom:40%">
                                <a href="" class="btn secondColor">Price Data Download</a> {{-- route('price_data_download_new') --}}
                            </div>
                            <div class="upload_content_bottom" style="bottom:25%">
                                <a href="{{ route('pricing_list_id') }}" class="btn secondColor">Download list of Pricing Service Id CSV</a>
                            </div>
                            <div class="upload_content_bottom" style="bottom:10% !important;">
                                <a id="sample_file" class="btn btn-sm box-shadow-4 secondColor" href="{{ route('download.sample') }}" download>Download Sample</a> 
                            </div>
                        </div> 
                    </div>
                </div>
                <div class="upload_card">
                    <div class="card card_upload shadow">
                        <div class="heading_upload mainColor">
                            <div class="small step_heading">
                                <small><b>Step 3</b></small>
                            </div>
                            Upload Price CSV
                        </div>
                        <div class="body_upload">
                            <div class="icon_card">
                                <img src="{{ asset('admin/uploadGIF.gif') }}" alt="" class="download_gif_icon">
                            </div>
                            <form  id="uploadForm" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="dz-message">
                                    <img src="{{ asset('admin/uploadGIF.gif') }}" alt="" class="download_gif_icon" id="img_up" style="width: 40px;">
                                    <div class="browse_file">
                                        <label for="uploadFile" class="file-label rounded btn btn-sm secondColor text-dark" style="font-weight:400;">
                                            Browse Files
                                        </label>
                                        <input type="file" class="d-none uploadFile" id="uploadFile" name="file" accept=".csv">
                                    </div>
                                </div>
                                <div class="upload_content_bottom" style="bottom:5%">
                                    <input type="submit" class="btn btn-sm mainColor text-white" value="Submit">
                                </div>
                            </form>  

                        </div>
                        
                    </div>
                </div>  
            </div>
            
            <div class="row">
                <div class="col-md-12 mx-auto">
                    <div class="card card_if_else " style="padding-bottom:40px; background:none;">
                        <div class="body">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="instruction" role="tabpanel" aria-labelledby="instruction-tab">
                                    <div class="col_inst" id="col_ins">
                                        <span class="po_select_err text-danger"></span>
                                        <h3 class="upload_heading">Column Instructions</h3>  
                                        <p>All Column should be in same order as below.</p>
                                        <div class="instruction_list">
													<div class="instruction_items">
														<div class="d-flex instruction_list_items"><span class="font-weight-bold">1.</span><span><strong>Service Id <sup style="font-size:11px;color:red;">*</sup> : </strong><small>(Numeric)</small></span></div>
														<div class="d-flex instruction_list_items"><span class="font-weight-bold">2.</span> <span><strong>Plan Name <sup style="font-size:11px;color:red;">*</sup> : </strong><small>(Alpha)</small></span></div>
														<div class="d-flex instruction_list_items"><span class="font-weight-bold">3.</span> <span><strong>Plan Duration
 <sup style="font-size:11px;color:red;">*</sup> : </strong><small>(Alpha)</small></span></div>
														<div class="d-flex instruction_list_items"><span class="font-weight-bold">4.</span><span><strong>Main Price <sup style="font-size:11px;color:red;">*</sup> : </strong><small>(Numeric)</small></span></div>
														<div class="d-flex instruction_list_items"><span class="font-weight-bold">5.</span> <span><strong>Discount <sup style="font-size:11px;color:red;">*</sup> : </strong><small>(Numeric)</small></span></div>
													</div>
													<div class="instruction_items">
														<div class="d-flex instruction_list_items"><span class="font-weight-bold">6.</span> <span><strong>Most Popular <sup style="font-size:11px;color:red;">*</sup> : </strong><small>(Numeric)</small></span></div>
													</div> 
												</div>
                                    </div>
                                </div>
                                 
                            </div>
                            <!-- END Tab 1 and Tab 2 content -->
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    
</div> 

</section> 
@endsection
@section('more-scripts')
<script>
$(document).ready(function() { 
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
      $('#uploadForm').on('submit', function(event) {
    event.preventDefault();

    var formData = new FormData(this);

    // Ensure the file input exists and is correctly accessed
    var fileInputElement = $('#uploadFile')[0]; // Using id instead of class

    if (fileInputElement.files.length > 0) {
        var fileInput = fileInputElement.files[0];
        formData.append('file', fileInput); 
        
        $.ajax({
            url: "{{ route('pricing_list_upload') }}",
            type: 'POST',
            contentType: false,
            processData: false,
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.status === 0) {
                    // Clear any previous error messages
                    $('.po_select_err').empty();

                    // Create a table to display the error message
                    var errorTable = '<table class="table table-bordered">';
                    errorTable += '<thead><tr><th>Service ID</th><th>Error Message</th></tr></thead><tbody>';
                    errorTable += '<tr><td>' + response.data + '</td><td>' + response.message + '</td></tr>';
                    errorTable += '</tbody></table>';

                    // Append the error table to the po_select_err div
                    $('.po_select_err').append(errorTable);
                } else {
                    // alert('File uploaded successfully');
                    Swal.fire({
                        icon: 'success',
                        title: 'File uploaded successfully',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error('Error: ', error);
                console.log('File upload failed: ' + xhr.responseText);
            }
        });
    } else {
        alert('No file selected!');
    }
});

});


</script>
@endsection