@extends('../layoutClient/app')
@section('content')
@section('moreCss')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
@endsection
<section class="section">

    <div class="section-body">
        <h2 class="section-title">REGISTER REQUEST</h2>
       <div class="row">
            <div class="col-lg-12 col-md-12 col-sm 12">
                <div class="card">
                    <div class="card-header">
                        <h4>Request List</h4>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Transaction No.</th>
                                    <th>Service</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Date Registered</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="requestList"></tbody>
                        </table>
                    </div>
                </div>
            </div>
       </div>
    </div>
</section>
@endsection

@section('moreJs')
    <!-- JS Libraies -->
    <script src="{{ asset('assets/modules/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('assets/modules/jquery-ui/jquery-ui.min.js') }}"></script>
    <script>
        let requestList = ()=>{
            let requestList='';
            $.ajax({
                url:'/client/request/list',
                type:'GET',
                dataType:'json',
                beforeSend: function () {
                        $("#tableUser").html(
                            `<tr>
                                    <td colspan="5" class="text-center">
                                        <div class="spinner-border spinner-border-sm" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </td>
                                </tr>
                                `
                        );
                },
            }).done(function(data){
                data.forEach(element => {
                    requestList+=`
                        <tr>
                            <td>
                                ${element.transaction_no}
                            </td>
                            <td>
                                ${element.service}
                            </td>
                            <td>
                                ${element.schedule_date}
                            </td>
                            <td>
                                <span class="badge  ${element.status=='Pending'? 'badge-warning' : 'badge-success'}">
                                    ${element.status}
                                </span>
                            </td>
                            <td>
                                ${element.created_at.split("T")[0]}
                            </td>
                            <td>
                                ${
                                    element.status=="Pending"?
                                    `<button class="btn btn-danger">Delete</button>
                                     <a target="_blank" href="register/slip/${element.id}" class="btn btn-info">Trans. slip</a>`
                                    :''
                                }
                                
                            </td>
                        </tr>
                    `
                });
                $("#requestList").html(requestList);
           }).fail(function (jqxHR, textStatus, errorThrown) {
                getToast("error", "Eror", errorThrown);
            });
        }
        requestList()

    </script>

    
@endsection