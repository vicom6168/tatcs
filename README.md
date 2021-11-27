# tatcs

(1) Access a variable defined in Controller 
    -controller:
        $data=['name'=>'Vic','title'=>'I LOVE U'];
        $data['title']='FUCK';
        $data['aaa']='VVVVVV';
     -View:
        <?= esc($aaa) ?>
        
 (2) Want to Access Variable defined in Config file
     --<?= config('Pager')->perPage  ?>
     --In the Config file, plea refer to Config/Pager.php
     
(3) <?= base_url()?>
      
