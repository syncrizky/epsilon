<main>
    <header class="py-10 mb-4 bg-gradient-primary-to-secondary">
        <div class="container-xl px-4">
            <div class="text-center">
                <h1 class="text-white">Welcome to <?= APP_NAME; ?></h1>
                <p class="lead mb-0 text-white-50">A professionally designed admin panel template built with Bootstrap 5</p>
            </div>
        </div>
    </header>
    <div class="container">
        <?php if ($_SESSION['user'] && $_SESSION['user']['phone'] == null): ?>
            <div class="alert alert-warning" role="alert">
                Please update your phone number in your profile settings. <a href="<?= BASEURL; ?>account" class="alert-link">Click here to update</a>.
            </div>
        <?php endif; ?>
    </div>
    <!-- <?php
            if (isset($_COOKIE['remember_token'])) {
                echo "Cookie 'remember_token' ada. Isinya: " . $_COOKIE['remember_token'];
            } else {
                echo "Cookie 'remember_token' tidak ditemukan.";
            }
            ?> -->
    <?php
    if (isset($_SESSION['new_device_notice'])) {
        echo "<div style='color:red'>" . $_SESSION['new_device_notice'] . "</div>";
        unset($_SESSION['new_device_notice']); // tampilkan sekali
    } ?>
    <pre>
        <?php print_r($_SESSION); ?>
    </pre>
</main>
