/* 
Link de Referência onde fora retirado o esqueleto da função de animação
-> https://codepen.io/origamid/pen/EgaXvW
-> https://www.origamid.com/codex/animacao-durante-o-scroll/
*/

function boxTop(idBox) {
	var boxOffset = $(idBox).offset().top;
	return boxOffset;

}

$(document).ready(function() {

	var $target = $('.anime'),
		animationClass = 'anime-init',
		windowHeight = $(window).height(),
		offset = windowHeight - 250;


	function animeScroll() {
		
		var documentTop = $(document).scrollTop();
		$target.each(function() {
			if (documentTop > boxTop(this) - offset) {
				$(this).addClass(animationClass);

			} else {
				$(this).removeClass(animationClass);

			}

			

			
		});
	}
	
	animeScroll();

	$(document).scroll(function() {
		setTimeout(function() {
			animeScroll()
		}, 150);

	});
});