-- MySQL Script generated by MySQL Workbench
-- Tue Aug  6 22:06:27 2019
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema chronos
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `chronos` ;

-- -----------------------------------------------------
-- Schema chronos
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `chronos` DEFAULT CHARACTER SET utf8mb4 ;
USE `chronos` ;

-- -----------------------------------------------------
-- Table `chronos`.`usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `chronos`.`usuario` ;

CREATE TABLE IF NOT EXISTS `chronos`.`usuario` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(80) NOT NULL,
  `matricula` CHAR(13) NOT NULL,
  `email` VARCHAR(70) NOT NULL,
  `nome_usr` VARCHAR(50) NOT NULL,
  `senha` VARCHAR(60) NOT NULL,
  `tipo` ENUM("ADM", "AL", "C") NOT NULL,
  `status` TINYINT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `nome_usr_UNIQUE` (`nome_usr` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC),
  UNIQUE INDEX `matricula_UNIQUE` (`matricula` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `chronos`.`coordenador`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `chronos`.`coordenador` ;

CREATE TABLE IF NOT EXISTS `chronos`.`coordenador` (
  `usuario_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`usuario_id`),
  INDEX `fk_coordenador_usuario1_idx` (`usuario_id` ASC),
  CONSTRAINT `fk_coordenador_usuario1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `chronos`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `chronos`.`aluno`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `chronos`.`aluno` ;

CREATE TABLE IF NOT EXISTS `chronos`.`aluno` (
  `usuario_id` INT UNSIGNED NOT NULL,
  `disc_nprevistas` TINYINT UNSIGNED NOT NULL,
  `cursos_atualizacao` TINYINT UNSIGNED NOT NULL,
  `monitoria` TINYINT UNSIGNED NOT NULL,
  `estagio_nobrigatorio` TINYINT UNSIGNED NOT NULL,
  `ev_internos` TINYINT UNSIGNED NOT NULL,
  `ev_externos` TINYINT UNSIGNED NOT NULL,
  `cursos_ext` TINYINT UNSIGNED NOT NULL,
  `init_cientifica` TINYINT UNSIGNED NOT NULL,
  `publicacoes` TINYINT UNSIGNED NOT NULL,
  `trab_cientifico` TINYINT UNSIGNED NOT NULL,
  PRIMARY KEY (`usuario_id`),
  INDEX `fk_aluno_usuario1_idx` (`usuario_id` ASC),
  CONSTRAINT `fk_aluno_usuario1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `chronos`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `chronos`.`relatorio`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `chronos`.`relatorio` ;

CREATE TABLE IF NOT EXISTS `chronos`.`relatorio` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `estado` TINYINT NOT NULL,
  `data` DATE NOT NULL,
  `coordenador_usuario_id` INT UNSIGNED NULL,
  `aluno_usuario_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_relatorio_coordenador1_idx` (`coordenador_usuario_id` ASC),
  INDEX `fk_relatorio_aluno1_idx` (`aluno_usuario_id` ASC),
  CONSTRAINT `fk_relatorio_coordenador1`
    FOREIGN KEY (`coordenador_usuario_id`)
    REFERENCES `chronos`.`coordenador` (`usuario_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_relatorio_aluno1`
    FOREIGN KEY (`aluno_usuario_id`)
    REFERENCES `chronos`.`aluno` (`usuario_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `chronos`.`atividade`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `chronos`.`atividade` ;

CREATE TABLE IF NOT EXISTS `chronos`.`atividade` (
  `id` INT UNSIGNED NOT NULL,
  `relatorio_id` INT UNSIGNED NOT NULL,
  `nome` VARCHAR(80) NOT NULL,
  `data` DATE NOT NULL,
  `qtd_horas` INT UNSIGNED NOT NULL,
  `horas_validadas` INT UNSIGNED NULL,
  `categoria` VARCHAR(45) NOT NULL,
  `comprovante` VARCHAR(256) NULL,
  INDEX `fk_atividade_relatorio_idx` (`relatorio_id` ASC),
  PRIMARY KEY (`id`, `relatorio_id`),
  CONSTRAINT `fk_atividade_relatorio`
    FOREIGN KEY (`relatorio_id`)
    REFERENCES `chronos`.`relatorio` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `chronos`.`administrador`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `chronos`.`administrador` ;

CREATE TABLE IF NOT EXISTS `chronos`.`administrador` (
  `usuario_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`usuario_id`),
  INDEX `fk_administrador_usuario1_idx` (`usuario_id` ASC),
  CONSTRAINT `fk_administrador_usuario1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `chronos`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
