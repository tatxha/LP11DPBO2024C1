<!-- Saya Tattha Maharany Yasmin Akbar dengan NIM 2201805 mengerjakan soal LP 11
dalam Praktikum mata kuliah Desain dan Pemrograman Berbasis Objek, untuk keberkahan-Nya
maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamin. -->

<?php

/******************************************
Asisten Pemrogaman 13
 ******************************************/

include("model/Template.class.php");
include("model/DB.class.php");
include("model/Pasien.class.php");
include("model/TabelPasien.class.php");
include("view/TampilPasien.php");


$tp = new TampilPasien();

if (isset($_GET['action'])) {
    if ($_GET['action'] == 'delete') {
        $tp->deletePasien($_GET['id']); // menggunakan nama function yang dibuat di view
    }
    else if ($_GET['action'] == 'add') {
        $tp->add($_GET);
    }
    else if ($_GET['action'] == 'update') {
        $tp->update($_GET['id']);
    }
}
else if (isset($_POST['action'])) {
    if ($_POST['action'] == 'addPasien') {
        $tp->addPasien($_POST['nik'], $_POST['nama'], $_POST['tempat'], $_POST['tl'], $_POST['gender'], $_POST['email'], $_POST['telp']);
    } 
    else if ($_POST['action'] == 'editPasien') {
        $tp->editPasien($_POST['id'], $_POST['nik'], $_POST['nama'], $_POST['tempat'], $_POST['tl'], $_POST['gender'], $_POST['email'], $_POST['telp']);
    }
}
else {
    $data = $tp->tampil();
}
