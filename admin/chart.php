<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>

        .chart-container {
            width: 90%;
            margin: auto;
        }
        .controls {
            text-align: center;
            margin-bottom: 10px;
        }

    </style>
</head>
<body>
    <div class="controls">
        <label for="timePeriod">Select Time Period:</label>
        <select id="timePeriod" onchange="updateChart()">
            <option value="daily">Daily</option>
            <option value="weekly">Weekly</option>
            <option value="monthly">Monthly</option>
        </select>
    </div>
    <div class="chart-container">
        <canvas id="bookingChart"></canvas>
    </div>
    <script>
        let chartInstance = null;

        async function fetchBookingData() {
            const response = await fetch('getBookings.php');
            return await response.json();
        }

        function processBookingData(bookings) {
            const dailyData = {
                labels: [],
                datasets: [{
                    label: 'Leadership Workshop',
                    data: [],
                    backgroundColor: 'teal',  // Sky Blue
                    borderColor: 'teal',
                    borderWidth: 1
                }, {
                    label: 'Staff Training',
                    data: [],
                    backgroundColor: 'royalblue',  // Navy
                    borderColor: 'royalblue',
                    borderWidth: 1
                }, {
                    label: 'Business Consultancy',
                    data: [],
                    backgroundColor: 'navy',  // Teal
                    borderColor: 'navy',
                    borderWidth: 1
                }, {
                    label: 'Others',
                    data: [],
                    backgroundColor: 'skyblue',  // Royal Blue
                    borderColor: 'skyblue',
                    borderWidth: 1
                }]
            };

            const dateMap = {};

            bookings.forEach(booking => {
                const date = booking.date;
                const sessionType = booking.session_type;

                if (!dateMap[date]) {
                    dateMap[date] = { 'Leadership Workshop': 0, 'Staff Training': 0, 'Business Consultancy': 0, 'Others': 0 };
                }

                dateMap[date][sessionType]++;
            });

            for (const date in dateMap) {
                dailyData.labels.push(date);
                dailyData.datasets[0].data.push(dateMap[date]['Leadership Workshop']);
                dailyData.datasets[1].data.push(dateMap[date]['Staff Training']);
                dailyData.datasets[2].data.push(dateMap[date]['Business Consultancy']);
                dailyData.datasets[3].data.push(dateMap[date]['Others']);
            }

            return dailyData;
        }

        async function updateChart() {
            const timePeriod = document.getElementById('timePeriod').value;
            const bookings = await fetchBookingData();
            const dailyData = await processBookingData(bookings);

            if (chartInstance) {
                chartInstance.destroy();
            }

            const ctx = document.getElementById('bookingChart').getContext('2d');
            chartInstance = new Chart(ctx, {
                type: 'bar',
                data: dailyData,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        window.onload = function() {
            updateChart();
        };
    </script>
</body>
</html>
