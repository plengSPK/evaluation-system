<div class="row">
    <div class="col col-md-12">

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
                
            <?php if ($this->session->flashdata('evaluate_info') != '') : ?>
            <div class="alert alert-success">
                <?= $this->session->flashdata('evaluate_info'); ?>
            </div>
            <?php endif; ?>

            <table class="table" id="dashboard_manager" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="text-center">Detail</th>
                            <th scope="col" class="text-center">Request</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
			                $val_temp = array_count_values(array_column($val_eval, 'target_user_id'));
			                $count_emp = count($val_user)-1;
                            foreach($val_user as $index => $user):
                                if($val_eval != null)
                                    $countEval = $val_temp[$user['user_id']];
                                else
                                    $countEval = false;
                        ?>
                        <tr>
                            <th scope="row" class="text-center"><?=$index+1;?></th>
                            <td><?=$user['name'];?></td>
                            <?php if($countEval !== false && $count_emp == $countEval): ?>
                                <td>Complete</td>                        
                            <?php else: ?>
                                <td>Waiting to complete</td>
                            <?php endif; ?>                            
                            <td class="text-center">
                                <a href="<?php echo base_url('/evaluate/result/') . $user['user_id']; ?>">
                                    <i class="material-icons">insert_chart_outlined</i>
                                </a>
                            </td>               
                            <td class="text-center">
                                <a href="<?php echo base_url('/request/') . $user['user_id']; ?>">
                                    <i class="material-icons">description</i>
                                </a>
                            </td>    
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
            <div class="tab-pane fade" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                pending
            </div>
        </div>

    </div>
</div>