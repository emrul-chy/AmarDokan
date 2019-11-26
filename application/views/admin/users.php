
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= base_url() ?>admin/panel">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Users</li>
  </ol>
</nav>

          <!-- Page Heading -->
          <div class="row">
            <div class="col-lg-8 col-md-6">
              <h1 class="h3 mb-4 text-gray-800">User List</h1>
            </div>
            <div class="col-lg-4 col-md-6">
              <form action="" method="post">
                <div class="input-group mb-3" style="float: right;">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Role</span>
                  </div>
                  <select class="form-control" name="role">
                    <option value="User"<?php 
                      if(isset($_POST['role'])) {
                        if($_POST['role'] == "User") echo "selected";
                      }
                    ?>>User</option>
                    <option value="Admin"<?php 
                      if(isset($_POST['role'])) {
                        if($_POST['role'] == "Admin") echo "selected";
                      }
                    ?>>Admin</option>
                    <option value="Delivery Man"<?php 
                      if(isset($_POST['role'])) {
                        if($_POST['role'] == "Delivery Man") echo "selected";
                      }
                    ?>>Deliver Man</option>
                  </select>
                  <div class="input-group-append">
                    <button class="btn btn-secondary" type="submit">Filter</button>
                  </div>
                </div>
              </form>
            </div>
          </div>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Users</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <?php
$users = $this->users;
?>
                <table class="table table-bordered table-striped table-hover" style="font-size: 14px" id="dataTable" width="100%" cellspacing="0">
                   <thead>
                    <tr>
                      <th>
                        #
                      </th>
                      <th>
                        Username
                      </th>
                      <th>
                        Name
                      </th>
                      <th>
                        Email
                      </th>
                      <th>
                        Role
                      </th>
                      <th>
                        Registered On
                      </th>
                      <th>
                        Action
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
$cnt = 1;
foreach ($users as $user) {
?>
                        <tr>
                          <td>
                            <?= $cnt++ ?>
                          </td>
                          <td>
                            <?= $user->username ?>
                          </td>
                          <td>
                            <?= $user->name ?>
                          </td>
                          <td>
                            <?= $user->email ?>
                          </td>
                          <td>
                            <?= $user->role ?>
                          </td>
                          <td>
                            <?= date("d M, Y h:i:sa", strtotime($user->registered)) ?>
                          </td>
                          <td>
                            <div class="dropdown show">
  <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Action
  </a>

  <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuLink">

    <?php if($user->role == "User" || $user->role == "Delivery Man"): ?>
      <button type="button" class="dropdown-item" data-toggle="modal" data-target="#makeAdmin_<?= $user->id ?>">
        Change Role to Admin
      </button>
    <?php endif; ?>
    <?php if($user->role == "Admin" || $user->role == "Delivery Man"): ?>
      <button type="button" class="dropdown-item" data-toggle="modal" data-target="#makeUser_<?= $user->id ?>">
        Change Role to User
      </button>
    <?php endif; ?>
    <?php if($user->role == "User" || $user->role == "Admin"): ?>
      <button type="button" class="dropdown-item" data-toggle="modal" data-target="#makeDeliveryMan_<?= $user->id ?>">
        Change Role to Delivery Man
      </button>
    <?php endif; ?>
    <!-- Button trigger modal -->
      <button type="button" class="dropdown-item" data-toggle="modal" data-target="#deleteUser_<?= $user->id ?>">
        Delete
      </button>
  </div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteUser_<?= $user->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Confirm Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure to delete <b><?= $user->name ?></b>?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="<?= base_url() . "admin/deleteUser/" . $user->username ?>" role="button" class="btn btn-danger">Yes</a>
      </div>
    </div>
  </div>
</div>

<!-- Make Admin Modal -->
<div class="modal fade" id="makeAdmin_<?= $user->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Confirm Action</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure to make <b><?= $user->name ?></b> admin?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="<?= base_url() . "admin/makeAdmin/" . $user->username ?>" role="button" class="btn btn-warning">Yes</a>
      </div>
    </div>
  </div>
</div>

<!-- Make User Modal -->
<div class="modal fade" id="makeUser_<?= $user->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Confirm Action</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure to make <b><?= $user->name ?></b> user?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="<?= base_url() . "admin/makeUser/" . $user->username ?>" role="button" class="btn btn-warning">Yes</a>
      </div>
    </div>
  </div>
</div>

<!-- Make Delivery Man Modal -->
<div class="modal fade" id="makeDeliveryMan_<?= $user->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Confirm Action</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure to make <b><?= $user->name ?></b> delivery man?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="<?= base_url() . "admin/makeDeliveryMan/" . $user->username ?>" role="button" class="btn btn-warning">Yes</a>
      </div>
    </div>
  </div>
</div>

                          </td>
                            
                        </tr>
                        <?php
}
?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
</div>

        <!-- /.container-fluid -->

        <script>
          $(document).ready( function () {
    $('#users').DataTable();
} );
        </script>

      </div>
      <!-- End of Main Content -->