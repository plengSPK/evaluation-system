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
    $('#dashboard_manager_pending').DataTable(
        {
            "searching":   false,
            "lengthChange":   false
        }
    );

    $('#dashboard_director').DataTable(
        {
            "searching":   false,
            "lengthChange":   false
        }
    );
    
    $('#dashboard_director_history').DataTable(
        {
            "searching":   false,
            "lengthChange":   false
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
    if($("#chart-summary").length){
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
    
        changeChartType('chart-summary');    
    }

    // request page
    if($("#all-summary-score").length){
        var count_emp = $('.chart-all-summary').data('count');

        config2 = {
            type: 'bar',            
            data: {
                labels: ['Time management', 'Quality of work', 'Creativity', 'Team work', 'Discipline'],
                datasets: []
            },            
        };

        var backgroundColor= [
            'rgba(75, 192, 192, 0.2)',
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 159, 64, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(255, 206, 86, 0.2)'
        ];
        var borderColor= [
            'rgba(75, 192, 192, 1)',
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 159, 64, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 206, 86, 1)'
        ];

        $.ajax({
            type: 'POST',
            url: BASE_URL + '/request/post_data',
            data: {target_id: $('.all-summary-score').data('id') },
            dataType: 'JSON', 
            success: function (res) {
                //console.log(res);
                $.each(res, function(index, element) {
                    var data_temp = [];
                    data_temp.push(scoreCharttoPercent(element.time_mange_score/element.count,4));
                    data_temp.push(scoreCharttoPercent(element.quality_score/element.count,4));
                    data_temp.push(scoreCharttoPercent(element.creativity_score/element.count,4));
                    data_temp.push(scoreCharttoPercent(element.teamwork_score/element.count,4));
                    data_temp.push(scoreCharttoPercent(element.discipline_score/element.count,4));

                    var dataset_temp = {
                        label: '# of Scores in ' + element.quarter + '/' + element.year,
                        data: data_temp,
                        backgroundColor: backgroundColor[index%6],
                        borderColor: borderColor[index%6],
                        borderWidth: 1,
                        fill: false,
                        type: 'line',
                    };
                    var dataset_temp2 = {
                        label: '# of Scores in ' + element.quarter + '/' + element.year,
                        data: data_temp,
                        backgroundColor: backgroundColor[index%6],
                        borderColor: borderColor[index%6],
                        borderWidth: 1,
                    };
                    config2.data.datasets.push(dataset_temp);
                    config2.data.datasets.push(dataset_temp2);
                    config2.options =  {
                        scales: {        
                            yAxes: [{
                                ticks: {
                                    min: 0,
                                    max: 100
                                }
                            }]
                        }
                    };
                });
                
                var summaryChart = document.getElementById('all-summary-score').getContext("2d");
                var temp = jQuery.extend(true, {}, config2);
                var mySummaryChart2 = new Chart(summaryChart, temp);
            },
            error: function(){
                console.log('error!');
            }
        });
    }

    // detail page
    if( $('.detail-eval input[name="name"]').length > 0){
        var status = $('.detail-eval input[name="name"]').data('value');
        $('.detail-eval input[name="name"]').val(changeStatus(status));
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

function changeChartType(name) {
    var type = $('.' + name + ' button').data('type');
    switch(type){
        case "bar":
            newType = "polarArea";
            $('.' + name + ' button').data('type',"polarArea");
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
            $('.' + name + ' button').data('type',"bar");
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

    var summaryChart = document.getElementById(name).getContext("2d");

    if (mySummaryChart) {
        mySummaryChart.destroy();
    }

    var temp = jQuery.extend(true, {}, config);
    temp.type = newType;
    mySummaryChart = new Chart(summaryChart, temp);
    
}

function scoreCharttoPercent(score,top_score){
    return (score*100/top_score).toFixed(2);
}

function changeStatus(id){
    switch (id){
        case 0:
            return "Pending";
            break;
        case 1:
            return "Approved";
            break;            
        case 2:
            return "Rejected";
            break;
    }
}