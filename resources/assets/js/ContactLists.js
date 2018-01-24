import ReactTable from 'react-table';
import 'react-table/react-table.css';
import update from 'immutability-helper';

import matchSorter from 'match-sorter';
import UpdateContact from './Contact/Update';
import ContactProperties from './Contact/Properties';
import UpdateContactCategory from './Contact/UpdateContactCategory';
import UpdateContactStatus from './Contact/UpdateContactStatus';
import ContactNotes from './Contact/Notes';

class ContactLists extends window.React.Component
{
	constructor(props)
	{
		super(props);

		this.state = {
			contacts: [],
			updating_status: false,
		}
	}

	componentDidMount()
	{
		this.setState({
			contacts: window.contacts
		})
	}

	getAllContacts() {
		window.axios.get('/api/contacts')
			.then(response => {
				this.setState({ contacts: response.data })
			})
			.catch(error => {
				console.log(error);
			})
	}

	_updateContactStatus(id, status) {
		console.log('_updateContactStatus(id, status)', id, status);

		return window.axios.put('/api/contacts/' + id, {
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
		const { contacts } = this.state
		return(
			<div>
				<ReactTable
					defaultPageSize={25}
					data={contacts}
					filterable
					columns={[
						{
							Header: 'Property Information',
							columns: [
								{
									Header: 'Community',
									id: 'community',
									// accessor: contact => Object.keys(contact.properties).length > 0 ? contact.properties[0].community : '',
									Cell: (contact) => (
										<UpdateContactCategory contact={contact.original} />
									),								
									filterMethod: (filter, rows) => matchSorter(rows, filter.value, { keys: ['community'] }),
									filterAll: true,
								},
								{
									Header: 'Sub Community / Tower',
									id: 'subcommunity',
									accessor: contact => Object.keys(contact.properties).length > 0 ? contact.properties[0].name : '',
									filterMethod: (filter, rows) => matchSorter(rows, filter.value, { keys: ['subcommunity'] }),
									filterAll: true,
								},
								{
									Header: 'Property Number',
									id: 'property_number',
									accessor: contact => Object.keys(contact.properties).length > 0 ? contact.properties[0].property_number : '',
									filterMethod: (filter, rows) => matchSorter(rows, filter.value, { keys: ['property_number'] }),
									filterAll: true
								}
							]
						},
						{
							Header: 'Contact Information',
							columns: [
								{
									Header: 'Name',
									accessor: 'name',
									filterMethod: (filter, rows) => matchSorter(rows, filter.value, { keys: ['name'] }),
									filterAll: true,
									Cell: contact => {
										return (
											<UpdateContactStatus contact={contact.original} updateContactStatus={(id, status) => this._updateContactStatus(id, status)} updating_status={this.state.updating_status}/>
										)
									}
								},
								{
									Header: 'Mobile',
									accessor: 'mobile',
									// filterMethod: (filter, row) => 
									// 	row[filter.id].startsWith(filter.value) ||
									// 	row[filter.id].endsWith(filter.value),
									filterMethod: (filter, rows) => matchSorter(rows, filter.value, { keys: ['mobile'] }),
									filterAll: true,
								},
								{
									Header: 'Nationality',
									accessor: 'nationality',
									filterMethod: (filter, rows) => matchSorter(rows, filter.value, { keys: ['nationality'] }),
									filterAll: true,
								}
							]
						},
						{
							Header: 'Notes',
							columns: [
								{
									Header: 'Notes',
									accessor: 'notes',
									Cell: row => {
										return (
											<ContactNotes contact_id={row.original.id} notes={row.original.notes ? row.original.notes : []}/>
										)
									}
								}
							]
						}
					]}
		        	className="-striped -highlight"					
					SubComponent={row => {
						console.log('SubComponent', row);
						let contact = row.original;
						let properties = contact.properties;
						return (
							<div>
								<UpdateContact contact={contact} refreshContacts={() => this.getAllContacts()} />								
								<ContactProperties contact={contact} properties={properties} />
							</div>
						)
					}}
				/>
			</div>
		)
	}
}

window.ReactDOM.render(
	<ContactLists />,
	document.getElementById('ContactLists')
)