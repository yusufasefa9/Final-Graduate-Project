<?php
require_once "header_dashboard.php";
require_once "session.php";
require_once "functions.php";
require_once "navbar_teacher.php";
$user = new login_registration_class();

if(isset($_REQUEST['vr'])){
    $student_id = $_REQUEST['vr'];
    $firstname = $_REQUEST['vn'];
}
?>
<?php 
$pageTitle = "Student Result";
?>
<div class="all_student fix">
    
    <?php
    
    //custom function check credit hour and grade point
    function credit_hour($x){
        if($x=="Accounting") return 3;
        elseif($x == "Enterprenership") return 2; // Corrected credit hours for Enterprenership
        elseif($x == "OB") return 3;
        elseif($x == "HR") return 5;
        elseif($x == "English") return 4;
        elseif($x == "economics") return 3;
        elseif($x == "businuss") return 3;
        elseif($x == "Psychology") return 3;
    }
    function grade_point($gd){
        if($gd<40) return 0;
        
        elseif($gd>=40 && $gd<50) return 1;
		elseif($gd>=50 && $gd<60) return 2;
		elseif($gd>=60 && $gd<65) return 3;
        elseif($gd>=65 && $gd<70) return 4;
		elseif($gd>=70 && $gd<75) return 5;
        elseif($gd>=75 && $gd<80) return 6;
		elseif($gd>=80 && $gd<85) return 7;
		elseif($gd>=80 && $gd<90) return 8;
        elseif($gd>=90 && $gd<=100) return 9;
    }
    ?>
    <!--Infomation of student-->
    <div>
        <p style="text-align:center;color:#fff;background-color: #007bff;margin:0;padding:0;"><?php echo "Name: ".$firstname."<br>Student ID: " . $student_id; ?></p>
    </div>  
    <div>
        <p style="float:left;margin:0 0 5px 0;width:100%;text-align:center;"><a href="view_cgpa.php?vr=<?php echo $student_id; ?>&vn=<?php echo $firstname; ?>"><button class="editbtn">View cgpa & completed course</button></a></p>
    </div>
    
    <form action="" method="post" style="width:23%;margin:0 auto;padding-bottom:5px;">
        <select name="seme" id="">
            <option value="1st">1st semester</option>
            <option value="2nd">2nd semester</option>
        
        </select>
        <input type="submit" value="view Result" />

    </form>
    <?php
    //select semester
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $semester = $_POST['seme'];
            
            $i=0;
            $ch = 0;
            $gp = 0;
                
            
                //$get_result = $user->show_marks();
                
                $get_result = $user->show_marks($student_id,$semester);
                if($get_result){
            ?>
                <p><?php echo "<p style='text-align:center;background-color: #007bff;color:#fff;padding:5px;width:85%;margin:0 auto'>".$semester." Semester Result"?></p>
                <table class="tab_two" style="text-align:center;width:85%;margin:0 auto">
                    <th>Subject</th>
                    <th>Marks</th>
                    <th>Grade</th>
                    <th>Credit hr.</th>
                    <th>Status</th>
        <?php       
                while($rows = $get_result->fetch_assoc()){
                $i++;
                //count total credit hour;    
                $ch = $ch + credit_hour($rows['sub']);

        ?>
            <tr>
                <td><?php echo $rows['sub'];?></td>
                <td><?php echo $rows['marks'];?></td>
                <td>
                <?php 
                //set grade for individual subject
                    $mark = $rows['marks'];
                    if($mark<40){echo "F";}
                    elseif($mark>=40 && $mark<50){echo "C-";}
                    elseif($mark>=50 && $mark<60){echo "C";}
					elseif($mark>=60 && $mark<65){echo "C+";}
					elseif($mark>=65 && $mark<70){echo "B-";}
                    elseif($mark>=70 && $mark<75){echo "B";}
					elseif($mark>=75 && $mark<80){echo "B+";}
                    elseif($mark>=80 && $mark<85){echo "A-";}
					elseif($mark>=85 && $mark<90){echo "A";}
                    elseif($mark>=90 && $mark<=100){echo "A+";}
                    
                    //total grade point
                    $gp = $gp + (credit_hour($rows['sub']) * grade_point($rows['marks']));
                    
                ?>
                </td>
                <td><?php echo credit_hour($rows['sub']); ?></td>
                <td>
                <?php
                    $stat = $rows['marks'];
                    if($stat<40){
                        echo "<span style='background:red;padding:3px 11px;color:#fff;'>Fail</span>";
                    }else{
                        echo "<span style='background:green;padding:3px 6px;color:#fff;'>Pass</span>";
                    }
                ?>
                </td>
                
                
            </tr>
            <?php } ?>
            <tr>
                <td colspan="2">SGPA : </td>
                <td colspan="2">
                <?php
                if($ch != 0) {
                    $sg = $gp/$ch;
                    echo "<span style='color:green;padding:3px 6px;font-size:20px'>" . round($sg,2) . "</span>";
                } else {
                    echo "<span style='color:red'>Division by zero error</span>";
                }
                ?>
                </td>
                <td>
                    <?php
                        if($ch != 0) {
                            if($sg>=3.5){
                                echo "<span style='background:purple;padding:3px 6px;color:#fff;'>Excellent";
                            }elseif($sg>=3.0 && $sg<3.5){
                                echo "<span style='background:green;padding:3px 6px;color:#fff;'>Good";
                            }elseif($sg>=2.5 && $sg<3.0){
                                echo "<span style='background:gray;padding:3px 6px;color:#fff;'>Average";
                            }else{
                                echo "<span style='background:red;padding:3px 6px;color:#fff;'>Probation";
                            }
                        } else {
                            echo "<span style='color:red'>SGPA calculation not possible</span>";
                        }
                    ?>
                </td>
            </tr>
        </table>
        
        <?php 
            }
            else{
                echo  "<p style='color:red;text-align:center'>Nothing Found</p>";
                }
        ?>
            <p style="float:left; text-align:right;margin:20px 0;width:49%"><a href="st_result_update.php?ar=<?php echo $student_id?>&seme=<?php echo $semester?>&vn=<?php echo $firstname?>"><button class="editbtn">Edit Result</button></a></p>
        <?php 
                }
        ?>
        
            <p style="float:right;text-align:left;margin:20px 0;width:49%"><a href="st_result.php"><button class="editbtn">Back to list</button></a></p>
            
            <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="fonts/stylesheet.css">
       <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="plugins/file-uploader/css/jquery.fileupload.css">
        <link rel="stylesheet" href="plugins/file-uploader/css/jquery.fileupload-ui.css">
        <script src="js/vendor/jquery-1.12.0.min.js"></script>
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>

</div>
<?php include('script.php'); ?>

<?php ob_end_flush() ; ?>
