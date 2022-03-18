<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.80.0">
    <script src="https://unpkg.com/feather-icons"></script>
    <title>UMKM PURI UTAMI</title>

    <link rel="icon" href="<?= base_url('images/icon.jpg') ?>" type="image/gif" sizes="16x16">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">

     <!-- Datatables -->
    <link href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap5.min.js"></script>

     <!-- Jquery masking -->
     <script src="<?= base_url('jquery/jquery.mask.js') ?>"></script>

    <!-- Bootstrap core CSS -->
    <link href="<?= base_url('css/bootstrap.min.css') ?>" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="<?= base_url('dashboard/dashboard.css') ?>" rel="stylesheet">

  </head>
  <body>
  <header class="navbar navbar-dark sticky-top flex-md-nowrap p-0 shadow" style="background-color:  #0099cc;" >
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 text-dark fw-bold" href="<?= base_url('umkm_puri_utami') ?>">UMKM PURI UTAMI</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <input class="form-control form-control-dark w-50 bg-light me-auto" type="text" placeholder="Search" aria-label="Search">
    <!-- <button class="btn btn-outline-primary" type="submit">Search</button> -->
        <ul class="nav justify-content-end me-5">
        <li class="nav-item">
          <a class="nav-link active text-dark" aria-current="page" href="#">Home<span class="sr-only"></span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link active text-dark" aria-current="page" href="#">Contact<span class="sr-only"></span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link active text-dark" aria-current="page" href="#">Help<span class="sr-only"></span></a>
        </li>
        </ul>
    <div class="icon mb-1 ">
    <i class="me-1 ms-1" data-feather="shopping-cart"></i>
    <i class="me-1" data-feather="mail"></i>
    <i data-feather="bell"></i>
    </div>
    <ul class="navbar-nav px-3">
      <li class="nav-item text-nowrap">
        <a class="btn btn-danger" href="#">Sign out</a>
      </li>
    </ul>
</header>
