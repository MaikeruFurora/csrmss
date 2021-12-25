@extends('../layout/app')
@section('title','Manage User')
@section('content')
@include('administrator/partial/DeleteConfirmation')
@include('administrator/partial/UpdateUserProfile')
@include('administrator/partial/changeUserPassword')
<section class="section">
    <h2 class="section-title">Manage User</h2>
    <div class="section-body">
        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12">
                <div class="card card-primary">
                    <div class="card-header">
                       <h4>User list</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="10%">#</th>
                                    <th>Fullname</th>
                                    <th>Email</th>
                                    <th>Username</th>
                                    <th width="25%">Action</th>
                                </tr>
                            </thead>
                            <tbody id="tableUser">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-8 col-sm-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>User Form</h4>
                    </div>
                    <div class="card-body">
                       <form id="userForm"> @csrf
                        <input type="hidden" name="id">
                        <div class="form-group">
                            <label >Fullname</label>
                            <input class="form-control" type="text" required name="name">
                        </div>
                        <div class="form-group">
                            <label >Email</label>
                            <input class="form-control" type="email" required name="email">
                        </div>
                        <div class="form-group">
                            <label >Username</label>
                            <input class="form-control" type="text" required name="username">
                        </div>
                        <div class="form-group">
                            <label >Password</label>
                            <input class="form-control" type="password" required name="password">
                        </div>
                        <div class="form-group">
                            <label >Confirm Password</label>
                            <input class="form-control" type="password" required name="confirm_password">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-info btn-lg btnSave">Add user</button>
                            <button type="button" class="btn btn-block btn-warning btn-lg btnCancel">Cancel</button>
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
        let user_id = $("input[name='user_id']").val();
        let tableUser=()=>{
            let meHOld='';
            $.ajax({
                url:'user/list',
                type:'GET',
                dataType:'json',
                beforeSend: function () {
                $("#tableUser").html(
                    `<tr>
                            <td colspan="5" class="text-center">
                                <div class="spinner-border spinner-border-sm" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </td>
                        </tr>
                        `
                );
        },
            }).done(function(data){
                if (data.length!=0) {
                    data.forEach((element,i) => {
                        meHOld+=`
                            <tr>
                               <td>${++i}</td>
                               <td>${element.name}</td>
                               <td>${element.email}</td>
                               <td>${element.username}</td>
                               <td>
                                ${ (element.id==user_id)?
                                `
                                <div class="btn-group" role="group">
                                    <button id="btnGroupDrop1" type="button" class="btn pl-4 pr-4 btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="far fa-edit"></i> Edit 
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                        <a class="dropdown-item edit" id="${element.id}" style="cursor: pointer"> <i class="far fa-edit"></i> Update Profile</a>
                                        <a class="dropdown-item change change_${element.id}" id="${element.id}" style="cursor: pointer"> <i class="fas fa-key"></i> Change Password</a>
                                       
                                    </div>
                                </div>
                                ` :
                                        '-- Restricted --'
                                    }
                                </td>
                            </tr>
                        `;
                    });
                    //<a class="dropdown-item delete delete_${element.id}" id="${element.id}" style="cursor: pointer">Delete</a>
                }else{
                    meHOld=`<tr>
                            <td colspan="5" class="text-center">
                                No Data Available
                            </td>
                        </tr>`;
                }
                $("#tableUser").html(meHOld)
            }).fail(function (jqxHR, textStatus, errorThrown) {
                getToast("error", "Eror", errorThrown);
            });
        }


        tableUser();

    $("#userForm").submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: "user/store",
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
                document.getElementById("userForm").reset();
                $("input[name='id']").val("");
                $(".btnSave").html("Add user").attr("disabled", false);
                $(".btnCancel").hide();
                tableUser();
            })
            .fail(function (jqxHR, textStatus, errorThrown) {
                getToast("error", "Eror", errorThrown);
                $(".btnSave").html("Add user").attr("disabled", false);
            });
    });
    $(".btnCancel").hide();
    $(".btnCancel").on("click", function (e) {
        e.preventDefault();
        $(this).hide();
        document.getElementById("userForm").reset();
        $(".btnSave").html("Add user");
        $("input[name='id']").val("");
    });

    $(document).on("click", ".edit", function () {
        let id= $(this).attr("id")
        $.ajax({
            url: "user/edit/" + id,
            type: "GET",
            data: { _token: $('input[name="_token"]').val() },
            // beforeSend: function () {
            //     $(".edit_" + id).html(`
            //     <div class="spinner-border spinner-border-sm" role="status">
            //         <span class="sr-only">Loading...</span>
            //     </div>`);
            // },
        })
            .done(function (data) {
                $("#updateProfileModal").modal("show")
                // $(".btnCancel").show();
                // $(".edit_" + id).html(`<i class="far fa-edit"></i>`);
                $(".btnSave").html("Update user");
                $("input[name='update_id']").val(data.id);
                $("input[name='update_name']").val(data.name);
                $("input[name='update_email']").val(data.email);
                $("input[name='update_username']").val(data.username);
            })
            .fail(function (jqxHR, textStatus, errorThrown) {
                console.log(jqxHR, textStatus, errorThrown);
                getToast("error", "Eror", errorThrown);
            });
    });

    $(document).on('click','.delete',function(){
        let id=$(this).attr("id");
        $("#deleteModal").modal("show")
        $(".yesConfirm").val(id)
    })

    $(".yesConfirm").on('click',function(){
        $.ajax({
            url: "user/delete/" + $(this).val(),
            type: "DELETE",
            data: { _token: $('input[name="_token"]').val() },
            beforeSend: function () {
                $(".yesConfirm").html(`
                <div class="spinner-border spinner-border-sm" role="status">
                    <span class="sr-only">Loading...</span>
                </div>`);
            },
        })
            .done(function (response) {
                $(".yesConfirm").html("Delete");
                getToast("success", "Success", "deleted one record");
                tableUser();
                $("#deleteModal").modal("hide")
            })
            .fail(function (jqxHR, textStatus, errorThrown) {
                console.log(jqxHR, textStatus, errorThrown);
                getToast("error", "Eror", errorThrown);
            });
    })

    $("#updateProfile").submit(function(e){
        e.preventDefault();
        let id=$("input[name='update_id']").val();
        $.ajax({
            url: "user/update/profile/"+id,
            type: "POST",
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function () {
                $(".btnUpdateProfile")
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
                $('.btnUpdateProfile').html('Save changes').attr("disabled", false)
                // document.getElementById("updateProfile").reset();
                if (data.msg) {
                    getToast("warning", "Warning", data.msg);
                } else {
                    $("input[name='update_id']").val("");
                    getToast("info", "Done", "Successfuly updated your record");

                    tableUser();
                    $("#updateProfileModal").modal("hide")
                }
            })
            .fail(function (jqxHR, textStatus, errorThrown) {
                getToast("error", "Eror", errorThrown);
                $(".btnUpdateProfile").html("Save changes").attr("disabled", false);
            });
    })

    $(document).on('click','.change',function(){
        $("#chagepasswordModal").modal("show");
    })

    $("#changePasswordForm").submit(function(e){
        e.preventDefault();
        let change_new_password = $("input[name='change_new_password']").val();
        let change_confirm_password = $("input[name='change_confirm_password']").val();

        if (change_new_password==change_confirm_password) {     
            $.ajax({
                url: "user/change/password",
                type: "POST",
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                beforeSend: function () {
                    $(".btnChangePassword")
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
                    $('.btnChangePassword').html('Change Password').attr("disabled", false)
                    // document.getElementById("updateProfile").reset();
                    if (data.msg) {
                        getToast("warning", "Warning", data.msg);
                    } else {
                        $("input[name='update_id']").val("");
                        getToast("info", "Done", "Successfuly updated your record");
                        tableUser();
                        $("#chagepasswordModal").modal("hide")
                    }
                })
                .fail(function (jqxHR, textStatus, errorThrown) {
                    getToast("error", "Eror", errorThrown);
                    $(".btnChangePassword").html("Change Password").attr("disabled", false);
                });
        } else {
            getToast("warning", "Warning", 'Confirm password did not match');
        }
      
    })
</script>
@endsection