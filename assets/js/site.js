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
            "order": [3,'desc']
        }
    );
    
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

});

// function getQuarter(d) {
//     d = d || new Date();
//     var m = Math.floor(d.getMonth() / 3) + 2;
//     m -= m > 4 ? 4 : 0;
//     var y = d.getFullYear() + (m == 1 ? 1 : 0);
//     return [y, m];
// }