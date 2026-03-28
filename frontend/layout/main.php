<!doctype html>
<html lang="en">

<head>
  <?php include __DIR__ . '/header.php'; ?>
</head>

<body>
  <script src="./assets/js/tabler-theme.min.js"></script>
  <div class="page">

    <?php include __DIR__ . '/sidebar.php'; ?>

    <div class="page-wrapper">

      <?php include $content; ?>

      <?php include __DIR__ . '/footer.php'; ?>

    </div>

  </div>

  <?php include __DIR__ . '/settings.php'; ?>

  <?php include __DIR__ . '/script.php'; ?>

  <script src="./assets/js/apexcharts.min.js"></script>
  <script src="./assets/js/jsvectormap.min.js"></script>
  <script src="./assets/js/world.js"></script>
  <script src="./assets/js/world-merc.js"></script>
  <script src="./assets/js/tabler.min.js"></script>
  <script src="./assets/js/demo.min.js"></script>
  <script src="./assets/js/banner.js"></script>

</body>

</html>