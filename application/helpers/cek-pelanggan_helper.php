<?php
function cek_login_pelanggan()
{
    $ci = get_instance();
    if (!$ci->session->userdata('username')) {
        $ci->session->set_flashdata('message', 'Tidak Dapat Akses, Silahkan Login Kembali!'); // Buat session flashdata
        redirect('autentifikasi');
    } 
}
