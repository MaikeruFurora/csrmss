@extends('../layoutClient/app')
@section('content')

<section class="section">

    <div class="section-body">
        <h2 class="section-title">Profile</h2>
       <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="card">
                <div class="card-header">
                    Information
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('client.profile.information',auth()->user()->id) }}">@csrf
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label>Name</label>
                            <input type="text" class="form-control" value="{{ auth()->user()->fullname }}" name="fullname">
                            @error('fullname') <span class="text-danger">{{ $message }}</span> @enderror
                          </div>
                          <div class="form-group col-md-6">
                            <label for="COntact">Contact No.</label>
                            <input type="text" class="form-control" id="COntact" value="{{ auth()->user()->contact_no }}" name="contact_no">
                            @error('contact_no') <span class="text-danger">{{ $message }}</span> @enderror
                          </div>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Address</label>
                            <input type="text" class="form-control" id="inputAddress" value="{{ auth()->user()->address }}" name="address">
                            @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                              <label>Email</label>
                              <input type="text" class="form-control" value="{{ auth()->user()->email }}" name="email">
                               @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group col-md-6">
                              <label for="COntact">Username</label>
                              <input type="text" class="form-control" id="COntact" value="{{ auth()->user()->username }}" name="username">
                               @error('username') <span class="text-danger">{{ $message }}</span> @enderror
                               <span class="uniqueUsername"></span>
                            </div>
                          </div>
                          <button type="submit" class="btn btn-primary float-right">Update</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            @if (Session::has('msg'))
            <div class="alert alert-warning" role="alert">
                  {{ Session::get('msg') }}
              </div>
            @endif
            <div class="card">
                <div class="card-header">
                    Account
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('client.profile.account') }}">@csrf
                        <div class="form-group row">
                          <label  class="col-sm-3 col-form-label">Current Password</label>
                          <div class="col-sm-9">
                            <input type="password" class="form-control" name="current_password">
                             @error('current_password') <span class="text-danger">{{ $message }}</span> @enderror
                          </div>
                        </div>
                        <div class="form-group row">
                          <label  class="col-sm-3 col-form-label">New Password</label>
                          <div class="col-sm-9">
                            <input type="password" class="form-control" name="new_password">
                             @error('new_password') <span class="text-danger">{{ $message }}</span> @enderror
                          </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-sm-3 col-form-label">Confirm Password</label>
                            <div class="col-sm-9">
                              <input type="password" class="form-control" name="confirm_password">
                               @error('confirm_password') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                          </div>
                          <button type="submit" class="btn btn-primary float-right">Change Password</button>
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
        $('input[name="username"]').on('keyup',function(){
            $.ajax({
                url: "/client/profile/check/username/" + $(this).val(),
                type: "GET",
            })
                .done(function (response) {
                    if(response.msg){
                        $(".uniqueUsername").text(response.msg).removeClass('text-success').addClass('text-danger');
                        $('input[name="username"]').removeClass('is-valid').addClass('is-invalid');
                        $('.btnSave').attr('disabled',true);
                    }else{
                        $(".uniqueUsername").text('Available').removeClass('text-danger').addClass('text-success');
                        $('input[name="username"]'). removeClass('is-invalid').addClass('is-valid');
                        $('.btnSave').attr('disabled',false);
                    }
                })
                .fail(function (jqxHR, textStatus, errorThrown) {
                    console.log(jqxHR, textStatus, errorThrown);
                    // getToast("error", "Eror", errorThrown);
                });
        });
    </script>
@endsection