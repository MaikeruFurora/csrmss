@extends('../layout/app')
@section('title','Create Record')
@section('content')
<section class="section">
    
    <h2 class="section-title">Create Record | Mass</h2>
    
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
                          <h4>Mass Information</h4>
                         <div class="row">
                              <div class="col-md-6 mt-4">
                                  <label for="">Request By</label>
                                  <input type="text" class="form-control" required name="request_by" value="{{ $data->request_by ?? $clientData->fullname }}">
                              </div>
                         </div>
                        
                         @if ($data->mass_first_name ?? false)
                         @foreach ($data->mass_first_name as $key => $item)
                         <div class="form-row mt-4">
                          <div class="col-md-3 mb-3">
                            <label for="">First name</label>
                            <input type="text" class="form-control"  required name="mass_first_name[]" value="{{ $item }}">
                          </div>
                          <div class="col-md-3 mb-3">
                            <label for="">Middle name</label>
                            <input type="text" class="form-control"   name="mass_middle_name[]" value="{{ $data->mass_middle_name[$key] }}">
                          </div>
                          <div class="col-md-3 mb-3">
                            <label for="">Last name</label>
                            <input type="text" class="form-control"  required name="mass_last_name[]" value="{{ $data->mass_last_name[$key] }}">
                          </div>
                          <div class="col-md-3 mb-3">
                              <label for="">Select option</label>
                            <div class="input-group">
                                <select required name="mass_option[]" class="custom-select" id="inputGroupSelect04" aria-label="Example select with button addon">
                                    <option value="">-- Choose --</option>
                                    <option  {{ $data->mass_option[$key]=="Birthday" ? 'selected': ''}} value="Birthday">Birthday</option>
                                    <option  {{ $data->mass_option[$key]=="Health" ? 'selected': ''}} value="Health">Health</option>
                                    <option  {{ $data->mass_option[$key]=="Thanksgiving" ? 'selected': ''}} value="Thanksgiving">Thanksgiving</option>
                                    <option  {{ $data->mass_option[$key]=="Death Anniversary" ? 'selected': ''}} value="Death Anniversary">Death Anniversary</option>
                                    <option  {{ $data->mass_option[$key]=="Special Intensions" ? 'selected': ''}} value="Special Intensions">Special Intensions</option>
                                </select>
                                <div class="input-group-append">
                                  @if ($key==0)
                                  <button class="btn btn-info pl-5 pr-5 btnplus" type="button"><i class="fa fa-plus"></i></button>
                                  @else
                                  <button class="btn btn-danger pl-5 pr-5 btnminus" type="button"><i class="fa fa-minus"></i></button>
                                  @endif
                                </div>
                            </div>
                          </div>
                        </div>
                         @endforeach
                         @else
                         <div class="form-row mt-4">
                          <div class="col-md-3 mb-3">
                            <label for="">First name</label>
                            <input type="text" class="form-control"  required name="mass_first_name[]">
                          </div>
                          <div class="col-md-3 mb-3">
                            <label for="">Middle name</label>
                            <input type="text" class="form-control"   name="mass_middle_name[]">
                          </div>
                          <div class="col-md-3 mb-3">
                            <label for="">Last name</label>
                            <input type="text" class="form-control"  required name="mass_last_name[]">
                          </div>
                          <div class="col-md-3 mb-3">
                              <label for="">Select option</label>
                            <div class="input-group">
                                <select required name="mass_option[]" class="custom-select" id="inputGroupSelect04" aria-label="Example select with button addon">
                                    <option value="">-- Choose --</option>
                                    <option value="Birthday">Birthday</option>
                                    <option value="Health">Health</option>
                                    <option value="Thanksgiving">Thanksgiving</option>
                                    <option value="Death Anniversary">Death Anniversary</option>
                                    <option value="Special Intensions">Special Intensions</option>
                                </select>
                                <div class="input-group-append">
                                  <button class="btn btn-info pl-5 pr-5 btnplus" type="button"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                          
                          </div>
                        
                        </div>
                         @endif
                          <div class="show"></div>
                          <h4>Schedule Date & Time</h4>
                          <div class="form-row">
                            <div class="col-md-4 mb-3">
                              <label for="">Date Selected</label>
                              <input type="text" id="datepicker" class="form-control"  required name="scheduled_date" value="{{ $data->start_date ?? date("Y-m-d",strtotime($regiterservice->schedule_date)) }}">
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
                         

                          <button class="btn btn-info mt-5 btnSave" type="submit">Submit Record</button>
                          <a href="{{ route('admin.registered.client') }}" class="btn btn-warning mt-5 ml-2">Back</a>
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
  let count=1;
let hold='';

let dynamic_field  = (number) =>{
     hold=
     `
     <div class="rows_${number}">
      <hr><div class="form-row">
                    <div class="col-md-3 mb-3">
                    <label for="">First name</label>
                    <input type="text" class="form-control"  required name="mass_first_name[]">
                    </div>
                    <div class="col-md-3 mb-3">
                    <label for="">Middle name</label>
                    <input type="text" class="form-control"   name="mass_middle_name[]">
                    </div>
                    <div class="col-md-3 mb-3">
                    <label for="">Last name</label>
                    <input type="text" class="form-control"  required name="mass_last_name[]">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="">Select option</label>
                    <div class="input-group">
                        <select required name="mass_option[]" class="custom-select" id="inputGroupSelect04" aria-label="Example select with button addon">
                            <option value="">-- Choose --</option>
                            <option value="Birthday">Birthday</option>
                            <option value="Health">Health</option>
                            <option value="Thanksgiving">Thanksgiving</option>
                            <option value="Death Anniversary">Death Anniversary</option>
                            <option value="Special Intensions">Special Intensions</option>
                        </select>
                        <div class="input-group-append">
                            <button class="btn btn-danger pl-5 pr-5 btnminus" value="${number}" type="button"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    
                    </div>
                
                </div>
                
     </div>
     `;

                $(".show").append(hold);  
}

$(document).on('click','.btnminus',function(){
   $(".rows_"+$(this).val()).remove()
})

$(".btnplus").on('click',function(){
    count++;
    dynamic_field(count)
});

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

        $("#burialForm").on('submit',function(e){
          e.preventDefault();
          $.ajax({
                url: "/admin/report/mass/store",
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
                    $(".btnSave").html("Register").attr("disabled", false);
                });
        })

</script>

@endsection