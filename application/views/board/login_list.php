<!DOCTYPE html>
<html>

<head>

	<meta charset="UTF-8"/>
	<meta name="apple-mobile-web-app-capable" content="yes"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no"/>
	<title>게시판</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<style type="text/css">
		td{
			padding:0 15px;
		}
	</style>

</head>

<body>

<a href="/todo/index.php/auth/logout" class="navbar-brand">로그아웃</a>
<a href="/todo/index.php/board/show" class="navbar-brand">회원가입</a>

<br>
<br>
<a href="/todo/index.php/board/write">게시글 작성하기</a>

	<h1>게시글 리스트</h1>
	<article id="board_area">

		<table cellpadding="0" cellspacing="0">

			<thead>
				<tr>
					<th scope="col">번호</th>
					<th scope="col">제목</th>
					<th scope="col">작성자</th>
					<th scope="col">작성일</th>
					<th scope="col">첨부파일 (첨부파일 존재시 다운로드 가능)</th>
				</tr>
			</thead>

			<tbody>

				<?php
				foreach($list as $lt)
				{
					?>
					<tr>

						<td scope="row"><?php echo $lt->board_id;?></td>
						<td><a rel="external" href="/todo/index.php/board/view/<?php echo $lt->board_id;?>"><?php echo $lt->subject;?></a></td>
						<td><?php echo $lt->user_name;?></td>
						<td><?php echo $lt->reg_date;?></td>

						<td><a rel="external" href="/todo/index.php/board/download_file/<?php echo $lt->board_id;?>">
								<?php

								//첨부파일 없는 경우
								if(strlen($lt->file_path)==34){
									echo "<a>X</a>";
								}

								//첨부파일 있는경우
								else{
									echo "O";
								}

								;?>

							</a>
						</td>

					</tr>
					<?php


				}
				?>
			</tbody>

		</table>
	</article>







