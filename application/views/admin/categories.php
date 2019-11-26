
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= base_url() ?>admin/panel">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Categories</li>
  </ol>
</nav>

          <!-- Page Heading -->
          <div class="row">
            <div class="col-lg-8 col-md-6">
              <h1 class="h3 mb-4 text-gray-800">Category List</h1>
            </div>
          </div>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <div class="row">
                <div class="col-lg-6 col-md-6">
                  <h6 class="m-0 font-weight-bold text-primary">Categories</h6>
                </div>
                <div class="col-lg-6 col-md-6">
                  <a role="button" href="createCategory" style="float: right;" class="btn btn-success">Create New</a>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <?php
$categories = $this->categories;
?>
                <table class="table table-bordered table-striped table-hover" style="font-size: 14px" id="dataTable" width="100%" cellspacing="0">
                   <thead>
                    <tr>
                      <th>
                        #
                      </th>
                      <th width="100%">
                        Name
                      </th>
                      <th>
                        Action
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
$cnt = 1;
foreach ($categories as $category) {
?>
                        <tr>
                          <td>
                            <?= $cnt++ ?>
                          </td>
                          <td>
                            <?= $category->name ?>
                          </td>
                          <td>
                            <div class="dropdown show">
  <a class="btn btn-primary btn-md dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Action
  </a>

  <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuLink">
    <!-- Button trigger modal -->
      <a role="button" class="dropdown-item" href="<?= base_url() . "admin/updateCategory/" . $category->id ?>">
        Update
      </a>
      <button type="button" class="dropdown-item" data-toggle="modal" data-target="#deleteCategory_<?= $category->id ?>">
        Delete
      </button>
  </div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteCategory_<?= $category->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Confirm Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure to delete <b><?= $category->name ?></b>?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="<?= base_url() . "admin/deleteCategory/" . $category->id ?>" role="button" class="btn btn-danger">Yes</a>
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