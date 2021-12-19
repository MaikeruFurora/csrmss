@extends('../layout/app')
@section('title','Create Record')
@section('content')
@include('administrator/partial/DeleteConfirmation')
<section class="section">
<h2 class="section-title">CONFIRMATION REGISTRATION FORM</h2>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                  
                    <div class="card-body mt-4"> 
                        <form id="burialForm">
                            @csrf
                            <input type="hidden" name="id">
                            <h4>Confirmation Information</h4>
                         
                            <div class="form-row mt-4">
                              <div class="col-md-4 mb-3">
                                <label for="">First name</label>
                                <input type="text" class="form-control"  required name="confirmation_first_name">
                              </div>
                              <div class="col-md-4 mb-3">
                                <label for="">Middle name</label>
                                <input type="text" class="form-control"   name="confirmation_middle_name">
                              </div>
                              <div class="col-md-4 mb-3">
                                <label for="">Last name</label>
                                <input type="text" class="form-control"  required name="confirmation_last_name">
                              </div>
                             
                              </div>
                              
                              <div class="form-row mt-4">
                                <div class="col-md-4 mb-3">
                                    <label for="">Select Gender</label>
                                      <select required name="confirmation_gender" class="custom-select" >
                                          <option value="">-- Choose --</option>
                                          <option value="Male">Male</option>
                                          <option value="Female">Female</option>
                                      </select>
                                     
                                  </div>
                                  <div class="col-md-4 mb-3">
                                    <label for="">Age</label>
                                    <input type="text"maxlength="2" onkeypress="return numberOnly(event)" maxlength="2" class="form-control"   name="confirmation_age">
                                  </div>
                                  <div class="col-md-4 mb-3">
                                    <label for="">Contact No.</label>
                                    <input type="text" maxlength="11" onkeypress="return numberOnly(event)" class="form-control"  required name="confirmation_contact_no">
                                  </div>
                              </div>
                              <br>
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
                            </div>
                            
                           

                           
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