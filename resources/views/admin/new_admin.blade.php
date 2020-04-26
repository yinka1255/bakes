<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="Neon Admin Panel" />
	<meta name="author" content="" />

	<title>Sellr | New Admin user</title>
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
				<div class="row">
					<div class="col-xs-8">
						<ol class="breadcrumb bc-3">
							<li>
								<a href="{{url('admin/index')}}"><i class="fa-home"></i>Dashboard</a>
							</li>
							<li>
								<a href="{{url('admin/admins')}}">Admin users</a>
							</li>
							<li class="active">
								<a href="#">New Admin user</a>
							</li>
						</ol>
					</div>
					<div class="col-xs-4">
						<div class="pull-right">
								<a href="{{url('admin/new_admin')}}" class="btn btn-primary"><i class="entypo-user"> </i> Add new</a>
						</div>
					</div>
				</div>
				<br/><br/>
				<form role="form" method="post" action="{{url('admin/save_admin')}}" class="form-horizontal form-groups-bordered">
					{{ csrf_field() }}
					<div class="form-group">
						<label for="field-2" class="col-sm-2 control-label">Name</label>
						<div class="col-sm-5">
							<input type="text" name="name" class="form-control" placeholder="Name">
						</div>
					</div>
					<div class="form-group">
						<label for="field-2" class="col-sm-2 control-label">Email</label>
						<div class="col-sm-5">
							<input type="email" name="email" class="form-control" placeholder="Email">
						</div>
					</div>
					<div class="form-group">
						<label for="field-2" class="col-sm-2 control-label">Phone</label>
						<div class="col-sm-5">
							<input type="text" name="phone" class="form-control" placeholder="Phone">
						</div>
					</div>
					<div class="form-group">
						<label for="field-2" class="col-sm-2 control-label">Password</label>
						<div class="col-sm-5">
							<input type="text" name="password" class="form-control" value="password" placeholder="Password" disabled>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-5">
							<button type="submit" class="btn btn-default">Create new user</button>
						</div>
					</div>
				</form>
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
	
</body>
</html>