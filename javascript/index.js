// Resim Önizleme Fonksiyonu...
this.resimonizleme = function(){
    /* Düzenleme */
        xOffset = 10;
        yOffset = 30;
        // Bu iki ayar görüntülenecek popup alanının  fare imlecine olan uzaklığını değiştirir.
        // İstediğiniz Şekle Getirmek için oynamalar yapaiblirsiniz.
    /* Düzenleme Sonu */
    $("a[rel*=popupacil]").hover(function(e){
        this.t = this.title;
        this.title = "";
        var c = (this.t != "") ? "<br />" + this.t : "";
        $("body").append("<p id='onizleme'><img src='"+ this.href +"' alt='Önizleme Resmi'  width = '750px' height = '500px'/>"+ c +"</p>");
        $("#onizleme")
            .css("top",(e.pageY - xOffset) + "px")
            .css("left",(e.pageX + yOffset) + "px")
            .fadeIn();
    },
    function(){
        this.title = this.t;
        $("#onizleme").remove();
    });
    $("[rel*=popupacil]").mousemove(function(e){
        $("#onizleme")
            .css("top",(e.pageY - xOffset) + "px")
            .css("left",(e.pageX + yOffset) + "px");
    });
};

// Sayfa hazır olduğunda fonksiyonları yükle...
$(document).ready(function(){
	$('#kitapEkle,.iptal').click(function () {
		$('#Form').toggle("slow");
	});
	
	$('#kontrolLink').click(function () {
		$('#kontrolMenu').toggle("slow");
	});
	
	$('.text-Td').click(function () {
		$(this).parent().next('tr').toggle();
	});
	
	resimonizleme();
});