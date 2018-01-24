import React from 'react';
import axios from 'axios';

class ContactNotes extends React.Component
{
	constructor(props)
	{
		super(props);

		this.state = {
			show_form: false,
			show_all: false,
			creating: false,
			message: '',
			notes: [],
			button_text: 'Create note',
		}
	}

	componentDidMount()
	{
		console.log(Object.keys(this.props.notes).length);
		// console.log('Notes props', this.props);
	}

	onSubmit(e) {
		e.preventDefault();

		this.setState({
			creating: true,
			button_text: 'Creating note'
		})

		axios.post('/api/contacts/'+this.props.contact_id+'/notes', {
			'message': this.state.message
		}).then(response => {
			console.log('Create note response', response);
			this.setState({
				show_form: false,
				creating: false,
				button_text: 'Create note'
			})
			this._getContactNotes(this.props.contact_id);
		}).catch(error => {
			console.log(error);
			this.setState({
				message: '',
				show_form: false,
				creating: false,
				button_text: 'Create note'
			})			
		})
	}

	_getContactNotes(contact) {
		axios.get('/api/contacts/'+contact+'/notes')
			.then(response => {
				console.log(response);
				this.setState({
					notes: response.data
				})
			}).catch(error => {
				console.log('_getContactNotes error', error);
			})
	}

	render()
	{		
		let state = this.state;
		let latest_note = '';
		let notes_history = '';

		if (this.props.notes.length > 0) {
			latest_note = this.props.notes[0].message;
			notes_history = this.props.notes.map(note => {
				return (
					<li key={note.id} className="text-sm text-grey-darkest my-2">
						<p className="flex flex-col">
							{note.message}
							<span className="text-xs text-grey-dark mt-1">{note.created_at}</span>
						</p>
					</li>
				)
			})
		}

		return (
			<div>
				{latest_note}
				<p className="text-center mt-2">
					<a className="no-underline cursor-pointer mr-2" onClick={() => this.setState({ 'show_form': !state.show_form, 'show_all': false })}>
						<i className="fa fa-plus-circle text-grey-dark"></i>
					</a>
					{
						this.props.notes.length > 0 ?					
						<a className="no-underline cursor-pointer ml-2" onClick={() => this.setState({ 'show_all': !state.show_all, 'show_form': false })}>
							<i className="fa fa-eye text-grey-dark"></i>
						</a> : ''
					}
				</p>
				{
					state.show_form ?				
					<div className="p-4 w-48 mt-2 border shadow bg-white absolute z-10">
						<p className="pb-3"><strong className="font-normal text-grey text-sm">Create note</strong></p>
						<form method="POST" className="relative" onSubmit={this.onSubmit.bind(this)}>
							<div className="w-full mb-2">
								<input value={state.message} onChange={(e) => this.setState({ message: e.target.value })} className="shadow border rounded w-full px-3 py-2" />
							</div>						
							<div className="w-full">
								<button 
									className="bg-gold hover:bg-black text-white px-2 py-1 rounded"
									disabled={state.creating ? 'disabled' : ''}
								>
									{
										state.creating ?
										<i className="fa fa-spinner fa-spin mr-2"></i> : ''
									}							
									{state.button_text}
								</button>
							</div>	
						</form>
						<div className="absolute pin-t pin-r mr-1">
							<a className="no-underline cursor-pointer text-dark text-xs" onClick={() => this.setState({ show_form: !state.show_form })}>
								<i className="fa fa-times-circle"></i>
							</a>
						</div>
					</div> : ''
				}

				{
					state.show_all ?				
					<div className="p-4 w-48 h-48 mt-2 border overflow-scroll shadow bg-white absolute z-10">
						<p className="pb-3"><strong className="font-normal text-grey text-sm">Notes History</strong></p>
						<ul className="list-reset">
							{notes_history}
						</ul>
						<div className="absolute pin-t pin-r mr-1">
							<a className="no-underline cursor-pointer text-dark text-xs" onClick={() => this.setState({ show_form: !state.show_form })}>
								<i className="fa fa-times-circle"></i>
							</a>
						</div>
					</div> : ''
				}				
			</div>
		)
	}
}

export default ContactNotes;