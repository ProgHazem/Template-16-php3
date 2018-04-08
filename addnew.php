<?php require 'header.php';?>
<?php echo'<h2 class="text-center">Add New Page</h2>';?>
<?php 
    if(isset($_POST['submit'])){
        $title = strip_tags($_POST['title']);
        $author = htmlentities($_POST['author']);
        $activestate = $_POST['active'];
        $errors = array();

        if(empty($title) || empty($author)){
            $errors = 'Please Enter This fields';
        }else{
            $localhost = 'localhost';
            $username = 'root';
            $pass='';
            $dbname = 'books';
            try{
                $conn = new PDO("mysql:host=$localhost; dbname=$dbname", $username, $pass);
                $sql = "INSERT INTO books (title, author, active) VALUES(?,?,?)";
                $stmt = $conn->prepare($sql);
                $stmt->bindPARAM(1, $title, PDO::PARAM_STR);
                $stmt->bindPARAM(2, $author, PDO::PARAM_STR);
                $stmt->bindPARAM(3, $activestate, PDO::PARAM_BOOL);
                $stmt->execute();
                echo '<div class="alert alert-success">The Book has been added</div>';
            }catch(PDOException $e) {
                echo"Not Connected : ".$e->getMessage();
            }
        }
    }

?>
<form class="form-horizontal" action="addnew.php" method="post">
    <?php 
        if(isset($errors)){
            foreach ($errors as $error){
                echo'<div class="alert alert-danger">'.$error.'</div>';
            }
        }
    ?>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Title</label>  
  <div class="col-md-4">
  <input id="textinput" name="title" type="text" placeholder="Enter Title Of Book" class="form-control input-md">
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Author</label>  
  <div class="col-md-4">
  <input id="textinput" name="author" type="text" placeholder="Enter Author Of Book" class="form-control input-md">
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="selectbasic">Select Basic</label>
  <div class="col-md-4">
    <select id="selectbasic" name="active" class="form-control">
      <option value="0">Unactive</option>
      <option value="1">Active</option>
    </select>
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-4">
    <input type="submit" name="submit" class="btn btn-primary" value="Save!">
  </div>
</div>
</form>


<?php require 'footer.php';?>    