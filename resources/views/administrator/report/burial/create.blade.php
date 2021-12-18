@extends('../layout/app')
@section('title','Dashboard')
@section('content')
@include('administrator/partial/DeleteConfirmation')
<section class="section">
  <div class="section-header ">
    <h1 class="lead">BURIAL REGISTRATION FORM</h1>
</div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                       <h4>&nbsp;&nbsp; </h4>
                    </div>
                    <div class="card-body"> 
                        <form id="burialForm">
                            @csrf
                            <input type="hidden" name="id">
                            <h4>Burial Information</h4>

                            <div class="form-row">
                              <div class="col-md-3 mb-3">
                                <label for="">First name</label>
                                <input type="text" class="form-control"  required name="burial_first_name">
                              </div>
                              <div class="col-md-3 mb-3">
                                <label for="">Middle name</label>
                                <input type="text" class="form-control"   name="burial_middle_name">
                              </div>
                              <div class="col-md-3 mb-3">
                                <label for="">Last name</label>
                                <input type="text" class="form-control"  required name="burial_last_name">
                              </div>
                              <div class="col-md-3 mb-3">
                                <label for="">Gender</label>
                                <select class="custom-select" required name="burial_gender">
                                  <option value="">Choose Gender</option>
                                  <option value="Male">Male</option>
                                  <option value="Female">Female</option>
                                </select>
                              </div>
                            </div>
                            <div class="form-group">
                                <label for="">Complete Address</label>
                                <input type="text" class="form-control"  required name="burial_complete_address">
                            </div>

                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                  <label for="">Date of Birth</label>
                                  <input type="date" class="form-control"  required name="burial_birth_of_date">
                                </div>
                                <div class="col-md-6 mb-3">
                                  <label for="">Birth Place</label>
                                  <input type="text" class="form-control"   name="burial_birth_of_place">
                                </div>
                            </div>
                           
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="">Date Died</label>
                                    <input type="date" class="form-control"  required name="burial_date_died">
                                  </div>
                                  <div class="col-md-6 mb-3">
                                    <label for="">Place Died</label>
                                    <input type="text" class="form-control"  required name="burial_place_died">
                                  </div>
                            </div>

                            <hr>
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
 $("#burialForm").on('submit',function(e){
      e.preventDefault();
      $.ajax({
            url: "/admin/report/burial/store",
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