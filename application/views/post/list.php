<!doctype html>
<html lang="en">

<head>
  <?php $this->load->view('includes/header'); ?>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <title>Codeigniter 3 CRUD Application</title>


</head>

<body>

  <div class="container">
    <div class="row">

      <div class="col-lg-12 my-5">
        <h2 class="text-center mb-3">Codeigniter 3 CRUD (Ajax) Application</h2>
      </div>

      <div class="col-lg-12">

        <?php echo $this->session->flashdata('message'); ?>

        <div class="d-flex justify-content-between mb-3">
          <h4>Manage Posts</h4>
          <a href="<?= base_url('post/create') ?>" class="btn btn-success"> <i class="fas fa-plus"></i> Add New Post</a>
        </div>      
      <div class="modal" id="myModal">
        <div class="modal-dialog">
          <div class="modal-content">
        
            <div class="modal-header">
              <h4 class="modal-title">View data</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>            
            <div class="modal-body">
              <div>
                <h4>Title</h4>
                <input type="text" name="" id="title">
                <h4>Discription</h4>
                 <input type="text" name="" id="Discription">

              </div>
            </div>
            
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
            
          </div>
        </div>
      </div>

        <table class="table table-bordered table-default">

          <thead class="thead-light">
            <tr>
              <th width="2%">#</th>
              <th width="25%">Title</th>
              <th width="53%">Description</th>
              <th width="20%">Action</th>
            </tr>
          </thead>

          <tbody>

            <?php $i = 1; foreach ($data as $post) { 

              // $id = $post->id;
              // print_r($id);
              ?>

              <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $post->title; ?></td>
                <td><?php echo $post->description; ?></td>

                <td>
                  <a href="<?= base_url('post/edit/' . $post->id) ?>" class="btn btn-primary"> <i class="fas fa-edit"></i> Edit </a>
                  <a href="<?= base_url('post/delete/' . $post->id) ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this record?')"> <i class="fas fa-trash"></i> Delete </a>
                  <a class="btn btn-primary" data-toggle="modal" data-target="#myModal" onclick="view_data(<?php echo $post->id; ?>)"> <i class="fas fa-eye"></i> View </a>
                </td>
              </tr>

            <?php $i++; } ?>

          </tbody>

        </table>

      </div>
    </div>
  </div>



  <?php $this->load->view('includes/footer'); ?>

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
  var base_url_data = "<?php echo base_url(); ?>";
  function view_data(id) {
    console.log(id);
    $.ajax({
      type: "POST",
      url: base_url_data + "Post/view_data",
      data: {
        id: id
      },
      success: function(response) {
        var res = JSON.parse(response);
        console.log(res);
        $('#title').val(res.title);
        $('#Discription').val(res.description);
      }
    });
  }
</script>

</html>