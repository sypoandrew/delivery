@extends('admin::layouts.main')

@section('content')
    <div class="flex pb-2 mb-4">
        <h2 class="flex-1 m-0 p-0">
		<a href="{{ route('admin.modules') }}" class="btn mr-4">&#171; Back</a>
		<span class="flex-1">Bonded Warehouses</span>
		<a href="{{ route('admin.modules.warehouse.new') }}" class="btn btn-secondary">@include('admin::icons.add') New Bonded Warehouse</a>
		</h2>
    </div>
	
    @include('admin::partials.alerts')
	<div class="card p-0 block">
	<table>
	<tbody>
	<tr class="header"><th>Name</th><th>Address</th><th>Delivery Product SKU</th><th>Is TBC</th><th></th></tr>
	@foreach ($bondedwarehouseaddress as $bondedwarehouse)
	<tr><td>{{ $bondedwarehouse->name }}</td><td>{{ $bondedwarehouse->formatted_alt }}</td><td>{{ $bondedwarehouse->model }}</td><td>{{ $bondedwarehouse->is_tbc }}</td><td><a href="{{ route('admin.modules.warehouse.edit', ['id' => $bondedwarehouse->id]) }}" class="mr-2">@include('admin::icons.manage')</a></td></tr>
	@endforeach
	</tbody>
	</table>
	</div>
		
@endsection
