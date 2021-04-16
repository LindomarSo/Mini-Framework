$(function(){
	cliqueMenu()
	scrollItem()
	function cliqueMenu(){
		$('#menuSelecionado a, #alvo a').click(function(){
			$('#alvo a').parent().removeClass('active')
			$('#menuSelecionado a').removeClass('active').removeClass('cor-padrao')
			$('#alvo a[res_sys='+$(this).attr('res_sys')+']').parent().addClass('active')
			$('#menuSelecionado a[res_sys='+$(this).attr('res_sys')+']').addClass('active')
			return false
		})
	}

	function scrollItem(){
		$('#menuSelecionado a, #alvo a').click(function(){
			var ref = '#'+$(this).attr('res_sys')
			var scroll = $(ref).offset().top 
			$('html, body').animate({'scrollTop':scroll - 50})
			if($(window)[0].innerWidth < 768){
				$('.icon-bar').click()
			}
		})
	}

	$('button.deletar-membro').click(function(){
		var id_membro = $(this).attr('id_membro')
		var el = $(this).parent().parent()
		$.ajax({
			url: 'deletar.php',
			method: 'post',
			data: {'id_membro':id_membro},
			complete:function(){
				el.remove()
			}
		})
	})
})