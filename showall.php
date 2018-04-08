<?php require 'header.php';?>
<?php echo'<h2 class="text-center">Show All Page</h2>';?>
<table class="table table-striped">
<tr> <th>ID</th> <th>TITLE</th> <th>AUTHOR</th> <th>ACTIVE STATUS</th> </tr>
<?php $localhost = 'localhost';
            $username = 'root';
            $pass='';
            $dbname = 'books';
            try{
                $conn = new PDO("mysql:host=$localhost; dbname=$dbname", $username, $pass);
                $sql = "SELECT * FROM books";
                $stmt = $conn->query($sql);
                while($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                    echo"<tr><td>{$row->ID}</td><td>{$row->TITLE}</td><td>{$row->AUTHOR}</td><td>{$row->ACTIVE}</td></tr>";
                }
            }catch(PDOException $e) {
                echo"Not Connected : ".$e->getMessage();
            }
            ?>
</table>
<?php require 'footer.php';?>    