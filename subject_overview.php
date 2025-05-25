<?php include('header_dashboard.php'); ?>
<?php include('session.php'); ?>
<?php $get_id = $_GET['id']; ?>
    <body>
		<?php include('navbar_teacher.php'); ?>
        <div class="container-fluid">
            <div class="row-fluid">
				<?php include('subject_overview_link.php'); ?>
                <div class="span9" id="content">
                     <div class="row-fluid">
					  <!-- breadcrumb -->
										<?php $class_query = mysqli_query($conn,"select * from teacher_class
										LEFT JOIN class ON class.class_id = teacher_class.class_id
										LEFT JOIN subject ON subject.subject_id = teacher_class.subject_id
										where teacher_class_id = '$get_id'")or die(mysqli_error($conn));
										$class_row = mysqli_fetch_array($class_query);
										?>
					     <ul class="breadcrumb">
							<li><a href="#"><?php echo $class_row['class_name']; ?></a> <span class="divider">/</span></li>
							<li><a href="#"><?php echo $class_row['subject_code']; ?></a> <span class="divider">/</span></li>
							<li><a href="#"><b>Subject Overview</b></a></li>
						</ul>
						 <!-- end breadcrumb -->
                        <!-- block -->
                        <div id="block_bg" class="block">
                            <div class="navbar navbar-inner block-header">
                                <div id="" class="muted pull-right">
									<?php $query = mysqli_query($conn,"select * from teacher_class
										LEFT JOIN class_subject_overview ON class_subject_overview.teacher_class_id = teacher_class.teacher_class_id
										where class_subject_overview.teacher_class_id = '$get_id'")or die(mysqli_error($conn));
										$row = mysqli_fetch_array($query);
										
										// Check if $row is not null and if it has the 'class_subject_overview_id' key before accessing it
										if(isset($row) && isset($row['class_subject_overview_id'])) {
											$id = $row['class_subject_overview_id'];
										} else {
											// Handle the case where $row is null or 'class_subject_overview_id' key is not set
											$id = null; // Or any other default value you prefer
										}
									
										
										$count = mysqli_num_rows($query);
									if ($count > 0){
									?>
										  <a href="edit_subject_overview.php<?php echo '?id='.$get_id; ?>&<?php echo 'subject_id='.$id; ?>" class="btn btn-info"><i class="icon-pencil"></i> Edit Subject Overview</a>
									 <?php }else{ ?>
										     <a href="add_subject_overview.php<?php echo '?id='.$get_id; ?>" class="btn btn-success"><i class="icon-plus-sign"></i> Add Subject Overview</a>
									 <?php } ?>
								</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
								<?php
// Check if $row is not null and if it has the 'content' key before accessing it
if(isset($row) && isset($row['content'])) {
    echo $row['content'];
} else {
    // Handle the case where $row is null or 'content' key is not set
    echo "Content not available"; // Or any other message you prefer
}
?>

                                </div>
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