<?php
session_start();
include 'config.php';
// Handlers Aksi CRUD
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $action = $_POST['action'] ?? '';

//     if ($action === 'create') {
//         $nik = $conn->real_escape_string($_POST['nik']);
//         $nama = $conn->real_escape_string($_POST['nama']);
//         $jenis_kelamin = $conn->real_escape_string($_POST['jenis_kelamin']);
//         $tanggal_lahir = $conn->real_escape_string($_POST['tanggal_lahir']);
//         $alamat = $conn->real_escape_string($_POST['alamat']);
//         $pekerjaan = $conn->real_escape_string($_POST['pekerjaan']);

//         $conn->query("INSERT INTO penduduk (nik, nama, jenis_kelamin, tanggal_lahir, alamat, pekerjaan) 
//                       VALUES ('$nik', '$nama', '$jenis_kelamin', '$tanggal_lahir', '$alamat', '$pekerjaan')");
//         echo '<script> window.location="listPenduduk"; </script>';
//         exit();
//     }

//     if ($action === 'edit') {
//         $id = (int)$_POST['id'];
//         $nik = $conn->real_escape_string($_POST['nik']);
//         $nama = $conn->real_escape_string($_POST['nama']);
//         $jenis_kelamin = $conn->real_escape_string($_POST['jenis_kelamin']);
//         $tanggal_lahir = $conn->real_escape_string($_POST['tanggal_lahir']);
//         $alamat = $conn->real_escape_string($_POST['alamat']);
//         $pekerjaan = $conn->real_escape_string($_POST['pekerjaan']);

//         $conn->query("UPDATE penduduk SET 
//                       nik='$nik', nama='$nama', jenis_kelamin='$jenis_kelamin', 
//                       tanggal_lahir='$tanggal_lahir', alamat='$alamat', pekerjaan='$pekerjaan' 
//                       WHERE id=$id");
//         echo '<script> window.location="listPenduduk"; </script>';
//         exit();
//     }

//     if ($action === 'delete') {
//         $id = (int)$_POST['id'];
//         $conn->query("DELETE FROM penduduk WHERE id=$id");
//         echo '<script> window.location="listPenduduk"; </script>';
//         exit();
//     }
// } else {
//     echo '<script> window.location="listPenduduk"; </script>';
//     exit();
// }


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'create') {
        $nik = $conn->real_escape_string($_POST['nik']);
        $nama = $conn->real_escape_string($_POST['nama']);
        $jenis_kelamin = $conn->real_escape_string($_POST['jenis_kelamin']);
        $tanggal_lahir = $conn->real_escape_string($_POST['tanggal_lahir']);
        $alamat = $conn->real_escape_string($_POST['alamat']);
        $pekerjaan = $conn->real_escape_string($_POST['pekerjaan']);

        $query = $conn->query("INSERT INTO penduduk (nik, nama, jenis_kelamin, tanggal_lahir, alamat, pekerjaan) 
                      VALUES ('$nik', '$nama', '$jenis_kelamin', '$tanggal_lahir', '$alamat', '$pekerjaan')");

        if ($query) {
            $_SESSION['toast'] = [
                'type' => 'success',
                'title' => 'Berhasil Ditambahkan',
                'message' => 'Data penduduk baru berhasil disimpan.'
            ];
        } else {
            $_SESSION['toast'] = [
                'type' => 'error',
                'title' => 'Gagal Ditambahkan',
                'message' => 'Terjadi kesalahan saat menyimpan data.'
            ];
        }
        echo '<script> window.location="listPenduduk"; </script>';
        exit();
    }

    if ($action === 'edit') {
        $id = (int)$_POST['id'];
        $nik = $conn->real_escape_string($_POST['nik']);
        $nama = $conn->real_escape_string($_POST['nama']);
        $jenis_kelamin = $conn->real_escape_string($_POST['jenis_kelamin']);
        $tanggal_lahir = $conn->real_escape_string($_POST['tanggal_lahir']);
        $alamat = $conn->real_escape_string($_POST['alamat']);
        $pekerjaan = $conn->real_escape_string($_POST['pekerjaan']);

        $query = $conn->query("UPDATE penduduk SET 
                      nik='$nik', nama='$nama', jenis_kelamin='$jenis_kelamin', 
                      tanggal_lahir='$tanggal_lahir', alamat='$alamat', pekerjaan='$pekerjaan' 
                      WHERE id=$id");

        if ($query) {
            $_SESSION['toast'] = [
                'type' => 'edit',
                'title' => 'Berhasil Diperbarui',
                'message' => 'Perubahan data penduduk berhasil disimpan.'
            ];
        } else {
            $_SESSION['toast'] = [
                'type' => 'error',
                'title' => 'Gagal Diperbarui',
                'message' => 'Terjadi kesalahan saat mengedit data.'
            ];
        }
        echo '<script> window.location="listPenduduk"; </script>';
        exit();
    }

    if ($action === 'delete') {
        $id = (int)$_POST['id'];
        $query = $conn->query("DELETE FROM penduduk WHERE id=$id");

        if ($query) {
            $_SESSION['toast'] = [
                'type' => 'delete',
                'title' => 'Berhasil Dihapus',
                'message' => 'Data penduduk telah dihapus dari sistem.'
            ];
        } else {
            $_SESSION['toast'] = [
                'type' => 'error',
                'title' => 'Gagal Dihapus',
                'message' => 'Terjadi kesalahan saat menghapus data.'
            ];
        }
        echo '<script> window.location="listPenduduk"; </script>';
        exit();
    }
} else {
    echo '<script> window.location="listPenduduk"; </script>';
    exit();
}
