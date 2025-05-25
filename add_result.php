<?php
require_once "header_dashboard.php";
require_once "session.php";
	require "admin/dbcon.php";
	require_once "functions.php";
	require_once "navbar_teacher.php";

	$user = new login_registration_class();
	
	if(isset($_REQUEST['ar'])){
		$stid = $_REQUEST['ar'];
		$name = $_REQUEST['vn'];
	}
?>	

<?php 
$pageTitle = "Student Result";
?>
<div class="all_student fix">

		<?php
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				$subject = $_POST['subject'];
				$semester = $_POST['semester'];
				$marks = $_POST['marks'];
				$result = $user->add_marks($stid,$subject,$semester,$marks);
				if($result){
					echo "<h3 style='color:green;margin:0;padding:0;text-align:center'>Marks successfully inserted!</h3>";
				}else{
					echo  "<p style='color:red;text-align:center'>Failed to insert data</p>";
				}
			}
		
		//SELECT avg(marks) as sgpa from result where st_id=10 and semester="1sr"
		?>
	<div>
	<p style="text-align:center;color:#fff;background-color: #007bff;margin:0;padding:0;"><?php echo "Name: ".$name."<br>Student ID: " . $stid; ?></p>
	</div>	
	<div style="width:40%;margin:50px auto">
		
		<table class="tab_one" style="text-align:center;">
			<form action="" method="post">
				<table>
					<tr>
						<td>Select Subject: </td>
						<td>
						<?php
// Assume you have already established a database connection

// Fetch subject titles from the subject table
$query = "SELECT subject_title FROM subject";
$result = mysqli_query($conn, $query);

// Check if query executed successfully
if ($result) {
    // Start select element
    echo '<select name="subject" id="">';

    // Loop through the results and generate options
    while ($row = mysqli_fetch_assoc($result)) {
        // Output option element for each subject title
        echo '<option value="' . $row['subject_title'] . '">' . $row['subject_title'] . ' </option>';
    }

    // Close select element
    echo '</select>';
} else {
    // Error handling if query fails
    echo "Error: " . mysqli_error($conn);
}
?>

						</td>
					</tr>
					<tr>
						<td>Select Semester: </td>
						<td>
						<select name="semester" id="" style="border-color:cornflowerblue">
							<option value="1st">1st semester</option>
							<option value="2nd">2nd semester</option>
							
						</select>
						</td>
					</tr>
					<tr>
						<td>Input marks: </td>
						<td><input type="text" name="marks" placeholder="enter marks" required style="border-color:cornflowerblue"/></td>
					</tr>
					<tr>
						<td><input type="submit" name="sub" value="Add marks" /></td>
						<td><input type="reset" /></td>
					</tr>
				</table>
				
			</form>
		</table>
		<style>
			@font-face {
    font-family: 'roboto';
    src: url('roboto-regular-webfont.woff2') format('woff2'),
         url('roboto-regular-webfont.woff') format('woff');
    font-weight: normal;
    font-style: normal;

}
.editbtn{
	background-color:#007bff;
}

		</style>
	</div>

		<div class="back fix">
				<p style="text-align:center"><a href="st_result.php"><button class="editbtn">Back to list</button></a></p>
			</div>
			
</div>
<?php include('script.php'); ?>

<?php ob_end_flush() ; ?>