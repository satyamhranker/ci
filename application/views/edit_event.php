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
        <a type="button" href="<?= base_url('index.php/Event/View') ?>" class="btn btn-primary float-end">View Table</a>
        <h1 class="text-center">Edit Event</h1>
        <div id="message" class="alert d-none"></div>

        <!-- Event Form -->
        <form id="eventForm">
            <div class="mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" class="form-control" id="date" name="date" required>
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Event Title" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" placeholder="Event Description" required></textarea>
            </div>
            <button type="button" id="saveEvent" class="btn btn-primary">Save Event</button>
        </form>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            // Handle the Save button click
            $('#saveEvent').on('click', function() {
                // Collect form data
                var formData = {
                    date: $('#date').val(),
                    title: $('#title').val(),
                    description: $('#description').val()
                };

                // Make the AJAX call
                $.ajax({
                    url: "<?= site_url('index.php/Event/save'); ?>",
                    type: "POST",
                    data: formData,
                    dataType: "json",
                    success: function(response) {
                        $('#message').removeClass('d-none').addClass(response.status ? 'alert-success' : 'alert-danger');
                        $('#message').text(response.message);

                        // Reset the form if successful
                        if (response.status) {
                            $('#eventForm')[0].reset();
                        }
                    },
                    error: function() {
                        $('#message').removeClass('d-none').addClass('alert-danger');
                        $('#message').text('An error occurred while saving the event.');
                    }
                });
            });
        });
    </script>

</body>

</html>