@extends('layouts.admin')

@section('content')

	<div class="w-full bg-white rounded shadow">
		<form method="POST" action="{{ route('admin.properties.store') }}">
			{{ csrf_field() }}
			<div class="px-6 py-6">
				<h1 class="text-grey-darker font-semibold pb-4">Create new Property</h1>
				<p class="text-grey-dark leading-normal">
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat.
				</p>

				<!--Personal information-->
				<div class="flex py-4 mt-4">
					<div class="w-1/2 mr-8">
						<h4 class="text-grey-dark mb-2">Property Information</h4>
						<p class="text-grey text-xs font-normal leading-normal mb-2">
							Lorem ipsum dolor sit amet, consectetur adipisicing elit.
						</p>
						<p class="text-grey text-xs font-normal leading-normal">
							Fields with (*) are required.
						</p>					
					</div>
					<div class="w-full">
						<div class="flex mb-6">			
							<div class="w-1/2 mr-2">
								<label class="text-grey text-xs font-semibold uppercase tracking-wide block mb-2 {{ $errors->has('name') ? 'text-red' : '' }}">Tower name <span class="required">*</span></label>
								<input name="name" class="shadow border rounded w-full px-3 py-2 {{ $errors->has('name') ? 'border-red' : '' }}" value="{{ old('name') }}" />
							</div>
							<div class="w-1/2 ml-2">
								<label class="text-grey text-xs font-semibold uppercase tracking-wide block mb-2 {{ $errors->has('property_number') ? 'text-red' : '' }}">Property number <span class="required">*</span></label>
								<input name="property_number" class="shadow border rounded w-full px-3 py-2 {{ $errors->has('property_number') ? 'border-red' : '' }}" value="{{ old('property_number') }}" />
							</div>						
						</div>
						<div class="flex mb-6">			
							<div class="w-1/2 mr-2">
								<label class="text-grey text-xs font-semibold uppercase tracking-wide block mb-2">Developer</label>
								<input name="developer" value="{{ old('developer') }}" class="shadow border rounded w-full px-3 py-2" />
							</div>
							<div class="w-1/2 ml-2">
								<label class="text-grey text-xs font-semibold uppercase tracking-wide block mb-2">Community</label>
								<input name="community" value="{{ old('community') }}" class="shadow border rounded w-full px-3 py-2" />
							</div>						
						</div>						
						<div class="mb-2">
							<label class="text-grey text-xs font-semibold uppercase tracking-wide block mb-2">About the property</label>
						</div>
						<div class="flex mb-6">
							<div class="w-1/4 mr-2">
								<input name="property_type" value="{{ old('property_type') }}" class="shadow border rounded w-full px-3 py-2" />
								<label class="text-grey text-xs block mt-2">Property Type</label>
							</div>
							<div class="w-1/4 mr-2 ml-2">
								<input name="unit_type" value="{{ old('unit_type') }}" class="shadow border rounded w-full px-3 py-2" />
								<label class="text-grey text-xs block mt-2">Unity Type</label>
							</div>
							<div class="w-1/4 mr-2 ml-2">
								<input name="bedrooms" value="{{ old('bedrooms') }}" class="shadow border rounded w-full px-3 py-2" />
								<label class="text-grey text-xs block mt-2">Bedrooms</label>
							</div>
							<div class="w-1/4 ml-2">
								<input name="size" value="{{ old('size') }}" class="shadow border rounded w-full px-3 py-2" />
								<label class="text-grey text-xs block mt-2">Size</label>
							</div>																		
						</div>
						<div class="flex mb-6">
							<div class="w-full">
								<label class="text-grey text-xs font-semibold uppercase tracking-wide block mb-2">View</label>
								<input name="view" value="{{ old('view') }}" class="shadow border rounded w-full px-3 py-2" />
							</div>
						</div>											
					</div>
				</div>		
			</div>
			<div class="bg-grey-lighter border-t flex px-6 py-3">
				<div class="w-full flex justify-end">
					<button type="reset" class="text-grey-darker px-4 py-2 mr-2">Cancel</button>
					<button class="bg-blue hover:bg-blue-dark text-white px-4 py-2 rounded">Save</button>
				</div>
			</div>
		</form>
	</div>
@endsection