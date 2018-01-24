@extends('layouts.admin')

@section('content')
	<h1 class="text-grey-darker font-semibold py-4">Create new contact</h1>

	<div class="w-full bg-white rounded shadow">
		<div>
			<div class="px-6 py-6">
				<p class="text-grey-dark leading-normal">
				</p>

				<!--Personal information-->
				<div class="flex py-4 mt-4">
					<div class="w-1/2 mr-8">
						<h4 class="text-grey-dark mb-2">Contact Information</h4>
						<p class="text-grey text-xs font-normal leading-normal mb-2">
							TODO: If the email or phone is existing on the database, the fields will be automatically filled.
						</p>
						<p class="text-grey text-xs font-normal leading-normal">
							Fields with (*) needs to be filled up.
						</p>					
					</div>
					<div class="w-full">
						<div class="flex mb-6">
							<div class="w-1/2 mr-2">
								<label class="text-grey text-xs font-semibold uppercase tracking-wide block mb-2">Contact Category / Type</label>
								<div class="inline-block relative w-full">
									<select class="w-full block appearance-none bg-white border hover:border-grey px-3 py-2 rounded shadow">
										<option value=""></option>
										<option value="buyer-lead-residential">Buyer LEAD - Residential</option>
										<option value="buyer-lead-commercial">Buyer LEAD - Commercial</option>
										<option value="landlord-lead-residential">Landlord LEAD - Residential</option>
										<option value="landlord-lead-commercial">Ladlord LEAD - Commercial</option>
										<option value="tenant-lead-residential">Tenant LEAD - Residential</option>
										<option value="tenant-lead-commercial">Tenant LEAD - Commercial</option>
										<option value="no-answer">No Answer</option>
										<option value="wrong-number">Wrong Number / Out of Service</option>
										<option value="busy-line">Busy Line</option>
										<option value="switched-off">Switched OFF</option>
										<option value="callback-request">Call Back request</option>
										<option value="hangup-cancelled">Hang up / Cancelled</option>
										<option value="follow-up">Follow up</option>
										<option value="do-not-call-dnd">DO NOT CALL - DND</option>
										<option value="not-interested-now">Not Interested NOW</option>
										<option value="not-interested-at-all">Not Interested AT ALL</option>
									</select>
									<div class="pointer-events-none absolute pin-y pin-r flex items-center px-2 text-slate">
										<svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
											<path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
										</svg>
									</div>
								</div>							
							</div>	
							<div class="w-1/2 ml-2">
								<label class="text-grey text-xs font-semibold uppercase tracking-wide block mb-2">Contact Source</label>
								<div class="inline-block relative w-full">
									<select class="w-full block appearance-none bg-white border hover:border-grey px-3 py-2 rounded shadow">
										<option value=""></option>
										<option value="company-database">Company Database</option>
										<option value="direct-call">Direct Call</option>
										<option value="walk-in">Walk-in</option>
										<option value="referral">Referral</option>
										<option value="agent">Agent</option>
										<option value="website">Website</option>
										<option value="newspapers-magazine">Newspapers - Magazines</option>
										<option value="sms-campaign">SMS Campaign</option>
										<option value="email-campaign">Email Campaign</option>
										<option value="roadshow">Roadshow</option>
										<option value="sign-boards">Sign Boards</option>
										<option value="tv-radio">TV - Radio</option>
										<option value="facebook">Facebook</option>
										<option value="twitter">Twitter</option>
										<option value="instagram">Instagram</option>
										<option value="whatsapp">WhatsApp</option>
										<option value="cold-calling">Cold Calling</option>
										<option value="dubizzle">Dubizzle</option>
										<option value="propertyfinder">PropertyFinder</option>
										<option value="bayut">bayut</option>
										<option value="just-property">Just Property</option>
										<option value="other-sources">Other Sources</option>										
									</select>
									<div class="pointer-events-none absolute pin-y pin-r flex items-center px-2 text-slate">
										<svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
											<path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
										</svg>
									</div>
								</div>								
							</div>								
						</div>
						<div class="flex mb-6">			
							<div class="w-1/2 mr-2">
								<label class="text-grey text-xs font-semibold uppercase tracking-wide block mb-2">Email</label>
								<input class="shadow border rounded w-full px-3 py-2" />
							</div>
							<div class="w-1/2 ml-2">
								<label class="text-grey text-xs font-semibold uppercase tracking-wide block mb-2">Phone</label>
								<input class="shadow border rounded w-full px-3 py-2" />
							</div>						
						</div>
						<div class="mb-2">
							<label class="text-grey text-xs font-semibold uppercase tracking-wide block mb-2">Full Name</label>
						</div>
						<div class="flex mb-6">
							<div class="w-16 mr-2">
								<div class="inline-block relative w-full">
									<select class="w-full block appearance-none bg-white border hover:border-grey px-3 py-2 rounded shadow">
										<option value=""></option>
										<option value="">Mr.</option>
										<option value="">Ms.</option>
									</select>
									<div class="pointer-events-none absolute pin-y pin-r flex items-center px-2 text-slate">
										<svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
											<path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
										</svg>
									</div>
								</div>
								<label class="text-grey text-xs block mt-2">Salutation</label>
							</div>
							<div class="w-1/3 mr-2 ml-2">
								<input class="shadow border rounded w-full px-3 py-2" />
								<label class="text-grey text-xs block mt-2">First</label>
							</div>
							<div class="w-1/3 mr-2 ml-2">
								<input class="shadow border rounded w-full px-3 py-2" />
								<label class="text-grey text-xs block mt-2">Middle</label>
							</div>
							<div class="w-1/3 ml-2">
								<input class="shadow border rounded w-full px-3 py-2" />
								<label class="text-grey text-xs block mt-2">Last</label>
							</div>																		
						</div>					
					</div>
				</div>

				<!--Company information-->
				<div class="flex py-4">
					<div class="w-1/2 mr-8">
						<h4 class="text-grey-dark mb-2">Company Information</h4>
						<p class="text-grey text-xs font-normal leading-normal mb-2">
							Lorem ipsum dolor sit amet, consectetur adipisicing.
						</p>
						<p class="text-grey text-xs font-normal leading-normal">
							Fields with (*) needs to be filled up.
						</p>					
					</div>
					<div class="w-full">
						<div class="flex mb-6">
							<div class="w-1/2 mr-2">
								<label class="text-grey text-xs font-semibold uppercase tracking-wide block mb-2">Company</label>
								<input class="shadow border rounded w-full px-3 py-2" />
							</div>
							<div class="w-1/2 ml-2">
								<label class="text-grey text-xs font-semibold uppercase tracking-wide block mb-2">Position</label>
								<input class="shadow border rounded w-full px-3 py-2" />
							</div>						
						</div>
					</div>
				</div>

				<!--Property information-->
				<div class="flex py-4">
					<div class="w-1/2 mr-8">
						<h4 class="text-grey-dark mb-2">Property Information</h4>
						<p class="text-grey text-xs font-normal leading-normal">
							Search for propery enquired for.
						</p>
					</div>
					<div class="w-full">
						<div class="flex mb-6">
							<div class="w-full">
								<label class="text-grey text-xs font-semibold uppercase tracking-wide block mb-2">Property</label>
								<div class="relative">
									<i class="fa fa-search absolute text-grey-dark mt-2 ml-3"></i>
									<input class="shadow border rounded w-full px-3 py-2 pl-8" />
								</div>
							</div>
						</div>
					</div>
				</div>			
				<!--Document information-->
				<!--Assign to-->			
			</div>
			<div class="bg-grey-lighter border-t flex px-6 py-3">
				<div class="w-full flex justify-end">
					<button type="reset" class="text-grey-darker px-4 py-2 mr-2">Cancel</button>
					<button class="bg-blue hover:bg-blue-dark text-white px-4 py-2 rounded">Save</button>
				</div>
			</div>			
		</div>
	</div>
@endsection