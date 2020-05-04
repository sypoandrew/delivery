@extends('admin::layouts.main')

@section('content')
    <div class="flex pb-2 mb-4">
        <h2 class="flex-1 m-0 p-0">
		<a href="{{ route('admin.modules.warehouse') }}" class="btn mr-4">&#171; Back</a>
		<span class="flex-1">Bonded Warehouse</span>
		</h2>
    </div>
	
    @include('admin::partials.alerts')
	<form action="{{ route('admin.modules.warehouse.update') }}" method="post" class="flex flex-wrap">
		@csrf
		<input type="hidden" name="id" value="{{ $bondedwarehouseaddress->id }}">
		<div class="card mt-4 w-full">
			<div><label for="name" class="block">Name</label> <input type="text" id="name" name="name" autocomplete="off" required="required" class="w-full" value="{{ $bondedwarehouseaddress->name }}"></div>
			<div class="mt-4 flex-1 flex flex-col"><label for="first" class="block">First</label> <input type="text" id="first" name="first" autocomplete="off" class="w-full" value="{{ $bondedwarehouseaddress->first }}"></div>
			<div class="mt-4 flex-1 flex flex-col"><label for="last" class="block">Last</label> <input type="text" id="last" name="last" autocomplete="off" class="w-full" value="{{ $bondedwarehouseaddress->last }}"></div>
			<div class="mt-4 flex-1 flex flex-col"><label for="line1" class="block">Line 1</label> <input type="text" id="line1" name="line1" autocomplete="off" class="w-full" value="{{ $bondedwarehouseaddress->line1 }}"></div>
			<div class="mt-4 flex-1 flex flex-col"><label for="line2" class="block">Line 2</label> <input type="text" id="line2" name="line2" autocomplete="off" class="w-full" value="{{ $bondedwarehouseaddress->line2 }}"></div>
			<div class="mt-4 flex-1 flex flex-col"><label for="city" class="block">City</label> <input type="text" id="city" name="city" autocomplete="off" class="w-full" value="{{ $bondedwarehouseaddress->city }}"></div>
			<div class="mt-4 flex-1 flex flex-col"><label for="county" class="block">County</label> <input type="text" id="county" name="county" autocomplete="off" class="w-full" value="{{ $bondedwarehouseaddress->county }}"></div>
			<div class="mt-4 flex-1 flex flex-col"><label for="postcode" class="block">Postcode</label> <input type="text" id="postcode" name="postcode" autocomplete="off" class="w-full" value="{{ $bondedwarehouseaddress->postcode }}"></div>
			<div class="mt-4 flex-1 flex flex-col"><label for="country_code" class="block">Country code</label> <input type="text" id="country_code" name="country_code" autocomplete="off" class="w-full" value="{{ $bondedwarehouseaddress->country_code }}"></div>
			<div class="mt-4 flex-1 flex flex-col"><label for="model" class="block">Delivery product SKU</label> <input type="text" id="model" name="model" autocomplete="off" class="w-full" value="{{ $bondedwarehouseaddress->model }}"></div>
			<div class="mt-4 flex-1 flex flex-col"><label for="is_tbc" class="block"><label class="checkbox">
			@if ($bondedwarehouseaddress->is_tbc)
			<input type="checkbox" id="is_tbc" name="is_tbc" autocomplete="off" value="1" class="w-full" checked>
			@else
			<input type="checkbox" id="is_tbc" name="is_tbc" autocomplete="off" value="1" class="w-full">
			@endif
			<span></span></label> Is TBC?</label></div>
		</div>
		
		<div class="card mt-4 p-4 w-full flex flex-wrap"><button type="submit" class="btn btn-secondary">Save</button> </div>
	</form>
		
@endsection
