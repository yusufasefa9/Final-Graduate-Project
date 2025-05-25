<?php
session_start();
	require "admin/dbcon.php";
	require_once "functions.php";
	$user = new login_registration_class();
	
	if(isset($_REQUEST['ar'])){
		$stid = $_REQUEST['ar'];
		$name = $_REQUEST['vn'];
		$semester = $_REQUEST['seme'];
	}
?>	
<?php 
$pageTitle = "update Student Result";

?>
<div class="all_student fix">
		<div>
		<p style="text-align:center;color:#fff;background:#007bff;margin:0;padding:8px;"><?php echo "Name: ".$name."<br>ID: ".$stid."<br>Semester: " . $semester; ?></p>
		</div>
			<?php
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				$subject = $_POST['umark'];
				$res = $user->update_result($stid,$subject,$semester);
				//var_dump($res);
				if($res){
					echo "<h3 style='color:green;margin:0;padding:0;text-align:center'>Marks successfully updated!</h3>";
				}else{
					echo  "<p style='color:red;text-align:center'>Failed to update data</p>";
				}
			}
		
	
		?>

		
		<form action="" method="post">
		<table class="tab_one" style="text-align:center;">
			<tr>
				<th style="text-align:center;">Subject</th>
				<th style="text-align:center;">Marks</th>
				
			</tr>
			<?php 
			$i=0;
			
				$get_result = $user->show_marks($stid,$semester);
				
				while($rows = $get_result->fetch_assoc()){
				$i++;
		?><link rel="stylesheet" href="css/normalize.css">
		<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="fonts/stylesheet.css">
		<link rel="stylesheet" href="css/main.css">
		<link rel="stylesheet" href="plugins/file-uploader/css/jquery.fileupload.css">
		<link rel="stylesheet" href="plugins/file-uploader/css/jquery.fileupload-ui.css">
		<script src="js/vendor/jquery-1.12.0.min.js"></script>
		<script src="js/vendor/modernizr-2.8.3.min.js"></script>
			<tr>
				<td><?php echo $rows['sub'];?></td>
				<td><input type="text" name="umark[<?php echo $rows['sub'];?>]" value="<?php echo $rows['marks'];?>"/></td>
				
			</tr>
			<?php } ?>
			<tr><td colspan="2"><input type="submit" value="Update Result" /></td></tr>
		</table>
	</form>
		<div class="back fix">
				<p style="text-align:center"><a href="view_result.php?vr=<?php echo $stid?>&vn=<?php echo $name?>"><button class="editbtn">go to result page</button></a></p>
			</div>
</div>

<?php ob_end_flush() ; ?>