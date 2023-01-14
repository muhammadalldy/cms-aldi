<?php
include 'db.php';
include 'dbconfig.php';


$db = new db($dbhost, $dbuser, $dbpass, $dbname);
$dbf = new db($dbhost, $dbuser, $dbpass, $dbname);
$con = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);

$sql = "SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));";
$db->query($sql);

function dd_menu($tblName, $value, $label, $filter,$sort, $selected)
{
    global $dbf;
    $orderBy = " ORDER BY ".$label." ".$sort;
    $sqldd_menu = "SELECT ".$value.",".$label." FROM ".$tblName." ".$filter." ".$orderBy;
    
    $result = $dbf->query($sqldd_menu);
    
    echo "<option value=\"\">-- Please Choose --</option>";
    if ($result->numRows() > 0) {
        $rows_all = $result->fetchAll();
        foreach ($rows_all as $rows) {
            $strselect="";
            if ($rows[$value] == $selected) {
                $strselect="selected";
                echo "<option ".$strselect." value='".$rows[$value]."'>".$rows[$label]."</option>";
            } else {
                echo "<option value='".$rows[$value]."'>".$rows[$label]."</option>";
            }
        }
    }
}	
 

function getValue($tablename, $target_label, $source_label, $source_value){
    global $db;
    $sql = "SELECT $target_label FROM $tablename WHERE $source_label = '".addslashes($source_value)."'";
    $data = $db->query($sql)->fetchArray();
    return $data[$target_label];
}

function run_num($column_name, $tblname) { // column_name, table_name
    
    global $dbf;
    
    $run_start = "001";
    
    $sql_slct_max = "SELECT MAX($column_name) AS run_id FROM $tblname";
    $sql_slct = $dbf;
    $rs = $sql_slct->query($sql_slct_max);
    $alldata = $rs->fetchArray();

    if($alldata==NULL) {
        $run_id = date("Ymd").$run_start;
    } else {
        
        $todate = date("Ymd");
            
        if($todate > substr($alldata["run_id"],0,8)) {
            $run_id = $todate.$run_start;
        } else {
            $run_id = $alldata["run_id"] + 1; 
        }
    }

    return $run_id;
}
