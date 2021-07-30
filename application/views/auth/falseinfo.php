

<a href="/todo/index.php/board/lists"><h1>메인 페이지이동</h1></a>

<div class="container" id="main">
	<div class="col-md-6 col-md-offset-3">
		<div class="panel panel-default content-main">
			<form autocomplete="off" action="/todo/index.php/auth/login" method="post">

				<p style="color: red">사용자아이디/패스워드가 회원가입한 정보가 아닙니다!</p>

				<div class="form-group">
					<label>사용자 아이디</label>
					<br>
					<input style="margin-bottom: 1em" type="text" class="form-control" name="userid" placeholder="사용자아이디" autocomplete="new-password">
				</div>

				<div class="form-group">
					<label>비밀번호</label>
					<br>
					<input type="password" class="form-control" name="password" placeholder="패스워드" autocomplete="new-password">
				</div>

				<br>
				<button type="submit" class="btn btn-success clearfix pull-right">로그인</button>

			</form>
		</div>
	</div>
</div>

