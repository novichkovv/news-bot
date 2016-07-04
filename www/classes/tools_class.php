<?php
/**
 * Created by PhpStorm.
 * User: enovichkov
 * Date: 26.05.2015
 * Time: 10:10
 */
class tools_class
{
    public static  $months_rus = array(
        '01' => 'Январь',
        '02' => 'Февраль',
        '03' => 'Март',
        '04' => 'Апрель',
        '05' => 'Март',
        '06' => 'Июнь',
        '07' => 'Июль',
        '08' => 'Август',
        '09' => 'Сентябрь',
        '10' => 'Октябрь',
        '11' => 'Ноябрь',
        '12' => 'Декабрь',
    );

    /**
     * @param string $subject
     * @param string $message
     * @param string $to
     * @param string $from
     * @param string string $name
     * @return bool
     * @throws Exception
     * @throws phpmailerException
     */

    public static function mail($subject, $message, $to, $from = 'info@tvoydom-norilsk.ru', $name = 'Client')
    {
        require_once LIBS_DIR.'phpmailer/class.phpmailer.php';
        $mail = new PHPMailer();
        $mail->SetFrom($from, 'qcop.ru');
        $mail->AddAddress($to, $name);
        $mail->Subject = $subject;
        $mail->MsgHTML($message);
        return $mail->Send();
    }

    public static function formatTime($seconds)
    {
        $sec = $seconds % 60;
        $sec = $sec < 10 ? '0' . $sec : $sec;
        $seconds = floor($seconds / 60);
        $min = $seconds % 60;
        $min = $min < 10 ? '0' . $min : $min;
        $hours = floor($seconds / 60);
        $hours = $hours < 10 ? '0' . $hours : $hours;
        return $hours . ':' . $min . ':' . $sec;
    }

    public static function checkImgUrl($url)
    {
        $headers = @get_headers($url);
        return strpos($headers[0], '200');
    }

    public function simpleHtml()
    {
    }

    public static function cropContent($html, $length)
    {
        $out = '';
        $arr = preg_split('/(<.+?>|&#?\\w+;)/s', $html, -1, PREG_SPLIT_DELIM_CAPTURE);
        $tagStack = array();

        for($i = 0, $l = 0; $i < count($arr); $i++) {
            if( $i & 1 ) {
                if( substr($arr[$i], 0, 2) == '</' or substr($arr[$i], 0, 2) == '[/') {
                    array_pop($tagStack);
                } elseif( $arr[$i][0] == '&' ) {
                    $l++;
                } elseif( substr($arr[$i], -2) != '/>' or substr($arr[$i], -2) != '/]') {
                    array_push($tagStack, $arr[$i]);
                }

                $out .= $arr[$i];
            } elseif( substr($arr[$i], -2) != '/>' ) {
                if( ($l += strlen($arr[$i])) >= $length ) {
                    $out .= substr($arr[$i], 0, $length - $l + strlen($arr[$i]));
                    break;
                } else {
                    $out .= $arr[$i];
                }
            }
        }
        $x = false;
        while( ($tag = array_pop($tagStack)) !== NULL ) {
            $out .= (!$x ? ' <span class="read_all">read more...</span>' : '') . '</' . strtok(substr($tag, 1), " \t>") . '>';
            $x = true;
        }

        return $out;
    }
}