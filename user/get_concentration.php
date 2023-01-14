<?php
include('../config/lib/common.php');

$id = $_POST["id"];

$sql = "SELECT * FROM lookup_concentration WHERE program_code='$id'";
$result = $db->query($sql);
 

$rows_all = $result->fetchAll();


?>
<option value="">Select</option>


<?php
foreach ($rows_all as $location) {
    ?>
    <option value="<?php echo $location["id"]; ?>"><?php echo $location["title_en"]; ?></option>
    <?php
}

?>