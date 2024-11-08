<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// 处理预检请求
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}
// require __DIR__ . '/../src/臺中市各區人口結構.json';

class Home
{
    public $people_data;
    public function __construct()
    {
        $fileContent = file_get_contents(__DIR__ . '/../src/臺中市各區人口結構.json');
        $this->people_data = json_decode($fileContent, true);
    }

    public function get_area_old_max_and_min($datas){
        $data = $this->people_data;
        $results = [];
        $n = 0;
    
        foreach($data["Sheet1"] as $key => $value){
            if ($value['性別'] === "計"){
                // 計算嬰幼兒數量
                // 計算老年人數量
                $elderly_total = (isset($value['65-69歲合計數量']) ? $value['65-69歲合計數量'] : 0) + 
                                 (isset($value['70-74歲合計數量']) ? $value['70-74歲合計數量'] : 0) + 
                                 (isset($value['75-79歲合計數量']) ? $value['75-79歲合計數量'] : 0) + 
                                 (isset($value['80-84歲合計數量']) ? $value['80-84歲合計數量'] : 0) + 
                                 (isset($value['85-89歲合計數量']) ? $value['85-89歲合計數量'] : 0) + 
                                 (isset($value['90-94歲合計數量']) ? $value['90-94歲合計數量'] : 0) +  
                                 (isset($value['95-99歲合計數量']) ? $value['95-99歲合計數量'] : 0) + 
                                 (isset($value['100歲以上數量']) ? $value['100歲以上數量'] : 0);
                
                $results[$n] = [
                    "區別" => $value['區別'],
                    "里別" => $value['里別'],
                    "人口數量" =>  $elderly_total,
                ];
                $n++;
            }
        }

        $result = [];
        $max_value = PHP_INT_MIN; // 初始設定為 PHP 中可以表示的最小整數值
        $min_value = PHP_INT_MAX; // 初始設定為 PHP 中可以表示的最大整數值
        
        foreach ($results as $key => $value) {
            if ($value['人口數量'] > $max_value) {
                $result['Max'][0] = $value;
                $max_value = $value['人口數量'];
            }
            if ($value['人口數量'] < $min_value) {
                $result['Min'][0] = $value;
                $min_value = $value['人口數量'];
            }
        }
        return $result;
    }


    public function get_contry_old_max_and_min($datas){
        $data = $this->people_data;
        $results = [];
        $n = 0;
    
        foreach($data["Sheet1"] as $key => $value){
            if ($value['性別'] === "計"){
                // 計算嬰幼兒數量
                
                // 計算老年人數量
                $elderly_total = (isset($value['65-69歲合計數量']) ? $value['65-69歲合計數量'] : 0) + 
                                 (isset($value['70-74歲合計數量']) ? $value['70-74歲合計數量'] : 0) + 
                                 (isset($value['75-79歲合計數量']) ? $value['75-79歲合計數量'] : 0) + 
                                 (isset($value['80-84歲合計數量']) ? $value['80-84歲合計數量'] : 0) + 
                                 (isset($value['85-89歲合計數量']) ? $value['85-89歲合計數量'] : 0) + 
                                 (isset($value['90-94歲合計數量']) ? $value['90-94歲合計數量'] : 0) +  
                                 (isset($value['95-99歲合計數量']) ? $value['95-99歲合計數量'] : 0) + 
                                 (isset($value['100歲以上數量']) ? $value['100歲以上數量'] : 0);
                
                if (empty($results)) {
                    $results[$n] = [
                        "區別" => $value['區別'],
                        "人口數量" => $elderly_total,
                    ];
                } else {
                    // 判斷是否為同一個區別
                    if ($results[$n]["區別"] === $value["區別"]) {
                        $results[$n]["人口數量"] += ($elderly_total);
                    } else {
                        $n++;
                        $results[$n] = [
                            "區別" => $value['區別'],
                            "人口數量" => $elderly_total,
                        ];
                    }
                }
            
            }
        }

        $result = [];
        $max_value = PHP_INT_MIN; // 初始設定為 PHP 中可以表示的最小整數值
        $min_value = PHP_INT_MAX; // 初始設定為 PHP 中可以表示的最大整數值
        
        foreach ($results as $key => $value) {
            if ($value['人口數量'] > $max_value) {
                $result['Max'][0] = $value;
                $max_value = $value['人口數量'];
            }
            if ($value['人口數量'] < $min_value) {
                $result['Min'][0] = $value;
                $min_value = $value['人口數量'];
            }
        }
        return $result;
    }

    public function get_country_young_max_and_min($datas){
        $data = $this->people_data;
        $results = [];
        $n = 0;
    
        foreach($data["Sheet1"] as $key => $value){
            if ($value['性別'] === "計"){

                // 計算青壯年數量
                $young_woman_total = (isset($value['10-14歲合計數量']) ? $value['10-14歲合計數量'] : 0) + 
                (isset($value['15-19歲合計數量']) ? $value['15-19歲合計數量'] : 0) + 
                (isset($value['20-24歲合計數量']) ? $value['20-24歲合計數量'] : 0) + 
                (isset($value['25-29歲合計數量']) ? $value['25-29歲合計數量'] : 0) + 
                (isset($value['30-34歲合計數量']) ? $value['30-34歲合計數量'] : 0) + 
                (isset($value['35-39歲合計數量']) ? $value['35-39歲合計數量'] : 0) + 
                (isset($value['40-44歲合計數量']) ? $value['40-44歲合計數量'] : 0) + 
                (isset($value['45-49歲合計數量']) ? $value['45-49歲合計數量'] : 0) + 
                (isset($value['50-54歲合計數量']) ? $value['50-54歲合計數量'] : 0) + 
                (isset($value['55-59歲合計數量']) ? $value['55-59歲合計數量'] : 0) + 
                (isset($value['60-64歲合計數量']) ? $value['60-64歲合計數量'] : 0);
                
                $results[$n] = [
                    "區別" => $value['區別'],
                    "人口數量" => $young_woman_total,
                ];
                $n++;
            }
        }

        $result = [];
        $max_value = PHP_INT_MIN; // 初始設定為 PHP 中可以表示的最小整數值
        $min_value = PHP_INT_MAX; // 初始設定為 PHP 中可以表示的最大整數值
        
        foreach ($results as $key => $value) {
            if ($value['人口數量'] > $max_value) {
                $result['Max'][0] = $value;
                $max_value = $value['人口數量'];
            }
            if ($value['人口數量'] < $min_value) {
                $result['Min'][0] = $value;
                $min_value = $value['人口數量'];
            }
        }
        return $result;
    }

    public function get_area_young_max_and_min($datas){
        $data = $this->people_data;
        $results = [];
        $n = 0;
    
        foreach($data["Sheet1"] as $key => $value){
            if ($value['性別'] === "計"){

                // 計算青壯年數量
                $young_woman_total = (isset($value['10-14歲合計數量']) ? $value['10-14歲合計數量'] : 0) + 
                (isset($value['15-19歲合計數量']) ? $value['15-19歲合計數量'] : 0) + 
                (isset($value['20-24歲合計數量']) ? $value['20-24歲合計數量'] : 0) + 
                (isset($value['25-29歲合計數量']) ? $value['25-29歲合計數量'] : 0) + 
                (isset($value['30-34歲合計數量']) ? $value['30-34歲合計數量'] : 0) + 
                (isset($value['35-39歲合計數量']) ? $value['35-39歲合計數量'] : 0) + 
                (isset($value['40-44歲合計數量']) ? $value['40-44歲合計數量'] : 0) + 
                (isset($value['45-49歲合計數量']) ? $value['45-49歲合計數量'] : 0) + 
                (isset($value['50-54歲合計數量']) ? $value['50-54歲合計數量'] : 0) + 
                (isset($value['55-59歲合計數量']) ? $value['55-59歲合計數量'] : 0) + 
                (isset($value['60-64歲合計數量']) ? $value['60-64歲合計數量'] : 0);
                
                $results[$n] = [
                    "區別" => $value['區別'],
                    "里別" => $value['里別'],
                    "人口數量" => $young_woman_total,
                ];
                $n++;
            }
        }

        $result = [];
        $max_value = PHP_INT_MIN; // 初始設定為 PHP 中可以表示的最小整數值
        $min_value = PHP_INT_MAX; // 初始設定為 PHP 中可以表示的最大整數值
        
        foreach ($results as $key => $value) {
            if ($value['人口數量'] > $max_value) {
                $result['Max'][0] = $value;
                $max_value = $value['人口數量'];
            }
            if ($value['人口數量'] < $min_value) {
                $result['Min'][0] = $value;
                $min_value = $value['人口數量'];
            }
        }
        return $result;
    }

    public function get_infancy_area_max_and_min($datas){
        $data = $this->people_data;
        $results = [];
        $n = 0;
    
        foreach($data["Sheet1"] as $key => $value){
            if ($value['性別'] === "計"){
                // 計算嬰幼兒數量
                $infancy_total = (isset($value['0-4歲合計數量']) ? $value['0-4歲合計數量'] : 0) + 
                                 (isset($value['5-9歲合計數量']) ? $value['5-9歲合計數量'] : 0);

        
                $results[$n] = [
                    "區別" => $value['區別'],
                    "里別" => $value['里別'],
                    "人口數量" => $infancy_total,
                ];
                $n++;
            }
        }

        $result = [];
        $max_value = PHP_INT_MIN; // 初始設定為 PHP 中可以表示的最小整數值
        $min_value = PHP_INT_MAX; // 初始設定為 PHP 中可以表示的最大整數值
        
        foreach ($results as $key => $value) {
            if ($value['人口數量'] > $max_value) {
                $result['Max'][0] = $value;
                $max_value = $value['人口數量'];
            }
            if ($value['人口數量'] < $min_value) {
                $result['Min'][0] = $value;
                $min_value = $value['人口數量'];
            }
        }
        return $result;
    }

    public function get_infancy_country_max_and_min($datas){
        $data = $this->people_data;
        $results = [];
        $n = 0;
    
        foreach($data["Sheet1"] as $key => $value){
            if ($value['性別'] === "計"){
                // 計算嬰幼兒數量
                $infancy_total = (isset($value['0-4歲合計數量']) ? $value['0-4歲合計數量'] : 0) + 
                                 (isset($value['5-9歲合計數量']) ? $value['5-9歲合計數量'] : 0);
                
                $results[$n] = [
                    "區別" => $value['區別'],
                    "人口數量" => $infancy_total,
                ];
                $n++;
            }
        }

        $result = [];
        $max_value = PHP_INT_MIN; // 初始設定為 PHP 中可以表示的最小整數值
        $min_value = PHP_INT_MAX; // 初始設定為 PHP 中可以表示的最大整數值
        
        foreach ($results as $key => $value) {
            if ($value['人口數量'] > $max_value) {
                $result['Max'][0] = $value;
                $max_value = $value['人口數量'];
            }
            if ($value['人口數量'] < $min_value) {
                $result['Min'][0] = $value;
                $min_value = $value['人口數量'];
            }
        }
        return $result;
    }

    public function get_area_woman_max_and_min($datas){
        $data = $this->people_data;
        $results = [];
        $n = 0;
    
        foreach($data["Sheet1"] as $key => $value){
            if ($value['性別'] === "女"){
                // 計算嬰幼兒數量
                $infancy_total = (isset($value['0-4歲合計數量']) ? $value['0-4歲合計數量'] : 0) + 
                                 (isset($value['5-9歲合計數量']) ? $value['5-9歲合計數量'] : 0);

                // 計算青壯年數量
                $young_woman_total = (isset($value['10-14歲合計數量']) ? $value['10-14歲合計數量'] : 0) + 
                (isset($value['15-19歲合計數量']) ? $value['15-19歲合計數量'] : 0) + 
                (isset($value['20-24歲合計數量']) ? $value['20-24歲合計數量'] : 0) + 
                (isset($value['25-29歲合計數量']) ? $value['25-29歲合計數量'] : 0) + 
                (isset($value['30-34歲合計數量']) ? $value['30-34歲合計數量'] : 0) + 
                (isset($value['35-39歲合計數量']) ? $value['35-39歲合計數量'] : 0) + 
                (isset($value['40-44歲合計數量']) ? $value['40-44歲合計數量'] : 0) + 
                (isset($value['45-49歲合計數量']) ? $value['45-49歲合計數量'] : 0) + 
                (isset($value['50-54歲合計數量']) ? $value['50-54歲合計數量'] : 0) + 
                (isset($value['55-59歲合計數量']) ? $value['55-59歲合計數量'] : 0) + 
                (isset($value['60-64歲合計數量']) ? $value['60-64歲合計數量'] : 0);
                
                // 計算老年人數量
                $elderly_total = (isset($value['65-69歲合計數量']) ? $value['65-69歲合計數量'] : 0) + 
                                 (isset($value['70-74歲合計數量']) ? $value['70-74歲合計數量'] : 0) + 
                                 (isset($value['75-79歲合計數量']) ? $value['75-79歲合計數量'] : 0) + 
                                 (isset($value['80-84歲合計數量']) ? $value['80-84歲合計數量'] : 0) + 
                                 (isset($value['85-89歲合計數量']) ? $value['85-89歲合計數量'] : 0) + 
                                 (isset($value['90-94歲合計數量']) ? $value['90-94歲合計數量'] : 0) +  
                                 (isset($value['95-99歲合計數量']) ? $value['95-99歲合計數量'] : 0) + 
                                 (isset($value['100歲以上數量']) ? $value['100歲以上數量'] : 0);
                
                $results[$n] = [
                    "區別" => $value['區別'],
                    "里別" => $value['里別'],
                    "人口數量" => $infancy_total + $young_woman_total + $elderly_total,
                ];
                $n++;
            }
        }

        $result = [];
        $max_value = PHP_INT_MIN; // 初始設定為 PHP 中可以表示的最小整數值
        $min_value = PHP_INT_MAX; // 初始設定為 PHP 中可以表示的最大整數值
        
        foreach ($results as $key => $value) {
            if ($value['人口數量'] > $max_value) {
                $result['Max'][0] = $value;
                $max_value = $value['人口數量'];
            }
            if ($value['人口數量'] < $min_value) {
                $result['Min'][0] = $value;
                $min_value = $value['人口數量'];
            }
        }
        return $result;
    }

    public function get_contry_woman_max_and_min($datas){
        $data = $this->people_data;
        $results = [];
        $n = 0;
    
        foreach($data["Sheet1"] as $key => $value){
            if ($value['性別'] === "女"){
                // 計算嬰幼兒數量
                $infancy_total = (isset($value['0-4歲合計數量']) ? $value['0-4歲合計數量'] : 0) + 
                                 (isset($value['5-9歲合計數量']) ? $value['5-9歲合計數量'] : 0);

                // 計算青壯年數量
                $young_woman_total = (isset($value['10-14歲合計數量']) ? $value['10-14歲合計數量'] : 0) + 
                (isset($value['15-19歲合計數量']) ? $value['15-19歲合計數量'] : 0) + 
                (isset($value['20-24歲合計數量']) ? $value['20-24歲合計數量'] : 0) + 
                (isset($value['25-29歲合計數量']) ? $value['25-29歲合計數量'] : 0) + 
                (isset($value['30-34歲合計數量']) ? $value['30-34歲合計數量'] : 0) + 
                (isset($value['35-39歲合計數量']) ? $value['35-39歲合計數量'] : 0) + 
                (isset($value['40-44歲合計數量']) ? $value['40-44歲合計數量'] : 0) + 
                (isset($value['45-49歲合計數量']) ? $value['45-49歲合計數量'] : 0) + 
                (isset($value['50-54歲合計數量']) ? $value['50-54歲合計數量'] : 0) + 
                (isset($value['55-59歲合計數量']) ? $value['55-59歲合計數量'] : 0) + 
                (isset($value['60-64歲合計數量']) ? $value['60-64歲合計數量'] : 0);
                
                // 計算老年人數量
                $elderly_total = (isset($value['65-69歲合計數量']) ? $value['65-69歲合計數量'] : 0) + 
                                 (isset($value['70-74歲合計數量']) ? $value['70-74歲合計數量'] : 0) + 
                                 (isset($value['75-79歲合計數量']) ? $value['75-79歲合計數量'] : 0) + 
                                 (isset($value['80-84歲合計數量']) ? $value['80-84歲合計數量'] : 0) + 
                                 (isset($value['85-89歲合計數量']) ? $value['85-89歲合計數量'] : 0) + 
                                 (isset($value['90-94歲合計數量']) ? $value['90-94歲合計數量'] : 0) +  
                                 (isset($value['95-99歲合計數量']) ? $value['95-99歲合計數量'] : 0) + 
                                 (isset($value['100歲以上數量']) ? $value['100歲以上數量'] : 0);
                
                if (empty($results)) {
                    $results[$n] = [
                        "區別" => $value['區別'],
                        "人口數量" => $infancy_total + $young_woman_total + $elderly_total,
                    ];
                } else {
                    // 判斷是否為同一個區別
                    if ($results[$n]["區別"] === $value["區別"]) {
                        $results[$n]["人口數量"] += ($infancy_total + $young_woman_total + $elderly_total);
                    } else {
                        $n++;
                        $results[$n] = [
                            "區別" => $value['區別'],
                            "人口數量" => $infancy_total + $young_woman_total + $elderly_total,
                        ];
                    }
                }
            
            }
        }

        $result = [];
        $max_value = PHP_INT_MIN; // 初始設定為 PHP 中可以表示的最小整數值
        $min_value = PHP_INT_MAX; // 初始設定為 PHP 中可以表示的最大整數值
        
        foreach ($results as $key => $value) {
            if ($value['人口數量'] > $max_value) {
                $result['Max'][0] = $value;
                $max_value = $value['人口數量'];
            }
            if ($value['人口數量'] < $min_value) {
                $result['Min'][0] = $value;
                $min_value = $value['人口數量'];
            }
        }
        return $result;
    }

    public function get_contry_man_max_and_min($datas){
        $data = $this->people_data;
        $results = [];
        $n = 0;
    
        foreach($data["Sheet1"] as $key => $value){
            if ($value['性別'] === "男"){
                // 計算嬰幼兒數量
                $infancy_total = (isset($value['0-4歲合計數量']) ? $value['0-4歲合計數量'] : 0) + 
                                 (isset($value['5-9歲合計數量']) ? $value['5-9歲合計數量'] : 0);

                // 計算青壯年數量
                $young_woman_total = (isset($value['10-14歲合計數量']) ? $value['10-14歲合計數量'] : 0) + 
                (isset($value['15-19歲合計數量']) ? $value['15-19歲合計數量'] : 0) + 
                (isset($value['20-24歲合計數量']) ? $value['20-24歲合計數量'] : 0) + 
                (isset($value['25-29歲合計數量']) ? $value['25-29歲合計數量'] : 0) + 
                (isset($value['30-34歲合計數量']) ? $value['30-34歲合計數量'] : 0) + 
                (isset($value['35-39歲合計數量']) ? $value['35-39歲合計數量'] : 0) + 
                (isset($value['40-44歲合計數量']) ? $value['40-44歲合計數量'] : 0) + 
                (isset($value['45-49歲合計數量']) ? $value['45-49歲合計數量'] : 0) + 
                (isset($value['50-54歲合計數量']) ? $value['50-54歲合計數量'] : 0) + 
                (isset($value['55-59歲合計數量']) ? $value['55-59歲合計數量'] : 0) + 
                (isset($value['60-64歲合計數量']) ? $value['60-64歲合計數量'] : 0);
                
                // 計算老年人數量
                $elderly_total = (isset($value['65-69歲合計數量']) ? $value['65-69歲合計數量'] : 0) + 
                                 (isset($value['70-74歲合計數量']) ? $value['70-74歲合計數量'] : 0) + 
                                 (isset($value['75-79歲合計數量']) ? $value['75-79歲合計數量'] : 0) + 
                                 (isset($value['80-84歲合計數量']) ? $value['80-84歲合計數量'] : 0) + 
                                 (isset($value['85-89歲合計數量']) ? $value['85-89歲合計數量'] : 0) + 
                                 (isset($value['90-94歲合計數量']) ? $value['90-94歲合計數量'] : 0) +  
                                 (isset($value['95-99歲合計數量']) ? $value['95-99歲合計數量'] : 0) + 
                                 (isset($value['100歲以上數量']) ? $value['100歲以上數量'] : 0);
                
                if (empty($results)) {
                    $results[$n] = [
                        "區別" => $value['區別'],
                        "人口數量" => $infancy_total + $young_woman_total + $elderly_total,
                    ];
                } else {
                    // 判斷是否為同一個區別
                    if ($results[$n]["區別"] === $value["區別"]) {
                        $results[$n]["人口數量"] += ($infancy_total + $young_woman_total + $elderly_total);
                    } else {
                        $n++;
                        $results[$n] = [
                            "區別" => $value['區別'],
                            "人口數量" => $infancy_total + $young_woman_total + $elderly_total,
                        ];
                    }
                }
            
            }
        }

        $result = [];
        $max_value = PHP_INT_MIN; // 初始設定為 PHP 中可以表示的最小整數值
        $min_value = PHP_INT_MAX; // 初始設定為 PHP 中可以表示的最大整數值
        
        foreach ($results as $key => $value) {
            if ($value['人口數量'] > $max_value) {
                $result['Max'][0] = $value;
                $max_value = $value['人口數量'];
            }
            if ($value['人口數量'] < $min_value) {
                $result['Min'][0] = $value;
                $min_value = $value['人口數量'];
            }
        }
        return $result;
    }

    public function get_area_man_max_and_min($datas){
        $data = $this->people_data;
        $results = [];
        $n = 0;
    
        foreach($data["Sheet1"] as $key => $value){
            if ($value['性別'] === "男"){
                // 計算嬰幼兒數量
                $infancy_total = (isset($value['0-4歲合計數量']) ? $value['0-4歲合計數量'] : 0) + 
                                 (isset($value['5-9歲合計數量']) ? $value['5-9歲合計數量'] : 0);

                // 計算青壯年數量
                $young_woman_total = (isset($value['10-14歲合計數量']) ? $value['10-14歲合計數量'] : 0) + 
                (isset($value['15-19歲合計數量']) ? $value['15-19歲合計數量'] : 0) + 
                (isset($value['20-24歲合計數量']) ? $value['20-24歲合計數量'] : 0) + 
                (isset($value['25-29歲合計數量']) ? $value['25-29歲合計數量'] : 0) + 
                (isset($value['30-34歲合計數量']) ? $value['30-34歲合計數量'] : 0) + 
                (isset($value['35-39歲合計數量']) ? $value['35-39歲合計數量'] : 0) + 
                (isset($value['40-44歲合計數量']) ? $value['40-44歲合計數量'] : 0) + 
                (isset($value['45-49歲合計數量']) ? $value['45-49歲合計數量'] : 0) + 
                (isset($value['50-54歲合計數量']) ? $value['50-54歲合計數量'] : 0) + 
                (isset($value['55-59歲合計數量']) ? $value['55-59歲合計數量'] : 0) + 
                (isset($value['60-64歲合計數量']) ? $value['60-64歲合計數量'] : 0);
                
                // 計算老年人數量
                $elderly_total = (isset($value['65-69歲合計數量']) ? $value['65-69歲合計數量'] : 0) + 
                                 (isset($value['70-74歲合計數量']) ? $value['70-74歲合計數量'] : 0) + 
                                 (isset($value['75-79歲合計數量']) ? $value['75-79歲合計數量'] : 0) + 
                                 (isset($value['80-84歲合計數量']) ? $value['80-84歲合計數量'] : 0) + 
                                 (isset($value['85-89歲合計數量']) ? $value['85-89歲合計數量'] : 0) + 
                                 (isset($value['90-94歲合計數量']) ? $value['90-94歲合計數量'] : 0) +  
                                 (isset($value['95-99歲合計數量']) ? $value['95-99歲合計數量'] : 0) + 
                                 (isset($value['100歲以上數量']) ? $value['100歲以上數量'] : 0);
                
                $results[$n] = [
                    "區別" => $value['區別'],
                    "里別" => $value['里別'],
                    "人口數量" => $infancy_total + $young_woman_total + $elderly_total,
                ];
                $n++;
            }
        }

        $result = [];
        $max_value = PHP_INT_MIN; // 初始設定為 PHP 中可以表示的最小整數值
        $min_value = PHP_INT_MAX; // 初始設定為 PHP 中可以表示的最大整數值
        
        foreach ($results as $key => $value) {
            if ($value['人口數量'] > $max_value) {
                $result['Max'][0] = $value;
                $max_value = $value['人口數量'];
            }
            if ($value['人口數量'] < $min_value) {
                $result['Min'][0] = $value;
                $min_value = $value['人口數量'];
            }
        }
        return $result;
    }

    public function get_area_total_max_and_min($datas){
        $data = $this->people_data;
        $results = [];
        $n = 0;
    
        foreach($data["Sheet1"] as $key => $value){
            if ($value['性別'] === "計"){
                // 計算嬰幼兒數量
                $infancy_total = (isset($value['0-4歲合計數量']) ? $value['0-4歲合計數量'] : 0) + 
                                 (isset($value['5-9歲合計數量']) ? $value['5-9歲合計數量'] : 0);

                // 計算青壯年數量
                $young_woman_total = (isset($value['10-14歲合計數量']) ? $value['10-14歲合計數量'] : 0) + 
                (isset($value['15-19歲合計數量']) ? $value['15-19歲合計數量'] : 0) + 
                (isset($value['20-24歲合計數量']) ? $value['20-24歲合計數量'] : 0) + 
                (isset($value['25-29歲合計數量']) ? $value['25-29歲合計數量'] : 0) + 
                (isset($value['30-34歲合計數量']) ? $value['30-34歲合計數量'] : 0) + 
                (isset($value['35-39歲合計數量']) ? $value['35-39歲合計數量'] : 0) + 
                (isset($value['40-44歲合計數量']) ? $value['40-44歲合計數量'] : 0) + 
                (isset($value['45-49歲合計數量']) ? $value['45-49歲合計數量'] : 0) + 
                (isset($value['50-54歲合計數量']) ? $value['50-54歲合計數量'] : 0) + 
                (isset($value['55-59歲合計數量']) ? $value['55-59歲合計數量'] : 0) + 
                (isset($value['60-64歲合計數量']) ? $value['60-64歲合計數量'] : 0);
                
                // 計算老年人數量
                $elderly_total = (isset($value['65-69歲合計數量']) ? $value['65-69歲合計數量'] : 0) + 
                                 (isset($value['70-74歲合計數量']) ? $value['70-74歲合計數量'] : 0) + 
                                 (isset($value['75-79歲合計數量']) ? $value['75-79歲合計數量'] : 0) + 
                                 (isset($value['80-84歲合計數量']) ? $value['80-84歲合計數量'] : 0) + 
                                 (isset($value['85-89歲合計數量']) ? $value['85-89歲合計數量'] : 0) + 
                                 (isset($value['90-94歲合計數量']) ? $value['90-94歲合計數量'] : 0) +  
                                 (isset($value['95-99歲合計數量']) ? $value['95-99歲合計數量'] : 0) + 
                                 (isset($value['100歲以上數量']) ? $value['100歲以上數量'] : 0);
                
                $results[$n] = [
                    "區別" => $value['區別'],
                    "里別" => $value['里別'],
                    "人口數量" => $infancy_total + $young_woman_total + $elderly_total,
                ];
                $n++;
            }
        }

        $result = [];
        $max_value = PHP_INT_MIN; // 初始設定為 PHP 中可以表示的最小整數值
        $min_value = PHP_INT_MAX; // 初始設定為 PHP 中可以表示的最大整數值
        
        foreach ($results as $key => $value) {
            if ($value['人口數量'] > $max_value) {
                $result['Max'][0] = $value;
                $max_value = $value['人口數量'];
            }
            if ($value['人口數量'] < $min_value) {
                $result['Min'][0] = $value;
                $min_value = $value['人口數量'];
            }
        }
        return $result;
    }

    public function get_contry_total_max_and_min($datas){
        $data = $this->people_data;
        $results = [];
        $n = 0;
    
        foreach($data["Sheet1"] as $key => $value){
            if ($value['性別'] === "計"){
                // 計算嬰幼兒數量
                $infancy_total = (isset($value['0-4歲合計數量']) ? $value['0-4歲合計數量'] : 0) + 
                                 (isset($value['5-9歲合計數量']) ? $value['5-9歲合計數量'] : 0);

                // 計算青壯年數量
                $young_woman_total = (isset($value['10-14歲合計數量']) ? $value['10-14歲合計數量'] : 0) + 
                (isset($value['15-19歲合計數量']) ? $value['15-19歲合計數量'] : 0) + 
                (isset($value['20-24歲合計數量']) ? $value['20-24歲合計數量'] : 0) + 
                (isset($value['25-29歲合計數量']) ? $value['25-29歲合計數量'] : 0) + 
                (isset($value['30-34歲合計數量']) ? $value['30-34歲合計數量'] : 0) + 
                (isset($value['35-39歲合計數量']) ? $value['35-39歲合計數量'] : 0) + 
                (isset($value['40-44歲合計數量']) ? $value['40-44歲合計數量'] : 0) + 
                (isset($value['45-49歲合計數量']) ? $value['45-49歲合計數量'] : 0) + 
                (isset($value['50-54歲合計數量']) ? $value['50-54歲合計數量'] : 0) + 
                (isset($value['55-59歲合計數量']) ? $value['55-59歲合計數量'] : 0) + 
                (isset($value['60-64歲合計數量']) ? $value['60-64歲合計數量'] : 0);
                
                // 計算老年人數量
                $elderly_total = (isset($value['65-69歲合計數量']) ? $value['65-69歲合計數量'] : 0) + 
                                 (isset($value['70-74歲合計數量']) ? $value['70-74歲合計數量'] : 0) + 
                                 (isset($value['75-79歲合計數量']) ? $value['75-79歲合計數量'] : 0) + 
                                 (isset($value['80-84歲合計數量']) ? $value['80-84歲合計數量'] : 0) + 
                                 (isset($value['85-89歲合計數量']) ? $value['85-89歲合計數量'] : 0) + 
                                 (isset($value['90-94歲合計數量']) ? $value['90-94歲合計數量'] : 0) +  
                                 (isset($value['95-99歲合計數量']) ? $value['95-99歲合計數量'] : 0) + 
                                 (isset($value['100歲以上數量']) ? $value['100歲以上數量'] : 0);
                
                if (empty($results)) {
                    $results[$n] = [
                        "區別" => $value['區別'],
                        "人口數量" => $infancy_total + $young_woman_total + $elderly_total,
                    ];
                } else {
                    // 判斷是否為同一個區別
                    if ($results[$n]["區別"] === $value["區別"]) {
                        $results[$n]["人口數量"] += ($infancy_total + $young_woman_total + $elderly_total);
                    } else {
                        $n++;
                        $results[$n] = [
                            "區別" => $value['區別'],
                            "人口數量" => $infancy_total + $young_woman_total + $elderly_total,
                        ];
                    }
                }
            
            }
        }

        $result = [];
        $max_value = PHP_INT_MIN; // 初始設定為 PHP 中可以表示的最小整數值
        $min_value = PHP_INT_MAX; // 初始設定為 PHP 中可以表示的最大整數值
        
        foreach ($results as $key => $value) {
            if ($value['人口數量'] > $max_value) {
                $result['Max'][0] = $value;
                $max_value = $value['人口數量'];
            }
            if ($value['人口數量'] < $min_value) {
                $result['Min'][0] = $value;
                $min_value = $value['人口數量'];
            }
        }
        return $result;
    }

    public function get_man_total($datas){
        $data = $this->people_data;
        $result = [];
        $n = 0;
    
        foreach($data["Sheet1"] as $key => $value){
            if ($value['性別'] === "男"){
                // 確保 $datas["區別"] 和 $datas["里別"] 已經設定
                $is_specific_area = isset($datas["區別"]) && isset($datas["里別"]);
    
                if ($is_specific_area) {
                    // 確保 $value["區別"] 和 $value["里別"] 已經設定
                    $matches_area = isset($value['區別']) && isset($value['里別']) && 
                                    $value['區別'] === $datas['區別'] && $value['里別'] === $datas['里別'];
    
                    if (!$matches_area) {
                        continue;
                    }
                }

                // 計算嬰幼兒數量
                $infancy_total = (isset($value['0-4歲合計數量']) ? $value['0-4歲合計數量'] : 0) + 
                                 (isset($value['5-9歲合計數量']) ? $value['5-9歲合計數量'] : 0);

                // 計算青壯年數量
                $young_woman_total = (isset($value['10-14歲合計數量']) ? $value['10-14歲合計數量'] : 0) + 
                (isset($value['15-19歲合計數量']) ? $value['15-19歲合計數量'] : 0) + 
                (isset($value['20-24歲合計數量']) ? $value['20-24歲合計數量'] : 0) + 
                (isset($value['25-29歲合計數量']) ? $value['25-29歲合計數量'] : 0) + 
                (isset($value['30-34歲合計數量']) ? $value['30-34歲合計數量'] : 0) + 
                (isset($value['35-39歲合計數量']) ? $value['35-39歲合計數量'] : 0) + 
                (isset($value['40-44歲合計數量']) ? $value['40-44歲合計數量'] : 0) + 
                (isset($value['45-49歲合計數量']) ? $value['45-49歲合計數量'] : 0) + 
                (isset($value['50-54歲合計數量']) ? $value['50-54歲合計數量'] : 0) + 
                (isset($value['55-59歲合計數量']) ? $value['55-59歲合計數量'] : 0) + 
                (isset($value['60-64歲合計數量']) ? $value['60-64歲合計數量'] : 0);
                
                // 計算老年人數量
                $elderly_total = (isset($value['65-69歲合計數量']) ? $value['65-69歲合計數量'] : 0) + 
                                 (isset($value['70-74歲合計數量']) ? $value['70-74歲合計數量'] : 0) + 
                                 (isset($value['75-79歲合計數量']) ? $value['75-79歲合計數量'] : 0) + 
                                 (isset($value['80-84歲合計數量']) ? $value['80-84歲合計數量'] : 0) + 
                                 (isset($value['85-89歲合計數量']) ? $value['85-89歲合計數量'] : 0) + 
                                 (isset($value['90-94歲合計數量']) ? $value['90-94歲合計數量'] : 0) +  
                                 (isset($value['95-99歲合計數量']) ? $value['95-99歲合計數量'] : 0) + 
                                 (isset($value['100歲以上數量']) ? $value['100歲以上數量'] : 0);
                
                $result[$n] = [
                    "區別" => $value['區別'],
                    "里別" => $value['里別'],
                    "嬰幼兒數量" => $infancy_total,
                    "青壯年數量" => $young_woman_total,
                    "老年人數量" => $elderly_total,
                ];
                $n++;
            }
        }
        return $result;
    }

    public function get_woman_total($datas){
        $data = $this->people_data;
        $result = [];
        $n = 0;
    
        foreach($data["Sheet1"] as $key => $value){
            if ($value['性別'] === "女"){
                // 確保 $datas["區別"] 和 $datas["里別"] 已經設定
                $is_specific_area = isset($datas["區別"]) && isset($datas["里別"]);
    
                if ($is_specific_area) {
                    // 確保 $value["區別"] 和 $value["里別"] 已經設定
                    $matches_area = isset($value['區別']) && isset($value['里別']) && 
                                    $value['區別'] === $datas['區別'] && $value['里別'] === $datas['里別'];
    
                    if (!$matches_area) {
                        continue;
                    }
                }

                // 計算嬰幼兒數量
                $infancy_total = (isset($value['0-4歲合計數量']) ? $value['0-4歲合計數量'] : 0) + 
                                 (isset($value['5-9歲合計數量']) ? $value['5-9歲合計數量'] : 0);

                // 計算青壯年數量
                $young_woman_total = (isset($value['10-14歲合計數量']) ? $value['10-14歲合計數量'] : 0) + 
                (isset($value['15-19歲合計數量']) ? $value['15-19歲合計數量'] : 0) + 
                (isset($value['20-24歲合計數量']) ? $value['20-24歲合計數量'] : 0) + 
                (isset($value['25-29歲合計數量']) ? $value['25-29歲合計數量'] : 0) + 
                (isset($value['30-34歲合計數量']) ? $value['30-34歲合計數量'] : 0) + 
                (isset($value['35-39歲合計數量']) ? $value['35-39歲合計數量'] : 0) + 
                (isset($value['40-44歲合計數量']) ? $value['40-44歲合計數量'] : 0) + 
                (isset($value['45-49歲合計數量']) ? $value['45-49歲合計數量'] : 0) + 
                (isset($value['50-54歲合計數量']) ? $value['50-54歲合計數量'] : 0) + 
                (isset($value['55-59歲合計數量']) ? $value['55-59歲合計數量'] : 0) + 
                (isset($value['60-64歲合計數量']) ? $value['60-64歲合計數量'] : 0);
                
                // 計算老年人數量
                $elderly_total = (isset($value['65-69歲合計數量']) ? $value['65-69歲合計數量'] : 0) + 
                                 (isset($value['70-74歲合計數量']) ? $value['70-74歲合計數量'] : 0) + 
                                 (isset($value['75-79歲合計數量']) ? $value['75-79歲合計數量'] : 0) + 
                                 (isset($value['80-84歲合計數量']) ? $value['80-84歲合計數量'] : 0) + 
                                 (isset($value['85-89歲合計數量']) ? $value['85-89歲合計數量'] : 0) + 
                                 (isset($value['90-94歲合計數量']) ? $value['90-94歲合計數量'] : 0) +  
                                 (isset($value['95-99歲合計數量']) ? $value['95-99歲合計數量'] : 0) + 
                                 (isset($value['100歲以上數量']) ? $value['100歲以上數量'] : 0);
                
                $result[$n] = [
                    "區別" => $value['區別'],
                    "里別" => $value['里別'],
                    "嬰幼兒數量" => $infancy_total,
                    "青壯年數量" => $young_woman_total,
                    "老年人數量" => $elderly_total,
                ];
                $n++;
            }
        }
        return $result;
    }


    public function get_total($datas){
        $data = $this->people_data;
        $result = [];
        $n = 0;
    
        foreach($data["Sheet1"] as $key => $value){
            if ($value['性別'] === "計"){
                // 確保 $datas["區別"] 和 $datas["里別"] 已經設定
                $is_specific_area = isset($datas["區別"]) && isset($datas["里別"]);
    
                if ($is_specific_area) {
                    // 確保 $value["區別"] 和 $value["里別"] 已經設定
                    $matches_area = isset($value['區別']) && isset($value['里別']) && 
                                    $value['區別'] === $datas['區別'] && $value['里別'] === $datas['里別'];
    
                    if (!$matches_area) {
                        continue;
                    }
                }

                // 計算嬰幼兒數量
                $infancy_total = (isset($value['0-4歲合計數量']) ? $value['0-4歲合計數量'] : 0) + 
                                 (isset($value['5-9歲合計數量']) ? $value['5-9歲合計數量'] : 0);

                // 計算青壯年數量
                $young_woman_total = (isset($value['10-14歲合計數量']) ? $value['10-14歲合計數量'] : 0) + 
                (isset($value['15-19歲合計數量']) ? $value['15-19歲合計數量'] : 0) + 
                (isset($value['20-24歲合計數量']) ? $value['20-24歲合計數量'] : 0) + 
                (isset($value['25-29歲合計數量']) ? $value['25-29歲合計數量'] : 0) + 
                (isset($value['30-34歲合計數量']) ? $value['30-34歲合計數量'] : 0) + 
                (isset($value['35-39歲合計數量']) ? $value['35-39歲合計數量'] : 0) + 
                (isset($value['40-44歲合計數量']) ? $value['40-44歲合計數量'] : 0) + 
                (isset($value['45-49歲合計數量']) ? $value['45-49歲合計數量'] : 0) + 
                (isset($value['50-54歲合計數量']) ? $value['50-54歲合計數量'] : 0) + 
                (isset($value['55-59歲合計數量']) ? $value['55-59歲合計數量'] : 0) + 
                (isset($value['60-64歲合計數量']) ? $value['60-64歲合計數量'] : 0);
                
                // 計算老年人數量
                $elderly_total = (isset($value['65-69歲合計數量']) ? $value['65-69歲合計數量'] : 0) + 
                                 (isset($value['70-74歲合計數量']) ? $value['70-74歲合計數量'] : 0) + 
                                 (isset($value['75-79歲合計數量']) ? $value['75-79歲合計數量'] : 0) + 
                                 (isset($value['80-84歲合計數量']) ? $value['80-84歲合計數量'] : 0) + 
                                 (isset($value['85-89歲合計數量']) ? $value['85-89歲合計數量'] : 0) + 
                                 (isset($value['90-94歲合計數量']) ? $value['90-94歲合計數量'] : 0) +  
                                 (isset($value['95-99歲合計數量']) ? $value['95-99歲合計數量'] : 0) + 
                                 (isset($value['100歲以上數量']) ? $value['100歲以上數量'] : 0);
                
                $result[$n] = [
                    "區別" => $value['區別'],
                    "里別" => $value['里別'],
                    "嬰幼兒數量" => $infancy_total,
                    "青壯年數量" => $young_woman_total,
                    "老年人數量" => $elderly_total,
                ];
                $n++;
            }
        }
        return $result;
    }
    public function get_older_total($datas){
        $data = $this->people_data;
        $result = [];
        $n = 0;
    
        foreach($data["Sheet1"] as $key => $value){
            if ($value['性別'] === "計"){
                // 確保 $datas["區別"] 和 $datas["里別"] 已經設定
                $is_specific_area = isset($datas["區別"]) && isset($datas["里別"]);
    
                if ($is_specific_area) {
                    // 確保 $value["區別"] 和 $value["里別"] 已經設定
                    $matches_area = isset($value['區別']) && isset($value['里別']) && 
                                    $value['區別'] === $datas['區別'] && $value['里別'] === $datas['里別'];
    
                    if (!$matches_area) {
                        continue;
                    }
                }
                
                // 計算老年人數量
                $elderly_total = (isset($value['65-69歲合計數量']) ? $value['65-69歲合計數量'] : 0) + 
                                 (isset($value['70-74歲合計數量']) ? $value['70-74歲合計數量'] : 0) + 
                                 (isset($value['75-79歲合計數量']) ? $value['75-79歲合計數量'] : 0) + 
                                 (isset($value['80-84歲合計數量']) ? $value['80-84歲合計數量'] : 0) + 
                                 (isset($value['85-89歲合計數量']) ? $value['85-89歲合計數量'] : 0) + 
                                 (isset($value['90-94歲合計數量']) ? $value['90-94歲合計數量'] : 0) +  
                                 (isset($value['95-99歲合計數量']) ? $value['95-99歲合計數量'] : 0) + 
                                 (isset($value['100歲以上數量']) ? $value['100歲以上數量'] : 0);
                
                $result[$n] = [
                    "區別" => $value['區別'],
                    "里別" => $value['里別'],
                    "老年人數量" => $elderly_total,
                ];
                $n++;
            }
        }
        return $result;
    }
    
    
    

    public function get_older_woman($datas){
        $data = $this->people_data;
        $result = [];
        $n = 0;
        
        foreach($data["Sheet1"] as $key => $value){
            if ($value['性別'] === "女"){
                // 檢查是否有特定的區別和里別條件
                $is_specific_area = isset($datas["區別"]) && isset($datas["里別"]);

    
                if ($is_specific_area) {
                    // 確保 $value["區別"] 和 $value["里別"] 已經設定
                    $matches_area = array_key_exists('區別', $value) && array_key_exists('里別', $value) &&
                                    $value['區別'] === $datas['區別'] && $value['里別'] === $datas['里別'];
    
                    if (!$matches_area) {
                        continue;
                    }
                }
                
                // 計算老年人數量
                $elderly_total = (array_key_exists('65-69歲合計數量', $value) ? $value['65-69歲合計數量'] : 0) + 
                                 (array_key_exists('70-74歲合計數量', $value) ? $value['70-74歲合計數量'] : 0) + 
                                 (array_key_exists('75-79歲合計數量', $value) ? $value['75-79歲合計數量'] : 0) + 
                                 (array_key_exists('80-84歲合計數量', $value) ? $value['80-84歲合計數量'] : 0) + 
                                 (array_key_exists('85-89歲合計數量', $value) ? $value['85-89歲合計數量'] : 0) + 
                                 (array_key_exists('90-94歲合計數量', $value) ? $value['90-94歲合計數量'] : 0) +  
                                 (array_key_exists('95-99歲合計數量', $value) ? $value['95-99歲合計數量'] : 0) + 
                                 (array_key_exists('100歲以上數量', $value) ? $value['100歲以上數量'] : 0);
                
                $result[$n] = [
                    "區別" => $value['區別'],
                    "里別" => $value['里別'],
                    "老女人數量" => $elderly_total,
                ];
                $n++;
            }
        }
        
        return $result;
    }
    

    public function get_older_man($datas){
        $data = $this->people_data;
        $result = [];
        $n = 0;
        
        foreach($data["Sheet1"] as $key => $value){
            if ($value['性別'] === "男"){
                // 檢查是否有特定的區別和里別條件
                $is_specific_area = isset($datas["區別"]) && isset($datas["里別"]);

    
                if ($is_specific_area) {
                    // 確保 $value["區別"] 和 $value["里別"] 已經設定
                    $matches_area = array_key_exists('區別', $value) && array_key_exists('里別', $value) &&
                                    $value['區別'] === $datas['區別'] && $value['里別'] === $datas['里別'];
    
                    if (!$matches_area) {
                        continue;
                    }
                }
                
                // 計算老年人數量
                $elderly_total = (array_key_exists('65-69歲合計數量', $value) ? $value['65-69歲合計數量'] : 0) + 
                                 (array_key_exists('70-74歲合計數量', $value) ? $value['70-74歲合計數量'] : 0) + 
                                 (array_key_exists('75-79歲合計數量', $value) ? $value['75-79歲合計數量'] : 0) + 
                                 (array_key_exists('80-84歲合計數量', $value) ? $value['80-84歲合計數量'] : 0) + 
                                 (array_key_exists('85-89歲合計數量', $value) ? $value['85-89歲合計數量'] : 0) + 
                                 (array_key_exists('90-94歲合計數量', $value) ? $value['90-94歲合計數量'] : 0) +  
                                 (array_key_exists('95-99歲合計數量', $value) ? $value['95-99歲合計數量'] : 0) + 
                                 (array_key_exists('100歲以上數量', $value) ? $value['100歲以上數量'] : 0);
                
                $result[$n] = [
                    "區別" => $value['區別'],
                    "里別" => $value['里別'],
                    "老男人數量" => $elderly_total,
                ];
                $n++;
            }
        }
        
        return $result;
    }

    public function get_infancy_total($datas){
        $data = $this->people_data;
        $result = [];
        $n = 0;
    
        foreach($data["Sheet1"] as $key => $value){
            if ($value['性別'] === "計"){
                // 確保 $datas["區別"] 和 $datas["里別"] 已經設定
                $is_specific_area = isset($datas["區別"]) && isset($datas["里別"]);
    
                if ($is_specific_area) {
                    // 確保 $value["區別"] 和 $value["里別"] 已經設定
                    $matches_area = isset($value['區別']) && isset($value['里別']) && 
                                    $value['區別'] === $datas['區別'] && $value['里別'] === $datas['里別'];
    
                    if (!$matches_area) {
                        continue;
                    }
                }
                
                // 計算嬰幼兒數量
                $infancy_total = (isset($value['0-4歲合計數量']) ? $value['0-4歲合計數量'] : 0) + 
                                 (isset($value['5-9歲合計數量']) ? $value['5-9歲合計數量'] : 0);
                
                $result[$n] = [
                    "區別" => $value['區別'],
                    "里別" => $value['里別'],
                    "嬰幼兒數量" => $infancy_total,
                ];
                $n++;
            }
        }
        return $result;
    }
     

    public function get_infancy_woman($datas){
        $data = $this->people_data;
        $result = [];
        $n = 0;
    
        foreach($data["Sheet1"] as $key => $value){
            if ($value['性別'] === "女"){
                // 確保 $datas["區別"] 和 $datas["里別"] 已經設定
                $is_specific_area = isset($datas["區別"]) && isset($datas["里別"]);
    
                if ($is_specific_area) {
                    // 確保 $value["區別"] 和 $value["里別"] 已經設定
                    $matches_area = isset($value['區別']) && isset($value['里別']) && 
                                    $value['區別'] === $datas['區別'] && $value['里別'] === $datas['里別'];
    
                    if (!$matches_area) {
                        continue;
                    }
                }
                
                // 計算嬰幼兒數量
                $infancy_total = (isset($value['0-4歲合計數量']) ? $value['0-4歲合計數量'] : 0) + 
                                 (isset($value['5-9歲合計數量']) ? $value['5-9歲合計數量'] : 0);
                
                $result[$n] = [
                    "區別" => $value['區別'],
                    "里別" => $value['里別'],
                    "女嬰幼兒數量" => $infancy_total,
                ];
                $n++;
            }
        }
        return $result;
    } 

    public function get_infancy_man($datas){
        $data = $this->people_data;
        $result = [];
        $n = 0;
    
        foreach($data["Sheet1"] as $key => $value){
            if ($value['性別'] === "男"){
                // 確保 $datas["區別"] 和 $datas["里別"] 已經設定
                $is_specific_area = isset($datas["區別"]) && isset($datas["里別"]);
    
                if ($is_specific_area) {
                    // 確保 $value["區別"] 和 $value["里別"] 已經設定
                    $matches_area = isset($value['區別']) && isset($value['里別']) && 
                                    $value['區別'] === $datas['區別'] && $value['里別'] === $datas['里別'];
    
                    if (!$matches_area) {
                        continue;
                    }
                }
                
                // 計算嬰幼兒數量
                $infancy_total = (isset($value['0-4歲合計數量']) ? $value['0-4歲合計數量'] : 0) + 
                                 (isset($value['5-9歲合計數量']) ? $value['5-9歲合計數量'] : 0);
                
                $result[$n] = [
                    "區別" => $value['區別'],
                    "里別" => $value['里別'],
                    "男嬰幼兒數量" => $infancy_total,
                ];
                $n++;
            }
        }
        return $result;
    } 

    public function get_young_total($datas){
        $data = $this->people_data;
        $result = [];
        $n = 0;
    
        foreach($data["Sheet1"] as $key => $value){
            if ($value['性別'] === "計"){
                // 檢查是否有特定的區別和里別條件
                $is_specific_area = isset($datas["區別"]) && isset($datas["里別"]);
                $matches_area = (!$is_specific_area) ||
                                (isset($value['區別']) && isset($value['里別']) &&
                                 $value['區別'] === $datas['區別'] && $value['里別'] === $datas['里別']);
                
                if ($matches_area) {
                    // 計算青壯年數量
                    $young_woman_total = (isset($value['10-14歲合計數量']) ? $value['10-14歲合計數量'] : 0) + 
                                         (isset($value['15-19歲合計數量']) ? $value['15-19歲合計數量'] : 0) + 
                                         (isset($value['20-24歲合計數量']) ? $value['20-24歲合計數量'] : 0) + 
                                         (isset($value['25-29歲合計數量']) ? $value['25-29歲合計數量'] : 0) + 
                                         (isset($value['30-34歲合計數量']) ? $value['30-34歲合計數量'] : 0) + 
                                         (isset($value['35-39歲合計數量']) ? $value['35-39歲合計數量'] : 0) + 
                                         (isset($value['40-44歲合計數量']) ? $value['40-44歲合計數量'] : 0) + 
                                         (isset($value['45-49歲合計數量']) ? $value['45-49歲合計數量'] : 0) + 
                                         (isset($value['50-54歲合計數量']) ? $value['50-54歲合計數量'] : 0) + 
                                         (isset($value['55-59歲合計數量']) ? $value['55-59歲合計數量'] : 0) + 
                                         (isset($value['60-64歲合計數量']) ? $value['60-64歲合計數量'] : 0);
                    
                    $result[$n] = [
                        "區別" => $value['區別'],
                        "里別" => $value['里別'],
                        "青壯年數量" => $young_woman_total,
                    ];
                    $n++;
                }
            }
        }
        return $result;
    }
     

    public function get_young_woman($datas){
        $data = $this->people_data;
        $result = [];
        $n = 0;
    
        foreach($data["Sheet1"] as $key => $value){
            if ($value['性別'] === "女"){
                // 檢查是否有特定的區別和里別條件
                $is_specific_area = isset($datas["區別"]) && isset($datas["里別"]);
                $matches_area = (!$is_specific_area) ||
                                (isset($value['區別']) && isset($value['里別']) &&
                                 $value['區別'] === $datas['區別'] && $value['里別'] === $datas['里別']);
                
                if ($matches_area) {
                    // 計算青壯年數量
                    $young_woman_total = (isset($value['10-14歲合計數量']) ? $value['10-14歲合計數量'] : 0) + 
                                         (isset($value['15-19歲合計數量']) ? $value['15-19歲合計數量'] : 0) + 
                                         (isset($value['20-24歲合計數量']) ? $value['20-24歲合計數量'] : 0) + 
                                         (isset($value['25-29歲合計數量']) ? $value['25-29歲合計數量'] : 0) + 
                                         (isset($value['30-34歲合計數量']) ? $value['30-34歲合計數量'] : 0) + 
                                         (isset($value['35-39歲合計數量']) ? $value['35-39歲合計數量'] : 0) + 
                                         (isset($value['40-44歲合計數量']) ? $value['40-44歲合計數量'] : 0) + 
                                         (isset($value['45-49歲合計數量']) ? $value['45-49歲合計數量'] : 0) + 
                                         (isset($value['50-54歲合計數量']) ? $value['50-54歲合計數量'] : 0) + 
                                         (isset($value['55-59歲合計數量']) ? $value['55-59歲合計數量'] : 0) + 
                                         (isset($value['60-64歲合計數量']) ? $value['60-64歲合計數量'] : 0);
                    
                    $result[$n] = [
                        "區別" => $value['區別'],
                        "里別" => $value['里別'],
                        "女青壯年數量" => $young_woman_total,
                    ];
                    $n++;
                }
            }
        }
        return $result;
    } 

    public function get_young_man($datas){
        $data = $this->people_data;
        $result = [];
        $n = 0;
    
        foreach($data["Sheet1"] as $key => $value){
            if ($value['性別'] === "男"){
                // 檢查是否有特定的區別和里別條件
                $is_specific_area = isset($datas["區別"]) && isset($datas["里別"]);
                $matches_area = (!$is_specific_area) ||
                                (isset($value['區別']) && isset($value['里別']) &&
                                 $value['區別'] === $datas['區別'] && $value['里別'] === $datas['里別']);
                
                if ($matches_area) {
                    // 計算青壯年數量
                    $young_woman_total = (isset($value['10-14歲合計數量']) ? $value['10-14歲合計數量'] : 0) + 
                                         (isset($value['15-19歲合計數量']) ? $value['15-19歲合計數量'] : 0) + 
                                         (isset($value['20-24歲合計數量']) ? $value['20-24歲合計數量'] : 0) + 
                                         (isset($value['25-29歲合計數量']) ? $value['25-29歲合計數量'] : 0) + 
                                         (isset($value['30-34歲合計數量']) ? $value['30-34歲合計數量'] : 0) + 
                                         (isset($value['35-39歲合計數量']) ? $value['35-39歲合計數量'] : 0) + 
                                         (isset($value['40-44歲合計數量']) ? $value['40-44歲合計數量'] : 0) + 
                                         (isset($value['45-49歲合計數量']) ? $value['45-49歲合計數量'] : 0) + 
                                         (isset($value['50-54歲合計數量']) ? $value['50-54歲合計數量'] : 0) + 
                                         (isset($value['55-59歲合計數量']) ? $value['55-59歲合計數量'] : 0) + 
                                         (isset($value['60-64歲合計數量']) ? $value['60-64歲合計數量'] : 0);
                    
                    $result[$n] = [
                        "區別" => $value['區別'],
                        "里別" => $value['里別'],
                        "男青壯年數量" => $young_woman_total,
                    ];
                    $n++;
                }
            }
        }
        return $result;
    } 
}