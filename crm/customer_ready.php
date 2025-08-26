<?php
        //effacer les var d'une eventuelle session précédente
        AfwSession::resetSession();
        AfwSession::setCustomer($custObj->getId());
         
        $customer_default_page = $login_page_options["customer_default_page"];
        if(!$customer_default_page)  $customer_default_page = "customer_index.php";
         
        header("Location: ".$customer_default_page);
?>