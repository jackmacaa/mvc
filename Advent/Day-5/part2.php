<?php
//error_reporting(E_ALL &~ E_NOTICE &~ E_WARNING);
function handleInput(): array
{
    $input = file("input.txt");
    $input2 = array();
    $input3 = array(array());

    for($i = 0; $i < count($input); $i++)
    {
        $j = 0;
        $input2[$i] = explode("->", $input[$i]);
        $x = explode(",",$input2[$i][$j]);
        $y = explode(",",$input2[$i][$j+1]);
        $input3[$i][$j] = $x;
        $input3[$i][$j+1] = $y;
    }
    return $input3;
}

function createFloor($input): array
{
    $oceanFloor = array(array());

    for($i = 0; $i < 1000; $i++)
    {
        for($j = 0; $j < 1000; $j++)
        {
            $oceanFloor[$i][$j] = 0;
        }
    }
    return $oceanFloor;
}

$setInput = handleInput();
$setOceanFloor = createFloor($setInput);

/*echo "<pre>";
print_r($setOceanFloor);
echo "</pre>";
*/

/*echo "<pre>";
print_r($setInput);
echo "</pre>";*/

function markFloorStraight($oceanFloor, $input)
{
    $markedOceanFloor = $oceanFloor;
    //echo count($input); exit;
   for($i = 0; $i < count($input); $i++)
   {
        $x1 = $input[$i][0][0];
        $y1 = $input[$i][0][1];
        $x2 = $input[$i][1][0];
        $y2 = $input[$i][1][1];
       // from 0,9 and 5,9
       // need to generate 1,9 2,9 3,9 4,9
       if($y1 == $y2)
       {
           while($x1 <= $x2)
           {
               $markedOceanFloor[intval($x1)][intval($y1)] += 1;
               $x1++;
           }
           $x1 = $input[$i][0][0];

           while($x2 <= $x1)
           {
               $markedOceanFloor[intval($x2)][intval($y1)] += 1;
               $x2++;
           }
           $x2 = $input[$i][1][0];
       }
       // from 0,5 and 0,9
       // need to generate 0,6 0,7 0,8
       if($x1 == $x2)
       {
           while($y1 <= $y2)
           {
               $markedOceanFloor[intval($x1)][intval($y1)] += 1;
               $y1++;
           }
           $y1 = $input[$i][0][1];

           while($y2 <= $y1)
           {
               $markedOceanFloor[intval($x1)][intval($y2)] += 1;
               $y2++;
           }
           $y2 = $input[$i][1][1];
       }
   }
    return $markedOceanFloor;
}


function markFloorDiagonal($oceanFloor, $input)
{
    $markedOceanFloor = $oceanFloor;
    //echo count($input); exit;
    for($i = 0; $i < count($input); $i++)
    {
        $x1 = $input[$i][0][0];
        $y1 = $input[$i][0][1];

        $x2 = $input[$i][1][0];
        $y2 = $input[$i][1][1];

        // 1,1 -> 3,3 = 1,1 2,2 3,3
        if ($x1 == $y1 && $x2 == $y2) {
            while ($x1 <= $x2) {
                $markedOceanFloor[intval($x1)][intval($y1)] += 1;
                $x1++;
                $y1++;
            }
            $x1 = $input[$i][0][0];
            $y1 = $input[$i][0][1];
            // 3,3 -> 1,1
            while ($x2 <= $x1) {
                $markedOceanFloor[intval($x1)][intval($y1)] += 1;
                $x1--;
                $y1--;
            }
            $x1 = $input[$i][0][0];
            $y1 = $input[$i][0][1];
        }
        // 9,7 -> 7,9 = 9,7 8,8 7,9
        if (($x1 - $x2) == ($y2 - $y1))
        {
            while ($x1 >= $x2)
            {
                $markedOceanFloor[intval($x1)][intval($y1)] += 1;
                $x1--;
                $y1++;
            }
            $x1 = $input[$i][0][0];
            $y1 = $input[$i][0][1];

        }
        // 6,4 -> 2,0
        if(($x1 - $x2) == ($y1 - $y2))
        {
            while($x1 >= $x2)
            {
                $markedOceanFloor[intval($x1)][intval($y1)] += 1;
                $x1--;
                $y1--;
            }
            $x1 = $input[$i][0][0];
            $y1 = $input[$i][0][1];
        }
        // 5,5 -> 8,2
        // 3,3 -> 6,0
        if(($x2 - $x1) == ($y1 - $y2))
        {
            while($x2 >= $x1)
            {
                $markedOceanFloor[intval($x1)][intval($y1)] += 1;
                $x1++;
                $y1--;
            }
            $x1 = $input[$i][0][0];
            $y1 = $input[$i][0][1];
        }
    }
    return $markedOceanFloor;
}

$markedOceanFloor = markFloorStraight($setOceanFloor, $setInput);
$markedOceanFloor = markFloorDiagonal($markedOceanFloor, $setInput);

/*echo "<pre>";
print_r($markedOceanFloor);
echo "</pre>";*/

$total = 0;

for($i = 0; $i < count($markedOceanFloor); $i++)
{
    for($j = 0; $j < count($markedOceanFloor); $j++)
    {
        if($markedOceanFloor[$i][$j] > 1)
        $total++;
    }
}
echo "The total number of line crossing more than once is: " . $total;


