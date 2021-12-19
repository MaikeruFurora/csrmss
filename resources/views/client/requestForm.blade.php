@extends('../layoutClient/app')
@section('content')
<section class="section">

    <div class="section-body">
        <h2 class="section-title">REGISTER FORM</h2>
       <div class="row">
        <div class="col-lg-8 col-md-8 col-sm 12">
            <div class="card">
                <div class="card-header">
                    <h4>Form</h4>
                </div>
                <div class="card-body">
                    <form id="formRequest" method="POST" action="{{ route('client.registerStore') }}">@csrf
                      <input type="hidden" name="client_id" value="{{ auth()->user()->id }}">
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label >Fullname</label>
                            <input type="text" readonly value="{{ ucwords(auth()->user()->fullname) }}" class="form-control" >
                          </div>
                          <div class="form-group col-md-3">
                            <label >Contact No.</label>
                            <input type="text" readonly value="{{ auth()->user()->contact_no }}" class="form-control">
                          </div>
                          <div class="form-group col-md-3">
                            <label >Service</label>
                            <input type="text" readonly value="{{ $type }}" class="form-control" name="service">
                          </div>
                        </div>
                        <hr>
                       <div class="form-row">
                        <div class="form-group col-6">
                          <h6 >Set schedule</h6>
                          <input type="text" class="form-control" id="datepicker" name="schedule_date" required>
                          <button type="submit" class="btn btn-primary mt-4 btn-block btnSave">Request</button>
                        </div>
                        <div class="form-group col-6">
                          <h6 for="" class="pl-3">Reminder</h6>
                          <p class="pl-3" style="text-align: justify;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas rerum provident totam alias aut, inventore consequatur blanditiis vitae eos saepe, quasi modi, reiciendis eius maxime? Sint velit asperiores saepe error!</p>
                        </div>
                      </div>
                      </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm 12">
            <div class="card">
                <div class="card-header">
                    <h4>Previous Activity</h4>
                </div>
                <div class="card-body p-0">
                    <table class="table table-bordered">
                     <thead>
                      <tr>
                        <th>Date request</th>
                        <th>Status</th>
                      </tr>
                     </thead>
                     @forelse ($data as $item)
                         <tr>
                           <td>{{ $item->schedule_date }}</td>
                           <td>
                             @if ($item->status=='Pending')
                                 <span class="badge badge-warning">Pending</span>
                                 @else
                                 <span class="badge badge-success">Approved</span>
                             @endif
                           </td>
                         </tr>
                     @empty
                     <tr>
                      <td colspan="2" class="text-center">No data</td>
                    </tr>
                     @endforelse
                    </table>
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
          dateFormat: "mm/dd/yy",
          minDate: +1,  
        });
    </script>
@endsection