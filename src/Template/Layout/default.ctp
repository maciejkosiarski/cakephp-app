<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    
    <?= $this->Html->css('main.css') ?>
    <?= $this->Html->css('bootstrap.min.css') ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/css/bootstrap-select.min.css">

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/js/bootstrap-select.min.js"></script>
</head>
<body>
    <?= $this->Flash->render() ?>
    <div class="container-fluid">
        <div class="row">
            <?= $this->fetch('content') ?>
        </div>
    </div>
    <?php if($this->request->session()->check('Auth.User')) : ?>
    <div class="user-panel">
        <div class="user-panel-box">
            <div class="user-panel-icon">
                Panel
            </div>
            <div class="user-panel-options">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="list-group">
                            <a href="#" class="user-panel-list-group-item">
                                <i class="fa fa-comment-o"></i> Lorem ipsum
                            </a>
                            <a href="#" class="user-panel-list-group-item">
                                <i class="fa fa-search"></i> Lorem ipsum
                            </a>
                            <a href="#" class="user-panel-list-group-item">
                                <i class="fa fa-user"></i> Lorem ipsum
                            </a>
                            <a href="#" class="user-panel-list-group-item">
                                <i class="fa fa-envelope"></i> Lorem ipsum <span class="badge">14</span>
                            </a>
                            <?= $this->Html->link(__('Logout'), '/logout', ['class' => 'user-panel-list-group-item']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <?php endif; ?>
    <footer>
    </footer>
    <?= $this->Html->script('main') ?>
    <?= $this->Html->script('bootstrap.min') ?>
</body>
</html>
