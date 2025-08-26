<?php
/*
              .رفيق     بعد التحية
        
        رابط الخدمة 
        
        
        طريقة الاستدعاء
        
        < ? xml version="1.0" encoding="utf-8" ? >
        <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
          <soap:Body>
            <SendSMS xmlns="http://serv.tvtc.gov.sa/webservice/">
              <Number>0567941072</Number>
              <Message>test</Message>
              <APPLICATION_ID>40</APPLICATION_ID>
              <PROCESS_ID>1</PROCESS_ID>
              <USER_NAME>a.behary</USER_NAME>
            </SendSMS>
          </soap:Body>
        </soap:Envelope>
        
           
           
           */
           
            $sms_servers_load_balancing_arr = array();
            $sms_servers_load_balancing_arr[] = "192.168.198.56";
            $sms_servers_load_balancing_arr[] = "192.168.198.57";
            $sms_servers_load_balancing_arr[] = "192.168.198.58";
            $sms_servers_load_balancing_arr[] = "192.168.198.59";

           
            //$smsSender_wsdlUrl = 'http://tvtcwstst.tvtc.gov.sa/webservice/TVTCSmsService.asmx?wsdl';
            $smsSender_wsdlUrl = 'http://tvtcws.tvtc.gov.sa/webservice/TVTCSmsService.asmx?wsdl';
            //$smsSender_wsdlUrl = trim(file_get_contents('http://tvtcws.tvtc.gov.sa/webservice/TVTCSmsService.asmx?op='.$method));
            $sms_username = "tvtc-crm-2factor"; 