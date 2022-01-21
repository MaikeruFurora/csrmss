@extends('../layout/app')
@section('title','System Profile')
@section('moreCss')
     <link rel="stylesheet" href="{{ asset('css/summernote-bs4.css') }}">
@endsection
@section('content')
<section class="section">
  <h2 class="section-title">System Profile</h2>

    <div class="section-body">
       <div class="row">
           <div class="col-md-10 offset-md-1">
                @if (session()->has('msg'))
                      <div class="alert alert-success alert-has-icon">
                          <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                          <div class="alert-body">
                              <div class="alert-title">Success</div>
                              {{  session()->get('msg') }}
                          </div>
                      </div>
                  @endif
              
                <div class="row">
                  <div class="col-lg-8">
                    <div class="card card-primary">
                  
                      <div class="card-body pt-4">
                           <form id="profileForm" enctype="multipart/form-data" method="POST" action="{{ route('admin.profile.store') }}">@csrf
                               <input type="hidden" name="id" value="{{ $data->id ?? '' }}">
                              <div class="form-group">
                                  <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text bg-primary text-white" id="inputGroupPrepend">Church Name</span>
                                      </div>
                                      <input type="text" name="church_name" value="{{ $data->church_name ?? '' }}" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                                      <div class="invalid-feedback">
                                        Please choose a username.
                                      </div>
                                    </div>
                              </div>
                             
                              <div class="form-group">
                                  <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text bg-primary text-white" id="inputGroupPrepend">Address &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                      </div>
                                      <input type="text" name="church_address" value="{{ $data->church_address ?? '' }}" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                                      <div class="invalid-feedback">
                                        Please choose a username.
                                      </div>
                                    </div>
                              </div>
      
                              <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text bg-primary text-white" id="inputGroupFileAddon01">Upload Logo</span>
                                  </div>
                                  <div class="custom-file">
                                    <input type="file"  name="church_logo" accept=".jpg,.jpeg,.png"  class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                  </div>
                                </div>
                                <hr>
                                <label for="">For landing Page | History</label>
                                <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text bg-primary text-white" id="inputGroupFileAddon01">Church Image</span>
                                  </div>
                                  <div class="custom-file">
                                    <input type="file"  name="church_image" accept=".jpg,.jpeg,.png"  class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                  </div>
                                </div>
                                <textarea name="church_body" class="summernote-simple"  data-height="30" required>{{ $data->church_body ?? '' }}</textarea>
                                <button class="btn btn-block btn-info">Update Profile</button>
                           </form>
                      </div>
                     </div>
                   </div>
                   <div class="col-lg-4">
                    <div class="card card-primary">
                   
                      <div class="card-body text-center">
                        <label for=""><b>Current Logo</b></label><br>
                         <img width="70%" class="img-thumbnail" src="{{ isset($data->church_logo) ? asset('image/'.$data->church_logo):'' }}" alt="">
                      </div>

                    </div>
                    <div class="card card-primary">
                   
                      <div class="card-body text-center">
                        <label for=""><b>Current Image</b></label><br>
                         <img width="100%" class="img-thumbnail" src="{{ isset($data->church_image) ? asset('image/'.$data->church_image):'' }}" alt="">
                      </div>
                      
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-header">
                    <b>Services</b>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Service</th>
                            <th>Amount</th>
                            <th>Updated at</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($amount as $key => $item)
                          <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $item->service }}</td>
                            <td width="30%">
                              <div class="input-group">
                               
                                <div class="input-group-prepend">
                                  <span class="input-group-text bg-info text-white" id="basic-addon1">₱</span>
                                </div>
                                <input type="text" class="form-control where input_{{ $item->id }}" value="{{ $item->amount }}" disabled>
                                <div class="input-group-append">
                                  
                                  <button class="btn btn-primary edit edit_{{ $item->id }}" value="{{ $item->id }}" type="button"><i class="far fa-edit"></i> Edit</button>
                                  <button class="btn btn-success update update_{{ $item->id }}" value="{{ $item->id }}" type="button"><i class="fas fa-pencil-alt"></i> Update</button>
                                  <button class="btn btn-warning cancel cancel_{{ $item->id }}" type="button"><i class="far fa-window-close"></i> Cancel</button>
                                  {{-- <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                  <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                    <div role="separator" class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Separated link</a>
                                  </div> --}}
                                </div>
                              </div>
                            </td>
                            <td width="25%">
                              <span class="badge badge-primary"> {{ $item->updated_at->format("M, d Y") .'( '.$item->updated_at->diffForHumans().' )' }} </span>
                            </td>
                        </tr>
                          @endforeach
                      </tbody>
                      </table>
                    </div>
                  </div>
                </div>
           </div>
       </div>
    </div>
</section>
@endsection
@section('moreJs')
<script src="{{ asset('js/summernote-bs4.js') }}"></script>
<script>
  $(".cancel").hide();
  $(".update").hide();
  $('.edit').on('click',function(){
      $('.where').attr('disabled',true);
      $(".cancel").hide();
      $(".edit").show();
      $(".update").hide();
      $(".cancel_"+$(this).val()).show();
      $('.edit_'+$(this).val()).hide();
      $(".input_"+$(this).val()).attr('disabled',false);
      $('.update_'+$(this).val()).show()
  })
  $(".cancel").on('click',function(){
    $('.where').attr('disabled',true);
      $(".cancel").hide();
      $(".update").hide();
      $('.edit').show();
  })

  $(".update").on('click',function(){ 
    let id = $(this).val();
    $.ajax({
        url: "/admin/amount/update/" + id,
        type: "PUT",
        data: { 
          _token: $('input[name="_token"]').val(),
          amount:  $(".input_"+id).val()
        },
        beforeSend: function () {
            $(".update_"+id).html(`<i class="fas fa-spinner"></i>`);
        },
    })
        .done(function (response) {
            $(".update_"+id).html(`<i class="fas fa-pencil-alt"></i> Update`);
            $(".cancel").hide();
            $(".update").hide();
            $('.edit').show();
            getToast("success", "Success", "Updated one record");
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            console.log(jqxHR, textStatus, errorThrown);
            getToast("error", "Eror", errorThrown);
        });
  })

</script>
@endsection