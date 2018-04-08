<?php require 'header.php';?>
<?php echo'<h2 class="text-center">Dashboard Page</h2>';?>
<table class="table table-striped">
<?php $localhost = 'localhost';
            $username = 'root';
            $pass='';
            $dbname = 'books';
            try{
                error_reporting("E_ALL & ~E_NOTIC");
                $conn = new PDO("mysql:host=$localhost; dbname=$dbname", $username, $pass);
                if($_GET['box'] == 'active'){
                    $id = intval($_GET['id']);
                    $sql = "UPDATE books SET active=1 WHERE ID=:id";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindPARAM(':id', $id, PDO::PARAM_INT);
                    $stmt->execute();
                    header("Location: dashbord.php");
                }elseif($_GET['box'] == 'unactive'){
                    $id = intval($_GET['id']);
                    $sql = "UPDATE books SET active=0 WHERE ID=:id";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindPARAM(':id', $id, PDO::PARAM_INT);
                    $stmt->execute();
                    header("Location: dashbord.php");
                }elseif($_GET['box'] == 'edit'){
                    $id = intval($_GET['id']);
                    $sql = "SELECT * FROM books WHERE ID=$id";
                    $stmt = $conn->query($sql);
                    $row = $stmt->fetch(PDO::FETCH_OBJ);
                    if(isset($_POST['edit'])){
                        $title = strip_tags($_POST['title']);
                        $author = strip_tags($_POST['author']);
                        $sql_UP = "UPDATE books SET TITLE=:title, AUTHOR=:author WHERE ID='$id'";
                        $upstmt = $conn->prepare($sql_UP);
                        $upstmt->bindPARAM(':title', $title, PDO::PARAM_STR);
                        $upstmt->bindPARAM(':author', $author, PDO::PARAM_STR);
                        $upstmt->execute();
                        echo '<div class="alert alert-success">The Book has been added</div>';
                        header("Location: dashbord.php");
                            }
                    ?>
                    <br/><br/>
                    <form class="form-horizontal" action="" method="post">

                    <!-- Text input-->
                        <div class="control-group">
                            <div class="col-md-5">
                                <input id="textinput" name="title" type="text" class="form-control input-md" value="<?php echo $row->TITLE;?>">
                            </div>
                        </div>
                    <!-- Text input-->
                        <div class="control-group">
                            <div class="col-md-5">
                                <input id="textinput" name="author" type="text" class="form-control input-md" value="<?php echo $row->AUTHOR;?>">
                            </div>
                        </div>
                    
                    <!-- Button -->
                        <div class="control-group">
                            <div class="col-md-2">
                                <input type="submit" name="edit" class="btn btn-primary" value="Edit">
                            </div>
                        </div>
                    </form>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <?php
                }elseif($_GET['box'] == 'delete'){
                    $id = intval($_GET['id']);
                    $sql = "DELETE FROM books WHERE ID=$id";
                    $stmt = $conn->query($sql);
                    header("Location: dashbord.php");
                }else{
                echo "<tr> <th>ID</th> <th>TITLE</th> <th>AUTHOR</th> <th>ACTIVE STATUS</th> <th>Edit || DELETE</th> </tr>
                ";
                $sql = "SELECT * FROM books ORDER BY ID";
                $stmt = $conn->query($sql);
                $count = $stmt->rowCount();
                if($count){
                    while($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                        if($row->ACTIVE == 0){
                            echo"<tr><td>{$row->ID}</td><td>{$row->TITLE}</td><td>{$row->AUTHOR}</td><td><a href='dashbord.php?box=active&id={$row->ID}'>Active</a></td><td><a href='dashbord.php?box=edit&id={$row->ID}'>Edit</a> || <a href='dashbord.php?box=delete&id={$row->ID}'>Delete</a></td></tr>";
                        }elseif($row->ACTIVE == 1){
                            echo"<tr><td>{$row->ID}</td><td>{$row->TITLE}</td><td>{$row->AUTHOR}</td><td><a href='dashbord.php?box=unactive&id={$row->ID}'>UnActive</a></td><td><a href='dashbord.php?box=edit&id={$row->ID}'>Edit</a> || <a href='dashbord.php?box=delete&id={$row->ID}'>Delete</a></td></tr>";
                        }else{

                        }
                    }
                }
            }
            }catch(PDOException $e) {
                echo"Not Connected : ".$e->getMessage();
            }
            ?>
<?php require 'footer.php';?>    