@extends('../layoutClient/app')
@section('moreCss')
    <link rel="stylesheet" href="{{ asset('css/fullcalendar/fullcalendar.min.css') }}">
@endsection
@section('content')
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
  </div>
<section class="section">

    <div class="section-body">
        <h2 class="section-title">CHURCH CALENDAR</h2>
       <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                  <div class="fc-overflow">
                    <div id="myEvent"></div>
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
<script src="{{ asset('assets/modules/jquery-ui/jquery-ui.min.js') }}"></script>
<script>
    $( "#datepicker" ).datepicker({
        dateFormat: "mm/dd/yy",
        minDate: +1,  
    });
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
        events: '/client/schedule/list/available',
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
</script>
@endsection