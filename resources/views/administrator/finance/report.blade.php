<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>REPORT</title>
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <style>
         @page { margin: 0px; }
        body { margin: 0px; }
    </style>
</head>
<body>
    <div class="jumbotron text-white p-3" style="background-color: #2065A8; border-top-left-radius:0px;border-top-right-radius:0px
    ; border-bottom-left-radius:0px;border-bottom-right-radius:0px">
        <div class="row">
            <div class="col-sm-4 text-left">
                <img class="mt-2" src="{{ asset('image/'.$church_logo) }}" alt="" width="80">
                <h2 class="mt-">Report<small>2021</small></h2>
            </div>
            <div class="col-sm-4 offset-sm-4 text-right"  style="float: right">
                <p class="lead" class="mt-5" style="font-size:16px;margin-top: 15px">{{ $church_name }}</p>
                <p class="lead" style="font-size:12px;margin-top: -10px">{{ $church_address }}</p>
                {{-- <p class="lead" style="font-size:12px;margin-top: -10px">Municipality of Pili</p> --}}
                <p class="lead" style="font-size:12px;margin-top: -10px">Philippines</p>
            </div>
        </div>
      </div>
      <table style="margin-top: -5px" width="100%" class="table table-borderless">
         
          <tr>
              <td width="15%" class="text-left"><b>Report No. :</b></td>
              <td  class="text-left">{{ rand(100,500)."-".rand(10000,50000) }}</span></td>
         
            <td width="20%" class="text-right"><b>Date:</b></td>
            <td  class="text-left">{{ date("F j,Y") }}</span></td>
        </tr>

      </table>
      <table width="100%" class="table mt-4 table-borderless">
        <thead class="border">
            <tr>
                <th width="5%">No.</th>
                <th width="20%">Service</th>
                <th width="20%">Amount</th>
                <th width="11%">Count</th>
                <th width="20%">Total Amount</th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <td>1</td>
                    <td>Baptism</td>
                    <td><span class="badge badge-danger"> 250.00</span></td>
                    <td><span class="badge badge-primary showTotalBaptism">{{ $data->baptism ?? 0  }}</span></td>
                    <td><span class="badge badge-info showAmountBaptism">{{ empty($data->baptism)? 0 :($data->baptism * 250).'.00' }}</span></td>
                    
                </tr>
                <tr>
                   <td>2</td>
                   <td>Confirmation</td>
                   <td><span class="badge badge-danger"> 150.00</span></td>
                   <td><span class="badge badge-primary showTotalConfirmation">{{ $data->confirmation ?? 0  }}</span></td>
                   <td><span class="badge badge-info showAmountConfirmation">{{empty($data->confirmation)? 0 :($data->confirmation * 150).'.00'}}</span></td>
               </tr>
               <tr>
                   <td>3</td>
                   <td>Wedding</td>
                   <td><span class="badge badge-danger"> 500.00</span></td>
                   <td><span class="badge badge-primary showTotalWedding">{{ $data->wedding ?? 0  }}</span></td>
                   <td><span class="badge badge-info showAmountWedding">{{ empty($data->wedding)? 0 :($data->wedding * 500).'.00' }}</span></td>
               </tr>
               <tr>
                   <td>4</td>
                   <td>Mass</td>
                   <td><span class="badge badge-danger"> 100.00</span></td>
                   <td><span class="badge badge-primary showTotalMass">{{ $data->mass ?? 0  }}</span></td>
                   <td><span class="badge badge-info showAmountMass">{{ empty($data->mass)? 0 :($data->mass * 100).'.00' }}</span></td>
               </tr>
               <tr>
                   <td>5</td>
                   <td>Burial</td>
                   <td><span class="badge badge-danger"> 100.00</span></td>
                   <td><span class="badge badge-primary showTotalBurial">{{ $data->burial ?? 0  }}</span></td>
                   <td><span class="badge badge-info showAmountBurial">{{ empty($data->burial)? 0 :($data->burial * 100).'.00' }}</span></td>
               </tr>
             
            <tr>
                <td colspan="3" style="background: #BCDFF5;">
                    <small><b>Notes:</b></small><br>
                    <small>Get some color inspiration with Color Hunt's green palettes collection and find the perfect scheme for your design or art project.</small>
                </td>
                <td colspan="2" style="background: #2065A8;color:white"><b>Total amount:</b><br>
                    {{-- <h1>₱ {{ $total.".00" }}</h1>     --}}
                    <h1>{{  ($data->baptism * 250)+($data->confirmation * 150)+($data->wedding * 500)+($data->mass * 100)+($data->burial * 100) }}.00</h1>
                </td>
            </tr>
        </tbody>
      </table>
      <div class="text-center">
        <img class="mt-4" src="{{ asset('image/'.$church_logo) }}" alt="" width="50">
        <h6 class="">Report<small>2021</small></h6>
        <small>If you have any enqueries concerning this <br> report, please contact us!</small>
      </div>
</body>
</html>