import React from 'react';
import axios from 'axios'

import ContactUpdate from './contact-update';
import ContactNotes from './contact-notes';
import UpdateContactStatus from './update-status';

import { Highlight } from 'react-instantsearch/dom';

import ArrowRight from '../arrow-right';
import ArrowDown from '../arrow-down';
import FilterIcon from '../svg/filter-icon';

class ContactHitRow extends React.Component
{
	constructor(props)
	{
		super(props);
		this.state = {
			show_details: false
		}
	}

	_updateContactStatus(id, status) {
		console.log('_updateContactStatus(id, status)', id, status);

		return axios.put('/api/contacts/' + id, {
			'contact_status': status
		}).then(response => {
			console.log('_updateContactStatus() response', response);
			if (response.data.status == 1) {
				let selected_contact = this.state.contacts.filter(contact => contact.id === id);
				let updated_contact = Object.assign({}, selected_contact);
				updated_contact[0]['contact_status'] = status;

				let state = Object.assign({}, this.state.contacts, {
					...this.state.contacts,
					updated_contact
				})

				this.setState({ state })
			}
		}).catch(error => {
			console.log('_updateContactStatus() error', error);
		})
	}	

	render()
	{
		const {hit} = this.props;

		const communities = Object.values(hit.properties).map((property, index) => {
			return (
				<span key={index}>{property.community}</span>
			)
		})	

		const property_names = Object.values(hit.properties).map((property, index) => {
			return (
				<span key={index}>{property.name}</span>
			)
		})		

		const property_numbers = Object.values(hit.properties).map((property, index) => {
			return (
				<span key={index}>{property.property_number}</span>
			)
		})

		// let latest_note = Object.values(hit.notes).map((note, index) => {
		// 	return (
		// 		<ContactNotes contact_id={row.original.id} notes={row.original.notes ? row.original.notes : []}/>
		// 		<span key={index}>{note.message}</span>
		// 	)
		// })

		return (
			<li key={hit.id} className="border-b py-2 relative">
				<div className="table-row grid">
					<div>
						<button className="arrow-button" onClick={() => this.setState({ show_details: ! this.state.show_details })}>
							{ !this.state.show_details ? <ArrowRight /> : <ArrowDown /> }
						</button>
					</div>
					<div className="truncate cursor-pointer" onClick={() => this.setState({ show_details: ! this.state.show_details })}>{communities}</div>
					<div className="truncate cursor-pointer" onClick={() => this.setState({ show_details: ! this.state.show_details })}>{property_names}</div>
					<div className="grid truncate cursor-pointer" onClick={() => this.setState({ show_details: ! this.state.show_details })}>{property_numbers}</div>
					<div className="truncate">
						<UpdateContactStatus 
							contact={hit} 
							updateContactStatus={(id, status) => this._updateContactStatus(id, status)} />
					</div>
					<div className="truncate">
						<Highlight attributeName="mobile" hit={hit} />
					</div>
					<div className="truncate">
						<Highlight attributeName="nationality" hit={hit} />
					</div>
					<div className="truncate">
						<ContactNotes contact_id={hit.id} notes={hit.notes} />
					</div>
				</div>
				{
					this.state.show_details ?				
					<div className="table-row-details">
						<ContactUpdate contact={hit} />
					</div> : ''
				}
			</li>
		)
	}
}

export default ContactHitRow;