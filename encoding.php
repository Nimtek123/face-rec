<?php

// $orgID = $_POST['org'];
$img = $_POST['img'];
$folder = $_POST['folder'];
$userID = $_POST['userID'];
// $alert_type = $_POST['alert_type'];
// $camera = $_POST['camera'];
// $img_name = $_POST['img_name'];
// $distance = $_POST['distance'];

//$camera_images = "camera_images";

echo "start processing...<br>";

// $data = "camera: $camera - alerttype: $alert_type - date: $date - img: $img org: $orgID";
 
//  $orgHost = '';
//  $orgID = 2;

//     $newdb= new PDO(
//         'mysql:host=localhost;port=3306;dbname=glamanoz_accounts',
//         'glamanoz_account',
//         'golive2019');
     
//     $sql = $newdb->prepare("SELECT * FROM  `ipa_organisations` WHERE `org_id`= :org");
//     $sql->bindValue(":org",$orgID, PDO::PARAM_STR);
//     $sql->execute();
//     $row = $sql->fetch(PDO::FETCH_ASSOC);
    
//    $orgfolder = "ackermans-tembisa";
//     $upload_path = '';
//     if ($sql->rowCount() > 0){
      
//         $dbname = $row['org_db'];
//         $dbuser = $row['org_db_user'];
//         $dbpass = $row['org_db_pass'];
        
//         $orgfolder = $row['org_upload_path'];
//         $orgHost = $row['org_host'];
        
//          $db= new PDO(
//             "mysql:host=localhost;port=3306;dbname=$dbname",
//             "$dbuser",
//             "$dbpass");
//     }
//     echo $orgfolder;
    


$upload_path = "dataset";

if(!is_dir("$upload_path/$folder")) {
    mkdir("$upload_path/$folder", 0777, true);
    chmod("$upload_path/$folder", 0777);
}

  
    if($img != ''){
     
    
        $file = time() . ".jpg";
        
        $img = str_replace(' ', '+', $img);
        
        $decoded=base64_decode($img);
        $success = file_put_contents("$upload_path/$folder/$file", $decoded);

        echo "<br> start processing recognition...<br>";

        ob_start();
        $command = 'python encode_faces.py ' . $folder;
        passthru($command);
        $output = ob_get_clean(); 

        echo "finished processing encoding...<br>";
    

    
       /* $img = str_replace('data:image/jpeg;base64,', '', $img);
        
        $img = str_replace(' ', '+', $img);
        
        $img = base64_decode($img);
        
        $file = "$camera_images/".time() . ".jpeg";
        
        $success = file_put_contents("../$file", $img);
        
        $img = base64_decode($img); 
        
        $source_img = imagecreatefromstring($img);
        
        $rotated_img = imagerotate($source_img, 90, 0); 
        
        
        $imageSave = imagejpeg($rotated_img, $file, 10);
        
        imagedestroy($source_img);
        */
        
        
        // if ($distance < 0.5) $distance = 0.51;
        
    
        // $sql = $db->prepare("INSERT INTO `frc_alerts` (`alt_type`, `alt_camera`,`alt_img`,`alt_date`, `alt_matched`, `alt_score`) VALUES ( :type, :camera,:img,:date, :matched, :score)");
        // $sql->bindValue(":type",$alert_type, PDO::PARAM_STR);
        // $sql->bindValue(":camera",$camera, PDO::PARAM_STR);
        // $sql->bindValue(":img",$file, PDO::PARAM_STR);
        // $sql->bindValue(":date",$date, PDO::PARAM_STR);
        // $sql->bindValue(":matched",$img_name, PDO::PARAM_STR);
        // $sql->bindValue(":score",$distance, PDO::PARAM_STR);
        // $sql->execute();
        
        // $fp = fopen('data.txt', 'w');
        // fwrite($fp, "$orgfolder");
        // fwrite($fp, "$data");
        // fclose($fp);
        
        // if($alert_type == 'r') {
        //     $type = "Repeat Visitor";
        // }
        // if($alert_type == 'v') {
        //     $type = "VIP";
        // }
        // if($alert_type == 's') {
        //     $type = "Suspect";
        // }
        
        
        // $recipient = "rene@glamancorp.com,michael@glamancorp.com,nimrod@glamancorp.com";
        // $subject = "FR Alert";
        // $message = '<p>Suspect Alert</p>
        //             <p>A possible suspect has been detected! </p>
        //             <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
        //             <tr> 
        //                 <th class="text-strong" >Location</td>
        //                 <th class="text-strong" >Live Capture</td>
        //                 <th class="text-strong" >Saved Image</td>
        //                 <th class="text-strong" >Alert Type</th>
        //                 <th class="text-strong" >Source Camera</th>
        //                 <th class="text-strong" >Date</th>
        //                 <th class="text-strong" >Accuracy</th>
        //             </tr>
        //              <tbody >

        //                 <tr>
        //                     <td>'.$orgfolder.'</td>
        //                     <td style="width:30%">
        //                        <img src="https://'.$orgHost.'/.platform/raw_data/'.$orgfolder.'/facial_recognition/'.$file.'" height="100px">
        //                     </td>
        //                      <td style="width:30%">
        //                        <img src="https://'.$orgHost.'/.platform/raw_data/'.$orgfolder.'/facial_recognition/faces/'.$img_name.'.jpg" height="100px">
        //                     </td>
        //                     <td>
        //                     '. $type.'
        //                     </td>
        //                     <td>
        //                         '.$camera.'
        //                     </td>
        //                     <td>
        //                         '.$date.'
        //                     </td>
        //                      <td>
        //                         '. round((0.6 - $distance) * 1000).'
        //                     </td>
        //                 </tr>
        //             </tbody>
        //         </table>';
                
        // $pdf = new PDF();
        // // Column headings
        // $header = array('Location', 'Alert Type', 'Source Camera','Date', 'Confidence');
        // // Data loading
        // //$data = ["Austria","Vienna","83859","8075"];//$pdf->LoadData('Austria;Vienna;83859;8075');
        // $data = [$orgfolder,$type,$camera,$date,round((0.6 - $distance) * 1000)];
        // $pdf->SetFont('Arial','',14);
        // $pdf->AddPage();
        // $pdf->BasicTable($header,$data);
        
        // $pdf->Ln();   
        
        
        // $pdf->Cell(70,6,"Captured Image",1);
        
        // $pdf->Cell(50,6,"Saved Image",1);
        // $pdf->Ln();  
        // $pdf->Image("https://$orgHost/.platform/raw_data/glamanoz/facial_recognition/$file",10,50,0,50,'JPG');
        
        // $pdf->Image("https://$orgHost/.platform/raw_data/glamanoz/facial_recognition/faces/$img_name.jpg",80,50,0,50,'JPG');
        // $pdf->Ln();
                    
        // //$pdf->AddPage();
        // //$pdf->ImprovedTable($header,$data);
        // //$pdf->AddPage();
        // //$pdf->FancyTable($header,$data);
        // $pdfFile = $date = date("Y-m-d_H-i-s").".pdf";
        // $pdf->Output("F","alertDocs/".$pdfFile);
        
        // $message = '<p>Suspect Alert</p>
        //             <p>A possible suspect has been detected! </p>
        //             <p>Please click link below to view details!</p>
        //             <p><a href="https://'.$orgHost.'/facialrecognition/alertDocs/'.$pdfFile.'">View Match Details</a></p>
        //             ';
                
                            
        // dispatchEmail($recipient, $subject, $message);
        
    
        // $params['type'] = $type;
        // error_logging($params);
    }
    


    

        

 function error_logging($params){
        
        
        
        
        $type = $params['type'];
        

        $subject = $type;
        $txt = "$type Notification ";


        //mail($to, $subject, $txt, $headers);

        
        $msg =[];
        
    
            $msg = array
                    (
                      
                        'body' 	=> $txt,
                        'title'		=> $subject,
                        'subtitle'	=> '',
                        'tickerText'=> '',
                        'android'   => array(
                        'vibrate'	=> 1,
                        'sound'		=> 'default',
                        ),
                        'largeIcon'	=> 'large_icon',
                        'smallIcon'	=> 'small_icon'
                         
                    );
       
        // API access key from Google API's Console
        define( 'API_ACCESS_KEY', 'AAAALL0c2-c:APA91bFxYmPKVB59kUCWpSNTDnbfjBiJ5Rpr3GuZ4Hd1poefVTbvLISUR_yhxjx8pGqJA9Y3X5xMlQb-yMY1B16fFpnrefuxfk9f81hh6q4rfGcqPPdEqAorDb4RQRF-q_pDvT-52iTc' );
        //$registrationIds = array('cZ67yt-OQKg:APA91bGXabYSkZDOKDWKqnl909k-MZrmHMsXYDti8_pcKkbGIC-mxKhPfAL9VawVDQY5Fj4ys6Knsar-ZmrZOoojQQuiTJwGW53fL07Y30R2hMDOj9Pht9VOv2GBuxvtS-AdkAQxCRLi');
        // prep the bundle
        
        $fields = array
        (
        	'to' 	=> "/topics/notify",
        	'data'			=> $msg
        );
        
         
        $fcmheaders = array
        (
        	'Authorization: key=' . API_ACCESS_KEY,
        	'Content-Type: application/json',
        	'topic: notify'
        );
        
        
         
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $fcmheaders );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        curl_close( $ch );
        echo $result;

    }
    
    function dispatchEmail($recipient, $subject, $message) {
        try {

            $to = $recipient;

            $messageHtml = '
                            <!doctype html>
                            <html>
                              <head>
                                <meta name="viewport" content="width = device-width" />
                                <meta http-equiv="Content-Type" content="text / html;
                                        charset = UTF-8" />
                                <title>Activate Profile</title>
                                <style>
                                  /* -------------------------------------
                                      GLOBAL RESETS
                                  ------------------------------------- */

                                  /*All the styling goes here*/

                                  img {
                                    border: none;
                                    -ms-interpolation-mode: bicubic;
                                    max-width: 100%; 
                                  }
                                  body {
                                    background-color: #f6f6f6;
                                    font-family: sans-serif;
                                    -webkit-font-smoothing: antialiased;
                                    font-size: 14px;
                                    line-height: 1.4;
                                    margin: 0;
                                    padding: 0;
                                    -ms-text-size-adjust: 100%;
                                    -webkit-text-size-adjust: 100%; 
                                  }
                                  table {
                                    border-collapse: separate;
                                    mso-table-lspace: 0pt;
                                    mso-table-rspace: 0pt;
                                    width: 100%; }
                                    table td {
                                      font-family: sans-serif;
                                      font-size: 14px;
                                      vertical-align: top; 
                                  }
                                  /* -------------------------------------
                                      BODY & CONTAINER
                                  ------------------------------------- */
                                  .body {
                                    background-color: #f6f6f6;
                                    width: 100%; 
                                  }
                                  /* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
                                  .container {
                                    display: block;
                                    margin: 0 auto !important;
                                    /* makes it centered */
                                    max-width: 580px;
                                    padding: 10px;
                                    width: 580px; 
                                  }
                                  /* This should also be a block element, so that it will fill 100% of the .container */
                                  .content {
                                    box-sizing: border-box;
                                    display: block;
                                    margin: 0 auto;
                                    max-width: 580px;
                                    padding: 10px; 
                                  }
                                  /* -------------------------------------
                                      HEADER, FOOTER, MAIN
                                  ------------------------------------- */
                                  .main {
                                    background: #ffffff;
                                    border-radius: 3px;
                                    width: 100%; 
                                  }
                                  .wrapper {
                                    box-sizing: border-box;
                                    padding: 20px; 
                                  }
                                  .content-block {
                                    padding-bottom: 10px;
                                    padding-top: 10px;
                                  }
                                  .footer {
                                    clear: both;
                                    margin-top: 10px;
                                    text-align: center;
                                    width: 100%; 
                                  }
                                    .footer td,
                                    .footer p,
                                    .footer span,
                                    .footer a {
                                      color: #999999;
                                      font-size: 12px;
                                      text-align: center; 
                                  }
                                  /* -------------------------------------
                                      TYPOGRAPHY
                                  ------------------------------------- */
                                  h1,
                                  h2,
                                  h3,
                                  h4 {
                                    color: #000000;
                                    font-family: sans-serif;
                                    font-weight: 400;
                                    line-height: 1.4;
                                    margin: 0;
                                    margin-bottom: 30px; 
                                  }
                                  h1 {
                                    font-size: 35px;
                                    font-weight: 300;
                                    text-align: center;
                                    text-transform: capitalize; 
                                  }
                                  p,
                                  ul,
                                  ol {
                                    font-family: sans-serif;
                                    font-size: 14px;
                                    font-weight: normal;
                                    margin: 0;
                                    margin-bottom: 15px; 
                                  }
                                    p li,
                                    ul li,
                                    ol li {
                                      list-style-position: inside;
                                      margin-left: 5px; 
                                  }
                                  a {
                                    color: #3498db;
                                    text-decoration: underline; 
                                  }
                                  /* -------------------------------------
                                      BUTTONS
                                  ------------------------------------- */
                                  .btn {
                                    box-sizing: border-box;
                                    width: 100%; }
                                    .btn > tbody > tr > td {
                                      padding-bottom: 15px; }
                                    .btn table {
                                      width: auto; 
                                  }
                                    .btn table td {
                                      background-color: #ffffff;
                                      border-radius: 5px;
                                      text-align: center; 
                                  }
                                    .btn a {
                                      background-color: #ffffff;
                                      border: solid 1px #3498db;
                                      border-radius: 5px;
                                      box-sizing: border-box;
                                      color: #3498db;
                                      cursor: pointer;
                                      display: inline-block;
                                      font-size: 14px;
                                      font-weight: bold;
                                      margin: 0;
                                      padding: 12px 25px;
                                      text-decoration: none;
                                      text-transform: capitalize; 
                                  }
                                  .btn-primary table td {
                                    background-color: #3498db; 
                                  }
                                  .btn-primary a {
                                    background-color: #3498db;
                                    border-color: #3498db;
                                    color: #ffffff; 
                                  }
                                  /* -------------------------------------
                                      OTHER STYLES THAT MIGHT BE USEFUL
                                  ------------------------------------- */
                                  .last {
                                    margin-bottom: 0; 
                                  }
                                  .first {
                                    margin-top: 0; 
                                  }
                                  .align-center {
                                    text-align: center; 
                                  }
                                  .align-right {
                                    text-align: right; 
                                  }
                                  .align-left {
                                    text-align: left; 
                                  }
                                  .clear {
                                    clear: both; 
                                  }
                                  .mt0 {
                                    margin-top: 0; 
                                  }
                                  .mb0 {
                                    margin-bottom: 0; 
                                  }
                                  .preheader {
                                    color: transparent;
                                    display: none;
                                    height: 0;
                                    max-height: 0;
                                    max-width: 0;
                                    opacity: 0;
                                    overflow: hidden;
                                    mso-hide: all;
                                    visibility: hidden;
                                    width: 0; 
                                  }
                                  .powered-by a {
                                    text-decoration: none; 
                                  }
                                  hr {
                                    border: 0;
                                    border-bottom: 1px solid #f6f6f6;
                                    margin: 20px 0; 
                                  }
                                  /* -------------------------------------
                                      RESPONSIVE AND MOBILE FRIENDLY STYLES
                                  ------------------------------------- */
                                  @media only screen and (max-width: 620px) {
                                    table[class=body] h1 {
                                      font-size: 28px !important;
                                      margin-bottom: 10px !important; 
                                    }
                                    table[class=body] p,
                                    table[class=body] ul,
                                    table[class=body] ol,
                                    table[class=body] td,
                                    table[class=body] span,
                                    table[class=body] a {
                                      font-size: 16px !important; 
                                    }
                                    table[class=body] .wrapper,
                                    table[class=body] .article {
                                      padding: 10px !important; 
                                    }
                                    table[class=body] .content {
                                      padding: 0 !important; 
                                    }
                                    table[class=body] .container {
                                      padding: 0 !important;
                                      width: 100% !important; 
                                    }
                                    table[class=body] .main {
                                      border-left-width: 0 !important;
                                      border-radius: 0 !important;
                                      border-right-width: 0 !important; 
                                    }
                                    table[class=body] .btn table {
                                      width: 100% !important; 
                                    }
                                    table[class=body] .btn a {
                                      width: 100% !important; 
                                    }
                                    table[class=body] .img-responsive {
                                      height: auto !important;
                                      max-width: 100% !important;
                                      width: auto !important; 
                                    }
                                  }
                                  /* -------------------------------------
                                      PRESERVE THESE STYLES IN THE HEAD
                                  ------------------------------------- */
                                  @media all {
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
                                    .apple-link a {
                                      color: inherit !important;
                                      font-family: inherit !important;
                                      font-size: inherit !important;
                                      font-weight: inherit !important;
                                      line-height: inherit !important;
                                      text-decoration: none !important; 
                                    }
                                    .btn-primary table td:hover {
                                      background-color: #34495e !important; 
                                    }
                                    .btn-primary a:hover {
                                      background-color: #34495e !important;
                                      border-color: #34495e !important; 
                                    } 
                                  }
                                </style>
                              </head>
                              <body class="">
                                <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body">
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td class="container">
                                      <div class="content">

                                        <!-- START CENTERED WHITE CONTAINER -->
                                        <span class="preheader">This is preheader text. Some clients will show this text as a preview.</span>
                                        <table role="presentation" class="main">

                                          <!-- START MAIN CONTENT AREA -->
                                          <tr>
                                            <td class="wrapper">
                                              <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                                                <tr>
                                                  <td>
                                                    
                                                    '.$message.'
                                        <p></p>
                                        </td>
                                        </tr>
                                        </table>
                                        </td>
                                        </tr>

                                        <!--END MAIN CONTENT AREA -->
                                        </table>

                                        <!--START FOOTER -->
                                        <div class = "footer">
                                        <table role = "presentation" border = "0" cellpadding = "0" cellspacing = "0">
                                        <tr>
                                        <td class = "content-block">
                                        <span class = "apple-link">Company Inc, 3 Abbey Road, San Francisco CA 94102</span>
                                              </td>
                                            </tr>
                                            <tr>
                                              <td class="content-block powered-by">
                                                Powered by <a href="http://unified-bi.co.za">UBI</a>.
                                              </td>
                                            </tr>
                                          </table>
                                        </div>
                                        <!-- END FOOTER -->

                                      <!-- END CENTERED WHITE CONTAINER -->
                                      </div>
                                    </td>
                                    <td>&nbsp;</td>
                                  </tr>
                                </table>
                              </body>
                            </html>
                        ';

                        // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            // More headers
            $headers .= 'From: no-reply@glamanoz.com' . "\r\n";
           // $headers .= 'Cc: myboss@example . com  ' . "\r\n";

            mail($to, $subject, $message, $headers);
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }