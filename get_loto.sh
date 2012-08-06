#!/bin/bash

curl --data "_search=false&nd=1344212404272&rows=280&page=1&sidx=lotoID&sord=desc"   "http://www.leidsa.com/administrator/sorteo_adm/data.php?tiposorteo=20&bnum=%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20&bfecha=&bsorteo=&btipo=" | python -mjson.tool

read -p "Press enter to quit, dude"
echo " Press enter to quit, dude"