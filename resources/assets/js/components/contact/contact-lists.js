import React from 'react';
import ReactDOM from 'react-dom';
import { InstantSearch, SearchBox, Hits, Pagination } from 'react-instantsearch/dom';
import ContactHitRow from './contact-hit';

const ContactHit = ({hit}) => {
	return <ContactHitRow hit={hit} />
}

class ContactLists extends React.Component
{
	render()
	{
		return(
			<InstantSearch
				appId={window.algolia_app_id}
				apiKey={window.algolia_app_key}
				indexName={window.algolia_contacts_index}
			>
				<div>
					<ul className="table-header grid">
						<li>&nbsp;</li>
						<li>Community</li>
						<li className="truncate">Sub Community</li>
						<li className="truncate">Property Number</li>
						<li>Name</li>
						<li>Mobile</li>
						<li>Nationality</li>
						<li>Notes</li>
					</ul>
					<ul className="list-reset">
						<Hits hitComponent={ContactHit} />
					</ul>

					<div className="p-4">
						<Pagination />
					</div>
				</div>

			</InstantSearch>
		)
	}
}

ReactDOM.render(
	<ContactLists />,
	document.getElementById('ContactLists')
)