//Реализация динамических селектов для поиска АРТИ
jQuery(document).ready(function($) {
		
		getData('tovar', 'all');	
		
		//Вывод динамических списков
		function getData(sel, param){
		
			var data = {
				'action': 'arti_search',
				'tovar': sel,
				'kind_tovar': param
			};
			
			$.post(ajax_obj.ajax_url, data, function(response) {
				$.each(response, function(result, row){
					$('.'+sel).append('<option value="'+row.id+'">'+row.name+'</option>');
				});
			});
		};
		
		//Отрисовка таблицы с результатами
		function setRender(user_chois){
		
			var data = {
				'action': 'arti_search',
				'chois': user_chois
			};
				
			$.post(ajax_obj.ajax_url, data, function(res) {
				var msg_found = $(".not_found");
				if( res == false ) {
					msg_found.show();
					return false;
				}
				msg_found.hide();
				$.each(res, function(result, row){
					$('.render_table').append('<tr><td><a href="market/'+row.id+'.html">'+row.name+'</a></td><td>'+row.sku+'</td><td>'+row.cat+'</td><td>'+row.profile+'</td><td>'+row.price+'</td></tr>');					
				});
			});
		};
		
		
		//Вывод списка подтоваров конкретной группы
			$(".tovar").change(function(){
				$(".kind_tovar option[value != '0']").remove();
				$(".param_tovar p").hide();
				$(".kind_tovar, .param_tovar").show();
				var chois = $(".tovar").val();
				$(".label_"+chois).show();
				getData('kind_tovar', chois);
			});	
		
		//Обработка пользовательского выбора
			$("form").submit(function() {
				$('.render_table td').remove();
				$('.render_table').slideDown();
				var str = $(this).serialize();
				setRender(str);
				return false;
			});
				
	});