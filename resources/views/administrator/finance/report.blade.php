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
                <h2 class="mt-">Report<small>{{ date('Y') }}</small></h2>
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
        @if ($type=="Monthly")
        <tr>
            <td width="15%" class="text-left"><b>Month :</b></td>
            <td  class="text-left">
                {{ date("F", mktime(0, 0, 0, explode("_",$logic)[0], 10)) }} -  {{ explode("_",$logic)[1] }} </span></td>
        </tr>
        @elseif($type=="Annually")
        <tr>
            <td width="15%" class="text-left"><b>Year :</b></td>
            <td  class="text-left">{{ $logic }}</span></td>
        </tr>
        @else
        <tr>
            <td width="15%" class="text-left"><b>Date range:</b></td>
            <td  class="text-left">{{ explode("_",$logic)[0] }} | {{ explode("_",$logic)[1] }}</span></td>
        </tr>
        @endif
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
            @php
                function whatType($type,$data){
                    switch($type){
                        case 'Baptism':
                            return $data->baptism;
                        break;
                        case 'Confirmation':
                            return $data->confirmation;
                        break;
                        case 'Burial':
                            return $data->burial;
                        break;
                        case 'Mass':
                            return $data->mass;
                        break;
                        case 'Wedding':
                            return $data->wedding;
                        break;
                        default:
                            return false;
                        break;
                    }
                }

                function typeAmount($type,$data){
                    switch($type->service){
                        case 'Baptism':
                            return empty($data->baptism)? 0 : $data->baptism*$type->amount;
                        break;
                        case 'Confirmation':
                            return empty($data->confirmation)? 0 : $data->confirmation*$type->amount;
                        break;
                        case 'Burial':
                            return empty($data->burial)? 0 : $data->burial*$type->amount;
                        break;
                        case 'Mass':
                            return empty($data->mass)? 0 : $data->mass*$type->amount;
                        break;
                        case 'Wedding':
                            return empty($data->wedding)? 0 : $data->wedding*$type->amount;
                        break;
                        default:
                            return false;
                        break;
                    }
                }

                function computeMyAmount($type,$data){
                    $sum=$bap=$mass=$con=$bur=$wed=0;
                   b:foreach ($type as $key => $value) {
                    if ($value->service=='Baptism') {
                        $bap=empty($data->baptism)? 0 : $data->baptism*$value->amount;
                    }elseif ($value->service=='Burial') {
                        $bur=empty($data->burial)? 0 : $data->burial*$value->amount;
                    } elseif ($value->service=='Mass') {
                        $mass=empty($data->mass)? 0 : $data->mass*$value->amount;
                    } elseif ($value->service=='Confirmation') {
                        $con=empty($data->confirmation)? 0 : $data->confirmation*$value->amount;
                    } elseif ($value->service=='Wedding') {
                        $wed=empty($data->wedding)? 0 : $data->wedding*$value->amount;
                    }
                   }
                   return $sum=intval($bap)+intval($mass)+intval($con)+intval($bur)+intval($wed);

                }
            @endphp
            @foreach ($amount as $key=> $item)
            <tr>
                {{-- {{ dd($data->Baptism) }} --}}
                <td>{{ ++$key }}</td>
                <td>{{ $item->service }}</td>
                <td><span class="badge badge-danger">{{ $item->amount }}.00</span></td>
                <td><span class="badge badge-primary showTotalBaptism">{{ whatType($item->service,$data) ?? 0  }}</span></td>
                <td><span class="badge badge-info showAmountBaptism">{{ typeAmount($item,$data).'.00' }}</span></td>
            </tr>
            
            @endforeach
            <tr>
                <td colspan="3" style="background: #BCDFF5;">
                    <small><b>Notes:</b></small><br>
                    <small>Get some color inspiration with Color Hunt's green palettes collection and find the perfect scheme for your design or art project.</small>
                </td>
                <td colspan="2" style="background: #2065A8;color:white"><b>Total amount:</b><br>
                    {{-- <h1>₱ {{ $total.".00" }}</h1>     --}}
                    <h1>{{ computeMyAmount($amount,$data) }}.00</h1>
                </td>
            </tr>
        </tbody>
      </table>
      <div class="text-center">
        <img class="mt-4 mb-1" src="{{ asset('image/'.$church_logo) }}" alt="" width="50">
        <h6 class="">Report<small>{{ date('Y') }}</small></h6>
        <small>If you have any enqueries concerning this <br> report, please contact us!</small>
      </div>
</body>
</html>