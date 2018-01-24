@extends('layouts.admin')

@section('content')
	<div class="w-full bg-white rounded shadow">
		<div class="px-6 pt-6">
			<h1 class="text-grey-darker text-2xl font-semibold pb-4">Leads by: {{ $leadsBy }}</h1>
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
	</div>
@endsection

@section('footer_scripts')
	<script src="{{ mix('js/alert.js') }}"></script>
	<script src="{{ mix('js/contact-lists.js') }}"></script>
	@include('flash')
@endsection