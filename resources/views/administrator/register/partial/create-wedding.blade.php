@extends('../layout/app')
@section('title','Create Record')
@section('content')
<section class="section">
    
    <h2 class="section-title">Create Record | Wedding</h2>
    
    <div class="section-body">
        @include('administrator/partial/clientRequestInfo')
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card card-primary">
                    <div class="card-header">
                       <h4>&nbsp;&nbsp; </h4>
                    </div>
                    <div class="card-body"> 
                        <form id="weddingForm">
                            @csrf
                            <input type="hidden" name="register_service_id" value="{{ $regiterservice->id }}">
                          <input type="hidden" name="id" value="{{ $data->id ?? '' }}">
                            <h4>Bride's Information</h4>

                            <div class="form-row">
                              <div class="col-md-3 mb-3">
                                <label >Bride's first name</label>
                                <input type="text" class="form-control" required name="bride_first_name" value="{{ $data->bride_first_name ?? '' }}">
                              </div>
                              <div class="col-md-3 mb-3">
                                <label >Bride's middle name</label>
                                <input type="text" class="form-control" required name="bride_middle_name" value="{{ $data->bride_middle_name ?? '' }}">
                              </div>
                              <div class="col-md-3 mb-3">
                                <label >Bride's last name</label>
                                <input type="text" class="form-control" required name="bride_last_name" value="{{ $data->bride_last_name ?? '' }}">
                              </div>
                              <div class="col-md-3 mb-3">
                                <label >Contact No.</label>
                                <input type="text" maxlength="11" onkeypress="return numberOnly(event)" class="form-control" name="bride_contact_no" value="{{ $data->bride_contact_no ?? '' }}">
                              </div>
                            </div>
                            <div class="form-group">
                                <label >Complete Address</label>
                                <input type="text" class="form-control" required name="bride_complete_address" value="{{ $data->bride_complete_address ?? '' }}">
                              </div>

                            <hr>
                            <h4>Groom's Information</h4>
                           
                            <div class="form-row">
                              <div class="col-md-3 mb-3">
                                <label >Groom's first name</label>
                                <input type="text" class="form-control" required name="groom_first_name" value="{{ $data->groom_first_name ?? '' }}">
                              </div>
                              <div class="col-md-3 mb-3">
                                <label >Groom's middle name</label>
                                <input type="text" class="form-control" required name="groom_middle_name" value="{{ $data->groom_middle_name ?? '' }}">
                              </div>
                              <div class="col-md-3 mb-3">
                                <label >Groom's last name</label>
                                <input type="text" class="form-control" required name="groom_last_name" value="{{ $data->groom_last_name ?? '' }}">
                              </div>
                              <div class="col-md-3 mb-3">
                                <label >Contact No.</label>
                                <input type="text" maxlength="11" onkeypress="return numberOnly(event)" class="form-control" name="groom_contact_no" value="{{ $data->groom_contact_no ?? '' }}">
                              </div>
                            </div>
                            <div class="form-group">
                              <label >Complete Address</label>
                              <input type="text" class="form-control" required name="groom_complete_address" value="{{ $data->groom_complete_address ?? '' }}">
                            </div>


                            <hr>
                            <h4>Schedule Date & Time</h4>
                            <div class="form-row">
                              <div class="col-md-4 mb-3">
                                <label >Date Selected</label>
                                <input type="text" id="datepicker" class="form-control" required name="scheduled_date" value="{{ $data->start_date ?? date("Y-m-d",strtotime($regiterservice->schedule_date)) }}">
                              </div>
                              <div class="col-md-4 mb-3">
                                <label >Time from</label>
                                <input type="time"  step='1' min="00:00:00" max="20:00:00" class="form-control" required name="scheduled_time_form" value="{{ $data->start_time ?? '' }}">
                              </div>
                              <div class="col-md-4 mb-3">
                                <label >Time to</label>
                                <input type="time"  step='1' min="00:00:00" max="20:00:00" class="form-control" required name="scheduled_time_to" value="{{ $data->end_time ?? '' }}">
                              </div>
                            </div>

                            <button class="btn btn-info mt-5 btnSave" type="submit">Submit Record</button>
                            <a href="{{ route('admin.registered.client') }}" class="btn btn-warning mt-5 pl-3 pr-3">Back</a>
                        </form>  
                    </div>
                </div>
                <div class="card">
                  <div class="card-header">
                    <h4>Event Schedule on <span style="font-size: 11px" class="badge badge-info showDateSelected"></span></h4>
                  </div>
                  <div class="card-body">
                     <div class="table-responsive">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Service</th>
                            <th>Time Start</th>
                            <th>Time End</th>
                          </tr>
                        </thead>
                        <tbody id="showAvailability">
                            <tr>
                              <td colspan="4" class="text-center">No data</td>
                            </tr>
                        </tbody>
                    </table>  
                     </div>
                  </div>
                </div>
              </div>
          
        </div>
    </div>
</section>
@endsection

@section('moreJs')
<script>
        let getSched = (date_selected)=>{
          if (date_selected!='') {
            let hold='';
            $.ajax({
              url: "/admin/get/all/occupied/"+date_selected,
              type: "GET",
              beforeSend: function () {
                      $("#showAvailability")
                          .html(
                              `<div class="spinner-border spinner-border-sm" role="status">
                                  <span class="sr-only">Loading...</span>
                              </div>`
                          );
                  },
              }).done(function(data){
              if (data.length!=0) {
                  data.forEach((element,i) => {
                      hold+=` <tr>
                              <th>${++i}</th>
                              <th>${element.service}</th>
                              <th>${element.start}</th>
                              <th>${element.end}</th>
                              </tr>`;
                  });
              } else {
                  hold=` <tr>
                          <td colspan="4" class="text-center">No data</td>
                          </tr>`;
              }
                  $("#showAvailability").html(hold);
              }).fail(function (jqxHR, textStatus, errorThrown) {
                  getToast("error", "Eror", errorThrown);
                  $(".btnSave").html("Register").attr("disabled", false);
              });
          }
        }
        let current_date= $('input[name="scheduled_date"]').val();
        getSched(current_date); 
        
        $( "#datepicker" ).datepicker({
          dateFormat: "yy-mm-dd",
          minDate: +1,  
        });
        $("#datepicker").on("change",function(){
        $('.showDateSelected').text($(this).val())
        getSched($(this).val())
        });
        

        $("#weddingForm").on('submit',function(e){
          e.preventDefault();
          $.ajax({
                url: "/admin/report/wedding/store",
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
              if (data.errTime) {
                getToast("warning", "Warning", data.errTime);
              } else {
                // document.getElementById("weddingForm").reset();
                getToast("success", "Done", "Successsfuly Save new record");
                // $("input[name='id']").val("");
                getSched($('input[name="scheduled_date"]').val())
              }
                $(".btnSave").html("Update Record").attr("disabled", false);
            })
            .fail(function (jqxHR, textStatus, errorThrown) {
                getToast("error", "Eror", errorThrown);
                $(".btnSave").html("Update Record").attr("disabled", false);
            });
      })  

</script>

@endsection