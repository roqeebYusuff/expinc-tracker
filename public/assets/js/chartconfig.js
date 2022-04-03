(function($) {
    // 'use strict';
    // $(function() {
    
    separator = (num) => {
      var str = num.toString().split(".")
      str[0] = str[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",")
      return str.join(".")
    }

    incomeChart = (url) => {
      'use strict';
      var options = {
        chart: {
          type: 'donut'
        },
        series: [],
        noData: {
          text: 'No data',
          style: {
            color: '#fff',
            fontSize: '20px'
          }
        },
        labels: [],
        responsive: [{
          breakpoint: 767,
          options: {
            legend: {
              show: false
            }
          }
        }],
        legend: {
          labels: {
            colors: '#fff'
          }
        },
        plotOptions: {
          pie: {
            donut: {
              // size: '65%',
              labels: {
                show: true,
                name: {
                  show: true,
                  fontSize: '15'
                },
                value: {
                  show: true,
                  fontSize: '16',
                  color: '#fff',
                  formatter: (val) => {
                    return separator(val)
                  }
                },
                total: {
                  show: true,
                  fontSize: '22',
                  color: '#fff',
                  label: 'Income',
                  formatter: (w) => {
                    var t = w.globals.seriesTotals.reduce((a,b) => a + b, 0)
                    return separator(t)
                  }
                }
              }
            },
          }
        },
        dataLabels: {
          enabled: true
        }
      }
      var incomeChart = new ApexCharts(document.querySelector('#incomeChart'), options)
      incomeChart.render()
      $.getJSON(url, (response) => {
          response.forEach(a => {
            options.labels.push(a.category)
            options.series.push(+a.amount)
            
          });
          incomeChart.updateOptions([{}])
      })
    }

    expenseChart = (url) => {
      'use strict';
      var options = {
        chart: {
          type: 'donut'
        },
        series: [],
        noData: {
          text: 'No data',
          style: {
            color: '#fff',
            fontSize: '20px'
          }
        },
        labels: [],
        responsive: [
          {
            breakpoint: 767,
            options: {
              legend: {
                show: false
              }
            }
          }
        ],
        legend: {
          labels: {
            colors: '#fff'
          }
        },
        plotOptions: {
          pie: {
            donut: {
              labels: {
                show: true,
                name: {
                  show: true,
                  fontSize: '15'
                },
                value: {
                  show: true,
                  fontSize: '16',
                  color: '#fff',
                  formatter: (val) => {
                    return separator(val)
                  }
                },
                total: {
                  show: true,
                  fontSize: '22',
                  color: '#fff',
                  label: 'Expense',
                  formatter: (w) => {
                    var t = w.globals.seriesTotals.reduce((a,b) => a + b, 0)
                    return separator(t)
                  }
                }
              }
            },
            // customScale: 0.8
          }
        },
        dataLabels: {
          enabled: true
        }
      }
      var expenseChart = new ApexCharts(document.querySelector('#expenseChart'), options)
      expenseChart.render()
      $.getJSON(url, (response) => {
          response.forEach(a => {
            options.labels.push(a.category)
            options.series.push(+a.amount)
            
          });
          expenseChart.updateOptions([{}])
      })
    }
  })(jQuery);