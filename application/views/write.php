<div id="main">

	<a href="/todo/index.php/board/lists"><h1>메인 페이지이동</h1></a>

	<article id="board_area">

		<header>
			<h1>게시글 쓰기</h1>
		</header>

		<form class="form-horizontal" method="post" action="/todo/index.php/board/write_post" id="write_action">
			<fieldset>
				<div class="control-group">
					<label class="control-label" for="input01">사용자 아이디</label>
					<div class="controls">
						<input type="text" class="input-xlarge" id="input01" name="userid">
						<p class="help-block"></p>
					</div>
					<label class="control-label" for="input02">사용자 이름</label>
					<div class="controls">
						<input type="text" class="input-xlarge" id="input02" name="username">
						<p class="help-block"></p>
					</div>
					<label class="control-label" for="input03">제목</label>
					<div class="controls">
						<input type="text" class="input-xlarge" id="input03" name="subject">
						<p class="help-block"></p>
					</div>

					<label class="control-label" for="input03">내용</label>
					<div class="controls">
						<input type="text" class="input-xlarge" id="input03" name="contents">
						<p class="help-block"></p>
					</div>

					<div class="form-actions">
						<input type="submit" class="btn btn-primary" id="write_btn" value="작성"/>
					</div>

				</div>
			</fieldset>
		</form>
	</article>

</div>



