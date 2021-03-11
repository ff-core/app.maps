<!doctype html>
<html lang="en" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.80.0">
    <title>Sticky Footer Navbar Template · Bootstrap v5.0</title>

    <!-- Bootstrap core CSS -->
    <link href="<?= base_url("/assets/css/bootstrap.min.css") ?>" rel="stylesheet">    
    <!-- Custom styles for this template -->
    <link href="<?= base_url("/assets/css/sticky-footer-navbar.css") ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url("/assets/css/leaflet.css") ?>" />
    <style>
      #myMap { width: 800px; height: 400px;}
    </style>
  </head>
  <body class="d-flex flex-column h-100">
  
<header>
  <!-- Fixed navbar -->
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Fixed navbar</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
          </li>
        </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>
</header>

<!-- Begin page content -->
<main class="flex-shrink-0">
  <div class="container">
    <h1 class="mt-5">App de Mapa</h1>
    
    <?= \Config\Services::validation()->listErrors() ?>
    <?= form_open('Home/reverse'); ?>
      <div class="mb-3">
        <?= form_label('Latidute', 'lat'); ?>
        <?= form_input(['type' => 'text', 'class' => 'form-control', 'id' => 'lat', 'name' => 'lat', 'value' => '']); ?>
      </div>
      <div class="mb-3">
        <?= form_label('Longitude', 'lon'); ?>
        <?= form_input(['type' => 'text', 'class' => 'form-control', 'id' => 'lon', 'name' => 'lon', 'value' => '']); ?>
      </div>
      <button type="submit" class="btn btn-primary">Pesquisar</button>
    </form>

    <div id="myMap" class="mt-4"></div>
    <?php 
      if (isset($map)){
        echo "<h5>".(isset($map['address']['country']) ? $map['address']['country'] : '')."</h5>";
        echo "<h6>".
            (isset($map['address']['road']) ? $map['address']['road'] : '').
            ", ".(isset($map['address']['suburb']) ? $map['address']['suburb'] : '').
            ", ".(isset($map['address']['city']) ? $map['address']['city'] : '').
            " - ".(isset($map['address']['state']) ? $map['address']['state'] : '').
            " - ".(isset($map['address']['postcode']) ? $map['address']['postcode'] : '').
            "</h6>";
      }
    ?>

  </div>

</main>

<footer class="footer mt-auto py-3 bg-light">
  <div class="container">
    <span class="text-muted">Place sticky footer content here.</span>
  </div>
</footer>

    <script>
      const lat = '<?= $lat == '' ? '-21.1709915618499' : $lat ?>';
      const lon = '<?= $lon == '' ? '-47.81417478366368' : $lon ?>';
    </script>
    <script src="<?= base_url("/assets/js/bootstrap.bundle.min.js") ?>"></script>
    <script src="<?= base_url("/assets/js/leaflet.js") ?>"></script>
    <script src="<?= base_url("/assets/js/maps.js") ?>"></script>

  </body>
</html>
