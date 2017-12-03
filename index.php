<?php
  /**
  *Buatlah Simulasi Pembelian Buku Menggunakan OOP PHP
  *== Prosedur ==
  *|Toko|
  *1. Pemilik Mendaftarkan Buku "Bahasa Pemograman" Harga 2000
  *2. Pemilik Mendaftarkan Buku "Sang Pencerah"  Harga 3000
  *3. Pemilik Mendaftarkan Buku "Perjalanan Sang Waktu"  Harga 4000
  *4. Pemilik Menghitung Buku Yang Ia Daftarkan
  *5. Pemilik Menampilkan Buku Yang Ia Daftarkan
  *|Pembeli|
  *1. Pembeli memilih Buku "Bahasa Pemograman"
  *2. Pembeli memilih Buku "Perjalanan Sang Waktu"
  *3. Pembeli mengurangi Buku "Bahasa Pemograman"
  *4. Pembeli Memilih Buku "Sang Pencerah"
  *5. Pembeli Membeli Buku Yang Sudah di Pilihnya
  *6. Selesai.
  *---
  *Output Toko : Akan Menampilkan Pesan Sukses Jika Buku Sudah Di Didaftarkan, Akan Menampilkan Error Jika Buku Yang Di Daftarkan Sudah di Input Sebelumnya
  *Output Pembeli : Akan Menampilkan Pesan Sukses Jika Buku yang Dipilih Ada , Akan Menampilkan Pesan Error Jika Buku Yang Di Pilih Tidak Ada
  *Pembelian Mengeluarkan Output : Total Harga Pembelian {Total_Beli}
  *Penghitungan Buku Mengeluarkan Output : Total Buku {Total}
  *Menampilkan Buku Mengeluarkan Output : {Nama_Buku} - {Harga}
  *----
  *Ket :
  *{} = Variabel
  * ---
  * Clue , Gunakan Array untuk Menyimpan Record , Cari Referensi (unset), array_push,pemanggilan static method dan static variable
  *
  **/
  /**
   * Class Toko
   */
  class Toko
  {
    private static $list_buku = array();
    function __construct(){

    }
    function set_buku($nama_buku,$harga){
      array_push(self::$list_buku,array("nama_buku"=>$nama_buku,"harga"=>$harga));
    }
    function hitung_buku(){
      return "Total Buku ".count(self::$list_buku);
    }
    public function get_buku(){
      return self::$list_buku;
    }
  }
  /**
   * Class Pelanggan
   */
  class Pelanggan extends Toko
  {
    private $cart = array();
    function pilih_buku($nama_buku){
      $status = false;
      $buku = $this->get_buku();
      $index = null;
      foreach ($buku as $key => $value) {
        if(in_array($nama_buku,$buku[$key])){
            $status = true;
            $index = $key;
            break;
        }
      }
      if($status){
        array_push($this->cart,array("nama_buku"=>$buku[$index]["nama_buku"],"harga"=>$buku[$index]["harga"]));
        return true;
      }else{
        return false;
      }
    }
    function unset_buku($nama_buku){
      $buku = $this->cart;
      $index = null;
      $status = false;
      foreach ($buku as $key => $value) {
        if(in_array($nama_buku,$buku[$key])){
            $status = true;
            $index = $key;
            break;
        }
      }
      if($status){
        unset($buku[$index]);
        return true;
      }else{
        return false;
      }
    }
    function beli_buku(){
      $buku = $this->cart;
      $total = 0;
      foreach ($buku as $key => $value) {
          $total = $value["harga"] + $total;
      }
      return "Total Harga Pembelian = ".$total;
    }
  }
  // Prosedur Toko
  $toko = new Toko();
  // Prosedur Toko Nomor 1
  $toko->set_buku("Bahasa Pemograman",2000);
  // Prosedur Toko Nomor 2
  $toko->set_buku("Sang Pencerah",3000);
  // Prosedur Toko Nomor 3
  $toko->set_buku("Perjalanan Sang Waktu",4000);
  // Prosedur Toko Nomor 4
  print($toko->hitung_buku()."\n");

  //Prosedur Pelanggan
  $pelanggan = new Pelanggan();
  // Prosedur Pelanggan 1
  if(!$pelanggan->pilih_buku("Bahasa Pemograman")){
    exit("Gagal Menambahkan Bahasa Pemograman\n");
  }
  // Prosedur Pelanggan 2
  if(!$pelanggan->pilih_buku("Perjalanan Sang Waktu")){
    exit("Gagal Menambahkan Perjalanan Sang Waktu\n");
  }
  // Prosedur Pelanggan 3
  if(!$pelanggan->unset_buku("Bahasa Pemograman")){
    exit("Gagal Menhapus Buku Pemograman\n");
  }
  // Prosedur Pelanggan 4
  if(!$pelanggan->pilih_buku("Sang Pencerah")){
    exit("Gagal Menambahkan Sang Pencerah\n");
  }
  // Prosedur Pelanggan 5
  print($pelanggan->beli_buku()."\n");

 ?>
