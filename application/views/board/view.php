<!DOCTYPE html>
<html>

<head>


</head>

<body>

	<?php
	foreach($post as $lt)
	{
		?>
		<div>
			<h1 scope="row">게시글 내용</h1>
			<textarea><?php echo $lt->contents;?></textarea>
		</div>
		<?php

	}
	?>
</body>

</html>

