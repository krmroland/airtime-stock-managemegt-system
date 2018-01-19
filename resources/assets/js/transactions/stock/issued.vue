<template>
	<div class="card">
		<div class="card-block">
			<h4 class="card-title text-center text-muted">I
					ssued stock to <u>{{loadings.fielder.name}}</u> on
					{{data.date|formatDate}}
			</h4>
			<table class="table table-bordered table-sm">
			
					<template v-for="network in networks">
						<tr>
							<th>{{network.name|title}}</th>
							<template v-for="denomination in network.denominations">
								<th>{{denomination.weight}}</th>
							</template>
						</tr>
					</template>

			</table>
			<fielder :data="loadings.fielder":showDetails="false"></fielder>
		</div>
	</div>
</template>

<script>

	export default{

		props:["data"],
		data()
		{
			return this.data;
		}
	}
</script>