<?php
//Шаблон для вывода плагина (форма поиска)
function  getTemplate() 
{
	echo '<div class="arti_search">
			<form>
				<select class="tovar" name="tovar">
					<option value="0" selected>Выберите товар</opton>
				</select>
				<select class="kind_tovar" name="kind_tovar">
					<option value="0" selected>Уточните тип товара</opton>
				</select>
				<div class="param_tovar">
					<p class="label_1">Укажите внутренний диаметр кольца, мм</p>
					<p class="label_2">Укажите внутренний диаметр манжеты, мм</p>
					<p class="label_3">Укажите длину ремня, мм</p>
					<p class="label_4">Укажите длину цепи, мм</p>
					<p class="label_5">Укажите ширину ленты, мм</p>
					<p class="label_6">Укажите внутренний диаметр сальника, мм</p>
					<p class="label_7">Можете оставить поле пустым</p>
					<p class="label_8">Можете оставить поле пустым</p>
					<p class="label_9">Можете оставить поле пустым</p>
					<p class="label_10">Укажите внешний диаметр рукава, мм</p>
					<input type="text" size="20" name="param" value="0"/>
				</div>
				<input type="submit" value="Подобрать">
			</form>
		  </div>';
}