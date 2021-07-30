<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Auth_m extends CI_Model{

	function __construct(){
		parent::__construct();
	}

	//로그인할때 사용한 아이디,비빌번호가 회원가입한 아이디인지 체크하기

	function login($auth){
		//$auth='username':사용자아이디 데이터, 'password': 비빌번호 데이터를 가진 어레이

		//sql query를 담은 변수
		//user table의  username(column)이 사용자아이디 데이터랑 같고 password(column)이 비빌번호 데이터랑 같은 row를 username,password column아래 보여주는 쿼리
		$sql="SELECT username,password FROM user WHERE username = '" . $auth['username'] . "' AND password = '" . $auth['password'] . "' ";

		//user table에서 username이 사용자아이디 데이터랑 같고 password가 비빌번호 데이터랑 같으면 row를 추줄하는 쿼리 실행
		$query=$this->db->query($sql);

		//회원가입한 사용자아이디, 패스워드이면
		if($query->num_rows()>0){
			return $query->row();
		}

		//회원가입하지않은 아이디, 패스워드면
		else{
			return False;
		}


	}

	
	

}
