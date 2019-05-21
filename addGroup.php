
<?PHP
require_once 'config.php';

$name = $_POST['name'];
$description =$_POST['description'];
$profilepicture =$_POST['profilepicture'];
$privacy =$_POST['privacy'];

if ($db->connect_error) {
    die("Conection failed: " . $db->connect_error);
}

echo "test";
 
$sql = "INSERT INTO Group_ (name,description,profilepicture,privacy) VALUES('$name','$description','$profilepicture','$privacy');";
if ($db->query($sql) === TRUE) {
    echo "Added successfully";
} else {
    echo "Error while adding a group: " . $db->error;
}

?>
