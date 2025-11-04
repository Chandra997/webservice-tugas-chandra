<?php
function render_table($title, $columns, $table) {
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Data <?= $title ?></title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-light">

<div class="container py-4">
  <h2 class="mb-3">Data <?= $title ?></h2>
  <table class="table table-bordered table-striped">
    <thead class="table-dark">
      <tr>
        <?php foreach ($columns as $col) echo "<th>$col</th>"; ?>
      </tr>
    </thead>
    <tbody id="data-body"></tbody>
  </table>
  <a href="index.php" class="btn btn-secondary">⬅ Kembali</a>
</div>

<script>
$(document).ready(function(){
  $.getJSON("../api/api.php?table=<?= $table ?>", function(data){
    let rows = "";
    $.each(data, function(i, item){
      rows += "<tr>";
      $.each(item, function(key, value){
        rows += "<td>"+value+"</td>";
      });
      rows += "</tr>";
    });
    $("#data-body").html(rows);
  }).fail(function(){
    alert("Gagal memuat data <?= $title ?>. Pastikan API aktif.");
  });
});
</script>

</body>
</html>
<?php } ?>
