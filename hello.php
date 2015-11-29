<?php
$data = json_decode(file_get_contents('http://mobile.nottingham.ac.uk/hack/data/timetabling/2015/courses'));
$schools = $data->Courses->School;
$courses = $data->Courses->School->Course;
//$select.html('');
?>
<html>
    <body>
        <form>
            <input type="text" name="username" placeholder="username"/>

            <select name="courseID">
                <?php
                foreach ($schools as $school)
                {
                    foreach ($school as $course)
                    {
                        if (is_array($course) || is_object($course))
                        {
                            foreach ($course as $co)
                            {
                                $text = substr($co -> Name, 0, -2);
                                if($text != $current)
                                {
                                      echo '<option>' . $text. '</option>';
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
                $startingYear = 2015;
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

