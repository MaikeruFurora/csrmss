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
           <div class="col-md-8 offset-md-2">
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
                        <label for=""><b>Current Logo</b></label>
                         <img width="70%" class="img-thumbnail" src="{{ isset($data->church_logo) ? asset('image/'.$data->church_logo):'' }}" alt="">
                      </div>

                    </div>
                    <div class="card card-primary">
                   
                      <div class="card-body text-center">
                        <label for=""><b>Current Image</b></label>
                         <img width="100%" class="img-thumbnail" src="{{ isset($data->church_image) ? asset('image/'.$data->church_image):'' }}" alt="">
                      </div>
                      
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

@endsection