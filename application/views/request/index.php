<div class="row">
    <div class="col-md-12 form-div request ">

        <a href="<?= base_url('/'); ?>">&#8592; Back to Dashboard</a>

        <form class="form-request col-12 mt-5" action="<?php echo base_url('/request/new/') . $target_user['user_id']; ?>" method="post">

            <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

            <?php if(isset($request_detail)): ?>
                <div class="form-group form-row">
                    <label class="col-sm-2 col-form-label" for="name"><b>Status: </b></label>
                    <input type="text" name="name" value="Pending" class="form-control col-sm-3" disabled>
                </div>
            <?php endif; ?>

            <div class="form-group form-row">
                <label class="col-sm-2 col-form-label" for="name">Employee Name: </label>
                <input type="text" name="name" value="<?= $target_user['name']; ?>" class="form-control col-sm-3" disabled>
            </div>
            <div class=" form-group form-row">
                <label class="col-sm-2 col-form-label" for="salary">Current Salary</label>
                <input type="number" name="salary" value="<?= $target_user['salary']; ?>" class="form-control col-sm-3" disabled>
            </div>

            <div class="all-summary-score mt-5 mb-5" data-count="<?=$count_emp;?>" data-id="<?=$target_user['user_id'];?>">
                <h4 class="text-center mt-5 mb-4">Summay Overall Evaluation</h4>
                <canvas id="all-summary-score" width="400" height="150"></canvas>
            </div>

            <?php if(isset($request_detail)): ?>
                <div class=" form-group form-row">
                    <label class="col-sm-2 col-form-label" for="new_salary"><b>Pending Salary</b></label>
                    <input type="number" name="new_salary" value="<?= $request_detail['salary_target']; ?>" class="form-control col-sm-3">
                </div>
                <div class=" form-group form-row">
                    <label class="col-sm-2 col-form-label" for="comment"><b>Comment</b></label>
                    <textarea class="form-control col-sm-8" rows="5" name="comment" id="comment"><?= $request_detail['detail']; ?></textarea>
                </div>
                <div class="form-group form-row">
                    <button type="submit" name="update-btn" class="btn btn-success btn-block btn-lg offset-sm-5 col-sm-2">Update</button>
                </div>
            <?php else: ?>
                <div class=" form-group form-row">
                    <label class="col-sm-2 col-form-label" for="new_salary"><b>Pending Salary</b></label>
                    <input type="number" name="new_salary" class="form-control col-sm-3">
                </div>
                <div class=" form-group form-row">
                    <label class="col-sm-2 col-form-label" for="comment"><b>Comment</b></label>
                    <textarea class="form-control col-sm-8" rows="5" name="comment" id="comment"></textarea>
                </div>
                <div class="form-group form-row">
                    <button type="submit" name="submit-btn" class="btn btn-primary btn-block btn-lg offset-sm-5 col-sm-2">Submit</button>
                </div>
            <?php endif; ?>

        </form>

    </div>
</div>