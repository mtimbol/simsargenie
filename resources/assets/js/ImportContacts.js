import React from 'react';
import ReactDOM from 'react-dom';
import classNames from 'classnames';
import axios from 'axios';
import swal from 'sweetalert';
import Modal from 'react-modal';

Modal.setAppElement('#ImportContacts')

class ImportContacts extends React.Component
{
	constructor(props) {
		super(props);

		this.state = {
			buttonText: 'Import',
			importingContacts: false,
			contactsWasImported: false,
			modalContacts: [],
			
			showNewContacts: false,
			newContactsImportResponse: '',
			
			showSkippedContacts: false,
			skippedImportResponse: '',
		}
	}

	componentDidMount()
	{
		window.Echo.channel('skipped.contacts')
			.listen('LogSkippedContacts', e => {
				console.log('skipped.contacts', e);
				this.setState({ 
					showSkippedContacts: true, 
					skippedImportResponse: e.message,
					// modalContacts: e.contacts 
				})
			});

		window.Echo.channel('contacts.was.imported')
			.listen('ContactsWasImported', (e) => {
				console.log('contacts.was.imported', e);
				this.setState({
					buttonText: 'Import',
					importingContacts: false,
					showNewContacts: true,
					newContactsImportResponse: e.message,
					// modalContacts: e.contacts,
				})
			})			
	}

	onSubmit(e) {
		e.preventDefault();

		this.setState({
			importingContacts: true,
			buttonText: 'Importing'
		})

	    let data = new FormData();
	    data.append('csv', document.getElementById('csv').files[0]);

		axios({
			method: 'post',
			url: '/admin/contacts/import',
			data: data
		}).then(response => {
			console.log(response);
		}).catch(error => {
		})
	}

	render()
	{
		let submitButtonClasses = classNames(
			'bg-blue', 'hover:bg-blue-dark', 'text-white', 'px-4', 'py-2', 'rounded',
			{ 'opacity-50': this.state.importingContacts }
		);

		return (
			<div>
				<form onSubmit={this.onSubmit.bind(this)}>
					<div className="px-6 py-6">
						<h1 className="text-grey-darker text-2xl font-semibold pb-4">Import contacts</h1>
						<p className="text-grey-dark leading-normal">
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
							consequat.
						</p>

						<div className="flex py-4 mt-4">
							<div className="w-1/2 mr-8">
								<h4 className="text-grey-dark mb-2">Export sample format</h4>
								<p className="text-grey text-xs font-normal leading-normal mb-2">
									<a href="#" className="no-underline text-blue-dark">Download</a> sample CSV format and be sure to follow the format properly.
								</p>
								<p className="text-grey text-xs font-normal leading-normal mb-2">
									Existing contacts will be skipped for now.
								</p>
							</div>
							<div className="w-full">
								<div className="flex mb-6">
									<div className="w-full">
										<label className="text-grey text-xs font-semibold uppercase tracking-wide block mb-4">Browse CSV</label>
										<input type="file" name="csv" id="csv" className="shadow border rounded w-full px-3 py-2" onChange={e => this.setState({ csv: e.target.value })} />
									</div>
								</div>
							</div>
						</div>			
					</div>
					<div className="flex items-center justify-between bg-grey-lighter border-t px-6 py-3">
						<div>
							<p>{this.state.importResponse}</p>
						</div>
						<div className="flex">
							<button type="reset" className="text-grey-darker px-4 py-2 mr-2">Cancel</button>
							<button className={submitButtonClasses} disabled={this.state.importingContacts ? 'disabled' : '' }>
								{
									this.state.importingContacts ?
									<i className="fa fa-spinner fa-spin mr-2"></i> : ''
								}
								{ this.state.buttonText }
							</button>
						</div>
					</div>
				</form>
				<Modal
					isOpen={this.state.showNewContacts}
					onRequestClose={() => this.setState({ showNewContacts: false })}
					contentLabel="New Contacts"
				>
					<div className="flex justify-between mb-4">
						<h3>New Contacts</h3>
						<button className="border-none" onClick={() => this.setState({ showNewContacts: false })}>Close</button>
					</div>
					<p>
						{this.state.newContactsImportResponse}
					</p>
				</Modal>

				<Modal
					isOpen={this.state.showSkippedContacts}
					onRequestClose={() => this.setState({ showSkippedContacts: false })}
					contentLabel="Skipped Contacts"
				>
					<div className="flex justify-between mb-4">
						<h3>Skipped Contacts</h3>
						<button className="border-none" onClick={() => this.setState({ showSkippedContacts: false })}>Close</button>
					</div>
					<p>
						{this.state.skippedImportResponse}
					</p>
				</Modal>								
			</div>
		)
	}
}

ReactDOM.render(
	<ImportContacts />,
	document.getElementById('ImportContacts')
)