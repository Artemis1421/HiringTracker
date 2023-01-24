<?php 
    require "../PHPmailer/PHPMailerAutoload.php";
    try {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host='smtp.gmail.com';
        $mail->Port=587;
        $mail->SMTPAuth=true;
        $mail->SMTPSecure='tls';

        //vygbzsykwwgetqce
        $mail->Username='payreto.hiring.tracker@gmail.com';
        $mail->Password='vygbzsykwwgetqce';

        //Recipients
        $mail->setFrom('payreto.hiring.tracker@gmail.com', 'Payreto | Hiring Tracker | Score Candidate');
        $mail->addAddress($email);

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'Hiring Tracker | Score Candidate';
        $mail->Body    = '
                <tbody>
                <tr>
                    <td style="background:none 50% 50%/cover no-repeat transparent;border-top:0px;border-bottom:0px;padding-top:0px;padding-bottom:0px" valign="top">
                        <table style="border-collapse:collapse;min-width:100%" width="100%" cellspacing="0" cellpadding="0" border="0">
                            <tbody>
                                <tr>
                                    <td style="padding:9px" valign="top">
                                        <table style="border-collapse:collapse;min-width:100%" width="100%" cellspacing="0" cellpadding="0" border="0" align="left">
                                            <tbody>
                                                <tr>
                                                    <td style="padding:0px 9px;text-align:center" valign="top"><img alt="" src="https://imgur.com/oHRlOQ8.png" style="border:0px;height:auto;outline:none;vertical-align:bottom;max-width:600px;padding-bottom:0px;display:inline" class="CToWUd" width="564" align="middle"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table style="border-collapse:collapse;min-width:100%;table-layout:fixed" width="100%" cellspacing="0" cellpadding="0" border="0">
                            <tbody>
                                <tr>
                                    <td style="min-width:100%;padding:18px">
                                        <table style="border-collapse:collapse;min-width:100%;border-top:2px solid rgb(234,234,234)" width="100%" cellspacing="0" cellpadding="0" border="0">
                                            <tbody>
                                                <tr>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table style="border-collapse:collapse;min-width:100%" width="100%" cellspacing="0" cellpadding="0" border="0">
                            <tbody>
                                <tr>
                                    <td style="padding:0px" valign="top">
                                        <table style="border-collapse:collapse;min-width:100%" width="100%" cellspacing="0" cellpadding="0" border="0" align="left">
                                            <tbody>
                                                <tr>
                                                    <td style="padding:0px;text-align:center" valign="top"><img alt="" src="https://imgur.com/HPN3lRC.png" outline:none;border:0px;vertical-align:bottom;max-width:900px;padding-bottom:0px;border-radius:0%;display:inline" class="CToWUd a6T" tabindex="0" width="600" height="400" align="middle">
                                                        <div class="a6S" dir="ltr" style="opacity: 0.01; left: 1934.65px; top: 448.567px;">
                                                            <div id=":5d" class="T-I J-J5-Ji aQv T-I-ax7 L3 a5q" role="button" tabindex="0" aria-label="Download attachment " data-tooltip-class="a1V" data-tooltip="Download">
                                                                <div class="akn">
                                                                    <div class="aSK J-J5-Ji aYr"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table style="border-collapse:collapse;min-width:100%;table-layout:fixed" width="100%" cellspacing="0" cellpadding="0" border="0">
                            <tbody>
                                <tr>
                                    <td style="min-width:100%;padding:9px 18px 0px">
                                        <table style="border-collapse:collapse;min-width:100%" width="100%" cellspacing="0" cellpadding="0" border="0">
                                            <tbody>
                                                <tr>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table style="border-collapse:collapse;min-width:100%" width="100%" cellspacing="0" cellpadding="0" border="0">
                            <tbody>
                                <tr>
                                    <td style="padding-top:9px" valign="top">
                                        <table style="border-collapse:collapse;max-width:100%;min-width:100%" width="100%" cellspacing="0" cellpadding="0" border="0" align="left">
                                            <tbody>
                                                <tr>
                                                    <td style="font-family:Helvetica;word-break:break-word;color:rgb(117,117,117);font-size:16px;line-height:24px;padding:0px 18px 9px" valign="top">
                                                        <p style="margin:10px 0px;padding:0px;line-height:24px"><span style="font-size:18px"><span style="font-family:tahoma,verdana,segoe,sans-serif"><strong>Hi '.$name.'</strong></span></span><strong style="font-family:tahoma,verdana,segoe,sans-serif;font-size:18px;background-color:transparent">,</strong></p>
                                                        <p style="margin:10px 0px;padding:0px;line-height:24px"><span style="font-size:18px"><span style="font-family:tahoma,verdana,segoe,sans-serif"><strong>&nbsp;</strong>
                                                                            <br>This is an automated email to provide you the Interview Feedback Form you would use for your interview.<br>&nbsp;
                                                                            <br>To start using the system, please click this&nbsp;<a href="   https://maldives-cm-promised-zealand.trycloudflare.com/HiringTracker/interviewFeedbackForm/iff.php?id='.$c_id.'&interviewer_id='.$i_id.'&score_candidate=1&phase='.$i_phase.'" target="_blank">link</a>&nbsp;to gain&nbsp;access&nbsp;or use the button below:</span></span><br></p>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table style="border-collapse:collapse;min-width:100%" width="100%" cellspacing="0" cellpadding="0" border="0">
                            <tbody>
                                <tr>
                                    <td valign="top">
                                        <table style="border-collapse:collapse;min-width:100%" width="100%" cellspacing="0" cellpadding="0" border="0" align="left">
                                            <tbody>
                                                <tr>
                                                    <td style="padding:9px 18px">
                                                        <table style="border-collapse:collapse;background-color:rgb(3,17,102);min-width:100%" width="100%" cellspacing="0" border="0">
                                                            
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table style="border-collapse:collapse;min-width:100%" width="100%" cellspacing="0" cellpadding="0" border="0">
                            <tbody>
                                <tr>
                                    <td style="padding:0px 18px 18px" valign="top" align="center">
                                        <table style="border:2px solid rgb(3,17,102);border-radius:17px" width="100%" cellspacing="0" cellpadding="0" border="0">
                                            <tbody>
                                                <tr>
                                                    <td style="font-family:Helvetica;font-size:18px;padding:18px" valign="middle" align="center"><a title="Click Here" href=" https://maldives-cm-promised-zealand.trycloudflare.com/HiringTracker/interviewFeedbackForm/iff.php?id='.$c_id.'&interviewer_id='.$i_id.'&score_candidate=1&phase='.$i_phase.'" style="color:rgb(3,17,102);display:block;font-weight:bold;line-height:18px;text-decoration-line:none" target="_blank">Click here to score your candidate</a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table style="border-collapse:collapse;min-width:100%;table-layout:fixed" width="100%" cellspacing="0" cellpadding="0" border="0">
                            <tbody>
                                <tr>
                                    <td style="min-width:100%;padding:9px 18px">
                                        <table style="border-collapse:collapse;min-width:100%;border-top:1px solid rgb(224,224,224)" width="100%" cellspacing="0" cellpadding="0" border="0">
                                            <tbody>
                                                <tr>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table style="border-collapse:collapse;min-width:100%" width="100%" cellspacing="0" cellpadding="0" border="0">
                            <tbody>
                                <tr>
                                    <td style="padding-top:9px" valign="top">
                                        <table style="border-collapse:collapse;max-width:100%;min-width:100%" width="100%" cellspacing="0" cellpadding="0" border="0" align="left">
                                            <tbody>
                                                <tr>
                                                    <td style="font-family:Helvetica;word-break:break-word;color:rgb(117,117,117);font-size:16px;line-height:24px;padding:0px 18px 9px" valign="top">
                                                        <h3 style="margin:0px;padding:0px;color:rgb(68,68,68);font-size:22px;line-height:33px"><span style="color:rgb(117,117,117);font-size:16px;background-color:transparent;font-weight:normal">In the event that you need a password reset or should you have any concerns, do not hesitate to send an email to&nbsp;</span><a href="mailto:payreto.hiring.tracker@payreto.com" style="color:rgb(0,124,137);font-size:16px;background-color:transparent;font-weight:normal" target="_blank">payreto.hiring.tracker@gmail.com</a><span style="color:rgb(117,117,117);font-size:16px;background-color:transparent;font-weight:normal">&nbsp;or use the <a href="https://google.com" target="_blank" data-saferedirecturl="https://google.com">forgot password</a> and an OTP will be sent to you via email.</span><br></h3>
                                                        <div>&nbsp;</div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>

            <table style="color:rgb(0,0,0);font-family:Roboto,RobotoDraft,Helvetica,Arial,sans-serif;font-size:medium;border-collapse:collapse;min-width:100%" width="100%" cellspacing="0" cellpadding="0" border="0">
            <tbody>
                <tr>
                    <td style="padding:9px" valign="top" align="center">
                        <table style="border-collapse:collapse;min-width:100%" width="100%" cellspacing="0" cellpadding="0" border="0">
                            <tbody>
                                <tr>
                                    <td style="padding-left:9px;padding-right:9px" align="center">
                                        <table style="border-collapse:collapse;min-width:100%;background-color:rgb(104,106,113)" width="100%" cellspacing="0" cellpadding="0" border="0">
                                            <tbody>
                                                <tr>
                                                    <td style="padding-top:9px;padding-right:9px;padding-left:9px" valign="top" align="center">
                                                        <table style="border-collapse:collapse" cellspacing="0" cellpadding="0" border="0" align="center">
                                                            <tbody>
                                                                <tr>
                                                                    <td valign="top" align="center">
                                                                        <table style="border-collapse:collapse;display:inline" cellspacing="0" cellpadding="0" border="0" align="left">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td style="padding-right:10px;padding-bottom:9px" valign="top">
                                                                                        <table style="border-collapse:collapse" width="100%" cellspacing="0" cellpadding="0" border="0">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td style="padding:5px 10px 5px 9px" valign="middle" align="left">
                                                                                                        <table style="border-collapse:collapse" width="" cellspacing="0" cellpadding="0" border="0" align="left">
                                                                                                            <tbody>
                                                                                                                <tr>
                                                                                                                    <td width="24" valign="middle" align="center"><a href="facebook.com/payretoph" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://us1.admin.mailchimp.com/templates/facebook.com/payretoph&amp;source=gmail&amp;ust=1656749777475000&amp;usg=AOvVaw2IjktP3HhEPu-q6Jo3iPwe"><img src="https://ci6.googleusercontent.com/proxy/iZE-48sXvszGHh6MUoqCYHnlP8ohfGJI6V1fj23YRaJHEaKjOb2V7stez03tl97kcCY9ebD52HlFfqGKcTQbPlQaysAL26ZKjUSa5NGX7CU3WUodCbzb-vFMkIXxvIREY4PT879oIw=s0-d-e1-ft#https://cdn-images.mailchimp.com/icons/social-block-v2/outline-light-facebook-48.png" alt="Facebook" style="border:0px;height:auto;outline:none;text-decoration-line:none;display:block" class="CToWUd" width="24" height="24"></a></td>
                                                                                                                </tr>
                                                                                                            </tbody>
                                                                                                        </table>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                        <table style="border-collapse:collapse;display:inline" cellspacing="0" cellpadding="0" border="0" align="left">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td style="padding-right:10px;padding-bottom:9px" valign="top">
                                                                                        <table style="border-collapse:collapse" width="100%" cellspacing="0" cellpadding="0" border="0">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td style="padding:5px 10px 5px 9px" valign="middle" align="left">
                                                                                                        <table style="border-collapse:collapse" width="" cellspacing="0" cellpadding="0" border="0" align="left">
                                                                                                            <tbody>
                                                                                                                <tr>
                                                                                                                    <td width="24" valign="middle" align="center"><a href="https://www.linkedin.com/company/payretoph/" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://www.linkedin.com/company/payretoph/&amp;source=gmail&amp;ust=1656749777475000&amp;usg=AOvVaw3aZamGH-zuyX2zVfIBcFi7"><img src="https://ci3.googleusercontent.com/proxy/FpKC1aFcvfDPI1MS2LGUKplthRlZAG8WmLpjZYlZ2DOVuaiIilo4gVSFwe9gvUOVkuK6WMw2dqEuxy4pfw2A5qShDQXqB56JtSw0EIbTBKiBrCFwkmwFDV8Q4ZB70NkcRlkMJuf5cw=s0-d-e1-ft#https://cdn-images.mailchimp.com/icons/social-block-v2/outline-light-linkedin-48.png" alt="LinkedIn" style="border:0px;height:auto;outline:none;text-decoration-line:none;display:block" class="CToWUd" width="24" height="24"></a></td>
                                                                                                                </tr>
                                                                                                            </tbody>
                                                                                                        </table>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                        <table style="border-collapse:collapse;display:inline" cellspacing="0" cellpadding="0" border="0" align="left">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td style="padding-right:0px;padding-bottom:9px" valign="top">
                                                                                        <table style="border-collapse:collapse" width="100%" cellspacing="0" cellpadding="0" border="0">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td style="padding:5px 10px 5px 9px" valign="middle" align="left">
                                                                                                        <table style="border-collapse:collapse" width="" cellspacing="0" cellpadding="0" border="0" align="left">
                                                                                                            <tbody>
                                                                                                                <tr>
                                                                                                                    <td width="24" valign="middle" align="center"><a href="https://www.payreto.com/" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://www.payreto.com/&amp;source=gmail&amp;ust=1656749777475000&amp;usg=AOvVaw3Ui2U51YmbuIaLDiE9SdhN"><img src="https://ci6.googleusercontent.com/proxy/uZ0yuxmORppOSAVlAI9An9dTGgd5WLSQ0CBL7MLu_J4uk8Z1QO7RWFmdlkUYkmd_GLhwph5RoVCp9eKrXzEQnDQ91cNlGygasb_4p2fT-TnBvWoJAX8mqJXeyuG36Kto6QrY=s0-d-e1-ft#https://cdn-images.mailchimp.com/icons/social-block-v2/outline-light-link-48.png" alt="Website" style="border:0px;height:auto;outline:none;text-decoration-line:none;display:block" class="CToWUd" width="24" height="24"></a></td>
                                                                                                                </tr>
                                                                                                            </tbody>
                                                                                                        </table>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
        <table style="color:rgb(0,0,0);font-family:Roboto,RobotoDraft,Helvetica,Arial,sans-serif;font-size:medium;border-collapse:collapse;min-width:100%;table-layout:fixed" width="100%" cellspacing="0" cellpadding="0" border="0">
            <tbody>
                <tr>
                    <td style="min-width:100%;padding:5px 18px">
                        <table style="border-collapse:collapse;min-width:100%;border-top:2px solid rgb(234,234,234)" width="100%" cellspacing="0" cellpadding="0" border="0">
                            <tbody>
                                <tr>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
        <table style="color:rgb(0,0,0);font-family:Roboto,RobotoDraft,Helvetica,Arial,sans-serif;font-size:medium;border-collapse:collapse;min-width:100%" width="100%" cellspacing="0" cellpadding="0" border="0">
            <tbody>
                <tr>
                    <td valign="top">
                        <table style="border-collapse:collapse;min-width:100%" width="100%" cellspacing="0" cellpadding="0" border="0" align="left">
                            <tbody>
                                <tr>
                                    <td style="padding:9px 18px">
                                        <table style="border-collapse:collapse;background-color:rgb(104,106,113);min-width:100%" width="100%" cellspacing="0" border="0">
                                            <tbody>
                                                <tr>
                                                    <td style="font-family:Helvetica;word-break:break-word;color:rgb(242,242,242);font-size:14px;line-height:21px;text-align:center;padding:18px" valign="top">
                                                        <p dir="ltr" style="margin:10px 0px;padding:0px;line-height:21px">Copyright &#169; 2022 Payreto Services, Inc. All Rights Reserved.</p><br><br><strong>Our mailing address is:</strong><br>Penthouse A&amp;D, Valero Tower<br>122 Valero St, Salcedo Village<br>Makati City 1227, Philippines
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
        ';
        $mail->send();
    } catch (Exception $e) {
        $_SESSION['status_listOfCandidates'] = "Error! Something went wrong";
        $_SESSION['status_code'] = "error";
        header("location: listOfCandidates.php");
    }
?>