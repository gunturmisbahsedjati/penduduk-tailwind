<?php
$do = explode("/", $_REQUEST['do']);
$opsi = $do[0];

define('PUB_DIR', dirname(__FILE__) . '/');

switch ($opsi) {
    case 'home':
        require_once(PUB_DIR . 'home.php');
        break;


    case 'listPenduduk':
        require_once(PUB_DIR . 'data-penduduk/data_penduduk.php');
        break;
    case 'setListPenduduk':
        require_once(PUB_DIR . 'data-penduduk/penduduk_aksi.php');
        break;
    case 'listPengguna':
        require_once(PUB_DIR . 'data-pengguna/data_pengguna.php');
        break;
    case 'setListPengguna':
        require_once(PUB_DIR . 'data-pengguna/pengguna_aksi.php');
        break;




    //signout
    // case 'logout':
    //     require_once(PUB_DIR . '../signout.php');
    //     break;

    default:
        require_once(PUB_DIR . 'home.php');
}
