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
 * @package 	Elite M Group
 * @subpackage 	Elite M Group - Admin section
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
 					echo self::getLogInHead();
				break;

				case 'dashboard':
					# code...
				break;
				
				case 'settings':
					echo self::getSettingsHead();
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
		<body id="<?php echo $this->data['section']; ?>" class="hold-transition <?php echo $this->data['template-class']; ?> fixed  skin-black sidebar-mini">
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
							
							case 'condo':
								echo self::getRoomsByCondo();
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

							case 'messages':
								echo self::getAllUnreadMessages();
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
	    <link rel="stylesheet" href="/dist/css/AdminLTE.css">
	    <!-- iCheck -->
	    <!-- iCheck for checkboxes and radio inputs -->
    	<link rel="stylesheet" href="/plugins/iCheck/all.css">
	
	    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	    <!--[if lt IE 9]>
	        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	    <![endif]-->
	    <link rel="stylesheet" href="/dist/css/skins/skin-black.min.css">
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
    	<script src="/js/bootbox.js"></script>
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
                                	<div class="pull-left">
                  						<a href="#" class="btn btn-default btn-flat">Profile</a>
                					</div>
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
						<a href="/messages/">
							<i class="fa fa-envelope"></i> <span>Messages</span>
							<small class="label pull-right bg-yellow"><?php echo $this->data['unreadMessagesTotal']; ?></small>
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
                            <li><a href="/owners/"><i class="fa fa-circle-o"></i> Owners list</a></li>
                            <?php 
							if ($this->data['condos'])
							{
								foreach ($this->data['condos'] as $condo)
								{
									?>
							<li><a href="/condo/<?php echo $condo['condo_id'].'/'.Tools::slugify($condo['condo']).'/'; ?>"><i class="fa fa-institution"></i> <span><?php echo $condo['condo']; ?></span></a></li>		
									<?php
								}
							}
							?>
                        </ul>
                    </li>
                    <li><a href="/rooms/"><i class="fa fa-home"></i> <span>Rooms</span></a></li>
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
						<span class="info-box-number"><a href="/dashboard/"><?php echo $this->data['totalMembers']; ?></a></span>
					</div><!-- /.info-box-content -->
				</div><!-- /.info-box -->
			</div><!-- /.col -->
			
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
                	<span class="info-box-icon bg-green"><i class="fa fa-tasks"></i></span>
                	<div class="info-box-content">
						<span class="info-box-text">Tasks</span>
						<span class="info-box-number"><a href="/tasks/"><?php echo $this->data['taskInfo']['today']; ?></a></span>
						<span class="progress-description"><?php echo $this->data['taskInfo']['pending']; ?> pending</span>
					</div><!-- /.info-box-content -->
				</div><!-- /.info-box -->
			</div><!-- /.col -->
			
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
                	<span class="info-box-icon bg-yellow"><i class="fa fa-envelope-o"></i></span>
                	<div class="info-box-content">
						<span class="info-box-text">Messages</span>
						<span class="info-box-number"><a href="/messages/"><?php echo $this->data['unreadMessagesTotal']; ?></a></span>
					</div><!-- /.info-box-content -->
				</div><!-- /.info-box -->
			</div><!-- /.col -->
			<!-- 
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
                	<span class="info-box-icon bg-red"><i class="fa fa-money"></i></span>
                	<div class="info-box-content">
						<span class="info-box-text">Payments</span>
						<span class="info-box-number">2</span>
					</div>
				</div>
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
   		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Recent Owners</h3>
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
						foreach ($this->data['members'] as $member)
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
		<script src="/js/room-types.js"></script>
		<script src="/js/condos.js"></script>
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
						<h3 class="widget-user-username">Condos</h3>
					</div>
					<!-- Horizontal Form -->
              		<div class="box box-info">
						<!-- form start -->
						<form class="form-horizontal">
							<div class="box-body">
								<div class="form-group">
									<label for="inputEmail3" class="col-sm-2 control-label">Condo</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="condoName" placeholder="Condo name ...">
									</div>
								</div>
								<div class="form-group">
									<label for="inputPassword3" class="col-sm-2 control-label">Description</label>
									<div class="col-sm-10">
										<textarea class="form-control" rows="3" id="condoDescription" placeholder="Description ..."></textarea>
									</div>
								</div>
							</div><!-- /.box-body -->
							<div class="box-footer">
								<button type="submit" class="btn btn-info btn-xs pull-right" id="addCondo">Add</button>
							</div><!-- /.box-footer -->
						</form>
					</div><!-- /.box -->
					<div class="box-footer no-padding">
						<ul class="nav nav-stacked" id="condoBox">
							<?php 
							if ($this->data['condos'])
							{
								foreach ($this->data['condos'] as $condo)
								{
									?>
							<li id="condoId<?php echo $condo['condo_id']; ?>"><a href="#"><?php echo $condo['condo']; ?><span class="pull-right badge bg-red"><i class="fa fa-close deleteCondo" data-id="<?php echo $condo['condo_id']; ?>"></i></span></a></li>
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
        </div>
        
        <div class="row">
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
										<input type="text" class="form-control" id="roomTypeName" placeholder="Room type">
									</div>
								</div>
								<div class="form-group">
									<label for="inputPassword3" class="col-sm-2 control-label">Description</label>
									<div class="col-sm-10">
										<textarea class="form-control" rows="3" id="roomTypeDescription" placeholder="Description ..."></textarea>
									</div>
								</div>
							</div><!-- /.box-body -->
							<div class="box-footer">
								<button type="submit" class="btn btn-info btn-xs pull-right" id="addRoomType">Add</button>
							</div><!-- /.box-footer -->
						</form>
					</div><!-- /.box -->
					<div class="box-footer no-padding">
						<ul class="nav nav-stacked" id="roomTypesBox">
							<!-- This has the close icon, or delete icon -->
							<!-- <li><a href="#"><?php echo $type['room_type']; ?><span class="pull-right badge bg-red"><i class="fa fa-close"></i></span></a></li> -->
							<?php 
							if ($this->data['types'])
							{
								foreach ($this->data['types'] as $type)
								{
									?>
							<li id="typeId<?php echo $type['room_type_id']; ?>"><a href="#"><?php echo $type['room_type']; ?><span class="pull-right badge bg-red"><i class="fa fa-close deleteType" data-id="<?php echo $type['room_type_id']; ?>"></i></span></a></li>
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
								<button type="submit" class="btn btn-danger btn-xs pull-right" id="deleteCategory">Delete category</button>
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
							<li><a href="#" id="inventoryId<?php echo $inventory['inventory_id']; ?>"><?php echo $inventory['inventory']; ?><span class="pull-right badge bg-red"><i class="fa fa-close deleteInventory" data-id="<?php echo $inventory['inventory_id']; ?>"></i></span></a></li>
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
							<label for="exampleInputEmail1">Individual percentage </label>
							<input type="text" class="form-control" id="memberCondo" placeholder="Percentage ...">
						</div>
					 
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
			<div class="col-md-6 text-right " id="showAddRoomBox">
				<div class="form-group">
					<button type="submit" class="btn btn-info pull-left btn-xs" id="showAddRoom">Add apartment</button>
				</div>
			</div>
			<div class="col-md-6 add-room-boxes">
				<div class="form-group">
					<label  class="col-sm-2 control-label">Apartment</label>
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
			
			<div class="col-md-6 text-right add-room-boxes">
				<div class="form-group">
					<button type="submit" class="btn btn-info pull-left btn-sm" id="addMemberRoom">Add room</button>
				</div>
			</div>
		</div>
		
		<h2 class="page-header">Apartments</h2>
		<input type="hidden" val="" id="currentRoom">
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
		
		<!------------------------------- Modals! ------------------------------->
		<!-- Modal  -->
		<div class="example-modal" >
			<input type="hidden" value="" id="currentCategory">
			<input type="hidden" value="" id="currentInventory">
			<div class="modal" id="payment-modal">
				<div class="modal-dialog modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title">Add payment</h4>
						</div>
						<div class="modal-body">
							<div class="row segment-user-payment">
								<div class="col-sm-12">
									<select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" id="categoryRoomList">
										<option>Category</option>
									</select>
								</div>
								
								<div class="col-sm-12">
									<select class="form-control select2 select2-hidden-accessible top-30" style="width: 100%;" tabindex="-1" aria-hidden="true" id="inventoryRoomList">
										<option>Inventory</option>
									</select>
								</div>
								
								<div class="col-sm-12">
									<a href="#" id="showAddInventory">Add Inventory</a>
								</div>
								
								<div class="col-sm-12">
									<div class="col-sm-10">
										<input type="text" class="form-control" placeholder="New inventory" id="newInventoryInput">
									</div>
									<div class="col-sm-2">
										<a href="#" class="btn btn-info btn-sm" id="newInventoryButton">Add</a>
									</div>
								</div>
							</div>
							
							<div class="row segment-user-payment">
								<div class="col-sm-6">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-dollar"></i></span>
										<input type="text" class="form-control" placeholder="Amount" id="paymentAmount">
									</div>
								</div>
								
								<div class="col-sm-6">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
										<input type="text" class="form-control" placeholder="Amount due date" id="paymentDate">
									</div>
								</div>
							</div>
							<div class="row segment-user-payment">
								<div class="col-sm-12">
									<div class="form-group">
										<textarea class="form-control" rows="3" placeholder="Payment description" id="paymentDescription"></textarea>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
							<!-- <button type="button" class="btn btn-info btn-sm" id="addPayment">Save</button>-->
							<a href="#" class="btn btn-info btn-sm" id="addPayment">Save</a>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
		</div>
		
		<!-- /.example-modal --><!------------------------------- Modals! ------------------------------->
		<!-- Modal  -->
		<div class="example-modal" >
			<div class="modal" id="singlePayment">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title">Payment</h4>
						</div>
						<div class="modal-body">
							<section class="invoice">
								<!-- title row -->
								<div class="row">
									<div class="col-xs-12">
										<h2 class="page-header">
											<i class="fa fa-globe"></i> <?php echo $this->data['appInfo']['siteName']; ?>
											<small class="pull-right">Date: <span id="dateAdded"></span></small>
										</h2>
									</div><!-- /.col -->
								</div>
								<!-- info row -->
								<div class="row invoice-info">
									<div class="col-sm-4 invoice-col">
										From
										<address>
											<strong><?php echo $this->data['appInfo']['siteName']; ?></strong><br>
											Phone: <?php echo $this->data['appInfo']['phone']; ?><br>
											Email: <?php echo $this->data['appInfo']['email']; ?>
										</address>
									</div><!-- /.col -->
									<div class="col-sm-4 invoice-col">
										To
										<address>
											<strong><?php echo $this->data['memberInfo']['name'].' '.$this->data['memberInfo']['last_name']; ?></strong><br>
											<?php echo $this->data['memberInfo']['address']; ?><br>
											Phone: <?php echo $this->data['memberInfo']['phone_one']; ?><br>
											Email: <?php echo $this->data['memberInfo']['email_one']; ?>
										</address>
									</div><!-- /.col -->
									<div class="col-sm-4 invoice-col">
										<b>Invoice #<span id="paymentNo"></span></b><br>
										<b>Payment Due:</b> <span id="singlePaymentDueDate"></</span>
									</div><!-- /.col -->
								</div><!-- /.row -->
								
								<!-- Table row -->
								<div class="row">
									<div class="col-xs-12 table-responsive">
										<table class="table table-striped">
											<thead>
												<tr>
													<th>Order</th>
													<th>Room</th>
													<th>Category</th>
													<th>Description</th>
													<th>Total</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td id="singlePaymentId"></td>
													<td id="singlePaymentInventory"></td>
													<td id="singlePaymentCategory"></td>
													<td id="singlePaymentDescription"></td>
													<td id="singlePaymentAmount"></td>
												</tr>
											</tbody>
										</table>
									</div><!-- /.col -->
								</div><!-- /.row -->
								
								<div class="row">
									<!-- accepted payments column -->
									<div class="col-xs-3">
										<div id="paymentOptionsPaid">
											<h3>PAID</h3>
										</div>
										
										<div id="paymentOptionsCancelled">
											<h3>CANCELLED</h3>
										</div>
										
										<div id="setPaymentOptionsBox">
											<p class="lead">Set payment as: </p>
											<div >
												<div class="form-group">
													<ul class="payment-options">
														<li>
															<input tabindex="7" type="radio" id="optionPaymentPending" name="minimal-radio">
															<label for="minimal-radio-1"> Pending</label>
														</li>
														<li>
															<input tabindex="8" type="radio" id="optionPaymentPaid" name="minimal-radio">
															<label for="minimal-radio-2"> Paid</label>
														</li>
														<li>
															<input tabindex="9" type="radio" id="optionPaymentCancelled" name="minimal-radio">
															<label for="minimal-radio-3"> Cancelled</label>
														</li>
													</ul>
												</div>
											</div>
										</div>
									</div><!-- /.col -->
									            
									<div class="col-xs-9">
										<div class="row">
											<div class="col-xs-6">
												<p class="lead">Uploaded by the Admin</p>
												<div class="table-responsive">
													<table class="table">
														<tbody id="paymentDocuments">
														</tbody>
													</table>
												</div>
												<div class="add-document" id="addDocument">
													Browse
												</div>
											</div>
											<div class="col-xs-6">
												<p class="lead">Uploaded by the Owner</p>
												<div class="table-responsive">
													<table class="table">
														<tbody id="paymentDocumentsOwner">
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div><!-- /.col -->
								</div><!-- /.row -->
							</section>
						</div>
						<div class="modal-footer">
							<input type="hidden" id="singlePaymentIdVal">
							<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>	
							<button class="btn btn-danger pull-right" id="deletePayment"><i class="fa fa-remove"></i> Delete</button>						
							<button class="btn btn-success pull-right" id="updatPayment"><i class="fa fa-credit-card"></i> Save Payment</button>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
		</div><!-- /.example-modal -->
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
					<a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $room['room_id']; ?>" class="roomList room-id" data-id="<?php echo $room['room_id']; ?>">
						<strong><?php echo $room['condo'].' / '.$room['room'].' / '.$room['room_type']; ?></strong>
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
								<input type="hidden" value="pending" id="currentPaymentSelection" />
								<ul class="nav nav-tabs">
									<li class="active"><a href="#tab_1" data-toggle="tab" id="getPendingTab">Payments</a></li>
									<li><a href="#tab_2" data-toggle="tab" id="getPastDueTab">Past Due</a></li>
									<li><a href="#tab_3" data-toggle="tab" id="getPaidTab">Paid</a></li>
									<li><a href="#tab_4" data-toggle="tab" id="getCancelledTab">Cancelled</a></li>
									<li><a href="#tab_5" data-toggle="tab" id="getDisplayAllPayments">All Payments</a></li>
									<li>
										<button type="submit" class="btn btn-danger btn-xs pull-right deleteApartment"  data-id="<?php echo $room['room_id']; ?>">Delete apartment</button>
									</li>
									<!-- <li><a href="#tab_3" data-toggle="tab">Galleries</a></li> -->
								</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="tab_1">
										<div class="row">
											<div class="col-sm-3">
												<button data-target="#payment-modal" type="submit" class="btn btn-info pull-left btn-sm" data-toggle="modal" >Add payment</button>
											</div>
											<div class="col-sm-3">
												<h3>Total: $<span class="paymentTotal"></span></h3>
											</div>
											<div class="col-sm-3">
												<h3>Paid: $<span class="paymentPaid"></span></h3>
											</div>
											<div class="col-sm-3">
												<h3>Pending: $<span class="paymentPending"></span></h3>
											</div>
										</div>
										<div class="vertical-spacer"></div>
										<div class="row paymentsBox-<?php echo $room['room_id']; ?>" id=""></div>
										
									</div><!-- /.tab-pane -->
									
									<div class="tab-pane" id="tab_2">
										<div class="row">
											<div class="col-sm-3">
												<button data-target="#payment-modal" type="submit" class="btn btn-info pull-left btn-sm" data-toggle="modal" >Add payment</button>
											</div>
											<div class="col-sm-3">
												<h3>Total: $<span class="paymentTotal"></span></h3>
											</div>
											<div class="col-sm-3">
												<h3>Paid: $<span class="paymentPaid"></span></h3>
											</div>
											<div class="col-sm-3">
												<h3>Pending: $<span class="paymentPending"></span></h3>
											</div>
										</div>
										<div class="vertical-spacer"></div>
										<div class="row paymentsBox-<?php echo $room['room_id']; ?>" id=""></div>
									</div> <!-- /.tab-pane -->
									
									<div class="tab-pane" id="tab_3">
										<div class="row">
											<div class="col-sm-3">
												<button data-target="#payment-modal" type="submit" class="btn btn-info pull-left btn-sm" data-toggle="modal" >Add payment</button>
											</div>
											<div class="col-sm-3">
												<h3>Total: $<span class="paymentTotal"></span></h3>
											</div>
											<div class="col-sm-3">
												<h3>Paid: $<span class="paymentPaid"></span></h3>
											</div>
											<div class="col-sm-3">
												<h3>Pending: $<span class="paymentPending"></span></h3>
											</div>
										</div>
										<div class="vertical-spacer"></div>
										<div class="row paymentsBox-<?php echo $room['room_id']; ?>" id=""></div>
									</div> <!-- /.tab-pane -->
									
									<div class="tab-pane" id="tab_4">
										<div class="row">
											<div class="col-sm-3">
												<button data-target="#payment-modal" type="submit" class="btn btn-info pull-left btn-sm" data-toggle="modal" >Add payment</button>
											</div>
											<div class="col-sm-3">
												<h3>Total: $<span class="paymentTotal"></span></h3>
											</div>
											<div class="col-sm-3">
												<h3>Paid: $<span class="paymentPaid"></span></h3>
											</div>
											<div class="col-sm-3">
												<h3>Pending: $<span class="paymentPending"></span></h3>
											</div>
										</div>
										<div class="vertical-spacer"></div>
										<div class="row paymentsBox-<?php echo $room['room_id']; ?>" id=""></div>
									</div> <!-- /.tab-pane -->
									
									
									<div class="tab-pane" id="tab_5">
										<section class="invoice">
											<!-- title row -->
											<div class="row">
												<div class="col-xs-12">
													<h2 class="page-header">
														<i class="fa fa-globe"></i> <?php echo $this->data['appInfo']['siteName']; ?>
													</h2>
												</div><!-- /.col -->
											</div>
											<!-- info row -->
											<div class="row invoice-info">
												<div class="col-sm-4 invoice-col">
													From
													<address>
														<strong><?php echo $this->data['appInfo']['siteName']; ?></strong><br>
														Phone: <?php echo $this->data['appInfo']['phone']; ?><br>
														Email: <?php echo $this->data['appInfo']['email']; ?>
													</address>
												</div><!-- /.col -->
												<div class="col-sm-4 invoice-col">
													To
													<address>
														<strong><?php echo $this->data['memberInfo']['name'].' '.$this->data['memberInfo']['last_name']; ?></strong><br>
														<?php echo $this->data['memberInfo']['address']; ?><br>
														Phone: <?php echo $this->data['memberInfo']['phone_one']; ?><br>
														Email: <?php echo $this->data['memberInfo']['email_one']; ?>
													</address>
												</div><!-- /.col -->
											</div><!-- /.row -->
											
											<!-- Table row -->
											<div class="row">
												<div class="col-xs-12 table-responsive">
													<table class="table table-striped">
														<thead>
															<tr>
																<th>Category</th>
																<th>Description</th>
																<th>Payment due</th>
																<th>Pending</th>
																<th>Paid</th>
															</tr>
														</thead>
														<tbody id="allPaymentsContent">
															
														</tbody>
													</table>
												</div><!-- /.col -->
											</div><!-- /.row -->
											<div class="row">
												<!-- accepted payments column -->
												<div class="col-xs-12">
													<div id="paymentOptionsBox">
														<h3>Total: $<span id="totalViewAllPayments"></span></h3>
													</div>
												</div><!-- /.col -->
											</div><!-- /.row -->
											<div class="row">
												<div class="col-xs-12">
													<button data-target="#payment-modal" type="submit" class="btn btn-info pull-left btn-md" data-toggle="modal" >Send via e-mail</button>
												</div>
											</div><!-- /.row -->
										</section>
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
    
    public function getSingleMessage($message)
    {
    	ob_start();
    	$class = '';
    	$className = '';
    	$classDate = '';
    	$name = '';
    	$image = '';
//     	var_dump($message);
    	if ($message['from_user'] == $this->data['memberInfo']['member_id'])
    	{
    		$class = 'right';
    		$className = 'pull-right';
    		$classDate = 'pull-left';
    		$name = $message['member_name'];
    		if ($message['avatar'])
    		{
    			$image = "/images/owners-profile/avatar/".$message['avatar'];
    		}
    		else 
    		{
    			$image = "/dist/img/default-user.jpg";
    		}
    	}
    	else 
    	{
    		$className = 'pull-left';
    		$classDate = 'pull-right';
    		$name = $message['user_name'];
    		$image = "/dist/img/user2-160x160.jpg";
    	}
    	?>
    	<!-- Message to the right -->
		<div class="direct-chat-msg <?php echo $class; ?>">
			<div class="direct-chat-info clearfix">
				<span class="direct-chat-name <?php echo $className; ?>"><?php echo $name; ?></span>
				<span class="direct-chat-timestamp <?php echo $classDate; ?>"><?php echo $message['date']; ?></span>
			</div><!-- /.direct-chat-info -->
			<img class="direct-chat-img" src="<?php echo $image; ?>" alt="message user image"><!-- /.direct-chat-img -->
			<?php if ($message['status'] == 0) 
			{
			?>
			<div class="direct-chat-text" style="font-weight: bold;">
				<?php echo $message['message']; ?>
			</div><!-- /.direct-chat-text -->
			<?php 
			} else { 
				?>
			<div class="direct-chat-text">
				<?php echo $message['message']; ?>
			</div><!-- /.direct-chat-text -->	
				<?php 
			}
			?>
		</div><!-- /.direct-chat-msg -->
    	<?php
    	$content = ob_get_contents();
    	ob_end_clean();
    	return $content;
    }
    
    public function getMessagesPanel()
    {
    	ob_start();
    	?>
    	<!-- DIRECT CHAT WARNING -->
		<div class="box box-primary direct-chat direct-chat-primary">
			<div class="box-header">
				<h3 class="box-title">Direct Chat</h3>
				<div class="box-tools pull-right">
					<span  class="">
						<a href="#" id="markAllAsRead" class="text-green"><b>Mark all as read</b></a>
					</span>
					/
					<span  class="">
						<a href="#" id="sendEmailNotification" class="text-blue"><b>Send e-mail notification</b></a>
					</span>
				</div>
			</div><!-- /.box-header -->
			<div class="box-body" id="">
				<!-- Conversations are loaded here -->
				<div class="direct-chat-messages" id="boxChat">
					<?php 
					if ($this->data['messages'])
					{
						foreach ($this->data['messages'] as $message)
						{
							echo $this->getSingleMessage($message);
						}
					}
					?>
				</div><!--/.direct-chat-messages-->
			</div><!-- /.box-body -->
			<div class="box-footer">
				<div class="input-group">
					<input type="text" name="message" placeholder="Type Message ..." class="form-control" id="chatMessage">
					<span class="input-group-btn">
						<button type="button" class="btn btn-primary btn-flat" id="addChatMessage">Send</button>
					</span>
				</div>
			</div><!-- /.box-footer-->
		</div><!--/.direct-chat -->
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
    	<link rel="stylesheet" href="/plugins/select2/select2.min.css">
    	<link rel="stylesheet" href="/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
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
    	<script src="/plugins/iCheck/icheck.min.js"></script>
    	<script src="/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    	
    	<script type="text/javascript">
    	$(function () {
            //Money Euro
            $("[data-mask]").inputmask();
            $("#task-date").datepicker();
            $('#paymentDate').datepicker();
            $(".select2").select2();

          //iCheck for checkbox and radio inputs
            $('input[type="radio"]').iCheck({
                radioClass: 'iradio_minimal-blue',
                increaseArea: '20%' // optional
            });

          	scrollToBottom();
            
    	});
    	$(function () {
    	    //Add text editor
    	    $("#sendEmailContent").wysihtml5();
    	  });
		</script>
		<link href="/css/uploadfile.css" rel="stylesheet">
		<script src="/js/jquery.uploadfile.min.js"></script>
		<script src="/js/members.js"></script>
		<script src="/js/history.js"></script>
		<script src="/js/tasks.js"></script>
		<script src="/js/rooms.js"></script>
		<script src="/js/payments.js"></script>
		<script src="/js/email.js"></script>
		<script src="/js/messages.js"></script>
    	<?php
    	$scripts = ob_get_contents();
    	ob_end_clean();
    	return $scripts;
    }
    
    public function getMemberContent()
    {
    	ob_start();
    	
    	$img = "/images/default/128x128-user.png";

    	if ($this->data['memberInfo']['avatar'])
    	{
    		$img = "/images/owners-profile/avatar/".$this->data['memberInfo']['avatar'];
    	}
    	?>
    	
    	<!-- Modal  -->
		<div class="example-modal" >
			<div class="modal" id="avatarModal">
				<div class="modal-dialog modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title">Change user avatar</h4>
						</div>
						<div class="modal-body">
							<div class="row">
								<div class="col-sm-12">
									<div class="col-sm-4">
										<img alt="" height="100" id="iconImg" src="<?php echo $img; ?>" />
									</div>
									<div class="col-sm-3">
										<h5><b>Avatar</b> 128 * 128px</h5>
									</div>
								</div>
								<div class="col-sm-12">
									<div class="col-sm-6" id="uploadAvatar">
										Browse
									</div>
								</div>
							</div>
							<br>
							<div class="clearfix"></div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
		</div><!-- /.example-modal -->
		
		<!-- Modal Send Email  -->
		<div class="example-modal" >
			<div class="modal" id="sendEmail">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title">Send e-mail to <?php echo $this->data['memberInfo']['name'].' '.$this->data['memberInfo']['last_name']; ?></h4>
						</div>
						<div class="modal-body">
							<div class="box box-primary">
								<div class="box-header with-border">
									<h3 class="box-title">Compose New Message</h3>
								</div>
								<!-- /.box-header -->
								<div class="box-body">
									<div class="form-group">
										<input class="form-control" placeholder="To:" value="<?php echo $this->data['memberInfo']['email_one']; ?>" id="sendEmailTo">
									</div>
									<div class="form-group">
										<input class="form-control" placeholder="Subject:" id="sendEmailSubject">
									</div>
									<div class="form-group">
										<textarea id="sendEmailContent" class="form-control" style="height: 300px"></textarea>
									</div>
									<div class="form-group">
										<div class="btn btn-default btn-file">
											<i class="fa fa-paperclip"></i> Attachment
											<input type="file" name="attachment">
										</div>
										<p class="help-block">Max. 32MB</p>
									</div>
								</div>
								<!-- /.box-body -->
								<div class="box-footer">
									<div class="pull-right">
										<button type="submit" class="btn btn-primary" id="sendEmailOwner"><i class="fa fa-envelope-o"></i> Send</button>
									</div>
								</div>
								<!-- /.box-footer -->
							</div>
							<!-- /. box -->
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
		</div><!-- /.example-modal -->
		
    	<div class="row">
			<div class="col-md-12">
				<!-- Widget: user widget style 1 -->
				<div class="box box-widget widget-user-2">
				
					<!-- Add the bg color to the header using any of the bg-* classes -->
					<div class="widget-user-header bg-aqua-active">
						<div class="widget-user-image">
							<a href="#" class="avatar-user-change" data-toggle="modal" data-target="#avatarModal" data-keyboard="true">
								<img class="img-circle" id="userAvatarImg" src="<?php echo $img; ?>" alt="User Avatar">
							</a>
						</div><!-- /.widget-user-image -->
						<h3 class="widget-user-username"><strong><?php echo $this->data['memberInfo']['name'].' '.$this->data['memberInfo']['last_name']; ?></strong></h3>
						<h5 class="widget-user-desc"><strong><?php echo $this->data['memberInfo']['condo']; ?></strong></h5>
						
						<button type="submit" class="btn btn-danger btn-xs pull-right " id="deleteOwner">Delete owner</button>
						<button type="submit" class="btn btn-primary btn-xs pull-right" id="showEditUser">Update</button>
						<button type="submit" class="btn btn-success btn-xs pull-right" id="sendOwnerInfo">Send info</button>
						<div class="clearfix"></div>
					</div>
					<div class="box-footer">
						<div class="row">
							<?php if ($this->data['memberInfo']['phone_one']) {?>
							<div class="col-sm-3 border-right">
								<div class="description-block">
									<h5 class="description-header"><i class="fa fa-fw fa-phone"></i></h5>
									<span class="description-text"><?php echo $this->data['memberInfo']['phone_one']; ?></span>
								</div><!-- /.description-block -->
							</div><!-- /.col -->
							<?php } if ($this->data['memberInfo']['phone_two']) {?>
							<div class="col-sm-3 border-right">
								<div class="description-block">
									<h5 class="description-header"><i class="fa fa-fw fa-phone"></i></h5>
									<span class="description-text"><?php echo $this->data['memberInfo']['phone_two']; ?></span>
								</div><!-- /.description-block -->
							</div><!-- /.col -->
							<?php } if ($this->data['memberInfo']['email_one']) {?>
							<div class="col-sm-3">
								<div class="description-block">
									<h5 class="description-header"><i class="fa fa-fw fa-envelope-o"></i></h5>
									<span class="description-text"><?php echo $this->data['memberInfo']['email_one']; ?></span>
								</div><!-- /.description-block -->
							</div><!-- /.col -->
							<?php } if ($this->data['memberInfo']['email_two']) {?>                   
							<div class="col-sm-3">
								<div class="description-block">
									<h5 class="description-header"><i class="fa fa-fw fa-envelope-o"></i></h5>
									<span class="description-text"><?php echo $this->data['memberInfo']['email_two']; ?></span>
								</div><!-- /.description-block -->
							</div><!-- /.col -->
							<?php } ?>
						</div><!-- /.row -->
					</div>
					<div class="box-footer no-padding">
						<ul class="nav nav-stacked user-info">
							<?php if ($this->data['memberInfo']['address']) {?>
							<li><span><i class="fa fa-fw fa-map-o"></i> <?php echo $this->data['memberInfo']['address']; ?></span></li>
							<?php } ?>
							<?php if ($this->data['memberInfo']['condo']) {?>
							<li><span><i class="fa fa-fw fa-pie-chart"></i>Percentage <?php echo $this->data['memberInfo']['condo']; ?></span></li>
							<?php } ?>
							<li><span><i class="fa fa-fw fa-sticky-note"></i><strong> <?php echo $this->data['memberInfo']['notes']; ?></strong></span></li>
							<li><span> <button data-target="#sendEmail" type="submit" class="btn btn-info pull-left btn-sm" data-toggle="modal" id="sendEmailButton">Send E-Mail</button></span></li>
						</ul>
					</div>
				</div><!-- /.widget-user -->
			</div>
    	</div>
    	
		<div class="row edit-user-info">
			<div class="col-md-6">
				<div class="box box-info">
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
							<label for="exampleInputEmail1">Individual percentage </label>
							<input type="text" class="form-control" id="memberCondo" placeholder="Condo" value="<?php echo $this->data['memberInfo']['condo']; ?>">
						</div>
						
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
						<div class="row">
							<div class="col-sm-offset-6 col-sm-2"></div>
							<div class="col-sm-2"><button type="submit" class="btn btn-info pull-right btn-sm" id="updateMember">Update info</button></div>
							<div class="col-sm-2"><button type="submit" class="btn btn-danger pull-right btn-sm" id="cancelEditUser">Cancel</button></div>
						</div>
                  	</div>
				</div>
			</div>
		</div>
		
		<div class="row" id="tabPanel">
			<div class="col-md-12">
				<!-- Custom Tabs (Pulled to the right) -->
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs pull-right">
						<li><a href="#tab_1-1" data-toggle="tab">Tasks</a></li>
						<li><a href="#tab_2-2" data-toggle="tab">History</a></li>
						<li class="<?php if ($_GET['message']){ echo "active"; }?>"><a href="#tab_3-3" data-toggle="tab" id="tabMessageSender" onclick="scrollToBottom();">Messages <span data-toggle="tooltip" title="New Messages" class="badge bg-light-blue" id="messageNumberBadge"><?php echo $this->data['unreadMessagesMember']; ?></span></a></li>
						<li class="<?php if (!$_GET['message']){ echo "active"; }?>"><a href="#tab_3-2" data-toggle="tab">Apartments</a></li>
						<li class="pull-left header"><i class="fa fa-th"></i>Admin Owner</li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane <?php if (!$_GET['message']){ echo "active"; }?>" id="tab_3-2">
							<?php echo $this->getRoomPanel(); ?>
						</div><!-- /.tab-pane -->
						
						<div class="tab-pane <?php if ($_GET['message']){ echo "active"; }?>" id="tab_3-3">
							<?php echo $this->getMessagesPanel(); ?>
						</div><!-- /.tab-pane -->
						
						<div class="tab-pane" id="tab_2-2">
							<div class="row">
								<?php echo $this->getHistoryPanel(); ?>
							</div>
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
					<div class="col-md-4">
						<div class="form-group">
							<label for="exampleInputEmail1">Room name</label>
							<input type="text" class="form-control" id="roomName" placeholder="Room name" value="" >
                  		</div><!-- /.form-group -->
					</div><!-- /.col -->
					
					<div class="col-md-4">
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
					
					<div class="col-md-4">
						<div class="form-group">
							<label>Condo</label>
							<select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" id="condoId">
								<?php 
								foreach ($this->data['condos'] as $type)
								{
									?>
								<option value="<?php echo $type['condo_id']; ?>"><?php echo $type['condo']; ?></option>
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
							<li>
								<a href="/edit-room/<?php echo $room['room_id']; ?>/">
									<strong>[<?php echo $room['condo']; ?>]</strong>
									<?php echo $room['room'].' / '.$room['room_type']; ?>
								</a>
							</li>
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
					<div class="col-md-4">
						<input type="hidden" id="roomId" value="<?php echo $this->data['room']['room_id']; ?>" >
						<div class="form-group">
							<label for="exampleInputEmail1">Room name</label>
							<input type="text" class="form-control" id="roomName" placeholder="Room name" value="<?php echo $this->data['room']['room']; ?>" >
                  		</div><!-- /.form-group -->
					</div><!-- /.col -->
					
					<div class="col-md-4">
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
					
					<div class="col-md-4">
						<div class="form-group">
							<label>Condo</label>
							<select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" id="condoId">
								<?php 
								foreach ($this->data['condos'] as $type)
								{
									?>
								<option value="<?php echo $type['condo_id']; ?>"><?php echo $type['condo']; ?></option>
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
				<button type="submit" class="btn btn-danger btn-sm pull-right" id="deleteRoom">Delete room</button>
				<button type="submit" class="btn btn-info btn-sm pull-right" id="updateRoom">Update room</button>
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
				<button type="submit" class="btn btn-info btn-sm pull-right" id="addRoomInventory">Add inventory</button>
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
    
    /**
   	 * The whole list of members
   	 * 
   	 * @return string
   	 */
   	public function getRoomsByCondo()
   	{
   		ob_start();
   		?>
   		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Recent Owners</h3>
					</div><!-- /.box-header -->
					<div class="box-body table-responsive no-padding">
	                  <table class="table table-hover">
	                    <tr>
	                      <th>Member ID</th>
							<th>Name</th>
							<th>Room</th>
							<th>Condo</th>
							<th>Total</th>
							<th>Paid</th>
							<th>Pending</th>
	                    </tr>
	                    <?php 
						foreach ($this->data['members'] as $member)
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
							<td><?php echo $member['room']; ?></td>
							<td><?php echo $member['condo']; ?></td>
							<td>$ <?php echo $member['total']; ?></td>
							<td>$ <?php echo $member['paid']; ?></td>
							<td>$ <?php echo $member['pending']; ?></td>
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
   	public function getAllUnreadMessages()
   	{
   		ob_start();
   		?>
   		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Recent messages</h3>
					</div><!-- /.box-header -->
					<div class="box-body table-responsive no-padding">
	                  <table class="table table-hover">
	                    <tr>
	                      <th>Member ID</th>
							<th>Name</th>
							<th>Message</th>
							<th>Unread</th>
							<th>Last Message</th>
	                    </tr>
	                    <?php 
						foreach ($this->data['messages'] as $message)
						{
							?>
						<tr>
							<td>
								<a href="/owner/<?php echo $message['from_user']; ?>/<?php echo Tools::slugify($message['name']); ?>/message/">
									<?php echo $message['from_user']; ?>
								</a>
							</td>
							<td>
								<a href="/owner/<?php echo $message['from_user']; ?>/<?php echo Tools::slugify($message['name']); ?>/message/">
									<?php echo $message['name']; ?>
								</a>
							</td>
							<td>
								<a href="/owner/<?php echo $message['from_user']; ?>/<?php echo Tools::slugify($message['name']); ?>/message/">
									<?php echo $message['message']; ?>
								</a>
							</td>
							<td><?php echo $message['total']; ?></td>
							<td><?php echo $message['date']; ?></td>
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
            <strong>Copyright &copy; 2018 <a href="#"><?php echo $this->data['appInfo']['siteName']; ?></a>.</strong> All rights reserved.
        </footer>
    	<?php
    	$footer = ob_get_contents();
    	ob_end_clean();
    	return $footer;
	}
}