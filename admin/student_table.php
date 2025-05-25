<?php include('dbcon.php'); ?>

<?php include('download.php'); ?>
<form action="delete_student.php" method="post">
    <table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
        <a data-toggle="modal" href="#student_delete" id="delete"  class="btn btn-danger" name=""><i class="icon-trash icon-large"></i></a>
        
        

        <?php include('modal_delete.php'); ?>
        <thead>
            <tr>
                <th></th>
                <th>Name</th>
                <th>Username</th>
                <th>Section</th>
                <th>File</th> <!-- New column for the file -->
                <th></th>
            </tr>
        </thead>
        <tbody>
            
        <?php
        $query = mysqli_query($conn,"SELECT student.*, class.class_name FROM student LEFT JOIN class ON student.class_id = class.class_id ORDER BY student.student_id DESC") or die(mysqli_error($conn));
        while ($row = mysqli_fetch_array($query)) {
            $id = $row['student_id'];
			$file= $row['file'];
            ?>
        
            <tr>
                <td width="30">
                    <input id="optionsCheckbox" class="uniform_on" name="selector[]" type="checkbox" value="<?php echo $id; ?>">
                </td>
            
                <td><?php echo $row['firstname'] . " " . $row['lastname']; ?></td> 
                <td><?php echo $row['username']; ?></td> 
            
                <td width="100"><?php echo $row['class_name']; ?></td> 
                
                <!-- Display file link with a download icon if available -->
               <!-- Display file link with a download icon if available -->
			

               
<td width="30">
    <?php 
    if (!empty($file)) {
    ?>
        <a data-placement="bottom" title="Download" class="btn btn-info" href="download.php?file=<?php echo urlencode($file); ?>"><i class="icon-download icon-large"></i></a>
    <?php 
    }
    ?>
</td>


            
                <td width="30"><a href="edit_student.php<?php echo '?id='.$id; ?>" class="btn btn-success"><i class="icon-pencil"></i> </a></td>
            
            </tr>
       

        <?php } ?>    
        
        </tbody>
    </table>
</form>
