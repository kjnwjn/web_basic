<?php

require_once('./private/core/App.php');
require_once('./private/core/Controller.php');
require_once('./private/core/DB.php');

// php mailer
require_once('./private/core/phpmailer/Exception.php');
require_once('./private/core/phpmailer/PHPMailer.php');
require_once('./private/core/phpmailer/SMTP.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
