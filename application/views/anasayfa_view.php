<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Kitap Listesi - Kitaplar</title>

<!-- Css Dosyaları -->
<link rel="stylesheet" type="text/css" href="css/reset.css" />
<link rel="stylesheet" type="text/css" href="css/960.css" />
<link rel="stylesheet" type="text/css" href="css/text.css" />
<link rel="stylesheet" type="text/css" href="css/style.css" />

<!-- Javascript Dosyaları -->
<script src="javascript/jquery-1.10.2.min.js"></script>
<script src="javascript/index.js"></script>
</head>

<body>

<div class = "container_12">
	<div class = "grid_12" id = "Header"><a href="#">Kitaplar</a></div>
	
	<!-- Menü -->
	<div class = "grid_12" id = "Menu">
		<div class = "grid_2 alt-Bosluk alpha" id = "Kontrol">
			<a href="#" id = "kontrolLink">Kontrol Panel</a>
		</div>
		<div class = "grid_7 alt-Bosluk" id = "Print">
			<div class = "sol solBosluk">
				Çıktı Al : 
				<a href="#"><img src = "images/printer.png" width = "32px", height = "32px"/></a>
				<a href="#"><img src = "images/file_extension_doc.png" width = "32px", height = "32px"/></a>
				<a href="#"><img src = "images/file_extension_xls.png" width = "32px", height = "32px"/></a>
				<a href="#"><img src = "images/file_extension_pdf.png" width = "32px", height = "32px"/></a>
			</div>
			<div class = "sag sagBosluk">
				Toplam Kitap : 1254
			</div>
			
		</div>
		<div class = "grid_3 alt-Bosluk omega" id = "Kategoriler">
			<div class = "sol ortaBosluk">
				Kategori : 
			</div>
			<div class = "sag sagBosluk">
				<ul class='dd_menu'>
				<li><a href='#nogo'>Hepsi</a>
				 <ul>
				 <?php foreach($kategoriler AS $kategori){ ?>
				 <li><a href='#nogo1'><?php echo $kategori->ad; ?></a></li>
				 <?php } ?>
				 </ul>
				</li>
				</ul>
			</div>
		</div>
	</div>
	
	<!-- Kontrol Panel Menüsü -->
	<div class = "grid_12 alt-Bosluk menu-Height" id = "kontrolMenu">
		<ul>
			<li><a href = "#" class = "border-left-fix" id = "kitapEkle">Kitap Ekle</a></li>
			<li><a href = "#" id = "kategoriEkle">Kategori Ekle</a></li>
			<li><a href = "#">Kategoriler</a></li>
			<li><a href = "#">Ayarlar</a></li>
		</ul>
	</div>
	
	<!-- Kategori Form -->
	<div class = "grid_12 alt-Bosluk" id = "Kategori">
	    <div class = "innerContentx">
			<form action="<?php echo site_url(); ?>/Anasayfa/kategori_kayit" method="post" name="form3" id="form3" class = "formx">
				<div class = "genelBilgi sol">
					<p>
						<label for="kategoriAdi">Kategori Adı* :</label>
						<input type="text" name="kategoriAdi" id="kategoriAdi" />
					</p>			
				</div>
				<div class = "both"></div>
				<div class = "form-Active">
					<input type="submit" name="button" id="button" value="Ekle" />
					<a href="#" class = "iptal">İptal</a>
				</div>
				
			</form>
	    </div>
	</div>
	
	<!-- Form -->
	<div class = "grid_12 alt-Bosluk" id = "Kitap">
	    <div class = "innerContentx">
			<form action="<?php echo site_url(); ?>/Anasayfa/kitap_kayit" method="post" enctype="multipart/form-data" name="form2" id="form2" class = "formx">
				<div class = "genelBilgi sol">
					<p>
						<label for="kitapAdi">Kitap Adı* :</label>
						<input type="text" name="kitapAdi" id="kitapAdi" />
					</p>
					<p>
						<label for="kitapDesc">Kitap Açıklaması* :</label>
						<textarea name="kitapDesc" id="kitapDesc" cols="45" rows="5"></textarea>
					</p>
					<p>
						<label for="resimDosya">Resim Yükle :</label>
						<input type="file" name="resimDosya" id="resimDosya" />
					</p>
				</div>
				
				<div class = "ayrinti sag">
					<p>
						<label for="kategori">Kategori* : </label>
						<select name="kategori" id="kategori">
							<option value="0">Seçiniz...</option>
							<?php foreach($kategoriler AS $kategori){ ?>
							<option value="<?php echo $kategori->id; ?>"><?php echo $kategori->ad; ?></option>
							<?php } ?>
						</select>
					</p>
					<p>
						<label for="yazar">Yazarı* :</label>
						<input type="text" name="yazar" id="yazar" />
					</p>
					<p>
						<label for="basimYil">Basım Yılı* :</label>
						<input type="text" name="basimYil" id="basimYil" />
					</p>
					<p>
						<label for="sayfaSayisi">Sayfa Sayısı* :</label>
						<input type="text" name="sayfaSayisi" id="sayfaSayisi" />
					</p>
					<p>
						<label for="cilt">Cilt* :</label>
						<input type="text" name="cilt" id="cilt" />
					</p>
					<p>
						<label for="yayinEvi">Yayın Evi* :</label>
						<input type="text" name="yayinEvi" id="yayinEvi" />
					</p>
				
				</div>
				<div class = "both"></div>
				<div class = "form-Active">
					<input type="submit" name="button" id="button" value="Ekle" />
					<a href="#" class = "iptal">İptal</a>
				</div>
				
			</form>
	    </div>
	</div>
	
	<div class = "grid_12 alt-Bosluk" id = "Content">
		<div class = "innerContent">
		<form id="form1" name="form1" method="post" action="">
			<table id = "Listeleme">
				<?php foreach($kitaplar as $kitap){ 
					if($kitap->id % 2 == 0){
						echo "<tr class = 'koyu-tr'>";
					}
					else{
						echo "<tr>";
					}
				?>
					<td class = "checkbox-Td">
						<input type="checkbox" name="<?php echo $kitap->id; ?>" id="checkbox" />
						<label for="checkbox"></label>
					</td>
					
					<td class = "text-Td">
						<a href = "upload/<?php echo $kitap->resimUrl; ?>" rel="popupacil"><img src = "images/photo.png" width = "32px", height = "32px"/></a>
						<?php echo $kitap->adi; ?>
					</td>
				</tr>
				<tr class = "aciklama-tr">
					<td></td>
					<td class = "miniText">
						<p><b>Kısa Açıklama:</b> <?php echo $kitap->aciklama; ?></p>
						<div class = "sol"><b>Yazar:</b> <?php echo $kitap->yazar; ?></div>
						<div class = "sol"><b>Basım Yılı:</b> <?php echo $kitap->basimYili; ?></div>
						<div class = "sol"><b>Sayfa Sayısı:</b> <?php echo $kitap->sayfaSayisi; ?></div>
						<div class = "sol"><b>Cilt:</b> <?php echo $kitap->cilt; ?></div>
						<div class = "sol"><b>Yayın Evi: </b> <?php echo $kitap->yayinEvi; ?></div>
					</td>
				</tr>
				<?php } ?>
			</table>
			</form>
		</div>
	</div>
	<div class = "grid_12 alt-Bosluk menu-Height" id = "Sayfalama">
	    <a href="#" class = "genis">Geri</a>
		<a href="#">1</a>
		<a href="#">2</a>
		<a href="#">3</a>
		<a href="#" class = "genis">İleri</a>
	</div>
	
	<div class = "grid_12" id = "Footer">
	    <p>Bu sitenin tasarımı ve programlaması <b>Beyazkan</b> tarafından yapılmıştır...</p>
	</div>
</div>

</body>
</html>
