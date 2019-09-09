<div class="row">
    <div class="col-md-12 form-div evaluate">

        <a href="<?= base_url('/'); ?>">&#8592; Back to Dashboard</a>

        <form class="form-evaluate col-12 mt-5" action="<?php echo base_url('/evaluate/new/') . $target_user['user_id']; ?>" method="post">

            <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

            <?php if ($this->session->flashdata('evaluate_info_sameID') != '') : ?>
                <div class="alert alert-danger">
                    <?= $this->session->flashdata('evaluate_info_sameID'); ?>
                </div>
            <?php endif; ?>

            <div class="text-center mb-5">
                <h4>Quarter: <?= $curQuarter; ?> / Year: <?= $curYear; ?></h4>
            </div>

            <div class="form-group form-row">
                <label class="col-sm-2 col-form-label" for="name">Employee Name: </label>
                <input type="text" name="name" value="<?= $target_user['name']; ?>" class="form-control col-sm-3" disabled>
            </div>
            <div class=" form-group form-row">
                <label class="col-sm-2 col-form-label" for="last_update">Date: </label>
                <input type="text" name="last_update" value="<?= date('d-m-Y'); ?>" class="form-control col-sm-3" disabled>
            </div>

            <div class="form-group form-row">
                <table id="table" class="table evaluate-table">
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
                        <tr>
                            <th scope="row">Time management</th>
                            <td><input type="radio" name="score_time" value="4"></td>
                            <td><input type="radio" name="score_time" value="3"></td>
                            <td><input type="radio" name="score_time" value="2"></td>
                            <td><input type="radio" name="score_time" value="1"></td>
                        </tr>
                        <tr>
                            <th scope="row">Quality of work</th>
                            <td><input type="radio" name="score_quality" value="4"></td>
                            <td><input type="radio" name="score_quality" value="3"></td>
                            <td><input type="radio" name="score_quality" value="2"></td>
                            <td><input type="radio" name="score_quality" value="1"></td>
                        </tr>
                        <tr>
                            <th scope="row">Creativity</th>
                            <td><input type="radio" name="score_creativity" value="4"></td>
                            <td><input type="radio" name="score_creativity" value="3"></td>
                            <td><input type="radio" name="score_creativity" value="2"></td>
                            <td><input type="radio" name="score_creativity" value="1"></td>
                        </tr>
                        <tr>
                            <th scope="row">Team work</th>
                            <td><input type="radio" name="score_teamwork" value="4"></td>
                            <td><input type="radio" name="score_teamwork" value="3"></td>
                            <td><input type="radio" name="score_teamwork" value="2"></td>
                            <td><input type="radio" name="score_teamwork" value="1"></td>
                        </tr>
                        <tr>
                            <th scope="row">Discipline</th>
                            <td><input type="radio" name="score_discipline" value="4"></td>
                            <td><input type="radio" name="score_discipline" value="3"></td>
                            <td><input type="radio" name="score_discipline" value="2"></td>
                            <td><input type="radio" name="score_discipline" value="1"></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="form-group form-row">
                <button type="submit" name="submit-btn" class="btn btn-primary btn-block btn-lg offset-sm-5 col-sm-2">Submit</button>
            </div>
        </form>
    </div>
</div>