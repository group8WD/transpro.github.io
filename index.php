
<?php
$conn = new mysqli("localhost", "root", "", "transpro");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$cities = [];
$sql = "SELECT DISTINCT fromLocation AS city FROM routes UNION SELECT DISTINCT toLocation AS city FROM routes";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cities[] = $row['city'];
    }
}
$conn->close();
?>

<?php include 'inc/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TransPro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f0f0;
        }
        .nav-link {
            color: #333 !important;
        }
        .transport-btn {
            background-color: #d3d3d3;
            border: none;
            margin: 5px;
            padding: 10px 20px;
            border-radius: 8px;
            box-shadow: 1px 1px 3px rgba(0,0,0,0.1);
        }
        .panel {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand ms-3" href="#"><strong>TransPro</strong></a>
  <div class="collapse navbar-collapse">
    <ul class="navbar-nav ms-auto me-3">
      <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
      <li class="nav-item"><a class="nav-link" href="#">Live Status</a></li>
      <li class="nav-item"><a class="nav-link" href="#">Plan Trip</a></li>
      <li class="nav-item"><a class="nav-link" href="#">Map</a></li>
      <li class="nav-item"><a class="nav-link" href="#">Reports</a></li>
      <li class="nav-item"><a class="nav-link" href="#">Contacts</a></li>
    </ul>
  </div>
</nav>

<div class="container text-center mt-4">
  <h4>Plan Your Route</h4>
  <div class="row justify-content-center mt-2 mb-3">
    <div class="col-md-3">
<select class="form-control" name="from">
    <option disabled selected>Select City</option>
    <?php foreach ($cities as $city): ?>
        <option value="<?= $city ?>"><?= $city ?></option>
    <?php endforeach; ?>
</select></div>
    <div class="col-md-3">
<select class="form-control" name="to">
    <option disabled selected>Select City</option>
    <?php foreach ($cities as $city): ?>
        <option value="<?= $city ?>"><?= $city ?></option>
    <?php endforeach; ?>
</select></div>
    <div class="col-md-2"><button class="btn btn-outline-secondary w-100">Get Directions</button></div>
  </div>

  <h5 class="my-3">Live Map</h5>
  <div class="panel mb-4" style="height: 200px;"></div>

  <div class="row">
    <div class="col-md-4 panel">
      <h6>Type of Transportation</h6>
      <button class="transport-btn">Bus</button>
      <button class="transport-btn">Jeepney</button>
      <button class="transport-btn">Tricycle</button>
      <button class="transport-btn">Motorcycle</button>
      <button class="transport-btn">Train</button>
    </div>
    <div class="col-md-4 panel">
      <h6>Fare Estimator</h6>
    </div>
    <div class="col-md-4 panel">
      <h6>Traffic & Service Alerts</h6>
    </div>
  </div>
</div>

</body>
</html>
