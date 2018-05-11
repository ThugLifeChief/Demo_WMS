<?php

//from db_setup_tables_v4.sql

class db_setup{

  public $db_setup_string = "

  -- MySQL Workbench Forward Engineering

  SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
  SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
  SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

  -- -----------------------------------------------------
  -- Schema DEMOWMS
  -- -----------------------------------------------------

  -- -----------------------------------------------------
  -- Schema DEMOWMS
  -- -----------------------------------------------------
  CREATE SCHEMA IF NOT EXISTS `DEMOWMS` DEFAULT CHARACTER SET utf8 ;
  USE `DEMOWMS` ;

  -- -----------------------------------------------------
  -- Table `DEMOWMS`.`LOGISTIKZENTRUM`
  -- -----------------------------------------------------
  CREATE TABLE IF NOT EXISTS `DEMOWMS`.`LOGISTIKZENTRUM` (
    `P_OID` INT NOT NULL AUTO_INCREMENT,
    `P_ZEITSTEMPEL` DATE NULL,
    `P_ANLAGE_DATUM` DATE NULL,
    `P_LETZTE_AENDERUNG` DATE NULL,
    `P_NAME` VARCHAR(100) NULL,
    `P_BESCHREIBUNG` VARCHAR(100) NULL,
    `P_BREITE` FLOAT NULL,
    `P_HOEHE` FLOAT NULL,
    `P_LAENGE` FLOAT NULL,
    PRIMARY KEY (`P_OID`))
  ENGINE = InnoDB;


  -- -----------------------------------------------------
  -- Table `DEMOWMS`.`LAGERBEREICH`
  -- -----------------------------------------------------
  CREATE TABLE IF NOT EXISTS `DEMOWMS`.`LAGERBEREICH` (
    `P_OID` INT NOT NULL AUTO_INCREMENT,
    `P_ZEITSTEMPEL` DATE NULL,
    `P_ANLAGE_DATUM` DATE NULL,
    `P_LETZTE_AENDERUNG` DATE NULL,
    `P_SGLN_ID` INT NULL,
    `P_BARCODE_LAGERBEREICH` INT NULL,
    `P_BESCHREIBUNG` VARCHAR(100) NULL,
    `P_HOEHE` FLOAT NULL,
    `P_EINHEIT_HOEHE` VARCHAR(45) NULL,
    `LOGISTIKZENTRUM_P_OID` INT NULL,
    PRIMARY KEY (`P_OID`),
    INDEX `fk_LAGERBEREICH_LOGISTIKZENTRUM1_idx` (`LOGISTIKZENTRUM_P_OID` ASC),
    CONSTRAINT `fk_LAGERBEREICH_LOGISTIKZENTRUM1`
      FOREIGN KEY (`LOGISTIKZENTRUM_P_OID`)
      REFERENCES `DEMOWMS`.`LOGISTIKZENTRUM` (`P_OID`)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION)
  ENGINE = InnoDB;


  -- -----------------------------------------------------
  -- Table `DEMOWMS`.`LOADING_AREA`
  -- -----------------------------------------------------
  CREATE TABLE IF NOT EXISTS `DEMOWMS`.`LOADING_AREA` (
    `P_OID` INT NOT NULL AUTO_INCREMENT,
    `P_ZEITSTEMPEL` DATE NULL,
    `P_ANLAGE_DATUM` DATE NULL,
    `P_LETZTE_AENDERUNG` DATE NULL,
    `P_SGLN_ID` INT NULL,
    `P_BREITE` FLOAT NULL,
    `P_LAENGE` FLOAT NULL,
    `LAGERBEREICH_P_OID` INT NULL,
    PRIMARY KEY (`P_OID`),
    INDEX `fk_LOADING_AREA_LAGERBEREICH1_idx` (`LAGERBEREICH_P_OID` ASC),
    CONSTRAINT `fk_LOADING_AREA_LAGERBEREICH1`
      FOREIGN KEY (`LAGERBEREICH_P_OID`)
      REFERENCES `DEMOWMS`.`LAGERBEREICH` (`P_OID`)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION)
  ENGINE = InnoDB;


  -- -----------------------------------------------------
  -- Table `DEMOWMS`.`STELLPLATZ`
  -- -----------------------------------------------------
  CREATE TABLE IF NOT EXISTS `DEMOWMS`.`STELLPLATZ` (
    `P_OID` INT NOT NULL AUTO_INCREMENT,
    `P_ZEITSTEMPEL` DATE NULL,
    `P_ANLAGE_DATUM` DATE NULL,
    `P_LETZTE_AENDERUNG` DATE NULL,
    `P_SGLN_ID` INT NULL,
    `P_STATUS` VARCHAR(45) NULL,
    `P_POS_BREITE` FLOAT NULL,
    `P_POSITION` FLOAT NULL,
    `P_POS_TIEFE` FLOAT NULL,
    `P_OBERGRENZE` FLOAT NULL,
    `LAGERBEREICH_P_OID` INT NULL,
    `LOADING_AREA_P_OID` INT NULL,
    PRIMARY KEY (`P_OID`),
    INDEX `fk_Stellplatz_LAGERBEREICH1_idx` (`LAGERBEREICH_P_OID` ASC),
    INDEX `fk_Stellplatz_LOADING_AREA1_idx` (`LOADING_AREA_P_OID` ASC),
    CONSTRAINT `fk_Stellplatz_LAGERBEREICH1`
      FOREIGN KEY (`LAGERBEREICH_P_OID`)
      REFERENCES `DEMOWMS`.`LAGERBEREICH` (`P_OID`)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
    CONSTRAINT `fk_Stellplatz_LOADING_AREA1`
      FOREIGN KEY (`LOADING_AREA_P_OID`)
      REFERENCES `DEMOWMS`.`LOADING_AREA` (`P_OID`)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION)
  ENGINE = InnoDB;


  -- -----------------------------------------------------
  -- Table `DEMOWMS`.`FAHRZEUGTYP`
  -- -----------------------------------------------------
  CREATE TABLE IF NOT EXISTS `DEMOWMS`.`FAHRZEUGTYP` (
    `P_OID` INT NOT NULL AUTO_INCREMENT,
    `P_ZEITSTEMPEL` DATE NULL,
    `P_ANLAGE_DATUM` DATE NULL,
    `P_LETZTE_AENDERUNG` DATE NULL,
    `P_BESCHREIBUNG` VARCHAR(100) NULL,
    `P_NAME` VARCHAR(100) NULL,
    PRIMARY KEY (`P_OID`))
  ENGINE = InnoDB;


  -- -----------------------------------------------------
  -- Table `DEMOWMS`.`STETIG_FOERDERER`
  -- -----------------------------------------------------
  CREATE TABLE IF NOT EXISTS `DEMOWMS`.`STETIG_FOERDERER` (
    `P_OID` INT NOT NULL AUTO_INCREMENT,
    `P_ANLAGE_DATUM` DATE NULL,
    `P_ZEITSTEMPEL` DATE NULL,
    `P_LETZTE_AENDERUNG` DATE NULL,
    `P_LAENGE` FLOAT NULL,
    `LAGERBEREICH_P_OID` INT NULL,
    PRIMARY KEY (`P_OID`),
    INDEX `fk_STETIG_FOERDERER_LAGERBEREICH1_idx` (`LAGERBEREICH_P_OID` ASC),
    CONSTRAINT `fk_STETIG_FOERDERER_LAGERBEREICH1`
      FOREIGN KEY (`LAGERBEREICH_P_OID`)
      REFERENCES `DEMOWMS`.`LAGERBEREICH` (`P_OID`)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION)
  ENGINE = InnoDB;


  -- -----------------------------------------------------
  -- Table `DEMOWMS`.`FLURFOERDERMITTEL`
  -- -----------------------------------------------------
  CREATE TABLE IF NOT EXISTS `DEMOWMS`.`FLURFOERDERMITTEL` (
    `P_OID` INT NOT NULL AUTO_INCREMENT,
    `P_ZEITSTEMPEL` DATE NULL,
    `P_ANLAGE_DATUM` DATE NULL,
    `P_LETZTE_AENDERUNG` DATE NULL,
    `P_GIAI_ID` INT NULL COMMENT '\n',
    `P_IP_ADRESSE` INT NULL,
    `P_MUSS_TLHM_AUFNEHMEN` TINYINT NULL,
    `P_BETRIEBSTUNDEN` INT NULL,
    `LOGISTIKZENTRUM_P_OID` INT NULL,
    `FAHRZEUGTYP_P_OID` INT NULL,
    PRIMARY KEY (`P_OID`),
    INDEX `fk_FLURFOERDERMITTEL_LOGISTIKZENTRUM1_idx` (`LOGISTIKZENTRUM_P_OID` ASC),
    INDEX `fk_FLURFOERDERMITTEL_FAHRZEUGTYP1_idx` (`FAHRZEUGTYP_P_OID` ASC),
    CONSTRAINT `fk_FLURFOERDERMITTEL_LOGISTIKZENTRUM1`
      FOREIGN KEY (`LOGISTIKZENTRUM_P_OID`)
      REFERENCES `DEMOWMS`.`LOGISTIKZENTRUM` (`P_OID`)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
    CONSTRAINT `fk_FLURFOERDERMITTEL_FAHRZEUGTYP1`
      FOREIGN KEY (`FAHRZEUGTYP_P_OID`)
      REFERENCES `DEMOWMS`.`FAHRZEUGTYP` (`P_OID`)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION)
  ENGINE = InnoDB;


  -- -----------------------------------------------------
  -- Table `DEMOWMS`.`ANHAENGER`
  -- -----------------------------------------------------
  CREATE TABLE IF NOT EXISTS `DEMOWMS`.`ANHAENGER` (
    `P_OID` INT NOT NULL AUTO_INCREMENT,
    `P_NAME` VARCHAR(100) NULL,
    `P_GRAI_ID` INT NULL,
    `P_LANGE` FLOAT NULL,
    `P_BREITE` FLOAT NULL,
    `FLURFOERDERMITTEL_P_OID` INT NULL,
    `STELLPLATZ_P_OID` INT NULL,
    PRIMARY KEY (`P_OID`),
    INDEX `fk_ANHAENGER_FLURFOERDERMITTEL1_idx` (`FLURFOERDERMITTEL_P_OID` ASC),
    INDEX `fk_ANHAENGER_STELLPLATZ1_idx` (`STELLPLATZ_P_OID` ASC),
    CONSTRAINT `fk_ANHAENGER_FLURFOERDERMITTEL1`
      FOREIGN KEY (`FLURFOERDERMITTEL_P_OID`)
      REFERENCES `DEMOWMS`.`FLURFOERDERMITTEL` (`P_OID`)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
    CONSTRAINT `fk_ANHAENGER_STELLPLATZ1`
      FOREIGN KEY (`STELLPLATZ_P_OID`)
      REFERENCES `DEMOWMS`.`STELLPLATZ` (`P_OID`)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION)
  ENGINE = InnoDB;


  -- -----------------------------------------------------
  -- Table `DEMOWMS`.`TRANSPORTAUFTRAG`
  -- -----------------------------------------------------
  CREATE TABLE IF NOT EXISTS `DEMOWMS`.`TRANSPORTAUFTRAG` (
    `P_OID` INT NOT NULL AUTO_INCREMENT,
    `P_ZEITSTEMPEL` DATE NULL,
    `P_ANLAGE_DATUM` DATE NULL,
    `P_LETZTE_AENDERUNG` DATE NULL,
    `P_TRANSPORTNUMMER` INT NULL,
    `P_QUELLE` VARCHAR(45) NULL,
    `P_ZIEL` VARCHAR(45) NULL,
    `P_STATUS` VARCHAR(45) NULL,
    `LOGISTIKZENTRUM_P_OID` INT NULL,
    `FLURFOERDERMITTEL_P_OID` INT NULL,
    `STETIG_FOERDERER_P_OID` INT NULL,
    PRIMARY KEY (`P_OID`),
    INDEX `fk_TRANSPORTAUFTRAG_LOGISTIKZENTRUM1_idx` (`LOGISTIKZENTRUM_P_OID` ASC),
    INDEX `fk_TRANSPORTAUFTRAG_FLURFOERDERMITTEL1_idx` (`FLURFOERDERMITTEL_P_OID` ASC),
    INDEX `fk_TRANSPORTAUFTRAG_STETIG_FOERDERER1_idx` (`STETIG_FOERDERER_P_OID` ASC),
    CONSTRAINT `fk_TRANSPORTAUFTRAG_LOGISTIKZENTRUM1`
      FOREIGN KEY (`LOGISTIKZENTRUM_P_OID`)
      REFERENCES `DEMOWMS`.`LOGISTIKZENTRUM` (`P_OID`)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
    CONSTRAINT `fk_TRANSPORTAUFTRAG_FLURFOERDERMITTEL1`
      FOREIGN KEY (`FLURFOERDERMITTEL_P_OID`)
      REFERENCES `DEMOWMS`.`FLURFOERDERMITTEL` (`P_OID`)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
    CONSTRAINT `fk_TRANSPORTAUFTRAG_STETIG_FOERDERER1`
      FOREIGN KEY (`STETIG_FOERDERER_P_OID`)
      REFERENCES `DEMOWMS`.`STETIG_FOERDERER` (`P_OID`)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION)
  ENGINE = InnoDB;


  -- -----------------------------------------------------
  -- Table `DEMOWMS`.`LADEHILFSMITTELTYP`
  -- -----------------------------------------------------
  CREATE TABLE IF NOT EXISTS `DEMOWMS`.`LADEHILFSMITTELTYP` (
    `P_OID` INT NOT NULL AUTO_INCREMENT,
    `P_ZEITSTEMPEL` DATE NULL,
    `P_ANLAGE_DATUM` DATE NULL,
    `P_LETZTE_AENDERUNG` DATE NULL,
    `P_EIGEN_GEWICHT` FLOAT NULL,
    `P_OV_TRAGLAST` FLOAT NULL,
    `P_POS_BREITE` FLOAT NULL,
    `P_POS_TIEFE` FLOAT NULL,
    `P_TRAG_LAST` FLOAT NULL,
    `P_HOEHE` FLOAT NULL,
    `P_GEWICHTS_EINHEIT` VARCHAR(45) NULL,
    `P_BEZEICHNUNG` VARCHAR(100) NULL,
    `LHMTYPZUORDUNG_P_OID` INT NULL,
    PRIMARY KEY (`P_OID`))
  ENGINE = InnoDB;


  -- -----------------------------------------------------
  -- Table `DEMOWMS`.`LADEHILFSMITTEL`
  -- -----------------------------------------------------
  CREATE TABLE IF NOT EXISTS `DEMOWMS`.`LADEHILFSMITTEL` (
    `P_OID` INT NOT NULL AUTO_INCREMENT,
    `P_ZEITSTEMPEL` DATE NULL,
    `P_ANLAGE_DATUM` DATE NULL,
    `P_LETZTE_AENDERUNG` DATE NULL,
    `P_GRAI_ID` INT NULL,
    `STETIG_FOERDERER_P_OID` INT NULL,
    `ANHAENGER_P_OID` INT NULL,
    `FLURFOERDERMITTEL_P_OID` INT NULL,
    `TRANSPORTAUFTRAG_P_OID` INT NULL,
    `STELLPLATZ_P_OID` INT NULL,
    `LADEHILFSMITTEL_P_OID` INT NULL,
    `LADEHILFSMITTELTYP_P_OID` INT NULL,
    PRIMARY KEY (`P_OID`),
    INDEX `fk_LADEHILFSMITTEL_STETIG_FOERDERER1_idx` (`STETIG_FOERDERER_P_OID` ASC),
    INDEX `fk_LADEHILFSMITTEL_ANHAENGER1_idx` (`ANHAENGER_P_OID` ASC),
    INDEX `fk_LADEHILFSMITTEL_FLURFOERDERMITTEL1_idx` (`FLURFOERDERMITTEL_P_OID` ASC),
    INDEX `fk_LADEHILFSMITTEL_TRANSPORTAUFTRAG1_idx` (`TRANSPORTAUFTRAG_P_OID` ASC),
    INDEX `fk_LADEHILFSMITTEL_STELLPLATZ1_idx` (`STELLPLATZ_P_OID` ASC),
    INDEX `fk_LADEHILFSMITTEL_LADEHILFSMITTEL1_idx` (`LADEHILFSMITTEL_P_OID` ASC),
    INDEX `fk_LADEHILFSMITTEL_LADEHILFSMITTELTYP1_idx` (`LADEHILFSMITTELTYP_P_OID` ASC),
    CONSTRAINT `fk_LADEHILFSMITTEL_STETIG_FOERDERER1`
      FOREIGN KEY (`STETIG_FOERDERER_P_OID`)
      REFERENCES `DEMOWMS`.`STETIG_FOERDERER` (`P_OID`)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
    CONSTRAINT `fk_LADEHILFSMITTEL_ANHAENGER1`
      FOREIGN KEY (`ANHAENGER_P_OID`)
      REFERENCES `DEMOWMS`.`ANHAENGER` (`P_OID`)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
    CONSTRAINT `fk_LADEHILFSMITTEL_FLURFOERDERMITTEL1`
      FOREIGN KEY (`FLURFOERDERMITTEL_P_OID`)
      REFERENCES `DEMOWMS`.`FLURFOERDERMITTEL` (`P_OID`)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
    CONSTRAINT `fk_LADEHILFSMITTEL_TRANSPORTAUFTRAG1`
      FOREIGN KEY (`TRANSPORTAUFTRAG_P_OID`)
      REFERENCES `DEMOWMS`.`TRANSPORTAUFTRAG` (`P_OID`)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
    CONSTRAINT `fk_LADEHILFSMITTEL_STELLPLATZ1`
      FOREIGN KEY (`STELLPLATZ_P_OID`)
      REFERENCES `DEMOWMS`.`STELLPLATZ` (`P_OID`)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
    CONSTRAINT `fk_LADEHILFSMITTEL_LADEHILFSMITTEL1`
      FOREIGN KEY (`LADEHILFSMITTEL_P_OID`)
      REFERENCES `DEMOWMS`.`LADEHILFSMITTEL` (`P_OID`)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
    CONSTRAINT `fk_LADEHILFSMITTEL_LADEHILFSMITTELTYP1`
      FOREIGN KEY (`LADEHILFSMITTELTYP_P_OID`)
      REFERENCES `DEMOWMS`.`LADEHILFSMITTELTYP` (`P_OID`)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION)
  ENGINE = InnoDB;


  -- -----------------------------------------------------
  -- Table `DEMOWMS`.`BESTELLUNG`
  -- -----------------------------------------------------
  CREATE TABLE IF NOT EXISTS `DEMOWMS`.`BESTELLUNG` (
    `P_OID` INT NOT NULL AUTO_INCREMENT,
    `P_ZEITSTEMPEL` DATE NULL,
    `P_ANLAGE_DATUM` DATE NULL,
    `P_LETZTE_AENDERUNG` DATE NULL,
    `P_ANLIEFERTAG` DATE NULL,
    `P_BESTELLNUMMER` INT NULL,
    `P_GEPLANTES_LIEFERDATUM` DATE NULL,
    `P_TEXT` VARCHAR(1000) NULL,
    `LOGISTIKZENTRUM_P_OID` INT NULL,
    PRIMARY KEY (`P_OID`),
    INDEX `fk_BESTELLUNG_LOGISTIKZENTRUM1_idx` (`LOGISTIKZENTRUM_P_OID` ASC),
    CONSTRAINT `fk_BESTELLUNG_LOGISTIKZENTRUM1`
      FOREIGN KEY (`LOGISTIKZENTRUM_P_OID`)
      REFERENCES `DEMOWMS`.`LOGISTIKZENTRUM` (`P_OID`)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION)
  ENGINE = InnoDB;


  -- -----------------------------------------------------
  -- Table `DEMOWMS`.`WARE`
  -- -----------------------------------------------------
  CREATE TABLE IF NOT EXISTS `DEMOWMS`.`WARE` (
    `P_OID` INT NOT NULL AUTO_INCREMENT,
    `P_ZEITSTEMPEL` DATE NULL,
    `P_ANLAGE_DATUM` DATE NULL,
    `P_LETZTE_AENDERUNG` DATE NULL,
    `P_MENGE` INT NULL,
    `P_EINHEITMENGE` VARCHAR(45) NULL,
    `P_EINHEITVOLUMEN` VARCHAR(45) NULL,
    `P_VOLUMEN` FLOAT NULL,
    `P_PACKUNGSGROESSE` FLOAT NULL,
    `LOGISTIKZENTRUM_P_OID` INT NULL,
    `BESTELLUNG_P_OID` INT NULL,
    `LADEHILFSMITTEL_P_OID` INT NULL,
    PRIMARY KEY (`P_OID`),
    INDEX `fk_WARE_LOGISTIKZENTRUM1_idx` (`LOGISTIKZENTRUM_P_OID` ASC),
    INDEX `fk_WARE_BESTELLUNG1_idx` (`BESTELLUNG_P_OID` ASC),
    INDEX `fk_WARE_LADEHILFSMITTEL1_idx` (`LADEHILFSMITTEL_P_OID` ASC),
    CONSTRAINT `fk_WARE_LOGISTIKZENTRUM1`
      FOREIGN KEY (`LOGISTIKZENTRUM_P_OID`)
      REFERENCES `DEMOWMS`.`LOGISTIKZENTRUM` (`P_OID`)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
    CONSTRAINT `fk_WARE_BESTELLUNG1`
      FOREIGN KEY (`BESTELLUNG_P_OID`)
      REFERENCES `DEMOWMS`.`BESTELLUNG` (`P_OID`)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
    CONSTRAINT `fk_WARE_LADEHILFSMITTEL1`
      FOREIGN KEY (`LADEHILFSMITTEL_P_OID`)
      REFERENCES `DEMOWMS`.`LADEHILFSMITTEL` (`P_OID`)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION)
  ENGINE = InnoDB;


  -- -----------------------------------------------------
  -- Table `DEMOWMS`.`ARTIKEL`
  -- -----------------------------------------------------
  CREATE TABLE IF NOT EXISTS `DEMOWMS`.`ARTIKEL` (
    `P_OID` INT NOT NULL AUTO_INCREMENT,
    `P_ZEITSTEMPEL` DATE NULL,
    `P_ANLAGE_DATUM` DATE NULL,
    `P_LETZTE_AENDERUNG` DATE NULL,
    `P_SGTIN_ID` INT NULL,
    `P_ADDITIONAL_TEXT` VARCHAR(100) NULL,
    `P_BESCHREIBUNG` VARCHAR(100) NULL,
    `P_BREITE` FLOAT NULL,
    `P_GESAMTMENGE` INT NULL,
    `P_HOEHE` FLOAT NULL,
    `P_LAENGE` FLOAT NULL,
    `P_MAX_TEMPERATUR` FLOAT NULL,
    `P_MIN_TEMPERATUR` FLOAT NULL,
    `P_STUECKGEWICHT` FLOAT NULL,
    `P_STUECKVOLUMEN` FLOAT NULL,
    `WARE_P_OID` INT NULL,
    `ARTIKELLHMTYP_P_OID` INT NULL,
    PRIMARY KEY (`P_OID`),
    INDEX `fk_ARTIKEL_WARE1_idx` (`WARE_P_OID` ASC),
    CONSTRAINT `fk_ARTIKEL_WARE1`
      FOREIGN KEY (`WARE_P_OID`)
      REFERENCES `DEMOWMS`.`WARE` (`P_OID`)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION)
  ENGINE = InnoDB;


  SET SQL_MODE=@OLD_SQL_MODE;
  SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
  SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

  ";

}

?>
