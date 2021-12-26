@extends('../layout/app')
@section('title','Archive Masterlist')
@section('moreCss')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
@endsection
@section('content')
@include('administrator/partial/DeleteConfirmation')
@include('administrator/partial/archiveModal')
<section class="section">
    <h2 class="section-title">Archive Masterlist</h2>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
               <div class="card">
                   <div class="card-header">
                       <h4>Information</h4>
                       {{-- <div class="card-header-action">
                               <select name="" id="" class="custom-select">
                                   <option value="">---- Choose ----</option>
                                   <option value="priest">Priest</option>
                                   <option value="client_request">Client request</option>
                               </select>
                       </div> --}}
                   </div>
                   <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab2" role="tablist">
                        <li class="nav-item"><a class="nav-link active" id="home-tab2" data-toggle="tab" href="#home2" role="tab" aria-controls="home" aria-selected="true">PRIEST</a></li>
                        <li class="nav-item"><a class="nav-link" id="profile-tab2" data-toggle="tab" href="#profile2" role="tab" aria-controls="profile" aria-selected="false">USERS</a></li>
                    </ul>
                    <div class="tab-content tab-bordered" id="myTab3Content">
                        <div class="tab-pane fade show active" id="home2" role="tabpanel" aria-labelledby="home-tab2">
                            <div class="table-responsive">
                                <table class="table table-striped" id="priestTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Archive Duration</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile2" role="tabpanel" aria-labelledby="profile-tab2">
                            <div class="table-responsive">
                                <table class="table table-striped" id="userTable"  style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
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
<script src="{{ asset('assets/modules/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('assets/modules/jquery-ui/jquery-ui.min.js') }}"></script>
<script>
    $("#userTable").DataTable()
    let priestTable= $("#priestTable").DataTable({
        pageLength: 5,
        lengthMenu: [ 5,10, 25, 50, 75, 100 ],
        destroy: true,
        ajax: "/admin/archive/retrive/priest",
        columns: [
            {
                 data: "i"
            },
            {
                 data: "fullname"
            },
            {
                 data: "deleted_at"
            },
           
            {
                 data: "updated_at"
            },
            {
                 data: null,
                 render:function(data){
                    return `
                   
                    <button class="btn btn-info restore" value="${data.id}"><i class="fas fa-window-restore"></i> Restore</button>
                    <button class="btn btn-danger delete" value="${data.id}"><i class="far fa-trash-alt"></i> Delete</button>
                    `;
                 }
            },

        ],
    });

    $(document).on('click','.restore',function(){
        $("#restoreModal").modal("show")
        $(".yesRestore").val($(this).val())
    })

    $(".yesRestore").on('click',function(){
        $.ajax({
            url: "/admin/archive/restore/priest/" + $(this).val(),
            type: "GET",
            data: { _token: $('input[name="_token"]').val() },
            beforeSend: function () {
                $(".yesRestore").html(`
                <div class="spinner-border spinner-border-sm" role="status">
                    <span class="sr-only">Loading...</span>
                </div>`);
            },
        })
            .done(function (response) {
                $(".yesRestore").html("Yes, Restore");
                getToast("success", "Success", "deleted one record");
                priestTable.ajax.reload()
                $("#restoreModal").modal("hide")
            })
            .fail(function (jqxHR, textStatus, errorThrown) {
                console.log(jqxHR, textStatus, errorThrown);
                $(".yesRestore").html("Yes, Restore");
                getToast("error", "Eror", errorThrown);
            });
    })

    $(document).on('click','.delete',function(){    
        $("#deleteModal").modal("show")
        $(".yesConfirm").val($(this).val())
    })

    $(".yesConfirm").on('click',function(){
        $.ajax({
            url: "/admin/archive/delete/priest/" + $(this).val(),
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
                $(".yesConfirm").html("Yes");
                getToast("success", "Success", "deleted one record");
                priestTable.ajax.reload();
                $("#deleteModal").modal("hide")
            })
            .fail(function (jqxHR, textStatus, errorThrown) {
                console.log(jqxHR, textStatus, errorThrown);
                $(".yesConfirm").html("Yes");
                getToast("error", "Eror", errorThrown);
            });
    })

</script>
@endsection