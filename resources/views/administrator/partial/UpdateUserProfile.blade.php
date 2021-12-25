<form id="updateProfile">@csrf
    <div class="modal fade" id="updateProfileModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="updateProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateProfileModalLabel">Update Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="update_id">
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="update_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="eamil" name="update_email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Username</label>
                        <input type="text" name="update_username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Enter your password</label>
                        <input type="password" name="update_password" class="form-control" required>
                    </div>
                    <small><b>Note</b>: Please enter your password for verification before you preoceed</small>
                </div>
                <div class="modal-footer p-2">
                    <button type="submit" class="btn btn-success btnUpdateProfile" >Save changes</button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</form>
