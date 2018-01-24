@extends('layouts.admin')

@section('content')
	<div class="w-full bg-white rounded shadow">
		<div class="pb-6 px-6 py-6">
			<h1 class="text-grey-darker text-2xl font-semibold pb-4">Properties</h1>
			<div class="flex justify-between">
				<div>
					<button class="bg-white border border-solid border-grey-light shadow py-2 px-4 rounded text-grey-dark hover:text-black">
						<i class="fa fa-filter mr-1"></i> Filter
					</button>
				</div>
				<div class="flex">
					<a href="{{ route('admin.properties.create') }}" class="bg-white border border-solid border-grey-light shadow py-2 px-4 rounded text-grey-dark hover:text-black no-underline">
						<i class="fa fa-plus mr-1"></i> New
					</a>
				</div>
			</div>
			<p class="text-grey-dark leading-normal pt-6">
				Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat.
			</p>			
		</div>
		<div class="pb-6">
			<table class="w-full">
				<thead>
					<tr class="bg-grey-lighter">
						<th class="text-grey-darkest font-bold text-xs uppercase tracking-wide font-normal text-left py-3 px-4">Property Number</th>
						<th class="text-grey-darkest font-bold text-xs uppercase tracking-wide font-normal text-left py-3 px-4">Tower Name</th>
						<th class="text-grey-darkest font-bold text-xs uppercase tracking-wide font-normal text-left py-3 px-4">Developer</th>
						<th class="text-grey-darkest font-bold text-xs uppercase tracking-wide font-normal text-left py-3 px-4">Community</th>
						<th>&nbsp;</th>
					</tr>
				</thead>
				<tbody>
					@if ($properties->count() > 0 )
						@foreach ($properties as $property) 
							<tr class="border-b hover:text-grey-darkest">
								<td class="text-xs text-grey-darker hover:text-grey-darkest px-4 py-3">
									<a href="#" class="no-underline text-grey-darkest">
										{{$property->property_number}}
									</a>
								</td>
								<td class="text-xs text-grey-darker hover:text-grey-darkest px-4 py-3">{{ $property->name }}</td>
								<td class="text-xs text-grey-darker hover:text-grey-darkest px-4 py-3">{{ $property->developer }}</td>
								<td class="text-xs text-grey-darker hover:text-grey-darkest px-4 py-3">{{ $property->community }}</td>
								<td class="table-actions-container w-8">
									<ul class="list-reset flex table-actions pr-4">
										<li><a href="{{ route('admin.properties.edit', $property->id) }}" class="no-underline">
											<i class="fa fa-pencil"></i>
										</a></li>
									</ul>
								</td>
							</tr>
						@endforeach	
					@endif							
				</tbody>
			</table>
		</div>		
	</div>
@endsection

@section('footer_scripts')
	<script src="{{ mix('js/alert.js') }}"></script>
	@include('flash')
@endsection