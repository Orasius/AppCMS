<?PHP
if($_POST['name'] == 'g')
{
	var_dump($_FILES);
}
else
{
?>
<html>
    <head>
        <title>Test</title>
    </head>
    <body>
       <form action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
       		<input type="hidden" name="name" value="g" />
        	<input name="upload[]" type="file" multiple accept="image/gif,image/png,image/jpeg" />
        	
        	<br />
        	<input type="submit" value="Upload!" />
        </form>
    </body>
</html>
<?
}
?>