@extends('../layout/app')
@section('title','Notification')
@section('moreCss')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/summernote-bs4.css') }}">
@endsection
@include('administrator/partial/approvedConfirmation')
@include('administrator/partial/DeleteConfirmation')
@include('administrator/partial/sendEmail')
@section('content')
<section class="section">

    <h2 class="section-title">Notification</h2>

    <div class="section-body">
       <div class="row">
           <div class="col-lg-12 col-md-12 col-sm 12">
                <div class="card">
                    <div class="card-header">
                        <div class="btn-group" role="group" aria-label="Button group">
                            <a href="{{ route('admin.markAsRead') }}" class="btn btn-info">Mark as Read</a>&nbsp;
                            <a href="{{ route('admin.deleteNotification') }}" class="btn btn-danger">Delete All</a>
                        </div>
                    </div>
                    <div class="card-header">
                        <table class="table table-bordered">
                            @forelse (auth()->user()->notifications()->get() as $item)
                            <tr class="@if ($item->read_at == null) bg-secondary @else  @endif">
                                <td>
                                    <i class="fas {{ $item->data['request']['icon'] }}"></i> &nbsp;
                                    {{ $item->data['request']['bodyMessage'] }}
                                    <span class="float-right">{{ $item->created_at->diffForHumans() }}</span>
                                </td>
                            </tr>
                            @empty
                            @endforelse
                        </table>
                    </div>
                       
                </div>
           </div>
       </div>
    </div>
</section>
@endsection