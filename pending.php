

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include 'navigationbar.php'; ?>

    <h1> Pending Reservations </h1>
    <div class="container">
        <?php 
        if (!empty($_SESSION) && $_SESSION['role'] == 'landlord') {
            $hname = $_SESSION['hname'];
            $query = "SELECT * FROM reservation WHERE hname = '$hname' AND res_stat = 'Pending' ORDER BY id ASC";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
        ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Guest Name</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Room No</th>
                        <th>Capacity</th>
                        <th>Status</th>
                        <th>Date In</th>
                        <th>Date Out</th>
                        <th>Duration</th>
                        <th>Reason</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    while ($fetch = mysqli_fetch_assoc($result)) { 
                    ?>
                    <tr>
                        <td><?php echo $fetch['id']; ?></td>
                        <td><?php echo $fetch['fname'] . ' ' . $fetch['lname']; ?></td>
                        <td><?php echo $fetch['email']; ?></td>
                        <td><?php echo $fetch['gender']; ?></td>
                        <td><?php echo $fetch['room_no']; ?></td>
                        <td><?php echo $fetch['capacity']; ?></td>
                        <td><?php echo $fetch['status']; ?></td>
                        <td><?php echo $fetch['date_in']; ?></td>
                        <td><?php echo $fetch['date_out']; ?></td>
                        <td><?php echo $fetch['res_duration']; ?></td>
                        <td><?php echo $fetch['res_reason']; ?></td>
                        <td>
                            <?php if ($fetch['res_stat'] == 'Pending'): ?>
                                <a href="php/function.php?approve=<?php echo $fetch['id']; ?>" class="btn btn-success btn-sm">Approve</a>
                                <a href="php/function.php?reject=<?php echo $fetch['id']; ?>" class="btn btn-danger btn-sm">Reject</a>
                            <?php else: ?>
                                <button class="btn btn-secondary btn-sm" disabled>Approve</button>
                                <button class="btn btn-secondary btn-sm" disabled>Reject</button>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <?php 
            } else {
                echo "<p>No pending reservations found.</p>";
            }
        } 
        ?>
    </div>
</body>
</html>