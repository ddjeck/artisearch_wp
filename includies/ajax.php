<?php
//Обработка ajax запросов
function arti_search_callback() {
	global $wpdb;
	
	$id_tovar = intval( $_POST['tovar'] ); 
	$id_kind_tovar = intval( $_POST['kind_tovar'] ); 
	$user_chois = strip_tags($_POST['chois']);		
	$query = "SELECT id, name FROM c_category";
	
	if( $id_kind_tovar != 0 )
	{
		$query = "SELECT DISTINCT p.id, p.profile as name  
					FROM c_profile as p 
						JOIN c_tovar as t 
							ON t.prof = p.id 
					WHERE t.cat = ".$id_kind_tovar." ORDER BY name";
	}		
	
	if( $user_chois )
	{
		parse_str( $user_chois, $find );
		
		$find['param']  =  intval( $find['param'] );
		$find['kind_tovar'] = intval( $find['kind_tovar'] );
		$find['tovar'] = intval( $find['tovar'] );

		switch( $find['tovar'] )
		{	
			//Поиск по внутреннему диаметру
			case 1:
			case 2:
			case 6: $and_p = " AND t.int_d = ".$find['param']; break;
			
			//Поиск по внешнему диаметру
			case 10: $and_p = " AND t.ext_d = ".$find['param']; break;
			
			//Поиск по длине 
			case 3:
			case 4: $and_p = " AND t.lenght BETWEEN ".$find['param']*(0.95)." AND ".$find['param']*(1.05); break;
			
			//Поиск по ширине
			case 5: $and_p = " AND t.width = ".$find['param']; break;
			
			//Без учета парамеров
			case 7:
			case 8:
			case 9:
			default: $and_p = "";			
		}
		
		//Отлавливание путсого поля параметров
		if( $find['param'] == 0)
		{
			$and_p = "";
		}
		
		$and_k = " AND p.id = ".$find['kind_tovar'];
		//Отлавливание неуточненных пофилей товара
		if( $find['kind_tovar'] == 0 )  
		{
			$and_k = "";
		}
		
		$query = "SELECT t.name, t.sku, c.name as cat, p.profile, t.id, t.id as price 
					FROM c_tovar as t 
						JOIN c_category as c 
							ON c.id = t.cat 
						JOIN c_profile as p 
							ON p.id = t.prof 
					WHERE c.id = ".$find['tovar'].$and_k.$and_p." ORDER BY t.name";
	}
	
	$data = $wpdb->get_results( $query );
	
	if(	$wpdb->num_rows == 0) 
	{
		$data = false;
	}
			
	wp_send_json( $data );
	
	die(); 
}