@extends('../layout/app')
@section('title','Dashboard')
@section('content')
@include('administrator/partial/DeleteConfirmation')
<section class="section">
<h2 class="section-title">MASS REGISTRATION FORM</h2>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                  
                    <div class="card-body mt-4"> 
                        <form id="burialForm">
                            @csrf
                            <input type="hidden" name="id">
                            <h4>Mass Information</h4>
                           <div class="row">
                                <div class="col-md-6 mt-4">
                                    <label for="">Request By</label>
                                    <input type="text" class="form-control" required name="request_by">
                                </div>
                           </div>
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
                            <div class="show"></div>
                            <h4>Schedule Date & Time</h4>
                            <div class="form-row">
                              <div class="col-md-4 mb-3">
                                <label for="">Date Selected</label>
                                <input type="text" id="datepicker" class="form-control"  required name="scheduled_date">
                              </div>
                              <div class="col-md-4 mb-3">
                                <label for="">Time from</label>
                                <input type="time"  step='1' min="00:00:00" max="20:00:00" class="form-control"  required name="scheduled_time_form">
                              </div>
                              <div class="col-md-4 mb-3">
                                <label for="">Time to</label>
                                <input type="time"  step='1' min="00:00:00" max="20:00:00" class="form-control"  required name="scheduled_time_to">
                              </div>
                            </div>
                           

                            <button class="btn btn-info mt-5 btnSave" type="submit">Register</button>
                            <a href="{{ url()->previous() }}" class="btn btn-warning mt-5 ml-2">Cancel</a>
                        </form>  
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
</script>
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

$("#datepicker1").datepicker({
    dateFormat: "yy-mm-dd",
    minDate: +1,  
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