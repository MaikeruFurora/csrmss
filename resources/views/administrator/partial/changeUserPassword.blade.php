<form id="changePasswordForm">@csrf
    <div class="modal fade" id="chagepasswordModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="chagepasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="chagepasswordModalLabel">Change Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <input type="hidden" name="change_id">
                        <div class="form-group">
                            <label for="">Current Password</label>
                            <input type="password" name="current_password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">New Password</label>
                            <input type="password" name="change_new_password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Confirm Password</label>
                            <input type="password" name="change_confirm_password" class="form-control" required>
                        </div>
                        
                    <div class="modal-footer p-1">
                        <button type="submit" class="btn btn-success btnChangePassword" >Change Password</button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>