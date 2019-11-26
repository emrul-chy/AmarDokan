<title>Purchase History | AmarDokan</title>
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
                    <li>Purchases</li>
                </ul>
            </div>
        </div>
    </div>
<div class="container" style="margin-bottom: 50px">
    <div class="row">
        <div class="col-lg-2">
            <ul class="nav nav-pills nav-stacked">
                <li role="presentation" class="active"><a href="<?= base_url();?>account/purchase">Puchase History</a></li>
                <li role="presentation"><a href="<?= base_url();?>account/profile">Profile</a></li>
                <li role="presentation"><a href="<?= base_url();?>account/email">Email</a></li>
                <li role="presentation"><a href="<?= base_url(); ?>account/password">Password</a></li>
            </ul>
        </div>

            <h3 style="margin: 10px">Purchase History</h3>
            <hr>
        <div class="col-lg-10">

            <table style="margin-top: 20px" class="timetable_sub table-hover table-striped">
                 <thead>
                     <tr>
                        <th>
                            #
                        </th>
                         <th>
                             Order ID
                         </th>
                         <th>
                             Time
                         </th>
                         <th>
                             Status
                         </th>
                         <th>
                             Action
                         </th>
                     </tr>
                 </thead>
                 <tbody>
                    <?php
                    $query = $this->query;
                    $cnt = ($this->pageno - 1) * 10 + 1;
                    $len = sizeof($query);
                    $tot = 0;
                    foreach ($query as $row) {
                        $tot++;
                        //echo $cnt . " " . $tot . "<br>";
                        if($tot < $cnt) continue;
                        if($tot > $cnt + 9) break;

                      //  echo "done";
                        ?>
                        <tr>
                            <td style="font-size: 15px">
                                <?= $tot ?>
                            </td>
                            <td style="font-size: 15px">
                                <?= $row->id ?>
                            </td>
                            <td style="font-size: 15px">
                                <?= date("h:i:sa", strtotime($row->time)) . "<br>" . date("d M, Y", strtotime($row->time)) ?>
                            </td>
                            <td>
                                <?php if($row->status == "Submitted"):?>
                                    <div style="font-size: 15px; margin: 0px; padding: 9px" class="alert alert-info" role="alert">
                                        <label>Submitted</label>
                                    </div>
                                <?php endif; ?> 
                                <?php if($row->status == "Cancelled"):?>
                                    <div style="font-size: 15px; margin: 0px; padding: 9px" class="alert alert-danger" role="alert">
                                        <label>Cancelled</label>
                                    </div>
                                <?php endif; ?> 
                                <?php if($row->status == "Accepted"):?>
                                    <div style="font-size: 15px; margin: 0px; padding: 9px" class="alert alert-warning" role="alert">
                                        <label>Accepted</label>
                                    </div>
                                <?php endif; ?> 
                                <?php if($row->status == "Completed"):?>
                                    <div style="font-size: 15px; margin: 0px; padding: 9px" class="alert alert-success" role="alert">
                                        <label>Completed</label>
                                    </div>
                                <?php endif; ?> 
                            </td>
                            <td style="font-size: 15px">
                                <a role="button" class="btn btn-success" href="<?= base_url() . "order/view/" . $row->id?>">View Order</a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                 </tbody>
            </table>
            <ul class="pagination pagination-md">
                <?php

                ?>
                        <li <?php if($this->pageno == 1) echo 'class="disabled"'; ?>>
                            <a href="<?= base_url() . 'account/purchase/' . 1?>">
                                <i class="fa fa-angle-left">«</i>
                            </a>
                        </li>
                        <?php
                        $tpg = $len / 10;
                        $tpg = floor($tpg);
                        if($len % 10 != 0) $tpg++;
                        for($i = 1; $i <= $tpg; $i++) {
                             ?>
                             <li <?php if($this->pageno == $i) echo 'class="active"'; ?>>
                             <a href="<?= base_url() . 'account/purchase/' . $i?>">
                                <?= $i ?>
                             </a>
                                </li>
                                <?php
                        }
                        ?>
                        <li <?php if($this->pageno == $tpg) echo 'class="disabled"'; ?>>
                            <a href="<?= base_url() . 'account/purchase/' . $tpg?>">
                                <i class="fa fa-angle-left">«</i>
                            </a>
                        </li>

                    </ul>
                </div>
    </div>

    
</div>