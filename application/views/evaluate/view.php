<div class="row">
    <div class="col-md-12 form-div evaluate">

        <a href="<?= base_url('/'); ?>">&#8592; Back to Dashboard</a>

        <form class="form-evaluate col-12 mt-5" action="<?php echo base_url('/evaluate/new/') . $target_user['user_id']; ?>" method="post">

            <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

            <div class="text-center mb-5">
                <h4>Quarter: <?= $evalaute_detail['quarter']; ?> / Year: <?= $evalaute_detail['year']; ?></h4>
            </div>

            <div class="form-group form-row">
                <label class="col-sm-2 col-form-label" for="name">Employee Name: </label>
                <input type="text" name="name" value="<?= $target_user['name']; ?>" class="form-control col-sm-3" disabled>
            </div>
            <div class=" form-group form-row">
                <label class="col-sm-2 col-form-label" for="last_update">Date: </label>
                <input type="text" name="last_update" value="<?= $evalaute_detail['last_update']; ?>" class="form-control col-sm-3" disabled>
            </div>

            <div class="form-group form-row">
                <table id="table" class="table evaluate-table view">
                    <thead>
                        <tr>
                            <th></th>
                            <th data-radio="true" class="text-center">Very Good</th>
                            <th data-radio="true" class="text-center">Good</th>
                            <th data-radio="true" class="text-center">So So</th>
                            <th data-radio="true" class="text-center">Bad</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="time">
                            <th scope="row" data-score="<?= $evalaute_detail['time_mange_score']; ?>">Time management</th>
                            <td><input type="radio" name="score_time" value="4"></td>
                            <td><input type="radio" name="score_time" value="3"></td>
                            <td><input type="radio" name="score_time" value="2"></td>
                            <td><input type="radio" name="score_time" value="1"></td>
                        </tr>
                        <tr class="quality">
                            <th scope="row" data-score="<?= $evalaute_detail['quality_score']; ?>">Quality of work</th>
                            <td><input type="radio" name="score_quality" value="4"></td>
                            <td><input type="radio" name="score_quality" value="3"></td>
                            <td><input type="radio" name="score_quality" value="2"></td>
                            <td><input type="radio" name="score_quality" value="1"></td>
                        </tr>
                        <tr class="creativity">
                            <th scope="row" data-score="<?= $evalaute_detail['creativity_score']; ?>">Creativity</th>
                            <td><input type="radio" name="score_creativity" value="4"></td>
                            <td><input type="radio" name="score_creativity" value="3"></td>
                            <td><input type="radio" name="score_creativity" value="2"></td>
                            <td><input type="radio" name="score_creativity" value="1"></td>
                        </tr>
                        <tr class="teamwork">
                            <th scope="row" data-score="<?= $evalaute_detail['teamwork_score']; ?>">Team work</th>
                            <td><input type="radio" name="score_teamwork" value="4"></td>
                            <td><input type="radio" name="score_teamwork" value="3"></td>
                            <td><input type="radio" name="score_teamwork" value="2"></td>
                            <td><input type="radio" name="score_teamwork" value="1"></td>
                        </tr>
                        <tr class="discipline">
                            <th scope="row" data-score="<?= $evalaute_detail['discipline_score']; ?>">Discipline</th>
                            <td><input type="radio" name="score_discipline" value="4"></td>
                            <td><input type="radio" name="score_discipline" value="3"></td>
                            <td><input type="radio" name="score_discipline" value="2"></td>
                            <td><input type="radio" name="score_discipline" value="1"></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <?php if ($canEval != '') : ?>
            <div class="form-group form-row">
                <button type="submit" name="update-btn" class="btn btn-success btn-block btn-lg offset-sm-5 col-sm-2">Update</button>
            </div>
            <?php endif; ?>
        </form>
    </div>
</div>