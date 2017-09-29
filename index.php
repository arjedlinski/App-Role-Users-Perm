<html lang="en">
<?php include_once('head.php') ;
ini_set('display_errors', 'On');
if (empty($_GET)){
	$_GET['url'] = '/';
}
if (isset($_GET['url']))
{

	$start = new App();
}
?>
<body>
<div style="    position: relative;min-height: 100%;">
<div style="    max-width: 1260px;
    margin: 0 auto;padding-bottom:60px;">
	<?php include_once('header.php'); ?>
    
<?php

	if(isset($start)){
            
            $start->submit();
        }

?>

</div>
<?php include_once('footer.php'); ?>
</div>
</body>

</html>

