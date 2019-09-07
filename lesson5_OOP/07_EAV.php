<?php

/*
EAV структура помогает хранить данные в таблице, которая должна расширяться и в длину (добавление новых рядков), и в ширину (добавление колонок). Вместо одной такой таблицы будем хранить 3, которые могут расширяться только в длину.
Например, у нас есть продукт T-shirt у которого есть цвет и вес. Также есть продукт Notebook, у которого есть какое-то количество оперативы, RAM. Чтобы записать такие данные в классической таблице - у нее должны быть такие колонки:

Таблица Product
id	| name		| weight	| color		| RAM
1	| T-shirt	| 150		| blue		| null
2 	| Notebook	| null		| null		| 4

С ростом количества типов продуктов нам нужно будет создавать все больше колонок, и все больше ячеек будет заполняться значениями null. Это не эффективно. Решение - хранить отдельно ИД и названия продуктов (Entity), отдельно названия атрибутов (Attribute), и отдельно значения этих атрибутов (Value). Таблица выше примет такой вид:

Таблица entity
id	| name
1	| T-shirt
2 	| Notebook

Таблица attribute
id	| name
1	| color
2	| weight
3	| RAM

Таблица value
product_id	| attribute_id	| value
1			| 1				| blue
1			| 2				| 150
2			| 3				| 4

По этим трем таблицам можно восстановить оригинальную первую.
Восстанавливать данные можно разными способами, для примера рассмотрим такой запрос:

SELECT  
	entity.id as id, 
	entity.name as product_name,
	value.value as value,
	attribute.name as attribute_name
FROM entity
LEFT JOIN value on entity.id = value.product_id
LEFT JOIN attribute on value.attribute_id = attribute.id
WHERE entity.id = 1

Он выдаст 2 рядка, с информацией о продукте и его атрибутах. Если прогнать такой запрос в ПХП через PDO, нам вернется результат, как ниже в переменной $result. Код ниже восстановит информацию о продукте из такого запроса.
*/

$result = [
	[
		'id' => 1,
		'product_name' => 'T-shirt',
		'value' => 'blue',
		'attribute_name' => 'color'
	],
	[
		'id' => 1,
		'product_name' => 'T-shirt',
		'value' => '150',
		'attribute_name' => 'weight'
	],
];

//ИД и название продукта записываем сразу. Они будут во всех рядках одинаковые, их можно взять из любого рядка. Возьмем из первого ($result[0])
$data = [
	'id' => $result[0]['id'],
	'name' => $result[0]['product_name'],
];

//Для каждого из атрибутов, дополняем информацию о продукте:
foreach ($result as $item) {
	$data[$item['attribute_name']] = $item['value'];
}

var_dump($data);

// $this->_data = [
// 	'id' => 1,
// 	'name' => 'T-shirt',
// 	'color' => 'blue',
// 	'weight' => 150
// ];


