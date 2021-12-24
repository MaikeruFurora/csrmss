@extends('../layout/app')
@section('title','Scheduling')
@section('content')
@section('moreCss')
    <link rel="stylesheet" href="{{ asset('css/fullcalendar/fullcalendar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
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
                            <button type="button" class="btn text-white" style="background: orange">Wedding</button>
                            <button type="button" class="btn text-white" style="background: blue">&nbsp;Baptism&nbsp;</button>
                            <button type="button" class="btn text-white" style="background: gray">&nbsp;&nbsp;Burial&nbsp;&nbsp;</button>
                            <button type="button" class="btn text-white" style="background: green">&nbsp;&nbsp;Mass&nbsp;&nbsp;</button>
                            <button type="button" class="btn text-white" style="background: violet">Confirmation</button>
                          </div>
                       </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="fc-overflow">
                                    <div id="myEvent"></div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <h5>Reminder</h5>
                                <p class="mt-2">
                                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sunt ad facilis ipsum fuga dolorum recusandae
                                    , et porro magnam quaerat accusantium reprehenderit ducimus quae molestiae animi dignissimos 
                                    nihil reiciendis eius quam.
                                </p>
                                <div class="card shadow card-info">
                                    <div class="card-body pb-3">
                                        <form class="mb-5">
                                            <div class="form-group">
                                              <label for="exampleInputEmail1">Church event name</label>
                                              <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                             </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                      <span class="input-group-text">Date Range</span>
                                                    </div>
                                                    <input type="text" id="datepicker1" class="form-control">
                                                    <input type="text" id="datepicker2" class="form-control">
                                                  </div>
                                            </div>
                                           
                                            <button type="submit" class="btn btn-block btn-primary">Save</button>
                                          </form><hr>
                                          <table class="table table-bordered" id="eventTable">
                                              <thead>
                                                  <tr>
                                                      <th>Event</th>
                                                      <th width="20%">Date</th>
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
       }
    })

    $("#eventTable").DataTable({
        lengthChange: false,
    })

    $('#datepicker1').datepicker()
    $('#datepicker2').datepicker()
</script>
@endsection