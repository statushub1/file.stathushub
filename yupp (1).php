<?php
error_reporting(0);
header("Content-Type: application/x-mpegURL");
$id = $_GET['id'];
$pxy = @$_REQUEST['p'];
$proxy = "";
$json = json_decode(file_get_contents("https://mhdtvworld.live/7star/ytvv.json"), true);

foreach($json["YuppList"] as $v) {
	if($v['id'] == $id) {
		$url = $v['url'];
	if($pxy == "on") {
		$url = $proxy.$v['url'];
	}
	}
}
$burl = str_replace("chunklist.m3u8","",$url);
$options = array(
        'http' => array(
            'header'  => "User-Agent: c2NyaXB0X2J5X0BhcnlhbnJhamVzaCBDb250YWN0IGF0IFRlbGVncmFtICAgICAgICAgICAgICAgICAgICAgICAgICAgVlZqTlZsVk1YVlJibHBYWVRGd2NWUnNWVEZrUmtwellVZDRWRkpVVm1oV2JHaDNZbTFXUjFWcmFHcFNWWEJvVkZWb1UxTkdaSEpoUlU1b1ZqQndXRlV5Y0V0WlZrcEdUbFVZWE5tYzJSbloxbFlUbXRqTWxKNldWZGthazFzU205WmVrcFRZbGRHZEdGSE9XRk5ia0oyVm10YWFrNVZOWFJTYkdoc1UwVTFZVlpZY0c1bFJsSklZMFZLWVUxSVVraFhhMmhEWVZkS1YxTnFTbUZTUlRWUFYycEdVMk14VmxoYVJUVlhVbFZaZUZaR1ZsTmxiRzk0VjFoc2FWTkdXbEJaVjNoR1RURk9WbUZITlU1aGVsWkdXWHBLYTJGdFNuTmhla3BWVFVaS1IxcEdWWGh6WjJka1ozTmtaMUpIUlhsYVJrNU9Za1p3ZUZkV1VrcE9SMUp5VFZoR1VsZEhhRTlWYTFaSFRrWlNWbFZyV21GTlZYQXdXV3RvYzFsV1dYaHpZV1prYzJaamMyWmhjMlpFU21GV1ZUQXdWR3RlGWZUZaRk5VbFplakE5V1ZoT2EyTXlVbnBaVjJScVRXeEtiMWw2U2xOaVYwWjBZVWM1WVUxdVFuWldhMXBxVGxVMWRGSnNhR3hUUlRWaFZsaHdibVZHVSgdUMftiGksfdWtoalJVcGhUVWhTU0ZkcmFFTmhWMHBYVTJwS1lWSkZOVTlYYWtaVFl6RldXRnBGTlZkU1ZWbDRWa1pXVTJWc2IzaFhXR3hwVTBaYVVGbFhlR0Z6Wm5Oa1owWk5NVTVXWVVjMVRtRjZWa1paZWtwcllXMUtjMkZtWVhObVBXRnpabUZ6WjJSbllYTm1jMlJuWjFsWVRtdGpNbEo2V1Zka2FrMXNTbTlaZWtwVFlsZEdkR0ZIT1dGTmJrSjJWbXRhYWs1Vk5YUlNiR2hzVTBVMVlWWlljRzVsUmxKSVkwVktZVTFJVWtoWGEyaERZVmRLVjFOcVNtRlNSVFZQVjJwR1UyTXhWbGhhUlRWWFVsVlplRlpHVmxObGJHOTRWMWhzYVZOR1dsQlpWM2hHVFRGT1ZtRkhOVTVoZWxaR1dYcEthMkZ0U25OaGVrcFZUVVpLUjFwR1ZYaHpaMmRrWjNOa1oxSkhSWGxhUms1T1lrWndlRmRXVWtwT1IxSnlUVmhHVWxkSGFFOVZhMVpIVGtaU1ZsVnJXbUZOVlhBd1dXdG9jMWxXV1hoellXWmtjMlpqYzJaaGMyWkVTbUZXVlRBd1ZHdFZlRlpGTlVsWmVqQTlXVmhPYTJNeVVucFpWMlJxVFd4S2IxbDZTbE5pVjBaMFlVYzVZVTF1UW5aV2ExcHFUbFUxZEZKc2FHeFRSVFZoVmxod2JtVkdVa2hqUlVwaFRVaFNTRmRyYUVOaFYwcFhVMnBLWVZKRk5VOVhha1pUWXpGV1dGcEZOVmRTVlZsNFZrWldVMlZzYjNoWFdHeHBVMFphVUZsWGVHRnpabk5rWjBaTk1VNVdZVWMxVG1GNlZrWlpla3ByWVcxS2MyRm1ZWE5tUFdGelptRnpaMlJu\r\n",
            'method'  => 'GET',
        ),
    );

$context = stream_context_create($options);
$e= @file_get_contents($url,false,$context);
//echo $e;
if($pxy == "on") {
$y = @preg_replace("/(?<=,\n).*ts/", "https://mhdtvworld.live/7star/ts.php?p=on&id=".$id."&ts=".'$0', $e);
$y = @preg_replace('/(?<=URI=").*(?=")/', "https://mhdtvworld.live/7star/key.php?key=".'$0', $y);
} else {
$y = @preg_replace("/(?<=,\n).*ts/", "https://mhdtvworld.live/7star/ts.php?id=".$id."&ts=".'$0', $e);
$y = @preg_replace('/(?<=URI=").*(?=")/', "https://mhdtvworld.live/7star/key.php?key=".'$0', $y);
}

echo $y;