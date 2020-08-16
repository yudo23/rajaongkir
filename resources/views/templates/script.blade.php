<!-- Core -->
<script src="{{ URL::to('/')}}/templating/vendor/jquery/dist/jquery.min.js"></script>
<script src="{{ URL::to('/')}}/templating/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ URL::to('/')}}/templating/vendor/js-cookie/js.cookie.js"></script>
<script src="{{ URL::to('/')}}/templating/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
<script src="{{ URL::to('/')}}/templating/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
<!-- Optional JS -->
<script src="{{ URL::to('/')}}/templating/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{ URL::to('/')}}/templating/vendor/chart.js/dist/Chart.extension.js"></script>
<!-- Argon JS -->
<script src="{{ URL::to('/')}}/templating/js/argon.js?v=1.2.0"></script>
<!-- Sweetalert -->
<script src="{{ URL::to('/')}}/templating/vendor/sweetalert2/dist/sweetalert2.all.min.js"></script>
<!-- Datatables -->
<script src="{{ URL::to('/')}}/templating/vendor/datatable/datatables.min.js"></script>
<script src="{{ URL::to('/')}}/templating/vendor/datatable/buttons.html5.min.js"></script>
<script src="{{ URL::to('/')}}/templating/vendor/datatable/buttons.colVis.min.js"></script>
<script src="{{ URL::to('/')}}/templating/vendor/datatable/buttons.flash.min.js"></script>
<script src="{{ URL::to('/')}}/templating/vendor/datatable/buttons.foundation.min.js"></script>
<script src="{{ URL::to('/')}}/templating/vendor/datatable/buttons.print.min.js"></script>

<!-- Toast -->
<script src="{{ URL::to('/')}}/templating/vendor/toast/js/jquery.toast.js"></script>
<script type="text/javascript">
	let base_url = "http://127.0.0.1:8000/";
	function ajaxcsrfscript(){
		$.ajaxSetup({
			data : {_token : "{{csrf_token()}}" }
		})
		return;
	}
	function getFormData($form) {
	    var unindexed_array = $form.serializeArray();
	    var indexed_array = {};
	    $.map(unindexed_array, function (n, i) {
	        indexed_array[n['name']] = n['value'];
	    });
	    return indexed_array;
	}
	function showToast($type,$heading,$message){
		$.toast({
			heading: $heading,
			text: $message,
			position: 'top-right',
			loaderBg:'#ffffff',
			icon: $type,
			hideAfter: 3500, 
			stack: 6
		});

	}
</script>