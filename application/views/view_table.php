<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Form</title>
    <!-- Bootstrap CSS (Dark Theme) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body class="bg-dark text-light">

    <div class="container mt-5">
        <a type="button" href="<?= base_url('index.php/Event') ?>" class="btn btn-primary float-end">Add Event</a>

        <h1 class="text-center">All Events</h1>
        <div id="message" class="alert d-none"></div>

        <table class="table table-dark table-striped" border="1">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Date</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($events)) {
                    foreach ($events as $index => $event) {
                ?>
                        <tr>
                            <th scope="row"><?= $index + 1 ?></th>
                            <td><?= htmlspecialchars($event['date'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($event['title'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($event['description'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><a class="btn btn-warning float-end" href="<?= base_url('index.php/Event/edit_event?id=' . $event['id']); ?>">Update</a></td>
                            <td><a class="btn btn-danger float-end" class="deleteEvent" data-id="<?= $event['id']; ?>">Delete</a></td>
                        </tr>
                    <?php

                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="4" class="text-center">No events found</td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $('.deleteEvent').on('click', function() {

            var id = $('#deleteEvent').data('id');;

            $.ajax({
                url: "<?= site_url('index.php/Event/softdelEvent'); ?>",
                type: "POST",
                data: id,
                dataType: "json",
                success: function(response) {
                    console.log(response);
                },
                error: function(res) {
                    console.error(res);
                }
            });
        })
    </script>
</body>

</html>