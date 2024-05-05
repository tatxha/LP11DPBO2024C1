<!-- Saya Tattha Maharany Yasmin Akbar dengan NIM 2201805 mengerjakan soal LP 11
dalam Praktikum mata kuliah Desain dan Pemrograman Berbasis Objek, untuk keberkahan-Nya
maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamin. -->

<?php


include("KontrakView.php");
include("presenter/ProsesPasien.php");

class TampilPasien implements KontrakView
{
	private $prosespasien; //presenter yang dapat berinteraksi langsung dengan view
	private $tpl;

	function __construct()
	{
		//konstruktor
		$this->prosespasien = new ProsesPasien();
	}

	function tampil()
	{
		$this->prosespasien->prosesDataPasien();
		$data = null;

		//semua terkait tampilan adalah tanggung jawab view
		for ($i = 0; $i < $this->prosespasien->getSize(); $i++) {
			$no = $i + 1;
			$data .= "<tr>
			<td>" . $no . "</td>
			<td>" . $this->prosespasien->getNik($i) . "</td>
			<td>" . $this->prosespasien->getNama($i) . "</td>
			<td>" . $this->prosespasien->getTempat($i) . "</td>
			<td>" . $this->prosespasien->getTl($i) . "</td>
			<td>" . $this->prosespasien->getGender($i) . "</td>
			<td>" . $this->prosespasien->getEmail($i) . "</td>
			<td>" . $this->prosespasien->getTelp($i) . "</td>
			<td>
				<a href='index.php?action=update&id=" . $this->prosespasien->getId($i) . "' class='btn btn-success'' style='background-color: blue; border-color: transparent;'>Edit</a>
				<a href='index.php?action=delete&id=" . $this->prosespasien->getId($i) . "' class='btn btn-danger'' style='background-color: red; border-color: transparent;'>Hapus</a>
			</td>
			";
		}
		// Membaca template skin.html
		$this->tpl = new Template("templates/skin.html");

		// Mengganti kode Data_Tabel dengan data yang sudah diproses
		$this->tpl->replace("DATA_TABEL", $data);

		// Menampilkan ke layar
		$this->tpl->write();
	}

	function add()
	{
		$tittle = "Add Data";
		$data = null;
		$data .='
		<form action="index.php" method="post">
		  <input hidden name="action" value="addPasien">
          <label> NIK: </label>
          <input type="text" name="nik" class="form-control"> <br>
          
		  <label> NAMA: </label>
          <input type="text" name="nama" class="form-control"> <br>
		  
		  <label> TEMPAT: </label>
          <input type="text" name="tempat" class="form-control"> <br>
          
          <label> TANGGAL LAHIR: </label>
          <input type="date" name="tl" class="form-control"> <br>
        
		  <label> PILIH GENDER: </label>
		  <select id="gender" name="gender" class="form-control">
			<option value="Laki-Laki">Laki-Laki</option>
			<option value="Perempuan">Perempuan</option>
		  </select> <br>
		
          <label> EMAIL: </label>
          <input type="email" name="email" class="form-control"> <br>
        
          <label> NOMOR TELPON: </label>
          <input type="tel" name="telp" class="form-control"> <br>

          <button class="btn btn-success" type="submit" name="submit" style="background-color: blue; border-color: transparent;"> Submit </button>
          <a class="btn btn-info" type="submit" name="cancel" href="index.php" style="background-color: red; border-color: transparent;"> Cancel </a><br>
        
          </div>
          </form>
		';

		// Membaca template skin.html
		$this->tpl = new Template("templates/form.html");

		// Mengganti kode Data_Tabel dengan data yang sudah diproses
		$this->tpl->replace("DATA_CRUD", $data);
		$this->tpl->replace("PAGE_TITTLE", $tittle);

		// Menampilkan ke layar
		$this->tpl->write();
	}

	function update($id)
	{
		$tittle = "Update Data";
		$this->prosespasien->prosesDataPasien();
		$data = null;
		for ($i = 0; $i < $this->prosespasien->getSize(); $i++)
		{
			if ($id == $this->prosespasien->getId($i))
			{
				// jangan lupa catch id
				$data .='
				<form action="index.php" method="post">
					<input hidden name="action" value="editPasien">
					<input hidden name="id" value="' . $this->prosespasien->getId($i) . '"> 

					<label> NIK: </label>
					<input type="text" name="nik" class="form-control" value="' . $this->prosespasien->getNik($i) . '"> <br>
					
					<label> NAMA: </label>
					<input type="text" name="nama" class="form-control" value="' . $this->prosespasien->getNama($i) . '"> <br>
					
					<label> TEMPAT: </label>
					<input type="text" name="tempat" class="form-control" value="' . $this->prosespasien->getTempat($i) . '"> <br>
					
					<label> TANGGAL LAHIR: </label>
					<input type="date" name="tl" class="form-control" value="' . $this->prosespasien->getTl($i) . '"> <br>
					
					<label> PILIH GENDER: </label>
					<select id="gender" name="gender" class="form-control" value="' . $this->prosespasien->getGender($i) . '">
						<option value="Laki-Laki">Laki-Laki</option>
						<option value="Perempuan">Perempuan</option>
					</select> <br>
					
					<label> EMAIL: </label>
					<input type="email" name="email" class="form-control" value="' . $this->prosespasien->getEmail($i) . '"> <br>
					
					<label> NOMOR TELPON: </label>
					<input type="tel" name="telp" class="form-control" value="' . $this->prosespasien->getTelp($i) . '"> <br>
			
					<button class="btn btn-success" type="submit" name="submit" style="background-color: blue; border-color: transparent;"> Submit </button>
					<a class="btn btn-info" type="submit" name="cancel" href="index.php" style="background-color: red; border-color: transparent;"> Cancel </a><br>
					
					</div>
				</form>
				';
				
				// Membaca template skin.html
				$this->tpl = new Template("templates/form.html");
		
				// Mengganti kode Data_Tabel dengan data yang sudah diproses
				$this->tpl->replace("DATA_CRUD", $data);
				$this->tpl->replace("PAGE_TITTLE", $tittle);
		
				// Menampilkan ke layar
				$this->tpl->write();
			}
		}

	}

	function addPasien($nik, $nama, $tempat, $tl, $gender, $email, $telp)
	{
		$this->prosespasien->addDataPasien($nik, $nama, $tempat, $tl, $gender, $email, $telp); // menggunakan function yang dibuat di presenter
		header("location:index.php");
	}
	function editPasien($id, $nik, $nama, $tempat, $tl, $gender, $email, $telp)
	{
		$this->prosespasien->editDataPasien($id, $nik, $nama, $tempat, $tl, $gender, $email, $telp);
		header("location:index.php");
	}
	function deletePasien($id)
	{
		$this->prosespasien->deleteDataPasien($id);
		header("location:index.php");
	}
}
