CREATE TABLE `activity_logs` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `user_id` int(11) NOT NULL,
    `action` varchar(100) NOT NULL,
    `description` varchar(255) NOT NULL,
    `created_at` datetime NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 40 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

CREATE TABLE `branches` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `code` varchar(100) NOT NULL,
    `name` varchar(100) NOT NULL,
    `location` varchar(255) NOT NULL,
    `phone` varchar(13) NOT NULL,
    `stock` int(11) NOT NULL,
    `created_at` datetime DEFAULT NULL,
    `slug` varchar(100) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 2 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

CREATE TABLE `brands` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(100) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 3 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

CREATE TABLE `menu_sub` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `menu_id` int(11) NOT NULL,
    `name` varchar(100) NOT NULL,
    `link` varchar(100) NOT NULL,
    `slug` varchar(100) NOT NULL,
    `role_id` int(11) DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 11 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

CREATE TABLE `menus` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(100) NOT NULL,
    `slug` varchar(100) NOT NULL,
    `link` varchar(100) DEFAULT NULL,
    `have_sub` int(11) NOT NULL DEFAULT 0,
    `feather_ico` varchar(10) DEFAULT NULL,
    `role_id` int(11) DEFAULT NULL,
    `que` int(11) DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 6 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

CREATE TABLE `products` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `sku` varchar(100) NOT NULL,
    `name` varchar(255) NOT NULL,
    `brand_id` int(11) NOT NULL,
    `supplier_id` int(11) NOT NULL,
    `category` varchar(100) NOT NULL,
    `grup` varchar(100) NOT NULL,
    `stock` int(100) NOT NULL DEFAULT 0,
    `het` double(10, 2) NOT NULL DEFAULT 0.00,
    `discount` int(11) DEFAULT NULL,
    `hpp` double(10, 2) DEFAULT 0.00,
    `price` double(10, 2) NOT NULL DEFAULT 0.00,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 14 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

CREATE TABLE `purchase_invoice_items` (
    `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
    `invoice_id` int(11) NOT NULL COMMENT 'Invoice ID',
    `product_sku` varchar(100) NOT NULL COMMENT 'Product SKU',
    `quantity` int(11) NOT NULL COMMENT 'Quantity',
    `unit_price` decimal(10, 2) NOT NULL COMMENT 'Unit Price',
    `total_price` decimal(10, 2) NOT NULL COMMENT 'Total Price',
    `created_at` datetime DEFAULT NULL COMMENT 'Create Time',
    `update_time` datetime DEFAULT NULL COMMENT 'Update Time',
    `create_user_id` int(11) DEFAULT NULL COMMENT 'Create User ID',
    `update_user_id` int(11) DEFAULT NULL COMMENT 'Update User ID',
    PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 29 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

CREATE TABLE `purchase_invoices` (
    `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
    `invoice_number` varchar(50) NOT NULL COMMENT 'Invoice Number',
    `supplier_id` int(11) NOT NULL COMMENT 'Customer ID',
    `branch_id` int(11) NOT NULL COMMENT 'Branch ID',
    `invoice_date` date NOT NULL COMMENT 'Invoice Date',
    `invoice_amount` decimal(10, 2) NOT NULL COMMENT 'Invoice Amount',
    `invoice_status` enum(
        'draft',
        'approve',
        'incoming',
        'cancelled'
    ) NOT NULL COMMENT 'Invoice Status',
    `created_at` timestamp NULL DEFAULT NULL COMMENT 'Create Time',
    `update_time` datetime DEFAULT NULL COMMENT 'Update Time',
    `create_user_id` int(11) DEFAULT NULL COMMENT 'Create User ID',
    `update_user_id` int(11) DEFAULT NULL COMMENT 'Update User ID',
    PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 31 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

CREATE TABLE `stock_items` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `branch_id` int(11) NOT NULL,
    `product_id` int(11) NOT NULL,
    `qty` int(11) NOT NULL,
    `updated_at` datetime NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 3 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

CREATE TABLE `stock_mutations` (
    `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
    `product_id` int(11) NOT NULL COMMENT 'Product ID',
    `branch_id` int(11) NOT NULL COMMENT 'Branch ID',
    `quantity` decimal(10, 2) NOT NULL COMMENT 'Quantity',
    `mutation_type` enum('In', 'Out') NOT NULL COMMENT 'Mutation Type',
    `create_time` datetime DEFAULT NULL COMMENT 'Create Time',
    `update_time` datetime DEFAULT NULL COMMENT 'Update Time',
    `create_user_id` int(11) DEFAULT NULL COMMENT 'Create User ID',
    `update_user_id` int(11) DEFAULT NULL COMMENT 'Update User ID',
    PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

CREATE TABLE `suppliers` (
    `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
    `name` varchar(100) NOT NULL COMMENT 'Supplier Name',
    `address` varchar(255) DEFAULT NULL COMMENT 'Address',
    `phone` varchar(50) DEFAULT NULL COMMENT 'Phone Number',
    `email` varchar(100) DEFAULT NULL COMMENT 'Email Address',
    `create_time` datetime DEFAULT NULL COMMENT 'Create Time',
    `update_time` datetime DEFAULT NULL COMMENT 'Update Time',
    `create_user_id` int(11) DEFAULT NULL COMMENT 'Create User ID',
    `update_user_id` int(11) DEFAULT NULL COMMENT 'Update User ID',
    `discount` int(11) DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 4 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

CREATE TABLE `user_devices` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `user_id` int(11) NOT NULL,
    `user_agent` text DEFAULT NULL,
    `ip_address` varchar(45) DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT current_timestamp(),
    PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 4 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

CREATE TABLE `users` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `first_name` varchar(20) NOT NULL,
    `last_name` varchar(20) NOT NULL,
    `username` varchar(20) NOT NULL,
    `password` varchar(255) NOT NULL,
    `remember_token` varchar(255) DEFAULT NULL,
    `whatsapp` varchar(12) DEFAULT NULL,
    `role` enum('admin', 'user', '', '') NOT NULL DEFAULT 'user',
    `is_active` int(11) NOT NULL DEFAULT 0,
    `is_reset` int(11) NOT NULL DEFAULT 0,
    `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
    PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 12 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;
