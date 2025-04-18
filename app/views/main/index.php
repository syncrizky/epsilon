<?php

$page = $_GET['page'] ?? null;

if ($page === 'home') {
    $this->view('home/index', $data);
} else if ($page === 'product') {
    $this->view('product/index', $data);
} else if ($page === 'contact') {
    $this->view('contact/index', $data);
} else {
    $this->view('home/index', $data);
}
