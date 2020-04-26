<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="Neon Admin Panel" />
	<meta name="author" content="" />

	<title>Sellr | Jobs</title>
	@include('admin.includes.head')

</head>
<body class="page-body  page-fade" data-url="http://neon.dev">

<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
	@include('admin.includes.sidemenu')
	<div class="main-content">
		@include('admin.includes.header')
		<hr />
		
		<div class="row">
			<div class="col-xs-12">
				<div class="col-xs-8">
					<ol class="breadcrumb bc-3">
						<li>
							<a href="{{url('admin/index')}}"><i class="fa-home"></i>Dashboard</a>
						</li>
						<li class="active">
							<a href="#">Jobs</a>
						</li>
					</ol>
				</div>
				<div class="col-xs-4">
					<div class="pull-right">
							<a href="{{url('admin/new_job')}}" class="btn btn-primary"><i class="entypo-user"> </i> Add new</a>
					</div>
				</div>
				<table class="table table-bordered datatable" id="table-1">
					<thead>
						<tr>
							<th>S/N</th>
							<th>Company</th>
							<th>Title</th>
							<th>Field</th>
							<th>State</th>
							<th>Education</th>
							<th>Type</th>
							<th>HTA</th>
							<th>Date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($jobs as $key=>$job)
						<tr class="odd gradeX">
							<td>{{$key + 1}}</td>
							<td>{{$job->company}}</td>
							<td>{{$job->title}}</td>
							<td>{{$job->field_name}}</td>
							<td>{{$job->state_name}}</td>
							<td>{{$job->education}}</td>
							@if($job->application_type == 1)
							<td>{{$job->email}}</td>
							@elseif($job->application_type == 2)
							<td>{{$job->website}}</td>
							@endif
							@if($job->status == 1)
							<td><span class="green">Active</span></td>
							@elseif($job->status == 2)
							<td><span class="brown">Inactive</span></td>
							@endif
							<td>{{$job->created_at}}</td>
							<td>
								<a href="{{url('admin/edit_job/'.$job->id)}}" class="btn btn-default btn-sm btn-icon icon-left">
									<i class="entypo-pencil"></i>
									Edit
								</a>
								@if($job->user_status == 1)
								<a href="{{url('admin/deactivate_job/'.$job->id)}}" class="btn btn-danger btn-sm btn-icon icon-left">
									<i class="entypo-cancel"></i>
									Deactivate
								</a>
								@elseif($job->user_status == 2)
								<a href="{{url('admin/activate_job/'.$job->id)}}" class="btn btn-success btn-sm btn-icon icon-left">
									<i class="entypo-cancel"></i>
									Activate
								</a>
								@endif
								
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		
		<br />
		
		<br />
		
	</div>




	<!-- Imported styles on this page -->
	<link rel="stylesheet" href="{{asset('public/staff/js/jvectormap/jquery-jvectormap-1.2.2.css')}}">
	<link rel="stylesheet" href="{{asset('public/staff/js/rickshaw/rickshaw.min.css')}}">
	<link rel="stylesheet" href="{{asset('public/staff/js/datatables/datatables.css')}}">
	<script src="{{asset('public/staff/js/datatables/datatables.js')}}"></script>
	@include('admin.includes.script')
	<script type="text/javascript">
		jQuery( document ).ready( function( $ ) {
			var $table1 = jQuery( '#table-1' );
			
			// Initialize DataTable
			$table1.DataTable( {
				"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
				"bStateSave": true
			});
			
			
		} );
	</script>
</body>
</html>