import React from 'react';
import ReactDOM from 'react-dom';
import classNames from 'classnames';
import axios from 'axios';
import swal from 'sweetalert';

class ImportContacts extends React.Component
{
	constructor(props) {
		super(props);

		this.state = {
			csv: '',
			formWasSubmitted: false,
			buttonText: 'Import'
		}
	}

	onSubmit(e) {
		e.preventDefault();

		this.setState({
			formWasSubmitted: true,
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
			if (response.status === 200) {
				swal({
					title: 'Pcasa',
					text: 'Importing contacts has been successfully finished.',
					icon: 'success'
				})
				this.setState({
					formWasSubmitted: false,
					buttonText: 'Import'
				})				
			}
		}).catch(error => {
			// No file uploaded
			if (error.response.status === 422) {				
				swal({
					title: 'Oops.',
					text: error.response.data.csv,
					icon: 'error'
				})
			} else {
				swal({
					title: 'Oops.',
					text: 'Something went wrong. ' + error.message,
					icon: 'error'
				})				
			}

			this.setState({
				formWasSubmitted: false,
				buttonText: 'Import'
			})				
		})
	}

	render()
	{
		let submitButtonClasses = classNames(
			'bg-blue', 'hover:bg-blue-dark', 'text-white', 'px-4', 'py-2', 'rounded',
			{ 'opacity-50': this.state.formWasSubmitted }
		);

		return (
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
				<div className="flex bg-grey-lighter border-t px-6 py-3">
					<div className="w-full flex justify-end">
						<button type="reset" className="text-grey-darker px-4 py-2 mr-2">Cancel</button>
						<button className={submitButtonClasses} disabled={this.state.formWasSubmitted ? 'disabled' : '' }>
							{
								this.state.formWasSubmitted ?
								<i className="fa fa-spinner fa-spin mr-2"></i> : ''
							}
							{ this.state.buttonText }
						</button>
					</div>
				</div>
			</form>
		)
	}
}

ReactDOM.render(
	<ImportContacts />,
	document.getElementById('ImportContacts')
)