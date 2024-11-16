<?php include '../includes/header.php'; ?>

<div class="schedule-wrapper">
    <h2>Store Schedule</h2>
    <div class="schedule-controls">
        <button onclick="window.print()" class="print-btn">Print Schedule</button>
    </div>
    <table class="schedule-table" id="printableTable">
        <caption>Photography Store Weekly Schedule</caption>
        <thead>
            <tr>
                <th rowspan="2">Time</th>
                <th colspan="5">Weekdays</th>
                <th colspan="2">Weekend</th>
            </tr>
            <tr>
                <th>Sunday</th>
                <th>Monday</th>
                <th>Tuesday</th>
                <th>Wednesday</th>
                <th>Thursday</th>
                <th>Friday</th>
                <th>Saturday</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>09:00 - 12:00</td>
                <td colspan="5">Regular Hours</td>
                <td rowspan="1">Special Weekend Hours</td>
                <td rowspan="4">Closed</td>
            </tr>
            <tr>
                <td>12:00 - 13:00</td>
                <td colspan="5">Lunch Break</td>
                <td rowspan="2">Closed</td>
            </tr>
            <tr>
                <td>13:00 - 17:00</td>
                <td colspan="5">Regular Hours</td>
            </tr>
        </tbody>
    </table>
</div>

<link rel="stylesheet" href="../print.css" media="print"/>

<?php include '../includes/footer.php'; ?>