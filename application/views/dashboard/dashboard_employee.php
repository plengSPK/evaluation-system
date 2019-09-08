<div class="row">
    <div class="col col-md-12">

        <ul class="nav nav-tabs dashboard-tab" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Overview</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="content-tab" data-toggle="tab" href="#content" role="tab" aria-controls="content" aria-selected="false">Content</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                
            <a href="<?= base_url('/evaluate/result/') . $user_detail['user_id']; ?>" class="btn btn-warning btn-block btn-md offset-sm-5 col-sm-2 mb-5">My Summary Evaluation</a>

            <?php if ($this->session->flashdata('evaluate_info') != '') : ?>
            <div class="alert alert-success">
                <?= $this->session->flashdata('evaluate_info'); ?>
            </div>
            <?php endif; ?>

                <table class="table" id="dashboard_emp" style="width:100%">
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
                                foreach($val_user as $index => $user):
                                    if($val_eval != null)
                                        $isEval = array_search($user['user_id'], array_column($val_eval, 'target_user_id'));
                                    else
                                        $isEval = false;
                            ?>
                            <tr>
                                <th scope="row" class="text-center"><?=$index+1;?></th>
                                <td><?=$user['name'];?></td>
                                <?php if($isEval !== false): ?>
                                    <td>Complete</td>
                                    <td class="text-center">
                                        <a href="<?php echo base_url('/evaluate/view/') . $val_eval[$isEval]['evaluate_id']; ?>">
                                            <i class="material-icons">search</i>
                                        </a>
                                    </td>                            
                                <?php else: ?>
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
            <div class="tab-pane fade" id="content" role="tabpanel" aria-labelledby="content-tab">
                content
            </div>
        </div>

    </div>
</div>