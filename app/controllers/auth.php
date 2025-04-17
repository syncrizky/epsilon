<?php
class Auth extends Controller
{
    public function index()
    {
        if (isset($_SESSION['auth'])) {
            header('Location: ' . BASEURL . 'home/index');
            exit;
        }
        if (isset($_COOKIE['remember_token'])) {
            $token = htmlspecialchars($_COOKIE['remember_token'], ENT_QUOTES, 'UTF-8');
            $user = $this->model('Auth_model')->getUserByToken($token);
            if ($user) {
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'name' => $user['first_name'] . ' ' . $user['last_name'],
                    'role' => $user['role'],
                    'phone' => $user['whatsapp']
                ];
                header('Location: ' . BASEURL . 'home/index');
            }
        }

        $data['title'] = 'Authentication';
        $this->view('auth/index', $data);
    }

    public function register()
    {
        if (isset($_SESSION['auth'])) {
            header('Location: ' . BASEURL . 'home/index');
            exit;
        }
        $data['title'] = 'Register';
        $this->view('auth/register', $data);
    }

    public function login()
    {
        if (isset($_SESSION['auth'])) {
            header('Location: ' . BASEURL . 'home/index');
            exit;
        }
        $remember = isset($_POST['rememberPasswordCheck']);
        $user = $this->model('Auth_model')->checkUsername($_POST['inputUsername']);

        if ($user) {
            if ($user['is_active'] == 1) {

                if (password_verify($_POST['inputPassword'], $user['password'])) {
                    $_SESSION['user'] = [
                        'id' => $user['id'],
                        'username' => $user['username'],
                        'name' => $user['first_name'] . ' ' . $user['last_name'],
                        'role' => $user['role'],
                        'phone' => $user['whatsapp']
                    ];

                    $userAgent = $_SERVER['HTTP_USER_AGENT'];
                    $ip = $_SERVER['REMOTE_ADDR'];

                    $knownDevices = $this->model('Device_model')->isKnownDevice($user['id'], $userAgent, $ip);
                    if (!$knownDevices) {
                        $this->model('Device_model')->saveDevice($user['id'], $userAgent, $ip);

                        // --- Notifikasi: Bisa kirim email, atau tampilkan alert session
                        $_SESSION['new_device_notice'] = "Login dari perangkat baru: $ip";
                    }

                    if ($remember) {
                        $token = bin2hex(random_bytes(32));
                        $cookieSet = setcookie('remember_token', $token, time() + (86400 * 30), '/'); // 86400 = 1 day
                        if (!$cookieSet) {
                            error_log('Failed to set cookie for remember_token');
                        }
                        $this->model('Auth_model')->updateRememberToken($user['id'], $token);
                    }

                    if ($user['is_reset'] == 1) {
                        header('Location: ' . BASEURL . 'auth/changePassword');
                        exit;
                    }

                    Flasher::setFlash('success', 'Welcome back, ' . $user['first_name'] . '!', 'You have successfully logged in.', 'home/index', 'Go to Dashboard');
                    header('Location: ' . BASEURL . 'auth/index');
                    exit;
                } else {
                    Flasher::setFlash('error', 'Login Failed', 'Invalid password.', 'auth/index', 'Try again');
                    header('Location: ' . BASEURL . 'auth/index');
                    exit;
                }
            } else {

                $otp = rand(100000, 999999);
                $phone = htmlspecialchars($_POST['inputPhone'], ENT_QUOTES, 'UTF-8');
                $_SESSION['otp_expired'] = time() + (5 * 60); // expire dalam 5 menit
                $_SESSION['otp'] = $otp;
                $_SESSION['whatsapp_number'] = $user['whatsapp'];

                // Kirim OTP via Fonnte
                $message = "Kode OTP kamu adalah *$otp*. Jangan berikan kepada siapa pun.";
                $this->model('Message_model')->sendMessage($user['whatsapp'], $message);

                Flasher::setFlash('error', 'Account Inactive', 'Please verify no phone.', 'auth/verify', 'Verify Now');
                header('Location: ' . BASEURL . 'auth/index');
                exit;
            }
        } else {
            Flasher::setFlash('error', 'Login Failed', 'Invalid username.', 'auth/index', 'Try again');
            header('Location: ' . BASEURL . 'auth/index');
            exit;
        }
    }

    public function verify()
    {

        $data['title'] = 'Authentication';
        $this->view('auth/verify_phone', $data);
    }

    public function verify_phone()
    {
        if (isset($_SESSION['auth'])) {
            header('Location: ' . BASEURL . 'home/index');
            exit;
        }

        $expired = $_SESSION['otp_expired'] ?? 0;
        if (time() > $expired) {
            echo "OTP telah kedaluwarsa. Silakan daftar ulang atau minta OTP baru.";
            session_unset(); // opsional, hapus data otp lama
            return;
        }

        if (isset($_POST['inputOtp'])) {
            $otp = htmlspecialchars($_POST['inputOtp'], ENT_QUOTES, 'UTF-8');
            if ($otp == $_SESSION['otp']) {
                unset($_SESSION['otp']);
                Flasher::setFlashMixin('success', 'Verification successful! Please login.');
                $this->model('Auth_model')->updateIsActive($_SESSION['whatsapp_number']);
                header('Location: ' . BASEURL . 'auth/index');
                exit;
            } else {
                Flasher::setFlashMixin('error', 'Invalid OTP! Please try again.');
                header('Location: ' . BASEURL . 'auth/verify');
                exit;
            }
        } else {
            Flasher::setFlashMixin('error', 'OTP is required! Please try again.');
            header('Location: ' . BASEURL . 'auth/verify');
            exit;
        }
    }

    public function registration()
    {
        if (isset($_SESSION['auth'])) {
            header('Location: ' . BASEURL . 'home/index');
            exit;
        }

        if ($this->model('Auth_model')->registerUser($_POST) > 0) {
            Flasher::setFlashMixin('success', 'Registration successful! Please login.');

            $otp = rand(100000, 999999);
            $phone = htmlspecialchars($_POST['inputPhone'], ENT_QUOTES, 'UTF-8');
            $_SESSION['otp'] = $otp;
            $_SESSION['whatsapp_number'] = htmlspecialchars($_POST['inputPhone'], ENT_QUOTES, 'UTF-8');

            // Kirim OTP via Fonnte
            $message = "Kode OTP kamu adalah *$otp*. Jangan berikan kepada siapa pun.";
            $this->model('Message_model')->sendMessage($phone, $message);

            header('Location: ' . BASEURL . 'auth/verify');
            exit;
        } else {
            Flasher::setFlashMixin('error', 'Registration failed! Please try again.');
            header('Location: ' . BASEURL . 'auth/register');
            exit;
        }
    }

    public function checkUsername()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $username = $data['username'];

        $user = $this->model('Auth_model')->checkUsername($username);
        if ($user) {
            echo json_encode(['status' => 'exists']);
        } else {
            echo json_encode(['status' => 'available']);
        }
    }

    public function checkPhone()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $phone = $data['phone'];

        $user = $this->model('Auth_model')->checkPhone($phone);
        if ($user) {
            echo json_encode(['status' => 'exists']);
        } else {
            echo json_encode(['status' => 'available']);
        }
    }

    public function forgotPassword()
    {
        if (isset($_SESSION['auth'])) {
            header('Location: ' . BASEURL . 'home/index');
            exit;
        }
        $data['title'] = 'Forgot Password';
        $this->view('auth/forgot_password', $data);
    }

    public function passwordRecovery()
    {
        if (isset($_SESSION['auth'])) {
            header('Location: ' . BASEURL . 'home/index');
            exit;
        }

        $password = bin2hex(random_bytes(4)); // Generate a random password
        $passwordHash = password_hash($password, PASSWORD_BCRYPT); // Generate and hash a random password

        $_SESSION['phone'] = htmlspecialchars($_POST['inputWhatsapp'], ENT_QUOTES, 'UTF-8');
        $this->model('Auth_model')->resetPasswordByPhone($_SESSION['phone'], $passwordHash);
        $user = $this->model('Auth_model')->getUserByPhone($_SESSION['phone']);

        if ($user) {

            // Kirim OTP via Fonnte
            $message = "Password Kamu adalah *$password*. Mohon segera rubah password.";
            $this->model('Message_model')->sendMessage($_SESSION['phone'], $message);

            Flasher::setFlashMixin('success', 'Reset Password Done! You Can Login Again.');
            header('Location: ' . BASEURL . 'auth/index');
            exit;
        } else {
            Flasher::setFlashMixin('error', 'Phone number not registered! Please try again.');
            header('Location: ' . BASEURL . 'auth/forgotPassword');
            exit;
        }
    }

    public function changePassword()
    {
        if (isset($_SESSION['auth'])) {
            header('Location: ' . BASEURL . 'home/index');
            exit;
        }
        $data['title'] = 'Change Password';
        $this->view('auth/change_password', $data);
    }

    public function updatePassword()
    {
        if (isset($_SESSION['auth'])) {
            header('Location: ' . BASEURL . 'home/index');
            exit;
        }

        $password = htmlspecialchars($_POST['inputPassword'], ENT_QUOTES, 'UTF-8');

        $this->model('Auth_model')->updatePassword($_SESSION['user']['phone'], $password);
        unset($_SESSION['phone']);

        Flasher::setFlashMixin('success', 'Password changed successfully! You can login again.');
        header('Location: ' . BASEURL . 'auth/index');
        exit;
    }

    public function logout()
    {
        session_destroy();
        unset($_SESSION['auth']);
        setcookie('remember_token', '', time() - 3600, "/");
        header('Location: ' . BASEURL . 'auth/index');
        exit;
    }
}
