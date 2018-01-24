@extends('layouts.admin')

@section('header_styles')
	<link rel="stylesheet" href="https://unpkg.com/react-instantsearch-theme-algolia@4.0.0/style.min.css">
@endsection

@section('content')
	<div class="w-full bg-white rounded shadow">
		<div class="px-6 pt-6">
			<h1 class="text-grey-darker text-2xl font-semibold pb-4">Contacts <small>({{ $total_contacts }})</small></h1>
			<div class="flex justify-between">
				<div>
					<button class="bg-white border border-solid border-grey-light shadow py-2 px-4 rounded text-grey-dark hover:text-black">
						<i class="fa fa-filter mr-1"></i> Filter
					</button>
				</div>
				<div class="flex">
					<a href="{{ route('admin.contacts.create') }}" class="bg-white border border-solid border-grey-light shadow py-2 px-4 rounded text-grey-dark hover:text-black no-underline">
						<i class="fa fa-plus mr-1"></i> New
					</a>
					<a href="{{ route('admin.contacts.import.index') }}" class="bg-white border border-solid border-grey-light shadow py-2 px-4 rounded text-grey-dark hover:text-black no-underline ml-1">
						<i class="fa fa-upload mr-1"></i> Import
					</a>
				</div>
			</div>
			<p class="text-grey-dark leading-normal pt-6">

			</p>			
		</div>

		<div id="ContactLists"></div>

		<?php /*
		<div class="pb-6">
			<table class="w-full">
				<thead>
					<tr class="bg-grey-lighter">
						<th></th>
						<th class="text-grey-darkest font-bold text-xs uppercase tracking-wide font-normal text-left py-3 px-4">Community</th>
						<th class="text-grey-darkest font-bold text-xs uppercase tracking-wide font-normal text-left py-3 px-4">Subcommunity</th>	
						<th class="text-grey-darkest font-bold text-xs uppercase tracking-wide font-normal text-left py-3 px-4" width="100">Property #</th>											
						<th class="text-grey-darkest font-bold text-xs uppercase tracking-wide font-normal text-left py-3 px-4">Name</th>
						<th class="text-grey-darkest font-bold text-xs uppercase tracking-wide font-normal text-left py-3 px-4">Mobile</th>	
						<th class="text-grey-darkest font-bold text-xs uppercase tracking-wide font-normal text-left py-3 px-4">Nationality</th>											
						<th class="text-grey-darkest font-bold text-xs uppercase tracking-wide font-normal text-left py-3 px-4">Notes</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach ($contacts as $contact) 
						<tr class="border-b hover:text-grey-darkest">
							<td width="30">
								<ul class="table-actions list-reset">
									<li><button class="p-2"><i class="fa fa-plus-circle"></i></button></li>
								</ul>
							</td>
							<td class="text-xs text-grey-darker hover:text-grey-darkest px-4 py-3">
								{{ $contact->properties[0]->community }}
							</td>
							<td class="text-xs text-grey-darker hover:text-grey-darkest px-4 py-3">
								{{ $contact->properties[0]->name }} <!-- Subcommunity -->
							</td>
							<td class="text-xs text-grey-darker hover:text-grey-darkest px-4 py-3">
								{{ $contact->properties[0]->property_number }}
								@if ($contact->properties->count() > 1)
									<button title="Show all properties in a modal">+</button>
								@endif
							</td>
							<td class="text-xs text-grey-darker hover:text-grey-darkest px-4 py-3">{{ $contact->name }}</td>
							<td class="text-xs text-grey-darker hover:text-grey-darkest px-4 py-3">{{ $contact->mobile }}</td>
							<td class="text-xs text-grey-darker hover:text-grey-darkest px-4 py-3">{{ $contact->nationality }}</td>
							<td class="text-xs text-grey-darker hover:text-grey-darkest px-4 py-3">notes</td>
							<td width="30">
								<ul class="table-actions list-reset">
									<li><button class="p-2"><i class="fa fa-plus-circle"></i></button></li>
								</ul>
							</td>							
						</tr>
					@endforeach	
				</tbody>
			</table>
		</div>
		*/ ?>
	</div>
@endsection

@section('footer_scripts')
	<script src="{{ mix('js/alert.js') }}"></script>
	<script src="{{ mix('js/contact-lists.js') }}"></script>
	@include('flash')
@endsection