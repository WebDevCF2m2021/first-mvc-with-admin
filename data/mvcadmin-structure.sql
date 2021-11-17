-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mvcadmin
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `mvcadmin` ;

-- -----------------------------------------------------
-- Schema mvcadmin
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mvcadmin` DEFAULT CHARACTER SET utf8 ;
USE `mvcadmin` ;

-- -----------------------------------------------------
-- Table `mvcadmin`.`theright`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mvcadmin`.`theright` ;

CREATE TABLE IF NOT EXISTS `mvcadmin`.`theright` (
  `idtheright` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `therightName` VARCHAR(60) NOT NULL,
  `therightdesc` VARCHAR(300) NULL,
  `therightPerm` TINYINT NOT NULL DEFAULT 0 COMMENT '0 => user\n1 => redactor\n2 => moderator\n3 => admin',
  PRIMARY KEY (`idtheright`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mvcadmin`.`theuser`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mvcadmin`.`theuser` ;

CREATE TABLE IF NOT EXISTS `mvcadmin`.`theuser` (
  `idtheuser` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `theuserName` VARCHAR(150) NOT NULL,
  `theuserLogin` VARCHAR(60) NOT NULL,
  `theuserPwd` VARCHAR(255) NOT NULL,
  `theright_idtheright` SMALLINT UNSIGNED NOT NULL,
  PRIMARY KEY (`idtheuser`),
  CONSTRAINT `fk_theuser_theright`
    FOREIGN KEY (`theright_idtheright`)
    REFERENCES `mvcadmin`.`theright` (`idtheright`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE UNIQUE INDEX `theuserLogin_UNIQUE` ON `mvcadmin`.`theuser` (`theuserLogin` ASC);

CREATE INDEX `fk_theuser_theright_idx` ON `mvcadmin`.`theuser` (`theright_idtheright` ASC);


-- -----------------------------------------------------
-- Table `mvcadmin`.`thearticle`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mvcadmin`.`thearticle` ;

CREATE TABLE IF NOT EXISTS `mvcadmin`.`thearticle` (
  `idthearticle` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `thearticleTitle` VARCHAR(180) NOT NULL,
  `thearticleText` TEXT NOT NULL,
  `thearticleDate` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `thearticleStatus` TINYINT NOT NULL DEFAULT 1 COMMENT '0 => wait validation\n1 => validate\n2 => wait correction\n3 => ban\n',
  `theuser_idtheuser` INT UNSIGNED NULL,
  PRIMARY KEY (`idthearticle`),
  CONSTRAINT `fk_thearticle_theuser1`
    FOREIGN KEY (`theuser_idtheuser`)
    REFERENCES `mvcadmin`.`theuser` (`idtheuser`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_thearticle_theuser1_idx` ON `mvcadmin`.`thearticle` (`theuser_idtheuser` ASC);


-- -----------------------------------------------------
-- Table `mvcadmin`.`thesection`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mvcadmin`.`thesection` ;

CREATE TABLE IF NOT EXISTS `mvcadmin`.`thesection` (
  `idthesection` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `thesectionTitle` VARCHAR(150) NOT NULL,
  `thesectionDesc` VARCHAR(500) NULL,
  PRIMARY KEY (`idthesection`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `thesectionTitle_UNIQUE` ON `mvcadmin`.`thesection` (`thesectionTitle` ASC);


-- -----------------------------------------------------
-- Table `mvcadmin`.`thearticle_has_thesection`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mvcadmin`.`thearticle_has_thesection` ;

CREATE TABLE IF NOT EXISTS `mvcadmin`.`thearticle_has_thesection` (
  `thearticle_idthearticle` INT UNSIGNED NOT NULL,
  `thesection_idthesection` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`thearticle_idthearticle`, `thesection_idthesection`),
  CONSTRAINT `fk_thearticle_has_thesection_thearticle1`
    FOREIGN KEY (`thearticle_idthearticle`)
    REFERENCES `mvcadmin`.`thearticle` (`idthearticle`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_thearticle_has_thesection_thesection1`
    FOREIGN KEY (`thesection_idthesection`)
    REFERENCES `mvcadmin`.`thesection` (`idthesection`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_thearticle_has_thesection_thesection1_idx` ON `mvcadmin`.`thearticle_has_thesection` (`thesection_idthesection` ASC);

CREATE INDEX `fk_thearticle_has_thesection_thearticle1_idx` ON `mvcadmin`.`thearticle_has_thesection` (`thearticle_idthearticle` ASC);


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
