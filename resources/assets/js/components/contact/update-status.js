import React from 'react';
import { Highlight } from 'react-instantsearch/dom';

class UpdateContactStatus extends React.Component
{
	constructor(props)
	{
		super(props);

		this.state = {
			showModal: false,
			contact_status: '',
			updating: false,
			button_text: 'Update',
		}
	}

	componentDidMount()
	{
		const {contact} = this.props;
		this.setState({
			contact_status: contact.contact_status,
		})
	}

	onSubmit(e) {
		e.preventDefault();

		const {contact} = this.props;

		console.log('UpdateContactStatus onSubmit(e)');

		this.setState({
			updating: true,
			button_text: 'Updating'
		})

		this.props.updateContactStatus(contact.id, this.state.contact_status).then(() => {
			this.setState({
				updating: false,
				button_text: 'Update',
				showModal: false,
			})
		})
	}

	render()
	{
		let state = this.state;
		const {contact} = this.props;

		return (
			<div>
				<div className="flex items-center">
					<a className="no-underline cursor-pointer mr-2" onClick={() => this.setState({ showModal: !state.showModal})}>
						<i className="fa fa-filter text-grey-dark"></i>
					</a>
					<p><Highlight attributeName="name" hit={contact} /></p>
				</div>
				{
					state.showModal ?
					<div className="p-4 w-auto pin-t mt-8 -ml-8 border shadow-lg bg-white absolute z-10">
						<p className="pb-3"><strong className="font-normal text-grey-darker text-sm">Update {contact.name}</strong></p>
						<form method="POST" className="flex relative" onSubmit={this.onSubmit.bind(this)}>
							<div className="inline-block relative w-full mr-2">
								<select 
									className="w-full block appearance-none bg-white border hover:border-grey px-2 py-1 rounded shadow mr-2"
									value={state.contact_status || 'Please select'}
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
							<div>
								<button 
									className="px-2 py-1 rounded"
									disabled={state.updating ? 'disabled' : ''}
								>
									{
										state.updating ?
										<i className="fa fa-spinner fa-spin mr-2"></i> : ''
									}							
									{state.button_text}
								</button>
							</div>	
						</form>
						<div className="absolute pin-t pin-r mr-1">
							<a className="no-underline cursor-pointer text-dark text-lg" onClick={() => this.setState({ showModal: !state.showModal })}>
								<i className="fa fa-times-circle"></i>
							</a>
						</div>
					</div>
					: ''
				}
			</div>
		)
	}
}

export default UpdateContactStatus;