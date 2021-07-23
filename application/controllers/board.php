<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
/**
 *  게시판 메인 컨트롤러
 */

//Board(class) is inheriting the methods of CI_Controller(parent controller)
class Board extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> database();
		$this -> load -> model('board_m');
		$this -> load -> helper('url');
	}

	/**
	 * 주소에서 메서드가 생략되었을 때 실행되는 기본 메서드
	 * //ex : localhost/todo/index.php/board
	 * index method는 URI의 function 부분이 없으면 LOAD됨
	 */
	public function index(){
		$this->lists();
	}

	/**
	 * _remap function is called if this controller(Board) is called regardless of function being called
	 * _remap function is used to override the function called in the uri
	 */
	//	public function _remap($method) {
	//		// 헤더 include
	//		$this->load->view('header_v');
	//
	//		if (method_exists($this, $method)) {
	//			$this -> {"{$method}"}();
	//		}
	//
	//		// 푸터 include
	//		$this -> load -> view('footer_v');
	//	}

	public function lists(){
		$data['list']=$this->board_m->get_list();
		$this->load->view('board/list_v', $data);
	}

	public function view($board_id){
		$data['post']=$this->board_m->retrieve($board_id);
		$this->load->view("board/view",$data);
	}

	public function write(){
		$this->load->view('write');
	}

	public function write_post(){
		if($_POST){
			$user_id=$this->input->post('userid');
			$username=$this->input->post('username');
			$title=$this->input->post('subject');
			$content=$this->input->post('contents');
			$this->board_m->insert_post($user_id,$username,$title,$content);
			redirect("/board/lists");
		}
	}

	public function show(){
		$this->load->view("board/registerpage");
	}

	public function check_duplicate(){

		$user_id=$this->input->post("userid_value",TRUE);
		$count=$this->board_m->checkid_duplicate($user_id);

		//중복안되는 아이디일 경우
		if($count==0){
			echo 0;
		}

		//중복되는경우
		else{
			echo 1;
		}

	}

	public function register_user(){

		//클라이언트에서 작성한 데이터받기
		//$_POST없어도 클라언트에서 데이터 가져오기 가능
		$user_id=$this->input->post('userid');
		$name=$this->input->post('username');
		$password=$this->input->post('password');
		$password2=$this->input->post('password2');
		$count=$this->board_m->checkid_duplicate($user_id);

		//첫번쨰 패스워드랑 2번쨰 패스워드랑 동일하고 사용자아이디가 중복안되는경우
		if($password==$password2 and $count==0){
			//사용자 아이디, 사용자 이름, 비빌번호 user table에 저장하기
			$this->board_m->insert_user($user_id,$name,$password);
			redirect("/board/lists");
		}

		else{

			//회원가입페이지 다시 보여주고
			// 사용가능한 아이디랑 첫번째 비빌번호랑 확이비빌번호랑 같아야된다고 알려주기
			$this->load->view("board/re-register");

		}


	}

	public function show_login(){
		$this->load->view("board/loginpage");
	}


}



