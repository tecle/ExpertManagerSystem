<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class My_mail
{

    var $mail;
    var $to = '996390269@qq.com';
    var $body =" <<<'EOT'ssssssss EOT";
    var $results_messages;
    var $user = 'service@peopleplus.cn';//peopleplus
    var $host = 'smtp.peopleplus.cn';
    var $pw = 'jiuqianzixun11';
    var $name = 'service@peopleplus.cn';
    var $port = "25";
    public function __construct()
    {
        require_once ('PHPMailer/PHPMailer.php');
        $this->mail = new PHPMailer(true);
        $this->mail->CharSet = 'utf-8';
        try {
            $this->mail->IsSMTP();
            $this->mail->SMTPDebug = 0;
            $this->mail->Host = $this->host;//"smtp.163.com";
            $this->mail->Port = $this->port;
            $this->mail->SMTPSecure = "none";
            $this->mail->SMTPAuth = true;
            $this->mail->Username = $this->user;//"jiuqian_test@163.com";
            $this->mail->Password = $this->pw;//"12qwaszx";
            $this->mail->AddReplyTo($this->user,"jiuqian");//
            $this->mail->WordWrap = 80;
        }
        catch (phpmailerAppException $e) {
            $this->results_messages[] = $e->errorMessage();
        }

        
    }
    public function send($head,$ctnt,$atach,$mails){
        $this->mail->From =$this->user;
        $this->mail->FromName = $this->name;
        $this->mail->Subject = $head;
        $this->mail->Body= $ctnt;
        foreach($mails as $k=>$vm){
            if (!PHPMailer::ValidateAddress($this->to)) {
                continue;
            }
            $this->mail->AddAddress($vm);
            
        }
        foreach($atach as $ka=>$va){
                //echo $va."<br />";
                if(file_exists($va))
                    $this->mail->AddAttachment($va);
            }
        $info=array();
        $info[0]="y";
        $info[1]="";
        try {
            $this->mail->Send();
            }
        catch (phpmailerException $e) {
            $info[0]="n";
            $info[1]=$e->getMessage();
        }
        return $info;
    }

    public function test()
    {
        $this->mail->From = "jiuqian_test@163.com";
        $this->mail->FromName = "s";
        $this->mail->AddAddress("996390269@qq.com", "j");
        $this->mail->Subject = "head";
        $this->mail->Body="ctnt";
                    if (!PHPMailer::ValidateAddress($this->to)) {
                throw new phpmailerAppException("Email address " . $this->to .
                    " is invalid -- aborting!");
            }
        try {
                $this->mail->Send();
                $this->results_messages[] = "Message has been sent using SMTP";
            }
            catch (phpmailerException $e) {
                echo 'Unable to send to: ' . $this->to . ': ' . $e->
                    getMessage();
            }
        if (count($this->results_messages) > 0) {
            echo "<h2>Run results</h2>\n";
            echo "<ul>\n";
            foreach ($this->results_messages as $result) {
                echo "<li>$result</li>\n";
            }
            echo "</ul>\n";
        }
    }
}

/* End of file mailer.php */
