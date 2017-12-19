window.chartColors = {
  red: 'rgb(255, 99, 132)',
  orange: 'rgb(255, 159, 64)',
  yellow: 'rgb(255, 205, 86)',
  green: 'rgb(75, 192, 192)',
  blue: 'rgb(54, 162, 235)',
  purple: 'rgb(153, 102, 255)',
  grey: 'rgb(201, 203, 207)'
};
var generalOptions = {
    responsive: true,
    title:{
        display:true,
        text:''
    },
    tooltips: {
        mode: 'index',
        intersect: false,
    },
    hover: {
        mode: 'nearest',
        intersect: true
    },
    scales: {
        xAxes: [{
            display: true,
            scaleLabel: {
                display: true,
                labelString: 'Date'
            }
        }],
        yAxes: [{
            display: true,
            scaleLabel: {
                display: true,
                labelString: 'Value on MXN'
            }
        }]
    }
};
var config = {
    type: 'line',
    data: {
        labels: btnLabels,
        datasets: [{
            label: "Aventura Bitcoin",
            backgroundColor: window.chartColors.blue,
            borderColor: window.chartColors.blue,
            data: btnData,
            fill: false,
        }]
    },
    options: generalOptions
};

var configrpl = {
    type: 'line',
    data: {
        labels: xrpLabels,
        datasets: [{
            label: "Aventura Ripple",
            backgroundColor: window.chartColors.yellow,
            borderColor: window.chartColors.yellow,
            data: xrpData,
            fill: false,
        }]
    },
    options: generalOptions
};

window.onload = function() {
    var ctx = document.getElementById("canvas").getContext("2d");
    window.myLine = new Chart(ctx, config);

    var ctxrpl = document.getElementById("canvas2").getContext("2d");
    window.myLine2 = new Chart(ctxrpl, configrpl);
};

function addData(chart, label, data) {
    chart.data.labels.push(label);
    chart.data.datasets.forEach((dataset) => {
        dataset.data.push(data);
    });
    chart.update();
}
