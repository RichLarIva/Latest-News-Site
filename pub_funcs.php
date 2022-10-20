<?php
function getNews($cat){
    $curl = curl_init();
    //$loc="uk";
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://newsdata.io/api/1/news?apikey=APIKEY&language=en&category=$cat",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache"
      ),
    ));
    
    $response = curl_exec($curl);
    $err = curl_error($curl);
    
    curl_close($curl);
    $json = json_decode($response, true);
    for($i = 0; $i < 10; $i++)
    {
        $res = $json["results"][$i];
            $title = $res["title"];
            $url = $res["link"];
            if($res["image_url"] === null){
              $img = "<img src='images/logo.svg' alt='MISSING IMAGE' class='articleImg'>";
            }
            else{
              $img = "<img src='".$res["image_url"]."' alt='Article image' class='articleImg'>";
            }
            $desc = $res["description"];
            $category = implode(" ", $res["category"]);
            $div = "<div class='article'><h1>$img<a href='$url'>".$title."</a></h1><hr><br><p>$desc</p><br><p>Categories: $category</p></div>";
            echo $div;
    }
}
?>