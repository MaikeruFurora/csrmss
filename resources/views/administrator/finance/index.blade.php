@extends('../layout/app')
@section('title','Financial Report')
@section('content')
@include('administrator/partial/DeleteConfirmation')
<section class="section">
    <h2 class="section-title">Financial Report</h2>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12">
                <div class="card">
                   
                    <div class="card-body">
                         <table class="table table-striped mt-4 table-bordered">
                             <thead>
                                 <tr>
                                     <th>#</th>
                                     <th>Service</th>
                                     <th>Total</th>
                                     <th>Amount</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <tr>
                                     <td>1</td>
                                     <td>Baptism</td>
                                     <td></td>
                                     <td></td>
                                     
                                 </tr>
                                 <tr>
                                    <td>2</td>
                                    <td>Confirmation</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Wedding</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Mass</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>Burial</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                             </tbody>
                         </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Filter Report</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Type</label>
                            <select class="custom-select" name="type">
                                <option value=""> Choose type... </option>
                                <option value="Monthly">Monthly</option>
                                <option value="Annually">Annually</option>
                                <option value="Date Range">Date Range</option>
                            </select>
                           
                        </div>
                       
                        <div class="show"></div>
                        <div class="DateRange">
                            <label>Select Date range</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="datepicker1" placeholder="Date From" name="from">
                                <input type="text" class="form-control" id="datepicker2" placeholder="Date to" name="to">
                            </div>
                        </div>
                        <button class="btn btn-block btn-info mt-4">Generate</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('moreJs')
    <script>
        $(".DateRange").hide();
        $("select[name='type']").on('change',function(){
        hold ='';
        let makeYear = '';
            const d = new Date();
            let year = d.getFullYear();
        // alert($(this).val())
        switch ($(this).val()) {
            case 'Monthly':
                    hold= `
                    <div class="form-group">
                        <label>Select Month</label>
                        <select class="custom-select" name="month">
                            <option value="">Choose month..</option>
                            <option value="January">January</option>
                            <option value="Febuary">Febuary</option>
                            <option value="March">March</option>
                            <option value="April">April</option>
                            <option value="May">May</option>
                            <option value="June">June</option>
                            <option value="July">July</option>
                            <option value="August">August</option>
                            <option value="September">September</option>
                            <option value="October">October</option>
                            <option value="November">November</option>
                            <option value="December">December</option>
                        </select>
                    </div>
                    `;
                    $(".DateRange").hide();
                    $(".show").html(hold)
                break;
            case 'Annually':
            
            for(let i = 2021; i <= year; i++) {
                
                makeYear+=`<option value="${i}">${i}</option>`
                
            }
            hold= `
                    <div class="form-group">
                        <label>Select Year</label>
                        <select class="custom-select" name="month">
                            <option value="">Choose year..</option>
                            ${makeYear}
                        </select>
                    </div>
                    `;
                    $(".DateRange").hide();
                    $(".show").html(hold)
                break;
            case 'Date Range':
                $(".DateRange").show();
                $(".show").html('')
                var currentDate = new Date();
                $('#datepicker1').datepicker({
                    dateFormat: "yy-mm-dd",
                        autoclose:true,
                        endDate: "currentDate",
                        maxDate: currentDate
                }).on('changeDate', function (ev) {
                    $(this).datepicker('hide');
                });
                $('#datepicker1').keyup(function () {
                    if (this.value.match(/[^0-9]/g)) {
                        this.value = this.value.replace(/[^0-9^-]/g, '');
                    }
                });

                $('#datepicker2').datepicker({
                    dateFormat: "yy-mm-dd",
                        autoclose:true,
                        endDate: "currentDate",
                        maxDate: currentDate
                }).on('changeDate', function (ev) {
                    $(this).datepicker('hide');
                });
                $('#datepicker2').keyup(function () {
                    if (this.value.match(/[^0-9]/g)) {
                        this.value = this.value.replace(/[^0-9^-]/g, '');
                    }
                });
                break;
        
            default:
                    return false;
                break;

            
        }

        })


       

    </script>
@endsection