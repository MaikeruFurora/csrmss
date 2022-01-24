@extends('../layout/app')
@section('title','System Log')
@section('moreCss')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
@endsection
@section('content')
<section class="section">
    <h2 class="section-title">System Log</h2>
    <div class="section-body">
        <div class="row">
           <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4>Monitor</h4>
                </div>
                <div class="card-body">
                    <form action="" id="dateForm">
                        <div class="input-group mb-4">
                            <div class="input-group-prepend">
                              <span class="input-group-text bg-secondary"><b>Date from</b></span>
                            </div>
                            <input type="text" id="datepicker1" name="from" required class="form-control">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-secondary"><b>Date to</b></span>
                              </div>
                            <input type="text" id="datepicker2" name="to" required class="form-control">
                            <button type="submit" class="btn btn-primary">Search&nbsp;&nbsp;<em>(filter)</em></button>
                          </div>
                      </form>
                    <table class="table" id="logtable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Log</th>
                                <th>Duration</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
           </div>
        </div>
    </div>
</section>
@endsection
@section('moreJs')
<script src="{{ asset('assets/modules/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('assets/modules/jquery-ui/jquery-ui.min.js') }}"></script>
<script>
   let currentDate = new Date();
    $('#datepicker1').datepicker({
        dateFormat: "yy-mm-dd",
            autoclose:true,
            endDate: "currentDate",
            maxDate: currentDate,
            beforeShow: function() {
                $(this).datepicker('option', 'maxDate', $('#datepicker2').val());
            }
    }).on('changeDate', function (ev) {
        $(this).datepicker('hide');
    });
    $('#datepicker1').keyup(function () {
        if (this.value.match(/[^0-9]/g)) {
            this.value = this.value.replace(/[^0-9^-]/g, '');
        }
    });
    $('#datepicker1').on('click',function () {
        $('#datepicker2').val('')
    });

    $('#datepicker2').datepicker({
        dateFormat: "yy-mm-dd",
        // autoclose:true,
        // endDate: "currentDate",
        // maxDate: currentDate,
        beforeShow: function() {
        $(this).datepicker('option', 'minDate', $('#datepicker1').val());
        if ($('#datepicker1').val() === '') $(this).datepicker('option', 'minDate', 0);                             
                }
    })
    setTimeout(() => {
        let logTable = $("#logtable").DataTable({
        pageLenth: 10,
        processing: true,
        language: {
            processing: `
                <div class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only">Loading...</span>
              </div>`,
        },

        ajax: `activity/log/${null}/${null}`,
        columns: [
            { data: "id" },
            { data: "log" },
            { data: "date" },
        ],
    });

    $("#dateForm").submit(function(e){
        e.preventDefault();
        let from = $("input[name='from']").val();
        let to = $("input[name='to']").val();
        if (to!="") {
            logTable.ajax.url(`activity/log/${from}/${to}`).load()
        }
    })
    
            
    }, 4000);

</script>
@endsection
