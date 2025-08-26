<?php
    $li_channels = "";
    $use_crm_channels = AfwSession::config("use_crm_channels",true);
    if($use_crm_channels)
    {
        $channelList = CrmChannel::loadAll();
        foreach($channelList as $channelItem)
        {
            $li_desc = "<span class='channel_title'>".$channelItem->getVal("name_ar")." : </span><div class='channel_desc'>".$channelItem->getVal("desc_ar")."</div>";
            $li_channels .= "<li> $li_desc </li>\n";
        }
    }
?>

<div class="modal-dialog popup-content">
        <div class="modal-content content-annonce">
        <?php
        if(!$hide_desc_app)
        {
        ?>
        عميلنا العزيز عن طريق منصة خدمة العملاء الإصدار الجديد يمكنكم :
        <ul>
            <li>1. طرح استفساراتكم واقتراحاتكم</li>
            <li>2. إصدار الشكاوي</li>
            <li>3. إرسال طلبات الدعم الفني</li>
            <li>4. متابعة حالة طلباتكم أولا بأول</li>
            <li>5. تقييم الخدمة المقدمة لكم</li>
            <li>6. التعقيب على الطلبات في حالة عدم الرضا</li>            
        </ul>
        <?php
        }
        $show_channels = AfwSession::config("show_channels",true);
        if($li_channels and $show_channels)
        {
        ?>
        <br>
        كما يمكنكم ارسال اقتراحاتكم وملاحظاتكم عن طريق القنوات التالية
        <ul>
            <?php echo $li_channels; ?>                        
        </ul>

        <?php
        }
        ?>
        </div>
</div>