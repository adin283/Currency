#!/usr/bin/python3
# -*- coding: UTF-8 -*-

import urllib.parse
from urllib import request
import json


class CurrencyExchange:
    api = "https://api.jisuapi.com/exchange/convert"

    def __init__(self, app_key):
        self.app_key = app_key

    def calculate(self, original_currency, destination_currency, input_amount):
        param = {'from': original_currency, 'to': destination_currency, 'appkey': self.app_key, 'amount': input_amount}
        param_string = urllib.parse.urlencode(param)
        url = self.api + "?" + param_string
        with request.urlopen(url) as f:
            data = f.read()
            if f.status == 200:
                content = data.decode('utf-8')
                result = json.loads(content)
                if result['status'] == 0:
                    exchange = result['result']['rate']
                    output_amount = result['result']['camount']
                    subtitle = str(input_amount) + " " + original_currency + " to " + destination_currency + " with exchange rate " + exchange + " = " + str(
                        output_amount)
                    output_dict = {'items': [{'title': output_amount, 'subtitle': subtitle, 'arg': output_amount}]}
                    print(json.dumps(output_dict))
                else:
                    print(str(result['status']) + ':' + result['msg'])
            else:
                print('request fail')