<?php header('Content-type: text/html; charset=utf-8'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>miPague</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF8" />

	<!--  styles -->
	<link rel="stylesheet" type="text/css" href="../web/css/style.css" />
	<link rel="stylesheet" type="text/css" href="../web/css/button.css" />
	<link rel="stylesheet" type="text/css" href="../web/lib/bootstrap/css/bootstrap.css" />	

	<!-- lib -->
	<script type="text/javascript" src="../web/lib/jquery/jquery.js"></script>
	<script type="text/javascript" src="../web/lib/jquery/jquery.position.js"></script>
	<script type="text/javascript" src="../web/lib/jquery/jquery.validate.js"></script>
	<script type="text/javascript" src="../web/lib/underscore/underscore.js"></script>
	<script type="text/javascript" src="../web/lib/backbone/backbone.js"></script>
	<script type="text/javascript" src="../web/lib/backbone/backbone-validation.js"></script>
	<script type="text/javascript" src="../web/lib/bootstrap/js/bootstrap.js"></script>
	<script type="text/javascript" src="../web/lib/Array.js"></script>
	<script type="text/javascript" src="../web/lib/date.js"></script>
	
	<!-- application -->
	<script type="text/javascript" src="../web/js/app.js"></script>
	<script type="text/javascript" src="../web/js/jst.js"></script>
	<script type="text/javascript" src="../web/js/src/ClassMgr.js"></script>
	<script type="text/javascript" src="../web/js/src/NestedModel.js"></script>
	<script type="text/javascript" src="../web/js/src/widgets/Button.js"></script>
	<script type="text/javascript" src="../web/js/src/widgets/Menu.js"></script>
	<script type="text/javascript" src="../web/js/src/widgets/Editable.js"></script>
	<script type="text/javascript" src="../web/js/util/Format.js"></script>
	<script type="text/javascript" src="../web/js/model/GroupModel.js"></script>
	<script type="text/javascript" src="../web/js/model/UserModel.js"></script>
	<script type="text/javascript" src="../web/js/model/ActivityModel.js"></script>
	<script type="text/javascript" src="../web/js/collection/GroupCollection.js"></script>
	<script type="text/javascript" src="../web/js/collection/ActivityCollection.js"></script>
	<script type="text/javascript" src="../web/js/view/AppLayout.js"></script>
	<script type="text/javascript" src="../web/js/view/Header.js"></script>
	<script type="text/javascript" src="../web/js/view/GroupListItem.js"></script>
	<script type="text/javascript" src="../web/js/view/GroupList.js"></script>
	<script type="text/javascript" src="../web/js/view/Group.js"></script>
	<script type="text/javascript" src="../web/js/view/User.js"></script>
	<script type="text/javascript" src="../web/js/view/ActivityList.js"></script>
	<script type="text/javascript" src="../web/js/view/ActivityListItem.js"></script>
	<script type="text/javascript" src="../web/js/main.js"></script>
	<script type="text/javascript">
		MPG.Bootstrap = {};
		MPG.Bootstrap.User = <?php echo json_encode($user); ?>
	</script>
</head>
<body>
</body>
</html>