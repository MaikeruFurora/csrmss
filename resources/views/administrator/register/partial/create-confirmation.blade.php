@extends('../layout/app')
@section('title','Create Record')
@section('content')
<section class="section">
    
    <h2 class="section-title">Create Record | Confirmation</h2>
    
    <div class="section-body">
        @include('administrator/partial/clientRequestInfo')
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card card-primary">
                    <div class="card-header">
                       <h4>&nbsp;&nbsp; </h4>
                    </div>
                    <div class="card-body mt-4"> 
                      <form id="burialForm">
                          @csrf
                          <input type="hidden" name="register_service_id" value="{{ $regiterservice->id }}">
                          <input type="hidden" name="id" value="{{ $data->id ?? '' }}">
                          <h4>Confirmation Information</h4>
                       
                          <div class="form-row mt-4">
                            <div class="col-md-4 mb-3">
                              <label for="">First name</label>
                              <input type="text" class="form-control"  required name="confirmation_first_name" value="{{ $data->confirmation_first_name ?? '' }}">
                            </div>
                            <div class="col-md-4 mb-3">
                              <label for="">Middle name</label>
                              <input type="text" class="form-control"   name="confirmation_middle_name" value="{{ $data->confirmation_middle_name ?? '' }}">
                            </div>
                            <div class="col-md-4 mb-3">
                              <label for="">Last name</label>
                              <input type="text" class="form-control"  required name="confirmation_last_name" value="{{ $data->confirmation_last_name ?? '' }}">
                            </div>
                           
                            </div>
                            
                            <div class="form-row mt-4">
                              <div class="col-md-4 mb-3">
                                  <label for="">Select Gender</label>
                                    <select required name="confirmation_gender"  class="custom-select" >
                                        <option value="">-- Choose --</option>
                                        <option {{ $data->confirmation_gender ?? ''=='Male'? 'selected':'' }} value="Male">Male</option>
                                        <option {{ $data->confirmation_gender ?? ''=='Female'? 'selected':'' }} value="Female">Female</option>
                                    </select>
                                   
                                </div>
                                <div class="col-md-4 mb-3">
                                  <label for="">Age</label>
                                  <input type="text"maxlength="2" onkeypress="return numberOnly(event)" maxlength="2" class="form-control"   name="confirmation_age" value="{{ $data->confirmation_age ?? '' }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                  <label for="">Contact No.</label>
                                  <input type="text" maxlength="11" onkeypress="return numberOnly(event)" class="form-control"  required name="confirmation_contact_no" value="{{ $data->confirmation_contact_no ?? '' }}">
                                </div>
                            </div>
                            <br>
                            <h4>Schedule Date & Time</h4>
                          <div class="form-row">
                            <div class="col-md-4 mb-3">
                              <label for="">Date Selected</label>
                              <input type="text" id="datepicker" class="form-control"  required name="scheduled_date" value="{{ $data->start_date ?? $regiterservice->schedule_date }}">
                            </div>
                            <div class="col-md-4 mb-3">
                              <label for="">Time from</label>
                              <input type="time"  step='1' min="00:00:00" max="20:00:00" class="form-control"  required name="scheduled_time_form" value="{{ $data->start_time ?? '' }}">
                            </div>
                            <div class="col-md-4 mb-3">
                              <label for="">Time to</label>
                              <input type="time"  step='1' min="00:00:00" max="20:00:00" class="form-control"  required name="scheduled_time_to" value="{{ $data->end_time ?? '' }}">
                            </div>
                           
                          </div>
                          <button class="btn btn-info mt-5 btnSave" type="submit">Submit record</button>
                          <a href="{{ route('admin.registered.client') }}" class="btn btn-warning mt-5 ml-2">Back</a>
                          </div>
                         
                      </form>  
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
    </div>
</section>
@endsection

@section('moreJs')
<script>
        $( "#datepicker" ).datepicker({
        dateFormat: "yy-mm-dd",
        minDate: +1,  
        });
        $("#datepicker").on("change",function(){
        let hold='';
        $('.showDateSelected').text($(this).val())
            $.ajax({
            url: "/admin/get/all/occupied/"+$(this).val(),
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
        });

        $("#burialForm").on('submit',function(e){
      e.preventDefault();
      $.ajax({
            url: "/admin/report/confirmation/store",
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
                document.getElementById("burialForm").reset();
                getToast("success", "Done", "Successsfuly Save new record");
                $("input[name='id']").val("");
                $(".btnSave").html("Register").attr("disabled", false);
            })
            .fail(function (jqxHR, textStatus, errorThrown) {
                getToast("error", "Eror", errorThrown);
                $(".btnSave").html("Register").attr("disabled", false);
            });
    })

</script>

@endsection