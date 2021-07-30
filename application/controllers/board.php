<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');


class Board extends CI_Controller {

	function __construct() {

		parent::__construct();

		$this->load->database();
		//페이징을 위한 라이브러리
		$this->load->library("pagination");
		$this->load->model('board_m');
		$this->load->helper(array('form','url'));
		$this->load->helper('download');

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


	public function login_lists(){
		$data['list']=$this->board_m->get_list();
		$this->load->view('board/login_list',$data);
	}

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

	//게시글 등록기능
	public function write_post(){

		//print_r($_FILES);
		//exit
		if($_POST){
			
			//png fiile 받기위해서
			$config['allowed_types']='png';
			//upload되서 서버로 전달되는 png파일의 사이즈 제한없음
			$config['max_size']=0;
			//upload되서 서버로 전달되는 png파일의 width(pixels)가 제한이없음
			$config['max_width']=0;
			//upload되서 서버로 전달되는 png파일의 height(pixels)가 제한이없음
			$config['max_height']=0;
			$config['upload_path']='./upload_files/';

			//loading upload library to get png file from client
			$this->load->library('upload',$config);

			//사용자가 클라이언트에서 입력한 데이터
			$user_id=$this->input->post('userid');
			$username=$this->input->post('username');
			$title=$this->input->post('subject');
			$content=$this->input->post('contents');

			//사용자 아이디, 이름, 제목, 내용 값이 다 입력됬을경우
			if($user_id!="" and $username!="" and $title!="" and $content!=""){


				//유저가 고른 png 파일을 upload_files에 업로드
				$this->upload->do_upload('userfile');

				//업로르된 파일의 full 경로를 db에 저장하기

				//data는 업로드된 파일의 정보를 가지고있는 어레이의 이름
				$data=$this->upload->data();
				//업로드된 파일의 풀경로
				$uploadedfile_fullpath=$data['full_path'];

				//사용자아이디,이름, 제목, 내용, 업로드된 파일 경로 정보를 모델에 넘겨주기
				$this->board_m->insert_post($user_id,$username,$title,$content,$uploadedfile_fullpath);

				//다음으로 해야될일: 어떤 href 값(주소를) 줘야지 이미지 파일이 클릭했을떄 보일지 체크하기
				
				//게시판 메인페이지에 파일첨부한 게시글이면 첨부파일 이미지 보여주고
				//첨부파일 이미지 클릭하면 다운로드 되게하기 보여주기

				//로그인상태에서의 메인페이지 보여주기(로그아웃 버튼)
				redirect("/board/login_lists");

			}

			//사용자아이디,이름, 제목, 내용이 채워지지 않은경우
			else{
				$this->load->view("board/write_fail");
			}


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

		//첫번쨰 패스워드랑 2번쨰 패스워드랑 동일하고 사용자아이디가 중복안되고 사용자아이디값이 입력되고 사용자이름이 입력되고 비빌번호 값이 입력되고 비빌번호 확인값이 입력되는 경우
		if($user_id!="" and $name!="" and $password!="" and $password2!="" and $password==$password2 and $count==0){
			//사용자 아이디, 사용자 이름, 비빌번호 user table에 저장하기
			$this->board_m->insert_user($user_id,$name,$password);
			redirect("/board/lists");
		}

		else{
			//회원가입페이지 다시 보여주고
			//모든 필드 채우라하고 중복되지않은 아이디랑 비빌번호랑 확일비빌번호랑 같아야된다고 알려주기 사용자한테
			$this->load->view("board/re-register");
		}

	}

	public function show_login(){
		$this->load->view("board/loginpage");
	}

	public function download_file($id){

		$uploadedfile_fullpath=$this->board_m->getuploadedfile_fullpath($id);
		//첨부되서 업로드된 파일을 클라이언트에게 다운로드시킴
		force_download($uploadedfile_fullpath,NULL);

	}

	public function getpostsData(){

		//페이지네이션 라이브러리 로드
		$this->load->library('pagination');

		//확실히는 모르겠음 일단 이대로 두기
		$config['base_url']="/todo/index.php/board/getpostsData/";

		//전체 게시글수
		$config['total_rows']=$this->board_m->record_count();

		//페이지 1개에 보여줄 게시글 숫자
		$config['per_page']=10;

		//페이지번호가 위치한 세그먼트
		$config['uri_segment']=3;

		//페이지네이션 초기화
		$this->pagination->initialize($config);

		//data=['pagination':page link]
		$data['pagination']=$this->pagination->create_links();

		//페이지 숫자
		$page=$this->uri->segment(3);

		$data["posts"]=$this->board_m->fetch_posts($config['per_page'],$page);

		$this->load->view("board/pagination",$data);



	}


}



