@extends('../layout/app')
@section('title','Financial Report')
@section('content')
@include('administrator/partial/DeleteConfirmation')
<section class="section">
    <h2 class="section-title">Financial Report</h2>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12">
                <div class="card card-primary shadow">
                   
                    <div class="card-body">
                         <table class="table table-striped mt-4 table-bordered text-center">
                             <thead>
                                 <tr class="bg-secondary">
                                     <th>#</th>
                                     <th>Service</th>
                                     <th>Amount</th>
                                     <th>Total</th>
                                     <th>Total Amount</th>
                                     {{-- <th>Report</th> --}}
                                 </tr>
                             </thead>
                             <tbody>
                                 @foreach ($amount as $key=> $item)
                                 <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $item->service }}</td>
                                    <td><span class="badge badge-danger">₱ {{ $item->amount }}.00</span></td>
                                    <td><span class="badge badge-primary showTotal{{ ucfirst($item->service) }}"></span></td>
                                    <td><span class="badge badge-info showAmount{{ ucfirst($item->service) }}"></span></td>
                                    </tr>    
                                 @endforeach
                                 
                                <tr class="bg-secondary">
                                    <td colspan="3" class="text-right text-dark"><b>TOTAL</b></td>
                                    <td><span class="badge badge-dark showTotal"></span></td>
                                    <td><span class="badge badge-dark showAmount"></span></td>
                                    {{-- <td></td> --}}
                                </tr>
                             </tbody>
                         </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-primary shadow">
                    <div class="card-header">
                        <h4>Filter Report</h4>
                    </div>
                    <form action="" id="formFinance">@csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>Type</label>
                                <select class="custom-select" name="type" required>
                                    <option value=""> Choose type... </option>
                                    <option value="Monthly">Monthly</option>
                                    <option value="Annually">Annually</option>
                                    <option value="Date_Range">Date Range</option>
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
                            <button type="submit" class="btn btn-block btn-info mt-4 btnSave">Generate</button>
                            
                        </div>
                    </form>
                </div>
                <div class="card mt-2 shadow cardPDF">
                    <div class="card-body">
                        <span class="badge badge-secondary text-dark toBePrint"></span>
                        <span class="badge badge-secondary text-dark text-right"><b>Generated</b>: {{ date("F j, Y"); }}</span><hr>
                        <button type="submit" class="btn btn-block btn-success mt-2 gPDF"><i class="far fa-file-pdf"></i> Download report (PDF format) </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('moreJs')

    <script>

        let myamount = JSON.parse(`<?=json_encode($service)?>`);

        $(".DateRange").hide();
        $("select[name='type']").on('change',function(){
        hold ='';
        let makeYear = '';
            const d = new Date();
            let year = d.getFullYear();
        // alert($(this).val())
        
        switch ($(this).val()) {
            case 'Monthly':
                  for(let i = 2021; i <= year; i++) { makeYear+=`<option value="${i}">${i}</option>`}
                    hold= `
                    <div class="form-row">
                        <div class="form-group col-6">
                        <label>Select Month</label>
                        <select class="custom-select" name="month">
                            <option value="">Choose month..</option>
                            <option value="01">January</option>
                            <option value="02">Febuary</option>
                            <option value="03">March</option>
                            <option value="04">April</option>
                            <option value="05">May</option>
                            <option value="06">June</option>
                            <option value="07">July</option>
                            <option value="08">August</option>
                            <option value="09">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                    </div>
                    
                    <div class="form-group col-6">
                        <label>Select Year</label>
                        <select class="custom-select" name="year">
                            <option value="">Choose year..</option>
                            ${makeYear}
                        </select>
                    </div>
                    </div>
                    `;
                    $(".show").html(hold)

                    $(".DateRange").hide();
                    $(".show").html(hold)
                break;
            case 'Annually':
             for(let i = 2021; i <= year; i++) { makeYear+=`<option value="${i}">${i}</option>`}
            hold= `
                    <div class="form-group">
                        <label>Select Year</label>
                        <select class="custom-select" name="year">
                            <option value="">Choose year..</option>
                            ${makeYear}
                        </select>
                    </div>
                    `;
                    $(".DateRange").hide();
                    $(".show").html(hold)
                break;
            case 'Date_Range':
                $(".DateRange").show();
                $(".show").html('')
                var currentDate = new Date();
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
                // .on('changeDate', function (ev) {
                //     $(this).datepicker('hide');
                // });
                // $('#datepicker2').keyup(function () {
                //     if (this.value.match(/[^0-9]/g)) {
                //         this.value = this.value.replace(/[^0-9^-]/g, '');
                //     }
                // });
                break;
        
            default:
                    return false;
                break;

            
        }
        })


       $("#formFinance").submit(function(e){
           e.preventDefault();
           $.ajax({
                url:'report/'+$('select[name="type"]').val(),
                type:'POST',
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                beforeSend: function () {
                    $(".btnSave")
                        .html(
                            `Generating ...
                            <div class="spinner-border spinner-border-sm" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>`
                        )
                        .attr("disabled", true);
                },
           }) .done(function (data) {
                toBeText($('select[name="type"]').val())
                // document.getElementById("formFinance").reset();
                $(".btnSave").html("Generate").attr("disabled", false);
                MainFunction(data);
                $('.cardPDF').show();
            })
            .fail(function (jqxHR, textStatus, errorThrown) {
                getToast("error", "Eror", errorThrown);
                $(".btnSave").html("Generate").attr("disabled", false);
            });
       })

        // $('.btnBaptism').hide();
        // $('.btnConfirmation').hide();
        // $('.btnWedding').hide();
        // $('.btnMass').hide();
        // $('.btnBurial').hide();
        $('.cardPDF').hide();

       let MainFunction = (data) =>{
           let total = '';
           let amount = '';
            total=parseInt(data.baptism ?? 0)+parseInt(data.confirmation ?? 0)+parseInt(data.wedding ?? 0)+parseInt(data.mass ?? 0)+parseInt(data.burial ?? 0)
           
            amount=
            parseInt(parseInt(data.baptism ?? 0) * parseInt(myamount[0].amount))+
            parseInt(parseInt(data.burial ?? 0) * parseInt(myamount[1].amount))+
            parseInt(parseInt(data.confirmation ?? 0) * parseInt(myamount[2].amount))+
            parseInt(parseInt(data.wedding ?? 0) * parseInt(myamount[3].amount))+
            parseInt(parseInt(data.mass ?? 0) * parseInt(myamount[4].amount))

            $(".showTotal").text(!isNaN(total)?total:'N/A')
            $(".showAmount").text(amount+'.00')

            if (data.baptism==null || data.baptism==0) {
                // $('.btnBaptism').hide();
                $('.showTotalBaptism').text('0')
                $('.showAmountBaptism').text('₱ 0.00')
            } else {
                $('.btnBaptism').show();
                $('.showTotalBaptism').text(data.baptism)
                $('.showAmountBaptism').text('₱ '+(parseInt(data.baptism)*parseInt(myamount[0].amount)).toString()+'.00')
                $('.btnBaptism').on('click',function(){
                    popupCenter({
                        url: "/admin/finance/report/print/dasda",
                        title: "report",
                        w: 1400,
                        h: 800,
                    });
                })
            }

            if (data.confirmation==null || data.confirmation==0) {
                // $('.btnConfirmation').hide();
                $('.showTotalConfirmation').text('0')
                $('.showAmountConfirmation').text('₱ 0.00')
            } else {
                $('.btnConfirmation').show();
                $('.showTotalConfirmation').text(data.confirmation)
                $('.showAmountConfirmation').text('₱ '+(parseInt(data.confirmation)*parseInt(myamount[2].amount)).toString()+'.00')
            }

            if (data.wedding==null || data.wedding==0) {
                $('.showTotalWedding').text('0')
                // $('.btnWedding').hide();
                $('.showAmountWedding').text('₱ 0.00')
            } else {
                $('.showTotalWedding').text(data.wedding)
                $('.btnWedding').show();
                $('.showAmountWedding').text('₱ '+(parseInt(data.wedding)*parseInt(myamount[3].amount)).toString()+'.00')
            }

            if (data.mass==null || data.mass==0) {
                $('.showTotalMass').text('0')
                // $('.btnMass').hide();
                $('.showAmountMass').text('₱ 0.00')
            } else {
                $('.showTotalMass').text(data.mass)
                $('.btnMass').show();
                $('.showAmountMass').text('₱ '+(parseInt(data.mass)*parseInt(myamount[4].amount)).toString()+'.00')
            }

            if (data.burial==null || data.burial==0) {
                $('.showTotalBurial').text('0')
                // $('.btnBurial').hide();
                $('.showAmountBurial').text('₱ 0.00')
            } else {
                $('.showTotalBurial').text(data.burial)
                $('.btnBurial').show();
                $('.showAmountBurial').text('₱ '+(parseInt(data.burial)*parseInt(myamount[1].amount)).toString()+'.00')
            }

            
       }

       let toBeText=(type)=>{
           let tobePrint = '';
            switch (type) {
                case 'Monthly':
                    tobePrint='<b>Month</b>: '+$('select[name="month"] option:selected').text()
                    break;
                case 'Annually':
                    tobePrint='<b>Year</b>: '+$('select[name="year"]').val()
                    break;
                case 'Date_Range':
                    tobePrint='<b>Date</b>: '+$('input[name="from"]').val()+'-'+$('input[name="to"]').val()
                    break;
                default:
                    break;
            }
            $('.toBePrint').html(tobePrint);
       }

       $(".gPDF").on('click',function(e){
           e.preventDefault();
           let myData='';
           let type=$('select[name="type"]').val();
            switch ($('select[name="type"]').val()) {
                case 'Monthly':
                    myData=$('select[name="month"]').val()+'_'+$('select[name="year"]').val();
                    break;
                case 'Annually':
                    myData=$('select[name="year"]').val();
                    break;
                case 'Date_Range':
                    myData=$('input[name="from"]').val()+'_'+$('input[name="to"]').val();
                    break;
                default:
                    return false;
                    break;
            }


            window.open(`report/pdf/${type}/${myData}`,'_blank')

        //    $.ajax({
        //         url:'report/pdf/'+type+"/"+myData,
        //         type:'GET',
        //         beforeSend: function () {
        //             $(".gPDF")
        //                 .html(
        //                     `Donwloading ...
        //                     <div class="spinner-border spinner-border-sm" role="status">
        //                         <span class="sr-only">Loading...</span>
        //                     </div>`
        //                 )
        //                 .attr("disabled", true);
        //         },
        //    }) .done(function (data) {
        //         $(".gPDF").html("Download report (PDF format)").attr("disabled", false);
             
        //     })
        //     .fail(function (jqxHR, textStatus, errorThrown) {
        //         // getToast("error", "Eror", errorThrown);
        //         $(".gPDF").html("Download report (PDF format)").attr("disabled", false);
        //     });
       })

    </script>
@endsection