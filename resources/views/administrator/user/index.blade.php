@extends('../layout/app')
@section('title','Users')
@section('content')
@include('administrator/partial/DeleteConfirmation')
<section class="section">
    <h2 class="section-title">Manage User</h2>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12">
                <div class="card">
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
                <div class="card">
                    <div class="card-header">
                        <h4>User Form</h4>
                    </div>
                    <div class="card-body">
                       <form id="priestForm"> @csrf
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
                                    <button value="${element.id}" class="btn btn-info edit edit_${element.id}">Edit</button>
                                    <button value="${element.id}" class="btn btn-danger delete delete_${element.id}">Delete</button>
                                </td>
                            </tr>
                        `;
                    });
                    
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

$("#priestForm").submit(function (e) {
    e.preventDefault();
    $.ajax({
        url: "/user/store",
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
            document.getElementById("priestForm").reset();
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
    document.getElementById("priestForm").reset();
    $(".btnSave").html("Add user");
    $("input[name='id']").val("");
});

$(document).on("click", ".edit", function () {
    let id= $(this).val()
    $.ajax({
        url: "user/edit/" + id,
        type: "GET",
        data: { _token: $('input[name="_token"]').val() },
        beforeSend: function () {
            $(".edit_" + id).html(`
            <div class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only">Loading...</span>
            </div>`);
        },
    })
        .done(function (data) {
            $(".btnCancel").show();
            $(".edit_" + id).html(`Edit`);
            $(".btnSave").html("Update user");
            $("input[name='id']").val(data.id);
            $("input[name='name']").val(data.name);
            $("input[name='email']").val(data.email);
            $("input[name='username']").val(data.username);
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            console.log(jqxHR, textStatus, errorThrown);
            getToast("error", "Eror", errorThrown);
        });
});

$(document).on('click','.delete',function(){
    $("#deleteModal").modal("show")
    $(".yesConfirm").val($(this).val())
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
    </script>
@endsection