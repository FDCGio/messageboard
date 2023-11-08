<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		echo $this->Html->css('users/header.css');
		
	?>
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
	<link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet" />
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>
<body>
	<div id="container" style="width:100%;padding:0;">
		<?php if ($this->request->params['action'] !== 'login'): ?>
			<nav class="navbar navbar-expand-lg navbar-dark bg-teal">
				<div class="container">
					<a class="navbar-brand" href="<?= $this->Html->url(['controller' => 'Users', 'action' => 'profile']) ?>">Message Board</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarNav">
						<ul class="navbar-nav ms-auto" id="navbarLinks">
							<?php if ($this->Session->check('Auth.User')) : ?>
								<?php $user = $this->Session->read('Auth.User'); ?>
								<li class="nav-item ml-auto">
								<?php if ($user['profile_img']) : ?>
									<img id="default_img" src="<?= $this->webroot ?>img/user_images/<?= $user['profile_img'] ?>" style="width: 50px; height: 50px;" alt="<?= $user['name'] ?>">
								<?php else : ?>
									<img id="default_img" src="<?= $this->webroot ?>img/empty_img.png" style="width: 50px; height: 50px;" alt="<?= $user['name'] ?>">
								<?php endif; ?>
								</li>
								<li class="nav-item dropdown ml-auto">
									<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
										<?php echo $user['name']; ?>
									</a>
									<div class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
										<a class="dropdown-item" href="<?= $this->Html->url(['controller' => 'Users', 'action' => 'edit']) ?>">Edit Profile</a>
										<a class="dropdown-item" href="<?= $this->Html->url(['controller' => 'Users', 'action' => 'edit_email']) ?>">Change Email Address</a>
										<a class="dropdown-item" href="<?= $this->Html->url(['controller' => 'Users', 'action' => 'edit_pass']) ?>">Change Password</a>
									</div>
								</li>
								<li class="nav-item dropdown ml-auto">
									<a class="nav-link dropdown-toggle" href="#" id="messageDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
										Messages
									</a>
									<div class="dropdown-menu dropdown-menu-end" aria-labelledby="messageDropdown">
										<a class="dropdown-item" href="<?= $this->Html->url(['controller' => 'Messages', 'action' => 'new_message']) ?>" class="btn btn-primary">New Message</a>
										<a class="dropdown-item" href="<?= $this->Html->url(['controller' => 'Messages', 'action' => 'message_list']) ?>" class="btn btn-primary">Message List</a>
									</div>
								</li>
								<li class="nav-item ml-auto">
									<a class="nav-link" href="<?= $this->Html->url(['controller' => 'Users', 'action' => 'logout']) ?>" class="btn btn-danger">Logout</a>
								</li>
								<?php else : ?>
								<li class="nav-item">
									<a class="nav-link" href="<?= $this->Html->url(['controller' => 'Users', 'action' => 'login']) ?>">Login</a>
								</li>
								<!-- <li class="nav-item">
									<a class="nav-link" href="<?= $this->Html->url(['controller' => 'Users', 'action' => 'register']) ?>">Register</a>
								</li> -->
							<?php endif; ?>
						</ul>
					</div>
				</div>
			</nav>
		<?php endif; ?>
		<div id="content">
			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			
		</div>
	</div>
	<!-- <?php echo $this->element('sql_dump'); ?> -->
	
</body>
</html>
