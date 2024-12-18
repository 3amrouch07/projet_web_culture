<?php
include '../../controller/signupcontroller.php';
$signupcontroller = new signup();

// Get the total count of users by role
$stats = $signupcontroller->getRoleStatistics();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../frontoffice/css/statistics.css">
    <title>Statistiques des utilisateurs</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Include Chart.js -->
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f9;
    color: #333;
    text-align: center;
}

h1 {
    color: #555;
}

table {
    width: 50%;
    margin: 20px auto;
    border-collapse: collapse;
}

table th, table td {
    padding: 12px;
    border: 1px solid #ddd;
}

table th {
    background-color: #f4b41a;
    color: white;
}

table tr:nth-child(even) {
    background-color: #f9f9f9;
}

canvas {
    display: block;
    margin: 20px auto;
}

    </style>
</head>
<body>
    <h1>Statistiques des utilisateurs</h1>

    <!-- Table of Role Statistics -->
    

    <h2>Visualisation des statistiques</h2>

    <!-- Chart Container -->
    <canvas id="roleChart" width="400" height="200"></canvas>

    <script>
        // Prepare the data for the Chart.js
        const ctx = document.getElementById('roleChart').getContext('2d');
        const roleLabels = <?= json_encode(array_keys($stats)); ?>; // Roles as labels (Admin, Client, etc.)
        const roleCounts = <?= json_encode(array_values($stats)); ?>; // Number of users for each role

        const roleChart = new Chart(ctx, {
            type: 'pie', // You can change to 'bar', 'line', etc.
            data: {
                labels: roleLabels,
                datasets: [{
                    label: 'Nombre d\'utilisateurs',
                    data: roleCounts,
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0'], // Custom colors
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'pie',
                    },
                    title: {
                        display: true,
                        text: 'Répartition des utilisateurs par rôle'
                    }
                }
            }
        });
    </script>

</body>
</html>
