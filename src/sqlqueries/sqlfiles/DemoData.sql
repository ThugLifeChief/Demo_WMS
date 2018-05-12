
--logistikzentrum--
INSERT INTO `logistikzentrum`( `P_OID`, `P_ZEITSTEMPEL`, `P_ANLAGE_DATUM`, `P_LETZTE_AENDERUNG`, `P_BESCHREIBUNG`, `P_BREITE`, `P_HOEHE`, `P_LAENGE`, `P_NAME`)
VALUES( NULL, CURRENT_DATE(), CURRENT_DATE(), CURRENT_DATE(), 'Hier werden experimente Durchgef�hrt','100,02','7,50','50,60','fml-Versuchshalle');

-- Lagerbereich --
INSERT INTO `lagerbereich` (`P_OID`, `P_ZEITSTEMPEL`, `P_ANLAGE_DATUM`, `P_LETZTE_AENDERUNG`, `P_SGLN_ID`, `P_BARCODE_LAGERBEREICH`, `P_BESCHREIBUNG`, `P_HOEHE`, `P_EINHEIT_HOEHE`, `LOGISTIKZENTRUM_P_OID`)
VALUES (NULL, NULL, NULL, NULL, '1234567890','888888888','Hochregallager','8.5','m','1'),
        (NULL, NULL, NULL, NULL, '0987654321', '777777777','Blocklager', '6.80','m','1');

-- Loading Area --
INSERT INTO `loading_area` (`P_OID`, `P_ZEITSTEMPEL`, `P_ANLAGE_DATUM`, `P_LETZTE_AENDERUNG`, `P_SGLN_ID`, `P_BREITE`, `P_LAENGE`, `LAGERBEREICH_P_OID`)
VALUES (NULL, NULL, NULL, NULL, '6666660', '5.5', '3.7', '1'),
       (NULL, NULL, NULL, NULL, '6666661', '5.5', '3.7', '2');

-- Stellplätze Hochregallager und Blocklager und Loading Area je 3 --
INSERT INTO `stellplatz` (`P_OID`, `P_ZEITSTEMPEL`, `P_ANLAGE_DATUM`, `P_LETZTE_AENDERUNG`, `P_SGLN_ID`, `P_STATUS`, `P_POS_BREITE`, `P_POSITION`, `P_POS_TIEFE`, `P_OBERGRENZE`, `LAGERBEREICH_P_OID`, `LOADING_AREA_P_OID`)
VALUES (NULL, NULL, NULL, NULL, '8801', NULL, '900', '01', '1300', '1300', '1', NULL),
       (NULL, NULL, NULL, NULL, '8802', NULL, '900', '02', '1300', '1300', '1', NULL),
       (NULL, NULL, NULL, NULL, '8803', NULL, '900', '03', '1300', '1300', '1', NULL),
       (NULL, NULL, NULL, NULL, '8804', NULL, '900', '04', '1300', '1300', '1', NULL),
       (NULL, NULL, NULL, NULL, '8805', NULL, '900', '05', '1300', '1300', '1', NULL),
       (NULL, NULL, NULL, NULL, '8806', NULL, '900', '06', '1300', '1300', '1', NULL),
       (NULL, NULL, NULL, NULL, '8807', NULL, '900', '07', '1300', '1300', '1', NULL),
       (NULL, NULL, NULL, NULL, '8808', NULL, '900', '08', '1300', '1300', '1', NULL),
       (NULL, NULL, NULL, NULL, '8809', NULL, '900', '09', '1300', '1300', '1', NULL),
       (NULL, NULL, NULL, NULL, '8800', NULL, '900', '00', '1300', '1300', '1', NULL),

       (NULL, NULL, NULL, NULL, '8901', NULL, '900', '01', '1300', '1300', '2', NULL),
       (NULL, NULL, NULL, NULL, '8902', NULL, '900', '02', '1300', '1300', '2', NULL),
       (NULL, NULL, NULL, NULL, '8903', NULL, '900', '03', '1300', '1300', '2', NULL),
       (NULL, NULL, NULL, NULL, '8904', NULL, '900', '04', '1300', '1300', '2', NULL),
       (NULL, NULL, NULL, NULL, '8905', NULL, '900', '05', '1300', '1300', '2', NULL),
       (NULL, NULL, NULL, NULL, '8906', NULL, '900', '06', '1300', '1300', '2', NULL),
       (NULL, NULL, NULL, NULL, '8907', NULL, '900', '07', '1300', '1300', '2', NULL),
       (NULL, NULL, NULL, NULL, '8908', NULL, '900', '08', '1300', '1300', '2', NULL),
       (NULL, NULL, NULL, NULL, '8909', NULL, '900', '09', '1300', '1300', '2', NULL),
       (NULL, NULL, NULL, NULL, '8900', NULL, '900', '00', '1300', '1300', '2', NULL),

       (NULL, NULL, NULL, NULL, '6601', NULL, '900', '01', '1300', '1300', NULL, '1'),
       (NULL, NULL, NULL, NULL, '6602', NULL, '900', '02', '1300', '1300', NULL, '1'),
       (NULL, NULL, NULL, NULL, '6603', NULL, '900', '03', '1300', '1300', NULL, '1'),

       (NULL, NULL, NULL, NULL, '6601', NULL, '900', '01', '1300', '1300', NULL, '2'),
       (NULL, NULL, NULL, NULL, '6602', NULL, '900', '02', '1300', '1300', NULL, '2'),
       (NULL, NULL, NULL, NULL, '6603', NULL, '900', '03', '1300', '1300', NULL, '2');

-- Stetig Förderer --
INSERT INTO `stetig_foerderer` (`P_OID`, `P_ANLAGE_DATUM`, `P_ZEITSTEMPEL`, `P_LETZTE_AENDERUNG`, `P_LAENGE`, `LAGERBEREICH_P_OID`)
VALUES (NULL, NULL, NULL, NULL, '4.5', '1'),
       (NULL, NULL, NULL, NULL, '4.5', '1');

-- Bestellung --
INSERT INTO `bestellung` (`P_OID`, `P_ZEITSTEMPEL`, `P_ANLAGE_DATUM`, `P_LETZTE_AENDERUNG`, `P_ANLIEFERTAG`, `P_BESTELLNUMMER`, `P_GEPLANTES_LIEFERDATUM`, `P_TEXT`, `LOGISTIKZENTRUM_P_OID`)
VALUES (NULL, NULL, NULL, NULL, '2019-06-14', '33301', '2019-06-14', 'Bestellung 01', '1'),
       (NULL, NULL, NULL, NULL, '2019-06-15', '33302', '2019-06-14', 'Bestellung 02', '1'),
       (NULL, NULL, NULL, NULL, '2019-06-16', '33303', '2019-06-14', 'Bestellung 03', '1'),
       (NULL, NULL, NULL, NULL, '2019-06-17', '33304', '2019-06-14', 'Bestellung 04', '1'),
       (NULL, NULL, NULL, NULL, '2019-06-18', '33305', '2019-06-14', 'Bestellung 05', '1'),
       (NULL, NULL, NULL, NULL, '2019-06-19', '33306', '2019-06-14', 'Bestellung 06', '1'),
       (NULL, NULL, NULL, NULL, '2019-06-20', '33307', '2019-06-14', 'Bestellung 07', '1'),
       (NULL, NULL, NULL, NULL, '2019-06-21', '33308', '2019-06-14', 'Bestellung 08', '1'),
       (NULL, NULL, NULL, NULL, '2019-06-22', '33309', '2019-06-14', 'Bestellung 09', '1'),
       (NULL, NULL, NULL, NULL, '2019-06-23', '33300', '2019-06-14', 'Bestellung 00', '1');

-- Fahrzeugtyp --
INSERT INTO `fahrzeugtyp` (`P_OID`, `P_ZEITSTEMPEL`, `P_ANLAGE_DATUM`, `P_LETZTE_AENDERUNG`, `P_BESCHREIBUNG`, `P_NAME`)
VALUES (NULL, NULL, NULL, NULL, 'Vierradstapler 1.6 - 2.0t; Elektro-Gabelstapler', 'EFG 320'),
       (NULL, NULL, NULL, NULL, 'Standschlepper 5.0t; Elektro-Schlepper', 'EZS 350');

-- Flurfoerdermittel --
INSERT INTO `flurfoerdermittel` (`P_OID`, `P_ZEITSTEMPEL`, `P_ANLAGE_DATUM`, `P_LETZTE_AENDERUNG`, `P_GIAI_ID`, `P_IP_ADRESSE`, `P_MUSS_TLHM_AUFNEHMEN`, `P_BETRIEBSTUNDEN`, `LOGISTIKZENTRUM_P_OID`, `FAHRZEUGTYP_P_OID`)
VALUES (NULL, NULL, NULL, NULL, '2501', '1921680100', '0', '80000', '1', '1'),
       (NULL, NULL, NULL, NULL, '2502', '1921680101', '0', '70000', '1', '1'),

       (NULL, NULL, NULL, NULL, '2503', '1921680103', '1', '40000', '1', '2'),
       (NULL, NULL, NULL, NULL, '2504', '1921680104', '1', '100', '1', '2');

-- Anhaenger --
INSERT INTO `anhaenger` (`P_OID`, `P_NAME`, `P_GRAI_ID`, `P_LANGE`, `P_BREITE`, `FLURFOERDERMITTEL_P_OID`, `STELLPLATZ_P_OID`)
VALUES (NULL, 'E-Frame-Anhänger 0.6 - 1.2t', '4401', '1200', '800', '1', '21'),
       (NULL, 'E-Frame-Anhänger 0.6 - 1.2t', '4402', '1200', '800', '1', '22'),
       (NULL, 'E-Frame-Anhänger 0.6 - 1.2t', '4403', '1200', '800', '1', '23'),
       (NULL, 'E-Frame-Anhänger 0.6 - 1.2t', '4404', '1200', '800', '1', NULL),
       (NULL, 'E-Frame-Anhänger 0.6 - 1.2t', '4405', '1200', '800', '1', NULL),
       (NULL, 'E-Frame-Anhänger 0.6 - 1.2t', '4406', '1200', '800', '1', NULL);

-- Ladehilfsmitteltyp --
INSERT INTO `ladehilfsmitteltyp` (`P_OID`, `P_ZEITSTEMPEL`, `P_ANLAGE_DATUM`, `P_LETZTE_AENDERUNG`, `P_EIGEN_GEWICHT`, `P_OV_TRAGLAST`, `P_POS_BREITE`, `P_POS_TIEFE`, `P_TRAG_LAST`, `P_HOEHE`, `P_GEWICHTS_EINHEIT`, `P_BEZEICHNUNG`, `LHMTYPZUORDUNG_P_OID`)
VALUES (NULL, NULL, NULL, NULL, '24', '2000', '800', '1200', '1000', '144', 'kg', 'largeLoadCarrier', NULL),
       (NULL, NULL, NULL, NULL, '10', '20', '400', '600', '20', '280', 'kg', 'smallLoadCarrier', NULL);

-- Ladehilfsmittel--
INSERT INTO `ladehilfsmittel` (`P_OID`, `P_ZEITSTEMPEL`, `P_ANLAGE_DATUM`, `P_LETZTE_AENDERUNG`, `P_GRAI_ID`, `STETIG_FOERDERER_P_OID`, `ANHAENGER_P_OID`, `FLURFOERDERMITTEL_P_OID`, `TRANSPORTAUFTRAG_P_OID`, `STELLPLATZ_P_OID`, `LADEHILFSMITTEL_P_OID`, `LADEHILFSMITTELTYP_P_OID`)
VALUES (NULL, NULL, NULL, NULL, '1111100', NULL, NULL, NULL, NULL, NULL, NULL, '1');
       (NULL, NULL, NULL, NULL, '1111101', NULL, NULL, NULL, NULL, NULL, NULL, '1'),
       (NULL, NULL, NULL, NULL, '1111102', NULL, NULL, NULL, NULL, NULL, NULL, '1'),
       (NULL, NULL, NULL, NULL, '1111103', NULL, NULL, NULL, NULL, NULL, NULL, '1'),
       (NULL, NULL, NULL, NULL, '1111104', NULL, NULL, NULL, NULL, NULL, NULL, '1'),
       (NULL, NULL, NULL, NULL, '1111105', NULL, NULL, NULL, NULL, NULL, NULL, '1'),
       (NULL, NULL, NULL, NULL, '1111106', NULL, NULL, NULL, NULL, NULL, NULL, '1'),
       (NULL, NULL, NULL, NULL, '1111107', NULL, NULL, NULL, NULL, NULL, NULL, '1'),
       (NULL, NULL, NULL, NULL, '1111108', NULL, NULL, NULL, NULL, NULL, NULL, '1'),
       (NULL, NULL, NULL, NULL, '1111109', NULL, NULL, NULL, NULL, NULL, NULL, '1'),
       (NULL, NULL, NULL, NULL, '1111110', NULL, NULL, NULL, NULL, NULL, '6' , '2'),
       (NULL, NULL, NULL, NULL, '1111111', NULL, NULL, NULL, NULL, NULL, '6' , '2'),
       (NULL, NULL, NULL, NULL, '1111112', NULL, NULL, NULL, NULL, NULL, '7' , '2'),
       (NULL, NULL, NULL, NULL, '1111113', NULL, NULL, NULL, NULL, NULL, '7' , '2'),
       (NULL, NULL, NULL, NULL, '1111114', NULL, NULL, NULL, NULL, NULL, '8' , '2'),
       (NULL, NULL, NULL, NULL, '1111115', NULL, NULL, NULL, NULL, NULL, '8' , '2'),
       (NULL, NULL, NULL, NULL, '1111116', NULL, NULL, NULL, NULL, NULL, '9' , '2'),
       (NULL, NULL, NULL, NULL, '1111117', NULL, NULL, NULL, NULL, NULL, '9' , '2'),
       (NULL, NULL, NULL, NULL, '1111118', NULL, NULL, NULL, NULL, NULL, '10', '2'),
       (NULL, NULL, NULL, NULL, '1111119', NULL, NULL, NULL, NULL, NULL, '10', '2'),
       (NULL, NULL, NULL, NULL, '1111120', NULL, NULL, NULL, NULL, NULL, NULL, '2'),
       (NULL, NULL, NULL, NULL, '1111121', NULL, NULL, NULL, NULL, NULL, NULL, '2'),
       (NULL, NULL, NULL, NULL, '1111122', NULL, NULL, NULL, NULL, NULL, NULL, '2'),
       (NULL, NULL, NULL, NULL, '1111123', NULL, NULL, NULL, NULL, NULL, NULL, '2'),
       (NULL, NULL, NULL, NULL, '1111124', NULL, NULL, NULL, NULL, NULL, NULL, '2'),
       (NULL, NULL, NULL, NULL, '1111125', NULL, NULL, NULL, NULL, NULL, NULL, '2'),
       (NULL, NULL, NULL, NULL, '1111126', NULL, NULL, NULL, NULL, NULL, NULL, '2'),
       (NULL, NULL, NULL, NULL, '1111127', NULL, NULL, NULL, NULL, NULL, NULL, '2'),
       (NULL, NULL, NULL, NULL, '1111128', NULL, NULL, NULL, NULL, NULL, NULL, '2'),
       (NULL, NULL, NULL, NULL, '1111129', NULL, NULL, NULL, NULL, NULL, NULL, '2');

-- WARE --
-- in Bestellungen --
INSERT INTO `ware` (`P_OID`, `P_ZEITSTEMPEL`, `P_ANLAGE_DATUM`, `P_LETZTE_AENDERUNG`, `P_MENGE`, `P_EINHEITMENGE`, `P_EINHEITVOLUMEN`, `P_VOLUMEN`, `P_PACKUNGSGROESSE`, `LOGISTIKZENTRUM_P_OID`, `BESTELLUNG_P_OID`, `LADEHILFSMITTEL_P_OID`)
VALUES (NULL, NULL, NULL, NULL, '200', 'St', 'ml', '500', '15', '1', '1', NULL),
       (NULL, NULL, NULL, NULL, '200', 'St', 'ml', '500', '15', '1', '1', NULL),
       (NULL, NULL, NULL, NULL, '200', 'St', 'ml', '500', '15', '1', '2', NULL),
       (NULL, NULL, NULL, NULL, '200', 'St', 'ml', '500', '15', '1', '2', NULL),
       (NULL, NULL, NULL, NULL, '200', 'St', 'ml', '500', '15', '1', '3', NULL),

-- nur auf Palette --
       (NULL, NULL, NULL, NULL, '200', 'St', 'ml', '500', '15', '1', NULL, '1'),
       (NULL, NULL, NULL, NULL, '200', 'St', 'ml', '500', '15', '1', NULL, '2'),
       (NULL, NULL, NULL, NULL, '200', 'St', 'ml', '500', '15', '1', NULL, '2'),
       (NULL, NULL, NULL, NULL, '200', 'St', 'ml', '500', '15', '1', NULL, '3'),
       (NULL, NULL, NULL, NULL, '200', 'St', 'ml', '500', '15', '1', NULL, '3'),
       (NULL, NULL, NULL, NULL, '200', 'St', 'ml', '500', '15', '1', NULL, '3'),
       (NULL, NULL, NULL, NULL, '200', 'St', 'ml', '500', '15', '1', NULL, '4'),
       (NULL, NULL, NULL, NULL, '200', 'St', 'ml', '500', '15', '1', NULL, '5'),
       (NULL, NULL, NULL, NULL, '200', 'St', 'ml', '500', '15', '1', NULL, '5'),
       (NULL, NULL, NULL, NULL, '200', 'St', 'ml', '500', '15', '1', NULL, '5'),

-- in KLT --
       (NULL, NULL, NULL, NULL, '200', 'St', 'ml', '500', '15', '1', NULL, '11'),
       (NULL, NULL, NULL, NULL, '200', 'St', 'ml', '500', '15', '1', NULL, '12'),
       (NULL, NULL, NULL, NULL, '200', 'St', 'ml', '500', '15', '1', NULL, '13'),
       (NULL, NULL, NULL, NULL, '200', 'St', 'ml', '500', '15', '1', NULL, '14'),
       (NULL, NULL, NULL, NULL, '200', 'St', 'ml', '500', '15', '1', NULL, '15'),
       (NULL, NULL, NULL, NULL, '200', 'St', 'ml', '500', '15', '1', NULL, '16'),
       (NULL, NULL, NULL, NULL, '200', 'St', 'ml', '500', '15', '1', NULL, '17'),
       (NULL, NULL, NULL, NULL, '200', 'St', 'ml', '500', '15', '1', NULL, '18'),
       (NULL, NULL, NULL, NULL, '200', 'St', 'ml', '500', '15', '1', NULL, '19'),
       (NULL, NULL, NULL, NULL, '200', 'St', 'ml', '500', '15', '1', NULL, '20'),
       (NULL, NULL, NULL, NULL, '200', 'St', 'ml', '500', '15', '1', NULL, '21'),
       (NULL, NULL, NULL, NULL, '200', 'St', 'ml', '500', '15', '1', NULL, '22');

-- Artikel --
-- auf Ware 1 --
INSERT INTO `artikel` (`P_OID`, `P_ZEITSTEMPEL`, `P_ANLAGE_DATUM`, `P_LETZTE_AENDERUNG`, `P_SGTIN_ID`, `P_ADDITIONAL_TEXT`, `P_BESCHREIBUNG`, `P_BREITE`, `P_GESAMTMENGE`, `P_HOEHE`, `P_LAENGE`, `P_MAX_TEMPERATUR`, `P_MIN_TEMPERATUR`, `P_STUECKGEWICHT`, `P_STUECKVOLUMEN`, `WARE_P_OID`, `ARTIKELLHMTYP_P_OID`)
VALUES (NULL, NULL, NULL, NULL, '90909001', 'Karton', '8 x 160mm Konstruktionsschrauben TX Senkkopf ', '50', '200', '60', '150', '100', '-50', '0.0001', '0.001', '1', NULL),
       (NULL, NULL, NULL, NULL, '90909002', 'Karton', '8 x 170mm Konstruktionsschrauben TX Senkkopf ', '50', '200', '60', '150', '100', '-50', '0.0001', '0.001', '1', NULL),
       (NULL, NULL, NULL, NULL, '90909003', 'Karton', '8 x 180mm Konstruktionsschrauben TX Senkkopf ', '50', '200', '60', '150', '100', '-50', '0.0001', '0.001', '1', NULL),
       (NULL, NULL, NULL, NULL, '90909004', 'Karton', '8 x 190mm Konstruktionsschrauben TX Senkkopf ', '50', '200', '60', '150', '100', '-50', '0.0001', '0.001', '1', NULL),
       (NULL, NULL, NULL, NULL, '90909005', 'Karton', '8 x 200mm Konstruktionsschrauben TX Senkkopf ', '50', '200', '60', '150', '100', '-50', '0.0001', '0.001', '1', NULL),
       (NULL, NULL, NULL, NULL, '90909006', 'Karton', '8 x 210mm Konstruktionsschrauben TX Senkkopf ', '50', '200', '60', '150', '100', '-50', '0.0001', '0.001', '1', NULL),

-- auf Ware 2 --
       (NULL, NULL, NULL, NULL, '90909011', 'Karton', '8 x 160mm Konstruktionsschrauben TX Senkkopf ', '50', '200', '60', '150', '100', '-50', '0.0001', '0.001', '2', NULL),
       (NULL, NULL, NULL, NULL, '90909012', 'Karton', '8 x 170mm Konstruktionsschrauben TX Senkkopf ', '50', '200', '60', '150', '100', '-50', '0.0001', '0.001', '2', NULL),
       (NULL, NULL, NULL, NULL, '90909013', 'Karton', '8 x 180mm Konstruktionsschrauben TX Senkkopf ', '50', '200', '60', '150', '100', '-50', '0.0001', '0.001', '2', NULL),
       (NULL, NULL, NULL, NULL, '90909014', 'Karton', '8 x 190mm Konstruktionsschrauben TX Senkkopf ', '50', '200', '60', '150', '100', '-50', '0.0001', '0.001', '2', NULL),
       (NULL, NULL, NULL, NULL, '90909015', 'Karton', '8 x 200mm Konstruktionsschrauben TX Senkkopf ', '50', '200', '60', '150', '100', '-50', '0.0001', '0.001', '2', NULL),
       (NULL, NULL, NULL, NULL, '90909016', 'Karton', '8 x 210mm Konstruktionsschrauben TX Senkkopf ', '50', '200', '60', '150', '100', '-50', '0.0001', '0.001', '2', NULL),

-- auf Ware 3 --
       (NULL, NULL, NULL, NULL, '90909021', 'Karton', '8 x 160mm Konstruktionsschrauben TX Senkkopf ', '50', '200', '60', '150', '100', '-50', '0.0001', '0.001', '3', NULL),
       (NULL, NULL, NULL, NULL, '90909022', 'Karton', '8 x 170mm Konstruktionsschrauben TX Senkkopf ', '50', '200', '60', '150', '100', '-50', '0.0001', '0.001', '3', NULL),
       (NULL, NULL, NULL, NULL, '90909023', 'Karton', '8 x 180mm Konstruktionsschrauben TX Senkkopf ', '50', '200', '60', '150', '100', '-50', '0.0001', '0.001', '3', NULL),
       (NULL, NULL, NULL, NULL, '90909024', 'Karton', '8 x 190mm Konstruktionsschrauben TX Senkkopf ', '50', '200', '60', '150', '100', '-50', '0.0001', '0.001', '3', NULL),
       (NULL, NULL, NULL, NULL, '90909025', 'Karton', '8 x 200mm Konstruktionsschrauben TX Senkkopf ', '50', '200', '60', '150', '100', '-50', '0.0001', '0.001', '3', NULL),
       (NULL, NULL, NULL, NULL, '90909026', 'Karton', '8 x 210mm Konstruktionsschrauben TX Senkkopf ', '50', '200', '60', '150', '100', '-50', '0.0001', '0.001', '3', NULL),

-- auf Ware 6 - 15 --
       (NULL, NULL, NULL, NULL, '90909030', 'keine Verpackung', 'Leichtlast-Elektrohängebahn-Antriebe Baureihe HW', '600', '1', '600', '800', '100', '-50', '50', '10', '6', NULL),
       (NULL, NULL, NULL, NULL, '90909031', 'keine Verpackung', 'Leichtlast-Elektrohängebahn-Antriebe Baureihe HW', '600', '1', '600', '800', '100', '-50', '50', '10', '7', NULL),
       (NULL, NULL, NULL, NULL, '90909032', 'keine Verpackung', 'Leichtlast-Elektrohängebahn-Antriebe Baureihe HW', '600', '1', '600', '800', '100', '-50', '50', '10', '8', NULL),
       (NULL, NULL, NULL, NULL, '90909033', 'keine Verpackung', 'Leichtlast-Elektrohängebahn-Antriebe Baureihe HW', '600', '1', '600', '800', '100', '-50', '50', '10', '9', NULL),
       (NULL, NULL, NULL, NULL, '90909034', 'keine Verpackung', 'Leichtlast-Elektrohängebahn-Antriebe Baureihe HW', '600', '1', '600', '800', '100', '-50', '50', '10', '10', NULL),
       (NULL, NULL, NULL, NULL, '90909035', 'keine Verpackung', 'Leichtlast-Elektrohängebahn-Antriebe Baureihe HW', '600', '1', '600', '800', '100', '-50', '50', '10', '11', NULL),
       (NULL, NULL, NULL, NULL, '90909036', 'keine Verpackung', 'Leichtlast-Elektrohängebahn-Antriebe Baureihe HW', '600', '1', '600', '800', '100', '-50', '50', '10', '12', NULL),
       (NULL, NULL, NULL, NULL, '90909037', 'keine Verpackung', 'Leichtlast-Elektrohängebahn-Antriebe Baureihe HW', '600', '1', '600', '800', '100', '-50', '50', '10', '13', NULL),
       (NULL, NULL, NULL, NULL, '90909038', 'keine Verpackung', 'Leichtlast-Elektrohängebahn-Antriebe Baureihe HW', '600', '1', '600', '800', '100', '-50', '50', '10', '14', NULL),
       (NULL, NULL, NULL, NULL, '90909039', 'keine Verpackung', 'Leichtlast-Elektrohängebahn-Antriebe Baureihe HW', '600', '1', '600', '800', '100', '-50', '50', '10', '15', NULL),

-- auf ware 16 - 20 --
       (NULL, NULL, NULL, NULL, '90909041', 'Karton', '8 x 160mm Konstruktionsschrauben TX Senkkopf ', '50', '200', '60', '150', '100', '-50', '0.0001', '0.001', '16', NULL),
       (NULL, NULL, NULL, NULL, '90909042', 'Karton', '8 x 170mm Konstruktionsschrauben TX Senkkopf ', '50', '200', '60', '150', '100', '-50', '0.0001', '0.001', '16', NULL),
       (NULL, NULL, NULL, NULL, '90909043', 'Karton', '8 x 180mm Konstruktionsschrauben TX Senkkopf ', '50', '200', '60', '150', '100', '-50', '0.0001', '0.001', '16', NULL),
       (NULL, NULL, NULL, NULL, '90909044', 'Karton', '8 x 190mm Konstruktionsschrauben TX Senkkopf ', '50', '200', '60', '150', '100', '-50', '0.0001', '0.001', '17', NULL),
       (NULL, NULL, NULL, NULL, '90909045', 'Karton', '8 x 200mm Konstruktionsschrauben TX Senkkopf ', '50', '200', '60', '150', '100', '-50', '0.0001', '0.001', '17', NULL),
       (NULL, NULL, NULL, NULL, '90909046', 'Karton', '8 x 210mm Konstruktionsschrauben TX Senkkopf ', '50', '200', '60', '150', '100', '-50', '0.0001', '0.001', '17', NULL),
       (NULL, NULL, NULL, NULL, '90909051', 'Karton', '8 x 160mm Konstruktionsschrauben TX Senkkopf ', '50', '200', '60', '150', '100', '-50', '0.0001', '0.001', '18', NULL),
       (NULL, NULL, NULL, NULL, '90909052', 'Karton', '8 x 170mm Konstruktionsschrauben TX Senkkopf ', '50', '200', '60', '150', '100', '-50', '0.0001', '0.001', '18', NULL),
       (NULL, NULL, NULL, NULL, '90909053', 'Karton', '8 x 180mm Konstruktionsschrauben TX Senkkopf ', '50', '200', '60', '150', '100', '-50', '0.0001', '0.001', '18', NULL),
       (NULL, NULL, NULL, NULL, '90909054', 'Karton', '8 x 190mm Konstruktionsschrauben TX Senkkopf ', '50', '200', '60', '150', '100', '-50', '0.0001', '0.001', '19', NULL),
       (NULL, NULL, NULL, NULL, '90909055', 'Karton', '8 x 200mm Konstruktionsschrauben TX Senkkopf ', '50', '200', '60', '150', '100', '-50', '0.0001', '0.001', '19', NULL),
       (NULL, NULL, NULL, NULL, '90909056', 'Karton', '8 x 210mm Konstruktionsschrauben TX Senkkopf ', '50', '200', '60', '150', '100', '-50', '0.0001', '0.001', '20', NULL);
