<h4 class="text-center text-info">{{ title_case($network) }}</h4>
@include('reports.daily.stock.table',["denominations"=>
$stats["table"]])

<pie></pie>