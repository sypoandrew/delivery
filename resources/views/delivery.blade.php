@extends('admin::layouts.main')

@section('content')
    <div class="flex pb-2 mb-4">
        <h2 class="flex-1 m-0 p-0">VinQuinn custom delivery settings</h2>
    </div>
	@if (session('status'))
		<div class="alert alert-success">
			{{ session('status') }}
		</div>
	@endif
	
    @include('admin::partials.alerts')
	<form action="{{ route('admin.modules.delivery') }}" method="post" class="flex flex-wrap">
		@csrf
		<div class="card mt-4 w-full">
			<h3>Custom delivery settings</h3>
			<div class="mt-4 w-full">
			<label for="enabled" class="block">
			<label class="checkbox">
			@if(setting('Delivery.enabled'))
			<input type="checkbox" id="enabled" name="enabled" checked="checked" value="1">
			@else
			<input type="checkbox" id="enabled" name="enabled" value="1">
			@endif
			<span></span>
			</label>Enabled
			</label>
			</div>
			<div class="mt-4 w-full">
			<label for="problem_postcodes" class="block">Problem Postcodes</label>
			<input type="text" id="problem_postcodes" name="problem_postcodes" autocomplete="off" required="required" class="w-full " value="{{ old('problem_postcodes', setting('Delivery.problem_postcodes')) }}">
			</div>
		</div>
		
		<div class="card mt-4 p-4 w-full flex flex-wrap"><button type="submit" class="btn btn-secondary">Save</button> </div>
	</form>
		
@endsection
