<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Anasayfa extends CI_Controller {

	public function index()
	{
		$this->load->model('anasayfa_model');
		$data['kategoriler'] 	= $this->anasayfa_model->kategoriler();
		$data['kitaplar']		= $this->anasayfa_model->kitaplar();
		
		$this->load->view('anasayfa_view', $data);
	}
	
	public function kayit(){
		$config['upload_path']		= 'upload';
		$config['allowed_types']	= 'jpg|gif|png';
		$config['file_name'] 		= "resim" . date("Y-m-d") . "-" . rand(1, 100);
		$config['overwrite']		= FALSE;
		$config['max_width'] 		= 1024;
		$config['max_height']		= 800;
		
		$this->load->library("upload", $config);
				
		$kitapAdi	= $this->input->post('kitapAdi', TRUE);
		$kitapDesc	= $this->input->post('kitapDesc', TRUE);
		$resimDosya	= $this->input->post('resimDosya', TRUE);
		$kategori 	= $this->input->post('kategori', TRUE);
		$yazar		= $this->input->post('yazar', TRUE);
		$basimYili	= $this->input->post('basimYil', TRUE);
		$sayfaSayisi= $this->input->post('sayfaSayisi', TRUE);
		$cilt		= $this->input->post('cilt', TRUE);
		$yayinEvi	= $this->input->post('yayinEvi', TRUE);
		
		if(empty($kitapAdi) || empty($kitapDesc) || empty($kategori) || empty($yazar) || empty($basimYili) || empty($sayfaSayisi)
		|| empty($cilt) || empty($yayinEvi))
		{
			$data['baslik'] = 'Bos girdi saptandı...';
			$data['mesaj']	= 'Lütfen doldurulması gereken alanları doldurunuz...';
			
			$this->load->view('hata_view', $data);
		}
		else{
			// Model
			$yukle = $this->upload->do_upload("resimDosya");
				
			$upData = $this->upload->data();
			$degerler = array($kitapAdi, $kitapDesc, $upData["file_name"], $kategori, $yazar, 
							$basimYili, $sayfaSayisi, $cilt, $yayinEvi);
									
			$this->load->model('anasayfa_model');
			$query = $this->anasayfa_model->kayitEkle($degerler);
			
			if($query){			
				$data['baslik'] = 'Tebrikler, İşlem tamamlandı.';
				$data['mesaj']	= "Kitap veritabanına başarılı bir şekilde yüklendi... <a href='".base_url()."'>Geri dön</a>";
			
				$this->load->view('hata_view', $data);
			}
			else{
				$data['baslik'] = 'HATA: Veritabanına Eklenemedi...';
				$data['mesaj']	= 'Veritabanına ekleme yapılamadı, lütfen daha sonra tekrar deneyiniz...';
			
				$this->load->view('hata_view', $data);
			}
		}
	}
}
