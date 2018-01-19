<style>
	.text-right {
		text-align: right !important;
	}

	.text-muted {
	  color: #636c72 !important;
	}

	.font-weight-bold {
		font-weight: bold;
	}
	.text-center {
		text-align: center !important;
	}
	.text-info 
	{
		color: #1565C0 !important;
	}
	.p-0 {
		padding: 0 0 !important;
	}

	.pt-2 {
	  padding-top: 0.5rem !important;
	}
	.pt-3 {
	  padding-top: 1rem !important;
	}


	.m-0 {
		margin: 0 0 !important;
	}
	.mb-2 {
	  margin-bottom: 0.5rem !important;
	}

	.table-component__table {
		min-width: 100%;
		border-collapse: collapse;
		border: solid px #ddd;
		table-layout: fixed;
	}

	.table-component__table th,
	.table-component__table td {
		padding: 0.5em 0.25em;
		vertical-align: top;
		text-align: left;
	}

	.table-component__table th {
		background-color: #e0e0e0;
		color: black;
		text-transform: uppercase;
		white-space: nowrap;
		font-size: .85em;
	}

	.table-component__table tbody tr:nth-child(even) {
		background-color: #f0f0f0;
	}

	.table-component__table a {
		color: #007593;
	}

	h1,
	h2,
	h3,
	h4,
	h5,
	h6,
	.h1,
	.h2,
	.h3,
	.h4,
	.h5,
	.h6 {
		margin-bottom: 0.5rem;
		font-family: inherit;
		font-weight: 500;
		line-height: 1.1;
		color: inherit;
	}

	h1,
	.h1 {
		font-size: 2.5rem;
	}

	h2,
	.h2 {
		font-size: 2rem;
	}

	h3,
	.h3 {
		font-size: 1.75rem;
	}

	h4,
	.h4 {
		font-size: 1.5rem;
	}

	h5,
	.h5 {
		font-size: 1.25rem;
	}

	h6,
	.h6 {
		font-size: 1rem;
	}

	.lead {
		font-size: 1.25rem;
		font-weight: 300;
	}

	.display-1 {
		font-size: 6rem;
		font-weight: 300;
		line-height: 1.1;
	}

	.display-2 {
		font-size: 5.5rem;
		font-weight: 300;
		line-height: 1.1;
	}

	.display-3 {
		font-size: 4.5rem;
		font-weight: 300;
		line-height: 1.1;
	}

	.display-4 {
		font-size: 3.5rem;
		font-weight: 300;
		line-height: 1.1;
	}

	hr {
		margin-top: 1rem;
		margin-bottom: 1rem;
		border: 0;
		border-top: 1px solid rgba(0, 0, 0, 0.1);
	}
	.box{
		padding:10px;
		border: 2px solid rgba($black,.125);
	}

	.img-thumbnail {
		padding: 0.25rem;
		background-color: #fff;
		border: 3px solid #ddd;
		border-radius: 0;
		-webkit-transition: all 0.2s ease-in-out;
		transition: all 0.2s ease-in-out;
		max-width: 100%;
		height: auto;
	}

	.page-break {
		page-break-after: always;
	}
	.text-underlined 
	{
		text-decoration:underline;
		text-decoration-style:double;
		text-decoration-width:3px;
	}

	.double-line
	{
		border: 4px double #1565C0;
	}
	.d-flex {
	  display: -webkit-box !important;
	  display: -ms-flexbox !important;
	  display: flex !important;
	}

	.align-items-center {
	      align-items: center !important;
	}
	.is-fullheight
	{
		min-height: 100vh;
	}

</style>

<div>
	<h3 class="text-center h1 text-info font-weight-bold">
		<strong>{{ $defaults->name }}</strong>
	</h3>
	<div class="double-line"></div>

</div>