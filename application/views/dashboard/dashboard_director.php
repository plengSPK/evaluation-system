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
                
                <table class="table" id="dashboard_manager_pending" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">#</th>
                            <th scope="col">Name</th>
                            <th scope="col" class="text-center">Pending Status</th>
                            <th scope="col" class="text-center">View</th>
                        </tr>
                    </thead>
                    <tbody>
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

                                <td class="text-center">
                                    <a href="<?= $request_url; ?>">
                                        <i class="material-icons">description</i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
            <div class="tab-pane fade" id="history" role="tabpanel" aria-labelledby="history-tab">
                history
            </div>
        </div>

    </div>
</div>