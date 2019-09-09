<div class="row">
    <div class="col col-md-12">

        <div class="text-center mt-5 mb-5">
            <div class="duedate">
                <?php if(empty($this->canEval)):?>
                <h4><font color="red">The system is closed now</font></h4>
                <?php else:?>
                <h4><font color="dodgerblue">The system opens between <?=$duedate;?></font></h4>
                <?php endif;?>
            </div>

            <h5 class="mt-5"><i>Current Evaluation</i></h5>
            <h4>Quarter: <?= $val_date['quarter']; ?> / Year: <?= $val_date['year']; ?></h4>
            <p><i>(Department: <?= $department_name; ?>)</i></p> 
            
            <div class="progress">
                <div class="progress-bar progress-bar-striped" role="progressbar" style="width: <?= $precent_complete; ?>%" aria-valuenow="<?= $precent_complete; ?>" aria-valuemin="0" aria-valuemax="100">Complete <?= $precent_complete; ?>%</div>
            </div>
        </div>

        <a href="<?= base_url('/evaluate/result/') . $user_detail['user_id']; ?>" class="btn btn-warning btn-block btn-md offset-sm-5 col-sm-2 mb-5">My Summary Evaluation</a>

        <?php if ($this->session->flashdata('evaluate_info') != '') : ?>
            <div class="alert alert-success offset-sm-3 col-sm-6 text-center">
                <?= $this->session->flashdata('evaluate_info'); ?>
            </div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('overdue_info') != '') : ?>
            <div class="alert alert-warning offset-sm-3 col-sm-6 text-center">
                <?= $this->session->flashdata('overdue_info'); ?>
            </div>
        <?php endif; ?>

        <table class="table table-responsive w-100 d-block d-md-table" id="dashboard_emp">
            <thead>
                <tr>
                    <th scope="col" class="text-center">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Status</th>
                    <th scope="col" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($val_user)) : ?>
                    <?php
                        foreach ($val_user as $index => $user) :
                            if ($val_eval != null)
                                $isEval = array_search($user['user_id'], array_column($val_eval, 'target_user_id'));
                            else
                                $isEval = false;
                            ?>
                        <tr>
                            <th scope="row" class="text-center"><?= $index + 1; ?></th>
                            <td><?= $user['name']; ?></td>
                            <?php if ($isEval !== false) : ?>
                                <td>Complete</td>
                                <td class="text-center">
                                    <a href="<?php echo base_url('/evaluate/view/') . $val_eval[$isEval]['evaluate_id']; ?>">
                                        <i class="material-icons">search</i>
                                    </a>
                                </td>
                            <?php else : ?>
                                <td>Waiting to complete</td>
                                <td class="text-center">
                                    <a href="<?php echo base_url('/evaluate/new/') . $user['user_id']; ?>">
                                        <i class="material-icons">create</i>
                                    </a>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>

    </div>
</div>