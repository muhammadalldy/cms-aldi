
<?php
include('../config/lib/common.php');

$id = $_POST["id"];

$sql = "SELECT * FROM dikti_district WHERE id_induk_wilayah='$id'";
$result = $db->query($sql);
 

$rows_all = $result->fetchAll();


?>
<option value="">Select</option>


<?php
foreach ($rows_all as $location) {
    ?>
    <option value="<?php echo $location["id_wil"]; ?>"><?php echo $location["title"]; ?></option>
    <?php
}

?>