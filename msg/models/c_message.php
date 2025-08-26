<?php


class CMessage extends MsgObject
{

    public static $MY_ATABLE_ID = 3601;

    public static $DATABASE = '';

    public static $MODULE = '';

    public static $TABLE        = '';
    public static $DB_STRUCTURE = null;

    public function __construct()
    {
        parent::__construct('c_message', 'id', 'msg');
        MsgCMessageAfwStructure::initInstance($this);

    }

    public static function loadById($id)
    {
        $obj = new CMessage();
        $obj->select_visibilite_horizontale();
        if ($obj->load($id)) {
            return $obj;
        } else {
            return null;
        }

    }

    public static function loadByMainIndex($customer_id, $subject, $create_obj_if_not_found = false)
    {
        $obj = new CMessage();
        if (! $customer_id) {
            $obj->_error('loadByMainIndex : customer_id is mandatory field');
        }

        if (! $subject) {
            $obj->_error('loadByMainIndex : subject is mandatory field');
        }

        $obj->select('customer_id', $customer_id);
        $obj->select('subject', $subject);

        if ($obj->load()) {
            if ($create_obj_if_not_found) {
                $obj->activate();
            }

            return $obj;
        } elseif ($create_obj_if_not_found) {
            $obj->set('customer_id', $customer_id);
            $obj->set('subject', $subject);

            $obj->insert();
            $obj->is_new = true;
            return $obj;
        } else {
            return null;
        }

    }

    public function getDisplay($lang = 'ar')
    {

        $data = [];
        $link = [];

        list($data[0], $link[0]) = $this->displayAttribute('customer_id', false, $lang);
        list($data[1], $link[1]) = $this->displayAttribute('subject', false, $lang);
        // list( $data[ 2 ], $link[ 2 ] ) = $this->displayAttribute( 'mobile', false, $lang );

        // $sms_sent = $this->getVal( 'sms_sent' );

        return implode(' - ', $data);
        // ." sms_sent=$sms_sent"
    }

    protected function getPublicMethods()
    {

        $pbms = [];

        $color    = 'green';
        $title_ar = 'تصحيح صيغة رقم الجوال';

        $pbms['x55f3Y'] = ['METHOD' => 'correctMobile', 'COLOR' => $color, 'LABEL_AR' => $title_ar, 'ADMIN-ONLY' => true, 'BF-ID' => ''];

        $color    = 'yellow';
        $title_ar = 'محاكاة إرسال الرسالة القصيرة';

        $pbms['uvH14Y'] = ['METHOD' => 'simulSMS', 'COLOR' => $color, 'LABEL_AR' => $title_ar, 'ADMIN-ONLY' => true, 'BF-ID' => ''];

        $color    = 'red';
        $title_ar = 'إرسال الرسالة القصيرة';

        $pbms['uvd4fY'] = ['METHOD' => 'sendSMS', 'COLOR' => $color, 'LABEL_AR' => $title_ar, 'ADMIN-ONLY' => true, 'BF-ID' => ''];

        return $pbms;
    }

    public static function textContainToken($text)
    {
        global $any_token;
        $arr_tokens = ['f1', 'f2', 'f3', 'f4', 'f5', 'f6', 'f7', 'f8', 'f9', 'idn', 'first_name', 'last_name', 'unit_type', 'unit_name', 'email', 'mobile'];

        if ($any_token) {
            return (strpos($text, '{') !== false);
        }

        foreach ($arr_tokens as $token) {
            $token_fcl = '{' . $token . '}';
            if (strpos($text, $token_fcl) !== false) {
                return true;
            }

        }

        return false;
    }

    public static function disableAllNotSent()
    {
        $cm = new CMessage();

        $cm->select('sms_sent', 'N');
        $cm->select('email_sent', 'N');
        $cm->select('active', 'Y');

        $cm->set('active', 'N');

        $cm->update(false);
    }

    public function simulSMS($lang = 'ar')
    {
        return $this->sendSMS($lang, true);
    }

    public function sendSMS($lang = 'ar', $simul = false, $application_id = 40)
    {

        $objme = AfwSession::getUserConnected();

        if (! $objme) {
            return ['error : no user responsible for this SMS sending', ''];
        }

        //if ( !$objme->canSendSMS() ) return array( 'not allowed for this user to send SMS', '' );
        $username = $objme->getVal('username');

        $info = '';

        if (! $simul) {
            $mobile = self::formatMobile($this->getVal('mobile'));
        } else {
            $mobile = self::formatMobile($objme->getVal('mobile'));
        }

        $mobile_error = self::mobileError($mobile, $lang);

        if ($mobile_error) {
            return [$mobile_error, '', true];
        }

        if (self::textContainToken($this->getVal('body'))) {
            $body_error = 'body still contain tokens : ' . $this->getVal('body');
        } else {
            $body_error = '';
        }

        if ($body_error) {
            return [$body_error, '', false];
        }

        $file_dir_name = dirname(__FILE__);

        require_once "$file_dir_name/../lib/hzm/sms/hzm.sms.php";
        $body = $this->getVal('body');
        $res  = hzmSMS($mobile, $body, $username, $application_id);

        if ($res->SendSMSResult == 'TRUE') {
            if (! $simul) {
                $file_dir_name = dirname(__FILE__);
                require_once "$file_dir_name/../pag/common_date.php";

                $this->set('sms_sent', 'Y');
                $this->set('sms_sent_date', hijri_current_date());
                $this->commit();
                $info = "REAL SMS sent to $mobile with reponsible user name [$username] " . date('Y-m-d H:i:s');

            } else {
                $info = "SIMUL SMS sent to $mobile with reponsible user name [$username] " . date('Y-m-d H:i:s');
            }

            return ['', $info, false];
        } elseif ($res->SendSMSResult == 'الرسالة مرسلة من قبل') {
            $this->set('sms_sent', 'W');
            $this->set('sms_sent_date', hijri_current_date());
            $this->commit();
            return ['', $res->SendSMSResult, false];
        } else {
            return ["failed to send SMS to $mobile with reponsible user name [$username] " . date('Y-m-d H:i:s') . ' sms server api response : [' . $res->SendSMSResult . ']', '', false];
        }

    }

    public function correctMobile($lang = 'ar')
    {
        $this->set('mobile', self::formatMobile($this->getVal('mobile')));
        $this->commit();

    }

}
