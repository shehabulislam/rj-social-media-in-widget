(function($){
	$(function(){
		$(".imageupload").on("click", function(){
			
			tb_show('', 'media-upload.php?post_id=57&type=image&TB_iframe=1');
			
			return false;	
		});
		
		window.send_to_editor = function(html){
			var imagelink = $('img', html).attr("src");
			
			$(".rj_image_link").val(imagelink);
			tb_remove();
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
	});	
})(jQuery);