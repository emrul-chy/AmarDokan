
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= base_url() ?>admin/panel">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Tags</li>
  </ol>
</nav>

          <!-- Page Heading -->
          <div class="row">
            <div class="col-lg-8 col-md-6">
              <h1 class="h3 mb-4 text-gray-800">Tag List</h1>
            </div>
            <div class="col-lg-4 col-md-6">
              <form action="" method="post">
                <div class="input-group mb-3" style="float: right;">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Category</span>
                  </div>
                  <select class="form-control" name="category">
                    <?php 
                        foreach ($this->categories as $category) {
                          ?>

                          <option value="<?= $category->name ?>"<?php 
                      if(isset($_POST['category'])) {
                        if(htmlentities($_POST['category']) == $category->name) echo "selected";
                      }
                    ?>><?= $category->name ?></option>

                          <?php
                        }
                    ?>
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
              <div class="row">
                <div class="col-lg-6 col-md-6">
                  <h6 class="m-0 font-weight-bold text-primary">Tags</h6>
                </div>
                <div class="col-lg-6 col-md-6">
                  <a role="button" href="createTag" style="float: right;" class="btn btn-success">Create New</a>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <?php
$tags = $this->tags;
?>
                <table class="table table-bordered table-striped table-hover" style="font-size: 14px" id="dataTable" width="100%" cellspacing="0">
                   <thead>
                    <tr>
                      <th>
                        #
                      </th>
                      <th width="50%">
                        Name
                      </th>
                      <th width="50%">
                        Category
                      </th>
                      <th>
                        Action
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
$cnt = 1;
foreach ($tags as $tag) {
?>
                        <tr>
                          <td>
                            <?= $cnt++ ?>
                          </td>
                          <td>
                            <?= $tag->name ?>
                            <?php if($tag->top == 1): ?>
                              <a style="float: right;" class="btn btn-success btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-check-circle"></i>
                    </span>
                    <span class="text" style="color: white; font-size: 14px">Top Product</span>
                  </a>
                            <?php endif; ?>
                          </td>
                          <td>
                            <?= $tag->category ?>
                          </td>
                          <td>
                            <div class="dropdown show">
  <a class="btn btn-primary btn-md dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Action
  </a>

  <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuLink">
    <!-- Button trigger modal -->
      <a role="button" class="dropdown-item" href="<?= base_url() . "admin/updateTag/" . $tag->id ?>">
        Update
      </a>
      <button type="button" class="dropdown-item" data-toggle="modal" data-target="#deleteTag_<?= $tag->id ?>">
        Delete
      </button>
  </div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteTag_<?= $tag->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Confirm Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure to delete <b><?= $tag->name ?></b>?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="<?= base_url() . "admin/deleteTag/" . $tag->id ?>" role="button" class="btn btn-danger">Yes</a>
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