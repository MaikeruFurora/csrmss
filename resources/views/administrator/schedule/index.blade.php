@extends('../layout/app')
@section('title','Scheduling')
@section('content')
@section('moreCss')
    <link rel="stylesheet" href="{{ asset('css/fullcalendar/fullcalendar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
    <style>
        .fc-today {
            background: #f2d9d9 !important;
            /* color: white; */
        } 
    </style>
@endsection
@include('administrator/partial/DeleteConfirmation')
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Event Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <ul class="list-group">
                <li class="list-group-item titleEvent"></li>
                <li class="list-group-item dateEvent"></li>
                <li class="list-group-item timeEvent"></li>
              </ul>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>`
<section class="section">
    <div class="section-body">
        <h2 class="section-title">Manage Schedule</h2>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card card-primary">
                    <div class="card-header">
                       <h4> Manage Schedule</h4>
                       <div class="card-header-action">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-default">Color Legend</button>
                            <button type="button" class="btn text-white" style="background: red">Church event</button>
                            <button type="button" class="btn text-white" style="background: orange">Wedding</button>
                            <button type="button" class="btn text-white" style="background: blue">&nbsp;Baptism&nbsp;</button>
                            <button type="button" class="btn text-white" style="background: #804000">&nbsp;&nbsp;Burial&nbsp;&nbsp;</button>
                            <button type="button" class="btn text-white" style="background: green">&nbsp;&nbsp;Mass&nbsp;&nbsp;</button>
                            <button type="button" class="btn text-white" style="background: violet">Confirmation</button>
                          </div>
                       </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="fc-overflow">
                                    <div id="myEvent"></div>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <h5>Reminder</h5>
                                <p class="mt-2">
                                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sunt ad facilis ipsum fuga dolorum recusandae
                                    , et porro magnam quaerat accusantium reprehenderit ducimus quae molestiae anim
                                </p>
                                <div class="card shadow card-info">
                                    <div class="card-body pb-3">
                                        <form class="mb-4" id="eventForm">@csrf
                                            <input type="hidden" name="id">
                                            <div class="form-group">
                                              <label>Church event name</label>
                                              <input type="text" name="event" class="form-control" required>
                                             </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                      <span class="input-group-text">Date Range</span>
                                                    </div>
                                                    <input type="text" id="datepicker1" class="form-control" required name="date_from">
                                                    <input type="text" id="datepicker2" class="form-control" name="date_to">
                                                  </div>
                                            </div>
                                            <div class="form-group">
                                                <select name="status" required class="custom-select">
                                                    <option value="">-- Choose status --</option>
                                                    <option value="1">Enable</option>
                                                    <option value="0">Disable</option>
                                                </select>
                                            </div>
                                           
                                            <button type="submit" class="btn btn-block btn-primary btnSave">Save</button>
                                            <button type="button" class="btn btn-block btn-warning btn-lg btnCancel">Cancel</button>
                                          </form><hr>
                                          <table class="table table-bordered" id="eventTable">
                                              <thead>
                                                  <tr>
                                                      <th>Event</th>
                                                      <th width="40%">Date</th>
                                                      <th width="10%">Status</th>
                                                      <th width="20%">Action</th>
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
    </div>

</section>
@endsection

@section('moreJs')
<script src="{{ asset('js/fullcalendar/fullcalendar.min.js') }}"></script>
<script src="{{ asset('assets/modules/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('assets/modules/jquery-ui/jquery-ui.min.js') }}"></script>
<script>
    $("#myEvent").fullCalendar({
        header:{
            left:'prev,next,today',
            center:'title',
            right:'month,agendaWeek,agendaDay'
        },
        editable:true,
        selectable:true,
        selectHelper:true,
        selectMirror:true,
        events: '/admin/schedule/list/available',
       eventClick:function(arg){
           console.log(arg);
           let dstart=arg.start.toString()
           let dend=arg.end==null?'':arg.end.toString()
        $(".titleEvent").text(arg.title)
        $(".dateEvent").html("<b>Date from</b> <em>"+dstart+"</em>")
        $(".timeEvent").html("<b>Date to</b> <em>"+dend+"</em>")
        $("#staticBackdrop").modal("show")
       },
       dayRender: function (date, cell) {

        let today = new Date();
        let end = new Date();                
        end.setDate(today.getDate());                 


        if( date < end) {
        cell.css("background-color", "#eeeedd");
        } // this is for previous date 

        //   if(date > today) {
        //     cell.css("background-color", "blue");
        //   }


        }
    })

   

    $("#datepicker1").datepicker({
        dateFormat: "MM dd",
    });
    $("#datepicker2").datepicker({
        dateFormat: "MM dd",
    });
    $(".btnCancel").hide();
    $(".btnCancel").on("click", function () {
        $(this).hide();
        document.getElementById("eventForm").reset();
        $(".btnSave").html("Save");
        $("input[name='id']").val("");
    });
    $("#eventForm").submit(function(e){
        e.preventDefault();
        $.ajax({
        url: "/admin/schedule/event/store",
        type: "POST",
        data: new FormData(this),
        processData: false,
        contentType: false,
        cache: false,
        beforeSend: function () {
            $(".btnSave")
                .html(
                    `Saving ...
                    <div class="spinner-border spinner-border-sm" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>`
                )
                .attr("disabled", true);
        },
    })
        .done(function (data) {
            $(".btnSave").text('Save')
            document.getElementById("eventForm").reset();
            $("input[name='id']").val("");
            $(".btnSave").html("Save").attr("disabled", false);
            $(".btnCancel").hide();
            eventTable.ajax.reload();
            $('#myEvent').fullCalendar('refetchEvents');
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            getToast("error", "Eror", errorThrown);
            $(".btnSave").html("Save").attr("disabled", false);
        });
    })

    let eventTable = $("#eventTable").DataTable({
    pageLength: 3,
    lengthMenu: [ 5,10, 25, 50, 75, 100 ],
    // lengthChange: false,
    processing: true,
    language: {
        processing: `
            <div class="spinner-border spinner-border-sm" role="status">
            <span class="sr-only">Loading...</span>
          </div>`,
    },
    ajax: "/admin/schedule/event/list",
    columns: [
        { data: "event" },
        {
            data: null,
            render: function (data) {
                if (data.date_to == null) {
                    return `${data.date_from}`;
                } else {
                    return `${data.date_from}-${
                        data.date_to.split(" ")[1]
                    }`;
                }
            },
        },
        {
            data: null,
            render: function (data) {
               if (data.status=='1') {
                   return `<span class="badge badge-success pt-1 pb-1">Enabled</span>`;
                } else {
                   return `<span class="badge badge-warning text-dark pt-1 pb-1">Disabled</span>`;
               }
            },
        },
        {
            data: null,
            render: function (data) {
                return `
                <div class="btn-group" role="group" aria-label="Button group">
                    <button class="btn pl-3 pr-3 btn-sm btn-info btnEdit btnload_${data.id}" value="${data.id}"><i class="far fa-edit"></i></button>
                    <button class="btn pl-3 pr-3 btn-sm btn-danger btnDelete btnDLoad_${data.id}" value="${data.id}"><i class="far fa-trash-alt"></i></button>
                </div>
                `;
            },
        },
    ],
});

$(document).on("click", ".btnEdit", function () {
    let id = $(this).val();
    $.ajax({
        url: "/admin/schedule/event/edit/" + $(this).val(),
        type: "GET",
        dataType: "json",
        beforeSend: function () {
            $(".btnload_" + id)
                .html(
                    `
            <div class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only">Loading...</span>
            </div>`
                )
                .attr("disabled", true);
        },
    })
        .done(function (response) {
            $(".btnCancel").show();
            $(".btnSave").text('Update')
            $(".btnload_" + id)
                .html(`<i class="far fa-edit"></i>`)
                .attr("disabled", false);
            $('input[name="id"]').val(response.id);
            $('input[name="date_from"]').val(response.date_from);
            $('input[name="date_to"]').val(response.date_to);
            $('input[name="event"]').val(response.event);
            $('select[name="status"]').val(response.status==1?'1':'0');
            // $("#holidayModal").modal("show");
            // $("#myEvent").fullCalendar("refetchResources");
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            $(".btnload_" + id)
                .html("Save")
                .attr("disabled", false);
            console.log(jqxHR, textStatus, errorThrown);
            getToast("error", "Eror", errorThrown);
        });
});


$(document).on("click", ".btnDelete", function () {
    let id = $(this).val();
    $("#deleteModal").modal("show")
    $(".yesConfirm").val(id)
   
});


$('.yesConfirm').on('click', function () {
    $.ajax({
        url: "/admin/schedule/event/delete/" + $(this).val(),
        type: "DELETE",
        data: { _token: $('input[name="_token"]').val() },
        beforeSend: function () {
            $(".yesConfirm")
                .html(
                    `
            <div class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only">Loading...</span>
            </div>`
                )
                .attr("disabled", true);
        },
    })
        .done(function (response) {
            $(".yesConfirm")
                .html(`<i class="far fa-trash-alt"></i>`)
                .attr("disabled", false);
                eventTable.ajax.reload();
            $("#deleteModal").modal("hide")
            $('#myEvent').fullCalendar('refetchEvents');
            // window.location.reload()
            
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            $(".yesConfirm")
                .html("Save")
                .attr("disabled", false);
            console.log(jqxHR, textStatus, errorThrown);
            getToast("error", "Eror", errorThrown);
        });
})
</script>
@endsection