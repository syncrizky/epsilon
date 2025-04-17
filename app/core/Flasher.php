<?php
class Flasher
{
    public static function setFlash($type, $title, $message, $link, $textBtn)
    {
        $_SESSION['flash'] = [
            'type' => $type,
            'title' => $title,
            'message' => $message,
            'link' => $link,
            'textBtn' => $textBtn
        ];
    }
    public static function setFlashConfirm($type, $title, $message, $link)
    {
        $_SESSION['flashConfirm'] = [
            'type' => $type,
            'title' => $title,
            'message' => $message,
            'link' => $link
        ];
    }
    public static function setFlashMixin($type, $title)
    {
        $_SESSION['flashMixin'] = [
            'type' => $type,
            'title' => $title
        ];
    }

    public static function flash()
    {
        if (isset($_SESSION['flash'])) {
            echo '
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                    Swal.fire({
                        title: "' . $_SESSION['flash']['title'] . '",
                        text: "' . $_SESSION['flash']['message'] . '",
                        icon: "' . $_SESSION['flash']['type'] . '",
                        showCancelButton: ' . ($_SESSION['flash']['type'] === 'warning' ? 'true' : 'false') . ',
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "' . $_SESSION['flash']['textBtn'] . '",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "' . BASEURL .   $_SESSION['flash']['link'] . '";
                        }
                    });
                  </script>';
            unset($_SESSION['flash']);
        }
    }

    public static function flashConfirm()
    {
        if (isset($_SESSION['flashConfirm'])) {
            echo '
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                    Swal.fire({
                        title: "' . $_SESSION['flashConfirm']['title'] . '",
                        text: "' . $_SESSION['flashConfirm']['message'] . '",
                        icon: "' . $_SESSION['flashConfirm']['type'] . '"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "' . BASEURL . '/' . $_SESSION['flashConfirm']['link'] . '";
                        }
                    });
                  </script>';
            unset($_SESSION['flashConfirm']);
        }
    }

    public static function flashMixin()
    {
        if (isset($_SESSION['flashMixin'])) {
            echo '
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                    });
                    Toast.fire({
                    icon: "' . $_SESSION['flashMixin']['type'] . '",
                    title: "' . $_SESSION['flashMixin']['title'] . '"
                    });
                  </script>';
            unset($_SESSION['flashMixin']);
        }
    }
}
