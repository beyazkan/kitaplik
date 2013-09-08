<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Anasayfa extends CI_Controller {
	private $perpage = 5;
	
	public function index(){
		$this->home();
	}
	
	public function home(){
		$this->load->model('anasayfa_model');
		$data['kategoriler'] = $this->anasayfa_model->kategoriler();
		$data['kitaplar']    = $this->anasayfa_model->kitaplar($this->perpage); 
		$data['toplam']      = $this->anasayfa_model->total_row_kitaplar(); 
		$toplam 			 = $this->anasayfa_model->toplam(); 
		
		$data['linkler']     = $this->sayfalama($toplam, $this->perpage); 
		
		$this->load->view('header_view');
		$this->load->view('content_view', $data);
		$this->load->view('footer_view');
	}
	
	public function listeleme($sayfa = NULL){
		$this->load->model('anasayfa_model');
		$data['kategoriler'] = $this->anasayfa_model->kategoriler();
		$data['kitaplar']    = $this->anasayfa_model->kitaplar($this->perpage, $sayfa); 
		$data['toplam']      = $this->anasayfa_model->total_row_kitaplar(); 
		$toplam 			 = $this->anasayfa_model->toplam(); 
		
		$data['linkler']     = $this->sayfalama($toplam, $this->perpage); 
		
		$this->load->view('header_view');
		$this->load->view('content_view', $data);
		$this->load->view('footer_view');
	}
	
	public function kategori($kategori = NULL, $sayfa = NULL){
	
		$this->load->model('anasayfa_model');
		$data['kategoriler'] = $this->anasayfa_model->kategoriler();
		$kategorid 			 = $this->anasayfa_model->kategoriToid($kategori); 
		$data['kitaplar']    = $this->anasayfa_model->kitaplar($this->perpage, $sayfa, $kategorid); 
		$data['toplam']      = $this->anasayfa_model->total_row_kitaplar(); 
		$toplam 			 = $this->anasayfa_model->toplam($kategorid); 
		
		$data['linkler']     = $this->sayfalama($toplam, $this->perpage, $kategori); 
		
		$this->load->view('header_view');
		$this->load->view('content_view', $data);
		$this->load->view('footer_view');
	}
	
	public function kitap_kayit(){
		$config['upload_path']		= 'upload';
		$config['allowed_types']	= 'jpg|gif|png';
		$config['file_name'] 		= "resim" . date("Y-m-d") . "-" . rand(1, 100);
		$config['overwrite']		= FALSE;
		$config['max_width'] 		= 1024;
		$config['max_height']		= 800;
		
		$this->load->library("upload", $config);
				
		$ad			= $this->input->post('kitapAdi', TRUE);
		$desc		= $this->input->post('kitapDesc', TRUE);
		$resimDosya	= $this->input->post('resimDosya', TRUE);
		$kategori 	= $this->input->post('kategori', TRUE);
		$yazar		= $this->input->post('yazar', TRUE);
		$basimYili	= $this->input->post('basimYil', TRUE);
		$sayfaSayisi= $this->input->post('sayfaSayisi', TRUE);
		$cilt		= $this->input->post('cilt', TRUE);
		$yayinEvi	= $this->input->post('yayinEvi', TRUE);
		
		if(empty($ad) || empty($desc) || empty($kategori) || empty($yazar) || empty($basimYili) || empty($sayfaSayisi)
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
			$degerler = array($ad, $desc, $upData["file_name"], $kategori, $yazar, 
							$basimYili, $sayfaSayisi, $cilt, $yayinEvi);
									
			$this->load->model('anasayfa_model');
			$query = $this->anasayfa_model->kitap_kayit($degerler);
			
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
	
	public function kategori_kayit(){
		
		$ad	= $this->input->post('kategoriAdi', TRUE);
		
		if(empty($ad))
		{
			$data['baslik'] = 'Bos girdi saptandı...';
			$data['mesaj']	= 'Lütfen doldurulması gereken alanları doldurunuz...';
			
			$this->load->view('hata_view', $data);
		}
		else{
			// Model
												
			$this->load->model('anasayfa_model');
			$query = $this->anasayfa_model->kategori_kayit($ad);
			
			if($query){			
				$data['baslik'] = 'Tebrikler, İşlem tamamlandı.';
				$data['mesaj']	= "Kategori veritabanına başarılı bir şekilde yüklendi... <a href='".base_url()."'>Geri dön</a>";
			
				$this->load->view('hata_view', $data);
			}
			else{
				$data['baslik'] = 'HATA: Veritabanına Eklenemedi...';
				$data['mesaj']	= 'Veritabanına ekleme yapılamadı, lütfen daha sonra tekrar deneyiniz...';
			
				$this->load->view('hata_view', $data);
			}
		}
	}
	
	public function sayfalama($toplam, $perpage, $kategori = NULL){
			if(!$kategori){
				$link_url = site_url()."/Sayfa";
				$segment = 2;
			}
			else{
				$link_url = site_url()."/Kategori/".$kategori;
				$segment = 3;
			}
			
			// Sayfalama işlemleri
			$this->load->library('pagination');
			$config = array(
            'base_url' => $link_url,
            'total_rows' => $toplam,
            'per_page' => $perpage,
            'num_links' => 1,
            'page_query_string' => FALSE,
            'uri_segment' => $segment,
            'full_tag_open' => '<div id = "Sayfalama" class="grid_12 alt-Bosluk menu-Height">',
            'full_tag_close' => '</div>',
            'first_link' => 'İlk Sayfa',
            'first_tag_open' => '',
            'first_tag_close' => '',
            'last_link' => 'Son Sayfa',
            'last_tag_open' => '',
            'last_tag_close' => '',
            'next_link' => 'Sonraki',
            'next_tag_open' => '',
            'next_tag_close' => '',
            'prev_link' => 'Önceki',
            'prev_tag_open' => '',
            'prev_tag_close' => '',
            'cur_tag_open' => '<span class="current">',
            'cur_tag_close' => '</span>',
            'num_tag_open' => '',
            'num_tag_close' => ''

        );

		$this->pagination->initialize($config);

		return $this->pagination->create_links();
	}
}


