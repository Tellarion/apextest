<?php

$list = array(array(
        'Id' => 7906,
        'Category' => 'Офис',
        'Operation' => 'Аренда',
        'Address' => 'Россия, г Москва, ул Первомайская, д 128',
        'Square' => 32,
        'Floor' => 4,
        'Price' => 28797,
        'Description' => 'Аренда офиса 32 м2 м. Первомайская в ВАО в административном здании. Аренда офиса площадью 32 м2, высота потолков три метра, пластиковые стекло-пакеты, новые отопительные радиаторы, пол линолеум, потолок армстронг, стены обои под покраску, Сталинское административное пятиэтажное здание, охрана, круглосуточный доступ, телефон, интернет, в рабочем состоянии с открытой планировкой, парковка.',
        'ContactPhone' => '8 495 3690133',
        'ManagerName' => 'Сергей Вячеславович',
        'Images' => array('https://www.testsite.ru/img/21c1d05d-c862-2967-3650-60240a37e4a1.jpeg', 'https://www.testsite.ru/img/e3ef1dff-1090-0c40-0c81-60240a63e6cd.jpeg')
    ), array(
        'Id' => 7907,
        'Category' => 'Офис',
        'Operation' => 'Аренда',
        'Address' => 'Россия, г Москва, ул Первомайская, д 129',
        'Square' => 33,
        'Floor' => 4,
        'Price' => 11111,
        'Description' => 'Аренда офиса 32 м2 м. Первомайская в ВАО в административном здании. Аренда офиса площадью 32 м2, высота потолков три метра, пластиковые стекло-пакеты, новые отопительные радиаторы, пол линолеум, потолок армстронг, стены обои под покраску, Сталинское административное пятиэтажное здание, охрана, круглосуточный доступ, телефон, интернет, в рабочем состоянии с открытой планировкой, парковка.',
        'ContactPhone' => '8 495 3690134',
        'ManagerName' => 'Александр Дементьев',
        'Images' => array('https://www.testsite.ru/img/21c1d05d-c862-2967-3650-60240a37e4a1.jpeg', 'https://www.testsite.ru/img/e3ef1dff-1090-0c40-0c81-60240a63e6cd.jpeg')
    )
);

$blob = file_get_contents('data.xml');

$structure = "";

for($i = 0; $i < count($list); $i++) {
    if($i != count($list)-1) { $structure .= "<Ad>
        "; } else { $structure .= "
    <Ad>
        "; }
    for($j = 0; $j < count($list[$i]); $j++) {
        $key = array_keys($list[$i])[$j];
        if($key != "Images") {
            $value = array_values($list[$i])[$j];
        } else {
            $values = array_values($list[$i])[$j];
            $value = "";
            for($m = 0; $m < count($values); $m++) {
                $value .= <<<tellarion

            <Image
                url="{$values[$m]}"/>
tellarion;
            }
            $value .= "
        ";
        }

        if($j == count($list[$i])-1) {
            $structure .= "<{$key}>{$value}</{$key}>";
        } else {
            $structure .= <<<tellarion
<{$key}>{$value}</{$key}>
        
tellarion;
        }
    }
    $structure .= "
    </Ad>";
}

$template = <<<tellarion
<Ads formatVersion="3">
    {$structure}
</Ads>
tellarion;
file_put_contents('data.xml', $template);


?>