<div class="row">
    <div class="col col-md-12">

        <ul class="nav nav-tabs dashboard-tab" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Overview</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="history-tab" data-toggle="tab" href="#history" role="tab" aria-controls="history" aria-selected="false">History</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                
                <div class="text-center mt-5 mb-5">
                    <h4>Pending Request</h4>
                    <p><i>(Department: <?= $department_name; ?>)</i></p>
                </div>

                <table class="table table-responsive w-100 d-block d-md-table" id="dashboard_director">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">#</th>
                            <th scope="col">Name</th>
                            <th scope="col" class="text-center">Pending Status</th>
                            <th scope="col" class="text-center">Pending Date</th>
                            <th scope="col" class="text-center">View</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $index_show = 0;
                              foreach ($val_req as $index => $req) : 
                              if($req['status'] != 0) continue;
                              $index_show += 1;
                              $val_temp = array_search($req['target_user_id'],array_column($val_user, 'user_id'));?>
                            <tr>
                                <th scope="row" class="text-center"><?= $index_show; ?></th>
                                <td><?= $val_user[$val_temp]['name'] ?></td>
                                <td class="text-center">Pending</td>
                                <td class="text-center"><?= $req['last_update']; ?></td>
                                <td class="text-center">
                                    <a href="<?= base_url('/request/detail/') . $req['request_id']; ?>">
                                        <i class="material-icons">description</i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
            <div class="tab-pane fade" id="history" role="tabpanel" aria-labelledby="history-tab">
                
                <div class="text-center mt-5 mb-5">
                    <h4>History Request</h4>
                </div>

                <table class="table table-responsive w-100 d-block d-md-table" id="dashboard_director_history">
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
                        <?php $index_show = 0;
                              foreach ($val_req as $index => $req) : 
                              if($req['status'] == 0) continue;
                              $index_show += 1;
                              $val_temp = array_search($req['target_user_id'],array_column($val_user, 'user_id'));?>
                            <tr>
                                <th scope="row" class="text-center"><?= $index_show; ?></th>
                                <td><?= $val_user[$val_temp]['name'] ?></td>
                                <?php if ($req['status'] == 1) : ?>
                                    <td class="text-center">Approved</td>
                                <?php else : ?>
                                    <td class="text-center">Rejected</td>
                                <?php endif; ?>
                                <td class="text-center"><?= $req['last_update']; ?></td>

                                <td class="text-center">
                                    <a href="<?= $request_url = base_url('/request/detail/') . $req['request_id']; ?>">
                                        <i class="material-icons">description</i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
        </div>

    </div>
</div>