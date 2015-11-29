<?php
header('Content-type: text/calendar; charset=utf-8');
header('Content-Disposition: inline; filename=calendar.ics');
?>
BEGIN:VCALENDAR
PRODID:-//VOJit Inc@HackNotts//Nottingham WebCal Server//EN
VERSION:2.0
<?php

function getIcalDate($time, $incl_time = true)
{
    return $incl_time ? date('Ymd\THis', $time) : date('Ymd', $time);
}

function echoProperty($propertyKey, $propertyValue)
{
    if ($propertyKey && $propertyValue)
    {
        echo $propertyKey . ":" . $propertyValue . "\n";
    }
}
$data = json_decode(file_get_contents('http://mobile.nottingham.ac.uk/hack/data/timetabling/2015/activities/course/DEFE15F6B6D777913C727DD801F89A9A'));
$modules = $data->Activities->Course->Module;


foreach ($modules as $module)
{
    $classes = $module->Activity;


    foreach ($classes as $class)
    {
        $date = $class->Date;
        $StartTime = $class->StartTime;
        $EndTime = $class->EndTime;
        $location = $class->Locations->Location;

        $lecturers = $class->Staff->Person;
        if (count($lecturers) > 1)
        {
            $lecturersString = "";
            foreach ($lecturers as $lecturer)
            {
                //print_r($lecturer);
                $lecturersString.=$lecturer->Name . " ";
            }
        }
        else
        {
            $lecturersString = $lecturers->Name;
        }


        echo "BEGIN:VEVENT\n";

        echoProperty("DTSTART", getIcalDate(strtotime("$date->Day-$date->Month-$date->Year $StartTime->Hours:$StartTime->Minutes")));
        echoProperty("DTEND", getIcalDate(strtotime("$date->Day-$date->Month-$date->Year $EndTime->Hours:$EndTime->Minutes")));


        echoProperty("DTSTAMP", getIcalDate(time()));
        echoProperty("SUMMARY", $class->Description);
        echoProperty("LOCATION", $location->AbbreviatedName);
        echoProperty("DESCRIPTION", $lecturersString);
        echoProperty("UID", $class->Guid);

        echo "END:VEVENT\n";
    }
}
?>
END:VCALENDAR