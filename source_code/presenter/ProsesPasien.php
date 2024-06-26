<!-- Saya Tattha Maharany Yasmin Akbar dengan NIM 2201805 mengerjakan soal LP 11
dalam Praktikum mata kuliah Desain dan Pemrograman Berbasis Objek, untuk keberkahan-Nya
maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamin. -->

<?php

include("KontrakPresenter.php");


class ProsesPasien implements KontrakPresenter
{
	private $tabelpasien;
	private $data = [];

	function __construct()
	{
		//konstruktor
		try {
			$db_host = "localhost"; // host 
			$db_user = "root"; // user
			$db_password = ""; // password
			$db_name = "mvp_php"; // nama basis data
			$this->tabelpasien = new TabelPasien($db_host, $db_user, $db_password, $db_name); //instansi TabelPasien
			$this->data = array(); //instansi list untuk data Pasien
			//data = new ArrayList<Pasien>;//instansi list untuk data Pasien
		} catch (Exception $e) {
			echo "wiw error" . $e->getMessage();
		}
	}

	function prosesDataPasien()
	{
		try { 
			//mengambil data di tabel pasien
			$this->tabelpasien->open();
			$this->tabelpasien->getPasien();
			while ($row = $this->tabelpasien->getResult()) {
				//ambil hasil query
				$pasien = new Pasien(); //instansiasi objek pasien untuk setiap data pasien
				$pasien->setId($row['id']); //mengisi id
				$pasien->setNik($row['nik']); //mengisi nik
				$pasien->setNama($row['nama']); //mengisi nama
				$pasien->setTempat($row['tempat']); //mengisi tempat
				$pasien->setTl($row['tl']); //mengisi tl
				$pasien->setGender($row['gender']); //mengisi gender


				$this->data[] = $row; //tambahkan data pasien ke dalam list
			}
			//tutup koneksi
			$this->tabelpasien->close();
		} catch (Exception $e) {
			//memproses error
			echo "wiw error part 2" . $e->getMessage();
		}
	}
	function getId($i)
	{
		//mengembalikan id Pasien dengan indeks ke i
		return $this->data[$i]['id'];
	}
	function getNik($i)
	{
		//mengembalikan nik Pasien dengan indeks ke i
		return $this->data[$i]['nik'];
	}
	function getNama($i)
	{
		//mengembalikan nama Pasien dengan indeks ke i
		return $this->data[$i]['nama'];
	}
	function getTempat($i)
	{
		//mengembalikan tempat Pasien dengan indeks ke i
		return $this->data[$i]['tempat'];
	}
	function getTl($i)
	{
		//mengembalikan tanggal lahir(TL) Pasien dengan indeks ke i
		return $this->data[$i]['tl'];
	}
	function getGender($i)
	{
		//mengembalikan gender Pasien dengan indeks ke i
		return $this->data[$i]['gender'];
	}
	function getEmail($i)
	{
		//mengembalikan gender Pasien dengan indeks ke i
		return $this->data[$i]['email'];
	}
	function getTelp($i)
	{
		//mengembalikan gender Pasien dengan indeks ke i
		return $this->data[$i]['telp'];
	}
	function getSize()
	{
		return sizeof($this->data);
	}

	function addDataPasien($nik, $nama, $tempat, $tl, $gender, $email, $telp)
	{
		try {

			$this->tabelpasien->open();
			$this->tabelpasien->addPasien($nik, $nama, $tempat, $tl, $gender, $email, $telp); // nama function pada model
			$this->tabelpasien->close();
		} catch (Exception $e) {
			echo "Gagal menambahkan data!" . $e->getMessage();
		}
	}
	function editDataPasien($id, $nik, $nama, $tempat, $tl, $gender, $email, $telp)
	{
		try {
			$this->tabelpasien->open();
			$this->tabelpasien->editPasien($id, $nik, $nama, $tempat, $tl, $gender, $email, $telp);
			$this->tabelpasien->close();
		} catch (Exception $e) {
			echo "Gagal mengubah data!" . $e->getMessage();
		}
	}
	
	function deleteDataPasien($id)
	{
		try {
			$this->tabelpasien->open();
			$this->tabelpasien->deletePasien($id);
			$this->tabelpasien->close();
		} catch (Exception $e) {
			echo "Gagal menghapus data!" . $e->getMessage();
		}
	}
}
