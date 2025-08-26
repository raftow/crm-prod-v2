<?php
        $contextLabel = array("ar"=>"إختيار  النظام","fr"=>"choix du systeme","en"=>"system choice");
        $contextShortLabel = array("ar"=>"ت.م", "fr"=>"a.p","en"=>"p.a"); 
        
             
        $contextList = array();
     
        $mau_list = $objme->get("mau");
        foreach($mau_list as $mau_item)
        {
              if($mau_item->getVal("id_module")>0)
              {
                   $contextList[$mau_item->getVal("id_module")] = $mau_item->get("id_module");
              }
        }
      
        return $contextList;
?>