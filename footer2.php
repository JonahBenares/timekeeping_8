        <script src="scripts/common.js" type="text/javascript"></script>
<!--         <script type="text/javascript" src="jquery-1.12.0.min.js"></script> -->
        <script type="text/javascript" src="scripts/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="scripts/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="scripts/dataTables.buttons.min.js"></script>
        <script type="text/javascript" src="scripts/buttons.flash.min.js"></script>
        <script type="text/javascript" src="scripts/jszip.min.js"></script>
        <script type="text/javascript" src="scripts/pdfmake.min.js"></script>
        <script type="text/javascript" src="scripts/vfs_fonts.js"></script>
        <script type="text/javascript" src="scripts/buttons.html5.min.js"></script>
        <script type="text/javascript" src="scripts/buttons.print.min.js"></script>
        <!-- <script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script> -->
        <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
        <script src="scripts/flot/jquery.flot.resize.js" type="text/javascript"></script>
        <script src="scripts/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#example').DataTable( {
                    order: [[0, 'asc'],[1, 'asc']],
                    dom: 'Bfrtip',
                    buttons: [
                        'copyHtml5',
                        'excelHtml5',
                        'csvHtml5',
                        'pdfHtml5'
                    ]
                } );
            } );
        </script>