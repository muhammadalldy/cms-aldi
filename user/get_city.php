<?php
include('../config/lib/common.php');

$id = $_POST["id"];

$sql = "SELECT * FROM dikti_city WHERE id_parent='$id'";
$result = $db->query($sql);
 

$rows_all = $result->fetchAll();


?>
<option value="">Select</option>


<?php
foreach ($rows_all as $location) {
    ?>
    <option value="<?php echo $location["id_wil"]; ?>"><?php echo $location["nm_wil"]; ?></option>
    <?php
}

?>