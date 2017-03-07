<?php
//Here check access. If admin, select all. If photographer, only select
//events matching the user id.
include("dbconnection.php");

if($_SESSION["accesslevel"] == 2) {
    //Photographer
    $currentUser = $_SESSION["userid"];
    $stmt = $databaseConnection->prepare("SELECT * FROM tbl_schedule, tbl_photographers WHERE tbl_schedule.photographerid = tbl_photographers.userid AND tbl_schedule.photographerid = ?");
    $stmt->execute([$currentUser]);
} else {
    $stmt = $databaseConnection->prepare("SELECT * FROM tbl_schedule, tbl_photographers WHERE tbl_schedule.photographerid = tbl_photographers.userid");
    $stmt->execute();
}

//Initialize an array for the results
$events = array();
if ($stmt) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        //Set each index of the event to the row retrieved
        $events[] = $row;
    }

    //title, start, end
    $jsonArray = array();

    foreach($events as $singleEvent) {
        $eventArray = array();

        $date = $singleEvent["eventdate"];

        $eventArray["title"] = $singleEvent["fname"].' '.$singleEvent["lname"].'-'.$singleEvent["eventdescription"];
        $eventArray["start"] = $date . "T" . $singleEvent["timestart"];
        $eventArray["end"] = $date . "T" . $singleEvent["timeend"];
        $jsonArray[] = $eventArray;
    }

    $fp = fopen('./fullcalendar/misc/json/events-test.json', 'w');
    fwrite($fp, json_encode($jsonArray));
    fclose($fp);
}

?>
