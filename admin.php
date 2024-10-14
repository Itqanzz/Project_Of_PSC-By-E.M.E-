<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Management</title>
    <link rel="stylesheet" href="admin.css">
    <script>
        function clearTable() {
            var table = document.querySelector('table'); // Get the table element
            var rowCount = table.rows.length;

            // Remove all rows except the first one (header row)
            for (var i = rowCount - 1; i > 0; i--) {
                table.deleteRow(i);
            }

            // Show message if no payments found
            var messageRow = table.insertRow(1); // Insert row below header
            var messageCell = messageRow.insertCell(0);
            messageCell.colSpan = 8;
            messageCell.textContent = "No payments found";
        }
    </script>
</head>
<body>
    <h2>Payments Management</h2>
    <a href="index.html">Back</a>
    <button onclick="clearTable()">Clear</button>
    <table>
        <tr>
            <th>No.</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Card Number</th>
            <th>Expiry Month</th>
            <th>Expiry Year</th>
            <th>CVV</th>
        </tr>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "EME";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT name, phone, address, card_number, expiry_month, expiry_year, cvv FROM payments";
        $result = $conn->query($sql);

        if (!$result) {
            die("Query failed: " . $conn->error);
        }
        $serialNumber = 1;

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$serialNumber."</td>";
                echo "<td>".$row["name"]."</td>";
                echo "<td>".$row["phone"]."</td>";
                echo "<td>".$row["address"]."</td>";
                echo "<td>".$row["card_number"]."</td>";
                echo "<td>".$row["expiry_month"]."</td>";
                echo "<td>".$row["expiry_year"]."</td>";
                echo "<td>".$row["cvv"]."</td>";
                echo "</tr>";
                $serialNumber++;
            }
        } else {
            echo "<tr><td colspan='8'>No payments found</td></tr>";
        }
        $conn->close();
    ?>
    </table>
</body>
</html>
