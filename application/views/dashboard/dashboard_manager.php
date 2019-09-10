<div class="row">
    <div class="col col-md-12">

        <!-- <div>Today: <?=$today['date'].'-'.$today['month'].'-'.$today['year'];?></div> -->

        <ul class="nav nav-tabs dashboard-tab" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Overview</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pending-tab" data-toggle="tab" href="#pending" role="tab" aria-controls="pending" aria-selected="false">Pending</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">

                <div class="text-center mt-5 mb-5">
                    <div class="duedate">
                        <?php if(empty($this->canEval)): $textDate = 'The Next Evaluation';?>
                        <h4><font color="red">The system is closed now<br>The system will open between <?=$duedate;?></font></h4>
                        <?php else: $textDate = 'Current Evaluation';?>
                        <h4><font color="dodgerblue">The system opens between <?=$duedate;?></font></h4>  
                        <?php endif;?>
                    </div>

                    <h5 class="mt-5"><i><?= $textDate; ?></i></h5>
                    <h4>Quarter: <?=$val_date['quarter'];?> / Year: <?=$val_date['year'];?></h4>
                    <p><i>(Department: <?= $department_name; ?>)</i></p>
                </div>

                <?php if ($this->session->flashdata('request_info') != '') : ?>
                    <div class="alert alert-success offset-sm-3 col-sm-6 text-center">
                        <?= $this->session->flashdata('request_info'); ?>
                    </div>
                <?php endif; ?>

                <table class="table table-responsive w-100 d-block d-md-table" id="dashboard_manager">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Evaluation Status</th>
                            <th scope="col" class="text-center">Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($val_user)):?>
                            <?php
                            if(isset($val_eval))
                                $val_temp = array_count_values(array_column($val_eval, 'target_user_id'));
                            else
                                $val_eval = null;
                            
                            $count_emp = count($val_user) - 1;
                            foreach ($val_user as $index => $user) :
                                if ($val_eval != null && isset($val_temp[$user['user_id']]))
                                    $countEval = $val_temp[$user['user_id']];
                                else
                                    $countEval = false;
                                ?>
                                <tr>
                                    <th scope="row" class="text-center"><?= $index + 1; ?></th>
                                    <td><?= $user['name']; ?></td>
                                    <?php if ($countEval !== false && $count_emp == $countEval) : ?>
                                        <td>Complete</td>
                                    <?php else : ?>
                                        <td>Waiting to complete</td>
                                    <?php endif; ?>

                                    <td class="text-center">
                                        <a href="<?php echo base_url('/evaluate/result/') . $user['user_id']; ?>">
                                            <i class="material-icons">insert_chart_outlined</i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>

            </div>
            <div class="tab-pane fade" id="pending" role="tabpanel" aria-labelledby="pending-tab">

                <div class="text-center mt-5 mb-5">
                    <h4>Pending Request</h4>
                </div>

                <table class="table table-responsive w-100 d-block d-md-table" id="dashboard_manager_pending">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">#</th>
                            <th scope="col">Name</th>
                            <th scope="col" class="text-center">Pending Status</th>
                            <th scope="col" class="text-center">Last Update</th>
                            <th scope="col" class="text-center">View</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($val_req) && isset($val_user)):?>
                            <?php foreach ($val_req as $index => $req) : 
                                $val_temp = array_search($req['target_user_id'],array_column($val_user, 'user_id'));?>
                                <tr>
                                    <th scope="row" class="text-center"><?= $index + 1; ?></th>
                                    <td><?= $val_user[$val_temp]['name'] ?></td>

                                    <?php if ($req['status'] == 0) :
                                            $request_url = base_url('/request/view/') . $req['request_id']; ?>
                                        <td class="text-center">Pending</td>
                                    <?php elseif ($req['status'] == 1) :
                                            $request_url = base_url('/request/detail/') . $req['request_id']; ?>
                                        <td class="text-center">Approved</td>
                                    <?php else :
                                            $request_url = base_url('/request/detail/') . $req['request_id']; ?>
                                        <td class="text-center">Rejected</td>
                                    <?php endif; ?>
                                    <td class="text-center"><?= $req['last_update']; ?></td>

                                    <td class="text-center">
                                        <a href="<?= $request_url; ?>">
                                            <i class="material-icons">description</i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>

            </div>
        </div>

    </div>
</div>