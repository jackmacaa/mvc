<?php
// PART 1
$arr = file("input.txt");
//$arr = explode("\n", $str2);

$count = 0;
//print_r($arr);
for($i = 0; $i < count($arr); $i++){
    if(isset($arr[$i + 1])){
        if($arr[$i + 1]  > $arr[$i]) {
            $count++;
        }
    }
}
echo "part 1" . "<br>";
echo $count . "<br>";

// PART 2
$count = 0;
$arr2 = [];
//echo count($arr);
//print_r($arr);
for($i = 0; $i < count($arr); $i++){
    if(isset($arr[$i + 2])){
        $arr2[] = $arr[$i] + $arr[$i + 1] + $arr[$i + 2];
    }
}

for($i = 0; $i < count($arr); $i++) {
    if(isset($arr2[$i + 1])){
        if ($arr2[$i + 1] > $arr2[$i]) {
            $count++;
        }
    }
}
//echo count($arr2);
echo "<br>" . "part 2" . "<br>";
echo $count;