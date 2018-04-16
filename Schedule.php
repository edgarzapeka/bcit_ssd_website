<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BCIT Schedule</title>
    <link rel="stylesheet" href="./styles/styles.css">
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet">
    <script
    src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
</head>
<body>
<div class="wrapper" id="top6">
<header>
            <h1>BCIT - SSD</h1>
            <button class="hamburger" id="hamburger">
                <div class="hamburger-content" tabindex="-1">
                    <span class="text">Menu</span>
                    <span class="bar"></span>
                </div><!-- end button-content -->
            </button>
            <nav>
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="Schedule.php">Schedule</a></li>
                    <li><a href="students.php">Students</a></li>
                    <li><a href="staff.php">Staff</a></li>
                    <li><a href="resources.html">Resources</a></li>
                    <li><a href="overview.html">Overview</a></li>
                    <li><a href="courses.html">Courses</a></li>
                    <li><a href="contact.html">Contact</a></li>
                </ul>
            </nav>       
    </header>
    <main>
        <h2>Schedule</h2>
    <button class="hideTab" id="switchViewBtn" onClick="switchView()">Switch View</button>
    <button id="tabBtn" onClick="openTab()"><</button>
    <script>
    
    function switchView() {
        $('#schedule').toggleClass('calendarView listView');
    }
    function openTab() {
        $('#switchViewBtn').toggleClass('hideTab');
        if($("#tabBtn").text() == "<") {
            $('#tabBtn').html('>');
            
        } else {
            $('#tabBtn').html('<'); 
        }
        
    }
    (function($) {
        var $window = $(window);
            $calendar = $('#schedule');
        
        $window.resize(function resize(){
            if ($window.width() < 800) {
                
                $('#schedule').removeClass('calendarView').addClass('listView');
                //$calendar.addClass('listView');
                
            }
    
            
        }).trigger('resize');
    })(jQuery);
    
    </script>
<?php 
$scheduleFile = "./data/ssd-schedule-2017-2018.csv";

$sep = [];
$oct = [];
$nov = [];
$dec = [];
$jan = [];
$feb = [];
$mar = [];
$apr = [];


if(($handle = fopen($scheduleFile,"r")) !== FALSE) {
    while(($data = fgetcsv($handle,1000,",")) !== FALSE) {
        $number = count($data);

        for ($cell = 0; $cell < $number; $cell++) {

            switch(substr($data[1],0,3)) {
                
                case "Sep": 
                    array_push($sep,$data[$cell]);
                    break;
                case "Oct": 
                    array_push($oct,$data[$cell]);
                    break;
                case "Nov": 
                    array_push($nov,$data[$cell]);
                    break;
                case "Dec": 
                    array_push($dec,$data[$cell]);
                    break;
                case "Jan": 
                    array_push($jan,$data[$cell]);
                    break;
                case "Feb": 
                    array_push($feb,$data[$cell]);
                    break;
                case "Mar": 
                    array_push($mar,$data[$cell]);
                    break;
                case "Apr": 
                    array_push($apr,$data[$cell]);
                    break;
            }
            
        }
       
    }
  
    fclose($handle);
    
}

function DisplayMonth($month, $monthName) {

    //get today
    $mon = date("M");
    $day = date("j");
    $today = $mon . " " . strval($day);

    $dataCount = 0;
    $weekDays = Array("Monday", "Tuesday", "Wednesday","Thursday","Friday");
    echo "<div class='monthHead'>";
    echo "<h1>" . $monthName . "</h1>";
    echo "</div>";
    echo "<div class='month'>";
    for($d=0; $d < count($weekDays); $d++) {
        echo "<div class='dayHead'> <h3>" . $weekDays[$d] . "</h3></div>";
    }

    $dayCount = 0;

    for($s=0; $s < count($month); $s++) {
        //data comes in packets of 5 (one is blank)
        if($s == 0) {
            if($month[$s] == "Tuesday") {
                echo "<div class='day'></div>";
            } else if($month[$s] == "Wednesday") {
                echo "<div class='day'></div>";
                echo "<div class='day'></div>";
            } else if($month[$s] == "Thursday") {
                echo "<div class='day'></div>";
                echo "<div class='day'></div>";
                echo "<div class='day'></div>";
            } else if ($month[$s] == "Friday") {
                echo "<div class='day'></div>";
                echo "<div class='day'></div>";
                echo "<div class='day'></div>";
                echo "<div class='day'></div>";
            }

        }
        if($dataCount == 0) {
            if($month[$s + 1] == $today) {
                echo "<div class='day today'>";
 
            } else {
               echo "<div class='day'>"; 
            }
            
            echo "<ul>";
        }
        if($month[$s] !== "" && $month[$s] !== "*") {
           
            echo "<li>" . $month[$s] . "</li>";
        }
        
        
        $dataCount++;
        if($dataCount == 5) {
            echo "</ul>";
            echo "</div>";
            
            $dataCount = 0;
        }

    }
    echo "</div>";

    echo "<hr>";
}

$months = Array($sep,$oct,$nov,$dec,$jan,$feb,$mar,$apr);
$monthNames = Array("September","October","November","December","January","February","March","April");

echo "<div class='calendarView' id='schedule'>";
for($m=0; $m < count($months); $m++) {
    DisplayMonth($months[$m],$monthNames[$m]);
}
echo "</div>";
?>
</main>

</div>
    <script src="./scripts/script.js"></script>

</body>
</html>