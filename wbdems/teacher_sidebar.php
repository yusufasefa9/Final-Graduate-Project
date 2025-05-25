<div class="span3" id="sidebar" style="margin:1px;">
	<img id="avatar" class="img-polaroid" src="admin/<?php echo $row['location']; ?>">

	<ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">
		<li class="active"><a href="dasboard_teacher.php"><i class="icon-chevron-right"></i><i class="icon-group"></i>&nbsp;My Class</a></li>
		<li class=""><a href="notification_teacher.php"><i class="icon-chevron-right"></i><i class="icon-info-sign"></i>&nbsp;Notification</a></li>
		<li class=""><a href="add_downloadable.php"><i class="icon-chevron-right"></i><i class="icon-plus-sign"></i>&nbsp;Add Downloadables</a></li> 
		<li class=""><a href="add_announcement.php"><i class="icon-chevron-right"></i><i class="icon-plus-sign"></i>&nbsp;Add Announcement</a></li> 
		<li class=""><a href="add_assignment.php"><i class="icon-chevron-right"></i><i class="icon-plus-sign"></i>&nbsp;Add Assignment</a></li>
		<li class=""><a href="teacher_quiz.php"><i class="icon-chevron-right"></i><i class="icon-list"></i>&nbsp;Exam</a></li>
		<li class=""><a href="viewresult.php"><i class="icon-chevron-right"></i><i class="icon-list"></i>&nbsp;view result</a></li>
		
	</ul>
	<?php include('teacher_count.php'); ?>
</div>

