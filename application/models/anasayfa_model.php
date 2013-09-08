﻿<?php 
	
	Class Anasayfa_model extends CI_Model
	{
		function __construct(){
			parent::__construct();
		}
		
		function kategoriler(){
			
			$this->db->select('*');
			$this->db->from('kategoriler');
			
			$query = $this->db->get();
			
			return $query->result();
		}
		
		function kitaplar(){
			
			$this->db->select('*');
			$this->db->from('kitaplar');
			
			$query = $this->db->get();
			
			return $query->result();
		}
		
		function kitap_kayit($degerler){
			$kitapAdi	= $this->db->escape_str($degerler[0]);
			$kitapDesc	= $this->db->escape_str($degerler[1]);
			$resim		= $this->db->escape_str($degerler[2]);
			$kategori	= $this->db->escape_str($degerler[3]);
			$yazar		= $this->db->escape_str($degerler[4]);
			$basimYili	= $this->db->escape_str($degerler[5]);
			$sayfaSayisi= $this->db->escape_str($degerler[6]);
			$cilt		= $this->db->escape_str($degerler[7]);
			$yayinEvi	= $this->db->escape_str($degerler[8]);
			
			$data = array(
							'adi' => $kitapAdi,
							'aciklama' => $kitapDesc,
							'resimUrl' => $resim,
							'kategori' => $kategori,
							'yazar' => $yazar,
							'basimYili' => $basimYili,
							'sayfaSayisi' => $sayfaSayisi,
							'cilt' => $cilt,
							'yayinEvi' => $yayinEvi,							
							);
							
			$ekle = $this->db->insert('kitaplar', $data);
			
			if($ekle){
				return true;
			}
			else{
				return false;
			}
			
		}
		
		function kategori_kayit($ad){
			$ad			= $this->db->escape_str($ad);
			
			$data = array('ad' => $ad);
							
			$ekle = $this->db->insert('kategoriler', $data);
			
			if($ekle){
				return true;
			}
			else{
				return false;
			}
			
		}
		
		function toplam(){
			$query = $this->db->query("SELECT COUNT(id) AS toplam FROM kitaplar");
			$result = $query->result();
			
			return $result[0]->toplam;
		}
		
		
	}
?>