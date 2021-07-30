<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Board_m extends CI_Model{

	function __construct(){
		parent::__construct();
	}

	function get_list(){

		$sql="SELECT * FROM ci_board";
		$query=$this->db->query($sql);
		$result=$query->result();
		return $result;

	}

	function insert_post($user_id,$username,$title,$content,$uploadedfile_fullpath){

		date_default_timezone_set('Asia/Tokyo');
		$sql="INSERT INTO ci_board(user_id,user_name,subject,contents,reg_date,file_path) VALUES ('" . $user_id ."','" . $username ."','" . $title ."','" . $content ."','" . date('Y-m-d H:i:s') ."','" . $uploadedfile_fullpath ."')";
		$query=$this->db->query($sql);

	}

	function retrieve($board_id){

		$sql="select * from ci_board where board_id=".$board_id;
		$query=$this->db->query($sql);
		$result=$query->result();
		return $result;

	}

	function checkid_duplicate($user_id){

		$sql="select * from user where username = ?";
		$query=$this->db->query($sql,array($user_id));
		return $query->num_rows();

	}

	function insert_user($user_id,$name,$password){
		$sql="INSERT INTO user(username,name,password) VALUES ('". $user_id ."','". $name ."','". $password ."')";
		$query=$this->db->query($sql);
	}

	function getuploadedfile_fullpath($id){

		$sql="select file_path from ci_board where board_id=".$id;
		$query=$this->db->query($sql);
		$uploadedfile_path=$query->result();
		return $uploadedfile_path[0]->file_path;

	}

	function record_count(){
		//returns the number(intger) of rows in ci_board(table)
		return $this->db->count_all("ci_board");
	}

	function fetch_posts($limit,$start){

		$this->db->limit($limit,($start-1)*10);
		$query=$this->db->get("ci_board");
		return $query->result();

//
//		if($query->num_rows()>0){
//
//			foreach($query->result() as $row){
//				$data[]=$row;
//			}
//			//쿼리된 데이터 반환
//			return $data;
//		}
//
//		//쿼리된 데이터가 없으면 false 반환
//		return false;

	}


}


