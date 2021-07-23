<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<title>CodeIgniter</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<style type="text/css">
			td{
				padding:0 15px;
			}
		</style>
	</head>
<body>

	<a href="/todo/index.php/board/show_login" class="navbar-brand">로그인</a>
	<a href="/todo/index.php/board/show" class="navbar-brand">회원가입</a>

	<br>
	<br>
	<a href="/todo/index.php/board/write">게시글 작성하기</a>

	<div id="main">
	<h1>게시글 리스트</h1>

<article id="board_area">

	<header>
		<h1></h1>
	</header>

	<table cellpadding="0" cellspacing="0">

		<thead>
			<tr>
				<th scope="col">번호</th>
				<th scope="col">제목</th>
				<th scope="col">작성자</th>
				<th scope="col">작성일</th>
			</tr>
		</thead>

		<tbody>

			<?php
			foreach($list as $lt)
			{
				?>
				<tr>
					<th scope="row"><?php echo $lt->board_id;?></th>
					<td><a rel="external" href="/todo/index.php/board/view/<?php echo $lt->board_id;?>"><?php echo $lt->subject;?></a></td>
					<td><?php echo $lt->user_name;?></td>
					<td><?php echo mdate("%Y-%M-%j",human_to_unix($lt->reg_date));?></td>
				</tr>
				<?php

			}
			?>

		</tbody>

	</table>
</article>

<br>





