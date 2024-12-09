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

// Get the current month and year
$currentMonth = date('m');
$currentYear = date('Y');

// Determine the first day of the month
$firstDayOfMonth = strtotime("{$currentYear}-{$currentMonth}-01");

// Determine how many days are in the month
$daysInMonth = date('t', $firstDayOfMonth);

// Get the name of the current month
$monthName = date('F', $firstDayOfMonth);

// Get the weekday of the first day of the month
$firstDayWeekday = date('w', $firstDayOfMonth);

// Function to display the calendar
function displayCalendar($currentMonth, $currentYear, $birthdays, $firstDayWeekday, $daysInMonth) {
    echo "<h2>{$currentYear} - {$currentMonth}</h2>";
    echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
    echo "<tr>
            <th>Sun</th>
            <th>Mon</th>
            <th>Tue</th>
            <th>Wed</th>
            <th>Thu</th>
            <th>Fri</th>
            <th>Sat</th>
          </tr>";
    
    $day = 1;
    
    // Start the first row from the correct weekday
    echo "<tr>";
    
    // Print empty cells until the first day of the month
    for ($i = 0; $i < $firstDayWeekday; $i++) {
        echo "<td></td>";
    }
    
    // Print the days of the month
    for ($i = $firstDayWeekday; $i < 7; $i++) {
        if ($day <= $daysInMonth) {
            $date = "{$currentYear}-{$currentMonth}-" . str_pad($day, 2, "0", STR_PAD_LEFT);
            echo "<td style='padding: 10px;'>";
            echo $day;
            
            // Check if there's a birthday on this day
            if (isset($birthdays[$date])) {
                echo "<br><span style='color: red;'>Birthday: {$birthdays[$date]}</span>";
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
                echo "<td style='padding: 10px;'>";
                echo $day;
                
                // Check if there's a birthday on this day
                if (isset($birthdays[$date])) {
                    echo "<br><span style='color: red;'>Birthday: {$birthdays[$date]}</span>";
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
