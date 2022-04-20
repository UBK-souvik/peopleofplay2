@extends('front.layouts.pages')
@section('content')

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<!----content start---->
	<div class="container mb-5">
		<div class="container" style="min-height: 350px">
	        <div class="col-sm-6 col-sm-12 top-nevigation my-3">						               <div style="margin-top:50px;">
					<ul class="nav nav-tabs" style="margin-left: -6px;">
						<li>
							<a class="active" data-toggle="tab" href="#book_appointment">Today</a>
						</li>
						<li>
							<a class="span-style1" data-toggle="tab" href="#assigned_appointment">Last 7 Days</a>
						</li>
						<li>
							<a class="span-style1" data-toggle="tab" href="#last_30">Last 30 Days</a>
						</li>
					</ul>			  </div>	
	        </div>
	        <div class="row">
	            <div class="col-md-12">
	                <div class="col-sm-12 top-nevigation">
	                    <div class="tab-content">
	                        <div id="book_appointment" class="tab-pane fade in active show">
	                            <div class="row">
	                                <div class="col-sm-12">      
                                        <div  class="user-info-table">
                                        	<p class="text-center"><?php echo $today; ?></p>
											
                                            	@include('front.sales.report_display')
                                        </div>
	                                </div>        
	                            </div>      
	                        </div>
	                        <div id="assigned_appointment" class="tab-pane fade">
	                            <div class="row">
	                                <div class="col-sm-12">               
	                                	<p class="text-center">Last 7 Days</p>   
                                         @php
   
										   if(!empty($last_7))
										   {
											  $today_reports = $last_7;
                                           }
										   
										@endphp										
										
                                       @include('front.sales.report_display')
										
									   
	                                </div>        
	                            </div> 
	                        </div>
	                        <div id="last_30" class="tab-pane fade">
	                            <div class="row">
	                                <div class="col-sm-12">               
	                                	<p class="text-center">Last 30 Days</p>   
                                         @php
   
										   if(!empty($last_30))
										   {
											  $today_reports = $last_30;
                                           }
										   
										@endphp										
										
										@include('front.sales.report_display')
									   
	                                </div>        
	                            </div> 
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div> 
	</div>
<!-----end------>

<style type="text/css">
    .text-left {
        text-align: left;
    }
    .glyphicon-edit {
        color: #f48400 !important;
    }
    .glyphicon {font-size: 15px; font-weight: bold !important; }
    .table tbody tr th {
        vertical-align: bottom;
        border-bottom: 2px solid #dee2e6;
        padding: .75rem;
    }
    .table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(0,0,0,.05);
    }
    .f17 {
        font-size: 17px !important;
    }
    .f15 {
        font-size: 15px !important;
    }
    .tab-content>.active {
	    display: block;
	}
	p.text-center {
	    font-size: x-large;
	}
</style>

 	<style type="text/css">
        .error-message{color: #fff; background-color: red; padding: 5px; margin: 5px 0; }
        .unit-body {border: 2px solid #f28401; padding: 15px; margin: 15px 0; border-radius: 5px; }
        .unit_number {font-size: 18px; }
        .unit {padding: 5px 0; }
        .top-nevigation {padding-bottom: 25px; }
        ul.nav.nav-tabs {border: 0; }
        .top-nevigation li {border: 1px solid #000!important; }
        .top-nevigation a {border: 0 !important;padding: 0 6px; }
        .top-nevigation li.active a {background: #f2f2f2; color: #000;}
        .top-nevigation li a.active {background: #000; color: #fff;padding: 3px 10px; }
        .add-unit-main {text-align: right; }
        .unit-delete span {color: #000000bd; position: relative; float: right;     margin-left: 5px; }
        .Building-title {font-size: 24px; }
        .ui-datepicker {margin: 0 auto; }
    </style>
	
	@endsection


	@section('scripts')
		<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript">
		$(document).ready(function() {
    		$('.example').DataTable();
    	});
    	</script>
	@endsection