<?php
// Takes the boards.txt and turns it into a 3D array with Arr1 = board num, Arr2 = row num
function setupBoards($boards2):array
{
    $newBoards = [];
    for($i = 0; $i < count($boards2[0]); $i++)
    {
        $newBoards[$i] = $boards2[0][$i];
    }

    $newBoards = array_chunk(($newBoards), 5);
    return array_chunk(($newBoards), 5);
}

// Searching through each entry and checks if it's the next number called then sets to X if so
function markBoard($setBoard, $num):array
{
    for($i = 0; $i < count($setBoard); $i++) {
        if ($setBoard[$i] != null) {
            for ($j = 0; $j < count($setBoard[$i]); $j++) {
                for ($k = 0; $k < count($setBoard[$i]); $k++) {
                    if ($setBoard[$i][$j][$k] == $num) {
                        $setBoard[$i][$j][$k] = "X";
                    }
                }
            }
        }
    }
    return $setBoard;
}

function checkWin($setBoard): array
{
    global $boardsWon;
    //var_dump($setBoard);
    for($i = 0; $i < count($setBoard); $i++)
    {
        // WIN CONDITIONS ROWS
        // Win condition 1st row
        if($setBoard[$i] != null) {
            if ($setBoard[$i][0][0] == "X" &&
                $setBoard[$i][0][1] == "X" &&
                $setBoard[$i][0][2] == "X" &&
                $setBoard[$i][0][3] == "X" &&
                $setBoard[$i][0][4] == "X")
            {
                $setBoard[$i] = null;
                $boardsWon++;
            }
        }
            // Win condition 2nd row
        if($setBoard[$i] != null) {
            if ($setBoard[$i][1][0] == "X" &&
                $setBoard[$i][1][1] == "X" &&
                $setBoard[$i][1][2] == "X" &&
                $setBoard[$i][1][3] == "X" &&
                $setBoard[$i][1][4] == "X") {

                $setBoard[$i] = null;
                $boardsWon++;
            }
        }
            // Win condition 3rd row
        if($setBoard[$i] != null) {
            if ($setBoard[$i][2][0] == "X" &&
                $setBoard[$i][2][1] == "X" &&
                $setBoard[$i][2][2] == "X" &&
                $setBoard[$i][2][3] == "X" &&
                $setBoard[$i][2][4] == "X")
            {
                $setBoard[$i] = null;
                $boardsWon++;
            }
        }
            // Win condition 4th row
        if($setBoard[$i] != null) {
            if ($setBoard[$i][3][0] == "X" &&
                $setBoard[$i][3][1] == "X" &&
                $setBoard[$i][3][2] == "X" &&
                $setBoard[$i][3][3] == "X" &&
                $setBoard[$i][3][4] == "X")
            {
                $setBoard[$i] = null;
                $boardsWon++;
            }
        }
            // Win condition 5th row
        if($setBoard[$i] != null) {
            if ($setBoard[$i][4][0] == "X" &&
                $setBoard[$i][4][1] == "X" &&
                $setBoard[$i][4][2] == "X" &&
                $setBoard[$i][4][3] == "X" &&
                $setBoard[$i][4][4] == "X")
            {
                $setBoard[$i] = null;
                $boardsWon++;
            }
        }
            //WIN CONDITIONS COLUMNS
            // Win condition 1st column
        if($setBoard[$i] != null) {
            if ($setBoard[$i][0][0] == "X" &&
                $setBoard[$i][1][0] == "X" &&
                $setBoard[$i][2][0] == "X" &&
                $setBoard[$i][3][0] == "X" &&
                $setBoard[$i][4][0] == "X")
            {
                $setBoard[$i] = null;
                $boardsWon++;
            }
        }
            // Win condition 2nd column
        if($setBoard[$i] != null) {
            if ($setBoard[$i][0][1] == "X" &&
                $setBoard[$i][1][1] == "X" &&
                $setBoard[$i][2][1] == "X" &&
                $setBoard[$i][3][1] == "X" &&
                $setBoard[$i][4][1] == "X")
            {
                $setBoard[$i] = null;
                $boardsWon++;
            }
        }
            // Win condition 3rd column
        if($setBoard[$i] != null) {
            if ($setBoard[$i][0][2] == "X" &&
                $setBoard[$i][1][2] == "X" &&
                $setBoard[$i][2][2] == "X" &&
                $setBoard[$i][3][2] == "X" &&
                $setBoard[$i][4][2] == "X")
            {
                $setBoard[$i] = null;
                $boardsWon++;
            }
        }
            // Win condition 4th column
        if($setBoard[$i] != null) {
            if ($setBoard[$i][0][3] == "X" &&
                $setBoard[$i][1][3] == "X" &&
                $setBoard[$i][2][3] == "X" &&
                $setBoard[$i][3][3] == "X" &&
                $setBoard[$i][4][3] == "X")
            {
                $setBoard[$i] = null;
                $boardsWon++;
            }
        }
            // Win condition 5th column
        if($setBoard[$i] != null) {
            if ($setBoard[$i][0][4] == "X" &&
                $setBoard[$i][1][4] == "X" &&
                $setBoard[$i][2][4] == "X" &&
                $setBoard[$i][3][4] == "X" &&
                $setBoard[$i][4][4] == "X")
            {
                $setBoard[$i] = null;
                $boardsWon++;
            }
        }
    }
    return $setBoard;
}

$boards = file("boards.txt");
$boards = implode(" ", $boards);
$boards2 = [];
$input = file("draw.txt");
$input = implode(" ", $input);
$input = explode(",", $input);
$answer = 0;
$winningNum = 0;
$boardsWon = 0;

preg_match_all('!\d+!', $boards, $boards2);

$setBoards = setupBoards($boards2);
$didWin = checkWin($setBoards);

$boardsCount = count($setBoards) - 1;

for ($i = 0; $i < count($input); $i++)
{
    if ($boardsWon < $boardsCount)
    {
        $setBoards = markBoard($setBoards, $input[$i]);
        $setBoards = checkWin($setBoards);
        echo $boardsWon . "<br>";

    }
    else
    {
        $winningNum = $input[$i];
        $i = count($input);
    }
}

echo $winningNum;
echo "<pre>";
print_r($setBoards);
echo "</pre>";

/*for($j = 0; $j < count($setBoards[1]); $j++) {
    for ($k = 0; $k < count($setBoards[1]); $k++) {
        $answer += (int)$setBoards[1][$j][$k];
    }
}
$answer = $answer - $winningNum;*/

echo "Bingo board number : " . /* $didWin .*/ "<br>" . "Left over values add up to: ". "<br>";
echo "Answer: " . $winningNum;

