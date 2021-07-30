<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Auth extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('auth_m');
		$this->load->helper('form');
		//this line of code is need to use redirect function
		$this->load->helper('url');
	}

	//로그인 기능
	public function login()
	{

		//form_validatoin library load함
		$this->load->library('form_validation');
		//사용자아이디폼이 데이터로 채워져야한다고 지정하기
		$this->form_validation->set_rules('userid', '사용자아이디', 'required');
		//비빌번호폼이 데이터로 채워져야한다고 지정하기
		$this->form_validation->set_rules('password', '사용자 패스워드', 'required');

		//사용자 아이디폼이랑 비빌번호 폼에 둘다 데이터가 있을경우
		if ($this->form_validation->run()){

			//auth_data는 'username': 사용자아이디 데이터, 'password': 비빌번호 데이터를 가진 key-value array
			$auth_data = array(
				'username' => $this->input->post('userid', TRUE),
				'password' => $this->input->post('password', TRUE)
			);

			//auth_m 파일의 로그인 함수에 'username':사용자 아이디 데이터, 'password': 비빌번호 데이터를 가진 어레이를 인자로 넘겨주고
			//auth_m파일의 로그인 함수가 반환하는 값을 result variable에 저장하기
			$result = $this->auth_m->login($auth_data);

			//로그인시 타입한 사용자아이디, 패스워드가 회원가입한 정보일때
			//세션데이터 추가해주고
			//대신 게시판 메인페이지 보여주기
			if ($result){

				$newdata =array(
					//db에 있는 데이터(회원가입해서 생김)
					'username' => $result->username,
					//db에 있는 마찬가지로(회원가입해서 생김)
					'password' => $result->password,
					'logged_in' => TRUE
				);

				//세션에 데이터 추가하기
				$this->session->set_userdata($newdata);

				//게시판 메인페이지 보여주기 로그아웃 버튼포함해서
				redirect("/board/login_lists");


			} //사용자아이디, 패스워드가 회원가입한 정보가 아닐경우
			else {
				$this->load->view('auth/falseinfo');
			}

		}

		//사용자 아이디 폼 데이터랑 패스워드 폼 데이터가 둘다 채워지는 경우가 아닌경우
		else {
			$this->load->view('auth/login_v');
		}


	}

	public function logout(){
		//세션에있는 데이터 삭제
		//세션에있는 데이터는 $this->sessoin->sert_userdata($newdata)에 의해서 생김
		$this->session->sess_destroy();
		redirect("/board/lists");
	}


}
