<!DOCTYPE html>
<html>
<head>
    <title>Visitor Graph</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
</head>
<body>
    <canvas id="visitorChart" width="800" height="400"></canvas>

    <?php
    // Your PHP code to get visitor data from the database
    // Example data
    $visitorData = [
        ['date' => '2024-04-01', 'subscribers' => 100],
        ['date' => '2024-04-02', 'subscribers' => 150],
        ['date' => '2024-04-03', 'subscribers' => 50],
        ['date' => '2024-04-03', 'subscribers' => 250],
        ['date' => '2024-04-03', 'subscribers' => 80],
        // Add more data here
    ];
    ?>

    <script>
        // JavaScript code to create the chart
        var visitorData = <?php echo json_encode($visitorData); ?>;

        var dates = visitorData.map(data => data.date);
        var subscribers = visitorData.map(data => data.subscribers);

        var ctx = document.getElementById('visitorChart').getContext('2d');
        var visitorChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: dates,
                datasets: [{
                    label: 'subscribers',
                    data: subscribers,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
</body>
</html>



