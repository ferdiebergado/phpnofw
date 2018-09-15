<!-- ID -->
<div class="form-group">
  <label class="col-sm-2 control-label">ID</label>
  <div class="col-sm-8">
    <div class="box box-solid box-default no-margin">
      <div class="box-body">
        <?= $_SESSION['USER_ID'] ?? '(New)' ?>
      </div>
    </div>
  </div>
</div>
<!-- /ID -->

<!-- NAME -->
<div class="form-group <?php if (isset($_SESSION['errors']['name'])) { echo 'has-error'; } ?>">
  <label for="name" class="col-sm-2 control-label">Name</label>
  <div class="col-sm-8">
    <div class="input-group">
      <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
      <input type="text" class="form-control" placeholder="Name" name="name" value="<?= $_SESSION['name'] ?? $_SESSION['USER_NAME']; ?>" maxlength="150" required autofocus>
    </div>
  </div>
  <?php if (isset($_SESSION['errors']['name'])): ?>
    <span class="help-block" role="alert">
      <small class="text-danger"><?= $_SESSION['errors']['name'] ?></small>
    </span>
    <?php unset($_SESSION['errors']['name']); endif; ?>
  </div>
  <!-- /NAME -->

  <!-- EMAIL -->
  <div class="form-group <?php if (isset($_SESSION['errors']['email'])) { echo 'has-error'; } ?>">
    <label for="email" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-8">
      <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
        <input id="email" type="email" class="form-control" placeholder="Email" name="email" value="<?= $_SESSION['email'] ?? $_SESSION['USER_EMAIL']; ?>" maxlength="150" required>
      </div>
      <?php if (isset($_SESSION['errors']['email'])): ?>
        <span class="help-block" role="alert">
          <small class="text-danger"><?= $_SESSION['errors']['email'] ?></small>
        </span>
        <?php unset($_SESSION['errors']['email']); endif; ?>
      </div>
    </div>
    <!-- /EMAIL -->

    <!-- OLD PASSWORD -->
    <div class="form-group <?php if (isset($_SESSION['errors']['old_password'])) { echo 'has-error'; } ?>">
      <label for="old_password" class="col-sm-2 control-label">Current Password</label>
      <div class="col-sm-8">
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-eye-slash"></i></span>
          <input type="password" class="form-control" placeholder="Current Password"
          name="old_password" maxlength="150">
        </div>
        <?php if (isset($_SESSION['errors']['old_password'])): ?>
          <span class="help-block" role="alert">
            <small class="text-danger"><?= $_SESSION['errors']['old_password'] ?></small>
          </span>
          <?php unset($_SESSION['errors']['old_password']); endif; ?>
        </div>
      </div>
      <!-- /OLD PASSWORD -->

      <!-- PASSWORD -->
      <div class="form-group <?php if (isset($_SESSION['errors']['password'])) { echo 'has-error'; } ?>">
        <label for="password" class="col-sm-2 control-label">New Password</label>
        <div class="col-sm-8">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-eye-slash"></i></span>
            <input type="password" class="form-control" placeholder="New Password"
            name="password" maxlength="150">
          </div>
          <?php if (isset($_SESSION['errors']['password'])): ?>
            <span class="help-block" role="alert">
              <small class="text-danger"><?= $_SESSION['errors']['password'] ?></small>
            </span>
            <?php unset($_SESSION['errors']['password']); endif; ?>
          </div>
        </div>
        <!-- /PASSWORD -->

        <!-- PASSWORD CONFIRMATION -->
        <div class="form-group <?php if (isset($_SESSION['errors']['password_confirmation'])) { echo 'has-error'; } ?>">
          <label for="password_confirmation" class="col-sm-2 control-label">Confirm Password</label>
          <div class="col-sm-8">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-eye-slash"></i></span>
              <input type="password" class="form-control" placeholder="Confirm Password"
              name="password_confirmation" maxlength="150">
            </div>
            <?php if (isset($_SESSION['errors']['password_confirmation'])): ?>
              <span class="help-block" role="alert">
                <small class="text-danger"><?= $_SESSION['errors']['password_confirmation'] ?></small>
              </span>
              <?php unset($_SESSION['errors']['password_confirmation']); endif; ?>
            </div>
          </div>
          <!-- /PASSWORD CONFIRMATION -->

          <!-- CREATED AT -->
          <div class="form-group">
            <label class="col-sm-2 control-label">Created at</label>
            <div class="col-sm-8">
              <div class="box box-solid box-default no-margin">
                <div class="box-body">
                  <?= $_SESSION['USER_CREATED_AT'] ?? '(New)'; ?>
                </div>
              </div>
            </div>
          </div>
          <!-- /CREATED AT -->

          <div class="box-footer">
            <div class="col-md-2"></div>
            <div class="col-md-8">
              <div class="btn-group pull-right">
                <button type="submit" class="btn btn-info pull-right" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Submit">Submit</button>
              </div>
              <div class="btn-group pull-left">
                <button type="reset" class="btn btn-warning">Reset</button>
              </div>
            </div>
          </div>
        </div>
        <?= csrf_token(); ?>
      </form>
