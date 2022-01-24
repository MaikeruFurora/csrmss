@extends('../layout/app')
@section('title','Dashboard')
@section('content')
<section class="section">
    <h2 class="section-title">Dashboard</h2>

    <div class="section-body">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="card card-statistic-2 shadow">
                            <div class="card-stats">
                            <div class="card-stats-title">Baptism Statistics</div>
                            <div class="card-stats-items">
                                <div class="card-stats-item">
                                    <div class="card-stats-item-count">{{ $baptismStat[0]['total'] ?? '0' }}</div>
                                    <div class="card-stats-item-label">Pending</div>
                                </div>
                                <div class="card-stats-item">
                                    <div class="card-stats-item-count">-</div>
                                    <div class="card-stats-item-label">-</div>
                                </div>
                                <div class="card-stats-item">
                                    <div class="card-stats-item-count">{{ $baptismStat[1]['total'] ?? '0' }}</div>
                                    <div class="card-stats-item-label">Completed</div>
                                </div>
                            </div>
                            </div>
                            <div class="card-icon shadow-primary bg-primary">
                            <i class="fas fa-baby"></i>
                            </div>
                            <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total No.</h4>
                            </div>
                            <div class="card-body">
                                {{ intval($baptismStat[0]['total'] ?? 0) + intval($baptismStat[1]['total'] ?? 0) }}
                            </div>
                            </div>
                        </div>
                    </div>
                   
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="card card-statistic-2 shadow">
                            <div class="card-stats">
                            <div class="card-stats-title">Wedding Statistics</div>
                            <div class="card-stats-items">
                                <div class="card-stats-item">
                                    <div class="card-stats-item-count">{{ $weddingStat[0]['total'] ?? '0'}}</div>
                                    <div class="card-stats-item-label">Pending</div>
                                </div>
                                <div class="card-stats-item">
                                    <div class="card-stats-item-count">-</div>
                                    <div class="card-stats-item-label">-</div>
                                </div>
                                <div class="card-stats-item">                                     
                                    <div class="card-stats-item-count">{{ $weddingStat[1]['total'] ?? '0' }}</div>
                                    <div class="card-stats-item-label">Completed</div>
                                </div>
                            </div>
                            </div>
                            <div class="card-icon shadow-primary bg-warning">
                            <i class="fas fa-male"></i><i class="fas fa-female"></i>
                            </div>
                            <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total No.</h4>
                            </div>
                            <div class="card-body">
                                {{ intval($weddingStat[0]['total'] ?? 0) + intval($weddingStat[1]['total'] ?? 0) }}
                            </div>
                            </div>
                        </div>
                    </div>
        
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="card card-statistic-2 shadow">
                            <div class="card-stats">
                            <div class="card-stats-title">Mass Statistics</div>
                            <div class="card-stats-items">
                                <div class="card-stats-item">
                                    <div class="card-stats-item-count">{{ $massStat[0]['total'] ?? '0'}}</div>
                                    <div class="card-stats-item-label">Pending</div>
                                </div>
                                <div class="card-stats-item">
                                    <div class="card-stats-item-count">-</div>
                                    <div class="card-stats-item-label">-</div>
                                </div>
                                <div class="card-stats-item">
                                    <div class="card-stats-item-count">{{ $massStat[1]['total'] ?? '0' }}</div>
                                    <div class="card-stats-item-label">Completed</div>
                                </div>
                            </div>
                            </div>
                            <div class="card-icon shadow-primary bg-danger">
                            <i class="fas fa-church"></i>
                            </div>
                            <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total No.</h4>
                            </div>
                            <div class="card-body">
                                {{ intval($massStat[0]['total'] ?? 0) + intval($massStat[1]['total'] ?? 0) }}
                            </div>
                            </div>
                        </div>
                    </div>
        
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="card card-statistic-2 shadow">
                            <div class="card-stats">
                            <div class="card-stats-title">Burial Statistics</div>
                            <div class="card-stats-items">
                                <div class="card-stats-item">
                                    <div class="card-stats-item-count">{{ $burialStat[0]['total'] ?? '0'}}</div>
                                    <div class="card-stats-item-label">Pending</div>
                                </div>
                                <div class="card-stats-item">
                                    <div class="card-stats-item-count">-</div>
                                    <div class="card-stats-item-label">-</div>
                                </div>
                                <div class="card-stats-item">
                                    <div class="card-stats-item-count">{{ $burialStat[1]['total'] ?? '0'}}</div>
                                    <div class="card-stats-item-label">Completed</div>
                                </div>
                            </div>
                            </div>
                            <div class="card-icon shadow-primary bg-info">
                            <i class="fas fa-cross"></i>
                            </div>
                            <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Orders</h4>
                            </div>
                            <div class="card-body">
                                {{ intval($burialStat[0]['total'] ?? 0) + intval($burialStat[1]['total'] ?? 0) }}
                            </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="card card-statistic-2 shadow">
                            <div class="card-stats">
                            <div class="card-stats-title">Confirmation Statistics</div>
                            <div class="card-stats-items">
                                <div class="card-stats-item">
                                    <div class="card-stats-item-count">{{ $confirmationStat[0]['total'] ?? '0'}}</div>
                                    <div class="card-stats-item-label">Pending</div>
                                </div>
                                <div class="card-stats-item">
                                    <div class="card-stats-item-count">-</div>
                                    <div class="card-stats-item-label">-</div>
                                </div>
                                <div class="card-stats-item">
                                    <div class="card-stats-item-count">{{ $confirmationStat[1]['total'] ??'0' }}</div>
                                    <div class="card-stats-item-label">Completed</div>
                                </div>
                            </div>
                            </div>
                            <div class="card-icon shadow-primary bg-secondary">
                            <i class="fas fa-sun text-dark"></i>
                            </div>
                            <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Orders</h4>
                            </div>
                            <div class="card-body">
                                {{ intval($confirmationStat[1]['total'] ?? 0) + intval($confirmationStat[0]['total'] ?? 0) }}
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card shadow">
                    <div class="card-header">
                        <h4>Upcoming Schedule</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled list-unstyled-border">
                            @forelse ($event as $item)
                            {{-- {{ $item['original'] }} --}}
                            <li class="media">
                                <div class="media-body">
                                    <div class="float-right"> <i style="font-size: 20px" class="fas {{ $item['icon'] }}"></i></div>
                                    <div class="media-title">{{ $item['name'] }}  <span class="badge badge-warning">{{ date("F j, Y",strtotime($item['start'])) }}</span></div>
                                    <span class="text-small text-muted">Time: {{ $item['time'] }}</span>
                                </div>
                            </li>
                            @empty
                            <div class="media-body text-center">No data available</div>
                            @endforelse
                        </ul>
                        <div class="text-center pt-1 pb-1">
                            <a href="{{ route('admin.schedule') }}" class="btn btn-primary btn-lg btn-round">
                                View All
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card shadow">
                    <div class="card-header">
                        <h4>No. of client request service</h4>
                        <div class="card-header-action">
                            <small>{{ date("F j, Y") }}</small>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart2"  width="40%" height="30%" ></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('moreJs')
<script src="{{ asset('js/chart/chart.min.js') }}"></script>
<script>
    let feedData = JSON.parse('<?php echo json_encode($Piedata,JSON_NUMERIC_CHECK); ?>');
    let populationByRequestService = (b,c,m,w,br) => {
    let ctx = document.getElementById("myChart2").getContext("2d");
    

    var myChart = new Chart(ctx, {
        type: "pie",
        data: {
            datasets: [
                {
                    data: [b,c,m,w,br],
                    backgroundColor: ["#6777EF", "#CDD3D8",'#FC544B','#FFA426','#3ABAF4'],
                    label: "Dataset 1",
                },
            ],
            labels: ['Baptism','Confirmation','Mass','Wedding','Burial'],
        },
        options: {
            responsive: true,
            legend: {
                position: "bottom",
            },
        },
    });
};
let b = (feedData[0]?.total ?? 0);
let br = (feedData[1]?.total ?? 0);
let c = (feedData[2]?.total ?? 0);
let m = (feedData[3]?.total ?? 0);
let w = (feedData[4]?.total ?? 0);
populationByRequestService(b,c,m,w,br)
</script>
@endsection