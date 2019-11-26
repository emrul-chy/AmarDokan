<?php
if ($this->session->userdata('success_msg') != NULL) {
    ?>
    <div class="alert alert-success" role="alert">
        <?php
        echo $this->session->userdata('success_msg');
        $this->session->unset_userdata('success_msg');
        ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php
}
?>
<?php
if ($this->session->userdata('error_msg') != "") {
    ?>
    <div class="alert alert-danger" role="alert">
        <?php
        echo $this->session->userdata('error_msg');
        $this->session->unset_userdata('error_msg');
        ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php
}
?>