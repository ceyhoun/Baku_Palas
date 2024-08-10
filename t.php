<!DOCTYPE html>
<html>
<body>

<h1>The select name attribute</h1>

<p>The name attribute specifies the name for a drop-down list:</p>

<form method="post">
<select name="subject" class="form-control">
                                            <option value="sikayet">Şikayet</option>
                                            <option value="rica">Rica</option>
                                        </select>
  <br><br>
  <input type="submit" name="carsBtn" value="Submit">
</form>
<?php 
if(isset($_POST['carsBtn'])){
	$cars=$_POST['subject'];
    echo $cars;
}

?>
</body>
</html>