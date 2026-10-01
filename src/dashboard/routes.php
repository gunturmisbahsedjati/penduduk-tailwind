<?php
$do = explode("/", $_REQUEST['do']);
$opsi = $do[0];

define('PUB_DIR', dirname(__FILE__) . '/');

switch ($opsi) {
    case 'home':
        require_once(PUB_DIR . 'home.php');
        break;

    //sementara
    case 'listPenduduk':
        require_once(PUB_DIR . 'data-penduduk/data_penduduk.php');
        break;
    case 'setRakorda':
        require_once(PUB_DIR . 'modul/manajemen/rakorda/biodata-aksi.php');
        break;




    //signout
    // case 'logout':
    //     require_once(PUB_DIR . '../signout.php');
    //     break;

    default:
        require_once(PUB_DIR . 'home.php');
}
