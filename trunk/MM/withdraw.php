<?php
session_start();
include_once('loginchecker.php');
//include_once('branch_checker.php');
include_once('localDB.php');
include_once('functions.php');
$day = date('d');
$month = date('F');
$numericMonth = date('m');
$year = date('Y');

?>
<script language="JavaScript" src="calendar/calendar_db.js"></script>
<link rel="stylesheet" href="calendar/calendar.css">
<fieldset>
<legend><strong>Withdrawals</strong></legend>
<table>


	<form method="POST" action="home.php?page=withdraw&submitted=yes"
		name="myform">
	
	
	<tr>
		<td>Out Going:</td>
		<td><select name="type">
			<option value="sampath_bank">Sampath Bank</option>
			<option value="anu_market">Anuradapura Market</option>
			<option value="anu_bus">Anuradapura Bus stand</option>
			<option value="mm">MM Branch</option>
			<option value="kurunegala">Kurunegala</option>
			<option value="wariyapola">Wariyapola</option>
            <option value="kekirawa">Kekirawa</option>
			<option value="medawachchiya">Madawachchiya</option>
			<option value="other">Other</option>
		</select></td>
	</tr>
	<tr>
		<td>Amount:</td>
		<td><input type="text" size="30" maxlength="50" name="Amount"></td>
	</tr>
	<tr>
		<td>Discription:</td>
		<td><textarea name="description" rows="5"></textarea></td>

	</tr>
	<tr><td>Enter Date:</td>
		<td><input type="text" name="date" />
		<script language="JavaScript">
		new tcal ({
			// form name
			'formname': 'myform',
			// input name
			'controlname': 'date'
		});

	</script></td></tr>

	<tr>
		<td></td>
		<td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<INPUT
			type="submit" name="button" value="Update" /></td>
	</tr>

	</form>
</table>
</legend></fieldset>

<?php
showStats('withdraw');
$dataSubmitted = $_GET['submitted'];
if($dataSubmitted == "yes") {

        displayToday('withdraw');
        //include_once('localDB.php');
        

        $genericInsert = "INSERT INTO withdrawals(trans_id,source,amount,description,date) "
        ."VALUES('','{$_POST['type']}','{$_POST['amount']}','{$_POST['description']}','{$_POST['date']}');";
        $withdrawResult = mysql_query($genericInsert);

        if ( ($withdrawResult) != null ) {
                echo '<p>Data entered successfully</p>';
        }
        else {
                echo '<p>Failed to enter data</p>';
        }

}
if ( $_GET['func'] == 'delete' ) {
	$id = $_GET['ref'];
	$deleted = deleteRecord($id, 'withdraw');
	if ( $deleted ) {
		echo '<p>Item deleted successfully.</p>';
	}
	displayToday('withdraw');
}

?>