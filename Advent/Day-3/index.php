<?php
$arr = file("input.txt");

// Part 1
$str1 = 0;
$j = 0;
$gamma = "";
$epsilon = "";
//
while($j < 12){
    for($i = 0; $i < count($arr); $i++){
        $str1 += (int)$arr[$i][$j];
    }
    if($str1 < (count($arr)/2)){
        $gamma .= "0";
    }
    else{
        $gamma .= "1";
    }
    $j++;
    $str1 = 0;
}

for($i = 0; $i < strlen($gamma); $i++){
    if($gamma[$i] == "0")
        $epsilon .= "1";
    else
        $epsilon .= "0";

}
echo "Gamma binary number: " . $gamma . " In decimal: " . bindec($gamma) ."<br>";
echo "Epsilon binary number: " . $epsilon . " In decimal: " . bindec($epsilon) . "<br>";
echo "Power consumption: " . bindec($gamma) * bindec($epsilon);

// Part 2
/*function commonBit($arr, $j):string{
    $one = 0;
    $zero = 0;
    for ($i = 0; $i < count($arr); $i++)
    {
        if ($arr[$i][$j] == "1")
        {
            $one++;
        } else {
            $zero++;
        }
    }
    if($one >= $zero){
        return "1";
    }
    else{
        return "0";
    }
}

function leastBit($arr, $j):string{
    $one = 0;
    $zero = 0;
    for ($i = 0; $i < count($arr); $i++)
    {
        if ($arr[$i][$j] == "0")
        {
            $one++;
        } else {
            $zero++;
        }
    }
    if($zero >= $one){
        return "0";
    }
    else{
        return "1";
    }
}

function oxygenGenerator($arr, $mcb, $j):array
{
    $arr2 = [];
    if ($mcb == "1") {
        for ($i = 0; $i < count($arr); $i++) {
            if ($arr[$i][$j] == "1") {
                array_push($arr2, $arr[$i]);
            }
        }
    } else {
        for ($i = 0; $i < count($arr); $i++) {
            if ($arr[$i][$j] == "0") {
                array_push($arr2, $arr[$i]);
            }
        }
    }
    return $arr2;
}

function coGenerator($arr, $lcb, $j):array
{
    $arr2 = [];
    if ($lcb == "1") {
        for ($i = 0; $i < count($arr); $i++) {
            if ($arr[$i][$j] == "1") {
                array_push($arr2, $arr[$i]);
            }
        }
    } else {
        for ($i = 0; $i < count($arr); $i++) {
            if ($arr[$i][$j] == "0") {
                array_push($arr2, $arr[$i]);
            }
        }
    }
    return $arr2;
}

$ox = "";
$co = "";
$mcb = "";
$lcb = "";
$j = 0;
// oxygen generator rating
while(count($arr) != 1){
    $mcb = commonBit($arr, $j);
    $arr = oxygenGenerator($arr, $mcb, $j);
    $j++;
}
print_r($arr);
$ox = $arr[0];
echo bindec($ox) . "<br>";

// CO2 scrubber rating
$j = 0;
$arr = file("input.txt");
while(count($arr) != 1){
    $lcb = leastBit($arr, $j);
    $arr = coGenerator($arr, $lcb, $j);
    $j++;
}
print_r($arr);
$co = $arr[0];
echo bindec($co);

// Life support rating
$total = bindec($ox) * bindec($co);
echo "<br>" . $total;*/







