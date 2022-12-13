<?php
include_once "dao/MahasiswaDaoImpl.php";
include_once "entity/Mahasiswa.php";
include_once "db-util/PDOUtil.php";

header("content-type: application/json");

$mahasiswaDao = new MahasiswaDaoImpl();
$listMahasiswa = $mahasiswaDao->fetchMahasiswaActive();

echo(json_encode($listMahasiswa));
