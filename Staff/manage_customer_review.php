<?php
require '../Db/connection.php'; 
include './Staff_header.php';

function fetchDataAndDisplayTable()
{
    try {

        $connectionObj = new connection();
        $conn = $connectionObj->getConnection();
        $sql = "SELECT * FROM feedback";
        $stmt = $conn->query($sql);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($rows) {
            echo "<table class='table' border='1'>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Comment</th>
                        <th>Rating</th>
                        <th>Action</th>
                    </tr>";
            foreach ($rows as $row) {
                echo "<tr>
                        <td>{$row['name']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['comment']}</td>
                        <td>{$row['rating']}</td>
                        <td>
                            <form method='post' action='./review_delete.php'> <!-- Create a separate PHP file for deletion -->
                                <input type='hidden' name='id' value='{$row['id']}'> <!-- Assuming 'id' is the primary key -->
                                <button type='submit' name='delete'>Delete</button>
                            </form>
                        </td>
                    </tr>";
            }

            echo "</table>";
        } else {
            echo "No records found";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        $conn = null;
    }
}


fetchDataAndDisplayTable();
?>
</body>
</html>
