const colorCoding = ['rgb(250, 219, 216)','rgb(249, 231, 159)','rgb(232, 218, 239)','rgb(212, 230, 241)',
                        'rgb(214, 234, 248)','rgb(212, 239, 223)','rgb(252, 243, 207)'];


function dataChart(datadaw, count){
    let name1 = new Array();
    let count1 = new Array();
    for( const qwe2 of datadaw){
        name1.push(qwe2.name1);
        count1.push(qwe2.count_status);
    }
    if(count == 1)
        return count1;
    else
        return name1;
}

// function dataChart1(datadaw){
    
//     for( const qwe2 of datadaw){
//         count1.push(qwe2.count_status);
//     }

//     return count1;
// }
