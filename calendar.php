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
$currentAcademicYear = date('Y', strtotime("-9 months"));  //2015-16 is counted as just 2015 - works out current academic year startting 1st spet
$userStartingYear = 2015;

$userInYear = $currentAcademicYear - $userStartingYear + 1;


$COURSEGUID = getGuid("Computer Science with Artificial Intelligence 4 year UG Full time/$userInYear");
$url = "http://mobile.nottingham.ac.uk/hack/data/timetabling/$currentAcademicYear/activities/course/$COURSEGUID";

include 'calgen.php';
