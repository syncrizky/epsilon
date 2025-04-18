<main>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-5">
        <!-- Custom page header alternative example-->
        <div class="d-flex justify-content-between align-items-sm-center flex-column flex-sm-row mb-4">
            <div class="me-4 mb-3 mb-sm-0">
                <h1 class="mb-0"><?= $data['title']; ?></h1>
                <div class="small">
                    <span id="currentDateTime" class="fw-500 text-primary"></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <!-- Dashboard info widget 1-->
                <div class="card border-start-lg border-start-primary h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div class="small fw-bold text-primary mb-1">Total Product</div>
                                <div class="h5"><?= $data['product_count']; ?> Pcs</div>
                            </div>
                            <div class="ms-2"><i class="fas fa-suitcase fa-2x text-gray-200"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <!-- Dashboard info widget 2-->
                <div class="card border-start-lg border-start-secondary h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div class="small fw-bold text-secondary mb-1">Total Stock</div>
                                <div class="h5">0 Pcs</div>
                            </div>
                            <div class="ms-2"><i class="fas fa-boxes-stacked fa-2x text-gray-200"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <!-- Dashboard info widget 3-->
                <div class="card border-start-lg border-start-success h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div class="small fw-bold text-success mb-1">Stock In (Today)</div>
                                <div class="h5">0 Pcs</div>
                            </div>
                            <div class="ms-2"><i class="fas fa-boxes-packing fa-2x text-gray-200"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <!-- Dashboard info widget 4-->
                <div class="card border-start-lg border-start-info h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div class="small fw-bold text-info mb-1">Stock Out (Today)</div>
                                <div class="h5">0 Pcs</div>
                            </div>
                            <div class="ms-2"><i class="fas fa-boxes-packing fa-2x text-gray-200"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xxl-4 col-xl-6 mb-4">
                <div class="card card-header-actions h-100">
                    <div class="card-header">
                        Recent Activity
                        <div class="dropdown no-caret">
                            <button class="btn btn-transparent-dark btn-icon dropdown-toggle" id="dropdownMenuButton" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="text-gray-500" data-feather="more-vertical"></i></button>
                            <div class="dropdown-menu dropdown-menu-end animated--fade-in-up" aria-labelledby="dropdownMenuButton">
                                <h6 class="dropdown-header">Filter Activity:</h6>
                                <a class="dropdown-item" href="#!"><span class="badge bg-green-soft text-green my-1">Commerce</span></a>
                                <a class="dropdown-item" href="#!"><span class="badge bg-blue-soft text-blue my-1">Reporting</span></a>
                                <a class="dropdown-item" href="#!"><span class="badge bg-yellow-soft text-yellow my-1">Server</span></a>
                                <a class="dropdown-item" href="#!"><span class="badge bg-purple-soft text-purple my-1">Users</span></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="timeline timeline-xs">
                            <?php foreach ($data['logs'] as $row): ?>
                                <!-- Timeline Item 1-->
                                <div class="timeline-item">
                                    <div class="timeline-item-marker">
                                        <div class="timeline-item-marker-text">
                                            <?php
                                            echo waktu_lalu_dff($row['created_at']);
                                            ?>
                                        </div>
                                        <div class="timeline-item-marker-indicator bg-green"></div>
                                    </div>
                                    <div class="timeline-item-content">
                                        <div class="fw-bold text-gray-800"><?= htmlspecialchars($row['action']); ?></div>
                                        <div class="text-gray-500"><?= htmlspecialchars($row['description']); ?></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-4 col-xl-6 mb-4">
                <div class="card card-header-actions h-100">
                    <div class="card-header">
                        Products Stock Tracker
                    </div>
                    <div class="card-body">
                        <?php foreach ($data['products'] as $row): ?>
                            <h4 class="small">
                                <?= htmlspecialchars(strtoupper($row['name'])); ?>
                                <span class="float-end fw-bold"><?= htmlspecialchars($row['stock']); ?> Pcs</span>
                            </h4>
                            <div class="progress mb-4">
                                <?php
                                $stockPercentage = htmlspecialchars($row['stock']);
                                $progressBarColor = $stockPercentage > 50 ? 'bg-success' : ($stockPercentage > 20 ? 'bg-warning' : 'bg-danger');
                                ?>
                                <div class="progress-bar <?= $progressBarColor; ?>" role="progressbar" style="width: <?= $stockPercentage; ?>%"></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="card-footer position-relative">
                        <div class="d-flex align-items-center justify-content-between small text-body">
                            <a class="stretched-link text-body" href="<?= BASEURL; ?>product">Visit Stock Products</a>
                            <i class="fas fa-angle-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
function waktu_lalu_dff($waktu_database)
{
    $waktu_post = new DateTime($waktu_database);
    $sekarang = new DateTime();
    $diff = $sekarang->diff($waktu_post);

    if ($diff->y > 0) return $diff->y . ' year';
    elseif ($diff->m > 0) return $diff->m . ' month';
    elseif ($diff->d > 0) return $diff->d . ' day';
    elseif ($diff->h > 0) return $diff->h . ' hours';
    elseif ($diff->i > 0) return $diff->i . ' min';
    else return 'just now';
} ?>
