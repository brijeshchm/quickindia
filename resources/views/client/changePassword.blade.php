@extends('client.layouts.app')
@section('title')
Quickindia- Local search, IT Training, Playschool, overseas education
@endsection 
@section('keyword')
Quickindia- Local search, IT Training, Playschool, overseas education
@endsection
@section('description')
Quickindia- Local search, IT Training, Playschool, overseas education
@endsection
@section('content')	
<div class="container">
	<h1>Change Password</h1>
	<?php if(count($errors)>0): ?>
		<div class="alert alert-danger">
			@foreach($errors->all() as $error)
			{{ $error }}.<br>
			@endforeach 
		</div>
	<?php endif; ?>
	@if(Session::has('success_msg'))
		<div class="alert alert-success">
			{{Session::get('success_msg')}}
			<a class="btn btn-success" href="{{url('business-owners')}}">View Your Profile</a>
		</div>
	@endif
	<div class="col-md-4 col-md-offset-4" style="border-top:2px solid #fff;padding-top:20px;margin-bottom:20px;">
		<form action="/business-owners/changepassword" method="POST">
		{{ csrf_field() }}
			<div class="form-group">
				<label for="old_pass">Old Password</label>
				<input type="password" name="old_pass" class="form-control" />
			</div>
			<div class="form-group">
				<label for="new_pass">New Password</label>
				<input type="password" name="password" class="form-control" />
			</div>
			<div class="form-group">
				<label for="confirm_pass">Confirm Password</label>
				<input type="password" name="password_confirmation" class="form-control" />
			</div>
			<div class="form-group text-right">
				<input type="submit" name="submit-new-pass" class="btn btn-warning" value="Change Password" />
			</div>
		</form>
	</div>
</div>
@endsection