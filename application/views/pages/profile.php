<title>Profile | AmarDokan</title>
<div class="services-breadcrumb" style="margin-bottom: 10px">
        <div class="agile_inner_breadcrumb">
            <div class="container">
                <ul class="w3_short">
                    <li>
                        <a href="<?= base_url() ?>">Home</a>
                        <i>|</i>
                    </li>
                    <li>
                        <a href="<?= base_url() ?>account/purchase">Account</a>
                        <i>|</i>
                    </li>
                    <li>Profile</li>
                </ul>
            </div>
        </div>
    </div>
<div class="container" style="margin-bottom: 50px">
    <div class="row">
        <div class="col-lg-2">
            <ul class="nav nav-pills nav-stacked">
                <li role="presentation"><a href="<?= base_url(); ?>account/purchase">Puchase History</a></li>
                <li role="presentation" class="active"><a href="<?= base_url(); ?>account/profile">Profile</a></li>
                <li role="presentation"><a href="<?= base_url(); ?>account/email">Email</a></li>
                <li role="presentation"><a href="<?= base_url(); ?>account/password">Password</a></li>
            </ul>
        </div>
        <h3 style="margin: 10px;">Profile</h3>
        <hr>
        <div class="col-lg-10" style="z-index: 0">
            <form method="post" action="<?= base_url(); ?>account/update_profile">
                <div class="row">
                    <div class="col-lg-2">
                        Name
                    </div>
                    <div class="col-lg-4">
                        <div class="input-group" style="width: 100%">
                            <input type="text" name="name" class="form-control" placeholder="Name" value="<?= $this->session->userdata('name'); ?>" aria-describedby="basic-addon1">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-2">
                        Username
                    </div>
                    <div class="col-lg-4">
                        <div class="input-group" style="width: 100%">
                            <input type="text" class="form-control" placeholder="Name" value="<?= $this->session->userdata('username'); ?>" aria-describedby="basic-addon1" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-info">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>