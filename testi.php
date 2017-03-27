<?php
$userMail = 'juska.munne@gmail.com';

$imageWidth = '150'; //The image size

$imgUrl = 'http://www.gravatar.com/avatar/'.md5($userMail).'fs='.$imageWidth;



?>

<?php echo $imgUrl;?>
