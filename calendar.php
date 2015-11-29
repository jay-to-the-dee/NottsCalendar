<?php

function getGuid($userCourseName)
{
    $url = 'http://mobile.nottingham.ac.uk/hack/data/timetabling/2015/courses';
    $data = json_decode(file_get_contents($url));
    $schools = $data->Courses->School;

    foreach ($schools as $school)
    {
        $schoolsCourses = $school->Course;

        foreach ($schoolsCourses as $schoolsCourse)
        {
            if ($schoolsCourse->Name == $userCourseName)
            {
                return $schoolsCourse->Guid;
            }
        }
    }
}




$COURSEGUID = getGuid("Computer Science with Artificial Intelligence 4 year UG Full time/1");
$url = "http://mobile.nottingham.ac.uk/hack/data/timetabling/2015/activities/course/$COURSEGUID";

include 'calgen.php';
