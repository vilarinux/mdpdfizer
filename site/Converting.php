<?php
  function convertDoc($url, $data)
  {
    $query = http_build_query($data, '', '&');
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_PORT, 5000);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $query);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
 
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
  }

  function mkCall(){
    $mdSource= $_POST['mdSource'];
    $mdType= $_POST['mdType'];
    $outType= $_POST['outType'];
  
    $API_URL    = "http://192.168.15.114";
    $response   = convertDoc($API_URL,
      array(
        "mdSource"=>$mdSource,
        "mdType"=>$mdType,
        "outType"=>$outType
      ));
    return $response;
  }

  function mkRedirect($response) {
    $response = json_decode($response);
    header("Location: " . $response->outputPath);
    die();
  }
?>