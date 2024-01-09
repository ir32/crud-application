<!DOCTYPE html>
<html>
<head>
    <title>Display JSON Data in Form - CodeIgniter 3</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>JSON Data Form</h2>
        <form method="post" action="<?php echo base_url('post/process_form_submission/'); ?>">
            <?php
            $json_array = json_decode($json_data, true);

            function createFormFields($data, $prefix = '') {
                foreach ($data as $key => $value) {
                    if (is_array($value)) {
                        createFormFields($value, $prefix . $key . '_');
                    } else {
                        echo '<div class="form-group">';
                        echo '<label for="' . $prefix . $key . '">' . ucfirst($key) . '</label>';
                        echo '<input type="text" class="form-control" id="' . $prefix . $key . '" name="' . $prefix . $key . '" value="' . $value . '">';
                        echo '</div>';
                    }
                }
            }

            createFormFields($json_array);
            ?>

            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
