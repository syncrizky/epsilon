<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="user"></i></div>
                            <?= $data['title']; ?> - Profile
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-4">
        <!-- Account page navigation-->
        <!-- <nav class="nav nav-borders">
            <a class="nav-link active ms-0" href="" data-bs-toggle="tab" data-bs-target="#profile">Profile</a>
        </nav>
        <hr class="mt-0 mb-4" /> -->

        <div class="tab-content">
            <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                <div class="row">
                    <div class="col-xl-4">
                        <!-- Profile picture card-->
                        <div class="card mb-4 mb-xl-0">
                            <div class="card-header"><?= $data['title']; ?></div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="small mb-1" for="inputFirstName">Supplier Name</label>
                                    <input class="form-control" id="inputFirstName" type="text" placeholder="Enter your first name" value="<?= htmlspecialchars(strtoupper($data['supplier']['name'])); ?>" readonly />
                                </div>
                                <div class="mb-3">
                                    <label class="small mb-1" for="inputDescription">Branch Location</label>
                                    <textarea class="form-control" id="inputDescription" name="inputDescription" rows="4" placeholder="Enter branch description" readonly><?= htmlspecialchars(ucwords($data['supplier']['address'])); ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="small mb-1" for="inputFirstName">Supplier Phone</label>
                                    <input class="form-control" id="inputFirstName" type="text" placeholder="Enter your first name" value="<?= htmlspecialchars(strtoupper($data['supplier']['phone'])); ?>" readonly />
                                </div>
                                <div class="mb-3">
                                    <label class="small mb-1" for="inputFirstName">Supplier Email</label>
                                    <input class="form-control" id="inputFirstName" type="text" placeholder="Enter your first name" value="<?= htmlspecialchars(strtoupper($data['supplier']['email'])); ?>" readonly />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <!-- Account details card-->
                        <div class="card card-header-actions mb-4">
                            <div class="card-header">
                                Supplier Products

                            </div>
                            <div class="card-body table-responsive">
                                <table id="myTable" class="table table-hover table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>SKU</th>
                                            <th>Descriptions</th>
                                            <th>Brand</th>
                                            <th>Stock</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($data['products'] as $product) : ?>
                                            <tr>
                                                <td><?= htmlspecialchars(strtoupper($product['sku'])); ?></td>
                                                <td><?= htmlspecialchars(strtoupper($product['name'])); ?></td>
                                                <td><?= htmlspecialchars(strtoupper($product['brand'])); ?></td>
                                                <td><?= htmlspecialchars($product['stock']); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
