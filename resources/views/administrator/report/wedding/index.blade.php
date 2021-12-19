@extends('../layout/app')
@section('title','Dashboard')
@section('moreCss')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
@endsection
@section('content')
@include('administrator/partial/weddingModal')
@include('administrator/partial/approvedConfirmation')
@include('administrator/partial/DeleteConfirmation')
<section class="section">
    <h2 class="section-title">Report Wedding</h2>
    
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                      
                       <div class="card-header-action">
                        {{-- <div class="btn"> --}}
                            <a href="{{ route('admin.wedding.create') }}" class="btn btn-info delete">Create record</a>
                        {{-- </div> --}}
                      </div>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab2" role="tablist">
                            <li class="nav-item"><a class="nav-link active" id="home-tab2" data-toggle="tab" href="#home2" role="tab" aria-controls="home" aria-selected="true">Pending</a></li>
                            <li class="nav-item"><a class="nav-link" id="profile-tab2" data-toggle="tab" href="#profile2" role="tab" aria-controls="profile" aria-selected="false">Approved</a></li>
                        </ul>
                        <div class="tab-content tab-bordered" id="myTab3Content">
                            <div class="tab-pane fade show active" id="home2" role="tabpanel" aria-labelledby="home-tab2">
                                <table style="font-size: 10px" class="table table-bordered table-striped" id="weddingTablePending">
                                    <thead>
                                        <tr>
                                            
                                            <th>Bride's name | Contact No. </th>
                                            <th>Groom's name | Contact No.</th>
                                            <th>Scheduled Date</th>
                                            <th>Time From & to</th>
                                            <th width="15%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="profile2" role="tabpanel" aria-labelledby="profile-tab2">
                                <table style="width: 100%;font-size:10px" class="table table-bordered table-striped" id="weddingTableApproved">
                                    <thead>
                                        <tr>
                                            
                                            <th>Bride's name | Contact No. </th>
                                            <th>Groom's name | Contact No.</th>
                                            <th>Scheduled Date</th>
                                            <th>Time From & to</th>
                                            <th >Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
    let weddingTablePending = $("#weddingTablePending").DataTable({
        pageLength: 5,
        lengthMenu: [ 5,10, 25, 50, 75, 100 ],
        destroy: true,
        ajax: "/admin/report/wedding/pending",
        columns: [
         
            {
                 data: null,
                 render:function(data){
                     return data.bride_first_name+' '+data.bride_middle_name +'. '+data.bride_last_name +' & '+ data.bride_contact_no   
                 }
            },
            {
                 data: null,
                 render:function(data){
                     return data.groom_first_name+' '+data.groom_middle_name +'. '+data.groom_last_name +' & '+ data.groom_contact_no   
                 }
            },
            {
                 data: 'start_date'
            
            },
            {
                     data: null,
                     render:function(data){
                        return data.start_date +' - '+data.start_time
                     }
                },
            {
                 data: null,
                 render:function(data){
                    return `
                    <button class="btn btn-sm btn-success changeStatus"  value="${data.id}_Approved">Approve</button>
                    <a href="/admin/report/wedding/view/${data.id}" class="btn btn-sm btn-info view">View</a>
                    <button class="btn btn-sm btn-danger delete_pending" value="${data.id}">Delete</button>
                    `;
                 }
            },

        ],
    });

    let weddingTableApproved= $("#weddingTableApproved").DataTable({
        pageLength: 5,
        lengthMenu: [ 5,10, 25, 50, 75, 100 ],
        destroy: true,
        ajax: "/admin/report/wedding/approved",
        columns: [
            {
                 data: null,
                 render:function(data){
                     return data.bride_first_name+' '+data.bride_middle_name +'. '+data.bride_last_name +' & '+ data.bride_contact_no   
                 }
            },
            {
                 data: null,
                 render:function(data){
                     return data.groom_first_name+' '+data.groom_middle_name +'. '+data.groom_last_name +' & '+ data.groom_contact_no   
                 }
            },
            {
                 data: 'start_date'
            
            },
            {
                     data: null,
                     render:function(data){
                        return data.start_date +' - '+data.start_time
                     }
                },
            {
                 data: null,
                 render:function(data){
                    return `
                        ${ 
                            data.married==null?
                            `<button class="btn btn-sm btn-warning changeStatus pl-3 pr-3" value="${data.id}_Pending">Reject</button>`
                            :
                            `<button class="btn btn-sm btn-primary print" value="${data.id}">Certificate</button>`
                        }
                        <a href="/admin/report/wedding/view/${data.id}" class="btn btn-sm btn-info view pl-4 pr-4">View</a>
                        
                        `;
                 }
            },

        ],
    });

    $(document).on('click','.delete_pending',function(){    
        $("#deleteModal").modal("show")
        $(".yesConfirm").val($(this).val())
    })

    $(document).on('click','.delete_appoved',function(){    
        $("#deleteModal").modal("show")
        $(".yesConfirm").val($(this).val())
    })

    $(".yesConfirm").on('click',function(){
        $.ajax({
            url: "/admin/report/wedding/delete/" + $(this).val(),
            type: "DELETE",
            data: { _token: $('input[name="_token"]').val() },
            beforeSend: function () {
                $(".yesConfirm").html(`
                <div class="spinner-border spinner-border-sm" role="status">
                    <span class="sr-only">Loading...</span>
                </div>`);
            },
        })
            .done(function (response) {
                $(".yesConfirm").html("Delete");
                getToast("success", "Success", "deleted one record");
                weddingTablePending.ajax.reload();
                weddingTableApproved.ajax.reload();
                $("#deleteModal").modal("hide")
            })
            .fail(function (jqxHR, textStatus, errorThrown) {
                console.log(jqxHR, textStatus, errorThrown);
                getToast("error", "Eror", errorThrown);
            });
    })

   
   
    $(document).on('click','.changeStatus',function(){    
        $("#approvedModal").modal("show");
        $(".yesApproved").val($(this).val())
        if ($(this).val().split("_")[1]=="Pending") {
            $(".modal-body").text(" Are you sure you want to reject this record?")
            $(".yesApproved").text('Reject')
        }else{
            $(".modal-body").text(" Are you sure you want to approve this record?")
            $(".yesApproved").text('Approve')
        }
    })


    $(".yesApproved").on('click',function(){
        let data=$(this).val().split("_")
        $.ajax({
            url: "/admin/report/wedding/change/status/"+data[0]+"/"+data[1],
            type: "POST",
            data: { _token: $('input[name="_token"]').val() },
            beforeSend: function () {
                $(".yesApproved").html(`
                <div class="spinner-border spinner-border-sm" role="status">
                    <span class="sr-only">Loading...</span>
                </div>`);
            },
        })
            .done(function (response) {
                $(".yesApproved").html("Yes, Approve");
                getToast("success", "Success", "Approved one record");
                weddingTablePending.ajax.reload();
                weddingTableApproved.ajax.reload();
                $("#approvedModal").modal("hide")
            })
            .fail(function (jqxHR, textStatus, errorThrown) {
                console.log(jqxHR, textStatus, errorThrown);
                getToast("error", "Eror", errorThrown);
            });
    })
    $(document).on("click",'.print', function () {
            $("#weddingModal").modal("show")   
            $(".generate").val($(this).val())
        });

        $(".generate").on('click',function(){
            let priest = $("select[name='priest']").val()
            
             popupCenter({
                    url: "/admin/report/wedding/print/" + $(this).val()+"/"+priest,
                    title: "report",
                    w: 1400,
                    h: 800,
                });
                $("#weddingModal").modal("hide")  
        })
</script>
@endsection