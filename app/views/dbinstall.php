<body>

        <?php global $app;?>
    <div>
        <h2>To use CRM you have to first install all database configs.<br>
        Below is a button to install datas.</h2>
        <div>Remember to edit your dbconfig file!. <br>
            File exist in the /config-crm/db/</div>
    </div>
	<form id="regiration_form" novalidate action="<?php echo $app->getUrl('dbinstall')?>" method="post">
		<input type="submit" name="submitinstall" class="submit btn btn-success" value="Click to install tables to database" />
	</form>
</body>
