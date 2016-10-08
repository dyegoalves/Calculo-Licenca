-- MySQL Script generated by MySQL Workbench
-- 09/11/16 23:19:15
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema modelo
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema modelo
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `modelo` DEFAULT CHARACTER SET utf8 ;
USE `modelo` ;

-- -----------------------------------------------------
-- Table `modelo`.`portes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `modelo`.`portes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `level` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `modelo`.`atividades`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `modelo`.`atividades` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `codigo` VARCHAR(255) NOT NULL,
  `descricao` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `modelo`.`empreendimentos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `modelo`.`empreendimentos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `atividade_id` VARCHAR(255) NOT NULL,
  `subatividade_id` VARCHAR(255) NOT NULL,
  `zonadelocalizacao` VARCHAR(255) NOT NULL,
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
-- Table `modelo`.`empresas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `modelo`.`empresas` (
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
  `portes_id` INT NOT NULL,
  `empreendimentos_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_empresas_portes1_idx` (`portes_id` ASC),
  INDEX `fk_empresas_empreendimentos1_idx` (`empreendimentos_id` ASC))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COMMENT = 'Tabela empresa\n';


-- -----------------------------------------------------
-- Table `modelo`.`subatividades`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `modelo`.`subatividades` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `codigo` VARCHAR(255) NOT NULL,
  `descricao` VARCHAR(255) NOT NULL,
  `atividades_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_subatividades_atividades1_idx` (`atividades_id` ASC),
  CONSTRAINT `fk_subatividades_atividades1`
    FOREIGN KEY (`atividades_id`)
    REFERENCES `modelo`.`atividades` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `modelo`.`ppds`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `modelo`.`ppds` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `level` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `modelo`.`portes_has_ppds`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `modelo`.`portes_has_ppds` (
  `portes_id` INT NOT NULL,
  `ppds_id` INT NOT NULL,
  PRIMARY KEY (`portes_id`, `ppds_id`),
  INDEX `fk_portes_has_ppds_ppds1_idx` (`ppds_id` ASC),
  INDEX `fk_portes_has_ppds_portes1_idx` (`portes_id` ASC),
  CONSTRAINT `fk_portes_has_ppds_portes1`
    FOREIGN KEY (`portes_id`)
    REFERENCES `modelo`.`portes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_portes_has_ppds_ppds1`
    FOREIGN KEY (`ppds_id`)
    REFERENCES `modelo`.`ppds` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `modelo`.`tipoprecos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `modelo`.`tipoprecos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `lp` DECIMAL(10,2) NOT NULL,
  `li` DECIMAL(10,2) NOT NULL,
  `lo` DECIMAL(10,2) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `modelo`.`ppds_has_tipoprecos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `modelo`.`ppds_has_tipoprecos` (
  `ppds_id` INT NOT NULL,
  `tipoprecos_id` INT NOT NULL,
  PRIMARY KEY (`ppds_id`, `tipoprecos_id`),
  INDEX `fk_ppds_has_tipoprecos_tipoprecos1_idx` (`tipoprecos_id` ASC),
  INDEX `fk_ppds_has_tipoprecos_ppds1_idx` (`ppds_id` ASC),
  CONSTRAINT `fk_ppds_has_tipoprecos_ppds1`
    FOREIGN KEY (`ppds_id`)
    REFERENCES `modelo`.`ppds` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ppds_has_tipoprecos_tipoprecos1`
    FOREIGN KEY (`tipoprecos_id`)
    REFERENCES `modelo`.`tipoprecos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `modelo`.`processos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `modelo`.`processos` (
  `id` INT NOT NULL,
  `numero` VARCHAR(255) NOT NULL,
  `empresas_id` INT NOT NULL,
  `empreendimentos_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_processo_empresas1_idx` (`empresas_id` ASC),
  INDEX `fk_processos_empreendimentos1_idx` (`empreendimentos_id` ASC),
  CONSTRAINT `fk_processo_empresas1`
    FOREIGN KEY (`empresas_id`)
    REFERENCES `modelo`.`empresas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_processos_empreendimentos1`
    FOREIGN KEY (`empreendimentos_id`)
    REFERENCES `modelo`.`empreendimentos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;