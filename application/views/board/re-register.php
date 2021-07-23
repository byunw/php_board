
<!--jquery 사용햐려고 추가함-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>

	function checkid(){

		//사용자아이디
		var userid=document.getElementById("user_id").value;

		//사용자아이디폼에 데이터가 있을경우
		if(userid){

			$.ajax({

				url: "http://localhost/todo/index.php/board/check_duplicate",
				type: "POST",
				dataType: "json",
				data:{
					"userid_value":userid
				},

				success:function(data){

					if(data==0){
						alert('사용가능한 아이디입니다!');
					}

					else{
						alert('중복아이디입니다.다른아이디 사용 부탁드립니다!');
					}

				}
			});

		}

		//사용자아이디폼에 데이터가 없을경우
		else{
			alert("아이디를 입력해주세요!");
		}

	}

</script>

<script>

	function password_equal_check(){

		var password1=document.getElementById('password1').value;
		var password2=document.getElementById('password2').value;

		if(password1!=password2){

			document.getElementById('password1').value="";
			document.getElementById('password2').value="";
			//alert("1번째 비빌번호랑 확인 비빌번호랑 동일해야합니다!");

			setTimeout(function(){
				alert("비빌번호랑 확인비빌번호랑 같아야합니다!");
			}, 100)

		}

		//사용자가 입력한 비빌번호 2개가 같은경우
		else{
			alert("패스워드체크 성공!");
		}


	}
</script>


<a href="/todo/index.php/board/lists"><h1>메인 페이지</h1></a>
<h1>회원가입</h1>

<div class="container">
	<form class="form-horizontal" method="post" action="/todo/index.php/board/register_user" id="write_action">
		<fieldset>

			<div class="control-group">

				<p style="color: red">사용가능한 아이디를 입력하시고 첫번째 비빌번호랑 확이비빌번호랑 동일하게 입력 부탁드립니다!</p>

				<label class="control-label" for="input01">사용자 아이디</label>
				<div class="controls">
					<input type="text" class="input-xlarge" id="user_id" name="userid">
					<button style="margin-bottom: 1em" type="button" id="ID_DUPLICATE" onclick="checkid()">ID 중복확인</button>
				</div>

				<label class="control-label" for="input02">사용자 이름</label>
				<div class="controls">
					<input type="text" class="input-xlarge" id="input02" name="username">
					<p class="help-block"></p>
				</div>

				<label class="control-label" for="input02">비빌번호</label>
				<div class="controls">
					<input type="password" class="input-xlarge" id="password1" name="password">
					<p class="help-block"></p>
				</div>

				<label class="control-label" for="input02">비빌번호 확인</label>
				<div class="controls">
					<input type="password" class="input-xlarge" id="password2" name="password2">
					<button style="margin-bottom: 1em" type="button" id="password-check" onclick="password_equal_check()">패스워드 체크</button>
				</div>

				<div class="form-actions">
					<input type="submit" class="btn btn-primary" id="register" value="회원가입">
				</div>

			</div>

		</fieldset>
	</form>
</div>
