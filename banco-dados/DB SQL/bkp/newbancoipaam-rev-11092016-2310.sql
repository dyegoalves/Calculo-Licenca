-- MySQL Script generated by MySQL Workbench
-- 09/11/16 23:10:57
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
-- Table `ipaam`.`empreendimentos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ipaam`.`empreendimentos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `atividade_id` VARCHAR(255) NOT NULL,
  `subatividade_id` VARCHAR(255) NOT NULL,
  `zonadelocilizacao` VARCHAR(255) NOT NULL,
  `endereco` VARCHAR(255) NOT NULL,
  `numero` VARCHAR(255) NOT NULL,
  `complemento` VARCHAR(255) NULL,
  `cep` VARCHAR(255) NOT NULL,
  `bairro` VARCHAR(255) NOT NULL,
  `estado` VARCHAR(255) NOT NULL,
  `municipio` VARCHAR(255) NOT NULL,
  `atividades_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_empreedimentos_atividades1_idx` (`atividades_id` ASC))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COMMENT = 'Tabela empresa\n';


-- -----------------------------------------------------
-- Table `ipaam`.`portes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ipaam`.`portes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `level` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ipaam`.`empresas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ipaam`.`empresas` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `razaosocial` VARCHAR(255) NOT NULL,
  `nomefantasia` VARCHAR(255) NOT NULL,
  `cnpj` VARCHAR(255) NOT NULL,
  `inscricaoestadual` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `telefone` VARCHAR(255) NOT NULL,
  `celular` VARCHAR(255) NOT NULL,
  `fax` VARCHAR(255) NULL,
  `endereco` VARCHAR(255) NOT NULL,
  `numero` VARCHAR(255) NOT NULL,
  `complemento` VARCHAR(255) NULL,
  `cep` VARCHAR(255) NOT NULL,
  `bairro` VARCHAR(255) NOT NULL,
  `estado` VARCHAR(255) NOT NULL,
  `municipio` VARCHAR(255) NOT NULL,
  `nacionalidade` VARCHAR(255) NOT NULL,
  `empreedimentos_id` INT NOT NULL,
  `portes_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_empresas_empreedimentos_idx` (`empreedimentos_id` ASC),
  INDEX `fk_empresas_portes1_idx` (`portes_id` ASC))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COMMENT = 'Tabela empresa\n';


-- -----------------------------------------------------
-- Table `ipaam`.`subatividades`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ipaam`.`subatividades` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `codigo` VARCHAR(255) NOT NULL,
  `descricao` VARCHAR(255) NOT NULL,
  `atividades_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_subatividades_atividades1_idx` (`atividades_id` ASC),
  CONSTRAINT `fk_subatividades_atividades1`
    FOREIGN KEY (`atividades_id`)
    REFERENCES `ipaam`.`atividades` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ipaam`.`ppds`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ipaam`.`ppds` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `level` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ipaam`.`portes_has_ppds`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ipaam`.`portes_has_ppds` (
  `portes_id` INT NOT NULL,
  `ppds_id` INT NOT NULL,
  PRIMARY KEY (`portes_id`, `ppds_id`),
  INDEX `fk_portes_has_ppds_ppds1_idx` (`ppds_id` ASC),
  INDEX `fk_portes_has_ppds_portes1_idx` (`portes_id` ASC),
  CONSTRAINT `fk_portes_has_ppds_portes1`
    FOREIGN KEY (`portes_id`)
    REFERENCES `ipaam`.`portes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_portes_has_ppds_ppds1`
    FOREIGN KEY (`ppds_id`)
    REFERENCES `ipaam`.`ppds` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ipaam`.`tipoprecos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ipaam`.`tipoprecos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `lp` DECIMAL(10,2) NOT NULL,
  `li` DECIMAL(10,2) NOT NULL,
  `lo` DECIMAL(10,2) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ipaam`.`ppds_has_tipoprecos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ipaam`.`ppds_has_tipoprecos` (
  `ppds_id` INT NOT NULL,
  `tipoprecos_id` INT NOT NULL,
  PRIMARY KEY (`ppds_id`, `tipoprecos_id`),
  INDEX `fk_ppds_has_tipoprecos_tipoprecos1_idx` (`tipoprecos_id` ASC),
  INDEX `fk_ppds_has_tipoprecos_ppds1_idx` (`ppds_id` ASC),
  CONSTRAINT `fk_ppds_has_tipoprecos_ppds1`
    FOREIGN KEY (`ppds_id`)
    REFERENCES `ipaam`.`ppds` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ppds_has_tipoprecos_tipoprecos1`
    FOREIGN KEY (`tipoprecos_id`)
    REFERENCES `ipaam`.`tipoprecos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ipaam`.`processos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ipaam`.`processos` (
  `id` INT NOT NULL,
  `numero` VARCHAR(255) NOT NULL,
  `empreedimentos_id` INT NOT NULL,
  `empresas_id` INT NOT NULL,
  `empresas_portes_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_processo_empreedimentos1_idx` (`empreedimentos_id` ASC),
  INDEX `fk_processo_empresas1_idx` (`empresas_id` ASC, `empresas_portes_id` ASC),
  CONSTRAINT `fk_processo_empreedimentos1`
    FOREIGN KEY (`empreedimentos_id`)
    REFERENCES `ipaam`.`empreendimentos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_processo_empresas1`
    FOREIGN KEY (`empresas_id`)
    REFERENCES `ipaam`.`empresas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
