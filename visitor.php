<!DOCTYPE html>
<?php
	require_once 'session.php';
	require_once '../connect.php';
?>
<html lang = "eng">
	<head>
		<title>Information System Society Membership</title>
		<meta charset = "UTF-8" />
		<meta name = "viewport" content = "width=device-width, initial-scale=1" />
		<link rel = "stylesheet" type = "text/css" href = "../css/bootstrap.css" />
		<link rel = "stylesheet" type = "text/css" href = "../css/style.css" />
		<link rel = "stylesheet" type = "text/css" href = "../css/jquery-ui.css" />
		<link rel = "stylesheet" type = "text/css" href = "../css/jquery.dataTables.css" />
	</head>
<body>
<!--------------------HEAD---------------------->
<?php include'head.php';?>
<!--------------------HEAD---------------------->

<!-------------------SIDEBAR0------------------>
<?php include 'sidebar.php';?>
<!-------------------SIDEBAR0------------------>

		<div id = "sidecontent" class = "well pull-right">
				<div class = "alert alert-info">Visitor</div>
				<button type = "button" id = "add_student" class = "btn btn-success"><span class = "glyphicon glyphicon-plus"></span> Add Visitor</button>
				<button style = "display:none;" type = "button" id = "cancel_student" class = "btn btn-warning"><span class = "glyphicon glyphicon-hand-right"></span> Cancel</button>
				<br />
				<br />
				<div id = "s_table" class = "panel panel-default">
					<div  class = " panel-heading">	
						<table id = "table" class = "table table-bordered">
							<thead>
								<tr>
									<th>Resident ID</th>
									<th>Visitor Name</th>
									<th>Time IN</th>
                                    <th>Time OUT</th>
                                    <th>Incident</th>
                                    <th>Visitor ID</th>
									
								</tr>
							</thead>
							<tbody>
								<?php
									$s_query = $conn->query("SELECT * FROM `db_issm`.`Visitors`;") or die(mysqli_error());
									while($s_fetch = $s_query->fetch_array()){	
								?>
                            
								<tr>
									<td><?php echo $s_fetch['Resident_id']?></td>
									<td><?php echo $s_fetch['Visitor_Name']?></td>
									<td><?php echo $s_fetch['Time_in']?></td>
                                    <td><?php echo $s_fetch['Time_out']?></td>
                                    <td><?php echo $s_fetch['Incident']?></td>
                                   
                             

									<td><center><a href = "edit_owner.php?id=<?php echo $s_fetch['Owner_ID']?>" class = "btn btn-warning"><span class=  "glyphicon glyphicon-edit"></span> Update</a> <a href = "#" name = "<?php echo $s_fetch['Owner_ID']?>" data-toggle = "modal" data-target = "#delete_student" class = "btn btn-danger id"><span class=  "glyphicon glyphicon-trash"></span> Delete</a></center></td>
								</tr>
								<?php
									}
								?>
							</tbody>
						</table>
					</div>	
				</div>
				<div class = "modal fade" id = "delete_student" tabindex = "-1" role = "dialog" aria-labelledby = "myModallabel">
					<div class = "modal-dialog" role = "document">
						<div class = "modal-content ">
							<div class = "modal-body">
								<center><label class = "text-danger">Are you sure you want to delete this record?</label></center>
								<br />
								<center><a class = "btn btn-danger delete_student" ><span class = "glyphicon glyphicon-trash"></span> Yes</a> <button type = "button" class = "btn btn-warning" data-dismiss = "modal" aria-label = "No"><span class = "glyphicon glyphicon-remove"></span> No</button></center>
							</div>
						</div>
					</div>
				</div>
                
				<div id = "s_form" style = "display:none;" class = "panel panel-default">
					<div  class = " panel-heading" >	
							<div class = "alert alert-success">Add Owner</div>
							<form method = "POST" enctype = "multipart/form-data" action = "add_visitor.php">
								
								<div style = "width:40%; margin-left:32%;">	
									<div class = "form-group">
										<label>Resident ID</label>
										<input type = "text" class = "form-control"  name = "building_id" required = "required"/>
									</div>
									<div class = "form-group">
										<label>Vistior Name</label>
										<input type = "text" class = "form-control"  name = "address" required = "required"/>
									</div>
									<div class = "form-group">
										<label>Time IN </label>
										<input type = "date" class = "form-control"  name = "contact1"/>
									</div>

                                    <div class = "form-group">
										<label>Time OUT </label>
										<input type = "date" class = "form-control"  name = "contact2" />
									</div>
                                    <div class = "form-group">
										<label>Incident </label>
										<input type = "textarea" class = "form-control"  name = "contact3" />
									</div>
                                 
                                    
                                    <div class = "form-group">
										<label>Visitor ID </label>
										<input type = "text" class = "form-control"  name = "contact5" />
									</div>


									
									<div class = "form-group">
										<button class = "btn btn-primary form-control" name = "save_student"><span class = "glyphicon glyphicon-save"></span> Save</button>
									</div>
								</div>	
							</form>		
					</div>
				</div>
		</div>
	<br />
	<br />
	<br />
	<br />
	<br />
	<br />
	<br />
	<br />
	<br />
	
</body>	
<script src = "../js/jquery-3.1.1.js"></script>
<script src = "../js/sidebar.js"></script>
<script src = "../js/bootstrap.js"></script>
<script src = "../js/jquery.dataTables.min.js"></script>
<script src = "../js/script.js"></script>
<script type = "text/javascript">
	$(document).ready(function(){
		$('#table').DataTable();
	});
</script>
<script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#pic')
                        .attr('src', e.target.result)
                        .width(200)
                        .height(200)
						.css('display', 'block');
					$('.pic_hide').hide();
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
</script>
<script type = "text/javascript">
	$(document).ready(function(){
		$('.id').on('click', function(){
			$id = $(this).attr('name');
			$('.delete_student').on('click', function(){
				window.location = 'delete_visitor.php?id=' + $id;
			});
		});
	});
</script>
</html>