@extends('../layout/app')
@section('title','Dashboard')
@section('content')
@include('administrator/partial/DeleteConfirmation')
<section class="section">
<h2 class="section-title">WEDDING REGISTRATION FORM</h2>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card card-primary">
                    <div class="card-header">
                       <h4>&nbsp;&nbsp; </h4>
                    </div>
                    <div class="card-body"> 
                        <form id="weddingForm">
                            @csrf
                            <input type="hidden" name="id">
                            <h4>Bride's Information</h4>

                            <div class="form-row">
                              <div class="col-md-3 mb-3">
                                <label for="">Bride's first name</label>
                                <input type="text" class="form-control" id="" value="" required name="bride_first_name">
                              </div>
                              <div class="col-md-3 mb-3">
                                <label for="">Bride's middle name</label>
                                <input type="text" class="form-control" id="" value=""  name="bride_middle_name">
                              </div>
                              <div class="col-md-3 mb-3">
                                <label for="">Bride's last name</label>
                                <input type="text" class="form-control" id="" value="" required name="bride_last_name">
                              </div>
                              <div class="col-md-3 mb-3">
                                <label for="">Contact No.</label>
                                <input type="text" maxlength="11" onkeypress="return numberOnly(event)" class="form-control" id="" value=""  name="bride_contact_no">
                              </div>
                            </div>
                            <div class="form-group">
                                <label for="">Complete Address</label>
                                <input type="text" class="form-control" id="" value="" required name="bride_complete_address">
                              </div>

                            <hr>
                            <h4>Groom's Information</h4>
                           
                            <div class="form-row">
                              <div class="col-md-3 mb-3">
                                <label for="">Groom's first name</label>
                                <input type="text" class="form-control" id="" value="" required name="groom_first_name">
                              </div>
                              <div class="col-md-3 mb-3">
                                <label for="">Groom's middle name</label>
                                <input type="text" class="form-control" id="" value=""  name="groom_middle_name">
                              </div>
                              <div class="col-md-3 mb-3">
                                <label for="">Groom's last name</label>
                                <input type="text" class="form-control" id="" value="" required name="groom_last_name">
                              </div>
                              <div class="col-md-3 mb-3">
                                <label for="">Contact No.</label>
                                <input type="text" maxlength="11" onkeypress="return numberOnly(event)" class="form-control" id="" value=""  name="groom_contact_no">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="">Complete Address</label>
                              <input type="text" class="form-control" id="" value="" required name="groom_complete_address">
                            </div>


                            <hr>
                            <h4>Schedule Date & Time</h4>
                            <div class="form-row">
                              <div class="col-md-4 mb-3">
                                <label for="">Date Selected</label>
                                <input type="text" id="datepicker" class="form-control" id="" value="" required name="scheduled_date">
                              </div>
                              <div class="col-md-4 mb-3">
                                <label for="">Time from</label>
                                <input type="time" step='1' min="00:00:00" max="20:00:00" class="form-control" id="" value="" required name="scheduled_time_form">
                              </div>
                              <div class="col-md-4 mb-3">
                                <label for="">Time to</label>
                                <input type="time" step='1' min="00:00:00" max="20:00:00" class="form-control" id="" value="" required name="scheduled_time_to">
                              </div>
                            </div>

                            <button class="btn btn-info mt-5 btnSave" type="submit">Register</button>
                            <a href="{{ url()->previous() }}" class="btn btn-warning mt-5 pl-3 pr-3">Cancel</a>
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
                document.getElementById("weddingForm").reset();
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