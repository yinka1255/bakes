<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="Neon Admin Panel" />
	<meta name="author" content="" />

	<title>Sellr | Admin users</title>
	@include('staff.includes.head')

</head>
<body class="page-body  page-fade" data-url="http://neon.dev">

<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
	@include('staff.includes.sidemenu')
	<div class="main-content">
		@include('staff.includes.header')
		<hr />
		
		<div class="row">
			<div class="col-xs-12">
				<div class="col-xs-8">
					<ol class="breadcrumb bc-3">
						<li>
							<a href="{{url('admin/index')}}"><i class="fa-home"></i>Dashboard</a>
						</li>
						<li class="active">
							<a href="#">Admin users</a>
						</li>
					</ol>
				</div>
				<div class="col-xs-4">
					<div class="pull-right">
							<a href="{{url('admin/new_admin')}}" class="btn btn-primary"><i class="entypo-user"> </i> Add new</a>
					</div>
				</div>
				<table class="table table-bordered datatable" id="table-1">
					<thead>
						<tr>
							<th>S/N</th>
							<th></th>
							<th>Name</th>
							<th>Email</th>
							<th>Phone</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($admins as $key=>$admin)
						<tr class="odd gradeX">
							<td>{{$admin->key + 1}}</td>
							<td><img src="{{asset('public/admin/images/profile.png')}}" class="avatar" /></td>
							<td>{{$admin->name}}</td>
							<td>{{$admin->email}}</td>
							<td>{{$admin->phone}}</td>
							@if($admin->user_status == 1)
							<td><span class="green">Active</span></td>
							@elseif($admin->user_status == 2)
							<td><span class="brown">Deactivated</span></td>
							@endif
							<td>
								<a href="{{url('admin/edit_admin/'.$admin->id)}}" class="btn btn-default btn-sm btn-icon icon-left">
									<i class="entypo-pencil"></i>
									Edit
								</a>
								@if($admin->user_status == 1)
								<a href="{{url('admin/deactivate_admin/'.$admin->user_id)}}" class="btn btn-danger btn-sm btn-icon icon-left">
									<i class="entypo-cancel"></i>
									Deactivate
								</a>
								@elseif($admin->user_status == 2)
								<a href="{{url('admin/activate_admin/'.$admin->user_id)}}" class="btn btn-success btn-sm btn-icon icon-left">
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
	<link rel="stylesheet" href="{{asset('public/admin/js/jvectormap/jquery-jvectormap-1.2.2.css')}}">
	<link rel="stylesheet" href="{{asset('public/admin/js/rickshaw/rickshaw.min.css')}}">
	<link rel="stylesheet" href="{{asset('public/admin/js/datatables/datatables.css')}}">
	<script src="{{asset('public/admin/js/datatables/datatables.js')}}"></script>
	@include('staff.includes.script')
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