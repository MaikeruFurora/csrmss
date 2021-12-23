@extends('../layout/app')
@section('title','Dashboard')
@section('content')
@include('administrator/partial/DeleteConfirmation')
<section class="section">
<h2 class="section-title">BAPTISM REGISTRATION FORM</h2>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                       <h4>&nbsp;&nbsp; </h4>
                    </div>
                    <div class="card-body"> 
                        <form id="baptismForm">
                          @csrf
                          <input type="hidden" name="id" value="{{ $baptism->id }}">
                          <h4>Child Information</h4>

                            <div class="form-row">
                              <div class="col-md-4 mb-3">
                                <label >First name</label>
                                <input type="text" class="form-control"  name="child_first_name" value="{{ $baptism->child_first_name }}"  required>
                              </div>
                              <div class="col-md-4 mb-3">
                                <label >Middle name</label>
                                <input type="text" class="form-control"  name="child_middle_name" value="{{ $baptism->child_middle_name }}"  >
                              </div>
                              <div class="col-md-4 mb-3">
                                <label >Last name</label>
                                <input type="text" class="form-control"  name="child_last_name" value="{{ $baptism->child_last_name }}"  required>
                              </div>
                            </div>
                           
                             <div class="form-row">
                              <div class="col-md-2 mb-3">
                                <label >Date of Birth</label>
                                <input type="date" class="form-control"  name="child_date_of_birth" value="{{ $baptism->child_date_of_birth }}"  required>
                              </div>
                              <div class="col-md-2 mb-3">
                                <label >Gender</label>
                               <select  class="custom-select" name="child_gender" value="{{ $baptism->child_gender }}">
                                 <option >Choose Gender</option>
                                 <option value="Male">Male</option>
                                 <option value="Female">Female</option>
                               </select>
                              </div>
                              <div class="col-md-4 mb-3">
                                <label >Birth of Place</label>
                                <input type="text" class="form-control"   required name="child_birth_of_place" value="{{ $baptism->child_birth_of_place }}">
                              </div>
                              <div class="col-md-4 mb-3">
                                <label >Complete Address</label>
                                <input type="text" class="form-control"   required name="child_complete_address" value="{{ $baptism->child_complete_address }}">
                              </div>
                            </div>

                            <hr>
                            <h4>Parent's Information</h4>

                            <div class="form-row">
                              <div class="col-md-3 mb-3">
                                <label >Mother's first name</label>
                                <input type="text" class="form-control"   required name="parent_mother_first_name" value="{{ $baptism->parent_mother_first_name }}">
                              </div>
                              <div class="col-md-3 mb-3">
                                <label >Mother's middle name</label>
                                <input type="text" class="form-control"    name="parent_mother_middle_name" value="{{ $baptism->parent_mother_middle_name }}">
                              </div>
                              <div class="col-md-3 mb-3">
                                <label >Mother's last name</label>
                                <input type="text" class="form-control"   required name="parent_mother_last_name" value="{{ $baptism->parent_mother_last_name }}">
                              </div>
                              <div class="col-md-3 mb-3">
                                <label >Contact No.</label>
                                <input type="text" maxlength="11" onkeypress="return numberOnly(event)" class="form-control"    name="parent_mother_contact_no" value="{{ $baptism->parent_mother_contact_no }}">
                              </div>
                            </div>
                           
                            <div class="form-row">
                              <div class="col-md-3 mb-3">
                                <label >Father's first name</label>
                                <input type="text" class="form-control"   required name="parent_father_first_name" value="{{ $baptism->parent_father_first_name }}">
                              </div>
                              <div class="col-md-3 mb-3">
                                <label >Father's middle name</label>
                                <input type="text" class="form-control"    name="parent_father_middle_name" value="{{ $baptism->parent_father_middle_name }}">
                              </div>
                              <div class="col-md-3 mb-3">
                                <label >Father's last name</label>
                                <input type="text" class="form-control"   required name="parent_father_last_name" value="{{ $baptism->parent_father_last_name }}">
                              </div>
                              <div class="col-md-3 mb-3">
                                <label >Contact No.</label>
                                <input type="text" maxlength="11" onkeypress="return numberOnly(event)" class="form-control"    name="parent_father_contact_no" value="{{ $baptism->parent_father_contact_no }}">
                              </div>
                            </div>
                            <div class="form-group">
                              <label >Complete Address</label>
                              <input type="text" class="form-control"   required name="parent_complete_address" value="{{ $baptism->parent_complete_address }}">
                            </div>

                            <hr>
                            <h4>GodMother's Information</h4>

                            <div class="form-row">
                              <div class="col-md-3 mb-3">
                                <label >Mother's first name</label>
                                <input type="text" class="form-control"   required name="god_father_first_name" value="{{ $baptism->god_father_first_name }}">
                              </div>
                              <div class="col-md-3 mb-3">
                                <label >Mother's middle name</label>
                                <input type="text" class="form-control"    name="god_father_middle_name" value="{{ $baptism->god_father_middle_name }}">
                              </div>
                              <div class="col-md-3 mb-3">
                                <label >Mother's last name</label>
                                <input type="text" class="form-control"   required name="god_father_last_name" value="{{ $baptism->god_father_last_name }}">
                              </div>
                              <div class="col-md-3 mb-3">
                                <label >Contact No.</label>
                                <input type="text" maxlength="11" onkeypress="return numberOnly(event)" class="form-control"    name="god_father_contact_no" value="{{ $baptism->god_father_contact_no }}">
                              </div>
                            </div>
                            <div class="form-group">
                              <label >Complete Address</label>
                              <input type="text" class="form-control"   required name="god_mother_complete_address" value="{{ $baptism->god_mother_complete_address }}">
                            </div>


                            <hr>
                            <h4>GodFather's Information</h4>

                            <div class="form-row">
                              <div class="col-md-3 mb-3">
                                <label >Father's first name</label>
                                <input type="text" class="form-control"   required name="god_mother_first_name" value="{{ $baptism->god_mother_first_name }}">
                              </div>
                              <div class="col-md-3 mb-3">
                                <label >Father's middle name</label>
                                <input type="text" class="form-control"    name="god_mother_middle_name" value="{{ $baptism->god_mother_middle_name }}">
                              </div>
                              <div class="col-md-3 mb-3">
                                <label >Father's last name</label>
                                <input type="text" class="form-control"   required name="god_mother_last_name" value="{{ $baptism->god_mother_last_name }}">
                              </div>
                              <div class="col-md-3 mb-3">
                                <label >Contact No.</label>
                                <input type="text" maxlength="11" onkeypress="return numberOnly(event)" class="form-control"    name="god_mother_contact_no" value="{{ $baptism->god_mother_contact_no }}">
                              </div>
                            </div>
                            <div class="form-group">
                              <label >Complete Address</label>
                              <input type="text" class="form-control"   required name="god_father_complete_address" value="{{ $baptism->god_father_complete_address }}">
                            </div>

                            <hr>
                            <h4>Schedule Date & Time</h4>
                            <div class="form-row">
                              <div class="col-md-3 mb-3">
                                <label >Date Selected</label>
                                <input type="text" class="form-control"  id="datepicker"  required name="scheduled_date" value="{{ $baptism->start_date }}">
                              </div>
                              <div class="col-md-3 mb-3">
                                <label >Time from</label>
                                <input type="time"  step='1' min="00:00:00" max="20:00:00" class="form-control"   required name="scheduled_time_form" value="{{ $baptism->start_time }}">
                              </div>
                              <div class="col-md-3 mb-3">
                                <label >Time to</label>
                                <input type="time"  step='1' min="00:00:00" max="20:00:00" class="form-control"   required name="scheduled_time_to" value="{{ $baptism->end_time }}">
                              </div>
                              <div class="col-md-3 mb-3">
                                <label >Date Baptized</label>
                                <input type="date" class="form-control"    name="baptized" value="{{ $baptism->baptized }}">
                              </div>
                            </div>

                            <button class="btn btn-info mt-5 btnSave" type="submit">Update record</button>
                            <a href="{{ url()->previous() }}" class="btn btn-warning mt-5 ml-2 pl-4 pr-4">Back</a>
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
$("#baptismForm").on('submit',function(e){
  e.preventDefault();
  $.ajax({
        url: "/admin/report/baptism/store",
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
            document.getElementById("baptismForm").reset();
            getToast("success", "Done", "Successsfuly Save new record");
            $("input[name='id']").val("");
            $(".btnSave").html("Update Record").attr("disabled", false);
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            getToast("error", "Eror", errorThrown);
            $(".btnSave").html("Update Record").attr("disabled", false);
        });
})

</script>

@endsection