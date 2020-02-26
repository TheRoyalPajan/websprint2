<!DOCTYPE html>
<html>
<head>
    <title>jakbylo.cz</title>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.js" integrity="sha256-nZaxPHA2uAaquixjSDX19TmIlbRNCOrf5HO1oHl5p70=" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <div class="inner-header flex">
            <h1>jakbylo.cz</h1>
        </div>
        <div style="margin-bottom: 10px;">
            <svg class="wave" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 280"><path fill="#ffffff" fill-opacity="1" d="M0,224L80,240C160,256,320,288,480,266.7C640,245,800,171,960,144C1120,117,1280,139,1360,149.3L1440,160L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z"></path></svg>
        </div>
    </header>

    <canvas id="bar-chart" width="800px" height="400px"></canvas>
    <script>

var labels = [];
var data = [];

fetch('php/getAverageTemp.php')
  .then((response) => {
    return response.json();
  })
  .then((myJson) => {
    console.log(myJson);
    myJson.forEach((item) => {
        console.log(item.rok);
        labels.push(item.rok);
        data.push(parseInt(item.teplota));

    });

        new Chart(document.getElementById("bar-chart"), {
    type: 'bar',
    data: {
      labels: labels,
      datasets: [
        {
          label: "Teplot",
          backgroundColor: "#3e95cd",
          data: data
        }
      ]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
              beginAtZero: true
          }
        }]
      },
      legend: {
          display: false
        },
      title: {
        display: true,
        text: 'Průměrná teplota v tvé oblasti'
      }
    }
});
});
    </script>
</body>
</html>