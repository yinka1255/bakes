<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="Neon Admin Panel" />
	<meta name="author" content="" />

	<title>Sellr | New Job</title>
	@include('admin.includes.head')

</head>
<body class="page-body  page-fade" data-url="http://neon.dev">
<script src="{{asset('public/staff/js/ckeditor/ckeditor.js')}}"></script>
<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
	@include('admin.includes.sidemenu')
	<div class="main-content">
		@include('admin.includes.header')
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
								<a href="{{url('admin/jobs')}}">Jobs</a>
							</li>
							<li class="active">
								<a href="#">New Job</a>
							</li>
						</ol>
					</div>
					<div class="col-xs-4">
						<div class="pull-right">
								<a href="{{url('admin/new_job')}}" class="btn btn-primary"><i class="entypo-briefcase"> </i> Add new</a>
						</div>
					</div>
				</div>
				<br/><br/>
				<form role="form" method="post" action="{{url('admin/save_job')}}" class="form-horizontal form-groups-bordered">
					{{ csrf_field() }}
					<div class="form-group">
						<label for="field-2" class="col-sm-2 control-label">Title</label>
						<div class="col-sm-7">
							<input type="text" name="title" class="form-control" placeholder="Title">
						</div>
					</div>
					<div class="form-group">
						<label for="field-2" class="col-sm-2 control-label">Field</label>
						<div class="col-sm-7">
							<select name="field_id" class="form-control" >
								@foreach($fields as $field)
								<option value="{{$field->id}}">{{$field->name}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="field-2" class="col-sm-2 control-label">Company</label>
						<div class="col-sm-7">
							<input type="text" name="company" class="form-control" placeholder="Company">
						</div>
					</div>
					<div class="form-group">
						<label for="field-2" class="col-sm-2 control-label">Type</label>
						<div class="col-sm-7">
							<select name="type" class="form-control" >
								<option>Fulltime</option>
								<option>Part-time</option>
								<option>Contract</option>
								<option>Intership</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="field-2" class="col-sm-2 control-label">Education</label>
						<div class="col-sm-7">
							<input type="text" name="education" class="form-control" placeholder="Education">
						</div>
					</div>
					<div class="form-group">
						<label for="field-2" class="col-sm-2 control-label">Experience</label>
						<div class="col-sm-7">
							<input type="text" name="experience" class="form-control" placeholder="Experience">
						</div>
					</div>
					<div class="form-group">
						<label for="field-2" class="col-sm-2 control-label">State</label>
						<div class="col-sm-7">
							<select name="state_id" class="form-control" >
								@foreach($states as $state)
								<option value="{{$state->id}}">{{$state->name}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="field-2" class="col-sm-2 control-label">Site</label>
						<div class="col-sm-7">
							<select name="site" class="form-control" >
								<option value="1">My job mag</option>
								<option value="2">NG Careers</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="field-2" class="col-sm-2 control-label">How to apply</label>
						<div class="col-sm-7">
							<select name="application_type" class="form-control" >
								<option value="1">Email</option>
								<option value="2">Companies website</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="field-2" class="col-sm-2 control-label">Email</label>
						<div class="col-sm-7">
							<input type="email" name="email" class="form-control" placeholder="Email">
						</div>
					</div>
					<div class="form-group">
						<label for="field-2" class="col-sm-2 control-label">Website</label>
						<div class="col-sm-7">
							<input type="text" name="website" class="form-control" placeholder="https://abc.com">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2"  for="description">Description</label>
						<div class="col-sm-7">
							<textarea class="ckeditor" name="description" id="description"  cols="80" id="editor4" rows="10" tabindex="1"></textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-7">
							<button type="submit" class="btn btn-default">Add job</button>
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
	@include('admin.includes.script')
	
</body>
</html>