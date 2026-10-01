CREATE DATABASE IF NOT EXISTS db_penduduk;
USE db_penduduk;

CREATE TABLE IF NOT EXISTS penduduk (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nik VARCHAR(16) NOT NULL UNIQUE,
    nama VARCHAR(100) NOT NULL,
    jenis_kelamin ENUM('Laki-laki', 'Perempuan') NOT NULL,
    tanggal_lahir DATE NOT NULL,
    alamat TEXT NOT NULL,
    pekerjaan VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO penduduk (nik, nama, jenis_kelamin, tanggal_lahir, alamat, pekerjaan) VALUES
('3578010101950001', 'Ahmad Rizky', 'Laki-laki', '1995-01-01', 'Jl. Merdeka No. 12, Surabaya', 'Software Engineer'),
('3578014205980002', 'Siti Aminah', 'Perempuan', '1998-05-02', 'Jl. Pemuda No. 45, Surabaya', 'Desainer Grafis');