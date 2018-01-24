import swal from 'sweetalert';

class UpdateContact extends window.React.Component
{
	constructor(props)
	{
		super(props);
		this.state = {
			salutation: '',
			name: '',
			email: '',
			email2: '',
			phone: '',
			fax: '',
			mobile: '',		
			mobile2: '',		
			mobile3: '',		
			company: '',
			position: '',
			nationality: '',
			contact_status: '',
			contact_source: '',

			showEmail: true,
			showEmail2: false,
			showFloatingEmailSelection: false,

			showMobile: true,
			showMobile2: false,
			showMobile3: false,	
			showFloatingMobileSelection: false,

			updating: false,
			button_text: 'Update contact',
		}
	}

	componentDidMount()
	{
		let { contact } = this.props;

		this.setState({
			salutation: contact.salutation, 
			name: contact.name,
			email: contact.email,
			email2: contact.email2,
			mobile: contact.mobile,
			mobile2: contact.mobile2,
			mobile3: contact.mobile3,
			phone: contact.phone,
			fax: contact.fax,
			company: contact.company,
			position: contact.position,
			nationality: contact.nationality,
			contact_status: contact.contact_status,
			contact_source: contact.source,	
		})
	}

	updateProfile(e) {
		e.preventDefault();
		this.setState({
			updating: true,
			button_text: 'Updating contact'
		})

		const state = this.state;
		const contact_id = this.props.contact.id;

		window.axios.put('/admin/contacts/'+contact_id, {
			salutation: state.salutation, 
			name: state.name,
			email: state.email,
			email2: state.email2,
			mobile: state.mobile,
			mobile2: state.mobile2,
			mobile3: state.mobile3,
			phone: state.phone,
			fax: state.fax,
			company: state.company,
			position: state.position,
			nationality: state.nationality,
			contact_status: state.contact_status,
			source: state.contact_source
		}).then(response => {
			if (response.data.status === 1 ) {
				this.setState({
					updating: false,
					button_text: 'Update contact'
				})
				swal({
					title: 'Pcasa',
					text: 'Contact has been successfully updated.',
					icon: 'success'
				})
				this.props.refreshContacts();
			}
		}).catch(error => {
			console.log(error);
			this.setState({
				updating: false,
				button_text: 'Update contact'
			})				
		});	

	}

	render() {
		const state = this.state;

		return (
			<form method="POST" onSubmit={this.updateProfile.bind(this)}>
				<div className="flex p-4">
					<div className="w-full">
						<h4 className="text-grey-dark font-normal mb-4 uppercase">Personal Information</h4>
						<div className="flex mb-6">
							<div className="w-1/2 mr-2">
								<label className="text-grey-darker text-xs font-semibold uppercase tracking-wide block mb-2">Contact Category/Type</label>
								<div className="inline-block relative w-full">
									<select 
										className="w-full block appearance-none bg-white border hover:border-grey px-3 py-2 rounded shadow"
										value={state.contact_status}
										onChange={(e) => this.setState({ contact_status: e.target.value })}
									>
										<option value="Please select">-</option>
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
									<div className="pointer-events-none absolute pin-y pin-r flex items-center px-2 text-slate">
										<svg className="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
											<path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
										</svg>
									</div>
								</div>							
							</div>	
							<div className="w-1/2 ml-2">
								<label className="text-grey-darker text-xs font-semibold uppercase tracking-wide block mb-2">Contact Source</label>
								<div className="inline-block relative w-full">
									<select className="w-full block appearance-none bg-white border hover:border-grey px-3 py-2 rounded shadow"
										value={state.contact_source}
										onChange={(e) => this.setState({ contact_source: e.target.value })}
									>
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
									<div className="pointer-events-none absolute pin-y pin-r flex items-center px-2 text-slate">
										<svg className="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
											<path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
										</svg>
									</div>
								</div>
							</div>								
						</div>
						<div className="mb-2">
							<label className="text-grey-darker text-xs font-semibold uppercase tracking-wide block mb-2">Full Name</label>
						</div>
						<div className="flex mb-6">
							<div className="w-16 mr-2">
								<div className="inline-block relative w-full">
									<select 
										className="w-full block appearance-none bg-white border hover:border-grey px-3 py-2 rounded shadow"
										value={state.salutation}
										onChange={(e) => this.setState({ salutation: e.target.value })}
									>
										<option value=""></option>
										<option value="Mr.">Mr.</option>
										<option value="Ms.">Ms.</option>
									</select>
									<div className="pointer-events-none absolute pin-y pin-r flex items-center px-2 text-slate">
										<svg className="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
											<path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
										</svg>
									</div>
								</div>
							</div>
							<div className="w-full ml-2">
								<input value={state.name} onChange={(e) => this.setState({ name: e.target.value })} className="shadow border rounded w-full px-3 py-2" />
							</div>
						</div>						
						<div className="flex mb-6">			
							<div className="w-1/2 mr-2">
								<label className="text-grey-darker text-xs font-semibold uppercase tracking-wide block mb-2">Email</label>
								<div className="relative">
									{ this.state.showEmail ? <input value={state.email} onChange={(e) => this.setState({ email: e.target.value })} placeholder="Primary email" className="shadow border rounded w-full px-3 py-2" /> : '' }
									{ this.state.showEmail2 ? <input value={state.email2} onChange={(e) => this.setState({ email2: e.target.value })} placeholder="Secondary email" className="shadow border rounded w-full px-3 py-2" /> : '' }
								
									<a onClick={() => this.setState({ showFloatingEmailSelection: !this.state.showFloatingEmailSelection })} className="no-underline cursor-pointer absolute pin-t pin-r mr-3 mt-3">
										<i className="fa fa-ellipsis-h text-grey-dark"></i>
									</a>

									{
										this.state.showFloatingEmailSelection ?									
										<div className="absolute bg-white border shadow p-2 w-32 pin-t pin-r mr-8 floating-field-menu">
											<ul className="list-reset">
												<li className="p-1 border-b border-dashed"><a className="no-underline cursor-pointer block text-grey-darker" onClick={() => this.setState({ showEmail: true, showEmail2: false, showFloatingEmailSelection: false })}>Primary Email</a></li>
												<li className="p-1"><a className="no-underline cursor-pointer block text-grey-darker" onClick={() => this.setState({ showEmail2: true, showEmail: false, showFloatingEmailSelection: false })}>Secondary Email</a></li>
											</ul>
										</div> : <span></span>
									}									
								</div>
							</div>
							<div className="w-1/2 ml-2">
								<label className="text-grey-darker text-xs font-semibold uppercase tracking-wide block mb-2">Mobile</label>
								<div className="relative">
									{ this.state.showMobile ? <input value={state.mobile} onChange={(e) => this.setState({ mobile: e.target.value })} placeholder="Primary mobile" className="shadow border rounded w-full px-3 py-2" /> : '' }
									{ this.state.showMobile2 ? <input value={state.mobile2} onChange={(e) => this.setState({ mobile2: e.target.value })} placeholder="Mobile 2" className="shadow border rounded w-full px-3 py-2" /> : '' }
									{ this.state.showMobile3 ? <input value={state.mobile3} onChange={(e) => this.setState({ mobile3: e.target.value })} placeholder="Mobile 3" className="shadow border rounded w-full px-3 py-2" /> : '' }
									
									<a onClick={() => this.setState({ showFloatingMobileSelection: !this.state.showFloatingMobileSelection })} className="no-underline cursor-pointer absolute pin-t pin-r mr-3 mt-3">
										<i className="fa fa-ellipsis-h text-grey-dark"></i>
									</a>

									{
										this.state.showFloatingMobileSelection ?									
										<div className="absolute bg-white border shadow p-2 w-32 pin-t pin-r mr-8 floating-field-menu">
											<ul className="list-reset">
												<li className="p-1 border-b border-dashed"><a className="no-underline cursor-pointer block text-grey-darker" onClick={() => this.setState({ showMobile: true, showMobile2: false, showMobile3: false, showFloatingMobileSelection: false })}>Primary Mobile</a></li>
												<li className="p-1 border-b border-dashed"><a className="no-underline cursor-pointer block text-grey-darker" onClick={() => this.setState({ showMobile2: true, showMobile3: false, showMobile: false, showFloatingMobileSelection: false })}>Mobile 2</a></li>
												<li className="p-1"><a className="no-underline cursor-pointer block text-grey-darker" onClick={() => this.setState({ showMobile3: true, showMobile: false, showMobile2: false, showFloatingMobileSelection: false })}>Mobile 3</a></li>
											</ul>
										</div> : <span></span>
									}
								</div>
							</div>						
						</div>
						<div className="flex mb-6">			
							<div className="w-1/2 mr-2">
								<label className="text-grey-darker text-xs font-semibold uppercase tracking-wide block mb-2">Phone</label>
								<input value={state.phone} onChange={(e) => this.setState({ phone: e.target.value })} className="shadow border rounded w-full px-3 py-2" />
							</div>
							<div className="w-1/2 ml-2">
								<label className="text-grey-darker text-xs font-semibold uppercase tracking-wide block mb-2">Fax</label>
								<input value={state.fax} onChange={(e) => this.setState({ fax: e.target.value })} className="shadow border rounded w-full px-3 py-2" />
							</div>						
						</div>
						<div className="flex mb-6">			
							<div className="w-full">
								<label className="text-grey-darker text-xs font-semibold uppercase tracking-wide block mb-2">Nationality</label>
								<input value={state.nationality} onChange={(e) => this.setState({ nationality: e.target.value })} className="shadow border rounded w-full px-3 py-2" />
							</div>
						</div>																	
					</div>
				</div>

				<div className="flex p-4">
					<div className="w-full">
						<h4 className="text-grey-dark font-normal mb-4 uppercase">Additional Information</h4>
						<div className="flex mb-6">
							<div className="w-1/2 mr-2">
								<label className="text-grey-darker text-xs font-semibold uppercase tracking-wide block mb-2">Company Name</label>
								<input value={state.company} onChange={(e) => this.setState({ company: e.target.value })} className="shadow border rounded w-full px-3 py-2" />
							</div>
							<div className="w-1/2 ml-2">
								<label className="text-grey-darker text-xs font-semibold uppercase tracking-wide block mb-2">Position</label>
								<input value={state.position} onChange={(e) => this.setState({ position: e.target.value })} className="shadow border rounded w-full px-3 py-2" />
							</div>	
						</div>
					</div>
				</div>

				<div className="flex px-4 pt-4 pb-8">
					<div className="w-full flex justify-end">
						<button type="reset" className="text-grey-darker px-4 py-2 mr-2">Cancel</button>
						<button 
							className="bg-gold hover:bg-black text-white px-4 py-2 rounded"
							disabled={state.updating ? 'disabled' : ''}
						>
							{
								state.updating ?
								<i className="fa fa-spinner fa-spin mr-2"></i> : <i className="fa fa-floppy-o mr-2"></i>
							}							
							{state.button_text}
						</button>
					</div>
				</div>					
			</form>
		)
	}
}

export default UpdateContact;