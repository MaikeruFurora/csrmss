@extends('../layout/app')
@section('title','Client Request')
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

    <h2 class="section-title">Manage Register Client</h2>

    <div class="section-body">
       <div class="row">
           <div class="col-lg-12 col-md-12 col-sm 12">
               <div class="card card-primary">
                   <div class="card-header">
                       <h4>Information</h4>
                   </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab2" role="tablist">
                            <li class="nav-item"><a class="nav-link active" id="home-tab2" data-toggle="tab" href="#home2" role="tab" aria-controls="home" aria-selected="true">Pending Request</a></li>
                            <li class="nav-item"><a class="nav-link" id="profile-tab2" data-toggle="tab" href="#profile2" role="tab" aria-controls="profile" aria-selected="false">Approved Request</a></li>
                        </ul>
                        <div class="tab-content tab-bordered" id="myTab3Content">
                            <div class="tab-pane fade show active" id="home2" role="tabpanel" aria-labelledby="home-tab2">

                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped" id="registerClientPending" style="font-size: 13px">
                                        <thead>
                                            <tr>
                                                <th>Trans. No</th>
                                                <th>FullName</th>
                                                <th>Address</th>
                                                <th>Contact No.</th>
                                                <th>Service</th>
                                                <th>Scheduled date</th>
                                                <th>Date registered</th>
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
                                <table style="width: 100%;font-size:12px" class="table table-bordered table-striped" id="baptismTableApproved">
                                    <thead>
                                        <tr>
                                            <th>Trans. No</th>
                                            <th>FullName</th>
                                            <th>Address</th>
                                            <th>Email</th>
                                            <th width="4%">Service</th>
                                            <th>Scheduled date</th>
                                            <th>Date registered</th>
                                            <th width="20%">Action</th>
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
      <script src="{{ asset('js/summernote-bs4.js') }}"></script>
  
      <script>
          let ids = JSON.parse('<?php echo json_encode($data) ?>')
          let registerClientPending = $("#registerClientPending").DataTable({
              pageLength: 5,
              lengthMenu: [ 5,10, 25, 50, 75, 100 ],
              destroy: true,
              ajax: "/admin/registered/client/list/pending",
              columns: [
                 { data:'transaction_no' },
                 { data:'fullname' },
                 { data:'address' },
                 { data:'contact_no' },
                 { data:'service' },
                 { data:'schedule_date' },
                  {
                       data: null,
                       render:function(data){
                          return data.created_at.split("T")[0]
                       }
                  },
                  {
                       data: null,
                       render:function(data){
                          return `
                          <button class="btn btn-sm btn-success changeStatus pl-2 pr-2"  value="${data.id}_Approved">Approve</button>
                          `;
                       }
                        //   <button class="btn btn-sm btn-danger delete_pending pl-3 pr-3" value="${data.id}">Delete</button>
                  },
  
              ],
          });
  
          let baptismTableApproved= $("#baptismTableApproved").DataTable({
            pageLength: 5,
              lengthMenu: [ 5,10, 25, 50, 75, 100 ],
              destroy: true,
              ajax: "/admin/registered/client/list/approved",
              columns: [
                { data:'transaction_no' },
                 { data:'fullname' },
                 { data:'address' },
                 { data:'email' },
                 { data:'service' },
                 { data:'schedule_date' },
                  {
                       data: null,
                       render:function(data){
                          return data.created_at.split("T")[0]
                       }
                  },
                  {
                       data: null,
                       render:function(data){
                        switch (data.service) {
                            case 'Baptism':
                                    
                                    return  ids.filter(i=>(i==data.id))==''?`
                                    <a href="/admin/resgistered/create/baptism/${data.id}" class="btn btn-sm btn-info text-white pl-1 pr-1" value="${data.id}">
                                        Create Record
                                    </a>
                                    <button class="btn btn-sm btn-warning sendEmail pl-1 pr-1" value="${data.id}"><i class="far fa-paper-plane"></i> Send Email</button>
                                    `:
                                    `
                                    <a href="/admin/resgistered/create/baptism/${data.id}" class="btn btn-sm btn-success text-white pl-1 pr-1" value="${data.id}">
                                        Update Record
                                    </a>
                                    `;
                                    
                                break;
                            case 'Wedding':
                            return  ids.filter(i=>(i==data.id))==''?`
                                    <a href="/admin/resgistered/create/wedding/${data.id}" class="btn btn-sm btn-info text-white pl-1 pr-1" value="${data.id}">
                                        Create Record
                                    </a>
                                    <button class="btn btn-sm btn-warning sendEmail pl-1 pr-1" value="${data.id}"><i class="far fa-paper-plane"></i> Send Email</button>
                                    `:
                                    `
                                    <a href="/admin/resgistered/create/wedding/${data.id}" class="btn btn-sm btn-success text-white pl-1 pr-1" value="${data.id}">
                                        Update Record
                                    </a>
                                    `
                                break;
                            case 'Mass':
                            return  ids.filter(i=>(i==data.id))==''?`
                                    <a href="/admin/resgistered/create/mass/${data.id}" class="btn btn-sm btn-info text-white pl-1 pr-1" value="${data.id}">
                                        Create Record
                                    </a>
                                    ${
                                        data.email==null?``:
                                        `<button class="btn btn-sm btn-warning sendEmail pl-1 pr-1" value="${data.email}"><i class="far fa-paper-plane"></i> Send Email</button>`
                                    }
                                    `:
                                    `
                                    <a href="/admin/resgistered/create/mass/${data.id}" class="btn btn-sm btn-success text-white pl-1 pr-1" value="${data.id}">
                                        Update Record
                                    </a>
                                    `
                                break;
                            case 'Confirmation':
                            return  ids.filter(i=>(i==data.id))==''?`
                                    <a href="/admin/resgistered/create/confirmation/${data.id}" class="btn btn-sm btn-info text-white pl-1 pr-1" value="${data.id}">
                                        Create Record
                                    </a>
                                    ${
                                        data.email==null?``:
                                        `<button class="btn btn-sm btn-warning sendEmail pl-1 pr-1" value="${data.email}"><i class="far fa-paper-plane"></i> Send Email</button>`
                                    }
                                    `:
                                    `
                                    <a href="/admin/resgistered/create/confirmation/${data.id}" class="btn btn-sm btn-success text-white pl-1 pr-1" value="${data.id}">
                                        Update Record
                                    </a>
                                    `
                                break;
                            case 'Burial':
                            return  ids.filter(i=>(i==data.id))==''?`
                                    <a href="/admin/resgistered/create/burial/${data.id}" class="btn btn-sm btn-info text-white pl-1 pr-1" value="${data.id}">
                                        Create Record
                                    </a>
                                    ${
                                        data.email==null?``:
                                        `<button class="btn btn-sm btn-warning sendEmail pl-1 pr-1" value="${data.email}"><i class="far fa-paper-plane"></i> Send Email</button>`
                                    }
                                    `:
                                    `
                                    <a href="/admin/resgistered/create/burial/${data.id}" class="btn btn-sm btn-success text-white pl-1 pr-1" value="${data.id}">
                                        Update Record
                                    </a>
                                    `
                                break;
                            
                            default:
                                break;
                        }
                            // <button class="btn btn-sm btn-warning changeStatus pl-2 pr-2" value="${data.id}_Pending">Reject</button>
                            // <button class="btn btn-sm btn-danger delete_pending pl-3 pr-3" value="${data.id}">Delete</button>
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
                  url: "/admin/registered/client/delete/" + $(this).val(),
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
                      registerClientPending.ajax.reload();
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
                  $(".yesApproved").text('Approve')
              }
          })
  
  
          $(".yesApproved").on('click',function(){
              let data=$(this).val().split("_")
              $.ajax({
                  url: "/admin/registered/client/change/status/"+data[0]+"/"+data[1],
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
                      registerClientPending.ajax.reload();
                      baptismTableApproved.ajax.reload();
                      $("#approvedModal").modal("hide")
                  })
                  .fail(function (jqxHR, textStatus, errorThrown) {
                      console.log(jqxHR, textStatus, errorThrown);
                      getToast("error", "Eror", errorThrown);
                  });
          })

          $(document).on('click','.sendEmail',function(){
              $("#sendEmailModal").modal("show")
              $("input[name='to']").val($(this).val())
              $("input[name='subject']").val('')
              $("textarea[name='body']").summernote('reset')
          })

          $(".sendCancel").on('click', function () {
            $("textarea[name='body']").summernote('reset')
            $("input[name='to']").val('')
          })

          $("#sendEmailForm").submit(function(e){
              e.preventDefault();
              $.ajax({
                url: "/admin/registered/client/sendEmail",
                type: "POST",
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                beforeSend: function () {
                    $(".btnSendEmail")
                        .html(
                            `Sending ...
                            <div class="spinner-border spinner-border-sm" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>`
                        )
                        .attr("disabled", true);
                },
            })
                .done(function (data) {
                    if (data.msg) {
                        getToast("warning", "Warning",data.msg);
                    } else {
                        $("#sendEmailModal").modal("hide")
                        getToast("success", "Done", "Successsfuly Sent an email");
                    }
                    $(".btnSendEmail").html(`<i class="far fa-paper-plane"></i> Send`).attr("disabled", false);
                })
                .fail(function (jqxHR, textStatus, errorThrown) {
                    getToast("error", "Eror", errorThrown);
                    $(".btnSendEmail").html(`<i class="far fa-paper-plane"></i> Send`).attr("disabled", false);
                });
          })


  
      </script>
@endsection