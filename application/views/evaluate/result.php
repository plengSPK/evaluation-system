<div class="row">
    <div class="col-md-12 form-div evaluate">

        <a href="<?= base_url('/'); ?>">&#8592; Back to Dashboard</a>

        <form class="form-evaluate col-12 mt-5" action="<?php echo base_url('/evaluate/result/') . $target_user['user_id']; ?>" method="post">

            <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

            <div class="form-group form-row">
                <label class="col-sm-2 col-form-label" for="name">Employee Name: </label>
                <input type="text" name="name" value="<?= $target_user['name']; ?>" class="form-control col-sm-3" disabled ">
            </div>
            <div class=" form-group form-row">
                <label class="col-sm-2 col-form-label" for="quarter">Quarter</label>
                <input type="number" name="quarter" value="<?= $quarter; ?>" class="form-control col-sm-3" min=1 max=4>
            </div>
            <div class=" form-group form-row">
                <label class="col-sm-2 col-form-label" for="year">Year </label>
                <input type="number" name="year" value="<?= $year; ?>" class="form-control col-sm-3">
            </div>
            <div class="form-group form-row">
                <button type="submit" name="login-btn" class="btn btn-primary btn-block btn-sm offset-sm-3 col-sm-2">Go to Quarter/Year</button>
            </div>
        </form>

        <?php if (isset($no_data)) : ?>
            <div class="text-center mt-5">
                <h4>No Record.</h4>
            </div>
        <?php else : ?>
            <ul class="nav nav-tabs result-eval-tab" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Overview</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="detail-tab" data-toggle="tab" href="#detail" role="tab" aria-controls="detail" aria-selected="true">Detail</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                    <div class="text-center mt-5 mb-2">
                        <?php if (isset($isNotComplete)) : ?>
                            <h4 class="mb-5"><font color="red">Evaluation of this user is not completed.</font></h4>
                        <?php endif; ?>
                        <h4>Summay Evaluation Score</h4>
                    </div>
                    <div class="chart-summary">
                        <button onclick="changeChartType();" data-type="" class="btn btn-success btn-block btn-sm offset-sm-10 col-sm-2">Switch Chart Type</button>    
                        <canvas id="summary-score" width="400" height="150"></canvas>
                    </div>
                    <table class="table mt-4" id="result_emp" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">Time management</th>
                                <th scope="col" class="text-center">Quality of work</th>
                                <th scope="col" class="text-center">Creativity</th>
                                <th scope="col" class="text-center">Team work</th>
                                <th scope="col" class="text-center">Discipline</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center time_mange_score" data-value="<?= $sum_score['time_mange_score']; ?>"><?= $sum_score['time_mange_score'] . "%"; ?></td>
                                <td class="text-center quality_score" data-value="<?= $sum_score['quality_score']; ?>"><?= $sum_score['quality_score'] . "%"; ?></td>
                                <td class="text-center creativity_score" data-value="<?= $sum_score['creativity_score']; ?>"><?= $sum_score['creativity_score'] . "%"; ?></td>
                                <td class="text-center teamwork_score" data-value="<?= $sum_score['teamwork_score']; ?>"><?= $sum_score['teamwork_score'] . "%"; ?></td>
                                <td class="text-center discipline_score" data-value="<?= $sum_score['discipline_score']; ?>"><?= $sum_score['discipline_score'] . "%"; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="detail" role="tabpanel" aria-labelledby="detail-tab">
                    <div class="text-center mt-5 mb-2">
                        <h4>Detail Evaluation Score</h4>
                    </div>
                    <table class="table mt-4" id="result_detail_emp" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">#</th>
                                <th scope="col" class="text-center">Time management</th>
                                <th scope="col" class="text-center">Quality of work</th>
                                <th scope="col" class="text-center">Creativity</th>
                                <th scope="col" class="text-center">Team work</th>
                                <th scope="col" class="text-center">Discipline</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($val_eval as $index => $score) : ?>
                                <tr>
                                    <td scope="row" class="text-center"><?= $index + 1; ?></td>
                                    <td class="text-center"><?= convertScore($score['time_mange_score']); ?></td>
                                    <td class="text-center"><?= convertScore($score['quality_score']); ?></td>
                                    <td class="text-center"><?= convertScore($score['creativity_score']); ?></td>
                                    <td class="text-center"><?= convertScore($score['teamwork_score']); ?></td>
                                    <td class="text-center"><?= convertScore($score['discipline_score']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif; ?>
        
    </div>
</div>