<?php
 $connect = new mysqli("localhost","herbiand_azdas","_+_O~%k]c03A","herbiand_azdas");
?>
<style>
.col{
border:1px solid black;
width:100px;
display:inline-block;
}
.a{
background-color:red;
}
.b{
background-color:green;
}
</style>
<form method="post">
    <input type="date" name="date1">
    <input type="date" name="date2">
    <input type="submit" name="submit">
</form>
<div style="border:1px solid black;">
<div class='col'>B.e</div>
<div class='col'>C.A</div>
<div class='col'>Cer</div>
<div class='col'>C.A</div>
<div class='col'>Cume</div>
<div class='col'>Senbe</div>
<div class='col'>Bazar</div><br>
<?php
if(isset($_POST['submit'])){
$date1=strtotime($_POST['date1']); //
$date2=strtotime($_POST['date2']);
$d1=intval(date('d', $date1));
$d2=intval(date('d', $date2));

$timestamp = strtotime('2024-06-11');
$day = date('w', $timestamp);
$say=0;
for($i=1;$i<=31;$i++){
   
if($i<$day){
echo "<div class='col'> &nbsp; </div >";
}
else{
$say++;
if($say>=$d1 && $say<=$d2){
$ay=date("m",$date1);
$bu=strtotime("2024-".$ay."-".$say);
$bu=date("Y-m-d",$bu);
$sql=mysqli_query($connect,'select * from rezerv where date="'.$bu.'"');
$say2=mysqli_num_rows($sql);
if($say2>0){
echo "<div class='col a'>".$say."</div >";
   
}
else{
    echo "<div class='col b'>".$say."</div >";

}






}
else{
echo "<div class='col'>".$say."</div >";

}



}

if($i%7==0){
echo "<br>";
}
}
}

?>

</div>