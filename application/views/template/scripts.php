    <script type="text/javascript" src="<?= base_url("assets/js/jquery.js") ?>"></script>
    <script type="text/javascript" src="<?= base_url("assets/js/jquery.gritter/js/jquery.gritter.js") ?>"></script>

    <script type="text/javascript" src="<?= base_url("assets/js/jquery.nanoscroller/jquery.nanoscroller.js") ?>"></script>
    <script type="text/javascript" src="<?= base_url("assets/js/behaviour/general.js") ?>"></script>
    <script type="text/javascript" src="<?= base_url("assets/js/jquery.ui/jquery-ui.js") ?>"></script>
    <script type="text/javascript" src="<?= base_url("assets/js/jquery.sparkline/jquery.sparkline.min.js") ?>"></script>
    <script type="text/javascript" src="<?= base_url("assets/js/jquery.easypiechart/jquery.easy-pie-chart.js") ?>"></script>
    <script type="text/javascript" src="<?= base_url("assets/js/jquery.nestable/jquery.nestable.js") ?>"></script>


    <script type="text/javascript" src="<?= base_url("assets/js/bootstrap.switch/bootstrap-switch.min.js") ?>"></script>
    <script type="text/javascript" src="<?= base_url("assets/js/bootstrap.datetimepicker/js/bootstrap-datetimepicker.min.js") ?>"></script>
    <script src="<?= base_url("assets/js/jquery.select2/select2.min.js") ?>" type="text/javascript"></script>
    <script src="<?= base_url("assets/js/skycons/skycons.js") ?>" type="text/javascript"></script>

    <script src="<?= base_url("assets/js/bootstrap.slider/js/bootstrap-slider.js") ?>" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/js/intro.js/intro.js" type="text/javascript"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/js/jquery.niftymodals/js/jquery.modalEffects.js"></script>  
    <script type="text/javascript" src="<?= base_url() ?>assets/js/jquery.datatables/jquery.datatables.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/js/jquery.datatables/bootstrap-adapter/js/datatables.js"></script>
    <script type="text/javascript" src="<?= base_url("assets/js/jquery.niftymodals/js/jquery.modalEffects.js") ?>"></script>
    <!--<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>-->

    <!-- SWEETALERT 2 -->
    <script src="<?= base_url() ?>assets/js/sweetalert2/sweetalert.min.js"></script>

    <script type="text/javascript" src="<?= base_url("assets/js/gral.js") ?>"></script>
    <!-- Bootstrap core JavaScript
          ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <script>
        $(document).ready(function() {
            App.init();
            App.dashBoard();
            $('.md-trigger').modalEffects();
            cargarMenu();
            cargarPermisosUsuario(URLActual());
             function fnFormatDetails(oTable, nTr) /*Da estilo a la tabla, añade paginacion, imput search */
                                                            {
                                                                var aData = oTable.fnGetData(nTr);
                                                                var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
                                                                sOut += '<tr><td>Rendering engine:</td><td>' + aData[1] + ' ' + aData[4] + '</td></tr>';
                                                                sOut += '<tr><td>Link to source:</td><td>Could provide a link here</td></tr>';
                                                                sOut += '<tr><td>Extra info:</td><td>And any further details here (images etc)</td></tr>';
                                                                sOut += '</table>';

                                                                return sOut;
                                                            }
                                                            var nCloneTh = document.createElement('th');
                                                            var nCloneTd = document.createElement('td');
                                                            nCloneTd.innerHTML = '<img class="toggle-details" src="<?= base_url("assets/img/plus.png") ?>" />';
                                                            nCloneTd.className = "center";

                                                            $('#datatable2 thead tr').each(function () {
                                                                this.insertBefore(nCloneTh, this.childNodes[0]);
                                                            });

                                                            $('#datatable2 tbody tr').each(function () {
                                                                this.insertBefore(nCloneTd.cloneNode(true), this.childNodes[0]);
                                                            });
                                                            var oTable = $('#datatable2').dataTable({
                                                                "language": {
                                                                      "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                                                                    },

                                                                "aoColumnDefs": [

                                                                    {"bSortable": false, "aTargets": [0]}

                                                                ],

                                                                "aaSorting": [[1, 'asc']]

                                                            });



                                                            /* Add event listener for opening and closing details
                                                             
                                                             * Note that the indicator for showing which row is open is not controlled by DataTables,
                                                             
                                                             * rather it is done here
                                                             
                                                             */

                                                            $('#datatable2').delegate('tbody td img', 'click', function () {

                                                                var nTr = $(this).parents('tr')[0];

                                                                if (oTable.fnIsOpen(nTr))

                                                                {

                                                                    /* This row is already open - close it */

                                                                    this.src = "images/plus.png";

                                                                    oTable.fnClose(nTr);

                                                                } else

                                                                {

                                                                    /* Open this row */

                                                                    this.src = "images/minus.png";

                                                                    oTable.fnOpen(nTr, fnFormatDetails(oTable, nTr), 'details');

                                                                }

                                                            });



                                                            $('.dataTables_filter input').addClass('form-control').attr('placeholder', 'Buscar...');

                                                            $('.dataTables_length select').addClass('form-control');



                                                            //Horizontal Icons dataTable
                                                            
                                                            $('#datatable-icons').dataTable({
                                                                
                                                                
                                                            });
                                                                                                                    
        });
    </script>

    <script src="<?= base_url("assets/js/behaviour/voice-commands.js") ?>"></script>
    <script src="<?= base_url("assets/js/bootstrap/dist/js/bootstrap.min.js") ?>"></script>
    <script type="text/javascript" src="<?= base_url("assets/js/jquery.flot/jquery.flot.js") ?>"></script>
    <script type="text/javascript" src="<?= base_url("assets/js/jquery.flot/jquery.flot.pie.js") ?>"></script>
    <script type="text/javascript" src="<?= base_url("assets/js/jquery.flot/jquery.flot.resize.js") ?>"></script>
    <script type="text/javascript" src="<?= base_url("assets/js/jquery.flot/jquery.flot.labels.js") ?>"></script>
    

     

