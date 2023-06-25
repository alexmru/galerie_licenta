<?php
session_start();
var_dump($_POST);

if (isset($_POST['submit']) && isset($_SESSION["username"])) {
    var_dump($_POST['tags']);
    include "../reusable/conectare_bd.php";
    


    $path = '../temp/' . $_POST['path'];
    // Insert into Database
    $type = pathinfo($path, PATHINFO_EXTENSION);
    // echo $type;
    $data = file_get_contents($path);
    $base64 = 'data:image/' . $type . ';base64,' . $data;
    $base64 = base64_encode($data);
    $data = array(
        'image' => $base64,
        'upscaling_resize' => $_POST['resize'],
        'upscaler_1' => '4x_foolhardy_Remacri',
    );
    $payload = json_encode($data);

    $ch = curl_init('http://127.0.0.1:7860/sdapi/v1/extra-single-image');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);


    $response = curl_exec($ch);
    // echo "hgllo";
    curl_close($ch);
    // echo $response;
    $r = json_decode($response, true);
    $img = $r['image'];
    $data = 'data:image/png;base64,AAAFBfj42Pj4';
    list($type, $data) = explode(';', $data);
    list(, $data)      = explode(',', $data);
    $data = base64_decode($data);
    // echo $img;
    $img = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $img));
    $savepath = '../tmp/' . uniqid("IMG-upscale-", true) . '.png';
    file_put_contents($savepath, $img);
    header("Location: $savepath");
} else {
    echo $_SESSION["username"];
    echo "hello";
    // var_dump($_POST['tags']);
    //sleep(5);
    //header("Location: ../index.php");
}
