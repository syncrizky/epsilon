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
                        <a class="dropdown-item" href="#!">
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
                            <th>Code</th>
                            <th>Branch Name</th>
                            <th>Location</th>
                            <th>Stock</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['branches'] as $row) : ?>
                            <tr>
                                <td><?= htmlspecialchars(strtoupper($row['code'])); ?></td>
                                <td><?= htmlspecialchars(strtoupper($row['name'])); ?></td>
                                <td><?= htmlspecialchars(strtoupper($row['location'])); ?></td>
                                <td><?= htmlspecialchars(strtoupper($row['stock'])); ?></td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton<?= $row['id']; ?>" data-bs-toggle="dropdown" aria-expanded="false">
                                            Actions
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton<?= $row['id']; ?>">
                                            <li><a class="dropdown-item" href="<?= BASEURL; ?>branch/detail/<?= $row['slug']; ?>">Detail</a></li>

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
