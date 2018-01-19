<template>
	
	<table class="table table-bordered table-hover table-sm">
		<thead>
			<tr>
				<th>Denomination</th>
				<th>Pieces</th>
				<th>Gross</th>
			</tr>
		</thead>
		<tbody>

			<tr v-for="(data,weight) in denominations">
				<td>{{ weight }}</td>
				<td>{{ data.quantity|currency }}</td>
				<td>{{ data.gross|currency }}</td>
			</tr>
		</tbody>
	</table>
</template>
<script>
	export default{
		props:["denominations"]
	}
</script>