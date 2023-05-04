#!/usr/local/bin/python3
# -*- coding: UTF-8 -*-

import sys
import os
from CurrencyExchange import CurrencyExchange

# please config app_key in Workflow Environment Variables
app_key = os.getenv('app_key')
# from currency
original_currency = sys.argv[1]
# to currency
destination_currency = sys.argv[2]
# alfred input amount
input = sys.argv[3].replace(",", "")
query = float(input)

currency_exchange = CurrencyExchange(app_key)
currency_exchange.calculate(original_currency, destination_currency, query)
