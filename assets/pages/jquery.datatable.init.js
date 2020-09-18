$(document).ready(function() {
	$(".tbl_members, .all_riders, .choose_riders").DataTable({
	        "processing": true,
	        "serverSide": true,
	        "pageLength": 25,
	        "ajax":{
	            url : urls,
	            type: "post"
	        },
	        "columnDefs":[
	        {
	            "target":[0,3,4],
	            "orderable": false
	        }
	        ]
	    }),
	
	$(document).ready(function() {
		$("#datatable2").DataTable()
	}),

	$("#datatable-buttons").DataTable({
		lengthChange: !1,
		buttons: ["copy", "excel", "pdf", "colvis"]
	}).buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)")
});