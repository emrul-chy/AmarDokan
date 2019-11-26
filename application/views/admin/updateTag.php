				<?php
$tag = $this->query;
?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

        	<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= base_url() ?>admin/panel">Home</a></li>
    <li class="breadcrumb-item"><a href="<?= base_url() ?>admin/panel/tags">Tags</a></li>
    <li class="breadcrumb-item active" aria-current="page"><?= $tag->name ?></li>
  </ol>
</nav>

          <!-- Page Heading -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Update Tag</h6>
            </div>
            <div class="card-body">  
          <form method="post" enctype="multipart/form-data" action="<?= base_url() . "admin/updateTag_process/" . $tag->id ?>">
					  <div class="form-group row">
					    <label for="name" class="col-sm-2 col-form-label">Name</label>
					    <div class="col-sm-10">
					      <input style="padding-left: 15px" name="name" type="text" class="form-control" id="name" value="<?= $tag->name ?>" required="">
					    </div>
					  </div>
            <div class="form-group row">
              <label for="category" class="col-sm-2 col-form-label">Category</label>
              <div class="col-sm-10">
                <select name="category" id="category" class="form-control"  onClick="getFoodItem()" required="">
                  <?php
$categories = $this->categories;
foreach ($categories as $category) {
?>
                      <option value="<?= $category->name ?>" <?php
        if ($category->name == $tag->category)
                echo ("selected");
?>><?= $category->name ?></option>
                      <?php
}
?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="top" class="col-sm-2 col-form-label">Top Product</label>
              <div class="col-sm-10">
                <input style="padding-left: 15px;" name="top" type="checkbox" <?php if($tag->top) echo "checked" ?>> <label>Yes</label>
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