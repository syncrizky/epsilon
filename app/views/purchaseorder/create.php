<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="user"></i></div>
                            <?= $data['title']; ?>
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container-xl px-4 mt-4">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-po-tab" data-bs-toggle="tab" data-bs-target="#nav-po" type="button" role="tab" aria-controls="nav-po" aria-selected="true">Purchase Order</button>
                <button class="nav-link" id="nav-products-tab" data-bs-toggle="tab" data-bs-target="#nav-products" type="button" role="tab" aria-controls="nav-products" aria-selected="false" <?php echo (isset($_SESSION['supplier_id']) ? '' : 'disabled') ?>>Products List</button>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-po" role="tabpanel" aria-labelledby="nav-po-tab" tabindex="0">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-header-actions mb-4 mt-3">
                            <div class="card-body">
                                <form action="<?= BASEURL; ?>purchaseorder/create" method="POST">
                                    <div class="mb-3">
                                        <label for="po_number" class="form-label small">PO Number</label>
                                        <input type="text" class="form-control" id="po_number" name="po_number" value="<?= $_SESSION['invoice_number']; ?>" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="supplier" class="form-label small">Supplier</label>
                                        <select class="form-select" id="selectSupplier" name="supplier_id" required data-table="supplier" onchange="setSession(this)">
                                            <option value="" disabled <?= isset($_SESSION['supplier_id']) ? '' : 'selected'; ?>>Select Supplier</option>
                                            <?php foreach ($data['suppliers'] as $supplier) : ?>
                                                <option value="<?= $supplier['id']; ?>" <?= (isset($_SESSION['supplier_id']) && $_SESSION['supplier_id'] == $supplier['id']) ? 'selected' : ''; ?>>
                                                    <?= htmlspecialchars(strtoupper($supplier['name'])); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>


                                    </div>
                                    <div class="mb-3">
                                        <label for="branch" class="form-label small">Shipped To</label>
                                        <select class="form-select" id="branch" name="branch_id" required data-table="branch" onchange="setSession(this)">
                                            <option value="" disabled <?= isset($_SESSION['branch_id']) ? '' : 'selected'; ?>>Select Branch</option>
                                            <?php foreach ($data['branches'] as $branch) : ?>
                                                <option value="<?= $branch['id']; ?>" <?= (isset($_SESSION['branch_id']) && $_SESSION['branch_id'] == $branch['id']) ? 'selected' : ''; ?>>
                                                    <?= htmlspecialchars(strtoupper($branch['name'])); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card card-header-actions mb-4 mt-3">
                            <div class="card-body table-responsive">
                                <table class="table table-hover table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>SKU</th>
                                            <th>Descriptions</th>
                                            <th>HPP</th>
                                            <th>Qty</th>
                                            <th colspan="2">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (isset($_SESSION['cart'])) : ?>
                                            <?php if (count($_SESSION['cart']) == 0) : ?>
                                                <tr>
                                                    <td colspan="6" class="text-center">No products in cart</td>
                                                </tr>
                                            <?php else: ?>
                                                <?php foreach ($_SESSION['cart'] as $product) : ?>
                                                    <tr>
                                                        <td><?= strtoupper(htmlspecialchars($product['sku'])); ?></td>
                                                        <td><?= strtoupper(htmlspecialchars($product['name'])); ?></td>
                                                        <td><?= number_format($product['hpp']); ?></td>
                                                        <td>
                                                            <input type="number" style="width: 70px;" onchange="addQty(this);" data-sku="<?= $product['sku']; ?>" name="inputQty" id="inputQty" value="<?php echo (isset($product['qty'])) ? $product['qty'] : ''; ?>" placeholder="Qty" class="form-control form-control-sm" min="1" required>
                                                        </td>
                                                        <td>
                                                            <?php echo (isset($product['total']) ? number_format($product['total']) : 0); ?>
                                                        </td>
                                                        <td>
                                                            <a href="<?= BASEURL; ?>purchaseorder/removeFromCart/<?= $product['sku']; ?>" class="btn btn-danger btn-sm">X</a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="4" class="text-end">Total Amount</td>
                                            <td colspan="2" class="text-end">
                                                <?= htmlspecialchars(number_format($_SESSION['invoice_amount'])); ?>
                                            </td>
                                        </tr>
                                </table>
                                <div class="text-end">
                                    <a href="<?= BASEURL; ?>purchaseorder/proses" class="btn btn-primary btn-sm">Simpan</a>
                                    <a href="<?= BASEURL; ?>purchaseorder/cancel" class="btn btn-outline-danger btn-sm">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <pre>
    <?php print_r($_SESSION); ?>
</pre>
            <div class="tab-pane fade" id="nav-products" role="tabpanel" aria-labelledby="nav-products-tab" tabindex="0">
                <div class="card card-header-actions mb-4 mt-3">
                    <div class="card-body table-responsive">
                        <table id="myTable" class="table table-hover table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>SKU</th>
                                    <th>Descriptions</th>
                                    <th>Category</th>
                                    <th>HPP</th>
                                    <th>Disc %</th>
                                    <th>HET</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($_SESSION['products'] as $product) : ?>
                                    <tr onclick="location.href='<?= BASEURL; ?>purchaseorder/addToCart/<?= $product['sku']; ?>'">
                                        <td><?= strtoupper(htmlspecialchars($product['sku'])); ?></td>
                                        <td><?= strtoupper(htmlspecialchars($product['name'])); ?></td>
                                        <td><?= strtoupper(htmlspecialchars($product['category'])); ?></td>
                                        <td><?= number_format($product['hpp']); ?></td>
                                        <td><?= number_format($product['discount']); ?></td>
                                        <td><?= number_format($product['het']); ?></td>
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
<script>
    function setSession(selectElement) {
        const valueID = selectElement.value;
        const tableName = selectElement.getAttribute('data-table');
        if (valueID) {
            console.log("ID: " + valueID);
            console.log("Table: " + tableName);

            // Send the data to the server using AJAX
            fetch('<?= BASEURL; ?>purchaseorder/setSession', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        id: valueID,
                        table: tableName
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log('Session set successfully!');
                        location.reload();
                    } else {
                        console.error('Error setting session:', data.error);
                        location.reload();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    }

    function addQty(inputElement) {
        const qty = inputElement.value;
        const sku = inputElement.getAttribute('data-sku');
        window.location.href = '<?= BASEURL; ?>purchaseorder/addQtyToCart/' + sku + '/' + qty;
        // Send the data to the server using AJAX
    }
</script>
