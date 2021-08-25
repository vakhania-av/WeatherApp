<?php 

error_reporting(E_ERROR | E_PARSE);

$weather = '';
$error = '';

if ( isset($_GET['city']) ) {
  $url_content = file_get_contents('https://api.openweathermap.org/data/2.5/weather?q=' . $_GET['city'] . '&units=metric&appid=ed594d315935d32f1121b6bf7d5ede6c');

  $forecast_array  = json_decode($url_content, true);

  if ($forecast_array['cod'] == 200) {
    $weather = 'Actually the weather is: ' . $forecast_array['weather'][0]['description'];
    $weather = $weather . '. The temperature is ' . $forecast_array['main']['temp'] . ' &#8451;' . ". The wind's speed is: " . $forecast_array['wind']['speed'] . ' m/sec.';
  } else {
    $error = 'The city name is incorrect. Please, try another name!';
  }

  
}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Weather App</title>
  </head>
  <body>
    <div class="container" id="mainDiv">
      <h1>
        <?php 
        if ($weather) {
          echo 'Weather in ' . $_GET['city'];
        } else {
          echo 'Weather in the city';
        }
        ?>
      </h1>

      <form>
        <div class="mb-3">
          <label for="city">Input a city name</label>
          <input class="form-control" id="city" name="city" aria-describedby="Forecast city" placeholder="Enter city name...">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>

    <div id="forecastDiv">
        <?php 

        if ($weather) {
          echo '<div class="alert alert-primary" role="alert">' .  $weather . '</div>';
        } else if ($error) {
          echo '<div class="alert alert-danger" role="alert">' .  $error . '</div>';
        }

         ?>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
    -->
  </body>
</html>
