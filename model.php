<?php

$data = json_decode(file_get_contents('http://mobile.nottingham.ac.uk/hack/data/timetabling/2015/activities/course/DEFE15F6B6D777913C727DD801F89A9A'));

var_dump($data->Activities->Course->Module);

?>