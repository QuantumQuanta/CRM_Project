<!DOCTYPE html>
<html>

<head>
    <title>Table Example</title>
    <link rel="stylesheet" href="../stylesheet/ceojointables.css">
</head>

<body>
    <?php
    date_default_timezone_set('Asia/Kolkata');
    $date = date("g:i A d.m.y "); //dS F Y, g:i A
    ?>
    <!-- <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>First Response</th>
                <th>Comment 1</th>
                <th>Second Response</th>
                <th>Comment 2</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Connect to MySQL database using object-oriented mysqli
            $mysqli = new mysqli("localhost", "Subham", "Subham@123@", "crm");

            // Check connection
            if ($mysqli->connect_error) die("Connection failed: " . $mysqli->connect_error);

            // Prepare a SELECT statement to retrieve data from both tables joined by uniq_id
            $stmt = $mysqli->prepare("SELECT u.uniq_id, u.second_resp, u.comment_2, p.firstst_resp, p.comment_1 FROM 2ndresp_input_data AS u LEFT JOIN pro_input_data AS p ON u.uniq_id = p.uniq_id WHERE u.uniq_id = '1' OR p.uniq_id = '1'");

            $stmt->execute();

            // Bind result variables
            $stmt->bind_result($uniq_id, $second_resp, $comment_2, $firstst_resp, $comment_1);

            // Fetch and process the data
            while ($stmt->fetch()) {
                // Output each row to the table
                echo "<tr>
                    <td>$uniq_id</td>
                    <td>$firstst_resp</td>
                    <td>$comment_1</td>
                    <td>$second_resp</td>
                    <td>$comment_2</td>
                </tr>";
            }

            // Close statement and database connection
            $stmt->close();
            $mysqli->close();
            ?>
        </tbody>
    </table> -->

    <h3>Respondant Data</h3>
    <div id="offcanvas_tables2">
        <table>
            <thead>
                <tr>
                    <th><input type="checkbox" class="toggle-col" data-column="0" checked> D&T-1</th>
                    <th>D&T-2</th>
                    <th><input type="checkbox" class="toggle-col" data-column="1" checked> Contacted Us</th>
                    <th><input type="checkbox" class="toggle-col" data-column="2" checked> KYC</th>
                    <!-- Add checkboxes for other columns -->
                    <th id="PCR_prio">(PCR) Priority</th>
                    <th id="PCR_ET">(PCR) E.T</th>
                    <th id="Call-Type">Call Type</th>
                    <th id="Call_Status">Call Status</th>
                    <th id="comment1">1st-Resp Comments</th>
                    <th id="ClientStatus-1">Client Status-1</th>
                    <th id="PCR_Resp">(PCR) Resp.-1</th>
                    <th id="PCR_pt">(PCR) P.T-1</th>
                    <th id="comment2">Comment-2</th>
                    <th>Client Status-2</th>
                    <th>(PCR)-Resp.-2</th>
                    <th>(PCR)-P.T-2</th>
                    <th>(PCR)-P.R.C.</th>
                    <th>Client Rating-2</th>
                </tr>
            </thead>
            <tbody>
                <?php

                // Connect to MySQL database using object-oriented mysqli
                $mysqli = new mysqli("localhost", "Subham", "Subham@123@", "testing");
                // Check connection
                if ($mysqli->connect_error) die("Connection failed: " . $mysqli->connect_error);
                // Prepare a SELECT statement to retrieve data from both tables joined by uniq_id
                $query = "SELECT u.date_time, u.contacted_us, u.kyc_stat, u.pcr_priority, u.pcr_et, u.call_type, u.call_stat, u.comment_1, u.client_stat_1, u.pcr_resp_1, u.pcr_pt_1, p.date_time_2, p.comment_2, p.client_stat_2, p.pcr_resp_2, p.pcr_pt_2, p.pcr_prc, p.client_rating_2 FROM 2ndresp_input_data AS p LEFT JOIN pro_input_data AS u ON u.uniq_id='1' OR p.uniq_id='1' ORDER BY  u.date_time DESC";
                $stmt = $mysqli->prepare($query);
                // $stmt->bind_param('ss', $client_id_val, $client_id_val);
                $stmt->execute();

                // Bind result variables
                $stmt->bind_result(
                    $date_time,
                    $contacted_us,
                    $kyc_stat,
                    $pcr_priority,
                    $pcr_et,
                    $call_type,
                    $call_stat,
                    $comment_1,
                    $client_stat_1,
                    $pcr_resp_1,
                    $pcr_pt_1,
                    $date_time_2,
                    $comment_2,
                    $client_stat_2,
                    $pcr_resp_2,
                    $pcr_pt_2,
                    $pcr_prc,
                    $client_rating_2
                );

                while ($stmt->fetch()) {
                    echo "<tr>
                        <td>$date</td>
                        <td>$date</td>
                        <td>$contacted_us</td>
                        <td>$kyc_stat </td>
                        <td>$pcr_priority </td>
                        <td>$pcr_et </td>
                        <td>$call_type </td>
                        <td>$call_stat </td>
                        <td>$comment_1 </td>
                        <td>$client_stat_1 </td>
                        <td>$pcr_resp_1 </td>
                        <td>$pcr_pt_1 </td>                        
                        <td>$comment_2 </td>
                        <td>$client_stat_2 </td>
                        <td>$pcr_resp_2 </td>
                        <td>$pcr_pt_2 </td>
                        <td>$pcr_prc </td>
                        <td>$client_rating_2</td>
                        </tr>";
                }
                // Close statement and database connection
                $stmt->close();
                $mysqli->close();
                ?>
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function() {
            $('.toggle-col').change(function() {
                var index = $(this).data('column');
                $('table td:nth-child(' + (index + 1) + '), table th:nth-child(' + (index + 1) + ')').toggle();
            });
        });
    </script>

</body>

</html>



<!-- SELECT
u.date_time,
p.date_time_2,
u.contacted_us,
u.kyc_stat,
u.pcr_priority,
u.pcr_et,
u.call_type,
u.call_stat,
u.comment_1,
u.client_stat_1,
u.pcr_resp_1,
u.pcr_pt_1,
p.comment_2,
p.client_stat_2,
p.pcr_resp_2,
p.pcr_pt_2,
p.pcr_prc,
p.client_rating_2
FROM
2ndresp_input_data AS p
LEFT JOIN pro_input_data AS u ON u.uniq_id=p.uniq_id
WHERE
u.uniq_id='1' OR p.uniq_id='1'
ORDER BY
u.date_time DESC



while ($stmt->fetch()) {
echo "<tr>
    <td>$date_time</td>
    <td>$date_time_2 </td>
    <td>$contacted_us</td>
    <td>$kyc_stat </td>
    <td>$pcr_priority </td>
    <td>$pcr_et </td>
    <td>$call_type </td>
    <td>$call_stat </td>
    <td>$comment_1 </td>
    <td>$client_stat_1 </td>
    <td>$pcr_resp_1 </td>
    <td>$pcr_pt_1 </td>
    <td>$comment_2 </td>
    <td>$client_stat_2 </td>
    <td>$pcr_resp_2 </td>
    <td>$pcr_pt_2 </td>
    <td>$pcr_prc </td>
    <td>$client_rating_2</td>
</tr>";
} -->