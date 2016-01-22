<?php
	require('includes/application_top.php');
	require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ACCOUNT);
	require(DIR_WS_INCLUDES . 'template_top.php');
?>
<title>Stock Out</title>
<style>
.scroll{
	height:300px;
	width:100%;
	overflow:hidden;
	overflow-y:scroll;
}
</style>
<link rel="stylesheet" type="text/css" href="css/lib_template/jquery-ui.min.css">
<div class="contentContainer" data-ng-app="main">
	<div class="row">
		<div class="col-md-12">
			<div data-ui-view=""></div>
		</div>
	</div>
</div>
<?php
require(DIR_WS_INCLUDES . 'template_bottom.php');
require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
<!-- custom file -->
<script src="js/ng/app/stock/main.js"></script>
<script src="js/ng/app/stock/config/route.js"></script>
<script src="js/ng/app/core/restful/restful.js"></script>
<script src="js/ng/app/stock/controller/stock_ctrl.js"></script>
<script src="js/ng/app/stock/services/services.js"></script>
<script src="js/ng/app/core/directive/number.js"></script>
<script src="js/ng/app/stock/directive/popup.js"></script>

