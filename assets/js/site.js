$(function(){
    //console.log(getQuarter())
    $('#example').DataTable(
        {
            "searching":   false,
            "lengthChange":   false,
            "order": [3,'asc']
        }
    );
});

// function getQuarter(d) {
//     d = d || new Date();
//     var m = Math.floor(d.getMonth() / 3) + 2;
//     m -= m > 4 ? 4 : 0;
//     var y = d.getFullYear() + (m == 1 ? 1 : 0);
//     return [y, m];
// }