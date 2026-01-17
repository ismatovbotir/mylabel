@extends('layouts.app')
@section('title', $company, 'Company')
@section('sider')

@endsection
@section('content')

    <script>
        let close = {{ $close }}
        if (close == 0) window.close()
    </script>

    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="components-preview ">
                        <div class="nk-block nk-block-lg " style="margin-top:50px;">

                            <h6>{{ $company }}</h6>
                            {{--
   
                            <a href="{{ route('admin.company.index') }}" class="btn btn-danger btn-lg">
                                <span class="ni ni-home "></span>
                            </a> 
                            --}}
                        </div><!-- .nk-block-head -->

                        <div class="nk-block nk-block-lg">
                            <div class="card card-preview">
                                <div class="card-inner">
                                    <div class="preview-block">

                                        <table class="table">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>
                                                        Date
                                                    </th>
                                                    <th>Agent
                                                    </th>
                                                    <th>Qty
                                                    </th>
                                                    <th>Value
                                                    </th>
                                                    <th>Discout
                                                    </th>
                                                    <th>Total
                                                    </th>
                                                    <th>Profit
                                                    </th>
                                                    <th>
                                                        Show
                                                    </th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $total = 0;
                                                    $profit = 0;
                                                    $labels = [];
                                                    $chartDataTotal = [];
                                                    $chartDataProfit = [];
                                                @endphp
                                                @foreach ($data as $key => $record)
                                                    <tr>
                                                        <td>{{ $record['docDate'] }}</td>
                                                        <td>{{ $record['agent'] }}</td>
                                                        <td>{{ number_format($record['totalQty'], 0, '.', ' ') }}</td>
                                                        <td>{{ number_format($record['totalValue'], 0, '.', ' ') }}</td>
                                                        <td>{{ number_format($record['totalDiscount'], 0, '.', ' ') }}</td>
                                                        <td>{{ number_format($record['total'], 0, '.', ' ') }}</td>
                                                        <td>{{ number_format($record['totalProfit'], 0, '.', ' ') }}</td>
                                                        <td>
                                                            <button class="btn btn-info btn-sm"
                                                                onClick="showItems('doc-{{ $key }}')"
                                                                {{ $record['totalQty'] == 0 ? 'disabled' : '' }}>
                                                                <span class="icon ni ni-list"></span>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    @php
                                                        $total = $total + $record['total'];
                                                        $profit = $profit + $record['totalProfit'];
                                                        $labels[] = $record['docDate'];
                                                        $chartDataTotal[] = $record['total'];
                                                        $chartDataProfit[] = $record['totalProfit'];
                                                    @endphp
                                                    <tr class="collapse" id="doc-{{ $key }}">
                                                        <td colspan="8">
                                                            <table class="table">
                                                                <tbody>
                                                                    @foreach ($record['items'] as $item)
                                                                        <tr>
                                                                            <td colspan="2">{{ $item['item'] }}</td>

                                                                            <td>{{ number_format($item['qty'], 0, '.', ' ') }}
                                                                            </td>
                                                                            <td>{{ number_format($item['value'], 0, '.', ' ') }}
                                                                            </td>
                                                                            <td>{{ number_format($item['discount'], 0, '.', ' ') }}
                                                                            </td>
                                                                            <td>{{ number_format($item['total'], 0, '.', ' ') }}
                                                                            </td>
                                                                            <td>{{ number_format($item['profit'], 0, '.', ' ') }}
                                                                            </td>

                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>

                                                            </table>

                                                        </td>

                                                    </tr>
                                                @endforeach
                                            </tbody>

                                        </table>

                                    </div>
                                </div>
                            </div><!-- .card-preview -->
                        </div>



                        <div class="nk-block nk-block-lg">
                            <div class="card card-preview">


                                <div class="card-inner">

                                    <div class="nk-sale-data-group align-center justify-between gy-3 gx-5">
                                        <div class="nk-sale-data">
                                            <span class="amount">Sotuv: {{ number_format($total, 0, '', ' ') }}</span>
                                            <span class="amount sm">Daromad:
                                                {{ number_format($profit, 0, '', ' ') }}</span>
                                        </div>
                                        <div class="nk-sale-data">

                                        </div>
                                    </div>
                                    <div class="nk-sales-ck large pt-4 ">

                                        <canvas class="sales-overview-chart chartjs-render-monitor" id="myChart1"
                                            style="display: block; width:100%; height: auto;"></canvas>
                                    </div>



                                </div>
                            </div><!-- .card-preview -->
                        </div><!-- .nk-block -->

                        <div class="nk-block nk-block-lg">
                            <div class="card card-preview">


                                <div class="card-inner">

                                    <div class="nk-sale-data-group align-center justify-between gy-3 gx-5">
                                        <div class="nk-sale-data">
                                            <span class="amount">Mahsulotlar kesimida:</span>

                                        </div>
                                        <div class="nk-sale-data">

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="md-6 nk-sales-ck large pt-4 ">

                                            <canvas class="sales-overview-chart chartjs-render-monitor" id="myChart2"
                                                style="display: block; width:100%; height: auto;"></canvas>
                                        </div>
                                        <div class="md-6 nk-sales-ck large pt-4 ">

                                            <canvas class="sales-overview-chart chartjs-render-monitor" id="myChart3"
                                                style="display: block; width:100%; height: auto;"></canvas>
                                        </div>
                                    </div>




                                </div>
                            </div><!-- .card-preview -->
                        </div><!-- .nk-block -->

                    </div><!-- .components-preview -->
                </div>
            </div>
        </div>
    </div>


@endsection

@section('footerScripts')
    <script src="assets/js/bundle.js?ver=2.4.0"></script>
    <script src="assets/js/scripts.js?ver=2.4.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function showItems(id) {
            items = document.getElementById(id);
            switch (items.className) {
                case "collapse":
                    items.className = "collapse show"
                    break;
                case "collapse show":
                    items.className = "collapse"
                    break;

            }
        }
    </script>
    <script>
        const ctx1 = document.getElementById('myChart1').getContext('2d');

        const myChart1 = new Chart(ctx1, {
            type: 'line', // тип графика: line, bar, pie, etc.
            data: {
                labels: @json($labels),
                datasets: [{
                    label: 'Sotuvlari',
                    data: @json($chartDataTotal),
                    borderWidth: 2,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    tension: 0.3 // сглаживание линий
                }, {
                    label: 'Daromad',
                    data: @json($chartDataProfit),
                    borderWidth: 2,
                    borderColor: 'rgba(250, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    tension: 0.3 // сглаживание линий
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        //piechart2
        const ctx2 = document.getElementById('myChart2').getContext('2d');
        let dataChart=@json($dataChart);
        console.log(dataChart)
        const myChart2 = new Chart(ctx2, {
            type: 'pie', // тип графика: line, bar, pie, etc.
            data: {
                labels: @json($labels),
                datasets: [{
                    label: 'Sotuvlari',
                    data: @json($dataChart),
                    borderWidth: 2,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    tension: 0.3 // сглаживание линий
                }, {
                    label: 'Daromad',
                    data: @json($chartDataProfit),
                    borderWidth: 2,
                    borderColor: 'rgba(250, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    tension: 0.3 // сглаживание линий
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });


    </script>

@endsection
