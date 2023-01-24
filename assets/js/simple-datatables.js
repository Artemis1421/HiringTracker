
// Table
window.addEventListener('DOMContentLoaded', event => {
    const datatablesSimple = document.getElementById('datatablesSimple');
    if (datatablesSimple) {
        new simpleDatatables.DataTable("#datatablesSimple")
    }    
});

window.addEventListener('DOMContentLoaded', event => {
    const loadTable = document.getElementById('loadTable');
    if (loadTable) {
        new simpleDatatables.DataTable("#loadTable",{

        });
    }    
});

// Dashboard Table (Total Expenses)
window.addEventListener('DOMContentLoaded', event => {
    const dashboardTable = document.getElementById('dashboardTable');
    if (dashboardTable) {
        new simpleDatatables.DataTable("#dashboardTable",{
            footer: true
        });
    }    
});

// Receipt Table
window.addEventListener('DOMContentLoaded', event => {
    const receiptsTable = document.getElementById('receiptsTable');
    if (receiptsTable) {
        new simpleDatatables.DataTable("#receiptsTable", {
            paging: true,
            perPage: 1000,
            perPageSelect: [10, 20, 30, 40, 50, 100, 500, 1000]
        });
    }
});

// Petty Cash Table
window.addEventListener('DOMContentLoaded', event => {
    const pettyCashFormTable = document.getElementById('pettyCashFormTable');
    if (pettyCashFormTable) {
        new simpleDatatables.DataTable("#pettyCashFormTable", {
            paging: true,
            footer: true,
            perPage: 1000,
            perPageSelect: [10, 20, 30, 40, 50, 100, 500, 1000]
        });
    }
});

// Dashboard Table (Total Expenses)
window.addEventListener('DOMContentLoaded', event => {
    const pettyCashFormTable = document.getElementById('pettyCashFormTable');
    if (pettyCashFormTable) {
        new simpleDatatables.DataTable("#pettyCashFormTable",{
            footer: true
        });
    }    
});

// CC Usage Table
window.addEventListener('DOMContentLoaded', event => {
    const ccUsageTable = document.getElementById('ccUsageTable');
    if (ccUsageTable) {
        new simpleDatatables.DataTable("#ccUsageTable", {
            paging: true,
            footer: true,
            perPage: 1000,
            perPageSelect: [10, 20, 30, 40, 50, 100, 500, 1000]
        });
    }
});

