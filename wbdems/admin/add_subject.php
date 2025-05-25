<?php include('header.php'); ?>
<?php include('session.php'); ?>
    <body>
		<?php include('navbar.php'); ?>
        <div class="container-fluid">
            <div class="row-fluid">
			<?php include('sidebar_dashboard.php'); ?>
		
						<div class="span9" id="content">
		                    <div class="row-fluid">
							
		                        <!-- block -->
		                        <div class="block">
		                            <div class="navbar navbar-inner block-header">
		                                <div class="muted pull-left">Add Subject</div>
		                            </div>
		                            <div class="block-content collapse in">
									<a href="subjects.php"><i class="icon-arrow-left"></i> Back</a>
									    <form class="form-horizontal" method="post">
										<div class="control-group">
											<label class="control-label" for="inputEmail">Subject Code</label>
											<div class="controls">
											<input type="text" name="subject_code" id="inputEmail" placeholder="Subject Code" style="border-color:cornflowerblue">
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="inputPassword">Subject Title</label>
											<div class="controls">
											<input type="text" class="span8" name="title" id="inputPassword" placeholder="Subject Title" required style="border-color:cornflowerblue"> 
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="inputPassword">Number of Units</label>
											<div class="controls">
											<input type="text" class="span1" name="unit" id="inputPassword" required style="border-color:cornflowerblue">
											</div>
										</div>
											<div class="control-group">
											<label class="control-label" for="inputPassword">Semester</label>
											<div class="controls">
												<select name="semester">
													<option></option>
													<option>1st</option>
													<option>2nd</option>
												</select>
											</div>
										</div>
										<div class="control-group">
    <label class="control-label" for="inputprice">Add price</label>
    <div class="controls">
        <input type="text" name="price" id="inputprice" placeholder="Subject price" style="border-color:cornflowerblue">
    </div>
</div>

								
										<div class="control-group">
											<label class="control-label" for="inputPassword">Description</label>
											<div class="controls">
													<textarea name="description" id="ckeditor_full"></textarea>
											</div>
										</div>
												
																		
											
										<div class="control-group">
										<div class="controls">
										
										<button name="save" type="submit" class="btn btn-info"><i class="icon-save"></i> Save</button>
										</div>
										</div>
										</form>
										
										<?php
										if (isset($_POST['save'])){
											// Retrieve other form fields
											$subject_code = $_POST['subject_code'];
											$title = $_POST['title'];
											$unit = $_POST['unit'];
											$description = $_POST['description'];
											$semester = $_POST['semester'];
											
											// Retrieve the new form field
											$price = $_POST['price'];
											
											// Check if subject_code already exists
											$query = mysqli_query($conn, "SELECT * FROM subject WHERE subject_code = '$subject_code'") or die(mysqli_error($conn));
											$count = mysqli_num_rows($query);
										
											if ($count > 0) { 
												?>
												<script>
													alert('Data Already Exist');
												</script>
												<?php
											} else {
												// Insert data into subject table
												mysqli_query($conn, "INSERT INTO subject (subject_code, subject_title, description, unit, semester, price) VALUES ('$subject_code', '$title', '$description', '$unit', '$semester', '$price')") or die(mysqli_error($conn));
										
												// Log the activity
												mysqli_query($conn, "INSERT INTO activity_log (date, username, action) VALUES (NOW(), '$user_username', 'Add Subject $subject_code')") or die(mysqli_error($conn));
										
												?>
												<script>
													window.location = "subjects.php";
												</script>
												<?php
											}
										}
										
										
										?>
									
								
		                            </div>
		                        </div>
		                        <!-- /block -->
		                    </div>
		                </div>
            </div>
		<?php include('footer.php'); ?>
        </div>
		<?php include('script.php'); ?>
    </body>

</html>