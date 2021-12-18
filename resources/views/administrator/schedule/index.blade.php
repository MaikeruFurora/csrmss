@extends('../layout/app')
@section('title','Scheduling')
@section('content')
@section('moreCss')
    <link rel="stylesheet" href="{{ asset('css/fullcalendar/fullcalendar.min.css') }}">
@endsection
@include('administrator/partial/DeleteConfirmation')
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Event Detail</h5>
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
                <div class="card">
                    <div class="card-header">
                       <h4> Manage Schedule</h4>
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
                                <p class="mt-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut nulla quis doloremque, error eligendi fugiat facere? Hic voluptate 
                                    quidem, aut laboriosam, blanditiis placeat ducimus error repellendus modi corrupti reprehenderit. Sequi.
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora necessitatibus illum perferendis voluptatem sequi
                                     sunt perspiciatis ab, inventore, doloribus architecto neque maiores facilis aut laudantium voluptatibus placeat quam. Consectetur, velit?
                                </p>
                                <h6 class="mt-5">Color legend</h6>
                                <table class="table table-bordered table-striped ">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Color</th>
                                            <th>Event</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td><span class="badge text-white" style="background: orange">Orange</span> </td>
                                            <td>Wedding</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td><span class="badge text-white" style="background: blue">Blue</span> </td>
                                            <td>Baptism</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td><span class="badge text-white" style="background: gray">Gray</span></td>
                                            <td>Burial</td>
                                        </tr>
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
<script src="{{ asset('js/fullcalendar/fullcalendar.min.js') }}"></script>
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
        $(".titleEvent").text(arg.title)
        $(".dateEvent").text(arg.start)
        $(".timeEvent").text(arg.end)
        $("#staticBackdrop").modal("show")
       }
    })

</script>
@endsection