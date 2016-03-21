<?php
    /*
    **友好日期格式化
    */
    function friendlyDate($sTime, $type = 'normal')
    {
        //sTime=源时间，cTime=当前时间，dTime=时间差
        $cTime = time();
        $dTime = $cTime - $sTime;
        //$dDay = intval(date("z", $cTime)) - intval(date("z", $sTime));
        $dDay = intval($dTime / 3600 / 24);
        $dYear = intval(date("Y", $cTime)) - intval(date("Y", $sTime));
        //normal：n秒前，n分钟前，n小时前，日期
        if ($type == 'normal') {
            if ($dTime < 60) {
                return $dTime . "秒前";
            } elseif ($dTime < 3600) {
                return intval($dTime / 60) . "分钟前";
                //今天的数据.年份相同.日期相同.
            } elseif ($dYear == 0 && $dDay == 0) {
                //return intval($dTime/3600)."小时前";
                return '今天' . date('H:i', $sTime);
            } elseif ($dYear == 0) {
                return date("m月d日 H:i", $sTime);
            } else {
                return date("Y-m-d H:i", $sTime);
            }
        } elseif ($type == 'mohu') {
            if ($dTime < 60) {
                return $dTime . "秒前";
            } elseif ($dTime < 3600) {
                return intval($dTime / 60) . "分钟前";
            } elseif ($dTime >= 3600 && $dDay == 0) {
                return intval($dTime / 3600) . "小时前";
            } elseif ($dDay > 0 && $dDay <= 7) {
                return intval($dDay) . "天前";
            } elseif ($dDay > 7 && $dDay <= 30) {
                return intval($dDay / 7) . '周前';
            } elseif ($dDay > 30) {
                return intval($dDay / 30) . '个月前';
            }
            //full: Y-m-d , H:i:s
        } elseif ($type == 'full') {
            return date("Y-m-d , H:i:s", $sTime);
        } elseif ($type == 'ymd') {
            return date("Y-m-d", $sTime);
        } else {
            if ($dTime < 60) {
                return $dTime . "秒前";
            } elseif ($dTime < 3600) {
                return intval($dTime / 60) . "分钟前";
            } elseif ($dTime >= 3600 && $dDay == 0) {
                return intval($dTime / 3600) . "小时前";
            } elseif ($dYear == 0) {
                return date("Y-m-d H:i:s", $sTime);
            } else {
                return date("Y-m-d H:i:s", $sTime);
            }
        }
    }

    /*
    ** 发送邮件
    */
    function send_email( $to, $name, $subject = '', $body = '', $attachment = null ) {

        vendor( 'phpmailer.PHPMailerAutoload' );
       
        $mail = new PHPMailer();
        $mail->CharSet = "utf-8";
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';

        $mail->Host       = C('smtp_host');
        $mail->Port       = C('smtp_port');
        $mail->Username   = C('smtp_user');
        $mail->Password   = C('smtp_pwd');
        $mail->SetFrom( C('from_email'), C('from_name'));

        $mail->isHTML( true );
        $mail->Subject    = $subject;
        $mail->MsgHTML( $body );
        $mail->AddAddress( $to, $name );
        //var_dump($mail);
        if ( is_array( $attachment ) ) {
            foreach ( $attachment as $file ) {
                is_file( $file ) && $mail->AddAttachment( $file );
            }
        }
        return $mail->Send() ? true : $mail->ErrorInfo;
    }

    function getIP() {
        if (getenv('HTTP_CLIENT_IP')) {
            $ip = getenv('HTTP_CLIENT_IP');
        }
        elseif (getenv('HTTP_X_FORWARDED_FOR')) {
            $ip = getenv('HTTP_X_FORWARDED_FOR');
        }
        elseif (getenv('HTTP_X_FORWARDED')) {
            $ip = getenv('HTTP_X_FORWARDED');
        }
        elseif (getenv('HTTP_FORWARDED_FOR')) {
            $ip = getenv('HTTP_FORWARDED_FOR');

        }
        elseif (getenv('HTTP_FORWARDED')) {
            $ip = getenv('HTTP_FORWARDED');
        }
        else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    } 
?>