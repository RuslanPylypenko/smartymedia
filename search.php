<?php

if(isset($_POST['search'])){
    $rules = $_POST['search'];
    if(!$rules) return;

    $query = '';

    foreach ($rules as $rule){
        $value = (int)$rule['value'];
        $query .= $rule['field'] . $rule['operator'] . $value . '+';
    }
    $query = rtrim($query, '+');


    $result= searchRepo($query);
    echo json_encode($result);
}



function searchRepo($query)
{
    if( $curl = curl_init() ) {
        curl_setopt($curl, CURLOPT_URL, 'https://api.github.com/search/repositories?q='.$query);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        $out = curl_exec($curl);
        curl_close($curl);
        return json_decode($out);
    }
    return false;
}