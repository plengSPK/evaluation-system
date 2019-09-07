$(function(){
    //console.log(getQuarter())
    $('#dashboard_emp').DataTable(
        {
            "searching":   false,
            "lengthChange":   false,
            "order": [3,'asc']
        }
    );
    $('#dashboard_manager').DataTable(
        {
            "searching":   false,
            "lengthChange":   false,
            "order": [2,'asc']
        }
    );
    
    // detail page
    var score_time = $('.evaluate-table.view tr.time th').data('score');
    var score_quality = $('.evaluate-table.view tr.quality th').data('score');
    var score_creativity = $('.evaluate-table.view tr.creativity th').data('score');
    var score_teamwork = $('.evaluate-table.view tr.teamwork th').data('score');
    var score_discipline = $('.evaluate-table.view tr.discipline th').data('score');
    
    $(`.evaluate-table.view tr.time td input[value='${score_time}']`).prop("checked", true);
    $(`.evaluate-table.view tr.quality td input[value='${score_quality}']`).prop("checked", true);
    $(`.evaluate-table.view tr.creativity td input[value='${score_creativity}']`).prop("checked", true);
    $(`.evaluate-table.view tr.teamwork td input[value='${score_teamwork}']`).prop("checked", true);
    $(`.evaluate-table.view tr.discipline td input[value='${score_discipline}']`).prop("checked", true);


    // summary page
    if($("#summary-score").length){
        var summary_time = $('#result_emp tr td.time_mange_score').data('value');
        var summary_quality = $('#result_emp tr td.quality_score').data('value');
        var summary_creativity = $('#result_emp tr td.creativity_score').data('value');
        var summary_teamwork = $('#result_emp tr td.teamwork_score').data('value');
        var summary_discipline = $('#result_emp tr td.discipline_score').data('value');
    
        config = {
            type: 'bar',
            data: {
                labels: ['Time management', 'Quality of work', 'Creativity', 'Team work', 'Discipline'],
                datasets: [{
                    label: '# of Scores',
                    data: [summary_time, summary_quality, summary_creativity, summary_teamwork, summary_discipline],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            
        };
    
        changeChartType();    
    }
});
var mySummaryChart;
var config;

// function getQuarter(d) {
//     d = d || new Date();
//     var m = Math.floor(d.getMonth() / 3) + 2;
//     m -= m > 4 ? 4 : 0;
//     var y = d.getFullYear() + (m == 1 ? 1 : 0);
//     return [y, m];
// }

function changeChartType() {
    var type = $('.chart-summary button').data('type');
    switch(type){
        case "bar":
            newType = "polarArea";
            $('.chart-summary button').data('type',"polarArea");
            config.options = {
                            scale: {
                                ticks: {
                                    min: 0,
                                    max: 100
                                }
                            }
                        };
            break;
        default:
            newType = "bar";
            $('.chart-summary button').data('type',"bar");
            config.options =  {
                    scales: {        
                        yAxes: [{
                            ticks: {
                                min: 0,
                                max: 100
                            }
                        }]
                    }
                };
            break;
    }

    var summaryChart = document.getElementById("summary-score").getContext("2d");

    if (mySummaryChart) {
        mySummaryChart.destroy();
    }

    var temp = jQuery.extend(true, {}, config);
    temp.type = newType;
    mySummaryChart = new Chart(summaryChart, temp);
}