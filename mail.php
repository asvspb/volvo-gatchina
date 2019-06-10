<?php

$method = $_SERVER['REQUEST_METHOD'];

$project_name = 'Volvo-Gatchina';
$admin_email = 'd@cidious.com';
$form_subject = 'Request for Callback';

//Script Foreach
$c = true;
$message = '';
if ($method === 'POST') {
    $username = htmlspecialchars(trim($_POST['user-name']));
    $userphone = htmlspecialchars(trim($_POST['user-phone']));

    foreach ($_POST as $key => $value) {
        $message .= (($c = !$c) ? '<tr>' : '<tr style="background-color: #f8f8f8;">') .
            "<td style='padding: 10px; border: #e9e9e9 1px solid;'><b>$key</b></td>".
            "<td style='padding: 10px; border: #e9e9e9 1px solid;'>$value</td></tr>";
    }
}

$message = "<p>Этот человек хочет чтобы ему перезвонили:</p><table style='width: 100%;'>$message</table>";

function adopt($text)
{
    return '=?UTF-8?B?' . Base64_encode($text) . '?=';
}

$headers = "MIME-Version: 1.0" . PHP_EOL .
    "Content-Type: text/html; charset=utf-8" . PHP_EOL .
    'From: ' . adopt($project_name) . ' <' . $admin_email . '>' . PHP_EOL .
    'Reply-To: ' . $admin_email . '' . PHP_EOL;

var_dump(mail($admin_email, adopt($form_subject), $message, $headers));
