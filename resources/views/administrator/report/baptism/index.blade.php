@extends('../layout/app')
@section('title','Report Baptism')
@section('moreCss')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
@endsection
@section('content')
@include('administrator/partial/approvedConfirmation')
@include('administrator/partial/DeleteConfirmation')
@include('administrator/partial/baptiszedModal')
@include('administrator/partial/generateModal')
<section class="section">
    <h2 class="section-title">Report Baptism</h2>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card card-primary">
                    <div class="card-header">
                       <div class="card-header-action">
                        {{-- <div class="btn"> --}}
                            <a href="{{ route('admin.baptism.create') }}" class="btn btn-info delete">SHEDULE BAPTISM</a>
                            <button type="submit" class="btn btn-primary" id="btnGenerate"><i class="far fa-file-alt"></i> Generate Report</button>
                        {{-- </div> --}}
                      </div>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab2" role="tablist">
                            <li class="nav-item"><a class="nav-link active" id="home-tab2" data-toggle="tab" href="#home2" role="tab" aria-controls="home" aria-selected="true">UPCOMING</a></li>
                            <li class="nav-item"><a class="nav-link" id="profile-tab2" data-toggle="tab" href="#profile2" role="tab" aria-controls="profile" aria-selected="false">COMPLETED</a></li>
                        </ul>
                        <div class="tab-content tab-bordered" id="myTab3Content">
                            <div class="tab-pane fade show active" id="home2" role="tabpanel" aria-labelledby="home-tab2">

                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped" id="baptismTablePending" style="font-size: 10px">
                                        <thead>
                                            <tr>
                                                <th>Child Name</th>
                                                <th>Mother & Contact No.</th>
                                                <th>Father & Contact No.</th>
                                                <th>Scheduled Date</th>
                                                <th>Time from - to</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                            <div class="tab-pane fade" id="profile2" role="tabpanel" aria-labelledby="profile-tab2">
                               {{-- tab two --}}
                               
                               <div class="table-responsive">
                                <table style="width: 100%;font-size:10px" class="table table-bordered table-striped" id="baptismTableApproved">
                                    <thead>
                                        <tr>
                                            <th>Child Name</th>
                                            <th>Mother & Contact No.</th>
                                            <th>Father & Contact No.</th>
                                            <th>Scheduled Date</th>
                                            <th>Time from - to</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                              {{-- tab two end --}}
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

        $("#btnGenerate").on('click',function(e){
            $("#generateModal").modal("show")
           
        })

        $("#generatePDF").submit(function(e){
            e.preventDefault()
            let from = $("input[name='from']").val();
            let to = $("input[name='to']").val();
            if (to!="") {
                window.open(`baptism/pdf/${from}/${to}`,'_blank')
                $("input[name='from']").val('');
                $("input[name='to']").val('');
            }else{
               getToast("error", "Eror", "Something went wrong");
            }
        })
                var currentDate = new Date();
                $('#datepicker1').datepicker({
                    dateFormat: "yy-mm-dd",
                        autoclose:true,
                        endDate: "currentDate",
                        maxDate: currentDate,
                        beforeShow: function() {
                            $(this).datepicker('option', 'maxDate', $('#datepicker2').val());
                        }
                }).on('changeDate', function (ev) {
                    $(this).datepicker('hide');
                });
                $('#datepicker1').keyup(function () {
                    if (this.value.match(/[^0-9]/g)) {
                        this.value = this.value.replace(/[^0-9^-]/g, '');
                    }
                });
                $('#datepicker1').on('click',function () {
                    $('#datepicker2').val('')
                });

                $('#datepicker2').datepicker({
                    dateFormat: "yy-mm-dd",
                    beforeShow: function() {
                    $(this).datepicker('option', 'minDate', $('#datepicker1').val());
                      if ($('#datepicker1').val() === '') $(this).datepicker('option', 'minDate', 0);                             
                    }
                })

    
        let baptismTablePending = $("#baptismTablePending").DataTable({
            pageLength: 5,
            lengthMenu: [ 5,10, 25, 50, 75, 100 ],
            destroy: true,
            ajax: "/admin/report/baptism/pending",
            columns: [
                {
                     data: null,
                     render:function(data){
                         return data.child_first_name+' '+data.child_middle_name +'. '+data.child_last_name
                     }
                },
                {
                     data: null,
                     render:function(data){
                         return data.parent_mother_first_name+' '+data.parent_mother_middle_name +'. '+data.parent_mother_last_name    
                     }
                },
                {
                     data: null,
                     render:function(data){
                         return data.parent_father_first_name+' '+data.parent_father_middle_name +'. '+data.parent_father_last_name   
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
                        <button class="btn btn-sm btn-success changeStatus"  value="${data.id}_Approved">Complete</button>
                        <a href="/admin/report/baptism/view/${data.id}" class="btn btn-sm btn-info view">View</a>
                        
                        `;
                     }
                },
// <button class="btn btn-sm btn-danger delete_pending" value="${data.id}">Delete</button>
            ],
        });

        let baptismTableApproved= $("#baptismTableApproved").DataTable({
            lengthChange: false,
            destroy: true,
            ajax: "/admin/report/baptism/approved",
            columns: [
                {
                     data: null,
                     render:function(data){
                         return data.child_first_name+' '+data.child_middle_name +'. '+data.child_last_name
                     }
                },
                {
                     data: null,
                     render:function(data){
                         return data.parent_mother_first_name+' '+data.parent_mother_middle_name +'. '+data.parent_mother_last_name   
                     }
                },
                {
                     data: null,
                     render:function(data){
                         return data.parent_father_first_name+' '+data.parent_father_middle_name +'. '+data.parent_father_last_name   
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
                        <button class="btn btn-sm btn-primary print" value="${data.id}">Certificate</button>
                        
                        <a href="/admin/report/baptism/view/${data.id}" class="btn btn-sm btn-info view pl-4 pr-4">View</a>
                        
                        `;
                     }
                },
                        // <button class="btn btn-sm btn-warning changeStatus pl-3 pr-3" value="${data.id}_Pending">Reject</button>

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
                url: "/admin/report/baptism/delete/" + $(this).val(),
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
                    baptismTablePending.ajax.reload();
                    baptismTableApproved.ajax.reload();
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
                $(".yesApproved").text('Complete')
            }
        })


        $(".yesApproved").on('click',function(){
            let data=$(this).val().split("_")
            $.ajax({
                url: "/admin/report/baptism/change/status/"+data[0]+"/"+data[1],
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
                    baptismTablePending.ajax.reload();
                    baptismTableApproved.ajax.reload();
                    $("#approvedModal").modal("hide")
                })
                .fail(function (jqxHR, textStatus, errorThrown) {
                    console.log(jqxHR, textStatus, errorThrown);
                    getToast("error", "Eror", errorThrown);
                });
        })


        $(document).on("click",'.print', function () {
            $("#baptizedModal").modal("show")   
            $(".generate").val($(this).val())
        });

        $(".generate").on('click',function(){
            let register_no = $("input[name='register_no']").val()
            let page_no = $("input[name='page_no']").val()
            let priest = $("select[name='priest']").val()
            
             popupCenter({
                    url: "/admin/report/baptism/print/" + $(this).val()+"/"+register_no+"/"+page_no+"/"+priest,
                    title: "report",
                    w: 1400,
                    h: 800,
                });
                $("#baptizedModal").modal("hide")  
        })
    </script>
@endsection