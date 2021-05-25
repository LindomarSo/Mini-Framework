$(function(){
    scroll()

	function scroll(){
		$('#navbar a').click(function(){
			var el = '#'+$(this).attr('href')
			var scroll = $(el).offset().top

			$('html, body').animate({
				'scrollTop': scroll - 40
			})

			if($(window)[0].innerWidt < 768){
				$('.icon-bar').click()
			}

			return false
		})
	}
  })