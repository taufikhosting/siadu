<?php

function cleartext($txt) {
        return preg_replace('/[!"\#\$%\'\(\)\?@\[\]\^`\{\}~\*\/]/', '', $txt);
}
function AuraCMSSEO($string) {
	$string = str_replace(' ', '-', $string);
	$string = preg_replace('/[^0-9a-zA-Z-_]/', '', $string); 
	$string = str_replace('-', ' ', $string);
	$string = preg_replace('/^\s+|\s+$/', '', $string);
	$string = preg_replace('/\s+/', ' ', $string);
	$string = str_replace(' ', '-', $string);
	return strtolower(cleartext($string));
}

try
{
	//Open database connection
	$con = mysql_connect("localhost","root","");
	mysql_select_db("tcms", $con);

	//Getting records (listAction)
	if($_GET["action"] == "list")
	{
		//Get record count
		$result = mysql_query("SELECT COUNT(*) AS RecordCount FROM halaman;");
		$row = mysql_fetch_array($result);
		$recordCount = $row['RecordCount'];

		//Get records from database
		$result = mysql_query("SELECT * FROM halaman ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
		
		//Add all records to an array
		$rows = array();
		while($row = mysql_fetch_array($result))
		{
		    $rows[] = $row;
		}

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['TotalRecordCount'] = $recordCount;
		$jTableResult['Records'] = $rows;
		print json_encode($jTableResult);
	}
	//Creating a new record (createAction)
	else if($_GET["action"] == "create")
	{
	$seftitle=AuraCMSSEO($_POST["judul"]);
		//Insert record into database
		$result = mysql_query("INSERT INTO halaman(judul,konten,seftitle) VALUES('".$_POST["judul"] ."','". $_POST["konten"] ."','".$seftitle."');");
		
		//Get last inserted record (to return to jTable)
		$result = mysql_query("SELECT * FROM halaman WHERE id = LAST_INSERT_ID();");
		$row = mysql_fetch_array($result);

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['Record'] = $row;
		print json_encode($jTableResult);
	}
	//Updating a record (updateAction)
	else if($_GET["action"] == "update")
	{
		//Update record in database
	$seftitle=AuraCMSSEO($_POST["judul"]);
		$result = mysql_query("UPDATE halaman SET judul = '" . $_POST["judul"] . "', konten = '" . $_POST["konten"] . "', seftitle = '" . $seftitle . "' WHERE id = " . $_POST["id"] . ";");
		//Get updated (to return to jTable)
		$result = mysql_query("SELECT * FROM halaman WHERE id = " . $_POST["id"] . ";");
		$row = mysql_fetch_array($result);
		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}
	//Deleting a record (deleteAction)
	else if($_GET["action"] == "delete")
	{
		//Delete from database
		$result = mysql_query("DELETE FROM halaman WHERE id = " . $_POST["id"] . ";");

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}

	//Close database connection
	mysql_close($con);

}
catch(Exception $ex)
{
    //Return error message
	$jTableResult = array();
	$jTableResult['Result'] = "ERROR";
	$jTableResult['Message'] = $ex->getMessage();
	print json_encode($jTableResult);
}
	
?>