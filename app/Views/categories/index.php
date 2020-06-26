<html>

<head>
  <title>Codeigniter Live Table Add Edit Delete using Ajax</title>



  <?= csrf_meta() ?>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link rel="stylesheet" href="/css/app.css">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
  <?php $ds = DIRECTORY_SEPARATOR; ?>

</head>

<body>

  <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
      <a class="navbar-brand" href="#">
        categories
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav mr-auto">

        </ul>

      </div>
    </div>
  </nav>

  <main class="py-4">

    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">Categories


              <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal">
                Add New
              </button> </div>

            <div class="card-body">
              <table class="table  d-table table-responsive table-striped table-bordered">
                <thead>
                  <tr>
                    <th>title</th>
                    <th>category</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody id="catgories-body">
                  <?php foreach ($categories as $category) : ?>
                    <tr id="category-<?= $category->id ?>">
                      <td><?= $category->title ?></td>
                      <td><?= $category->parent_title ?></td>
                      <td>
                        <div class="row">
                          <a href="/categories/<?= $category->id; ?>/edit" onclick="getCategory('/categories/<?= $category->id; ?>/edit')" class="btn btn-info text-white px-2 mx-2"> edit</a>
                          <a href="/categories/<?= $category->id; ?>" class="btn btn-primary px-2 mx-2" onclick="getCategory('/categories/<?= $category->id; ?>')"> show</a>
                          <a href="/categories/<?= $category->id; ?>/delete" class="btn btn-danger  px-2 mx-2" onclick="destroy('/categories/<?= $category->id; ?>/delete',<?= $category->id; ?>)"> delete </a>
                        </div>

                      </td>
                    </tr>
                  <?php endforeach ?>

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>


  </main>

  <!-- Create -->
  <?php unset($category) ?>
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <?php include(APPPATH . "Views{$ds}categories{$ds}partials{$ds}_create.php") ?>
  </div>
  <!-- Edit -->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">


  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>


  <script src="/script.js"></script>

  </script>


</body>

</html>