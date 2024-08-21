<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #000; /* Light grey background */
            color: #333; /* Dark grey text */
            margin: 0;
            padding: 0;
        }

        h1 {
            background-color: #55e6a5; /* Green header background */
            color: #fff; /* White text */
            padding: 20px;
            text-align: center;
            margin: 0;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff; /* White background for the table */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd; /* Light grey border */
        }

        th {
            background-color: #55e6a5; /* Green background for header cells */
            color: #fff; /* White text in header cells */
            text-align: left;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9; /* Alternating row color */
        }

        tr:hover {
            background-color: #f1f1f1; /* Highlight row on hover */
        }

        .table-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .error {
            color: #e74c3c; /* Red color for error messages */
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Admin Panel</h1>
    <div class="table-container">
        <table id="contactsTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Message</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data will be injected here by JavaScript -->
            </tbody>
        </table>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            fetch('./fetch.php')
                .then(response => response.json())
                .then(data => {
                    const tableBody = document.querySelector('#contactsTable tbody');
                    tableBody.innerHTML = ''; // Clear existing rows

                    data.forEach(contact => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${contact.id}</td>
                            <td>${contact.name}</td>
                            <td>${contact.email}</td>
                            <td>${contact.phone}</td>
                            <td>${contact.message}</td>
                            <td>${new Date(contact.created_at).toLocaleString()}</td>
                        `;
                        tableBody.appendChild(row);
                    });
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                    const tableBody = document.querySelector('#contactsTable tbody');
                    tableBody.innerHTML = `<tr><td colspan="6" class="error">Error fetching data. Please try again later.</td></tr>`;
                });
        });
    </script>
</body>
</html>
