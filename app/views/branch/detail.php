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
        <nav class="nav nav-borders">
            <a class="nav-link active ms-0" href="" data-bs-toggle="tab" data-bs-target="#profile">Profile</a>
            <a class="nav-link ms-0" href="" data-bs-toggle="tab" data-bs-target="#stocks">Stock</a>
        </nav>
        <hr class="mt-0 mb-4" />

        <div class="tab-content">
            <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                <div class="row">
                    <div class="col-xl-4">
                        <!-- Profile picture card-->
                        <div class="card mb-4 mb-xl-0">
                            <div class="card-header">Branch Logo</div>
                            <div class="card-body text-center">
                                <!-- Profile picture image-->
                                <img class="img-account-profile rounded-circle mb-2" src="<?= BASEURL; ?>assets/img/illustrations/profiles/profile-1.png" alt="" />
                                <!-- Profile picture help block-->
                                <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                                <!-- Profile picture upload button-->
                                <button class="btn btn-primary" type="button">Upload new image</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <!-- Account details card-->
                        <div class="card mb-4">
                            <div class="card-header">Branch Details</div>
                            <div class="card-body">
                                <form>
                                    <!-- Form Row-->
                                    <div class="row gx-3 mb-3">
                                        <!-- Form Group (first name)-->
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="inputFirstName">Branch Code</label>
                                            <input class="form-control" id="inputFirstName" type="text" placeholder="Enter your first name" value="<?= htmlspecialchars(strtoupper($data['branch']['code'])); ?>" readonly />
                                        </div>
                                        <!-- Form Group (last name)-->
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="inputLastName">Branch Name</label>
                                            <input class="form-control" id="inputLastName" type="text" placeholder="Enter your last name" value="<?= htmlspecialchars(strtoupper($data['branch']['name'])); ?>" readonly />
                                        </div>
                                    </div>
                                    <!-- Form Group (branch description)-->
                                    <div class="mb-3">
                                        <label class="small mb-1" for="inputDescription">Branch Location</label>
                                        <textarea class="form-control" id="inputDescription" name="inputDescription" rows="4" placeholder="Enter branch description" readonly><?= htmlspecialchars(ucwords($data['branch']['location'])); ?></textarea>
                                    </div>
                                    <!-- Form Row        -->

                                    <!-- Form Row-->
                                    <div class="row gx-3 mb-3">
                                        <!-- Form Group (phone number)-->
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="inputWhatsapp">No. Phone</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="inputWhatsapp" name="inputWhatsapp" placeholder="Masukan No Whatsapp" value="<?= htmlspecialchars($data['branch']['phone']); ?>" readonly />
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Save changes button-->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="stocks" role="tabpanel" aria-labelledby="stock-tab" tabindex="0">
                <div class="card card-header-actions mb-4">
                    <div class="card-header">
                        Branch Stocks
                    </div>
                    <div class="card-body table-responsive">
                        <table id="myTable" class="table table-hover table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>SKU</th>
                                    <th>Descriptions</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data['stock_branches'] as $row) : ?>
                                    <tr>
                                        <td><?= htmlspecialchars(strtoupper($row['sku'])); ?></td>
                                        <td><?= htmlspecialchars(strtoupper($row['name'])); ?></td>
                                        <td><?= htmlspecialchars(strtoupper($row['qty'])); ?> Pcs</td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
