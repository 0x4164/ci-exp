# quick auto generate file

model1="""<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mc extends CI_Model {

	public function create(){

    }
	
    public function get(){
        $str="test succeed";
        return $str;
    }
	
    public function update(){
        
    }
    public function update(){
        
    }
}"""

ctrl1="""<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Mc');
    }

	public function index()
	{
        $data=array();
        $data['data1']=$this->mc->get();
		$this->load->view('welcome_message',$data);
	}
}"""

v1="""

<h1><?php
echo $data1;
?>
</h1>
"""

m=['./application/models/C.php']
c=['./application/controllers/Mc.php']
v=['./application/views/vc.php']

fm = open(m[0],'w')
fm.write(model1)
fm.close()

fc = open(c[0],'w')
fc.write(ctrl1)
fc.close()

fv = open(v[0],'w')
fv.write(v1)
fv.close()