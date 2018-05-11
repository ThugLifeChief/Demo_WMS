INSERT INTO `logistikzentrum`(
    `P_OID`,
    `P_ZEITSTEMPEL`,
    `P_ANLAGE_DATUM`,
    `P_LETZTE_AENDERUNG`,
    `P_BESCHREIBUNG`,
    `P_BREITE`,
    `P_HOEHE`,
    `P_LAENGE`,
    `P_NAME`
)
VALUES(
    NULL,
    CURRENT_DATE(),
    CURRENT_DATE(),
    CURRENT_DATE(),
    'Hier werden experimente Durchgeführt',
    '100,02',
    '7,50',
    '50,60',
    'fml-Versuchshalle'
)
