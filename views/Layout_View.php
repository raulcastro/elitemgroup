<?php
/**
 * This file has the main view of the project
 *
 * @package    Reservation System
 * @subpackage Tropical Casa Blanca Hotel
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Raul Castro <rd.castro.silva@gmail.com>
 */

$root = $_SERVER['DOCUMENT_ROOT'];
/**
 * Includes the file /Framework/Tools.php which contains a 
 * serie of useful snippets used along the code
 */
require_once $root.'/Framework/Tools.php';

/**
 * 
 * Is the main class, almost everything is printed from here
 * 
 * @package 	Reservation System
 * @subpackage 	Tropical Casa Blanca Hotel
 * @author 		Raul Castro <rd.castro.silva@gmail.com>
 * 
 */
class Layout_View
{
	/**
	 * @property string $data a big array cotaining info for especified sections
	 */
	private $data;
	
	/**
	 * get's the data *ARRAY* and the title of the document
	 * 
	 * @param array $data Is a big array with the whole info of the document 
	 * @param string $title The title that will be printed in <title></title>
	 */
	public function __construct($data)
	{
		$this->data = $data;
	}    
	
	/**
	 * function printHTMLPage
	 * 
	 * Prints the content of the whole website
	 * 
	 * @param int $this->data['section'] the section that define what will be printed
	 * 
	 */
	
	public function printHTMLPage()
    {
    ?>
	<!DOCTYPE html>
	<html class='no-js' lang='<?php echo $this->data['appInfo']['lang']; ?>'>
		<head>
			<!--[if IE]> <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> <![endif]-->
			<meta charset="utf-8" />
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
    		<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="shortcut icon" href="favicon.ico" />
			<link rel="icon" type="image/gif" href="favicon.ico" />
			<title><?php echo $this->data['title']; ?> - <?php echo $this->data['appInfo']['title']; ?></title>
			<meta name="keywords" content="<?php echo $this->data['appInfo']['keywords']; ?>" />
			<meta name="description" content="<?php echo $this->data['appInfo']['description']; ?>" />
			<meta property="og:type" content="website" /> 
			<meta property="og:url" content="<?php echo $this->data['appInfo']['url']; ?>" />
			<meta property="og:site_name" content="<?php echo $this->data['appInfo']['siteName']; ?> />
			<link rel='canonical' href="<?php echo $this->data['appInfo']['url']; ?>" />
			<?php echo self::getCommonStyleDocuments(); ?>			
			<?php 
			switch ($this->data['section']) 
			{
				case 'log-in':
 					echo self :: getLogInHead();
				break;

				case 'dashboard':
					# code...
				break;
				
				case 'settings':
					echo self :: getSettingsHead();
				break;
				
				case 'inventory-category':
					echo self::getCategoryHead();
 				break;
				
				case 'add-owner':
					echo self::getAddOwnerHead();
				break;
				
				case 'member':
					echo self::getMemberHead();
				break;
				
				case 'rooms':
					echo self::getRoomsHead();
				break;
				
				case 'room':
					echo self::getRoomHead();
				break;
				
				case 'tasks':
					echo self::getTasksHead();
				break;
			}
			?>
		</head>
		<body id="<?php echo $this->data['section']; ?>" class="hold-transition <?php echo $this->data['template-class']; ?> fixed  skin-blue sidebar-mini">
			<?php 
			if ($this->data['section'] != 'log-in' && $this->data['section'] != 'log-out')
			{
			?>
			<div class="wrapper">
				<?php echo self :: getHeader(); ?>
				<?php echo self :: getSidebar(); ?>
				<!-- Content Wrapper. Contains page content -->
		        <div class="content-wrapper">
		            <!-- Content Header (Page header) -->
		            <section class="content-header">
		                <h1><?php echo $this->data['title']; ?></h1>
		                <ol class="breadcrumb">
		                    <li><a href="#"><i class="fa <?php echo $this->data['icon']; ?>"></i><?php echo $this->data['title']; ?></a></li>
		                    <!-- <li class="active">Here</li> -->
		                </ol>
		            </section>
		            <!-- Main content -->
            		<section class="content">
						<?php 
						switch ($this->data['section']) {

							case 'dashboard':
								echo self::getDashboardIcons();
								echo self::getRecentMembers();
							break;
							
							case 'owners':
								echo self::getRecentMembers();
 							break;
							
							case 'settings':
								echo self::getSettingsContent();
							break;
							
							case 'inventory-category':
								echo self::getCategoryContent();
							break;
							
							case 'add-owner':
								echo self::getAddOwnerContent();
							break;

							case 'member':
								echo self::getMemberContent();
							break;
							
							case 'members':
								echo self::getAllMembers();
							break;
							
							case 'rooms':
								echo self::getRoomsContent();
							break;
							
							case 'room':
								echo self::getRoomContent();
							break;
							
							case 'tasks':
								echo self :: getAllTasks();
							break;

							default :
								# code...
							break;
						}
						?>
					</section>
				</div>
			</div>
			<?php
				echo self::getFooter();
			}
			else
			{
				switch ($this->data['section']) 
				{
					case 'log-in':
						echo self::getLogInContent();
					break;
				
					case 'log-out':
						echo self::getSignOutContent();
					break;
					
					default:
					break;
				}
			}
			
			
			echo self::getCommonScriptDocuments();
			switch ($this->data['section'])
			{
				case 'log-in':
					echo self::getLogInScripts();
				break;
				
				case 'settings':
					echo self::getSettingsScripts();
				break;
				
				case 'inventory-category':
					echo self::getCategoryScripts();
				break;
				
				case 'add-owner':
					echo self::getAddOwnerScripts();
				break;
				
				case 'member':
					echo self::getMemberScripts();
				break;
				
				case 'rooms':
					echo self::getRoomsScripts();
				break;
				
				case 'room':
					echo self::getRoomScripts();
				break;
				
				case 'tasks':
					echo self::getTasksScripts();
				break;
			}
			?>
		</body>
	</html>
    <?php
    }
    
    /**
     * returns the common css and js that are in all the web documents
     * 
     * @return string $documents css & js files used in all the files
     */
    public function getCommonStyleDocuments()
    {
    	ob_start();
    	?>
    	<!-- Bootstrap 3.3.5 -->
	    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
	    <!-- Font Awesome -->
	    <link rel="stylesheet" href="/dist/font-awesome-4.5.0/css/font-awesome.min.css">
	    <!-- Ionicons -->
	    <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
	    <!-- Theme style -->
	    <link rel="stylesheet" href="/dist/css/AdminLTE.min.css">
	    <!-- iCheck -->
	    <link rel="stylesheet" href="/plugins/iCheck/square/blue.css">
	
	    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	    <!--[if lt IE 9]>
	        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	    <![endif]-->
	    <link rel="stylesheet" href="/dist/css/skins/skin-blue.min.css">
       	<link href="/css/style.css" media="screen" rel="stylesheet" type="text/css" />
    	
       	<?php 
       	$documents = ob_get_contents();
       	ob_end_clean();
       	return $documents; 
    }
    
    /**
     * returns the common css and js that are in all the web documents
     * 
     * @return string $documents css & js files used in all the files
     */
    public function getCommonScriptDocuments()
    {
    	ob_start();
    	?>
    	<!-- jQuery 2.1.4 -->
    	<script src="/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    	<!-- Bootstrap 3.3.5 -->
    	<script src="/bootstrap/js/bootstrap.min.js"></script>
    	<!-- AdminLTE App -->
    	<script src="/dist/js/app.min.js"></script>
    	<!-- SlimScroll -->
    	<script src="/plugins/slimScroll/jquery.slimscroll.min.js"></script>
       	<?php 
       	$documents = ob_get_contents();
       	ob_end_clean();
       	return $documents; 
    }
    
    /**
     * The main menu
     *
     * it's the top and main navigation menu
     * if is logged shows a sign-in | sign-up links
     * but if is logged it shows other menus included the sign-out
     *
     * @return string HTML Code of the main menu 
     */
    public function getHeader()
    {
    	ob_start();
    	$active='class="active"';
    	?>  		
		<!-- Main Header -->
        <header class="main-header">

            <!-- Logo -->
            <a href="/" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b><?php echo $this->data['appInfo']['title']; ?></b></span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><?php echo $this->data['appInfo']['title']; ?></span>
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        <li class="dropdown messages-menu">
                            <!-- Menu toggle button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope-o"></i>
                                <span class="label label-success">4</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 4 messages</li>
                                <li>
                                    <!-- inner menu: contains the messages -->
                                    <ul class="menu">
                                        <li>
                                            <!-- start message -->
                                            <a href="#">
                                                <div class="pull-left">
                                                    <!-- User Image -->
                                                    <img src="/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                                                </div>
                                                <!-- Message title and timestamp -->
                                                <h4>Owner Room 2
                            						<small><i class="fa fa-clock-o"></i> 5 mins</small>
												</h4>
                                                <!-- The message -->
                                                <p>Pending payment</p>
                                            </a>
                                        </li>
                                        <!-- end message -->
                                    </ul>
                                    <!-- /.menu -->
                                </li>
                                <li class="footer"><a href="#">See All Messages</a>
                                </li>
                            </ul>
                        </li>
                        <!-- /.messages-menu -->

                        <!-- Notifications Menu -->
                        <li class="dropdown notifications-menu">
                            <!-- Menu toggle button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bell-o"></i>
                                <span class="label label-warning">10</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 10 notifications</li>
                                <li>
                                    <!-- Inner Menu: contains the notifications -->
                                    <ul class="menu">
                                        <li>
                                            <!-- start notification -->
                                            <a href="#">
                                                <i class="fa fa-users text-aqua"></i> 5 new incidents today
                                            </a>
                                        </li>
                                        <!-- end notification -->
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">View all</a>
                                </li>
                            </ul>
                        </li>
                        <!-- Tasks Menu -->
                        <li class="dropdown tasks-menu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-flag-o"></i>
                                <span class="label label-danger">9</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 9 tasks</li>
                                <li>
                                    <!-- Inner menu: contains the tasks -->
                                    <ul class="menu">
                                        <li>
                                            <!-- Task item -->
                                            <a href="#">
                                                <!-- Task title and progress text -->
                                                <h3>Collect Payment<small class="pull-right">20%</small></h3>
                                                <!-- The progress bar -->
                                                <div class="progress xs">
                                                    <!-- Change the css width attribute to simulate progress -->
                                                    <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">20% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <!-- end task item -->
                                    </ul>
                                </li>
                                <li class="footer">
                                    <a href="#">View all tasks</a>
                                </li>
                            </ul>
                        </li>
                        <!-- User Account Menu -->
                        <li class="dropdown user user-menu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <!-- The user image in the navbar-->
                                <img src="/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                <span class="hidden-xs"><?php echo $this->data['userInfo']['name']; ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- The user image in the menu -->
                                <li class="user-header">
                                    <img src="/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                                    <p>
                                        <?php echo $this->data['userInfo']['name']; ?> - Administrator
                                        <small>Member since Nov. 2012</small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-right">
                                        <a href="#" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li>
							<a href="/settings/" ><i class="fa fa-gears"></i></a>
						</li>
                    </ul>
                </div>
            </nav>
        </header>
		
    	<?php
    	$header = ob_get_contents();
    	ob_end_clean();
    	return $header;
    }
    
    
    /**
     * it is the head that works for the sign in section, aparently isn't getting 
     * any parameter, I just left it here for future cases
     *
     * @package 	Reservation System
     * @subpackage 	Sign-in
     * @todo 		Delete it?
     * 
     * @return string
     */
    public function getLogInHead()
    {
    	ob_start();
    	?>
    	<script type="text/javascript">
		</script>
    	<?php
    	$signIn = ob_get_contents();
    	ob_end_clean();
    	return $signIn;
    }
    
    public function getLogInScripts()
    {
    	ob_start();
    	?>
    	<script type="text/javascript">
		</script>
		<script src="/js/log-in.js"></script>
    	<?php
    	$signIn = ob_get_contents();
    	ob_end_clean();
    	return $signIn;
    }
    
    /**
     * getSignInContent
     * 
     * the sign-in box
     * 
     * @package Reservation System
     * @subpackage Sign-in
     * 
     * @return string
     */
    public function getLogInContent()
    {
    	ob_start();
    	?>
		<div class="login-box">
	        <div class="login-logo">
	            <a href="/"><b><?php echo $this->data['appInfo']['siteName']; ?></b></a>
	        </div>
	        <!-- /.login-logo -->
	        <div class="login-box-body">
	            <p class="login-box-msg">Sign in to start your session</p>
	            <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" id="logInForm">
	                <div class="form-group has-feedback">
	                    <input type="email" class="form-control" placeholder="Email" name='loginUser'>
	                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
	                </div>
	                <div class="form-group has-feedback">
	                    <input type="password" class="form-control" placeholder="Password" name='loginPassword'>
	                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
	                </div>
	                <div class="row">
	                    <div class="col-xs-8">
	                        <!-- <div class="checkbox icheck">
	                            <label>
	                                <input type="checkbox"> Remember Me
	                            </label>
	                        </div>
	                       	 -->
	                    </div>
	                    <!-- /.col -->
	                    <div class="col-xs-4">
	                    	<input type="hidden" name="submitButton" value="1">
	                        <button type="submit" class="btn btn-primary btn-block btn-flat" id="logins">Log In</button>
	                    </div>
	                    <!-- /.col -->
	                </div>
	            </form>
	        </div>
	        <!-- /.login-box-body -->
	    </div>
	    <!-- /.login-box -->
        <?php
        $wideBody = ob_get_contents();
        ob_end_clean();
        return $wideBody;
    }
    
    /**
     * getSignOutContent
     *
     * It finish the session
     *
     * @package 	Reservation System
     * @subpackage 	Sign-in
     *
     * @return string
     */
    public function getSignOutContent()
    {
    	ob_start();
    	?>
       	<div class="row login-box" id="sign-in">
    		<div class="col-md-4 col-md-offset-4">
    			<h3 class="text-center">You've been logged out successfully</h3>
    			<br />
    	    	<div class="panel panel-default">
					<div class="panel-body">
						<a href="/" class="btn btn-lg btn-success btn-block">Login</a>
					</div>
    			</div>
    		</div>
    	</div>
		<?php
		$wideBody = ob_get_contents();
		ob_end_clean();
		return $wideBody;
    }
   	
    /**
     * The side bar of the apliccation
     * 
     * Is the side-bar of the application where the main sections are as links
     * 
     * @return string
     */
   	public function getSidebar()
   	{
   		ob_start();
   		$active = 'class="active"';
   		?>
   		<!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">

            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">

                <!-- Sidebar user panel (optional) -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p><?php echo $this->data['userInfo']['name']; ?></p>
                        <!-- Status -->
                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <ul class="sidebar-menu">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="active"><a href="/dashboard/"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
                    <li>
						<a href="">
							<i class="fa fa-envelope"></i> <span>Messages</span>
							<small class="label pull-right bg-yellow">12</small>
						</a>
					</li>
                    <li><a href="/tasks/"><i class="fa fa-tasks"></i> <span>Tasks</span></a></li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-users"></i>
                            <span>Owners</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="/add-owner/"><i class="fa fa-circle-o"></i> Add owner</a></li>
                            <li><a href="/owners/"><i class="fa fa-circle-o"></i> View all owners</a></li>
                        </ul>
                    </li>
                    <li><a href="/rooms/"><i class="fa fa-home"></i> <span>Rooms</span></a></li>
                    <li><a href="#"><i class="fa fa-bolt"></i> <span>Incidents</span></a></li>
                    <li>
						<a href="#">
							<i class="fa fa-money"></i> <span>Payments</span>
							<small class="label pull-right bg-red">12</small>
						</a>
					</li>
                </ul>
                <!-- /.sidebar-menu -->
            </section>
            <!-- /.sidebar -->
        </aside>
   		<?php
   		$sideBar = ob_get_contents();
   		ob_end_clean();
   		return $sideBar;
   	}
   	
   	/**
   	 * the big icons that appear on the top of every section
   	 * 
   	 * @return string
   	 */
   	public function getDashboardIcons() 
   	{
   		ob_start();
   		?>
		<div class="row">
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
                	<span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>
                	<div class="info-box-content">
						<span class="info-box-text">Owners</span>
						<span class="info-box-number"><?php echo $this->data['totalMembers']; ?></span>
					</div><!-- /.info-box-content -->
				</div><!-- /.info-box -->
			</div><!-- /.col -->
			
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
                	<span class="info-box-icon bg-green"><i class="fa fa-tasks"></i></span>
                	<div class="info-box-content">
						<span class="info-box-text">Tasks</span>
						<span class="info-box-number"><?php echo $this->data['taskInfo']['today']; ?></span>
						<span class="progress-description"><?php echo $this->data['taskInfo']['pending']; ?> pending</span>
					</div><!-- /.info-box-content -->
				</div><!-- /.info-box -->
			</div><!-- /.col -->
			
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
                	<span class="info-box-icon bg-yellow"><i class="fa fa-envelope-o"></i></span>
                	<div class="info-box-content">
						<span class="info-box-text">Owners</span>
						<span class="info-box-number">4</span>
					</div><!-- /.info-box-content -->
				</div><!-- /.info-box -->
			</div><!-- /.col -->
			
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
                	<span class="info-box-icon bg-red"><i class="fa fa-money"></i></span>
                	<div class="info-box-content">
						<span class="info-box-text">Payments</span>
						<span class="info-box-number">2</span>
					</div><!-- /.info-box-content -->
				</div><!-- /.info-box -->
			</div><!-- /.col -->
		</div>
          <!-- =========================================================== -->
   		<?php
   		$dashboardIcons = ob_get_contents();
   		ob_end_clean();
   		return $dashboardIcons;
   	}
   	
   	/**
   	 * Last n members
   	 * 
   	 * Is like a preview, it is printed onthe dashboard
   	 * 
   	 * @return string
   	 */
   	
   	public function getRecentMembers()
   	{
   		ob_start();
   		?>
   		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Recent Owners</h3>
						<!-- <div class="box-tools">
							<div class="input-group" style="width: 150px;">
								<input type="text" name="table_search" class="form-control input-sm pull-right" placeholder="Search">
								<div class="input-group-btn">
									<button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
								</div>
							</div>
						</div> -->
					</div><!-- /.box-header -->
					<div class="box-body table-responsive no-padding">
	                  <table class="table table-hover">
	                    <tr>
	                      <th>Member ID</th>
							<th>Name</th>
							<th>Phone</th>
							<th>Email</th>
							<?php 
							if ($_SESSION['loginType'] == 1)
							{
							?>
								<th>Added by</th>
							<?php 
							} 
							else 
							{
							?>
								<th>Address</th>
							<?php 
							}
							?>
							<th>Date</th>
	                    </tr>
	                    <?php 
						foreach ($this->data['lastMembers'] as $member)
						{
							?>
						<tr>
							<td>
								<a href="/owner/<?php echo $member['member_id']; ?>/<?php echo Tools::slugify($member['name'].' '.$member['last_name']); ?>/">
									<?php echo $member['member_id']; ?>
								</a>
							</td>
							<td>
								<a href="/owner/<?php echo $member['member_id']; ?>/<?php echo Tools::slugify($member['name'].' '.$member['last_name']); ?>/" class="member-link">
									<?php echo $member['name'].' '.$member['last_name']; ?>
								</a>
							</td>
							<td><?php echo $member['phone_one']; ?></td>
							<td><?php echo $member['email_one']; ?></td>
							<?php 
							if ($_SESSION['loginType'] == 1)
							{
								?>
								<td><?php echo $member['user_name']; ?></td>
								<?php 
							} 
							else 
							{
								?>
								<td><?php echo $member['address']; ?></td>
								 <?php 
							}
							?>
							<td><?php echo Tools::formatMYSQLToFront($member['date']); ?></td>
						</tr>
							<?php
						}
						?>
	                  </table>
                	</div><!-- /.box-body -->
				</div><!-- /.box -->
			</div>
		</div>
   		<?php
   		$membersRecent = ob_get_contents();
   		ob_end_clean();
   		return $membersRecent;
   	}
	
   	/**
   	 * The whole list of members
   	 * 
   	 * @return string
   	 */
   	public function getAllMembers()
   	{
   		ob_start();
   		?>
   		<div class="table-responsive">
   			<table class="table table-striped">
   				<thead>
   					<tr>
   						<th>Member ID</th>
   						<th>Name</th>
   						<?php 
   						if ($_SESSION['loginType'] == 1)
   						{
   							?>
   							<th>Added by</th>
   							<?php 
   						} else {
   							?>
   							<th>Address</th>
   							 <?php 
   						}
   						?>
   						<th>City</th>
   						<th>State</th>
   						<th>Country</th>
   					</tr>
   				</thead>
   				<tbody>
   					<?php 
   					foreach ($this->data['members'] as $member)
   					{
   					?>
   					<tr>
   						<td>
   							<a href="/<?php echo $member['member_id']; ?>/<?php echo Tools::slugify($member['name'].' '.$member['last_name']); ?>/">
   							<?php echo $member['member_id']; ?>
   							</a>
   						</td>
   						<td>
   							<a href="/<?php echo $member['member_id']; ?>/<?php echo Tools::slugify($member['name'].' '.$member['last_name']); ?>/" class="member-link">
   								<?php echo $member['name'].' '.$member['last_name']; ?>
   							</a>
   						</td>
   						<?php 
   						if ($_SESSION['loginType'] == 1)
   						{
   							?>
   							<td><?php echo $member['user_name']; ?></td>
   							<?php 
   							} else {
   							?>
   							<td><?php echo $member['address']; ?></td>
   							 <?php 
   							}
   						?>
   						<td><?php echo $member['city']; ?></td>
   						<td><?php echo $member['state']; ?></td>
   						<td><?php echo $member['country']; ?></td>
   					</tr>
   						<?php
   					}
   					?>
   				</tbody>
   			</table>
   		</div>
   	   	<?php
   	   	$membersRecent = ob_get_contents();
   	   	ob_end_clean();
   	   	return $membersRecent;
   	}

   	/**
   	 * The head element of Members
   	 * 
   	 * It contains the <strong>extra</strong> files needed
   	 * such jquery-ui.css, tasks.js, ...
   	 * 
   	 * @return string
   	 */
   	public function getMembersHead()
   	{
   		ob_start();
   		?>
		<link rel="stylesheet" href="/css/jquery-ui.css">
		<script src="/js/jquery-ui.js"></script>
		<script src="/js/members.js"></script>
		<script src="/js/history.js"></script>
		<script src="/js/tasks.js"></script>
		<script src="/js/reservations.js"></script>
		<script>
		$(function() {
			$( "#task-date" ).datepicker();

			$( "#checkIn" ).datepicker({
				altFormat: "d M, y",
				changeMonth: true,
			    changeYear: true,
				onSelect: function(dateText, inst) 
				{
	            	$( "#checkOut" ).datepicker( "option", "defaultDate", dateText );
	        	}
        	});
        	
	        $( "#checkOut" ).datepicker({
	        	altFormat: "d M, y",
				changeMonth: true,
			    changeYear: true,
		        onSelect: function(dateText, inst) 
		        {
	            	$( "#checkIn" ).datepicker( "option", "defaultDate", dateText );
	        	}
        	});

	<?php 
					
	if ($this->data['memberReservations'])
		foreach ($this->data['memberReservations'] as $reservation)
		{
			if ($reservation['status'] != 5)
			{
			?>
				$( "#dateBoxCheckIn-<?php echo $reservation['reservation_id']; ?>").datepicker(
					{
						defaultDate:new Date("<?php echo Tools::formatMYSQLToJS($reservation['check_in']); ?>"),
						onSelect: function()
						{
							$('#availableRoomsSelect-'+<?php echo $reservation['reservation_id']; ?>).attr('disabled', false);
							updateAvailableRooms("<?php echo $reservation['reservation_id']; ?>");

							$('.room-aux-'+<?php echo $reservation['reservation_id']; ?>).show();
						}
					}
				);
				$( "#dateBoxCheckOut-<?php echo $reservation['reservation_id']; ?>").datepicker(
					{
						defaultDate:new Date("<?php echo Tools::formatMYSQLToJS($reservation['check_out']); ?>"),
						onSelect: function()
						{
							$('#availableRoomsSelect-'+<?php echo $reservation['reservation_id']; ?>).attr('disabled', false);
							updateAvailableRooms("<?php echo $reservation['reservation_id']; ?>");
							$('.room-aux-'+<?php echo $reservation['reservation_id']; ?>).show();
						}
					}
				);
	<?php 
   			}
		}
	?>
			});
		</script>
		
		<?php
		$signIn = ob_get_contents();
		ob_end_clean();
		return $signIn;
	}
	
	/**
	 * Show the member profiles
	 * 
	 * <s>In this section you had the abilitie of add a new member</s>
	 * It is the main interface where to show the member profile
	 * 
	 * @todo rename this method with better descriptive name
	 * 
	 * @return string
	 */
   	
   	public function getAddMember()
   	{
   		ob_start();
   		if ($this->data['memberInfo']['member_id'])
   		{
   			$memberId = $this->data['memberInfo']['member_id'];
   			$memberId = str_pad($memberId, 4, '0', STR_PAD_LEFT);
   		}
   		?>
		<div class="row">
			<div class="col-md-6">
				<form class="form-horizontal" role="form">
					<fieldset>
						<!-- Text input-->
						<div class="form-group">
							<label class="col-sm-2 control-label" for="textinput"><b>Guest#</b></label>
							<div class="col-sm-10">
								<input type="text" value="<?php echo $memberId; ?>" class="form-control" id="member-id" readonly="readonly">
							</div>
						</div>
					
						<!-- Text input-->
						<div class="form-group">
							<label class="col-sm-2 control-label" for="textinput">Name</label>
							<div class="col-sm-10">
								<input type="text" placeholder="Name" class="form-control" id="member-name" value="<?php echo $this->data['memberInfo']['name']; ?>">
							</div>
						</div>
						
						<!-- Text input-->
						<div class="form-group">
							<label class="col-sm-2 control-label" for="textinput">Last Name</label>
							<div class="col-sm-10">
								<input type="text" placeholder="Last Name" class="form-control" id="member-last-name" value="<?php echo $this->data['memberInfo']['last_name']; ?>">
							</div>
						</div>
						
						<!-- Text input-->
						<div class="form-group">
							<label class="col-sm-2 control-label" for="textinput">Address</label>
							<div class="col-sm-10">
								<input type="text" placeholder="Address" class="form-control" id="member-address" value="<?php echo $this->data['memberInfo']['address']; ?>">
							</div>
						</div>
						
						<!-- Text input-->
						<div class="form-group">
							<label class="col-sm-2 control-label" for="textinput">Country</label>
							<div class="col-sm-10">
								<select id="country_list" onchange="selCountry(this);" class="form-control">
									<option value="0">Select Country</option>
									<?php
									
									foreach ($this->data['countries'] as $cl)
									{
										$selected = '';
										
										if ($cl['Code'] == $this->data['memberInfo']['country_code'])
											$selected = 'selected';
										?>
									<option value="<?php echo $cl['Code']; ?>" <?php echo $selected; ?>><?php echo $cl['Name']; ?></option>
										<?php	
									}
									?>
								</select>
							</div>
						</div>
						<input type="hidden" id="country" value="<?php echo $this->data['memberInfo']['country_code']; ?>" />
						
						<!-- Text input-->
						<div class="form-group">
							<label class="col-sm-2 control-label" for="textinput">State</label>
							<div class="col-sm-10">
								<select id="state_list" onchange="selState(this);" class="form-control">
									<option value="0">Select State</option>
									<?php 
									if ($this->data['memberInfo']['state'])
									{
										?>
									<option selected><?php echo $this->data['memberInfo']['state']; ?></option>
										<?php
									}
									?>
								</select>
							</div>
						</div>
						<input type="hidden" id="mState" value="<?php echo $this->data['memberInfo']['state']; ?>" />
						
						<!-- Text input-->
						<div class="form-group">
							<label class="col-sm-2 control-label" for="textinput">City</label>
							<div class="col-sm-10">
								<select id="city_list" onchange="selCity(this);" class="form-control">
									<option value="0">Select City</option>
									<?php 
									if ($this->data['memberInfo']['city'])
									{
										?>
									<option selected><?php echo $this->data['memberInfo']['city']; ?></option>
										<?php
									}
									?>
								</select>
							</div>
						</div>
						<input type="hidden" id="city" value="<?php echo $this->data['memberInfo']['city']; ?>" />
					</fieldset>
				</form>
			</div><!-- /.col-lg-12 -->
			
			<div class="col-md-6">
				<form class="form-horizontal" role="form">
					<fieldset>
						<!-- Text input-->
						<div id="memberEmails">
							<div class="form-group">
								<label class="col-sm-2 control-label" for="textinput">Email</label>
								<div class="col-sm-9">
									<input type="text" placeholder="Email" class="form-control memberEmail" eid="0">
								</div>
								<a href="javascript:void(0);" id="addEmailField" class="text-success col-sm-1 control-label">
									<i class="glyphicon glyphicon-plus"></i>
								</a>
							</div>
							<?php 
							if ($this->data['memberEmails'])
							{
								foreach ($this->data['memberEmails'] as $email)
								{
								?>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="textinput">Email</label>
								<div class="col-sm-9">
									<input type="text" placeholder="Email" class="form-control memberEmail" eid="<?php echo $email['email_id']; ?>" value="<?php echo $email['email']; ?>">
								</div>
							</div>	
								<?php
								}
							}
							?>
						</div>

						<!-- Text input-->
						<div id="memberPhones">
							<div class="form-group">
								<label class="col-sm-2 control-label" for="textinput">Phone</label>
								<div class="col-sm-9">
									<input type="text" placeholder="Phone" class="form-control memberPhone" pid="0">
								</div>
								<a href="javascript:void(0);" class="text-success col-sm-1 control-label" id="addPhoneField" >
									<i class="glyphicon glyphicon-plus"></i>
								</a>
							</div>
							<?php 
							if ($this->data['memberPhones'])
							{
								foreach ($this->data['memberPhones'] as $phone)
								{
								?>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="textinput">Phone</label>
								<div class="col-sm-9">
									<input type="text" placeholder="Phone" class="form-control memberPhone" pid="<?php echo $phone['phone_id']; ?>" value="<?php echo $phone['phone']; ?>">
								</div>
							</div>	
								<?php
								}
							}
							?>
						</div>
					</fieldset>
					
					<fieldset>
						<!-- Form Name -->
						<legend>Notes</legend>
						<!-- Textarea input-->
						<div class="form-group">
							<div class="col-sm-10 col-sm-offset-2">
								<textarea rows="6" cols="" class="form-control" placeholder="notes" id="notes"><?php echo $this->data['memberInfo']['notes']; ?></textarea>
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
							<div class="pull-right">
								<button type="submit" class="btn btn-primary" id="memberSave">Save</button>
							</div>
							</div>
						</div>
					</fieldset>
				</form>
			</div><!-- /.col-lg-12 -->
		</div><!-- /.row -->

		<div class="row">
			<div class="alert alert-success alert-autocloseable-success">
        		<i class="glyphicon glyphicon-ok"></i> The info was sucessfully updated
			</div>
		</div>

		<div class="row utilities" id="utilitiesBox">
			<div class="col-md-12">
	
				<div class="tabbable-panel">
					<div class="tabbable-line">
						<ul class="nav nav-tabs ">
							<li class="active">
								<a href="#tab_default_1" data-toggle="tab">Reservations</a>
							</li>
							<li class="">
								<a href="#tab_default_2" data-toggle="tab">History </a>
							</li>
							<li>
								<a href="#tab_default_3" data-toggle="tab">Tasks</a>
							</li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="tab_default_1">
								<?php echo $this->getMemberReservations(); ?>
							</div>
							<div class="tab-pane" id="tab_default_2">
								<?php echo $this->getHistoryPanel(); ?>
							</div>
							<div class="tab-pane" id="tab_default_3">
								<?php echo $this->getTaskPanel(); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
		$membersRecent = ob_get_contents();
		ob_end_clean();
		return $membersRecent;
	}
   	
	
	/**
	 * The box of the reservation search engine that is displayed under the member profile
	 * @return string
	 */
	public function getMemberReservations()
   	{
   		ob_start();
   		?>
   		<div class="row">
   			<?php echo $this->getReservationPanel(); ?>
   		</div>
   		<div class="row memberReservations" id="memberReservations">
   		<?php
   		if ($this->data['memberReservations'])
   			foreach ($this->data['memberReservations'] as $reservation)
   			{
   				echo $this->getMemberReservationItem($reservation);
   			}
   		?>
   		</div>
   		<?php
   		$memberReservation = ob_get_contents();
   		ob_end_clean();
   		return $memberReservation;
   	}

   	/**
   	 * Display a list of available rooms
   	 * 
   	 * This is called via <strong>AJAX</strong>, is a list of available rooms, depending on the check-in check-out date
   	 *  
   	 * @param array $rooms list of rooms in an array 
   	 * @return string
   	 */
   	
   	public static function getRoomsList($rooms)
	{
		ob_start();
		if ($rooms)
		{
			?>
			<ul class="roomTypeList">
			<?php
			$roomType = 0;
			$c = 0;
			foreach ($rooms as $room)
			{
				if ($c == 0 && $roomType != $room['room_type_id']) 
				{
					?>
				<li class="row">
					<ul class="roomList">
					<?php
					$roomType = $room['room_type_id'];
				}
				?>
						<li class="row bg-success">
							<div class="title col-sm-8">
								<strong><?php echo $room['room']; ?></strong>
								 - <?php echo $room['room_type']; ?>
							</div>
							<div class="operator col-sm-4">
								<a href="javascript:void (0);" rn="<?php echo $room['room']; ?>" ri="<?php echo $room['room_id']; ?>">book now</a>
							</div>
						</li>
				<?php
				if ($roomType != $room['room_type_id'] )
				{
					?>
					</ul>
				</li>
				<li class="row">
					
					<ul class="roomList">	
					<?php
					$roomType = $room['room_type_id'];
				}
				$c++;
			}
			?>
			</ul>
			<?php
		}
		$roomList = ob_get_contents();
		ob_end_clean();
		return $roomList;
	}

	/**
	 * The controls for check a room availability
	 * 
	 * Is where we choose check-in, check-out, number of people and so
	 * 
	 * @todo work a bit more with the datepicker
	 * 
	 * @return string
	 */
   	public function getReservationPanel()
	{
		ob_start();
		?>
		<div class="col-sm-12 reservation-member-panel">
			<div class="reservationBox" id="reservationBox">
				<div class="searchReservation row">
					<div class="col-sm-3">
						<label>Check In</label>
						<input type="text" class="checkIn" id="checkIn" />
					</div>
					<div class="col-sm-3">
						<label>Check Out</label>
						<input type="text" class="checkOut" id="checkOut" />
					</div>
					<div class="col-sm-2">
						<label>Adults</label>
						<select id="reservationAdults">
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
							<option value="10">10</option>
							<option value="11">11</option>
							<option value="12">12</option>
						</select>
					</div>
					<div class="col-sm-2">
						<label>Children</label>
						<select id="reservationChildren">
							<option value="0">0</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
						</select>
					</div>
					<div class="col-sm-2">
						<a href="javascript:void(0);" class="btn btn-info btn-xs" id="searchReservation">search</a>
					</div>
				</div>
				<div class="row">
					<div class="reservationResults row col-sm-6" id="reservationResults">
					</div>
					<div class="row col-sm-6">
						<?php echo $this->getRightSideReservations(); ?>
					</div>
				</div>
			</div>
		</div>
		<?php
		$reservationPanel = ob_get_contents();
		ob_end_clean();
		return $reservationPanel;
	}
	
	/**
	 * extra info after choose a room
	 * 
	 * Extra info for the reservation
	 * <strong>This can create a new member</strong>
	 * 
	 * @return string
	 */
	public function getRightSideReservations()
	{
		ob_start();
		?>
		<div class="row rightSideReservations" id="rightSideReservations">
			<p class="bg-success text-center roomName"><strong id="roomName"></strong></p>
			<p class="text-success text-center">from <span id="checkInReservation"></span> to <span id="checkOutReservation"></span></p>
			<p class="text-info text-center"><strong> <span id="totalDays"></span> nights</strong> </p>
			<div class="forms">
				
				<input type="hidden" id="roomId" value='0' />
				<?php 
				if (!$this->data['memberInfo']['member_id'])
				{
					?>
				<input type="hidden" id="memberId" value='0' />
				<div class="row">
					<div class="col-sm-3">
						<label>Name</label>
					</div>
					<div class="col-sm-9">
						<input type="text" id="member-name" />
					</div>
				</div>
				
				<div class="row">
					<div class="col-sm-3">
						<label>Last Name</label>
					</div>
					<div class="col-sm-9">
						<input type="text" id="member-last-name" />
					</div>
				</div>
					<?php
				}
				?>
				
				<div class="row">
					<div class="col-sm-3">
						<label>Agency</label>
					</div>
					<div class="col-sm-9">
						<select id="agencyList">
						<?php
						foreach ($this->data['agencies'] as $agency)
						{
							?>
							<option value="<?php echo $agency['agency_id']; ?>"><?php echo $agency['agency']; ?></option>
							<?php
						}
						?>
						</select>
					</div>
				</div>
				
				<div class="row">
					<div class="col-sm-3">
						<label>External ID</label>
					</div>
					<div class="col-sm-9">
						<input type="text" id="externalId" />
					</div>
				</div>
				
				<div class="row">
					<div class="col-sm-3">
						<label>Price per Night</label>
					</div>
					<div class="col-sm-9">
						<input type="text" id="pricePerNight" />
					</div>
				</div>
				
				<div class="row">
					<div class="col-sm-3">
						<label>Total</label>
					</div>
					<div class="col-sm-9">
						<input type="text" id="totalReservation" readonly="readonly" />
					</div>
				</div>
				
				<?php 
				if (!$this->data['memberInfo']['member_id'])
				{
					?>
				<div class="row text-center">
					<a href="javascript:void(0);" class="btn btn-info btn-xs" id="bookRoom">Book Now</a>
				</div>
				
				<div class="row text-center">
					<a href="javascript:void(0);" class="text-success" id="completeProfileBtn">Complete Profile</a>
				</div>
					<?php
				}
				else 
				{
					?>
				<div class="row text-center">
					<a href="javascript:void(0);" class="btn btn-info btn-xs" id="bookRoomMember">Book Now</a>
				</div>
					<?php
				}
				?>
				
				<div class="row text-center text-info" id="loadingText">
					<i>Loading ...</i>
				</div>
			</div>
		</div>
		<?php
		$rightSideReservations = ob_get_contents();
		ob_end_clean();
		return $rightSideReservations;
	}

	/**
   	 * getMemberReservationItem
   	 * 
   	 * print the reservation belongs to a member
   	 * 
   	 * @param array $data array with the reservation info
   	 * @return string html of the reservation item
   	 */
   	public function getMemberReservationItem($data)
   	{
   		ob_start();
   		$class = '';
   		if ($data['status'] == '5')
   			$class = 'canceled-reservation';
   		?>
   		<div class="col-sm-12 reservation-item <?php echo $class; ?>" id="reservation-item-<?php echo $data['reservation_id']; ?>">
   			
   			<div class="row bg-primary title">
   				<div class="col-sm-1">Date</div>
   				<div class="col-sm-1">Room</div>
   				<div class="col-sm-2">Check-In</div>
   				<div class="col-sm-2">Check-Out</div>
   				<div class="col-sm-1"></div>
   				<div class="col-sm-1"></div>
   			</div>
   				
   			<div class="row info">
<!--    				Current info about rooms -->
   				<input type="hidden" id="currentRoomId-<?php echo $data['reservation_id']; ?>" value="<?php echo $data['room_id']; ?>" />
   				<input type="hidden" id="currentCheckIn-<?php echo $data['reservation_id']; ?>" value="<?php echo Tools::formatMySQLtoJS($data['check_in']); ?>" />
   				<input type="hidden" id="currentCheckOut-<?php echo $data['reservation_id']; ?>" value="<?php echo Tools::formatMySQLtoJS($data['check_out']); ?>" />
   				
   				<div class="col-sm-1"><?php echo Tools::formatMYSQLToFront($data['date']); ?></div>
   				<div class="col-sm-1"><strong><?php echo $data['room']; ?></strong></div>
   				<div class="col-sm-2"><strong><input type="text" id="dateBoxCheckIn-<?php echo $data['reservation_id']; ?>" value="<?php echo Tools::formatMYSQLToJS($data['check_in']); ?>"> </strong></div>
   				<div class="col-sm-2"><strong><input type="text" id="dateBoxCheckOut-<?php echo $data['reservation_id']; ?>" value="<?php echo Tools::formatMYSQLToJS($data['check_out']); ?>"> </strong></div>
   				<div class="col-sm-1">
   					<select id="availableRoomsSelect-<?php echo $data['reservation_id']; ?>"  disabled="true">
   						<option selected><?php echo $data['room']; ?></option>
   						<?php 
   						foreach ($data['availableRooms'] as $room)
   						{
   							?>
   							<option value="<?php echo $room['room_id']; ?>"><?php echo $room['room']; ?></option>
   							<?php
   						}
   						?>
   					</select>
   				</div>
   				<div class="col-sm-1 room-aux room-aux-<?php echo $data['reservation_id']; ?>">No. Days: <strong id="totalNightsRes-<?php echo $data['reservation_id']; ?>"></strong></div>
   				<div class="col-sm-2 room-aux room-aux-<?php echo $data['reservation_id']; ?>"><input type="text" class="priceCalculator" placeholder="cost per night" value="0" id="newCostPerNight-<?php echo $data['reservation_id']; ?>" resId="<?php echo $data['reservation_id']; ?>"/></div>
   				<div class="col-sm-1 room-aux room-aux-<?php echo $data['reservation_id']; ?>">Total: <strong id="newTotalStaying-<?php echo $data['reservation_id']; ?>" ></strong></div>
   				<div class="col-sm-1 room-aux room-aux-<?php echo $data['reservation_id']; ?>">
   					<button type="button" class="updateRoom btn btn-default btn-xs btn-info" res-id="<?php echo $data['reservation_id']; ?>">Update room</button>
   				</div>
   				
   			</div>
   				
   			<div class="row extra">
   				<div class="col-sm-2">Room Type: <strong><?php echo $data['room_type']; ?></strong></div>
   				<div class="col-sm-2">Reservation ID: <strong><?php echo $data['reservation_id']; ?></strong></div>
   				<div class="col-sm-2">Adults: <strong><?php echo $data['adults']; ?></strong></div>
   				<div class="col-sm-2">Children: <strong><?php echo $data['children']; ?></strong></div>
   				<div class="col-sm-2">No. of nights: <strong><?php echo $data['n_days']; ?></strong></div>
   			</div>
   			
   			<div class="row extra">
   				<div class="col-sm-4">
   					Agency: 
   					<?php 
   					if ($this->data['userInfo']['type'] == 1)
   					{
   						?>
   					<select id="agencyListReservation-<?php echo $data['reservation_id']; ?>">
						<?php
						foreach ($this->data['agencies'] as $agency)
						{
							$selected = '';
							if ($agency['agency'] == $data['agency'])
								$selected = 'selected';
							?>
						<option value="<?php echo $agency['agency_id']; ?>" <?php echo $selected; ?>><?php echo $agency['agency']; ?></option>
							<?php
						}
						?>
					</select>
   						<?php
   					}
   					else
   					{
   						?>
   					<strong><?php echo $data['agency']; ?></strong>
   					<input type="hidden" id="agencyListReservation-<?php echo $data['reservation_id']; ?>" value="<?php echo $data['agency_id']; ?>">
   						<?php 
   					}
   					?>
   				</div>
   				<div class="col-sm-4">External Id: <strong><?php echo $data['external_id']; ?></strong></div>
   			</div>
   			
   			<div class="row extra">
   				<input type="hidden" value="0" id="res-option-<?php echo $data['reservation_id']; ?>">
   				<div class="title-options">
   					Set Reservation as:
   				</div>
   				
   				<div class="reservation-options">
   					<div class="option pending <?php if ($data['status'] == '1') echo 'checked'; ?>" opt-res="1" single-res="<?php echo $data['reservation_id']; ?>">Pending</div>
   					<div class="option canceled <?php if ($data['status'] == '5') echo 'checked'; ?>" opt-res="5" single-res="<?php echo $data['reservation_id']; ?>">Canceled</div>
   					<div class="option confirmed <?php if ($data['status'] == '2') echo 'checked'; ?>" opt-res="2" single-res="<?php echo $data['reservation_id']; ?>">Confirmed</div>
   					<div class="option checked-in <?php if ($data['status'] == '3') echo 'checked'; ?>" opt-res="3" single-res="<?php echo $data['reservation_id']; ?>">Checked-In</div>
   					<div class="option checked-out <?php if ($data['status'] == '4') echo 'checked'; ?>" opt-res="4" single-res="<?php echo $data['reservation_id']; ?>">Checked-Out</div>
   				</div>
   			</div>
   			
   			<div class="row-extra">
   				<div class="col-sm-4">
   					<h5>Grand Total <strong> $ <span id="payment-grand-total-<?php echo $data['reservation_id']; ?>"><?php echo $data['grandTotal']; ?></span></strong></h5>
   				</div>
   				<div class="col-sm-4">
   					<h5>Paid: <strong> <span id="payment-paid-total-<?php echo $data['reservation_id']; ?>">$ <?php echo $data['paid']; ?></span></strong></h5>
   				</div>
   				<div class="col-sm-4">
   					<h5 class="pending-highlight">Pending: <strong> <span id="payment-pending-total-<?php echo $data['reservation_id']; ?>">$ <?php echo $data['unpaid']; ?></span></strong></h5>
   				</div>
   			</div>
   			
   			<div class="row-extra">
   				<div class="col-sm-4">Staying cost total: <strong id="payment-staying-total-<?php echo $data['reservation_id']; ?>">$ <?php echo $data['staying_total']; ?> </strong></div>
   				<div class="col-sm-4">Staying cost paid: <strong id="payment-staying-paid-<?php echo $data['reservation_id']; ?>"> $ <?php echo $data['staying_paid']; ?></strong></div>
   				<div class="col-sm-4">Staying cost pending: <strong id="payment-staying-pending-<?php echo $data['reservation_id']; ?>"> $ <?php echo $data['staying_pending']; ?></strong></div>
   			</div>
   			
   			<div class="clearfix"></div>
   			
   			<div class="row-extra payment-items" id="payment-items-<?php echo $data['reservation_id']; ?>" >
   			<?php 
   			if ($data[0]['payments'])
   				echo Layout_View::getPaymentItems($data[0]['payments']);
   			?>
   			</div>
   			<br>
   			<?php 
   			if ($data['status'] < 4)
   			{
   			?>
   			<div class="row-extra payment-extra" id="">
   				<div class="row">
	   				<div class="col-sm-3">
	   					<input type="text" placeholder="description" id="extra-pay-des-<?php echo $data['reservation_id']; ?>" />
	   				</div>
	   				<div class="col-sm-2">
	   					$ <input type="text" class="input-cost" placeholder="cost" id="extra-pay-cost-<?php echo $data['reservation_id']; ?>" />
	   				</div>
	   				<div class="col-sm-2">
	   					<input type="checkbox" name="staying" value="staying" id="extra-pay-staying-<?php echo $data['reservation_id']; ?>"> Staying cost
	   				</div>
	   				<div class="col-sm-1">
	   					<button type="button" class="btn btn-info btn-xs add-extra-pay" res-id="<?php echo $data['reservation_id']; ?>" >ADD</button>
	   				</div>
   				</div>
   			</div>
   			
   			<div class="row extra save-single-res">
   				<a href="javascript:void(0);" 
   					class="btn btn-info btn-xs save-single-res-a" 
   					single-res="<?php echo $data['reservation_id']; ?>">save</a>
   			</div>
   			<?php 
   			}
   			?>
   			
   		</div>
   		<?php
   		$item = ob_get_contents();
   		ob_end_clean();
   		return $item;
   	}
   	
   	/**
   	 * display a single payment item
   	 * 
   	 * @param array $payments list of payments
   	 * @return string
   	 */
   	public function getPaymentItems($payments)
   	{
   		ob_start();
   		foreach ($payments as $payment)
   		{
   		?>
   		<div class="row">
   			<div class="col-sm-3">
   				<i>
 			<?php 
 			if ($payment['staying'] == 1)
 			{
 				echo "<strong>[Staying]</strong> ";	
 			}
 			
   			if ($payment['active'] == 0)
   			{
   				echo "<s>".$payment['description']."</s>";
   			} else {
   				echo $payment['description']; 
   			}
   			?>
   				</i>
   			</div>
   			<div class="col-sm-1">$ 
   				<strong>
   			<?php 
   			if ($payment['active'] == 0)
   			{
   				echo "<s>".$payment['cost']."</s>";
   			} else {
   				echo $payment['cost']; 
   			}
   			?>
   				</strong>
   			</div>
   			<div class="col-sm-2" res-id="<?php echo $payment['reservation_id']; ?>" pay-id="<?php echo $payment['payment_id']; ?>">
   				<button type="button" pay-type="1" class="btn-pay-type btn btn-default btn-xs <?php if ($payment['payment_type'] == '1') echo 'btn-info'; ?>">Cash</button>
   				<button type="button" pay-type="2" class="btn-pay-type btn btn-default btn-xs <?php if ($payment['payment_type'] == '2') echo 'btn-info'; ?>">CC</button>
   			</div>
   			<div class="col-sm-2" res-id="<?php echo $payment['reservation_id']; ?>" pay-id="<?php echo $payment['payment_id']; ?>">
   				<button type="button" class="btn-status-money btn btn-default btn-xs <?php if ($payment['status'] == '1') echo 'btn-info'; ?>">Paid</button>
   				<button type="button" class="btn-status-moneys btn btn-default btn-xs <?php if ($payment['status'] == '0') echo 'btn-info'; ?>">Unpaid</button>
	   		</div>
	   		
	   		<div class="col-sm-2" res-id="<?php echo $payment['reservation_id']; ?>" pay-id="<?php echo $payment['payment_id']; ?>">
	   			<?php 
	   			if ($payment['active'] == 1)
	   			{
   				?>
   				<i class="btn-remove glyphicon glyphicon-remove"></i>
   				<?php
	   			} 
   				?>
	   		</div>
   		</div>
 		<?php
   		}
   		$paymentItems = ob_get_contents();
   		ob_end_clean();
   		return $paymentItems;
   	}

   	/**
   	 * The box of the history items
   	 * @return string
   	 */
	public function getHistoryPanel()
   	{
   		ob_start();
   		?>
   		<div class="col-sm-12 history-member-panel">
			<div class="text-right">
				<a href="javascript:void(0);" class="btn btn-info btn-sm display-add-history">Add history</a>
			</div>
			
			<div class="history-member-box">
				<textarea rows="2" cols="" class="form-control" placeholder="history" id="history-entry"></textarea>
				<a href="javascript:void(0);" class="btn btn-info btn-xs" id="add-history">Add</a>
			</div>
			
			<div class="history-content">
				<ul class="history-list">
					<?php
					if ($this->data['memberHistory'])
					{
						foreach ($this->data['memberHistory'] as $history)
						{
						?>
					<li>
                    	<div class="header"><?php echo $history['name']; ?> | <?php echo Tools::formatMYSQLToFront($history['date']).'  '.Tools::formatHourMYSQLToFront($history['time']); ?></div>
                        	<div>
							<i class="glyphicon glyphicon-option-vertical"></i>
							<div class="history-title">
								<span class="task-title-sp">
									<?php echo $history['history']; ?>
								</span>
							</div>
						</div>
					</li>
					<?php
						}
					}
					?>
				</ul>
			</div>
		</div>
   		<?php
   		$historyPanel = ob_get_contents();
   		ob_end_clean();
   		return $historyPanel;
   	}
   	
   	/**
   	 * the task tab, displayed under the member profile
   	 * @return string
   	 */
   	public function getTaskPanel()
   	{
   		ob_start();
   		?>
   		<div class="col-sm-12 task-member-panel">
			<div class="text-right">
				<a href="javascript:void(0);" class="btn btn-info btn-sm display-add-task">Add task</a>
			</div>
			
			<div class="task-member-box">
				<div class="create-task-box" id="create-task-box">
					<div class="top">
						<?php 
						if ($this->data['userInfo']['type'] == 1)
						{
						?>
						<div class="to">
							<label>To</label>
							<select id="task_to">
							<?php 
							if ($this->data['usersActive'])
							{
								foreach ($this->data['usersActive'] as $user) 
								{
									?>
								<option value="<?php echo $user['user_id']; ?>"><?php echo $user['name']; ?></option>
									<?php
								}
							}
							?>
							</select>
						</div>
						<?php 
						}
						else
						{
							?>
						<input type="hidden" id="task_to" value="<?php echo $this->data['userInfo']['user_id']; ?>">
							<?php
						}
						?>
						
						<div class="date">
							<label>Date</label>
							<input type="text" id="task-date" />
						</div>
						
						<div class="hour">
							<label>Time</label>
							<select id="task_hour">
								<option value="8:00">8:00</option>
								<option value="8:30">8:30</option>
								<option value="9:00">9:00</option>
								<option value="9:30">9:30</option>
								<option value="10:00">10:00</option>
								<option value="10:30">10:30</option>
								<option value="11:00">11:00</option>
								<option value="11:30">11:30</option>
								<option value="12:00">12:00</option>
								<option value="12:30">12:30</option>
								<option value="13:00">13:00</option>
								<option value="13:30">13:30</option>
								<option value="14:00">14:00</option>
								<option value="14:30">14:30</option>
								<option value="15:00">15:00</option>
								<option value="15:30">15:30</option>
								<option value="16:00">16:00</option>
								<option value="15:30">16:30</option>
								<option value="17:00">17:00</option>
								<option value="17:30">17:30</option>
								<option value="18:00">18:00</option>
								<option value="18:30">18:30</option>
								<option value="19:00">19:00</option>
								<option value="19:30">19:30</option>
								<option value="20:00">20:00</option>
								<option value="20:30">20:30</option>
							</select>
						</div>
						<div class="clear"></div>
					</div><!--  /top -->
					<div class="middle">
						<textarea rows="" cols="" id="task_content" class="form-control" placeholder="new task"></textarea>
						<a href="javascript:void(0);" class="btn btn-info btn-xs" id="add-task">Add</a>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
			
			<div class="row task-content">
				<ul class="task-list">
					<?php
					echo $this->listTasks($this->data['memberTasks']);
					?>
				</ul>
			</div>
		</div>
   		<?php
   		$taskPanel = ob_get_contents();
   		ob_end_clean();
   		return $taskPanel;
   	}

   	/**
   	 * extra files for the reservation section
   	 * @return string
   	 */
	public function getReservationsHead()
	{
		ob_start();
		?>
		<link rel="stylesheet" href="/css/jquery-ui.css">
		<script src="/js/jquery-ui.js"></script>
		<script src="/js/reservations.js"></script>
		<script>
		$(function() {

			$( "#checkIn" ).datepicker({
				altFormat: "d M, y",
				changeMonth: true,
			    changeYear: true,
				onSelect: function(dateText, inst) 
				{
	            	$( "#checkOut" ).datepicker( "option", "defaultDate", dateText );
	        	}
        	});
        	
	        $( "#checkOut" ).datepicker({
	        	altFormat: "d M, y",
				changeMonth: true,
			    changeYear: true,
		        onSelect: function(dateText, inst) 
		        {
	            	$( "#checkIn" ).datepicker( "option", "defaultDate", dateText );
	        	}
        	});
		});
		</script>
		<?php		
	   	$signIn = ob_get_contents();
		ob_end_clean();
		return $signIn;
	}
	
	/**
	 * This method show the reservation panel
	 * 
	 * which is actually the same showed under the member profile
	 * this method is a bit <s>stupid</s> ... well it doesn't makes sense
	 * 
	 * @return string
	 */
	public function getReservations()
	{
		ob_start();
		?>
	   	   	<?php echo $this->getReservationPanel(); ?>
   	   	<?php
   	   	$tasks = ob_get_contents();
   	   	ob_end_clean();
   	   	return $tasks; 
   	}
	
	/**
	 * extra files for the agencies section
	 * @return string
	 */
	public function getAgenciesHead()
	{
		ob_start();
		?>
		<script src="/js/agencies.js"></script>
   		<?php		
		$agenciesHead = ob_get_contents();
		ob_end_clean();
		return $agenciesHead;
	}
	
	/**
	 * add and display the agencies
	 * 
	 * @return string
	 */
	public function getAgencies()
	{
		ob_start();
		?>
		<div class="row agencyForm">
			<div class="col-sm-3">
				<input type="text" class="" placeholder="agency" id="agency">
			</div>
			
			<div class="col-sm-2">
				<a href="javascript:void(0);" class="btn btn-info btn-xs" id="addAgency">add</a>
			</div>
		</div>
				
		<div class="table-responsive">
   		   	<table class="table table-striped">
   				<thead>
   					<tr>
   						<th>Agency</th>
   						<th></th>
   					</tr>
   				</thead>
   				<tbody id="agenciesList">
   					<?php echo Layout_View::listAgencies($this->data['agencies']); ?>
   				</tbody>
   			</table>
		</div>
		<?php
		$agencies = ob_get_contents();
		ob_end_clean();
		return $agencies; 
	}
	
	/**
	 * display a single agency item
	 * 
	 * @param array $agencies list of agencies
	 * @return string
	 */
	
	public static function listAgencies($agencies)
	{
		ob_start();
		if ($agencies)
		{
			foreach ($agencies as $agency)
			{
				?>
				<tr>
					<td>
	   					<?php echo $agency['agency']; ?>
	   				</td>
					<td>
	   					<a href="/<?php echo $member['member_id']; ?>/<?php echo Tools::slugify($member['name'].' '.$member['last_name']); ?>/">
	   						<i class="glyphicon glyphicon-remove"></i>
	   					</a>
	   				</td>
   				</tr>
				<?php
			}	
		}
		$agencies = ob_get_contents();
		ob_end_clean();
		return $agencies;
	}

	/**
	 * extra files for the task section
	 * 
	 * @return string
	 */

	public function getTasksHead()
    {
    	ob_start();
    	?>
       	<script src=""></script>
        <script>
    	</script>
        <?php
        $signIn = ob_get_contents();
        ob_end_clean();
        return $signIn;
    }
    
    public function getTasksScripts()
    {
    	ob_start();
    	?>
       	<script src="/js/tasks.js"></script>
        <script>
    	</script>
        <?php
        $signIn = ob_get_contents();
        ob_end_clean();
        return $signIn;
    }

    /**
     * Display the tasks
     * 
     * @param array $tasks all the tasks
     * @return string
     */
    public static function listTasks($tasks)
   	{
   		ob_start();
   		
   		if ($tasks)
   		{
   			foreach ($tasks as $task)
   			{
   				$date = Tools::formatMYSQLToFront($task['date']);
   				$time = Tools::formatHourMYSQLToFront($task['time']);
   				?>
				<li
   				<?php 
   				if( $task['status'] == 1)
   					echo 'class="completed"';
   				
   				if( strtotime($date) == strtotime(@date('d-M-Y', strtotime('now'))))
   					echo 'class="today"';
   							
   				if( strtotime($date) < strtotime('now'))
   					echo 'class="pending"';
   							
   				if( strtotime($date) > strtotime('now'))
   					echo 'class="future"';
   				?>
   				>
   					<div class="header">
   						<div class="info">
   							<strong><?php echo $task['assigned_to']; ?> </strong>
   							<span class="text-primary"><?php echo $date.' '.$time; ?></span>
   							<span class="text-muted"><?php echo $task['assigned_by']; ?></span>
   						</div>
   						<?php 
	                    if ($task['status'] == 0)
	                    {
	                    ?>
	                    	<a href="javascript: void(0);" class="completeTask" tid="<?php echo $task['task_id']; ?>"><i class="glyphicon glyphicon-check icon" ></i></a>
	                    <?php 
	                    }
	                    
   						if ($task['member_id'])
   						{
   						?>
   						<div class="member">
   							<a href="/<?php echo $task['member_id']; ?>/<?php echo Tools::slugify($task['name'].' '.$task['last_name']); ?>/">
   								<?php echo $task['name'].' '.$task['last_name']; ?>
   							</a>
   						</div>
   						<?php
   						}
   						?>
   						<div class="clear"></div>
   					</div>
   					<div class="clear"></div>
   					<div>
   						<i class="glyphicon glyphicon-option-vertical"></i>
   						<div class="history-title">
   							<span class="task-title-sp"><?php echo $task['content']; ?></span>
   						</div>
   					</div>
   					<div class="clear"></div>
   				</li>
   				<?php
   				}
   			}
   		$tasks = ob_get_contents();
   		ob_end_clean();
   		return $tasks;
   	}

   	/**
   	 * The boix and tabs for the tasks
   	 * 
   	 * @return string
   	 */
   	public function getAllTasks()
   	{
   		ob_start();
   		?>
   		<div class="row">
			<div class="col-sm-12 task-member-panel">
				<div class="main-menu-tasks text-center">
					<ul class="nav nav-pills">
						<li>
							<a href="#" class="text-red" id="get-pending-tasks">
								Pending
								<?php if ($this->data['taskInfo']['pending'] > 0) {?><span class="badge"><?php echo $this->data['taskInfo']['pending']; ?></span><?php } ?>
							</a>
						</li>
						<li>
							<a href="#" class="text-aqua" id="get-today-tasks">
								Today 
								<?php if ($this->data['taskInfo']['today'] > 0) {?><span class="badge"><?php echo $this->data['taskInfo']['today']; ?></span><?php } ?>
							</a>
						</li>
						<li>
							<a href="#" class="text-yellow" id="get-future-tasks">
								Future 
								<?php if ($this->data['taskInfo']['future'] > 0) {?><span class="badge"><?php echo $this->data['taskInfo']['future']; ?></span><?php } ?>
							</a>
						</li>
						<li>
							<a href="#" class="text-green" id="get-completed-tasks">
								Completed
							</a>
						</li>
					</ul>
				</div>
				<div class="row task-content">
					<ul class="task-list">
					<?php 
					echo $this->listTasks($this->data['memberTasks']);
					?>
					</ul>
				</div>
			</div>
		</div>
   		<?php
   		$tasks = ob_get_contents();
   		ob_end_clean();
   		return $tasks; 
   	}
   	
   	public function getReportsHead()
    {
    	ob_start();
    	?>
       	<script src="/js/reports.js"></script>
        <script>
    	</script>
        <?php
        $signIn = ob_get_contents();
        ob_end_clean();
        return $signIn;
    }
    
    public function getReports()
	{
		ob_start();
		$curMonth = date('M Y');
		?>
		<div class="row agencyForm">
			<div class="col-sm-2">
				<select onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
					<option value="/rooms/">Select a month</option>
					<?php 
					for ($i = 0; $i <= 12; $i ++)
					{
						$interval = '+'.$i.' month';
						?>
						<option value="/reports/from/<?php echo date('Y-m-d', strtotime($interval, strtotime($curMonth))); ?>/">
							<?php echo date('M Y', strtotime($interval, strtotime($curMonth))); ?>
						</option>
						<?php 
					}
					
					if (!$_GET['from'])
					{
						$from = date('Y-m-d', strtotime(' -1 day'));
						$start = date('Y-m-d', strtotime(' -1 day', strtotime($from)));
						$end = date('Y-m-d', strtotime(' +31 day', strtotime($from)));
					}
					else 
					{
						$from = date('Y-m-d', strtotime($_GET['from']));
						$start = date('Y-m-d', strtotime(' -1 day', strtotime($_GET['from'])));
						$end = date('Y-m-d', strtotime(' +32 day', strtotime($_GET['from'])));
					}
					?>
				</select>
				
			</div>
			
			<?php
			if ($this->data['userInfo']['type'] == 1)
			{
				?>
			<div class="col-sm-2">
				<a href="/get-report.php?from=<?php echo $_GET['from']; ?>" class="btn btn-info btn-xs" id="" target="_blank">Get Report</a>
			</div>
				<?php
			}
			?>
			
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="table-responsive">
		   		   	<table class="table table-striped">
		   				<thead>
		   					<tr>
		   						<th>R. ID</th>
		   						<th>Date</th>
		   						<th>Guest Name</th>
		   						<th>Ad.</th>
		   						<th>Ch.</th>
		   						<th>Nights</th>
		   						<th>Agency</th>
		   						<th>PPN</th>
		   						<th>Total</th>
		   						<th>Paid</th>
		   						<th>Room</th>
		   						<th>Check In</th>
		   						<th>Check Out</th>
		   						<th>Status</th>
		   						<th>Country</th>
		   						<th>External Id</th>
		   						<th>Comments</th>
		   					</tr>
		   				</thead>
		   				<tbody id="agenciesList">
		   					<?php 
		   					foreach ($this->data['reservations'] as $reservation)
		   					{
		   						?>
		   					<tr>
		   						<td><?php echo $reservation['reservation_id']; ?></td>
		   						<td><?php echo Tools::formatMYSQLToFront($reservation['date']); ?></td>
		   						<td><?php echo $reservation['name'].' '.$reservation['last_name']; ?></td>
		   						<td><?php echo $reservation['adults']; ?></td>
		   						<td><?php echo $reservation['children']; ?></td>
		   						<td><?php echo $reservation['n_days']; ?></td>
		   						<td><?php echo $reservation['agency']; ?></td>
		   						<td><?php echo $reservation['ppn']; ?></td>
		   						<td><?php echo $reservation['total']; ?></td>
		   						<td><?php echo $reservation['paid']; ?></td>
		   						<td><?php echo $reservation['room']; ?></td>
		   						<td><?php echo Tools::formatMYSQLToFront($reservation['check_in']); ?></td>
		   						<td><?php echo Tools::formatMYSQLToFront($reservation['check_out']); ?></td>
		   						<td><?php echo $reservation['r_status']; ?></td>
		   						<td><?php echo $reservation['country']; ?></td>
		   						<td><?php echo $reservation['external_id']; ?></td>
		   						<td><?php echo $reservation['notes']; ?></td>	
		   					</tr>
		   						<?php 
		   					}
		   					?>
		   				</tbody>
		   			</table>
			</div>
			</div>
		</div>
		<?php
		$agencies = ob_get_contents();
		ob_end_clean();
		return $agencies; 
	}
	
	
    public function getSettingsHead()
    {
    	ob_start();
    	?>
    	<script type="text/javascript">
		</script>
    	<?php
    	$head = ob_get_contents();
    	ob_end_clean();
    	return $head;
    }
    
    public function getSettingsScripts()
    {
    	ob_start();
    	?>
    	<script type="text/javascript">
		</script>
		<script src="/js/settings.js"></script>
    	<?php
    	$scripts = ob_get_contents();
    	ob_end_clean();
    	return $scripts;
    }
    
    public function getSettingsContent()
    {
    	ob_start();
    	?>
		<div class="row">
			<div class="col-md-6">
				<div class="box box-widget widget-user-2">
					<div class="widget-user-header bg-blue">
						<h3 class="widget-user-username">Inventory categories</h3>
					</div>
					<!-- Horizontal Form -->
              		<div class="box box-info">
						<!-- form start -->
						<form class="form-horizontal">
							<div class="box-body">
								<div class="form-group">
									<label for="inputEmail3" class="col-sm-2 control-label">Category</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="categoryName" placeholder="Category name ...">
									</div>
								</div>
								<div class="form-group">
									<label for="inputPassword3" class="col-sm-2 control-label">Description</label>
									<div class="col-sm-10">
										<textarea class="form-control" rows="3" id="categoryDescription" placeholder="Description ..."></textarea>
									</div>
								</div>
							</div><!-- /.box-body -->
							<div class="box-footer">
								<button type="submit" class="btn btn-info btn-xs pull-right" id="addCategory">Add</button>
							</div><!-- /.box-footer -->
						</form>
					</div><!-- /.box -->
					<div class="box-footer no-padding">
						<ul class="nav nav-stacked" id="categoryBox">
							<?php 
							if ($this->data['categories'])
							{
								foreach ($this->data['categories'] as $category)
								{
									?>
							<li><a href="/edit-inventory-category/<?php echo $category['category_id']; ?>/"><?php echo $category['category']; ?></a></li>
									<?php
								}
							}
							?>
						</ul>
					</div>
				</div><!-- /.widget-user -->
			</div><!-- /.col -->
			
			<div class="col-md-6">
				<div class="box box-widget widget-user-2">
					<div class="widget-user-header bg-blue">
						<h3 class="widget-user-username">Room Types</h3>
					</div>
					<!-- Horizontal Form -->
              		<div class="box box-info">
						<!-- form start -->
						<form class="form-horizontal">
							<div class="box-body">
								<div class="form-group">
									<label for="inputEmail3" class="col-sm-2 control-label">Room Type</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="" placeholder="Room type">
									</div>
								</div>
								<div class="form-group">
									<label for="inputPassword3" class="col-sm-2 control-label">Description</label>
									<div class="col-sm-10">
										<textarea class="form-control" rows="3" placeholder="Description ..."></textarea>
									</div>
								</div>
							</div><!-- /.box-body -->
							<div class="box-footer">
								<button type="submit" class="btn btn-info btn-xs pull-right">Add</button>
							</div><!-- /.box-footer -->
						</form>
					</div><!-- /.box -->
					<div class="box-footer no-padding">
						<ul class="nav nav-stacked">
							<?php 
							if ($this->data['types'])
							{
								foreach ($this->data['types'] as $type)
								{
									?>
							<li><a href="#"><?php echo $type['room_type']; ?><span class="pull-right badge bg-red"><i class="fa fa-close"></i></span></a></li>
									<?php
								}
							}
							?>
						</ul>
					</div>
				</div><!-- /.widget-user -->
			</div><!-- /.col -->
        </div>
        <?php
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
    
    public function getCategoryHead()
    {
    	ob_start();
    	?>
    	<script type="text/javascript">
		</script>
    	<?php
    	$head = ob_get_contents();
    	ob_end_clean();
    	return $head;
    }
    
    public function getCategoryScripts()
    {
    	ob_start();
    	?>
    	<script type="text/javascript">
		</script>
		<script src="/js/settings.js"></script>
    	<?php
    	$scripts = ob_get_contents();
    	ob_end_clean();
    	return $scripts;
    }
    
    public function getCategoryContent()
    {
    	ob_start();
    	?>
		<div class="row">
			<div class="col-md-6">
				<div class="box box-widget widget-user-2">
					<div class="widget-user-header bg-blue">
						<h3 class="widget-user-username">Category</h3>
					</div>
					<!-- Horizontal Form -->
              		<div class="box box-info">
						<!-- form start -->
						<form class="form-horizontal">
							<input type="hidden" id="categoryId" value="<?php echo $this->data['category']['category_id']; ?>">
							<div class="box-body">
								<div class="form-group">
									<label for="inputEmail3" class="col-sm-2 control-label">Category</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="categoryName" placeholder="Category name ..." value="<?php echo $this->data['category']['category']; ?>">
									</div>
								</div>
								<div class="form-group">
									<label for="inputPassword3" class="col-sm-2 control-label">Description</label>
									<div class="col-sm-10">
										<textarea class="form-control" rows="3" id="categoryDescription" placeholder="Description ..."><?php echo $this->data['category']['description']; ?></textarea>
									</div>
								</div>
							</div><!-- /.box-body -->
							<div class="box-footer">
								<button type="submit" class="btn btn-info btn-xs pull-right" id="updateCategory">Update</button>
							</div><!-- /.box-footer -->
						</form>
					</div><!-- /.box -->
				</div><!-- /.widget-user -->
			</div><!-- /.col -->
			
			<div class="col-md-6">
				<div class="box box-widget widget-user-2">
					<div class="widget-user-header bg-blue">
						<h3 class="widget-user-username">Inventory</h3>
					</div>
					<!-- Horizontal Form -->
              		<div class="box box-info">
						<!-- form start -->
						<form class="form-horizontal">
							<div class="box-body">
								<div class="form-group">
									<label for="inputEmail3" class="col-sm-2 control-label">Inventory</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="inventoryName" placeholder="Inventory name ..." value="">
									</div>
								</div>
								<div class="form-group">
									<label for="inputPassword3" class="col-sm-2 control-label">Description</label>
									<div class="col-sm-10">
										<textarea class="form-control" rows="3" id="inventoryDescription" placeholder="Description ..."></textarea>
									</div>
								</div>
							</div><!-- /.box-body -->
							<div class="box-footer">
								<button type="submit" class="btn btn-info btn-xs pull-right" id="addInventory">Add</button>
							</div><!-- /.box-footer -->
						</form>
					</div><!-- /.box -->
					<div class="box-footer no-padding">
						<ul class="nav nav-stacked" id="inventoryBox">
							<?php 
							if ($this->data['inventoryArray'])
							{
								foreach ($this->data['inventoryArray'] as $inventory)
								{
									?>
							<li><a href="/edit-inventory-category/<?php echo $inventory['category_id']; ?>/"><?php echo $inventory['inventory']; ?></a></li>
									<?php
								}
							}
							?>
						</ul>
					</div>
				</div><!-- /.widget-user -->
			</div><!-- /.col -->
        </div>
        <?php
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
    
    public function getAddOwnerHead()
    {
    	ob_start();
    	?>
    	<script type="text/javascript">
		</script>
		
    	<?php
    	$head = ob_get_contents();
    	ob_end_clean();
    	return $head;
    }
    
    public function getAddOwnerScripts()
    {
    	ob_start();
    	?>
		<!-- InputMask -->
	    <script src="/plugins/input-mask/jquery.inputmask.js"></script>
	    <script src="/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
	    <script src="/plugins/input-mask/jquery.inputmask.extensions.js"></script>
	    <!-- SlimScroll 1.3.0 -->
    	<script src="/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    	
    	<script type="text/javascript">
    	$(function () {
            //Money Euro
            $("[data-mask]").inputmask();
    	});
		</script>
		<script src="/js/members.js"></script>
    	<?php
    	$scripts = ob_get_contents();
    	ob_end_clean();
    	return $scripts;
    }
    
    public function getAddOwnerContent()
    {
    	ob_start();
    	?>
		<div class="row">
			<div class="col-md-6">
				<div class="box box-info">
					<div class="box-header">
						<h3 class="box-title">Owner info</h3>
					</div>
					<div class="box-body">
						<div class="form-group">
							<label for="exampleInputEmail1">First name</label>
							<input type="text" class="form-control" id="memberFirst" placeholder="First Name">
						</div>
						
						<div class="form-group">
							<label for="exampleInputEmail1">Last name</label>
							<input type="text" class="form-control" id="memberLast" placeholder="Last Name">
						</div>
                        
                        <!-- phone mask -->
						<div class="form-group">
							<label>Phone one:</label>
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-phone"></i>
								</div>
								<input type="text" id="phoneOne" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>
							</div>
							<!-- /.input group -->
						</div>
						<!-- /.form group -->
						
						<!-- phone mask -->
						<div class="form-group">
							<label>Phone two:</label>
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-phone"></i>
								</div>
								<input type="text" id="phoneTwo" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>
							</div>
							<!-- /.input group -->
						</div>
						<!-- /.form group -->
						
						<!-- email mask -->
						<div class="form-group">
							<label>Email one:</label>
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-envelope"></i>
								</div>
								<input type="email" id="emailOne" class="form-control" data-inputmask='' id="emailOne" data-mask>
							</div>
							<!-- /.input group -->
						</div>
						<!-- /.form group -->
						
						<!-- email mask -->
						<div class="form-group">
							<label>Email two:</label>
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-envelope"></i>
								</div>
								<input type="email" id="emailTwo" class="form-control" data-inputmask='' id="emailOne" data-mask>
							</div>
							<!-- /.input group -->
						</div>
						<!-- /.form group -->
					</div>
				</div>
			</div>
			
			<div class="col-md-6">
				<div class="box box-info">
					<div class="box-body">
						<div class="form-group">
							<label for="exampleInputEmail1">Address</label>
							<textarea class="form-control" id="memberAddress" rows="3" placeholder="Address ..."></textarea>
						</div>
						
						<div class="form-group">
							<label for="exampleInputEmail1">Notes</label>
							<textarea class="form-control" id="notes" rows="5" placeholder="Notes ..."></textarea>
						</div>
					</div>
					
					<div class="box-footer">
						<div class="progress progress-sm active">
	                    	<div class="progress-bar progress-bar-success progress-bar-striped" id="progressSaveMember" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
	                      		<span class="sr-only">20% Complete</span>
	                    	</div>
	                  	</div>
	                    <button type="submit" class="btn btn-info pull-right" id="memberSave">Add Owner</button>
	                    <a href="" class="btn btn-success pull-right" id="memberComplete">Complete Owner</a>
                  	</div>
				</div>
			</div>
		</div>
        <?php
        $content = ob_get_contents();
        ob_end_clean();
     	return $content;
    }
    
    public function getRoomPanel()
    {
    	ob_start();
    	?>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label  class="col-sm-2 control-label">Rooms</label>
					<div class="col-sm-10">
						<select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" id="roomList">
							<?php 
							foreach ($this->data['rooms'] as $room)
							{
								?>
							<option value="<?php echo $room['room_id']; ?>"><?php echo $room['room']; ?></option>
								<?php
							}
							?>
						</select>
					</div>
				</div><!-- /.form-group -->
			</div><!-- /.col -->
			
			<div class="col-md-6 text-right">
				<div class="form-group">
					<button type="submit" class="btn btn-info pull-left btn-sm" id="addMemberRoom">Add room</button>
				</div>
			</div>
		</div>
		
		<h2 class="page-header">Rooms</h2>
		
		<div class="row">
			<div class="col-md-12">
				<div class="box box-solid">
					<div class="box-body">
						<div class="box-group" id="accordion">
							<!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
							<?php 
							foreach ($this->data['memberRooms'] as $room)
							{
								echo self::getRoomMemberItem($room);
							}
							?>
						</div>
					</div><!-- /.box-body -->
				</div><!-- /.box -->
			</div><!-- /.col -->
		</div><!-- /.row -->
        <?php
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
    
    public function getRoomMemberItem($room)
    {
    	ob_start();
    	?>
		<div class="panel box box-success">
			<div class="box-header with-border">
				<h5 class="box-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $room['room_id']; ?>" class="roomList">
						<?php echo $room['room'].' / '.$room['room_type']; ?>
					</a>
				</h5>
			</div>
			<div id="collapse<?php echo $room['room_id']; ?>" class="panel-collapse collapse">
				<div class="box-body">
				<?php echo $room['description']; ?>
				<br>
				<br>
				
				<div class="row">
            <div class="col-md-12">
              <!-- Custom Tabs -->
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#tab_1" data-toggle="tab">Payments</a></li>
                  <li><a href="#tab_2" data-toggle="tab">Incidents</a></li>
                  <li><a href="#tab_3" data-toggle="tab">Galleries</a></li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                    <b>How to use:</b>
                    <p>Exactly like the original bootstrap tabs except you should use
                      the custom wrapper <code>.nav-tabs-custom</code> to achieve this style.</p>
                  </div><!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_2">
                    The European languages are members of the same family. Their separate existence is a myth.
                  </div><!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_3">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                  </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
              </div><!-- nav-tabs-custom -->
            </div><!-- /.col -->

          </div>
				
				
				</div>
			</div>
		</div>
        <?php
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
    
    public function getMemberHead()
    {
    	ob_start();
    	?>
    	<link rel="stylesheet" href="/plugins/datepicker/datepicker3.css">
    	<!-- Select2 -->
    	<link rel="stylesheet" href="/plugins/select2/select2.min.css">
    	<?php
    	$head = ob_get_contents();
    	ob_end_clean();
    	return $head;
    }
    
    public function getMemberScripts()
    {
    	ob_start();
    	?>
    	<!-- InputMask -->
	    <script src="/plugins/input-mask/jquery.inputmask.js"></script>
	    <script src="/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
	    <script src="/plugins/input-mask/jquery.inputmask.extensions.js"></script>
	    <!-- SlimScroll 1.3.0 -->
    	<script src="/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    	<script src="/plugins/datepicker/bootstrap-datepicker.js"></script>
    	<script src="/plugins/select2/select2.full.min.js"></script>
    	
    	<script type="text/javascript">
    	$(function () {
            //Money Euro
            $("[data-mask]").inputmask();
            $("#task-date").datepicker();
            $(".select2").select2();
    	});
		</script>
		<script src="/js/members.js"></script>
		<script src="/js/history.js"></script>
		<script src="/js/tasks.js"></script>
		<script src="/js/rooms.js"></script>
    	<?php
    	$scripts = ob_get_contents();
    	ob_end_clean();
    	return $scripts;
    }
    
    public function getMemberContent()
    {
    	ob_start();
    	?>
		<div class="row">
			<div class="col-md-6">
				<div class="box box-info">
					<div class="box-header">
						<h3 class="box-title"><?php echo $this->data['memberInfo']['name'].' '.$this->data['memberInfo']['last_name']; ?></h3>
					</div>
					<div class="box-body">
						<div class="form-group">
							<label for="exampleInputEmail1">First name</label>
							<input type="hidden" id="memberId" value="<?php echo $this->data['memberInfo']['member_id']; ?>">
							<input type="text" class="form-control" id="memberFirst" placeholder="First Name" value="<?php echo $this->data['memberInfo']['name']; ?>" >
						</div>
						
						<div class="form-group">
							<label for="exampleInputEmail1">Last name</label>
							<input type="text" class="form-control" id="memberLast" placeholder="Last Name" value="<?php echo $this->data['memberInfo']['last_name']; ?>" >
						</div>
                        
                        <!-- phone mask -->
						<div class="form-group">
							<label>Phone one:</label>
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-phone"></i>
								</div>
								<input type="text" id="phoneOne" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask value="<?php echo $this->data['memberInfo']['phone_one']; ?>" >
							</div>
							<!-- /.input group -->
						</div>
						<!-- /.form group -->
						
						<!-- phone mask -->
						<div class="form-group">
							<label>Phone two:</label>
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-phone"></i>
								</div>
								<input type="text" id="phoneTwo" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask value="<?php echo $this->data['memberInfo']['phone_two']; ?>" >
							</div>
							<!-- /.input group -->
						</div>
						<!-- /.form group -->
						
						<!-- email mask -->
						<div class="form-group">
							<label>Email one:</label>
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-envelope"></i>
								</div>
								<input type="email" id="emailOne" class="form-control" data-inputmask='' id="emailOne" data-mask value="<?php echo $this->data['memberInfo']['email_one']; ?>" >
							</div>
							<!-- /.input group -->
						</div>
						<!-- /.form group -->
						
						<!-- email mask -->
						<div class="form-group">
							<label>Email two:</label>
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-envelope"></i>
								</div>
								<input type="email" id="emailTwo" class="form-control" data-inputmask='' id="emailOne" data-mask value="<?php echo $this->data['memberInfo']['email_two']; ?>" >
							</div>
							<!-- /.input group -->
						</div>
						<!-- /.form group -->
					</div>
				</div>
			</div>
			
			<div class="col-md-6">
				<div class="box box-info">
					<div class="box-body">
						<div class="form-group">
							<label for="exampleInputEmail1">Address</label>
							<textarea class="form-control" id="memberAddress" rows="3" placeholder="Address ..."><?php echo $this->data['memberInfo']['address']; ?></textarea>
						</div>
						
						<div class="form-group">
							<label for="exampleInputEmail1">Notes</label>
							<textarea class="form-control" id="notes" rows="5" placeholder="Notes ..."><?php echo $this->data['memberInfo']['notes']; ?></textarea>
						</div>
					</div>
					
					<div class="box-footer">
						<div class="progress progress-sm active">
	                    	<div class="progress-bar progress-bar-success progress-bar-striped" id="progressSaveMember" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
	                      		<span class="sr-only">20% Complete</span>
	                    	</div>
	                  	</div>
	                    <button type="submit" class="btn btn-info pull-right" id="updateMember">Update info</button>
	                    <a href="" class="btn btn-success pull-right" id="memberComplete">Complete Owner</a>
                  	</div>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<!-- Custom Tabs (Pulled to the right) -->
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs pull-right">
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">
								Dropdown <span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
							</ul>
						</li>
						<li><a href="#tab_1-1" data-toggle="tab">Tasks</a></li>
						<li><a href="#tab_2-2" data-toggle="tab">History</a></li>
						<li class="active"><a href="#tab_3-2" data-toggle="tab">Rooms</a></li>
						<li class="pull-left header"><i class="fa fa-th"></i>Admin Owner</li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="tab_3-2">
							<?php echo $this->getRoomPanel(); ?>
						</div><!-- /.tab-pane -->
						<div class="tab-pane" id="tab_2-2">
							<div class="row">
								<?php echo $this->getHistoryPanel(); ?>
							</div>
						</div><!-- /.tab-pane -->
						<div class="tab-pane" id="tab_3-2">
							Lorem 
						</div><!-- /.tab-pane -->
						<div class="tab-pane" id="tab_1-1">
							<div class="row">
								<?php echo $this->getTaskPanel(); ?>
							</div>
						</div><!-- /.tab-pane -->
					</div><!-- /.tab-content -->
				</div><!-- nav-tabs-custom -->
			</div><!-- /.col -->
		</div>
        <?php
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
    
    public function getRoomsHead()
    {
    	ob_start();
    	?>
    	<!-- Select2 -->
    <link rel="stylesheet" href="/plugins/select2/select2.min.css">
    	<?php
    	$head = ob_get_contents();
    	ob_end_clean();
    	return $head;
    }
    
    public function getRoomsScripts()
    {
    	ob_start();
    	?>
		<!-- Select2 -->
    	<script src="/plugins/select2/select2.full.min.js"></script>
		<script type="text/javascript">
		$(function () {
	        //Initialize Select2 Elements
	        $(".select2").select2();
		});
		</script>
    	<script src="/js/rooms.js"></script>
    	<?php
    	$scripts = ob_get_contents();
    	ob_end_clean();
    	return $scripts;
    }
    
    public function getRoomsContent()
    {
    	ob_start();
    	?>
		<div class="box box-default">
			<div class="box-header with-border">
				<h3 class="box-title">Add Room</h3>
            </div><!-- /.box-header -->
            <div class="box-body" style="display: block;">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="exampleInputEmail1">Room name</label>
							<input type="text" class="form-control" id="roomName" placeholder="Room name" value="" >
                  		</div><!-- /.form-group -->
					</div><!-- /.col -->
					
					<div class="col-md-6">
						<div class="form-group">
							<label>Room type</label>
							<select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" id="roomType">
								<?php 
								foreach ($this->data['types'] as $type)
								{
									?>
								<option value="<?php echo $type['room_type_id']; ?>"><?php echo $type['room_type']; ?></option>
									<?php
								}
								?>
							</select>
                  		</div><!-- /.form-group -->
					</div><!-- /.col -->
				</div><!-- /.row -->
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="exampleInputEmail1">Description</label>
							<textarea class="form-control" rows="3" placeholder="Room description ..." id="roomDescription"></textarea>
                  		</div><!-- /.form-group -->
					</div><!-- /.col -->
				</div>
			</div><!-- /.box-body -->
			
			<div class="box-footer">
				<button type="submit" class="btn btn-info pull-right" id="addRoom">Add room</button>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<div class="box box-widget widget-user-2">
					<div class="box-footer no-padding">
						<ul class="nav nav-stacked" id="roomsBox">
							<?php 
							if ($this->data['rooms'])
							{
								foreach ($this->data['rooms'] as $room)
								{
									?>
							<li><a href="/edit-room/<?php echo $room['room_id']; ?>/"><?php echo $room['room'].' / '.$room['room_type']; ?></a></li>
									<?php
								}
							}
							?>
						</ul>
					</div>
				</div><!-- /.widget-user -->
			</div><!-- /.col -->
        </div>
        <?php
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
    
    public function getRoomHead()
    {
    	ob_start();
    	?>
    	<!-- Select2 -->
    	<link rel="stylesheet" href="/plugins/select2/select2.min.css">
    	<?php
    	$head = ob_get_contents();
    	ob_end_clean();
    	return $head;
    }
    
    public function getRoomScripts()
    {
    	ob_start();
    	?>
		<!-- Select2 -->
    	<script src="/plugins/select2/select2.full.min.js"></script>
		<script type="text/javascript">
		$(function () {
	        //Initialize Select2 Elements
	        $(".select2").select2();
		});
		</script>
    	<script src="/js/rooms.js"></script>
    	<?php
    	$scripts = ob_get_contents();
    	ob_end_clean();
    	return $scripts;
    }
    
    public function getRoomContent()
    {
    	ob_start();
    	?>
		<div class="box box-success">
			<div class="box-header with-border">
				<h3 class="box-title">Update Room</h3>
            </div><!-- /.box-header -->
            <div class="box-body" style="display: block;">
				<div class="row">
					<div class="col-md-6">
						<input type="hidden" id="roomId" value="<?php echo $this->data['room']['room_id']; ?>" >
						<div class="form-group">
							<label for="exampleInputEmail1">Room name</label>
							<input type="text" class="form-control" id="roomName" placeholder="Room name" value="<?php echo $this->data['room']['room']; ?>" >
                  		</div><!-- /.form-group -->
					</div><!-- /.col -->
					
					<div class="col-md-6">
						<div class="form-group">
							<label>Room type</label>
							<select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" id="roomType">
								<?php 
								foreach ($this->data['types'] as $type)
								{
									?>
								<option value="<?php echo $type['room_type_id']; ?>"><?php echo $type['room_type']; ?></option>
									<?php
								}
								?>
							</select>
                  		</div><!-- /.form-group -->
					</div><!-- /.col -->
				</div><!-- /.row -->
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="exampleInputEmail1">Description</label>
							<textarea class="form-control" rows="3" placeholder="Room description ..." id="roomDescription"><?php echo $this->data['room']['description']; ?></textarea>
                  		</div><!-- /.form-group -->
					</div><!-- /.col -->
				</div>
			</div><!-- /.box-body -->
			
			<div class="box-footer">
				<button type="submit" class="btn btn-info pull-right" id="updateRoom">Update room</button>
			</div>
		</div>
		
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title">Add inventory to the room</h3>
            </div><!-- /.box-header -->
            <div class="box-body" style="display: block;">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Categories</label>
							<select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" id="categoriesList">
								<?php 
								foreach ($this->data['categories'] as $category)
								{
									?>
								<option value="<?php echo $category['category_id']; ?>"><?php echo $category['category']; ?></option>
									<?php
								}
								?>
							</select>
                  		</div><!-- /.form-group -->
					</div><!-- /.col -->
					
					<div class="col-md-6">
						<div class="form-group">
							<label>Inventory</label>
							<select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" id="inventoryList">
							<?php 
							if ($this->data['inventory'])
							{
								foreach ($this->data['inventory'] as $inventory)
								{
									?>
								<option value="<?php echo $inventory['inventory_id']; ?>"><?php echo $inventory['inventory']; ?></option>
									<?php
								}
							}
							else 
							{
								?>
								<option value="0">Inventory empty</option>
								<?php 
							}
							?>
							</select>
                  		</div><!-- /.form-group -->
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.box-body -->
			
			<div class="box-footer">
				<button type="submit" class="btn btn-info pull-right" id="addRoomInventory">Add inventory</button>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<div class="box box-success box-widget widget-user-2">
					<div class="box-footer no-padding">
						<ul class="nav nav-stacked" id="inventoryBox">
							<?php 
							if ($this->data['roomInventory'])
							{
								foreach ($this->data['roomInventory'] as $inventory)
								{
									?>
							<li><a href="#"><?php echo $inventory['category'].' / '.$inventory['inventory']; ?></a></li>
									<?php
								}
							}
							?>
						</ul>
					</div>
				</div><!-- /.widget-user -->
			</div><!-- /.col -->
        </div>
        <?php
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
    
    public function getSectionHead()
    {
    	ob_start();
    	?>
    	<script type="text/javascript"></script>
    	<?php
    	$head = ob_get_contents();
    	ob_end_clean();
    	return $head;
    }
    
    public function getSectionScripts()
    {
    	ob_start();
    	?>
    	<script type="text/javascript">
		</script>
		<script src=""></script>
    	<?php
    	$scripts = ob_get_contents();
    	ob_end_clean();
    	return $scripts;
    }
    
    public function getSectionContent()
    {
    	ob_start();
    	?>

        <?php
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
    
   	
   	/**
   	 * The very awesome footer!
   	 * 
   	 * <s>useless</s>
   	 * 
   	 * @return string
   	 */
    public function getFooter()
    {
    	ob_start();
    	?>
		<!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="pull-right hidden-xs">
                Property Managements
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2016 <a href="#"><?php echo $this->data['appInfo']['siteName']; ?></a>.</strong> All rights reserved.
        </footer>
    	<?php
    	$footer = ob_get_contents();
    	ob_end_clean();
    	return $footer;
	}
}