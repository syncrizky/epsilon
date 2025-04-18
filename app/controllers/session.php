<?php
class Session extends Controller
{
    public function setDateRange()
    {
        // Periksa apakah request menggunakan metode POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Ambil data JSON dari body request
            $input = file_get_contents('php://input');
            $data = json_decode($input, true);

            // Validasi apakah 'dateRange' ada dalam data
            if (isset($data['dateRange']) && !empty($data['dateRange'])) {
                // Simpan rentang tanggal ke dalam sesi
                $_SESSION['dateRange'] = $data['dateRange'];

                // Kirim respons sukses
                echo json_encode(['success' => true, 'message' => 'Date range saved to session.']);
            } else {
                // Kirim respons gagal jika 'dateRange' tidak valid
                echo json_encode(['success' => false, 'message' => 'Invalid date range.']);
            }
        } else {
            // Kirim respons gagal jika metode request bukan POST
            echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
        }
    }
}
