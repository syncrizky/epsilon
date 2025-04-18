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
                All Products
                <div class="dropdown no-caret">
                    <button class="btn btn-transparent-dark btn-icon dropdown-toggle" id="dropdownMenuButton" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="text-gray-500" data-feather="more-vertical"></i></button>
                    <div class="dropdown-menu dropdown-menu-end animated--fade-in-up" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#!" data-bs-toggle="modal" data-bs-target="#addProductModal">
                            <div class="dropdown-item-icon"><i class="text-gray-500" data-feather="plus-circle"></i></div>
                            Add Product
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table id="myTable" class="table table-hover table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>SKU</th>
                            <th>Descriptions</th>
                            <th>Brand</th>
                            <th>Category</th>
                            <th>Group</th>
                            <th>Stock</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['products'] as $product) : ?>
                            <tr>
                                <td><?= htmlspecialchars(strtoupper($product['sku'])); ?></td>
                                <td><?= htmlspecialchars(strtoupper($product['name'])); ?></td>
                                <td><?= htmlspecialchars(strtoupper($product['brand'])); ?></td>
                                <td><?= htmlspecialchars(strtoupper($product['category'])); ?></td>
                                <td><?= htmlspecialchars(strtoupper($product['group'])); ?></td>
                                <td><?= htmlspecialchars($product['stock']); ?></td>
                                <td><?= htmlspecialchars(number_format($product['price'], 2)); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<!-- Modal Add Product -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= BASEURL; ?>product/add" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="small mb-1" for="inputProductSku">Product SKU</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Enter product sku" name="inputProductSku" id="input" data-description="Product Sku" data-link="product/checkProductSku" required autocomplete="off" />
                                <button class="btn btn-outline-primary" type="button" onclick="checkInput();"><i class="fa-solid fa-check-double"></i></button>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="small mb-1" for="inputProductDesc">Descriptions</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Enter product descriptions" name="inputProductDesc" required autocomplete="off" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="small mb-1" for="inputBrand">Brand</label>
                            <select class="form-select" name="inputBrand">
                                <option value="" disabled selected>Open this select brand</option>
                                <?php foreach ($data['brands'] as $brand) : ?>
                                    <option value="<?= $brand['id']; ?>"><?= htmlspecialchars(strtoupper($brand['name'])); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="small mb-1" for="inputCategory">Category</label>
                            <select class="form-select" name="inputCategory" required>
                                <option value="" disabled selected>Open this select category</option>
                                <option value="TIRE RELATED PRODUCT">TIRE RELATED PRODUCT</option>
                                <option value="NOT ENGINE & NON TIRE">NOT ENGINE & NON TIRE</option>
                                <option value="ENGINE RELATED PRODUCT">ENGINE RELATED PRODUCT</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="small mb-1" for="inputGroup">Group</label>
                            <select class="form-select" name="inputGroup" required>
                                <option value="" disabled selected>Open this select group</option>
                                <option value="TUBETYPE">TUBETYPE</option>
                                <option value="TUBELESS">TUBELESS</option>
                                <option value="INNERTUBE">INNERTUBE</option>
                                <option value="TYRE SEALENT">TYRE SEALENT</option>
                                <option value="VALVE">VALVE</option>
                                <option value="OIL MECHINE">OIL MECHINE</option>
                                <option value="GEAR OIL">GEAR OIL</option>
                                <option value="ACCU">ACCU</option>
                                <option value="CHEMICAL">CHEMICAL</option>
                                <option value="BRAKE">BRAKE</option>
                                <option value="V BELT">V BELT</option>
                                <option value="ROLLER">ROLLER</option>
                                <option value="AIR FILTER">AIR FILTER</option>
                                <option value="SPARK PLUG">SPARK PLUG</option>
                                <option value="LAMP">LAMP</option>
                                <option value="PART">PART</option>
                                <option value="CLUTCH">CLUTCH</option>
                            </select>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" onclick="return validateForm();">Save Product</button>
                </div>
            </form>
        </div>
    </div>
</div>
