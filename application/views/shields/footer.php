	

	<div class="mt-40_"></div>
	<footer class="footer text-center text-sm-left">&copy; 2020 Logistics <span class="text-soft d-none d-sm-inline-block float-right">Developed by Tech Academy</span></footer>
</div>

</div>


</div>
	</div>
	

	<script src="<?=base_url()?>assets/js/jquery.min.js"></script>
	<!-- <script src="<?=base_url()?>assets/js/jquery-1.11.1.min.js"></script> -->
	
	<script src="<?=base_url()?>assets/js/bootstrap.bundle.min.js"></script>
	<script src="<?=base_url()?>assets/js/metisMenu.min.js"></script>
	<script src="<?=base_url()?>assets/js/waves.min.js"></script>
	<script src="<?=base_url()?>assets/js/jquery.slimscroll.min.js"></script>
	<script src="<?=base_url()?>assets/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
	<script src="<?=base_url()?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
	<script src="<?=base_url()?>assets/plugins/moment/moment.js"></script>
	<script src="<?=base_url()?>assets/plugins/apexcharts/apexcharts.min.js"></script>
	<!-- <script src="<?=base_url()?>assets/js/irregular-data-series.js"></script>
	<script src="<?=base_url()?>assets/js/series1000.js"></script>
	<script src="<?=base_url()?>assets/js/ohlc.js"></script> -->
	<script src="<?=base_url()?>assets/pages/jquery.dashboard.init.js"></script>

	<script src="<?=base_url()?>assets/plugins/parsleyjs/parsley.min.js"></script>
	<script src="<?=base_url()?>assets/pages/jquery.validation.init.js"></script>
	<script src="<?=base_url()?>assets/js/jquery.core.js"></script>


	<?php if($page_name != ""){ ?>
	<!-- Required datatable js -->
	<script src="<?=base_url()?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="<?=base_url()?>assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
	<!-- Buttons examples -->
	<!-- <script src="<?=base_url()?>assets/plugins/datatables/dataTables.buttons.min.js"></script>
	<script src="<?=base_url()?>assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
	<script src="<?=base_url()?>assets/plugins/datatables/jszip.min.js"></script>
	<script src="<?=base_url()?>assets/plugins/datatables/pdfmake.min.js"></script>
	<script src="<?=base_url()?>assets/plugins/datatables/vfs_fonts.js"></script>
	<script src="<?=base_url()?>assets/plugins/datatables/buttons.html5.min.js"></script>
	<script src="<?=base_url()?>assets/plugins/datatables/buttons.print.min.js"></script>
	<script src="<?=base_url()?>assets/plugins/datatables/buttons.colVis.min.js"></script> -->
	<!-- Responsive examples -->


	<script>
	    var site_urls = $('#txtsite_url').val();
	    var txt_pagename = $('#txtpage_name').val();
	    var txtmem = $('#txtmem').val();
	    var uid = "<?=$this->uri->segment(3);?>";
	    if(uid!="") uid = uid+"/";
	    //alert(txt_pagename);

	    var urls = site_urls+"shields/fetch_records/"+txt_pagename+"/"+uid;

	</script>



	<script src="<?=base_url()?>assets/plugins/datatables/dataTables.responsive.min.js"></script>
	<script src="<?=base_url()?>assets/plugins/datatables/responsive.bootstrap4.min.js"></script>
	<script src="<?=base_url()?>assets/pages/jquery.datatable.init.js"></script>
	<?php } ?>


	<?php if($page_name=="riders"){ ?>
	<script src="<?=base_url()?>assets/plugins/tabledit/jquery.tabledit.js"></script>
	<script src="<?=base_url()?>assets/pages/jquery.tabledit.init.js"></script>
	<?php } ?>


	<script src="<?=base_url()?>assets/js/app.js"></script>

	<script src="<?=base_url()?>js/jscripts.js"></script>

	<script src="<?=base_url()?>plugins/sweetalert/sweetalert.min.js"></script>
    <script src="<?=base_url()?>js_adm/dialogs.js"></script>


</body>

</html>