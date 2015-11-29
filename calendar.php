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

require 'sql-connect.php';

try
{
    $query = $db->prepare("SELECT * FROM user_info WHERE username=:username");
    $query->execute(array('username' => $_REQUEST['username']));
    $user_info = $query->fetch();
} catch (PDOException $e)
{
    die($e->getMessage());
}


$currentAcademicYear = date('Y', strtotime("-9 months"));  //2015-16 is counted as just 2015 - works out current academic year startting 1st spet
$userStartingYear = $user_info[start_year];

$userInYear = $currentAcademicYear - $userStartingYear + 1;


$COURSEGUID = getGuid("$user_info[course_name]/$userInYear");
$url = "http://mobile.nottingham.ac.uk/hack/data/timetabling/$currentAcademicYear/activities/course/$COURSEGUID";

include 'calgen.php';
