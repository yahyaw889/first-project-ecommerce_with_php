<?php 


if (!function_exists('getTitle')) {
    function getTitle() {
        global $pageTitle;
        if (isset($pageTitle)) {
            return $pageTitle;
        } else {
            return 'default';
        }
    }
}


if (!function_exists('redirectHome')) {
    function redirectHome($theMsg, $url = null, $seconds = 3) {
        if ($url === null) {
            $url = 'dashboard.php'; 
            $link = 'Home Page';
        } elseif ($url == 'back') {
            if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== '') {
                $url = $_SERVER['HTTP_REFERER'];
                $link = 'Previous Page';
            } else {
                $url = 'dashboard.php';
                $link = 'Home Page';
            }
        }
        empty($link) ? $link = 'Home Page' : $link;

        echo "<div class='alert alert-danger' style='width: 100%;text-align: center;height: 50px;margin-top: 50px'>" . $theMsg . "</div>";
        header("refresh:$seconds;url=$url");
        exit();
    }
}


if (!function_exists('checkItem')) {
function checkItem($select, $from, $value) {
    global $conn;
    $statement = $conn->prepare("SELECT $select FROM $from WHERE $select = ?");
    $statement->execute([$value]);
    $count = $statement->rowCount();
    return $count;
}
}
if (!function_exists('itemName')) {
    function itemName($select, $from, $whereColumn, $whereValue) {
        global $conn;
        $sql = "SELECT $select FROM $from WHERE $whereColumn = :whereValue LIMIT 1";
        $state = $conn->prepare($sql);
        $state->bindParam(':whereValue', $whereValue, PDO::PARAM_INT); // Assuming $whereValue is an integer, adjust if needed
        $state->execute();
        $row = $state->fetch(PDO::FETCH_ASSOC);
        return $row[$select] ?? null; // Return the specific column value or null if not found
    }
}
if (!function_exists('countItem')) {
function countItem($item,$table){
    global $conn;
    $statment2 = $conn->prepare("SELECT COUNT($item) FROM $table");
    $statment2->execute();
    return $statment2->fetchColumn();
    
}
}

if (!function_exists('countEarning')) {
    function countEarning($item, $table) {
        global $conn;

        $statement = $conn->prepare("SELECT SUM($item) AS total_earnings FROM $table");
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        

        if ($result && isset($result['total_earnings'])) {
            return $result['total_earnings'];
        } else {
            return 0;
        }
    }
}






if (!function_exists('getLaster')) {
    function getLaster($select , $table , $order , $limit){
        global $conn;
        $statLast = $conn->prepare("SELECT $select FROM $table ORDER BY $order DESC LIMIT $limit");
        $statLast->execute();
        return $statLast->fetchAll();
    }
}


// function uploadAndSaveImage($uploadDir) {
//     global $conn;
//     if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
//         $uploadFilePath = $uploadDir . basename($_FILES['image']['name']);
        
//         if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFilePath)) {
//             $stmt = $conn->prepare("INSERT INTO images (image_name) VALUES (?)");
//             $stmt->execute([$_FILES['image']['name']]);
//             return true;
//         } else {
//             return false;
//         }
//     } else {
//         return false;
//     }
// }