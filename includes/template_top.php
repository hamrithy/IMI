<?php
if (!tep_session_is_registered('id')) {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
}
?>
<!DOCTYPE html>
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta charset="<?php echo CHARSET; ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-se=1cal">
<title>IMI Management System</title>
    <link rel="shortcut icon" href="images/banners/logo.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Fonts -->
<!--    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300,400' rel='stylesheet' type='text/css'>-->
<!--    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>-->
    <!-- CSS Libs https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.css -->
    <link rel="stylesheet" type="text/css" href="css/lib_template/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome/css/font-awesome.css">
<!--    <link rel="stylesheet" type="text/css" href="css/lib_template/animate.min.css">-->
    <link rel="stylesheet" type="text/css" href="css/lib_template/bootstrap-switch.min.css">
    <!-- CSS App -->
    <link rel="stylesheet" type="text/css" href="css/lib_template/style.css">
    <link rel="stylesheet" type="text/css" href="css/lib_template/select.css">
    <link rel="stylesheet" type="text/css" href="css/lib_template/flat-blue.css">
    <link rel="stylesheet" type="text/css" href="css/lib_template/select2.min.css">
    <link rel="stylesheet" type="text/css" href="css/lib_template/selectize.default.css">
</head>
<body class="flat-blue">
<div class="app-container">
    <div class="row content-container">
        <nav class="navbar navbar-default navbar-fixed-top navbar-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-expand-toggle">
                        <i class="fa fa-bars icon"></i>
                    </button>
                    <ol class="breadcrumb navbar-breadcrumb">
                        <li class="active">IMI Management System </li>
                    </ol>
                    <button type="button" class="navbar-right-expand-toggle pull-right visible-xs">
                        <i class="fa fa-th icon"></i>
                    </button>
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <button type="button" class="navbar-right-expand-toggle pull-right visible-xs">
                        <i class="fa fa-times icon"></i>
                    </button>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-comments-o"></i></a>
                        <ul class="dropdown-menu animated fadeInDown">
                            <li class="title">
                                Notification <span class="badge pull-right">0</span>
                            </li>
                            <li class="message">
                                No new notification
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown danger">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-star-half-o"></i> 4</a>
                        <ul class="dropdown-menu danger  animated fadeInDown">
                            <li class="title">
                                Notification <span class="badge pull-right">4</span>
                            </li>
                            <li>
                                <ul class="list-group notifications">
                                    <a href="#">
                                        <li class="list-group-item">
                                            <span class="badge">1</span> <i class="fa fa-exclamation-circle icon"></i> new registration
                                        </li>
                                    </a>
                                    <a href="#">
                                        <li class="list-group-item">
                                            <span class="badge success">1</span> <i class="fa fa-check icon"></i> new orders
                                        </li>
                                    </a>
                                    <a href="#">
                                        <li class="list-group-item">
                                            <span class="badge danger">2</span> <i class="fa fa-comments icon"></i> customers messages
                                        </li>
                                    </a>
                                    <a href="#">
                                        <li class="list-group-item message">
                                            view all
                                        </li>
                                    </a>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown profile">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <?php
                                echo $_SESSION['user_name'];
                            ?>
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu animated fadeInDown">
                            <li>
                                <div class="profile-info">
                                    <h4 class="username">
                                        <?php
                                            echo $_SESSION['user_name'];
                                        ?>
                                    </h4>
                                    <p>
                                        <?php
                                            echo $_SESSION['customer_email'];
                                        ?>
                                    </p>
                                    <div class="btn-group margin-bottom-2x" role="group">
                                        <button type="button" class="btn btn-default"><i class="fa fa-user"></i> Profile</button>
                                        <button type="button" class="btn btn-default">
                                            <a href="logoff.php">
                                                <i class="fa fa-sign-out"></i> Logout
                                            </a>
                                        </button>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="side-menu sidebar-inverse">
            <nav class="navbar navbar-default" role="navigation">
                <div class="side-menu-container">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#">
                            <div class="icon fa fa-paper-plane"></div>
                            <div class="title">IMI Admin</div>
                        </a>
                        <button type="button" class="navbar-expand-toggle pull-right visible-xs">
                            <i class="fa fa-times icon"></i>
                        </button>
                    </div>
                    <ul class="nav navbar-nav">
                        <li class="active">
                            <a href="#">
                                <span class="icon fa fa-tachometer"></span><span class="title">Dashboard</span>
                            </a>
                        </li>
                        <li class="panel panel-default dropdown">
                            <a data-toggle="collapse" href="#dropdown-element">
                                <span class="icon fa fa-desktop"></span><span class="title">Setup Customers</span>
                            </a>
                            <!-- Dropdown level 1 -->
                            <div id="dropdown-element" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul class="nav navbar-nav">
                                        <li><a href="#/customer_type">Customer Type</a></li>
                                        <li><a href="#/customer_list">Customer List</a></li>
                                        <li><a href="#/create_invoice">Create Invoice</a></li>
                                        <li><a href="#/received_payment">Received Payment</a></li>
                                        <li><a href="#/service">Service</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li class="panel panel-default dropdown">
                            <a data-toggle="collapse" href="#dropdown-table">
                                <span class="icon fa fa-table"></span><span class="title">Setup Staff</span>
                            </a>
                            <!-- Dropdown level 1 -->
                            <div id="dropdown-table" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul class="nav navbar-nav">
                                        <li><a href="#/staff_type">Staff Type</a></li>
                                        <li><a href="#/staff_list">Staff List</a></li>
                                        <li><a href="#/staff_payroll">Staff Payroll</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li class="panel panel-default dropdown">
                            <a data-toggle="collapse" href="#dropdown-doctor">
                                <span class="icon fa fa-folder"></span><span class="title">Setup Doctor</span>
                            </a>
                            <!-- Dropdown level 1 -->
                            <div id="dropdown-doctor" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul class="nav navbar-nav">
                                        <li><a href="#/doctor_type">Doctor Type</a></li>
                                        <li><a href="#/doctor_list">Doctor List</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li class="panel panel-default dropdown">
                            <a data-toggle="collapse" href="#dropdown-form">
                                <span class="icon fa fa-file-text-o"></span><span class="title">Setup Vendor</span>
                            </a>
                            <!-- Dropdown level 1 -->
                            <div id="dropdown-form" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul class="nav navbar-nav">
                                        <li><a href="#/vendor_type">Vendor Type</a></li>
                                        <li><a href="#/vendor_list">Vendor List</a></li>
                                        <li><a href="#/pay_bill">Pay Bill</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li class="panel panel-default dropdown">
                            <a data-toggle="collapse" href="#purchase-form">
                                <span class="icon fa fa-file-text-o"></span><span class="title">Purchase</span>
                            </a>
                            <!-- Dropdown level 1 -->
                            <div id="purchase-form" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul class="nav navbar-nav">
                                        <li><a href="#/purchase_order">Purchase Order</a></li>
                                        <li><a href="#/purchase">Purchase</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li class="panel panel-default dropdown">
                            <a data-toggle="collapse" href="#sale-form">
                                <span class="icon fa fa-file-text-o"></span><span class="title">Sale</span>
                            </a>
                            <!-- Dropdown level 1 -->
                            <div id="sale-form" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul class="nav navbar-nav">
                                        <li><a href="#/sale">Sale</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <!-- Dropdown-->
                        <li class="panel panel-default dropdown">
                            <a data-toggle="collapse" href="#component-example">
                                <span class="icon fa fa-cubes"></span><span class="title">Setup Item</span>
                            </a>
                            <!-- Dropdown level 1 -->
                            <div id="component-example" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul class="nav navbar-nav">
                                        <li><a href="#/product_type">Product Type</a></li>
                                        <li><a href="#/product_list">Product List</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <!-- Dropdown-->
                        <li class="panel panel-default dropdown">
                            <a data-toggle="collapse" href="#dropdown-example">
                                <span class="icon fa fa-slack"></span><span class="title">Report</span>
                            </a>
                            <!-- Dropdown level 1 -->
                            <div id="dropdown-example" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul class="nav navbar-nav">
                                        <li><a href="#/cash_flow">Cash Flow</a></li>
                                        <li><a href="#/income_statement">Income Statement</a></li>
                                        <li><a href="#/balance_sheet">Balance Sheet</a></li>
                                        <li><a href="#/stock_report">Stock Report</a></li>
                                        <li><a href="#/staff_report">Staff Report</a></li>
                                        <li><a href="#/sale_report">Sale Report</a></li>
                                        <li><a href="#/account_payable">Account Payable</a></li>
                                        <li><a href="#/account_receivable">Account Receivable</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <!-- Dropdown-->
                        <li class="panel panel-default dropdown">
                            <a data-toggle="collapse" href="#dropdown-icon">
                                <span class="icon fa fa-archive"></span><span class="title">Chart of Account</span>
                            </a>
                            <!-- Dropdown level 1 -->
                            <div id="dropdown-icon" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul class="nav navbar-nav">
                                        <li><a href="#/asset">Asset (10xxx)</a></li>
                                        <li><a href="#/current_set">Current Set (11xxx)</a></li>
                                        <li><a href="#/fix_asset">Fix Asset (20xxx)</a></li>
                                        <li><a href="#/liability">Liability (30XXX)</a></li>
                                        <li><a href="#/equity">Equity (50XXX)</a></li>
                                        <li><a href="#/income">Income (60XXX)</a></li>
                                        <li><a href="#/cost">Cost (70XXX)</a></li>
                                        <li><a href="#/expense">Expense (80XXX)</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li class="panel panel-default dropdown">
                            <a data-toggle="collapse" href="#dropdown-user">
                                <span class="icon fa fa-user"></span><span class="title">User</span>
                            </a>
                            <!-- Dropdown level 1 -->
                            <div id="dropdown-user" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul class="nav navbar-nav">
                                        <li><a href="#/user">List User</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a href="#/license">
                                <span class="icon fa fa-thumbs-o-up"></span><span class="title">License</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </nav>
        </div>
        <!-- Main Content -->
        <div class="container-fluid">
            <div class="side-body padding-top">