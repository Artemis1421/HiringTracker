var startDate;
var endDate;
$(function() {
    var start = moment().subtract(7, "days");
    var end = moment();

    function cb(start, end) {
        $("#expenseRange span").html(
            start.format("MMMM D YYYY") + " - " + end.format("MMMM D YYYY")
        );
        startDate = start;
        endDate = end;
    }

    $("#expenseRange").daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                Today: [moment(), moment()],
                Yesterday: [moment().subtract(1, "days"), moment().subtract(1, "days")],
                "Last 7 Days": [moment().subtract(6, "days"), moment()],
                "Last 30 Days": [moment().subtract(29, "days"), moment()],
                "This Month": [moment().startOf("month"), moment().endOf("month")],
                "Last Month": [
                    moment().subtract(1, "month").startOf("month"),
                    moment().subtract(1, "month").endOf("month"),
                ],
            },
        },
        cb
    );

    cb(start, end);

    $("#saveBtn").click(function() {
        var search_start_date = startDate.format("MMMM D YYYY");
        var search_end_date = endDate.format("MMMM D YYYY");
        var start = document.getElementById("start");
        var end = document.getElementById("end");

        GFG_Fun();

        function GFG_Fun() {
            start.value = search_start_date;
            end.value = search_end_date;
        }

        console.log(search_start_date + ' search');
        console.log(search_end_date + ' search');
    });

    $("#saveBtn2").click(function() {
        var search_start_date = startDate.format("MMMM D YYYY");
        var search_end_date = endDate.format("MMMM D YYYY");
        var start = document.getElementById("startBatch");
        var end = document.getElementById("endBatch");

        GFG_Fun();

        function GFG_Fun() {
            start.value = search_start_date;
            end.value = search_end_date;
        }

        console.log(search_start_date + ' batch');
        console.log(search_end_date + ' batch');
    });
});

// SUMMARY RANGE

$(function() {
    var start = moment().subtract(7, "days");
    var end = moment();

    function cb(start, end) {
        $("#summaryRange span").html(
            start.format("MMMM D YYYY") + " - " + end.format("MMMM D YYYY")
        );
        startDate = start;
        endDate = end;
    }

    $("#summaryRange").daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                Today: [moment(), moment()],
                Yesterday: [moment().subtract(1, "days"), moment().subtract(1, "days")],
                "Last 7 Days": [moment().subtract(6, "days"), moment()],
                "Last 30 Days": [moment().subtract(29, "days"), moment()],
                "This Month": [moment().startOf("month"), moment().endOf("month")],
                "Last Month": [
                    moment().subtract(1, "month").startOf("month"),
                    moment().subtract(1, "month").endOf("month"),
                ],
            },
        },
        cb
    );

    cb(start, end);

    $("#savePieBtn").click(function() {
        var pie_start_date = startDate.format("MMMM D YYYY");
        var pie_end_date = endDate.format("MMMM D YYYY");
        var start = document.getElementById("pie_start_date");
        var end = document.getElementById("pie_end_date");

        GFG_Fun();

        function GFG_Fun() {
            start.value = pie_start_date;
            end.value = pie_end_date;
        }

        console.log(pie_start_date + ' pie');
        console.log(pie_end_date + ' pie');
    });
});

// END SUMMARY RANGE

// RECEIPT RANGE

$(function() {

    var start = moment().subtract(7, 'days');
    var end = moment();

    function cb(start, end) {
        $('#receiptRange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }

    $('#receiptRange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    cb(start, end);

    $("#receiptBatch").click(function() {
        var search_start_date = startDate.format("MMMM D YYYY");
        var search_end_date = endDate.format("MMMM D YYYY");
        var start = document.getElementById("start");
        var end = document.getElementById("end");

        GFG_Fun();

        function GFG_Fun() {
            start.value = search_start_date;
            end.value = search_end_date;
        }

        console.log(search_start_date + ' receipt');
        console.log(search_end_date + ' receipt');
    });

    $("#saveBtn3").click(function() {
        var search_start_date = startDate.format("MMMM D YYYY");
        var search_end_date = endDate.format("MMMM D YYYY");
        var startReport = document.getElementById("startReport");
        var endReport = document.getElementById("endReport");

        GFG_Fun();

        function GFG_Fun() {
            startReport.value = search_start_date;
            endReport.value = search_end_date;
        }

        console.log(search_start_date + ' report');
        console.log(search_end_date + ' report');
    });
});
// END RECEIPT RANGE

// PETTYCASH RANGE
$(function() {
    var start = moment().subtract(7, "days");
    var end = moment();

    function cb(start, end) {
        $("#pettyRange span").html(
            start.format("MMMM D YYYY") + " - " + end.format("MMMM D YYYY")
        );
        startDate = start;
        endDate = end;
    }

    $("#pettyRange").daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                Today: [moment(), moment()],
                Yesterday: [moment().subtract(1, "days"), moment().subtract(1, "days")],
                "Last 7 Days": [moment().subtract(6, "days"), moment()],
                "Last 30 Days": [moment().subtract(29, "days"), moment()],
                "This Month": [moment().startOf("month"), moment().endOf("month")],
                "Last Month": [
                    moment().subtract(1, "month").startOf("month"),
                    moment().subtract(1, "month").endOf("month"),
                ],
            },
        },
        cb
    );

    cb(start, end);

    $("#pettyCashBtn").click(function() {
        var search_start_date = startDate.format("MMMM D YYYY");
        var search_end_date = endDate.format("MMMM D YYYY");
        var start = document.getElementById("startPetty");
        var end = document.getElementById("endPetty");

        GFG_Fun();

        function GFG_Fun() {
            start.value = search_start_date;
            end.value = search_end_date;
        }

        console.log(search_start_date + ' petty');
        console.log(search_end_date + ' petty');
    });
});
// END PETTYCASH RANGE

// CC USAGE
$(function() {
    var start = moment().subtract(30, "days");
    var end = moment();

    function cb(start, end) {
        $("#ccUsageRange span").html(
            start.format("MMMM D YYYY") + " - " + end.format("MMMM D YYYY")
        );
        startDate = start;
        endDate = end;
    }

    $("#ccUsageRange").daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                Today: [moment(), moment()],
                Yesterday: [moment().subtract(1, "days"), moment().subtract(1, "days")],
                "Last 7 Days": [moment().subtract(6, "days"), moment()],
                "Last 30 Days": [moment().subtract(29, "days"), moment()],
                "This Month": [moment().startOf("month"), moment().endOf("month")],
                "Last Month": [
                    moment().subtract(1, "month").startOf("month"),
                    moment().subtract(1, "month").endOf("month"),
                ],
            },
        },
        cb
    );

    cb(start, end);

    $("#usageCashBtn").click(function() {
        var cc_start_date = startDate.format("MMMM D YYYY");
        var cc_end_date = endDate.format("MMMM D YYYY");
        var startCC = document.getElementById("startCC");
        var endCC = document.getElementById("endCC");

        GFG_Fun();

        function GFG_Fun() {
            startCC.value = cc_start_date;
            endCC.value = cc_end_date;
        }

        console.log(cc_start_date + ' cc');
        console.log(cc_end_date + ' cc');
    });
});
// END CC USAGE