<div class="span3" id="sidebar">
					<img id="avatar" class="img-polaroid" src="admin/<?php echo $row['location']; ?>">
					<?php include('count.php'); ?>
		<ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">
			<li class="active"><a href="dashboard_student.php"><i class="icon-chevron-right"></i><i class="icon-group"></i>&nbsp;My Class</a></li>
			<li class=""><a href="student_notification.php"><i class="icon-chevron-right"></i><i class="icon-info-sign"></i>&nbsp;Notification</a></li>
				<li class=""><a href="my_classmates.php<?php echo '?id='.$get_id; ?>"><i class="icon-chevron-right"></i><i class="icon-group"></i>&nbsp;My Classmates</a></li>
				<li class=""><a href="downloadable_student.php<?php echo '?id='.$get_id; ?>"><i class="icon-chevron-right"></i><i class="icon-download"></i>&nbsp;Downloadable Materials</a></li>
				<li class=""><a href="assignment_student.php<?php echo '?id='.$get_id; ?>"><i class="icon-chevron-right"></i><i class="icon-book"></i>&nbsp;Assignments</a></li>
				<li class=""><a href="announcements_student.php<?php echo '?id='.$get_id; ?>"><i class="icon-chevron-right"></i><i class="icon-info-sign"></i>&nbsp;Announcements</a></li>
				<li class=""><a href="student_quiz_list.php<?php echo '?id='.$get_id; ?>"><i class="icon-chevron-right"></i><i class="icon-reorder"></i>&nbsp;Exam</a></li>
				<li class=""><a href="view.php"><i class="icon-chevron-right"></i><i class="icon-suitcase"></i>&nbsp;View Result</a></li>
				<li class=""><a href="price.php"><i class="icon-chevron-right"></i><i class="icon-credit-card"></i>&nbsp;	View Price</a></li>
				<li class=""><a href="pay.php"><i class="icon-chevron-right"></i><i class="icon-credit-card"></i>&nbsp;Pay</a></li>

		</ul>
					<?php /* include('search_other_class.php');  */?>	
</div>

