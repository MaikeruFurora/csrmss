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
                                    <div class="card-stats-item-count">{{ $baptismStat->Pending ?? '0' }}</div>
                                    <div class="card-stats-item-label">Pending</div>
                                </div>
                                <div class="card-stats-item">
                                    <div class="card-stats-item-count">-</div>
                                    <div class="card-stats-item-label">-</div>
                                </div>
                                <div class="card-stats-item">
                                    <div class="card-stats-item-count">{{ $baptismStat->Approved ?? '0' }}</div>
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
                                {{ intval($baptismStat->Pending ?? 0) + intval($baptismStat->Approved ?? 0) }}
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
                                    <div class="card-stats-item-count">{{ $weddingStat->Pending ?? '0'}}</div>
                                    <div class="card-stats-item-label">Pending</div>
                                </div>
                                <div class="card-stats-item">
                                    <div class="card-stats-item-count">-</div>
                                    <div class="card-stats-item-label">-</div>
                                </div>
                                <div class="card-stats-item">
                                    <div class="card-stats-item-count">{{ $weddingStat->Approved ?? '0' }}</div>
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
                                {{ intval($weddingStat->Pending ?? 0) + intval($weddingStat->Approved ?? 0) }}
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
                                    <div class="card-stats-item-count">{{ $massStat->Pending ?? '0'}}</div>
                                    <div class="card-stats-item-label">Pending</div>
                                </div>
                                <div class="card-stats-item">
                                    <div class="card-stats-item-count">-</div>
                                    <div class="card-stats-item-label">-</div>
                                </div>
                                <div class="card-stats-item">
                                    <div class="card-stats-item-count">{{ $massStat->Approved ?? '0' }}</div>
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
                                {{ intval($massStat->Pending ?? 0) + intval($massStat->Approved ?? 0) }}
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
                                    <div class="card-stats-item-count">{{ $burialStat->Pending ?? '0'}}</div>
                                    <div class="card-stats-item-label">Pending</div>
                                </div>
                                <div class="card-stats-item">
                                    <div class="card-stats-item-count">-</div>
                                    <div class="card-stats-item-label">-</div>
                                </div>
                                <div class="card-stats-item">
                                    <div class="card-stats-item-count">{{ $burialStat->Approved ?? '0'}}</div>
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
                                {{ intval($burialStat->Pending ?? 0) + intval($burialStat->Approved ?? 0) }}
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
                                    <div class="card-stats-item-count">{{ $confirmationStat->Pending ?? '0'}}</div>
                                    <div class="card-stats-item-label">Pending</div>
                                </div>
                                <div class="card-stats-item">
                                    <div class="card-stats-item-count">-</div>
                                    <div class="card-stats-item-label">-</div>
                                </div>
                                <div class="card-stats-item">
                                    <div class="card-stats-item-count">{{ $confirmationStat->Approved ??'0' }}</div>
                                    <div class="card-stats-item-label">Completed</div>
                                </div>
                            </div>
                            </div>
                            <div class="card-icon shadow-primary bg-secondary">
                            <i class="fas fa-sun"></i>
                            </div>
                            <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Orders</h4>
                            </div>
                            <div class="card-body">
                                {{ intval($confirmationStat->Pending ?? 0) + intval($confirmationStat->Approved ?? 0) }}
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
            </div>
        </div>
    </div>
</section>
@endsection