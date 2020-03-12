@extends('admin::layouts.main')

@section('content')
    <div class="flex pb-2 mb-4">
        <h2 class="flex-1 m-0 p-0">VinQuinn custom delivery settings</h2>
    </div>
    @include('admin::partials.alerts')
	<form action="{{ route('admin.modules.delivery') }}" method="post" class="flex flex-wrap">
		<div class="card mt-4 w-full">
			<h3>Custom delivery settings</h3>
			<div class="mt-4 w-full">
			<label for="enabled" class="block">Enabled</label>
			<input type="text" id="enabled" name="enabled" autocomplete="off" required="required" class="w-full " value="{{ setting('Delivery.enabled') }}">
			</div>
			<div class="mt-4 w-full">
			<label for="fortified_wine_rate" class="block">Problem Postcodes</label>
			<input type="text" id="fortified_wine_rate" name="fortified_wine_rate" autocomplete="off" required="required" class="w-full " value="">
			</div>
		</div>
		
		<div class="card mt-4 p-4 w-full flex flex-wrap"><button type="submit" class="btn btn-secondary">Save</button> </div>
	</form>
		
@endsection
