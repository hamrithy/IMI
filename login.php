<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2012 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

// redirect the customer to a friendly cookie-must-be-enabled page if cookies are disabled (or the session has not started)
  if ($session_started == false) {
    if ( !isset($HTTP_GET_VARS['cookie_test']) ) {
      $all_get = tep_get_all_get_params();

      tep_redirect(tep_href_link(FILENAME_LOGIN, $all_get . (empty($all_get) ? '' : '&') . 'cookie_test=1', 'SSL'));
    }

    tep_redirect(tep_href_link(FILENAME_COOKIE_USAGE));
  }

// login content module must return $login_customer_id as an integer after successful customer authentication
  $login_customer_id = false;

  $page_content = $oscTemplate->getContent('login');

  if ( is_int($login_customer_id) && ($login_customer_id > 0) ) {
    if (SESSION_RECREATE == 'True') {
      tep_session_recreate();
    }

    $customer_info_query = tep_db_query("
      select
          c.customers_firstname, c.user_name, c.customers_lastname,
          c.customers_default_address_id, ab.entry_country_id,
          ab.entry_zone_id, c.customers_email_address
      from
          " . TABLE_CUSTOMERS . "
            c left join
          " . TABLE_ADDRESS_BOOK . " ab
            on
          (c.customers_id = ab.customers_id and c.customers_default_address_id = ab.address_book_id)
      where
          c.customers_id = '" . (int)$login_customer_id . "'");
    $customer_info = tep_db_fetch_array($customer_info_query);

    $customer_id = $login_customer_id;
    tep_session_register('customer_id');

    $user_name = $customer_info['user_name'];
    tep_session_register('user_name');

      $customer_email = $customer_info['customers_email_address'];
      tep_session_register('customer_email');

    $customer_default_address_id = $customer_info['customers_default_address_id'];
    tep_session_register('customer_default_address_id');

    $customer_first_name = $customer_info['customers_firstname'];
    tep_session_register('customer_first_name');

    $customer_last_name = $customer_info['customers_lastname'];
    tep_session_register('customer_last_name');

    $customer_country_id = $customer_info['entry_country_id'];
    tep_session_register('customer_country_id');

    $customer_zone_id = $customer_info['entry_zone_id'];
    tep_session_register('customer_zone_id');

    tep_db_query("update " . TABLE_CUSTOMERS_INFO . " set customers_info_date_of_last_logon = now(), customers_info_number_of_logons = customers_info_number_of_logons+1, password_reset_key = null, password_reset_date = null where customers_info_id = '" . (int)$customer_id . "'");

// reset session token
    $sessiontoken = md5(tep_rand() . tep_rand() . tep_rand() . tep_rand());

// restore cart contents
    $cart->restore_contents();

    if (sizeof($navigation->snapshot) > 0) {
      $origin_href = tep_href_link($navigation->snapshot['page'], tep_array_to_string($navigation->snapshot['get'], array(tep_session_name())), $navigation->snapshot['mode']);
      $navigation->clear_snapshot();
      tep_redirect($origin_href);
    }

    tep_redirect(tep_href_link(FILENAME_DEFAULT));
  }

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_LOGIN);

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_LOGIN, '', 'SSL'));

//  require(DIR_WS_INCLUDES . 'template_top.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <!-- CSS -->
    <link rel="stylesheet" href="css/login/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/login/assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/login/assets/css/form-elements.css">
    <link rel="stylesheet" href="css/login/assets/css/style.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Favicon and touch icons -->
    <link rel="shortcut icon" href="css/login/assets/ico/favicon.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="css/login/assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="css/login/assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="css/login/assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="css/login/assets/ico/apple-touch-icon-57-precomposed.png">

</head>

<body>
<!-- Top content -->
<div class="top-content">

    <div class="inner-bg">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3 form-box">
                    <div class="form-top">
                        <div class="form-top-left">
                            <h3>Login to our site</h3>
                            <p>Enter your username and password to log on:</p>
                        </div>
                        <div class="form-top-right">
                            <i class="fa fa-lock"></i>
                        </div>
                        <div class="clearfix"></div>
                        <?php
                            if ($messageStack->size('login') > 0) {
                                echo $messageStack->output('login');
                            }
                        ?>
                    </div>
                    <div class="form-bottom">

                            <?php echo tep_draw_form('login', tep_href_link(FILENAME_LOGIN, 'action=process', 'SSL'), 'post', 'class="login-form"', true); ?>
                                <div class="form-group">
                                    <label class="sr-only" for="form-username">Email Address</label>
                                    <input
                                        type="text"
                                        required
                                        name="email_address"
                                        placeholder="Email Address..."
                                        class="form-username form-control"
                                        id="inputEmail"
                                        >
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="form-password">Password</label>
                                    <input
                                        type="password"
                                        name="password"
                                        placeholder="Password..."
                                        class="form-password form-control"
                                        id="inputPassword"
                                        required
                                        >
                                </div>
                                <button type="submit" class="btn">Sign in!</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<!-- Javascript -->
<script src="css/login/assets/js/jquery-1.11.1.min.js"></script>
<script src="css/login/assets/bootstrap/js/bootstrap.min.js"></script>
<script src="css/login/assets/js/jquery.backstretch.min.js"></script>
<script src="css/login/assets/js/scripts.js"></script>

<!--[if lt IE 10]>
<script src="css/login/assets/js/placeholder.js"></script>
<![endif]-->

</body>

</html>
<?php
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
