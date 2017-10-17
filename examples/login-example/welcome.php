<?php
    session_start();
    include '../includes/header.php';
    include '../includes/nav.php';

    $birthDate = date_create($_SESSION['client']['BirthDate']);
    $birthDate = date_format($birthDate,"M d, Y");
?>
	<div class="container">
		<div class="row">
            <?php
    if(!empty($data['GetClassesResult']['Classes']['Class'])) :
        $classes = $mb->makeNumericArray($data['GetClassesResult']['Classes']['Class']);
        $classes = sortClassesByDate($classes);
        foreach($classes as $classDate => $classes) :
            $classFormat = date_create($classDate);
            $classFormat = date_format($classFormat,"M d,Y");
            // echo $classDate.'<br />';
?>
            <label class="control-label"><?= $classFormat; ?></label>
            <table class="table table-condensed table-hover table-striped table-bordered">
                <thead><tr>
                    <th>Class Name</th><th>Class Instructor/Teacher</th><th>Date</th><th>Time</th>
                </tr></thead>
                <tbody>
        <?php
            foreach($classes as $class) :
                $sDate = date('m/d/Y', strtotime($class['StartDateTime']));
                $sLoc = $class['Location']['ID'];
                $sTG = $class['ClassDescription']['Program']['ID'];
                $studioid = $class['Location']['SiteID'];
                $sclassid = $class['ClassScheduleID'];
                $sType = -7;
                $linkURL = "https://clients.mindbodyonline.com/ws.asp?sDate={$sDate}&sLoc={$sLoc}&sTG={$sTG}&sType={$sType}&sclassid={$sclassid}&studioid={$studioid}";
                $className = $class['ClassDescription']['Name'];
                // $startDateTime = date('Y-m-d H:i:s', strtotime($class['StartDateTime']));
                // $endDateTime = date('Y-m-d H:i:s', strtotime($class['EndDateTime']));
                $startDate = date_create($class['StartDateTime']);
                $startDate = date_format($startDate,"M d,Y");
                $timeStart = date_create($class['StartDateTime']);
                $timeStart = date_format($timeStart,"h:i A");
                $timeEnd = date_create($class['EndDateTime']);
                $timeEnd = date_format($timeEnd,"h:i A");
                $staffName = $class['Staff']['Name'];
                // echo "<a href='{$linkURL}'>{$className}</a> w/ {$staffName} {$startDateTime} - {$endDateTime}<br />";
        ?>
                    <tr>
                        <td><a href="<?= $linkURL; ?>"><?= $className; ?></a></td>
                        <td><?= $staffName; ?></td>
                        <td><?= $startDate; ?></td>
                        <td><?= $timeStart.' - '.$timeEnd; ?></td>
                    </tr>
        <?php endforeach; ?>
                </tbody>
            </table>
<?php
        endforeach;
    else :
        if(!empty($data['GetClassesResult']['Message'])) {
            echo $data['GetClassesResult']['Message'];
        } else {
            echo "Error getting classes<br />";
            echo '<pre>'.print_r($data,1).'</pre>';
        }
    endif;

    function sortClassesByDate($classes = array()) {
        $classesByDate = array();
        foreach($classes as $class) {
            $classDate = date("Y-m-d", strtotime($class['StartDateTime']));
            if(!empty($classesByDate[$classDate])) {
                $classesByDate[$classDate] = array_merge($classesByDate[$classDate], array($class));
            } else {
                $classesByDate[$classDate] = array($class);
            }
        }
        ksort($classesByDate);
        foreach($classesByDate as $classDate => &$classes) {
            usort($classes, function($a, $b) {
                if(strtotime($a['StartDateTime']) == strtotime($b['StartDateTime'])) {
                    return 0;
                }
                return $a['StartDateTime'] < $b['StartDateTime'] ? -1 : 1;
            });
        }
        return $classesByDate;
    }
?>
		</div>
	</div>
</body>
</html>