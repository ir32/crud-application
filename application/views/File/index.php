
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .error-message {
            color: red;
        }
    </style>
</head>
<body>

<div class="container mt-4">
        <h2>JSON Data Form</h2>
        <?php
            // Decode JSON data into an associative array
            $data = json_decode($json_data, true);

            // Display form with JSON data
            foreach ($data as $key => $value) {
                echo '<div class="form-group">';
                echo '<label for="' . $key . '">' . $key . '</label>';
                echo '<input type="text" class="form-control" id="' . $key . '" name="' . $key . '" value="' . $value . '">';
                echo '</div>';
            }
        ?>
        <!-- Additional form elements or submit button if needed -->
    </div>



</body>
</html>
