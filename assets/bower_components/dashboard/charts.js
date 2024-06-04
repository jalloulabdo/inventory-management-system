$(document).ready(function () {
  $("#dashboardMainMenu").addClass("active");
  display_data();
  $("#overlay").show();
  let topProduct = [];
  let topCustomer = [];
  var monthArr = [
    "Jan",
    "Feb",
    "Mar",
    "Apr",
    "Mar",
    "Jun",
    "Jul",
    "Aug",
    "Sep",
    "Oct",
    "Nov",
    "Dec",
  ];
  Highcharts.setOptions({ lang: { noData: "No data for you today!" } });
  let series = [];
  newData = [];
  function initializeColumnChart() {
    // Highcharts.chart("containerCol", {
    //   chart: {
    //     type: "column",
    //   },
    //   title: {
    //     text: "",
    //     align: "left",
    //   },
    //   subtitle: {
    //     text: "",
    //     align: "left",
    //   },
    //   xAxis: {
    //     categories: ["USA", "China", "Brazil", "EU", "India", "Russia"],
    //     crosshair: true,
    //     accessibility: {
    //       description: "Countries",
    //     },
    //   },
    //   yAxis: {
    //     min: 0,
    //     title: {
    //       text: "1000 metric tons (MT)",
    //     },
    //   },
    //   tooltip: {
    //     valueSuffix: " (1000 MT)",
    //   },
    //   plotOptions: {
    //     column: {
    //       pointPadding: 0.2,
    //       borderWidth: 0,
    //     },
    //   },
    //   series: [
    //     {
    //       name: "Corn",
    //       data: [406292, 260000, 107000, 68300, 27500, 14500],
    //     },
    //     {
    //       name: "Wheat",
    //       data: [51086, 136000, 5500, 141000, 107180, 77000],
    //     },
    //   ],
    // });
  }

  function initializePieChart() {
    Highcharts.chart("containerPie", {
      chart: {
        type: "variablepie",
      },
      title: {
        text: "",
        align: "left",
      },
      tooltip: {
        headerFormat: "",
        pointFormat:
          '<span style="color:{point.color}">\u25CF</span> <b> ' +
          "{point.name}</b><br/>" +
          "Quantity : <b>{point.y}</b><br/>",
      },
      series: [
        {
          minPointSize: 10,
          innerSize: "20%",
          zMin: 0,
          name: "products",
          borderRadius: 5,
          data: topProduct,
          colors: [
            "#4caefe",
            "#3dc3e8",
            "#2dd9db",
            "#1feeaf",
            "#0ff3a0",
            "#00e887",
            "#23e274",
          ],
        },
      ],
    });

    Highcharts.each(series, function (p, i) {
      newData.push([p[0] - 1, p[1]]);
    });

    Highcharts.chart("containerCol", {
      chart: {
        type: "column",
      },
      title: {
        text: "",
        align: "left",
      },
      tooltip: {
        headerFormat: "",
        pointFormat:
          '<span style="color:{point.color}">\u25CF</span> <b> ' +
          "Mount sales : $ <b>{point.y}</b><br/>",
      },
      xAxis: {
        categories: [
          "Jan",
          "Feb",
          "Mar",
          "Apr",
          "Mai",
          "Jun",
          "Jul",
          "Aug",
          "Sep",
          "Oct",
          "Nov",
          "Dec",
        ],
      },

      series: [
        {
          data: newData,
        },
      ],
    });

    Highcharts.setOptions({
      colors: Highcharts.map(Highcharts.getOptions().colors, function (color) {
        return {
          radialGradient: {
            cx: 0.5,
            cy: 0.3,
            r: 0.7,
          },
          stops: [
            [0, color],
            [1, Highcharts.color(color).brighten(-0.3).get("rgb")], // darken
          ],
        };
      }),
    });

    // Build the chart
    Highcharts.chart("containerCustomer", {
      chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: "pie",
      },
      title: {
        text: "",
        align: "left",
      },
      tooltip: {
        pointFormat: "{series.name}: <b>{point.percentage:.1f}%</b>",
      },
      accessibility: {
        point: {
          valueSuffix: "%",
        },
      },
      plotOptions: {
        pie: {
          allowPointSelect: true,
          cursor: "pointer",
          dataLabels: {
            enabled: true,
            format:
              '<span style="font-size: 1.2em"><b>{point.name}</b>' +
              "</span><br>" +
              '<span style="opacity: 0.6">{point.percentage:.1f} ' +
              "%</span>",
            connectorColor: "rgba(128,128,128,0.5)",
          },
        },
      },
      series: [
        {
          name: "Share",
          data: topCustomer,
        },
      ],
    });
  }

  function display_data() {
    let newZ = 0;
    $("#overlay").fadeIn(300);
    $.ajax({
      type: "GET",
      url: "Dashboard/displayData",
      success: function (data) {
        var response = $.parseJSON(data);
        setTimeout(function () {
          $("#overlay").fadeOut(300);
        }, 500);
        const currentMonthIndex = new Date().getMonth();

        // Array of month names
        const monthNames = [
          "January",
          "February",
          "March",
          "April",
          "May",
          "June",
          "July",
          "August",
          "September",
          "October",
          "November",
          "December",
        ];

        // Get the element by ID
        const element = document.getElementById("monthActual");

        // Set the inner HTML of the element to the current month's name
        if (element) {
          element.innerHTML = monthNames[currentMonthIndex];
        } else {
          console.error(`Element with ID "${"monthActual"}" not found.`);
        }
        $("#orderUnPaid").html(parseFloat(response.order_unpaid));
        if (response.total_unpaid) {
          $("#totalUnPaid").html(
            "$   " + parseFloat(response.total_unpaid).toFixed(2)
          );
        } else{
          $("#totalUnPaid").html(
            "$   " + parseFloat(0).toFixed(2)
          );
        }
        $("#totalPaid").html(
          "$   " + parseFloat(response.total_paid_orders).toFixed(2)
        );
        $("#totalBrands").html(+response.total_brands);
        response.top_product.forEach((item) => {
          topProduct.push({
            name: item.name,
            y: parseFloat(item.total_quantity),
            z: parseFloat(item.total_quantity),
          });
        });
        response.mount_months.forEach((item) => {
          series.push([parseFloat(item.month), parseFloat(item.total)]);
        });
        if (response.top_customer) {
          response.top_customer.forEach((item) => {
            topCustomer.push({
              name: item.firstname + " " + item.lastname,
              y: parseFloat(item.total),
            });
          });
        } else {
          $("#containerCustomer").html(
            '<div style="text-align: center; width: 100%; height: 100%; position: absolute; left: 0; top: 100px; z-index: 20;"><b>No data for you today!</b></div>'
          );
        }

        const table = document.getElementById("alertProduct");

        // Create a new tbody element
        const tbody = document.createElement("tbody");
        tbody.id = "alertProduct";

        // Iterate over the products array to create rows
        response.alert_product.forEach((item) => {
          const tr = document.createElement("tr");

          // Create and append cells to the row
          const tdSerial = document.createElement("td");
          tdSerial.className = "shadow-none fw-normal text-black title ps-0";
          tdSerial.textContent = item.serial;
          tr.appendChild(tdSerial);

          const tdName1 = document.createElement("td");
          tdName1.className = "shadow-none lh-1 fs-14 fw-normal text-paragraph";
          tdName1.textContent = item.name;
          tr.appendChild(tdName1);

          const tdName2 = document.createElement("td");
          tdName2.className = "shadow-none lh-1 fs-14 fw-normal text-paragraph";
          tdName2.textContent = item.name_store;
          tr.appendChild(tdName2);

          const tdStoreName = document.createElement("td");
          tdStoreName.className =
            "shadow-none lh-1 fs-14 fw-normal text-paragraph";
          const span = document.createElement("span");
          span.className = "text-red fw-bold";
          span.textContent = item.qty;
          tdStoreName.appendChild(span);
          tr.appendChild(tdStoreName);

          // Append the row to the tbody
          tbody.appendChild(tr);
        });

        // Append the tbody to the table
        table.appendChild(tbody);

        initializePieChart(); // Initialize pie chart after data is set
      },
    });
  }

  initializeColumnChart(); // Initialize column chart immediately
});
