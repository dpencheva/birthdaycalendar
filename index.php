<?php
// Array of birthdays (you can replace this with a database)
$birthdays = [
    '2024-12-01' => 'Alice',
    '2024-12-05' => 'Bob',
    '2024-12-10' => 'Charlie',
    '2024-12-15' => 'David',
    '2024-12-20' => 'Eva',
    '2024-12-25' => 'Frank'
];

// Array of Bulgarian month names
$bulgarianMonths = [
    '01' => 'Януари',
    '02' => 'Февруари',
    '03' => 'Март',
    '04' => 'Април',
    '05' => 'Май',
    '06' => 'Юни',
    '07' => 'Юли',
    '08' => 'Август',
    '09' => 'Септември',
    '10' => 'Октомври',
    '11' => 'Ноември',
    '12' => 'Декември'
];

// Get the current month and year
$currentMonth = date('m');
$currentYear = date('Y');

// Determine the first day of the month
$firstDayOfMonth = strtotime("{$currentYear}-{$currentMonth}-01");

// Determine how many days are in the month
$daysInMonth = date('t', $firstDayOfMonth);

// Get the Bulgarian name of the current month
$monthName = $bulgarianMonths[$currentMonth];

// Get the weekday of the first day of the month
$firstDayWeekday = date('w', $firstDayOfMonth);

// Adjust so the week starts on Monday (0 = Monday, 6 = Sunday)
$firstDayWeekday = ($firstDayWeekday == 0) ? 6 : $firstDayWeekday - 1;

// Function to display the calendar
function displayCalendar($currentMonth, $currentYear, $birthdays, $firstDayWeekday, $daysInMonth) {
    global $bulgarianMonths;
    
    echo "<h2>{$currentYear} - {$currentMonth}</h2>";
    echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
    
    // Header with the days of the week (in Bulgarian)
    echo "<tr>
            <th>Пн</th>
            <th>Вт</th>
            <th>Ср</th>
            <th>Чт</th>
            <th>Пт</th>
            <th>Сб</th>
            <th>Нд</th>
          </tr>";
    
    $day = 1;
    
    // Start the first row from the correct weekday (Monday)
    echo "<tr>";
    
    // Print empty cells until the first day of the month
    for ($i = 0; $i < $firstDayWeekday; $i++) {
        echo "<td></td>";
    }
    
    // Print the days of the month
    for ($i = $firstDayWeekday; $i < 7; $i++) {
        if ($day <= $daysInMonth) {
            $date = "{$currentYear}-{$currentMonth}-" . str_pad($day, 2, "0", STR_PAD_LEFT);
            
            // Check if the day is a weekend (Saturday or Sunday)
            $isWeekend = ($i == 5 || $i == 6); // Saturday = 5, Sunday = 6
            
            // Apply weekend background color if it's Saturday or Sunday
            $backgroundColor = $isWeekend ? '#f0f0f0' : ''; // Light gray background for weekends
            
            echo "<td style='padding: 10px; background-color: {$backgroundColor};'>";
            echo $day;
            
            // Check if there's a birthday on this day
            if (isset($birthdays[$date])) {
                echo "<br><span style='color: red;'>Рожден ден: {$birthdays[$date]}</span>";
            }
            
            echo "</td>";
            $day++;
        }
    }
    
    echo "</tr>";
    
    // Print remaining days of the month
    while ($day <= $daysInMonth) {
        echo "<tr>";
        for ($i = 0; $i < 7; $i++) {
            if ($day <= $daysInMonth) {
                $date = "{$currentYear}-{$currentMonth}-" . str_pad($day, 2, "0", STR_PAD_LEFT);
                
                // Check if the day is a weekend (Saturday or Sunday)
                $isWeekend = ($i == 5 || $i == 6); // Saturday = 5, Sunday = 6
                
                // Apply weekend background color if it's Saturday or Sunday
                $backgroundColor = $isWeekend ? '#f0f0f0' : ''; // Light gray background for weekends
                
                echo "<td style='padding: 10px; background-color: {$backgroundColor};'>";
                echo $day;
                
                // Check if there's a birthday on this day
                if (isset($birthdays[$date])) {
                    echo "<br><span style='color: red;'>Рожден ден: {$birthdays[$date]}</span>";
                }
                
                echo "</td>";
                $day++;
            } else {
                echo "<td></td>";
            }
        }
        echo "</tr>";
    }
    
    echo "</table>";
}

// Display the calendar for the current month
displayCalendar($monthName, $currentYear, $birthdays, $firstDayWeekday, $daysInMonth);
?>
