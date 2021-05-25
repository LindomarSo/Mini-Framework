$(function(){
	scroll()
	alert('Ola mundo')
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

	// var include_path = $('base').attr('base')
	// console.log(include_path)

	// $('body').on('submit','form',function(){
	// 	var form = $(this)
	// 	$.ajax({
	// 		beforeSend:function(){
	// 			$('.overlay-form').fadeIn()
	// 		},
	// 		url: include_path+'ajax/formularios.php',
	// 		method: 'post',
	// 		dataType: 'json',
	// 		data: form.serialize()
	// 	}).done(function(data){
	// 		alert('Enviada com sucesso!')
	// 		$('.overlay-form').fadeOut()
	// 	})

	// 	return false
	// })
})