@extends('../layout/app')
@section('title','System Profile')
@section('content')
<section class="section">
  <h2 class="section-title">System Profile</h2>

    <div class="section-body">
       <div class="row">
           <div class="col-md-6 offset-md-3">
            @if (session()->has('msg'))
            <div class="alert alert-success alert-has-icon">
                <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                <div class="alert-body">
                    <div class="alert-title">Success</div>
                    {{  session()->get('msg') }}
                </div>
            </div>
        @endif
               <div class="card">
              
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
                        
                          <button class="btn btn-block btn-info">Update Profile</button>
                     </form>
                </div>
               </div>

            <div class="row">
              <div class="col-lg-4">
                <div class="card">
                  <div class="card-header">
                    Church Logo
                  </div>
                  <div class="card-body">
                     <img class="img-thumbnail" src="{{ isset($data->church_logo) ? asset('image/'.$data->church_logo):'' }}" alt="">
                  </div>
                </div>
              </div>
            </div>
           </div>
       </div>
    </div>
</section>
@endsection