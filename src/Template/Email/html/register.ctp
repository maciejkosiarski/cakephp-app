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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
<head>
    <title>Email rejestracyjny</title>
</head>
<body>
	<table class="border: 2px solid black">
	    <tr>
	        <td style="background-color: #01545b; color: #ffffff; text-align: center;"><h1>Dzięki za rejestracje!</h1></td>
	    </tr>
	    <tr>
	        <td style="color:#1798A5;">Twoje konto zostało utworzone, możesz logować się za pomocą poniższych danych, po kliknięciu w przycisk na dole maila.</td>
	    </tr>
	    <tr>
	        <td>
	            <hr style="color:#1798A5;">
	            <p style="color:#1798A5;"><strong>Email: </strong><?= $email ?></p>
	            <p style="color:#1798A5;"><strong>Hasło: </strong><?= $password ?></p>
	            <hr style="color:#1798A5;">
	        </td>
	    </tr>
	    <tr>
	        <td style="background-color: #01545b; color: #ffffff; text-align: center;"><a style="color: #ffffff; text-decoration: none; width:100%; height:100%;" href="http://localhost/cakephp_blog/users/verifyEmail/<?= $email ?>/<?= $hash ?>"><h2>Kliknij<h2/></a></td>
	    </tr>
	</table>
</body>
</html>