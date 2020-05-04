@extends('admin::layouts.main')

@section('content')
    <div class="flex pb-2 mb-4">
        <h2 class="flex-1 m-0 p-0">
		<a href="{{ route('admin.modules') }}" class="btn mr-4">&#171; Back</a>
		<span class="flex-1">Bonded Warehouses</span>
		<a href="{{ route('admin.modules.warehouse.new') }}" class="btn btn-secondary"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" class="h-4 max-h-full fill-current mr-2"><path d=" M 59 33 C 59 35 56 37 54 37 L 36 37 L 36 54 C 36 56 34 59 32 59 C 29 59 27 56 27 54 L 27 37 L 10 37 C 8 37 6 35 6 33 C 6 30 8 28 10 28 L 27 28 L 27 10 C 27 8 29 6 32 6 C 34 6 36 8 36 10 L 36 28 L 54 28 C 56 28 59 30 59 33 Z "></path></svg>
 New Bonded Warehouse
            </a>
		</h2>
    </div>
	
    @include('admin::partials.alerts')
	<div class="card p-0 block">
	<table>
	<tbody>
	<tr class="header"><th>Name</th><th>Address</th><th>Delivery Product SKU</th><th>Is TBC</th><th></th></tr>
	@foreach ($bondedwarehouseaddress as $bondedwarehouse)
	<tr><td>{{ $bondedwarehouse->name }}</td><td>{{ $bondedwarehouse->formatted_alt }}</td><td>{{ $bondedwarehouse->model }}</td><td>{{ $bondedwarehouse->is_tbc }}</td><td><a href="{{ route('admin.modules.warehouse.edit', ['id' => $bondedwarehouse->id]) }}" class="mr-2"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 240.82 240.82" class="h-3 w-5 max-h-full fill-current mx-1"><path d="M183.19 111.82L74.89 3.56a12.2 12.2 0 00-17.21 0 12.13 12.13 0 000 17.17l99.7 99.68-99.7 99.67a12.15 12.15 0 000 17.19 12.2 12.2 0 0017.22 0L183.2 129a12.27 12.27 0 00-.01-17.2z"></path></svg></a></td></tr>
	@endforeach
	</tbody>
	</table>
	</div>
		
@endsection
