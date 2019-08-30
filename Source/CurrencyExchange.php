<?php

class CurrencyExchange
{
    // Please fill in appkey here.
    private $_appKey = "appkey";
    private $_api = "http://op.juhe.cn/onebox/exchange/currency";

    function caculate($from, $to, $amount)
    {
        header('Content-type:text/html;charset=utf-8');

        $params = array(
            "from" => $from,
            "to" => $to,
            "key" => $this->_appKey,
        );
        $paramstring = http_build_query($params);
        $content = $this->juhecurl($this->_api, $paramstring);
        $result = json_decode($content, true);
        if ($result) {
            if ($result['error_code'] == '0') {
                $exchange = $result["result"][0]["exchange"];
                $output = $exchange * $amount;

                $json = [
                    "items" => [
                        [
                            "title" => $output,
                            "subtitle" => $from . " / " . $to . " = " . $output,
                            "arg" => $output
                        ]
                    ]
                ];
                echo json_encode($json);

            } else {
                echo $result['error_code'] . ":" . $result['reason'];
            }
        } else {
            echo "请求失败";
        }
    }

    function juhecurl($url, $params = false, $ispost = 0)
    {
        $httpInfo = array();
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'JuheData');
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        if ($ispost) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            curl_setopt($ch, CURLOPT_URL, $url);
        } else {
            if ($params) {
                curl_setopt($ch, CURLOPT_URL, $url . '?' . $params);
            } else {
                curl_setopt($ch, CURLOPT_URL, $url);
            }
        }
        $response = curl_exec($ch);
        if ($response === FALSE) {
            return false;
        }
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $httpInfo = array_merge($httpInfo, curl_getinfo($ch));
        curl_close($ch);
        return $response;
    }
}

//$currencyExchange = new CurrencyExchange();
//$currencyExchange->caculate("USD", "CNY", 1000);