<div class="row">
    <div class="col-md-12 form-div request ">

        <a href="<?= base_url('/'); ?>">&#8592; Back to Dashboard</a>

        <form class="form-request col-12 mt-5" action="<?php echo base_url('/request/detail/') . $request_detail['request_id']; ?>" method="post">

            <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

            <div class="form-group form-row detail-eval">
                <label class="col-sm-2 col-form-label" for="name"><b>Status: </b></label>
                <input type="text" name="name" data-value="<?= $request_detail['status']; ?>" class="form-control col-sm-3" disabled>
            </div>
            <div class="form-group form-row">
                <label class="col-sm-2 col-form-label" for="name">Employee Name: </label>
                <input type="text" name="name" value="<?= $target_user['name']; ?>" class="form-control col-sm-3" disabled>
            </div>
            <div class=" form-group form-row">
                <label class="col-sm-2 col-form-label" for="salary">Current Salary</label>
                <input type="number" name="salary" value="<?= $target_user['salary']; ?>" class="form-control col-sm-3" disabled>
            </div>
            
            <a href="<?= base_url('/evaluate/result/') . $target_user['user_id']; ?>" class="btn btn-info btn-block btn-md offset-sm-10 col-sm-2">Evaluation Score</a>
            <p class="offset-sm-10 col-sm-2 text-center mb-0"><small><em>of this user</em></small></p>

            <div class="all-summary-score mt-3 mb-5" data-id="<?= $target_user['user_id']; ?>">
                <h4 class="text-center mt-5 mb-4">Summay Overall Evaluation</h4>
                <canvas id="all-summary-score" width="400" height="150"></canvas>
            </div>
            <div class=" form-group form-row">
                <label class="col-sm-2 col-form-label" for="new_salary"><b>Pending Salary</b></label>
                <input type="number" name="new_salary" value="<?= $request_detail['salary_target']; ?>" class="form-control col-sm-3" disabled>
            </div>
            <div class=" form-group form-row">
                <label class="col-sm-2 col-form-label" for="comment"><b>Comment</b></label>
                <textarea class="form-control col-sm-8" rows="5" name="comment" id="comment" disabled><?= $request_detail['detail']; ?></textarea>
            </div>

            <div class=" form-group form-row">
                <label class="col-sm-2 col-form-label" for="reason"><b>Reason</b></label>
                <textarea class="form-control col-sm-8" rows="5" name="reason" id="reason" 
                <?php if ($user_detail['level'] == 2 || $request_detail['status'] != 0) echo "disabled";?> ><?php if(isset($val_approve)) echo $val_approve['reason']; ?>
                </textarea>
            </div>
            
            <?php if ($user_detail['level'] == 3 && $request_detail['status'] == 0) : ?>
            <div class="form-group form-row">
                <button type="submit" name="submit-btn" value="approve" class="btn btn-success btn-block btn-lg offset-sm-5 col-sm-2">Approve</button>
                <button type="submit" name="submit-btn" value="reject" class="btn btn-danger btn-block btn-lg offset-sm-5 col-sm-2">Reject</button>
            </div>
            <?php endif; ?>


        </form>

    </div>
</div>