BEGIN:VCALENDAR
PRODID:-//VOJit Inc@HackNotts//Nottingham WebCal Server//EN
VERSION:2.0
<?php

$data = json_decode(file_get_contents('http://mobile.nottingham.ac.uk/hack/data/timetabling/2015/activities/course/DEFE15F6B6D777913C727DD801F89A9A'));
$modules=$data->Activities->Course->Module;


foreach ($modules as $module)
{
    print_r($module->Description."\n");
}
 
    
?>
END:VCALENDAR