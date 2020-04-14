<?php

// configuration
$url = '/woopla';
$file = 'clients.txt';

// check if form has been submitted
if (isset($_POST['text']))
{
    // save the text contents
    file_put_contents($file, $_POST['text']);

    // redirect to form again
    header(sprintf('Location: %s', $url));
    printf('<a href="%s">Moved</a>.', htmlspecialchars($url));
    exit();
}

// read the textfile
$text = file_get_contents($file);

?>
<!-- HTML form -->
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
    integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous" />
<head>
<body>
	<div class="col-lg-12">
		<div class="panel panel-primary" style="border-color: #000000;">
			<div class="panel-heading" style="background-color: #000000;border-color: #000000;">
			 <img src="logo.png" alt="Deloitte Logo" style="height: 17px;" />
             <h3 class="panel-title" style="display: contents;">Client List Editor</h3>
			</div>
			<div class="panel-body">
				<form action="" method="post" class="panel">
				<textarea name="text" style="width:100%; height: 25rem"><?php echo htmlspecialchars($text) ?></textarea>
				<input class="btn btn-success" type="submit" />
				</form>
			</div>
		</div>
	</div>
</body>