@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="info-box bg-red hover-expand-effect">
            <div class="icon">
                <i class="material-icons">account_balance_wallet</i>
            </div>
            <div class="content">
                <div class="text">TOTAL REVENUE</div>
                <div class="number"><small>₱</small> <strong>{{ number_format($revenue, 2, '.', ',') }}</strong></div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="info-box bg-red hover-expand-effect">
            <div class="icon">
                <i class="material-icons">group</i>
            </div>
            <div class="content">
                <div class="text">ACTIVE MEMBERS</div>
                <div class="number"><strong>{{ $active }}</strong></div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="info-box bg-red hover-expand-effect">
            <div class="icon">
                <i class="material-icons">group_add</i>
            </div>
            <div class="content">
                <div class="text">NEW MEMBERS THIS MONTH</div>
                <div class="number"><strong>{{ $newmembers }}</strong></div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <b>Monthly Statistics</b>
            </div>
            <div class="body">
                <canvas id="monthlyStatistics"></canvas>
            </div>
        </div>
    </div>
</div>
<script>
var ctx = document.getElementById('monthlyStatistics').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'line',

    // The data for our dataset
    data: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        datasets: [{
            label: 'Gym Revenue',
            backgroundColor: 'maroon',
            borderColor: 'black',
            data: [
                {{ $graph_revenue['January'] }},
                {{ $graph_revenue['February'] }},
                {{ $graph_revenue['March'] }},
                {{ $graph_revenue['April'] }},
                {{ $graph_revenue['May'] }},
                {{ $graph_revenue['June'] }},
                {{ $graph_revenue['July'] }},
                {{ $graph_revenue['August'] }},
                {{ $graph_revenue['September'] }},
                {{ $graph_revenue['October'] }},
                {{ $graph_revenue['November'] }},
                {{ $graph_revenue['December'] }},
            ]
        },{
            label: 'New Members',
            backgroundColor: 'red',
            borderColor: 'black',
            data: [
                {{ $graph_members['January'] }},
                {{ $graph_members['February'] }},
                {{ $graph_members['March'] }},
                {{ $graph_members['April'] }},
                {{ $graph_members['May'] }},
                {{ $graph_members['June'] }},
                {{ $graph_members['July'] }},
                {{ $graph_members['August'] }},
                {{ $graph_members['September'] }},
                {{ $graph_members['October'] }},
                {{ $graph_members['November'] }},
                {{ $graph_members['December'] }},
            ]
        }]
    },

    // Configuration options go here
    options: {}
});
</script>
@endsection