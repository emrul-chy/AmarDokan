				<?php
$category = $this->query;
?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

        	<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= base_url() ?>admin/panel">Home</a></li>
    <li class="breadcrumb-item"><a href="<?= base_url() ?>admin/panel/categorys">Categories</a></li>
    <li class="breadcrumb-item active" aria-current="page"><?= $category->name ?></li>
  </ol>
</nav>

          <!-- Page Heading -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Update Category</h6>
            </div>
            <div class="card-body"> 

          <form method="post" enctype="multipart/form-data" action="<?= base_url() . "admin/updateCategory_process/" . $category->id ?>">
					  <div class="form-group row">
					    <label for="name" class="col-sm-2 col-form-label">Name</label>
					    <div class="col-sm-10">
					      <input style="padding-left: 15px" name="name" type="text" class="form-control" id="name" value="<?= $category->name ?>" required="">
					    </div>
					  </div>
					  <div class="form-group row">
					    <div class="col-sm-10">
					      <button type="submit" class="btn btn-primary">Update</button>
					    </div>
					  </div>
					</form>

        </div>
      </div>

        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->