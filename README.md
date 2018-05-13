# Demo_WMS
==============================================

Demo Warehouse Management System

Hier sind alle Daten für den htdocs für XAMPP für ein demo Warehouse Management System.

Folgende Seiten können aufgerufen werden im Webbrowser:

demowms/sqlinterface.php
demowms/transportauftraege.php
demowms/ResetDB.php

Folgende RestAPI Endpoints sind eingetragen:

Spezifisch Für DEMO_WMS:

- 1	GET	demowms/restapi/functions/getLargeLoadCarrierID/sgtin/{sgtin}
- 2	GET	demowms/restapi/functions/getLargeLoadCarrierID/grai/{grai}
- 3	GET	demowms/restapi/functions/storeTo/grai/{grai}/sgln/{sgln}
- 4	GET	demowms/restapi/functions/removeFrom/grai/{grai}/sgln/{sgln}
- 5	GET	demowms/restapi/functions/receivedGoods/grai/{grai}
- 6	GET	demowms/restapi/functions/outgoingGoods/grai/{grai}
- 7	GET	demowms/restapi/functions/requestStorage/grai/{grai}
- 8	GET	demowms/restapi/functions/requestTransport/grai/{grai}
- 9	GET	demowms/restapi/functions/getTrailerAtLoadingLocation/sgln/{sgln}
- 10	GET	demowms/restapi/functions/getTrailerID/sgtin/{sgtin}
- 11	GET	demowms/restapi/functions/getTrailerID/grai/{grai}
- 12	GET	demowms/restapi/functions/getTuggerTrain/grai/{grai}
- 13	GET	demowms/restapi/functions/loadTo/grai/{grai1}/grai/{grai2}
- 14	GET	demowms/restapi/functions/reportTuggerTrainDeparture/giai/{giai}
- 15	GET	demowms/restapi/functions/Storageblocked/sgln/{sgln}
- 16	GET	demowms/restapi/functions/TagIDType/id/{id}
- 17	GET	demowms/restapi/functions/requestTuggerTrainLoading/giai/{giai}

Allgemeine GET POST PUT DELETE request:

- 1	GET	demowms/restapi/allTables
- 2	GET	demowms/restapi/allColumn/{table}
- 3	GET	demowms/restapi/table/{table}
- 4	POST	demowms/restapi/insert/{table}
- 5	PUT	demowms/restapi/update/{table}
- 6	DELETE	demowms/restapi/delete/{table}/{P_OID}

Für POST, PUT hier je ein Beispiel:

POST:
- HEADER: Content-Type: application/json)
- BODY: {"P_OID":"","P_ZEITSTEMPEL":"2018-04-17","P_ANLAGE_DATUM":"2018-04-17","P_LETZTE_AENDERUNG":"2018-04-17","P_NAME":"test2-Testhalle","P_BESCHREIBUNG":"Hier wird getestet","P_BREITE":"80","P_HOEHE":"8.5","P_LAENGE":"100"}

	
PUT: 	
- HEADER: Content-Type: application/json)
- BODY: {"P_OID":"5","P_BREITE":"200","P_HOEHE":"200","P_LAENGE":"2000"}

=========================================

Hinweis zur Installation von XAMPP:

- Download XAMPP
- Installiere XAMPP
- Füge diese Dateien als Demo_WMS Order in den htdocs Ordner
- Gehe zu xampp->apache->conf; öffne httpd-vhosts.conf und füge an der geeigneten Stelle diese Zeilen hinzu:
	<VirtualHost *>
	DocumentRoot "C:/xampp/htdocs/Demo_WMS/public"
	ServerName demowms
	</VirtualHost>
zudem muss diese Zeile einkommentiert sein: NameVirtualHost 127.0.0.1:80

- Gehe zu C:\Windows\System32\drivers\etc, öffne Hostfile als Admin und füge folgenden Zeile am Ende hinzu:
	127.0.0.1 demowms

- Öffne XAMPP Control Panel und starte Apache und MySQL
- Öffne beliebigen Webbrowser und gib demowms/sqlinterface.php ein



