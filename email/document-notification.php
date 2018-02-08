<?php
// var_dump($_POST);
$root = $_SERVER['DOCUMENT_ROOT'];
require ('PHPMailer/PHPMailerAutoload.php');
date_default_timezone_set('America/Toronto');
require_once($root.'/models/back/Layout_Model.php');
require_once($root.'/views/Layout_View.php');
require_once $root.'/backends/admin-backend.php';
require_once $root.'/Framework/Tools.php';
$model	= new Layout_Model();

$memberId = (int) $_POST['memberId'];

$memberInfo = $model->getMemberByMemberId($memberId);

$from       = 'info@elitemgroup.com';
$fromName   = 'Elite M Group';
$to         = $memberInfo['email_one'];
$replyTo    = 'info@elitemgroup.com';

$mail       = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      

$mail->SMTPDebug  = 0;                     
// 1 = errors and messages
// 2 = messages only
$mail->SMTPAuth  	= true;                  
$mail->SMTPSecure 	= "ssl";                 
$mail->Host       	= "smtp.gmail.com";      
$mail->Port       	= 465;                   
$mail->Username   	= "wtg.sender@gmail.com";  
$mail->Password   	= "cas8867ca";            
$mail->CharSet 		= 'utf-8';
$mail->From 		= $from;
$mail->FromName 	= $fromName;
$mail->addAddress($to, 'Info');     // Add a recipient             // Name is optional
$mail->addReplyTo($replyTo, 'Elite M Group');
$mail->addBCC('raul@wheretogo.com.mx');
$mail->addBCC('info@elitemgroup.com');
$mail->isHTML(true);                                  // Set email format to HTML
$mail->Subject = "Elite M Group Document Notification";

$paymentInfo = $model->getPaymentsByPaymentId($_POST);
var_dump($paymentInfo);

ob_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="format-detection" content="date=no" />
    <meta name="format-detection" content="address=no" />
    <meta name="format-detection" content="email=no" />
    <title>Elite M Group</title>
    <style type="text/css">
      #outlook a {
        padding: 0;
      }
      
      .ReadMsgBody,
      .ExternalClass {
        width: 100%;
      }
      
      .ExternalClass,
      .ExternalClass p,
      .ExternalClass span,
      .ExternalClass font,
      .ExternalClass td,
      .ExternalClass div {
        line-height: 100%;
      }
      
      body,
      table,
      td,
      span,
      a {
        -webkit-text-size-adjust: 100%;
        -ms-text-size-adjust: 100%;
        -webkit-font-smoothing: antialiased;
      }
      
      table,
      td {
        mso-table-lspace: 0pt;
        mso-table-rspace: 0pt;
      }
      
      img {
        -ms-interpolation-mode: bicubic;
      }
      
      html,
      body,
      #wrappertable {
        width: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
        line-height: 100% !important;
      }
      
      img {
        display: block;
        border: none;
        height: auto;
        outline: none !important;
        line-height: 100% !important;
        text-decoration: none !important;
      }
      
      table {
        border-spacing: 0 !important;
        border-collapse: collapse !important;
      }
      
      table td {
        border-collapse: collapse !important;
      }
      
      a,
      a:link,
      a:visited,
      a:focus,
      a:hover {
        color: inherit !important;
        outline: none !important;
        text-decoration: none !important;
      }
      
      @media screen and (-webkit-min-device-pixel-ratio:0) {}
      
      @media only screen and (min-device-width: 768px) and (max-device-width: 1024px) {}
      
      @media screen and (max-device-width: 480px),
      screen and (max-width: 480px) {}
      
      @media (-webkit-min-device-pixel-ratio: 2),
      (min-resolution: 192dpi) {}
      
      @media (-webkit-min-device-pixel-ratio: 1.5),
      (min-resolution: 144dpi) {}
    </style>
    <!--[if IEMobile 7]>
		<style type="text/css">
			
		</style>
	<![endif]-->
    <!--[if gte mso 9]>
		<style type="text/css">
			
		</style>
	<![endif]-->
    <!--[if gte mso 9]>
		<xml>
			<o:OfficeDocumentSettings>
				<o:AllowPNG/>
				<o:PixelsPerInch>96</o:PixelsPerInch>
			</o:OfficeDocumentSettings>
		</xml>
	<![endif]-->
    <style type="text/css">
      [style*="Montserrat"] {
        font-family: 'Montserrat', 'Trebuchet MS', Helvetica, sans-serif !important
      }
      
      @media only screen and (max-width: 599px) {
        div[class="block"] {
          width: 100% !important;
          max-width: none !important;
        }
        table[class="full-width"] {
          width: 100% !important;
        }
        table[class="center"],
        td[class="center"] {
          text-align: center !important;
          float: none !important;
        }
        table[class="remove"] {
          display: none;
        }
        td[class="heading"] {
          font-size: 50px !important;
          line-height: 60px !important;
        }
        td[class="subheading"] {
          font-size: 30px !important;
          line-height: 46px !important;
        }
      }
      
      @media only screen and (max-width: 413px) {
        div[class="block"] {
          width: 100% !important;
          max-width: none !important;
        }
      }
      
      @media only screen and (max-width: 374px) {
        div[class="block"] {
          width: 100% !important;
          max-width: none !important;
        }
        td[class="heading"] {
          font-size: 40px !important;
          line-height: 48px !important;
        }
      }
    </style>
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
  </head>

  <body id="body-layout">
    <table width="100%" border="0" cellpadding="0" cellspacing="0" id="wrappertable" style="table-layout: fixed;">
      <tr>
        <td align="center" valign="top">
          <table cellpadding="0" cellspacing="0" border="0" style="background: #1c1d21;">
            <tr>
              <td width="1000" align="center" valign="top">
                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                  <tr>
                    <td align="center" valign="top">
                      <table width="100%" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                          <td align="center" valign="top" style="padding: 0 20px;">
                            <table cellpadding="0" cellspacing="0" border="0">
                              <tr>
                                <td width="600" align="center" valign="top">
                                  <table width="100%" cellpadding="0" cellspacing="0" border="0" class="remove">
                                    <tr>
                                      <td style="padding-top: 10px; line-height: 0px;"></td>
                                    </tr>
                                  </table>
                                  <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                    <tr>
                                      <td style="padding-top: 20px; line-height: 0px;"></td>
                                    </tr>
                                  </table>
                                  <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                    <tr>
                                      <td align="left" valign="top">
                                        <table cellpadding="0" cellspacing="0" border="0">
                                          <tr>
                                            <td width="460" align="center" valign="top" style="line-height: 0px !important;">
                                              <a style="text-decoration: none; display: block;" href="index.html#" target="_blank"><img src="http://admin.elitemgroup.com/dist/img/logo02.png" alt="" width="40%" style="width: 40%; max-width: 40%;" /></a>
                                            </td>
                                          </tr>
                                        </table>
                                      </td>
                                    </tr>
                                  </table>
                                  <table width="100%" cellpadding="0" cellspacing="0" border="0" class="remove">
                                    <tr>
                                      <td style="padding-top: 5px; line-height: 0px;"></td>
                                    </tr>
                                  </table>
                                  <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                    <tr>
                                      <td style="padding-top: 20px; line-height: 0px;"></td>
                                    </tr>
                                  </table>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
                <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background: #1c1d21;">
                  <tr>
                    <td align="center" valign="top">
                      <table width="100%" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                          <td align="center" valign="top" style="padding: 0 20px;">
                            <table cellpadding="0" cellspacing="0" border="0">
                              <tr>
                                <td width="600" align="center" valign="top">
                                  <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                    <tr>
                                      <td style="padding-top: 5px; line-height: 0px;"></td>
                                    </tr>
                                  </table>
                                  <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                    <tr>
                                      <td align="left" valign="top" style="color: #e2cc0f; font-family: 'Trebuchet MS', Helvetica, sans-serif, 'Montserrat'; font-size: 80px; mso-line-height-rule: exactly; line-height: 96px; font-weight: 700;" class="heading">Elite M Group </td>
                                    </tr>
                                  </table>
                                  <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                    <tr>
                                      <td style="padding-top: 10px; line-height: 0px;"></td>
                                    </tr>
                                  </table>
                                  <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                    <tr>
                                      <td align="left" valign="top" style="color: #ffffff; font-family: 'Trebuchet MS', Helvetica, sans-serif, 'Montserrat'; font-size: 35px; mso-line-height-rule: exactly; line-height: 63px; font-weight: 400;" class="subheading">
                                          Dear <?php echo $memberInfo['name']. ' '.$memberInfo['last_name']; ?>:<br>
                                          </td>
                                    </tr>
                                  </table>
                                  <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                    <tr>
                                      <td style="padding-top: 28px; line-height: 0px;"></td>
                                    </tr>
                                  </table>
                                  <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                    <tr>
                                      <td align="left" valign="top" style="color: #ffffff; font-family: 'Trebuchet MS', Helvetica, sans-serif, 'Montserrat'; font-size: 20px; mso-line-height-rule: exactly; line-height: 34px; font-weight: 400;">
                                        
                                        A new document related to <?php echo $paymentInfo['category'].' / '.$paymentInfo['inventory']; ?> 
                                        has been uploaded.
                                        <br>
                                        <br>
                                          You can access to the system by clicking this link:
                                          <br>

                                          <a href="http://user.elitemgroup.com/" style="color: #e2cc0f!important;">
                                              http://user.elitemgroup.com/
                                          </a>
                                        </td>
                                    </tr>
                                  </table>
                                  <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                    <tr>
                                      <td style="padding-top: 90px; line-height: 0px;"></td>
                                    </tr>
                                  </table>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                  <tr>
                    <td align="center" valign="top">
                      <table width="100%" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                          <td align="center" valign="top" style="padding: 0 20px;">
                            <table cellpadding="0" cellspacing="0" border="0">
                              <tr>
                                <td width="600" align="center" valign="top">
                                  <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                    <tr>
                                      <td style="padding-top: 69px; line-height: 0px;"></td>
                                    </tr>
                                  </table>
                                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                    <tr>
                                      <td align="left" valign="top" style="color: #e2cc0f; font-family: 'Trebuchet MS', Helvetica, sans-serif, 'Montserrat'; font-size: 50px; mso-line-height-rule: exactly; line-height: 96px; font-weight: 700;" class="heading">contacts</td>
                                    </tr>
                                  </table>
                                  <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                    <tr>
                                      <td align="center" valign="top">
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                          <tr>
                                            <td style="padding-top: 25px; line-height: 0px;"></td>
                                          </tr>
                                        </table>
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                          <tr>
                                            <td width="38" align="center" valign="top" style="padding: 15px 0 0 0;">
                                              <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                <tr>
                                                  <td align="right" valign="top" style="line-height: 0px !important;"><img src="http://admin.elitemgroup.com/dist/img/icon-location.png" alt="" width="38" /></td>
                                                </tr>
                                              </table>
                                            </td>
                                            <td align="center" valign="top" style="padding: 0 0 0 27px;">
                                              <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                <tr>
                                                  <td align="left" valign="top" style="color: #e2cc0f; font-family: 'Trebuchet MS', Helvetica, sans-serif, 'Montserrat'; font-size: 35px; mso-line-height-rule: exactly; line-height: 63px; font-weight: 400;"
                                                  class="subheading">Address:</td>
                                                </tr>
                                              </table>
                                            </td>
                                          </tr>
                                        </table>
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                          <tr>
                                            <td style="padding-top: 9px; line-height: 0px;"></td>
                                          </tr>
                                        </table>
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                          <tr>
                                            <td align="left" valign="top" style="color: #999999; font-family: 'Trebuchet MS', Helvetica, sans-serif, 'Montserrat'; font-size: 20px; mso-line-height-rule: exactly; line-height: 34px; font-weight: 400;">4578 Marmora Road, Glasgow D04 89GR</td>
                                          </tr>
                                        </table>
                                      </td>
                                    </tr>
                                  </table>
                                  <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                    <tr>
                                      <td align="center" valign="top">
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                          <tr>
                                            <td style="padding-top: 25px; line-height: 0px;"></td>
                                          </tr>
                                        </table>
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                          <tr>
                                            <td width="38" align="center" valign="top" style="padding: 15px 0 0 0;">
                                              <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                <tr>
                                                  <td align="right" valign="top" style="line-height: 0px !important;"><img src="http://admin.elitemgroup.com/dist/img/icon-phone.png" alt="" width="38" /></td>
                                                </tr>
                                              </table>
                                            </td>
                                            <td align="center" valign="top" style="padding: 0 0 0 27px;">
                                              <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                <tr>
                                                  <td align="left" valign="top" style="color: #e2cc0f; font-family: 'Trebuchet MS', Helvetica, sans-serif, 'Montserrat'; font-size: 35px; mso-line-height-rule: exactly; line-height: 63px; font-weight: 400;"
                                                  class="subheading">Phones:</td>
                                                </tr>
                                              </table>
                                            </td>
                                          </tr>
                                        </table>
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                          <tr>
                                            <td style="padding-top: 9px; line-height: 0px;"></td>
                                          </tr>
                                        </table>
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                          <tr>
                                            <td align="left" valign="top" style="color: #999999; font-family: 'Trebuchet MS', Helvetica, sans-serif, 'Montserrat'; font-size: 20px; mso-line-height-rule: exactly; line-height: 34px; font-weight: 400;">800-2345-6789; 800-2345-6790</td>
                                          </tr>
                                        </table>
                                      </td>
                                    </tr>
                                  </table>
                                  <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                    <tr>
                                      <td align="center" valign="top">
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                          <tr>
                                            <td style="padding-top: 25px; line-height: 0px;"></td>
                                          </tr>
                                        </table>
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                          <tr>
                                            <td width="38" align="center" valign="top" style="padding: 15px 0 0 0;">
                                              <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                <tr>
                                                  <td align="right" valign="top" style="line-height: 0px !important;"><img src="http://admin.elitemgroup.com/dist/img/icon-time.png" alt="" width="38" /></td>
                                                </tr>
                                              </table>
                                            </td>
                                            <td align="center" valign="top" style="padding: 0 0 0 27px;">
                                              <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                <tr>
                                                  <td align="left" valign="top" style="color: #e2cc0f; font-family: 'Trebuchet MS', Helvetica, sans-serif, 'Montserrat'; font-size: 35px; mso-line-height-rule: exactly; line-height: 63px; font-weight: 400;"
                                                  class="subheading">Hours:</td>
                                                </tr>
                                              </table>
                                            </td>
                                          </tr>
                                        </table>
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                          <tr>
                                            <td style="padding-top: 9px; line-height: 0px;"></td>
                                          </tr>
                                        </table>
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                          <tr>
                                            <td align="left" valign="top" style="color: #999999; font-family: 'Trebuchet MS', Helvetica, sans-serif, 'Montserrat'; font-size: 20px; mso-line-height-rule: exactly; line-height: 34px; font-weight: 400;">7 days a week from 8:00 am to 7:00 pm</td>
                                          </tr>
                                        </table>
                                      </td>
                                    </tr>
                                  </table>
                                  <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                    <tr>
                                      <td style="padding-top: 52px; line-height: 0px;"></td>
                                    </tr>
                                  </table>
                                  <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                    <tr>
                                      <td align="left" valign="top">
                                        <table cellpadding="0" cellspacing="0" border="0">
                                          <tr>
                                            <td align="center" valign="top" style="line-height: 0px !important;">
                                              <a style="text-decoration: none; display: inline-block;" href="index.html#" target="_blank"><img src="http://admin.elitemgroup.com/dist/img//socials01.png" alt="" width="76" /></a>
                                            </td>
                                            <td align="center" valign="top" style="line-height: 0px !important; padding: 0 0 0 20px;">
                                              <a style="text-decoration: none; display: inline-block;" href="index.html#" target="_blank"><img src="http://admin.elitemgroup.com/dist/img//socials02.png" alt="" width="76" /></a>
                                            </td>
                                            <td align="center" valign="top" style="line-height: 0px !important; padding: 0 0 0 20px;">
                                              <a style="text-decoration: none; display: inline-block;" href="index.html#" target="_blank"><img src="http://admin.elitemgroup.com/dist/img//socials03.png" alt="" width="76" /></a>
                                            </td>
                                          </tr>
                                        </table>
                                      </td>
                                    </tr>
                                  </table>
                                  <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                    <tr>
                                      <td style="padding-top: 52px; line-height: 0px;"></td>
                                    </tr>
                                  </table>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
                <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background: #e2cc0f;">
                  <tr>
                    <td align="center" valign="top">
                      <table width="100%" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                          <td align="center" valign="top" style="padding: 0 20px;">
                            <table cellpadding="0" cellspacing="0" border="0">
                              <tr>
                                <td width="600" align="center" valign="top">
                                  <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                    <tr>
                                      <td style="padding-top: 91px; line-height: 0px;"></td>
                                    </tr>
                                  </table>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </body>

</html>


<?php
$body = ob_get_contents();
ob_end_clean();

$mail->Body    = $body;

// echo $body;

if (!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 1;
}