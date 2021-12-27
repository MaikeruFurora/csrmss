@extends('../layout/app')
@section('title','Manage Priest')
@section('content')
@include('administrator/partial/archiveModal')
<section class="section">
    <h2 class="section-title">Manage Priest</h2>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12">
                <div class="card card-primary">
                    <div class="card-header">
                       <h4>Priest</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="10%">#</th>
                                    <th>Fullname</th>
                                    <th width="30%">Action</th>
                                </tr>
                            </thead>
                            <tbody id="tablePriest">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-8 col-sm-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Priest Form</h4>
                    </div>
                    <div class="card-body">
                       <form id="priestForm"> @csrf
                        <input type="hidden" name="id">
                        <div class="form-group">
                            <label for="my-input">Fullname</label>
                            <input id="my-input" class="form-control" type="text" name="fullname">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-info btn-lg btnSave">Add priest</button>
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
        let tablePriest=()=>{
            let meHOld='';
            $.ajax({
                url:'priest/list',
                type:'GET',
                dataType:'json',
                beforeSend: function () {
                $("#tablePriest").html(
                    `<tr>
                            <td colspan="3" class="text-center">
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
                               <td>${element.fullname}</td>
                               <td>
                                    <button value="${element.id}" class="btn btn-info edit edit_${element.id}"><i class="far fa-edit"></i> Edit</button>
                                    <button value="${element.id}" class="btn btn-warning delete delete_${element.id}"><i class="far fa-folder-open"></i> Archive</button>
                                </td>
                            </tr>
                        `;
                    });
                    
                }else{
                    meHOld=`<tr>
                            <td colspan="3" class="text-center">
                                No Data Available
                            </td>
                        </tr>`;
                }
                $("#tablePriest").html(meHOld)
            }).fail(function (jqxHR, textStatus, errorThrown) {
                getToast("error", "Eror", errorThrown);
            });
        }


        tablePriest();

$("#priestForm").submit(function (e) {
    e.preventDefault();
    $.ajax({
        url: "priest/store",
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
            $(".btnSave").html("Add priest").attr("disabled", false);
            $(".btnCancel").hide();
            tablePriest();
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            getToast("error", "Eror", errorThrown);
            $(".btnSave").html("Add priest").attr("disabled", false);
        });
});
$(".btnCancel").hide();
$(".btnCancel").on("click", function (e) {
    e.preventDefault();
    $(this).hide();
    document.getElementById("priestForm").reset();
    $(".btnSave").html("Add priest");
    $("input[name='id']").val("");
});

$(document).on("click", ".edit", function () {
    let id= $(this).val()
    $.ajax({
        url: "priest/edit/" + id,
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
            $(".edit_" + id).html(`<i class="far fa-edit"></i> Edit`);
            $(".btnSave").html("Update priest");
            $("input[name='id']").val(data.id);
            $("input[name='fullname']").val(data.fullname);
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            console.log(jqxHR, textStatus, errorThrown);
            getToast("error", "Eror", errorThrown);
        });
});

$(document).on('click','.delete',function(){
    $("#archiveModal").modal("show")
    $(".yesConfirm").val($(this).val())
})

$(".yesConfirm").on('click',function(){
    $.ajax({
        url: "priest/delete/" + $(this).val(),
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
            $(".yesConfirm").html("Yes, Move to archive");
            getToast("success", "Success", "deleted one record");
            tablePriest();
            $("#archiveModal").modal("hide")
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            console.log(jqxHR, textStatus, errorThrown);
            getToast("error", "Eror", errorThrown);
        });
})
    </script>
@endsection