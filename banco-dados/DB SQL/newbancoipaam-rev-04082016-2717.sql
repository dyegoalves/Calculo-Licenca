-- MySQL Script generated by MySQL Workbench
-- 08/04/16 22:15:34
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema ipaam
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema ipaam
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `ipaam` DEFAULT CHARACTER SET utf8 ;
USE `ipaam` ;

-- -----------------------------------------------------
-- Table `ipaam`.`atividades`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ipaam`.`atividades` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `codigo` VARCHAR(255) NOT NULL,
  `descricao` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ipaam`.`portes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ipaam`.`portes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `tamanho` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ipaam`.`ppds`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ipaam`.`ppds` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nivel` VARCHAR(255) NOT NULL,
  `portes_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_ppds_portes1_idx` (`portes_id` ASC),
  CONSTRAINT `fk_ppds_portes1`
    FOREIGN KEY (`portes_id`)
    REFERENCES `ipaam`.`portes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ipaam`.`subatividades`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ipaam`.`subatividades` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `codigo` VARCHAR(255) NOT NULL,
  `descricao` VARCHAR(255) NOT NULL,
  `atividades_id` INT NOT NULL,
  `ppd_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_subatividades_atividades1_idx` (`atividades_id` ASC),
  INDEX `fk_subatividades_ppd1_idx` (`ppd_id` ASC),
  CONSTRAINT `fk_subatividades_atividades1`
    FOREIGN KEY (`atividades_id`)
    REFERENCES `ipaam`.`atividades` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_subatividades_ppd1`
    FOREIGN KEY (`ppd_id`)
    REFERENCES `ipaam`.`ppds` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ipaam`.`empresas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ipaam`.`empresas` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `cnpjcpf` VARCHAR(255) NOT NULL,
  `nome` VARCHAR(255) NOT NULL,
  `nomefantasia` VARCHAR(255) NOT NULL,
  `endereco` VARCHAR(255) NOT NULL,
  `telefone` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `atividades_id` INT NOT NULL,
  `subatividades_id` INT NOT NULL,
  `portes_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_empresas_atividades1_idx` (`atividades_id` ASC),
  INDEX `fk_empresas_subatividades1_idx` (`subatividades_id` ASC),
  INDEX `fk_empresas_portes1_idx` (`portes_id` ASC),
  CONSTRAINT `fk_empresas_atividades1`
    FOREIGN KEY (`atividades_id`)
    REFERENCES `ipaam`.`atividades` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_empresas_subatividades1`
    FOREIGN KEY (`subatividades_id`)
    REFERENCES `ipaam`.`subatividades` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_empresas_portes1`
    FOREIGN KEY (`portes_id`)
    REFERENCES `ipaam`.`portes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ipaam`.`processos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ipaam`.`processos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `numero` VARCHAR(255) NOT NULL,
  `empresas_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_processos_empresas_idx` (`empresas_id` ASC),
  CONSTRAINT `fk_processos_empresas`
    FOREIGN KEY (`empresas_id`)
    REFERENCES `ipaam`.`empresas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ipaam`.`tipoprecos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ipaam`.`tipoprecos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `precoLP` VARCHAR(255) NOT NULL,
  `precoLI` VARCHAR(255) NOT NULL,
  `precoLO` VARCHAR(255) NOT NULL,
  `ppds_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_tipoprecos_ppds1_idx` (`ppds_id` ASC),
  CONSTRAINT `fk_tipoprecos_ppds1`
    FOREIGN KEY (`ppds_id`)
    REFERENCES `ipaam`.`ppds` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
