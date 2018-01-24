import React from 'react';

class UpdateContactCategory extends React.Component
{
	constructor(props)
	{
		super(props);
		this.state = {
			showForm: false
		}
	}

	render()
	{
		return(
			<div className="relative">
				<div>
					<a href="#" className="no-underline cursor-pointer hidden"><i className="fa fa-database text-xs text-grey-dark mr-2"></i></a>
					<span>{Object.keys(this.props.contact.properties).length > 0 ? this.props.contact.properties[0].community : ''}</span>
				</div>
				{
					this.state.showForm ?				
					<div className="absolute bg-white shadow w-64 h-64 p-2 pin-t pin-r">
						<form method="POST">
							<p>Selection</p>
						</form>
					</div> : <span></span>
				}
			</div>
		)
	}
}

export default UpdateContactCategory;