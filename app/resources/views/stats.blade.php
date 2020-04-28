@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <h1>Statistics</h1>

        @if (session('status'))
            <div class="alert alert-warning" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <canvas id="item_categories"></canvas>
        <canvas id="item_reported_dates"></canvas>

        <div id="chart_data" data-category_counts="{{ $category_counts }}" data-item_dates="{{ $item_dates }}"></div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script>
    // var category_counts = JSON.parse({{ $category_counts }})
    var dataset = document.getElementById('chart_data').dataset
    var category_counts = JSON.parse(dataset.category_counts)
    var item_dates = JSON.parse(dataset.item_dates)

    var ctx = document.getElementById('item_categories').getContext('2d')
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',
        // The data for our dataset
        data: {
            labels: category_counts.map(cat => { return cat.name }),
            datasets: [{
                label: 'Lost items by category',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                // borderColor: '#63ffdd',
                data: category_counts.map(cat => { return cat.count })
            }]
        },
        // Configuration options go here
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true,
                    }
                }]
            }
        }
    })

    var ctx = document.getElementById('item_reported_dates').getContext('2d')
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',
        // The data for our dataset
        data: {
            labels: item_dates.map(item => { return item.date_reported.split('T')[0] }),
            datasets: [{
                label: 'Lost items by category',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                // borderColor: '#63ffdd',
                data: item_dates.map(item => { return item.count })
            }]
        },
        // Configuration options go here
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true,
                    }
                }]
            }
        }
    })
</script>
@endsection
