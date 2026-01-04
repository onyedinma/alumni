// Replace the hex codes below with colors from your website
function getColorByIndex(index) {
    const colors = [
        '#cdef84', // Light green, example placeholder
        '#1b1c17', // Coral, example placeholder
        '#008ffbd9', // Dark blue, example placeholder
        '#7f56d9', // Purple, example placeholder
        '#feb019', // Light red, example placeholder
        '#e655d6', // Pink, example placeholder
        '#e6d455', // Yellow, example placeholder
        '#5596e6', // Light blue, for example, replace with your site's light blue
        '#55e6e2', // Cyan, example placeholder
        // Add more colors as needed, ensuring they complement your site's scheme
    ];
    return colors[index % colors.length];
}
// Assign a color to each product based on its name
var productData = JSON.parse($('#monthlyOrderSummaryData').val());

// Assign a color to each product based on its index
var colors = productData.map(function(product, index) {
    return getColorByIndex(index);
});

var options = {
    series: productData,
    colors: colors,

    chart: {
        type: 'bar',
        height: 400,
        stacked: true,
        toolbar: {
            show: true
        },
        zoom: {
            enabled: true
        }
    },
    responsive: [{
        breakpoint: 480,
        options: {
            legend: {
                position: 'bottom',
                offsetX: -10,
                offsetY: 0
            }
        }
    }],
    plotOptions: {
        bar: {
            horizontal: false,
            borderRadius: 10,
            columnWidth: '40%',
            dataLabels: {
                total: {
                    enabled: true,
                    style: {
                        fontSize: '13px',
                        fontWeight: 900
                    }
                }
            }
        },
    },
    tooltip: {
        y: {
            formatter: function (val) {
                return parseInt(val); // Convert the value to an integer for the tooltip
            }
        }
    },
    xaxis: {
        type: 'string',
        categories: JSON.parse($('#monthlyOrderSummaryCategory').val())
    },
    legend: {
        position: 'right',
        offsetY: 40
    },
    fill: {
        opacity: 1
    }
};

var chart = new ApexCharts(document.querySelector("#monthlyOrderSummary"), options);
chart.render();
