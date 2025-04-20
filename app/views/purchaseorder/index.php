<main>
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

        <div class="card card-header-actions mb-4">
            <div class="card-header">
                All Purchase Order
                <div class="dropdown no-caret">
                    <button class="btn btn-transparent-dark btn-icon dropdown-toggle" id="dropdownMenuButton" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="text-gray-500" data-feather="more-vertical"></i></button>
                    <div class="dropdown-menu dropdown-menu-end animated--fade-in-up" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="<?= BASEURL; ?>purchaseorder/create">
                            <div class="dropdown-item-icon"><i class="text-gray-500" data-feather="plus-circle"></i></div>
                            Add Purchase Order
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table id="myTable" class="table table-hover table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Supplier</th>
                            <th>Shipped</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['purchase_orders'] as $row) : ?>
                            <tr>
                                <td><?= htmlspecialchars(strtoupper($row['invoice_number'])); ?></td>
                                <td><?= htmlspecialchars(strtoupper($row['invoice_date'])); ?></td>
                                <td><?= htmlspecialchars(strtoupper($row['supplier_name'])); ?></td>
                                <td><?= htmlspecialchars(strtoupper($row['branch_name'])); ?></td>
                                <td>Rp. <?= htmlspecialchars(number_format($row['invoice_amount'])); ?></td>
                                <td>
                                    <?php if ($row['invoice_status'] == 'draft'): ?>
                                        <span class="badge text-bg-warning"><?= htmlspecialchars(ucwords($row['invoice_status'])); ?></span>
                                    <?php elseif ($row['invoice_status'] == 'approved'): ?>
                                        <span class="badge text-bg-success"><?= htmlspecialchars(ucwords($row['invoice_status'])); ?></span>
                                    <?php elseif ($row['invoice_status'] == 'incoming'): ?>
                                        <span class="badge text-bg-primary"><?= htmlspecialchars(ucwords($row['invoice_status'])); ?></span>
                                    <?php elseif ($row['invoice_status'] == 'completed'): ?>
                                        <span class="badge text-bg-secondary"><?= htmlspecialchars(ucwords($row['invoice_status'])); ?></span>
                                    <?php elseif ($row['invoice_status'] == 'canceled'): ?>
                                        <span class="badge text-bg-danger"><?= htmlspecialchars(ucwords($row['invoice_status'])); ?></span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton<?= $row['id']; ?>" data-bs-toggle="dropdown" aria-expanded="false">
                                            Actions
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton<?= $row['id']; ?>">
                                            <li><a class="dropdown-item" href="<?= BASEURL; ?>purchasing/purchase_order_detail/<?= $row['id']; ?>">Detail</a></li>

                                        </ul>
                                    </div>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
