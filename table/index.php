<?php 
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


require_once __DIR__ . '/simple-xlsx.php'; // Подключаем обработчик XLSX
$file = __DIR__ . '/name_base.xlsx'; // Файл для обработки 
$xlsx = SimpleXLSX::parse($file);
$count_rows = count($xlsx->rows(0)); //Вычисляем общее количество строк в таблице
$rows = $xlsx->rows(0);

$names_file = __DIR__ . '/names.xlsx';
$names_xls = SimpleXLSX::parse($names_file);
$rows_names = $names_xls->rows(0);

foreach ($rows_names as $key => $value) {
    $name = trim($value[0]);
    $name = mb_strtolower($name);
    $names_arr[]=$name;
}

// print_r($names_arr); 


for ($i=1; $i < $count_rows ; $i++) {
    $arr = explode(' ', $rows[$i][0]);
    
    foreach ($arr as $key => $value) {
        
        $name_curr = trim($value);
        $name_curr = mb_strtolower($name_curr);
        

        foreach($names_arr as $k=>$val){
            if ($name_curr == $val) {
                $result_array[] = $name_curr;
            }
        }
    }


    
    
    // foreach($arr as $str){
    //     print_r($str);echo(' || ');
    //     if (isset($str[1])) {
    //         $array[] = $str[1];
    //     }else{
    //         $array[] = $str[0];
    //     }
    // } 
    
}

//print_r($result_array);


$file2 = __DIR__ . '/name_2021.xlsx'; // Файл для обработки 
$xlsx2 = SimpleXLSX::parse($file2);
$count_rows2 = count($xlsx2->rows(0)); //Вычисляем общее количество строк в таблице
$rows2 = $xlsx2->rows(0);


for ($i=1; $i < $count_rows2; $i++) { 
    $name2 = trim($rows2[$i][0]);
    $name2 = mb_strtolower($name2);
    $result_array[] = $name2;
}






foreach ($result_array as $key => $value) {
    echo "<div>{$value}</div>";
    
}



