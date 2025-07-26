<?php
function cek_login()
{
    $ci = get_instance();
    if (!$ci->session->userdata('username')) {
        $ci->session->set_flashdata('message', 'Tidak Dapat Akses, Silahkan Login Kembali!'); // Buat session flashdata
        redirect('login-admin');
    } else {
        $level_id = $ci->session->userdata('id_level');
    }
}
