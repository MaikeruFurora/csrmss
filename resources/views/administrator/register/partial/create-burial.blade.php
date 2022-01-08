@extends('../layout/app')
@section('title','Create Record')
@section('content')
<section class="section">
    
    <h2 class="section-title">Create Record | Burial</h2>
    
    <div class="section-body">
        @include('administrator/partial/clientRequestInfo')
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card card-primary">
                    <div class="card-header">
                       <h4>&nbsp;&nbsp; </h4>
                    </div>
                    <div class="card-body"> 
                      <form id="burialForm">
                          @csrf
                          <input type="hidden" name="register_service_id" value="{{ $regiterservice->id }}">
                          <input type="hidden" name="id" value="{{ $data->id ?? '' }}">
                          <h4>Burial Information</h4>

                          <div class="form-row">
                            <div class="col-md-3 mb-3">
                              <label for="">First name</label>
                              <input type="text" class="form-control"   required name="burial_first_name" value="{{ $data->burial_first_name ?? '' }}">
                            </div>
                            <div class="col-md-3 mb-3">
                              <label for="">Middle name</label>
                              <input type="text" class="form-control"    name="burial_middle_name" value="{{ $data->burial_middle_name ?? '' }}">
                            </div>
                            <div class="col-md-3 mb-3">
                              <label for="">Last name</label>
                              <input type="text" class="form-control"   required name="burial_last_name" value="{{ $data->burial_last_name ?? '' }}">
                            </div>
                            <div class="col-md-3 mb-3">
                              <label for="">Gender</label>
                              <select class="custom-select" name="burial_gender" value="{{ $data->burial_gender ?? '' }}">
                                <option value="">Choose Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                              </select>
                            </div>
                          </div>
                          <div class="form-group">
                              <label for="">Complete Address</label>
                              <input type="text" class="form-control"   required name="burial_complete_address" value="{{ $data->burial_complete_address ?? '' }}">
                          </div>

                          <div class="form-row">
                              <div class="col-md-6 mb-3">
                                <label for="">Date of Birth</label>
                                <input type="date" class="form-control"   required name="burial_birth_of_date" value="{{ $data->burial_birth_of_date ?? '' }}">
                              </div>
                              <div class="col-md-6 mb-3">
                                <label for="">Birth Place</label>
                                <input type="text" class="form-control"    name="burial_birth_of_place" value="{{ $data->burial_birth_of_place ?? '' }}">
                              </div>
                          </div>
                         
                          <div class="form-row">
                              <div class="col-md-6 mb-3">
                                  <label for="">Date Died</label>
                                  <input type="date" class="form-control"   required name="burial_date_died" value="{{ $data->burial_date_died ?? '' }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                  <label for="">Place Died</label>
                                  <input type="text" class="form-control"   required name="burial_place_died" value="{{ $data->burial_place_died ?? '' }}">
                                </div>
                          </div>

                          <hr>
                          <h4>Schedule Date & Time</h4>
                          <div class="form-row">
                            <div class="col-md-4 mb-3">
                              <label for="">Date Selected</label>
                              <input type="text" id="datepicker" class="form-control"   required name="scheduled_date" value="{{ $data->start_date ?? date("Y- m-d",strtotime($regiterservice->schedule_date)) }}">
                            </div>
                            <div class="col-md-4 mb-3">
                              <label for="">Time from</label>
                              <input type="time"  step='1' min="00:00:00" max="20:00:00" class="form-control"   required name="scheduled_time_form" value="{{ $data->start_time ?? '' }}">
                            </div>
                            <div class="col-md-4 mb-3">
                              <label for="">Time to</label>
                              <input type="time"  step='1' min="00:00:00" max="20:00:00" class="form-control"   required name="scheduled_time_to" value="{{ $data->end_time ?? '' }}">
                            </div>
                          </div>

                          <button class="btn btn-info mt-5 btnSave" type="submit">Submit Record</button>
                          <a href="{{ route('admin.registered.client') }}" class="btn btn-warning mt-5 ml-2 pl-4 pr-4">Back</a>
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