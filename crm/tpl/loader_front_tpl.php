<div id="exec_result_div"></div>
<script type="text/javascript">
        $(document).ready(function() {       
                $("#save_form").click(function(){
                        $(".alert-dismissable").fadeOut().remove();
                        $("#exec_result_div").html('<div class="footer1 hzm-relative-loader-div" id="mySQLloader"><div class="relative hzm-loading-div" id="myloading">الرجاء الانتظار جارٍ معالجة الطلب                   </div></div>');
                });
        });
</script>