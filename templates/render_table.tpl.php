<?php
//Шаблон отрисовки таблицы для вывода результата, зацеплена на хук контента

function renderTable()
{	
	return '<table class="render_table">
				<tbody>
					<th>Название</th>
					<th>Код товара</th>
					<th>Категория</th>
					<th>Профиль</th>
					<th>Цена</th>
				</tbody>
			</table>
			<h1 class="not_found">По вашему запросу ничего не найдено!!!</h1>';			
}