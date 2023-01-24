<!-- LINKS -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

<!-- DEFAULT TABLE -->
<script>
    $(document).ready(function () {
    $('#tableTemplate').DataTable();
});
</script>
<!-- DEFAULT TABLE END -->

<!-- Datatable Phase dropdown filter for listofcandidate START -->
<script>
    $(document).ready(function(){
        var PhaseFilter = $('#tableTemplate1').DataTable();
        $('#phase_pos').on('change', function(){
            PhaseFilter.columns(7).search(this.value).draw();
        });
    });
</script>
<!-- Datatable dropdown filter END -->

<script>
    var PhaseFilter_dept = $('#tableDashboard').DataTable();
        $('#dash_dept').on('change', function(){
            PhaseFilter_dept.columns(0).search(this.value).draw();
        });

        var PhaseFilter_pos = $('#tableDashboard').DataTable();
        $('#dash_pos').on('change', function(){
            PhaseFilter_pos.columns(1).search(this.value).draw();
        });
        var PhaseFilter_type = $('#tableDashboard').DataTable();
        $('#dash_type').on('change', function(){
            PhaseFilter_type.columns(3).search(this.value).draw();
        });
</script>

<!-- DASHBOARD TABLE -->
<script>
    $(document).ready(function () {
    $('#tableDashboard').DataTable();
});
</script>
<!-- DASHBOARD TABLE END -->


<!-- PROFILE TABLE -->
<script>
    $(document).ready(function () {
    $('#tableProfile').DataTable();
});
</script>
<!-- PROFILE TABLE END -->

