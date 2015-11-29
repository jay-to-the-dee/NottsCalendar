<?php
$data = json_decode(file_get_contents('http://mobile.nottingham.ac.uk/hack/data/timetabling/2015/courses'));
$schools = $data->Courses->School;
$courses = $data->Courses->School->Course;
?>
<html>
    <body>
        <form>
            <input type="text" name="username" placeholder="username"/>

            <select name="courseID">
                <?php
                foreach ($schools as $school)
                {
                    echo '<optgroup label = '.$school -> Name.'></optgroup>';
                    foreach ($school as $course)
                    {
                        if (is_array($course) || is_object($course))
                        {
                            foreach ($course as $co)
                            {
                                $text = substr($co -> Name, 0, -2);
                                if($text != $current)
                                {
                                      echo '<option>&emsp;&emsp;' . $text. '</option>';
                                }
                                $current= $text;
                            }
                        }
                    }
                }
                ?>
            </select>

            <select name="year" style="width: 60px">
                <?php
                $startingYear = date('Y', strtotime("-9 months"));  //2015-16 is counted as just 2015 - works out current academic year startting 1st sept;
                $yearsToGoBack = 6;

                for ($i = $startingYear; $i > $startingYear - $yearsToGoBack; $i--)
                {
                    echo "<option>$i</option>";
                }
                ?>
            </select>
            <button name="button">Submit</button>
        </form>

    </body>    
</html>
