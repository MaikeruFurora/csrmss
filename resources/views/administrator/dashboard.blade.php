@extends('../layout/app')
@section('title','Dashboard')
@section('content')
<section class="section">
    <h2 class="section-title">Dashboard</h2>

    <div class="section-body">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card card-statistic-2">
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
                <div class="card card-statistic-2">
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

            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card card-statistic-2">
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
                <div class="card card-statistic-2">
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
                            <div class="card-stats-item-count">{{ $burialStat->Approved }}</div>
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
        
        {{-- <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                   <h4> Financial Report</h4>
                   <div class="card-header-action">
                       <select name="" id="" class="custom-select">
                           <option value="">Select Services</option>
                           <option value="Baptism">Baptism</option>
                           <option value="Wedding">Wedding</option>
                           <option value="Burial">Burial</option>
                       </select>
                   </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div> --}}
        </div>
        
    </div>
</section>
@endsection