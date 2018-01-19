<template>
	<table class="table table-bordered table-sm">
	<thead>
		<tr>
			<th>Pieces</th>
			<th>Denomination</th>
			<th>Gross</th>
			<th>Net</th>
			
		</tr>
	</thead>
	<tbody>
		<template v-for="n in network">
			<tr>
				<td>{{ (n.net/n.weight)|currency}}</td>
				<td>{{n.weight|currency}}</td>
				<td>{{n.gross|currency}}</td>
				<td>{{n.net|currency }}</td>
			
			</tr>
		</template>
	</tbody>
	<tfoot>
		<tr>
			<th colspan="2"  class="text-right">Totals</th>
			<th>{{ totals.gross|currency}}</th>
			<th>{{ totals.net|currency }}</th>
		</tr>
	</tfoot>
</table>
</template>
<script>
export default
{
	props:['network','totals'],
}	
</script>
