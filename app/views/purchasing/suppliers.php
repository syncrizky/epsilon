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
                All <?= $data['title']; ?>
                <div class="dropdown no-caret">
                    <button class="btn btn-transparent-dark btn-icon dropdown-toggle" id="dropdownMenuButton" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="text-gray-500" data-feather="more-vertical"></i></button>
                    <div class="dropdown-menu dropdown-menu-end animated--fade-in-up" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#!" data-bs-toggle="modal" data-bs-target="#addSupplierModal">
                            <div class="dropdown-item-icon"><i class="text-gray-500" data-feather="plus-circle"></i></div>
                            Add <?= $data['title']; ?>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table id="myTable" class="table table-hover table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['suppliers'] as $row) : ?>
                            <tr>
                                <td><?= htmlspecialchars(strtoupper($row['name'])); ?></td>
                                <td><?= htmlspecialchars(strtoupper($row['address'])); ?></td>
                                <td><?= htmlspecialchars(strtoupper($row['phone'])); ?></td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton<?= $row['id']; ?>" data-bs-toggle="dropdown" aria-expanded="false">
                                            Actions
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton<?= $row['id']; ?>">
                                            <li><a class="dropdown-item" href="<?= BASEURL; ?>supplier/supplier_detail/<?= $row['id']; ?>">Detail</a></li>

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
<!-- Add Supplier Modal -->
<div class="modal fade" id="addSupplierModal" tabindex="-1" aria-labelledby="addSupplierModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="<?= BASEURL; ?>supplier/add_supplier" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSupplierModalLabel">Add Supplier</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="name" autocomplete="off" required oninput="this.value = this.value.replace(/[^a-zA-Z0-9\s]/g, '')">
                                <label for="floatingInput">Supplier Name</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" minlength="6" placeholder="name@example.com" name="phone" autocomplete="off" required oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                <label for="floatingInput">No. Phone</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" name="address" autocomplete="off" style="height: 100px"></textarea>
                            <label for="floatingTextarea2">Alamat Supplier</label>
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com" autocomplete="off" required>
                        <label for="floatingInput">Email address</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Supplier</button>
                </div>
            </form>
        </div>
    </div>
</div>
