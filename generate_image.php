<?php
// var_dump($_POST);
$default_positive = "(masterpiece, best quality:1.3), ";
$default_positive_end = ", very intricate details, highly detailed, 4k, 8k, octane render, global illumination, rtx, bloom, shaders";
$default_negative = "nsfw, (worst quality, low quality:2), monochrome, zombie,overexposure, watermark,text,bad anatomy,bad hand,extra hands,extra fingers,too many fingers,fused fingers,bad arm, distorted fingers, distorted arm,extra arms,fused arms,extra legs,missing leg,disembodied leg,extra nipples, detached arm, liquid hand,inverted hand,disembodied limb, oversized head,extra body, extra navel, (hair between eyes),sketch, duplicate, ugly, huge eyes, text, logo, worst face, (bad and mutated hands:1.3),  (blurry:2.0), horror, geometry, bad_prompt, (bad hands), (missing fingers), multiple limbs, bad anatomy, (interlocked fingers:1.2), Ugly Fingers, (extra digit and hands and fingers and legs and arms:1.4), ((2girl)), (deformed fingers:1.2), (long fingers:1.2),(bad-artist-anime), bad-artist, bad hand, extra legs ,(ng_deepnegative_v1_75t)";
$data = array(
    'prompt' => $default_positive . $_POST['prompt'] . $default_positive_end,
    'negative_prompt' => $default_negative . $_POST['negative_prompt'],
    'steps' => 20,
    'seed' => 1809503255,

);
$payload = json_encode($data);
// echo $payload;
$ch = curl_init('http://127.0.0.1:7860/sdapi/v1/txt2img');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);



$response = curl_exec($ch);
curl_close($ch);
$r = json_decode($response, true);
foreach ($r['images'] as $img) {
    $img = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $img));
    $path = 'tmp/' . uniqid("IMG-", true).'.png';
    file_put_contents($path, $img);
    header("Location: $path");
}