<?php
include '../config/lib/db.php';


$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '12345678';
$dbname = 'aldi';


$dbt = new db($dbhost, $dbuser, $dbpass, $dbname);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>


<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
  text-align: center;
}
body {
    font-size: 12px;
}
.col-7-12 { -ms-flex: 0 0 14.285714%;     flex: 0 0 14.285714%; max-width: 14.285714%; }

</style>
</head>
<body>
<div class="container-fluid">

<?php
    $i = 0;
    $sql = "SELECT tm.id_month, m.title as month_name 
            FROM `time2023` tm 
            LEFT JOIN months m ON m.id = tm.id_month
            GROUP BY id_month";
    $rs = $dbt->query($sql);
    $months = $rs->fetchAll();
?>


<?php foreach ($months as $month) { ?>

<?php
    $sql = "SELECT * FROM `time2023` WHERE id_month='".$month['id_month']."'";
    $rs = $dbt->query($sql);
    $days = $rs->fetchAll();
?>

<div align="center" style="text-align: center"><?=$month['month_name'];?></div>

 

<div class="row mb-3">
<?php foreach ($days as $day) { ?> 

<?php
$now = date("Y-m-d");
$i++;
if($day['id_day'] == '10' || $day['id_day'] == '20' || $day['id_day'] == '30'){
    $id_day = $day['id_day'];

} else {
    $id_day = str_replace("0","",$day['id_day']);

}
?>
    <div class="col-7-12">
            <div class="card">
            <div class="card-header" style="padding-top: 6px;padding-bottom: 6px;padding-left: 12px;">
            <?=$id_day;?><span style="float: right"><?=substr($day['id_dayname'], 0, 3);?></span>
            </div>
            <?php
                if($now <= $day['id_date']){
                    $color = "#FFF";                    
                } else {
                    $color = "#ecf0f1";
                }
            ?>
            <div class="card-body" style="background: <?=$color;?>">

                    <?php
                        $i = 0;
                        $sql = "
                                SELECT f.amount, f.label, ls.color
                                FROM `fin` f 
                                LEFT JOIN lookup_status ls ON ls.id = f.id_status
                                WHERE id_date ='".$day['id_date']."'
                                ";
                        $fins = $dbt->query($sql);
                        $fins = $fins->fetchAll();
                    ?>


                    <?php foreach ($fins as $fin) { ?>
                        <a style="color: <?=$fin['color']?>" style="color=red">
                        <?=$fin['amount']?> 
                    </a>
                        <br/>
                    
                    <?php } ?>

            </div> 
            </div>   
    </div>   

   





    <?php } ?>
    </div> 
 
<?php } ?>





        </div>

</body>
</html>