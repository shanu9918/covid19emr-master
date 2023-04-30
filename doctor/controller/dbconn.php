<?php
/*$username = "root";
$password = "mysql";
$servername = "localhost";
$dbconn=mysqli_connect("localhost","root","mysql","afh");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }*/ 

 
ini_set("display_errors", "Off");
/* ============================================================= */
/* ==============Connects to the DB============================= */

function db_connect() {
    $dbhost = 'localhost';
    $dbusername = 'root';
    $database = 'emr';
    $dbuserpassword = '';
//    $dbhost = 'bm5yzmft28ph1gw4zio2-mysql.services.clever-cloud.com';
//    $dbusername = 'ub0kopxjm61lm4z1';
//    $database = 'bm5yzmft28ph1gw4zio2';
//    $dbuserpassword = 'ub0kopxjm61lm4z1';

    $connection = mysqli_connect($dbhost, $dbusername, $dbuserpassword, $database);
//  mysql_select_db($database) or die( "Unable to select database");    

    return $connection;
}

/* _-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- */

/* ============================================================= */
/* ===Performs an SQL query and returns the result in an array== */

function return_array($query) {
    $connection = db_connect();
    $exec = mysqli_query($connection, $query);
    $querydata = array();
    while ($data = mysqli_fetch_array($exec))
        $querydata[] = $data;

    echo mysqli_error($connection);
    return $querydata;
}

/* =======Performs an SQL query with a query as an argument===== */

function gosql($query) {
    $connection = db_connect();
    $exec = mysqli_query($connection, $query);
    return $exec;
}

function gosql1($query) {
    $connection = db_connect();
    $exec = mysqli_query($connection, $query);
    $id = mysqli_insert_id($connection);
    return $id;
}

function insert($query, $id) {
    $connection = db_connect();
    $table = array_shift($query);
    $cols = mysqli_query($connection, "SHOW COLUMNS from $table");
    $message = array();
    while ($row = mysqli_fetch_assoc($cols)) {
//        if ($row['Null'] == "NO") {
        if ($row['Null'] == "NO") {
            if ($row['Default'] == '') {
                if ($row['Extra'] == '') {
                    if ($query[$row['Field']] == '') {
                        $message['response'] = 'fail';
                        $message[$row['Field']] = "Please enter the " . $row['Field'];
                    }
                }
            }
        }
//        }
    }
    if ($message) {
        echo "<pre>";
        print_r($message);
        exit;
        return $message;
    } else {
        if ($id) {
            $cnt = count($query);
            $sql = "update $table set ";
            $i = 1;
            foreach ($query as $key => $value) {
                if ($cnt == $i) {
                    $sql .= $key . "='" . $value . "' ";
                } else {
                    $sql .= $key . "='" . $value . "', ";
                }
                $i++;
            }
            $sql .= " where id=$id";
//            echo $sql;exit;
            $exec = mysqli_query($connection, $sql);
            $message['response'] = "Save Successfully";
            $message['id'] = "$id";
            return $message;
        } else {
            $keys = implode(",", array_keys($query));
            $values = "'" . implode("','", $query) . "'";
            $sql = "insert into $table($keys) values($values)";
            $exec = mysqli_query($connection, $sql);
            $id = mysqli_insert_id($connection);
            $message['response'] = "Save Successfully";
            $message['id'] = "$id";
            return $message;
        }
    }
}

/* _-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- */

/* ============================================================= */
/* ===Performs an SQL query and returns the result in an array== */

function return_single($query) {
    $connection = db_connect();
    $exec = mysqli_query($connection, $query);
    while ($data = mysqli_fetch_assoc($exec)) {
        $querydata[] = $data;
    }
    return $querydata[0];
}

/* ============================================================= */
/* ===Performs an SQL query and returns the result in an array== */

function return_record($query) {
    $connection = db_connect();
    $exec = mysqli_query($connection, $query);
    while ($data = mysqli_fetch_array($exec))
        $querydata = $data;

    echo mysql_error($connection);
    return $querydata;
}

/* ============================================================= */

function filter_field($field) {
    $connection = db_connect();
    // Stripslashes 
    if (get_magic_quotes_gpc())
        $field = stripslashes($field);

    $field = mysqli_real_escape_string($connection, htmlspecialchars($field));

    return $field;
}

function slug($tablename, $id, $string, $replace = array(), $delimiter = '-') {
    $connection = db_connect();
    $oldLocale = setlocale(LC_ALL, '0');
    setlocale(LC_ALL, 'en_US.UTF-8');
    $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $string);
    if (!empty($replace)) {
        $clean = str_replace((array) $replace, ' ', $clean);
    }
    $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
    $clean = strtolower($clean);
    $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
    $clean = trim($clean, $delimiter);
    setlocale(LC_ALL, $oldLocale);


    $slugs = "SELECT slug FROM $tablename WHERE slug = '" . $clean . "' AND id !=$id";
    $obj = return_array($slugs);

    if ($obj) {
        $clean = $clean;
//        $clean = $clean . '-' . $id;
    } else {
        $clean = $clean;
    }
    $slugsupdate = "UPDATE $tablename SET slug = '" . $clean . "' WHERE id =" . $id;
    mysqli_query($connection, $slugsupdate);
    return $clean;
}

?>
