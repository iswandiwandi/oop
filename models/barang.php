<?php
class manusia
{
    public $mulut;
    public $nama;
    
    

    // membuat sebuah object di awal dan di dalam class
    function __construct()
    {
        $this->nama = "Iswandi";
    }
        
    

    // method atau kebiasaan
    function berbicara()
    {
        return "Halo teman - teman";
    }
    function panggil_saya()
    {
        return "Halo Nama saya adalah Nama :" . $this->panggil_wandi();
    }
    function panggil_wandi()
    {
        return $this-> nama;
}
//inheritange = inisiasi/membuat object manusia dari class

 $manusia = new manusia();

echo $manusia->berbicara();
echo "<br>" ;
echo $manusia->panggil_saya();
        
    }