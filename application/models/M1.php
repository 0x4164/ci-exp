<?php
class M1 extends CI_Model{

    public function alluser(){
        $q1="SELECT * from sn_masjid snm
        inner join masjid m on m.id=snm.idmasjid
        inner join taw.users tawu on tawu.user_id=snm.userid";

    $q=$this->db->query($q1);
    return $q;
    }

    public function getJurusan($j=""){
        $q1="SELECT DISTINCT nama_jurusan FROM `matakuliah` WHERE 1 order by nama_jurusan";
        $q=$this->db->query($q1);
        return $q;
    }

    public function getMatakul($j=""){
        
        // $q1="SELECT DOS_NIP , nidn_nupn , nik , namadosen , concat('S1 - ',nama_jurusan) as nama_jurusan , 1 as prodihomebase , 'S1' as jenjang , 1 as rombel , nama_mtk , sks_mtk , 50 as jmlmenit , Hari , substring(range_jam,1,5) as jammulai from matakuliah
        // where nama_jurusan like \"%$j%\" and namadosen like \"%%\" order by namadosen
        // ";
        $q1="SELECT CAST(DOS_NIP as CHAR(50)) , nidn_nupn , CAST(nik as CHAR(50))  , namadosen , concat('S1 - ',nama_jurusan) as nama_jurusan , 1 as prodihomebase , 'S1' as jenjang , 1 as rombel , nama_mtk , sks_mtk , 50 as jmlmenit , Hari , substring(range_jam,1,5) as jammulai from matakuliah
        where nama_jurusan like \"%$j%\" and namadosen like \"%%\" order by nama_mtk
        ";
        $q=$this->db->query($q1);
        // echo $this->db->last_query();
        return $q;
    }
}
?>