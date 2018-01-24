import ReactTable from 'react-table';
import 'react-table/react-table.css';
import matchSorter from 'match-sorter';
import UpdateProperty from './UpdateProperty';

class ContactProperties extends window.React.Component
{
	constructor(props)
	{
		super(props)
		this.state = {
			contactProperties: [],
			allProperties: [],
			showAllProperties: false,
		}
	}

	componentDidMount()
	{
		console.log('ContactProperties props', this.props);
		// this.setState({
		// 	contactProperties: this.props.properties
		// })

		this._getAllProperties();
	}

	_getAllProperties() {
		window.axios.get('/api/properties')
			.then(response => {
				this.setState({ allProperties: response.data })
			}).catch(error => {
				console.log(error);
			})
	}

	_attachingProperty() {
		this.setState({
			showAllProperties: true,
		})
	}

	_attachProperty(e, property_id) {
		e.preventDefault();

		console.log('Attach property_id', property_id);

		const { contact } = this.props;
		const endpoint = '/api/contacts/' + contact.id + '/properties';

		window.axios.post(endpoint, {
			property_id
		}).then(response => {
			console.log(response)
			this._getContactProperties(contact.id);
		}).catch(error => {
			console.log(error)
		});
	}

	_detachProperty(e, property) {
		e.preventDefault();

		const { contact } = this.props;
		let property_id = property.original.pivot.property_id;
		const endpoint = '/api/contacts/' + contact.id + '/properties';

		window.axios.delete(endpoint, {
			params: { property_id }
		}).then(response => {
			console.log(response)
			this._getContactProperties(contact.id);
		}).catch(error => {
			console.log(error)
		});
	}	

	_doneAttachingProperty() {
		this.setState({
			showAllProperties: false,
		})
	}

	_getContactProperties(contact) {		
		const endpoint = '/api/contacts/' + contact + '/properties';
		window.axios.get(endpoint)
			.then(response => {
				this.setState({
					contactProperties: response.data,
					showAllProperties: false,
				})
			}).catch(error => {
				console.log(error);
			})
	}

	render()
	{
		const headerTitle = 'Associated Properties to ' + this.props.contact.name;
		return(
			<div className="w-full p-4">
				{
					this.state.showAllProperties ?
					<ReactTable 
						data={this.state.allProperties}
						filterable
						defaultPageSize={5}
						columns={[
							{
								Header: 'Select properties to attach on the contact',
								columns: [
									{
										Header: 'Property Number',
										accessor: 'property_number',
										id: 'property_number',
										filterMethod: (filter, rows) => matchSorter(rows, filter.value, { keys: ['property_number'] }),
										filterAll: true,
									},
									{
										Header: 'Sub Community / Tower',
										accessor: 'name'
									},
									{
										Header: 'Community',
										accessor: 'community'
									},
									{
										Header: 'Property Type',
										accessor: 'property_type'
									},
									{
										Header: 'Bedrooms',
										accessor: 'bedrooms'
									},
									{
										Header: 'Unit Type',
										accessor: 'unit_type',							
									},
									{
										Header: '',
										accessor: 'id',
										Cell: ({value}) => (
											<form method="POST" onSubmit={(e) => this._attachProperty(e, value)}>
												<button type="submit" title="Attach property from this contact" className="no-underline px-2 text-green text-xs font-bold">Attach</button>
											</form>
										)
									}
								]
							}
						]}
					/> :					
					<ReactTable 
						data={this.props.properties}
						defaultPageSize={5}
						columns={[
							{
								Header: headerTitle,
								columns: [
									{
										Header: 'Property Number',
										accessor: 'property_number',
									},
									{
										Header: 'Sub Community / Tower',
										accessor: 'name'
									},
									{
										Header: 'Community',
										accessor: 'community'
									},
									{
										Header: 'Property Type',
										accessor: 'property_type'
									},
									{
										Header: 'Bedrooms',
										accessor: 'bedrooms'
									},
									{
										Header: 'Unit Type',
										accessor: 'unit_type',							
									},
									{
										Header: '',
										accessor: 'id',
										Cell: (value) => (
											<form method="POST" onSubmit={(e) => this._detachProperty(e, value)}>
												<button type="submit" title="Remove property from this contact" className="no-underline px-2 text-red text-xs font-bold">Unattach</button>
											</form>											
										)
									}
								]
							}
						]}
						SubComponent={row => {
							return (
								<div>
									<UpdateProperty property_id={row.original.pivot.property_id} contact_id={row.original.pivot.contact_id} refreshContactProperties={(contact) => this._getContactProperties(contact)} />
								</div>
							)
						}}
					/>
				}

				<div className="w-full flex justify-end my-4">
				{
					this.state.showAllProperties ?				
						<a onClick={() => this._doneAttachingProperty()} className="no-underline bg-gold hover:bg-black text-white px-4 py-2 rounded cursor-pointer">
							<i className="fa fa-check mr-2"></i>
							Done
						</a> :
						<a onClick={() => this._attachingProperty()} className="no-underline bg-gold hover:bg-black text-white px-4 py-2 rounded cursor-pointer">
							<i className="fa fa-paperclip mr-2"></i>
							Attach property
						</a>
				}
				</div>					
			</div>
		)
	}
}

export default ContactProperties;