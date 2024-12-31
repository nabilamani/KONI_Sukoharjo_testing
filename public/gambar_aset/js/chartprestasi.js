// Achievement chart script
var chartData = @json($chartData);

// Prepare data for the chart
var categories = Object.keys(chartData); // Sport categories
var seriesData = [{
        name: 'Juara 1',
        data: []
    },
    {
        name: 'Juara 2',
        data: []
    },
    {
        name: 'Juara 3',
        data: []
    }
];

// Iterate over the sport categories and fill the series data
categories.forEach(function(category) {
    var rankData = chartData[category];

    seriesData[0].data.push(rankData['Juara 1']);
    seriesData[1].data.push(rankData['Juara 2']);
    seriesData[2].data.push(rankData['Juara 3']);
});

// Configure the chart
var options = {
    chart: {
        type: 'bar',
        height: 350
    },
    title: {
        text: 'Jumlah Prestasi per Kategori Olahraga', // Title for the chart
        align: 'center', // Align the title to the center
        style: {
            fontSize: '16px', // Font size of the title
            fontWeight: 'bold', // Font weight of the title
            fontFamily: 'Arial, sans-serif' // Font family of the title
        }
    },
    plotOptions: {
        bar: {
            columnWidth: '40%',
            horizontal: false,
        }
    },
    xaxis: {
        categories: categories, // Display sport categories on the x-axis
    },
    yaxis: {
        title: {
            text: 'Jumlah Prestasi'
        }
    },
    series: seriesData
};

// Render the chart
var chart = new ApexCharts(document.querySelector("#achievement-chart"), options);
chart.render();

// Region chart script
var regionData = @json($regionData);

// Prepare data for the pie chart
var pieSeries = [];
var pieLabels = [];

regionData.forEach(function(item) {
    pieSeries.push(item.total); // Total achievements for each region_level
    pieLabels.push(item.region_level); // Region levels
});

// Configure the pie chart
var pieOptions = {
    chart: {
        type: 'pie',
        height: 350
    },
    title: {
        text: 'Jumlah Prestasi per Tingkat Wilayah',
        align: 'center',
        style: {
            fontSize: '16px',
            fontWeight: 'bold',
            fontFamily: 'Arial, sans-serif'
        }
    },
    labels: pieLabels, // Region labels
    series: pieSeries, // Data for the pie chart
    tooltip: {
        y: {
            formatter: function(val) {
                return val + ' Prestasi';
            }
        }
    }
};

// Render the pie chart
var pieChart = new ApexCharts(document.querySelector("#region-chart"), pieOptions);
pieChart.render();
