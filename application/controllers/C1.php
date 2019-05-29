<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C1 extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct(){
		parent::__construct();

		echo "construct";
		$this->load->model('m1');
	}

	public function index()
	{
		$m1=$this->m1->alluser()->result();
		$data=array(
			'd1'=>'data 1',
			'd2'=>'data 2',
			'd3'=>'data 3',
			'd4'=>'data 4',
			'd5'=>'data 5',
			'm1'=>$m1,
		);
		$this->load->view('v1',$data);
	}

	public function csv1(){
		// get data 
		$jurusan = $this->m1->getJurusan()->result();

		$n=1;
		foreach($jurusan as $j){
			// file name 
			// if($n<11){
			if($n==1){
				$n++;
				continue;
			}
			
			// exit();

			// header("Content-Description: File Transfer"); 
			// header("Content-Disposition: attachment; filename=$filename"); 
			// header("Content-Type: application/csv; ");
			$nama=$j->nama_jurusan;
			$matkul = $this->m1->getMatakul($nama)->result_array();
			$nama=$n."-".$j->nama_jurusan;
			echo $nama."\n";
			$filename = $nama.'.csv'; 
			echo "to ".$filename."\n";
			// var_dump($matkul);
			// exit();
		 
			// file creation 
			// $file = fopen('php://output', 'w');
			$file = fopen('./csv/'.$filename, 'w');
		  
			// $header = array("Username","Name","Gender","Email"); 
			$header = array("DOS_NIP" , "nidn_nupn" , "nik" , "namadosen" , "nama_jurusan" , 
			"prodihomebase" , "jenjang" , "rombel" , "nama_mtk" , "sks_mtk" , "jmlmenit" , "Hari" , "jammulai"); 
			fputcsv($file, $header,";");
			
			$x=1;
			$nama_mtk="";
			$x2=1;
			foreach ($matkul as $key=>$line){
				
				if($x==1){
					
				}else{
					$b1=$nama_mtk==$line['nama_mtk'];
					if($b1){
						$x2++;
					}else{
						$x2=1;
					}
				}
				$nama_mtk=$line['nama_mtk'];
				$line['rombel']=$x2;
				// exit();
				// echo $line['jammulai'];
				
				$line['jammulai']= str_replace('.',':',$line['jammulai']);
				// echo $line['Hari'];
				switch($line['Hari']){
					case "Senin":$line['Hari']=1;break;
					case "Selasa":$line['Hari']=2;break;
					case "Rabu":$line['Hari']=3;break;
					case "Kamis":$line['Hari']=4;break;
					case "Jumat":$line['Hari']=5;break;
					default:$line['Hari']=1;break;
				}
				// var_dump($line);

				// exit();
				fputcsv($file,$line,";");
				$x++;
			}
			fclose($file); 
			// exit();
			echo "done<br>";
			$n++;
		}
		exit;
	}
}
