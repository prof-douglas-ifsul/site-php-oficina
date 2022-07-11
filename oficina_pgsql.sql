-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 11-Jul-2022 às 03:32
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 7.3.2

-- ajustes para converter para pgsql
-- mudar int(11) para integer
-- mudar smallint(6) para smallint
-- mudar escape \' para ''
-- retirar engine de create table
-- remover comandos de auto incremet
-- remover criacao de chaves vinculadas a chave estrangeiras
-- alter table add unique para create unique 
-- colar trecho de criacao de sequencias pgsql

--
-- Database: oficina
--

-- --------------------------------------------------------

--
-- Estrutura da tabela clientes
--

CREATE TABLE clientes (
  idcliente integer NOT NULL,
  nome varchar(150) NOT NULL,
  email varchar(150) NOT NULL,
  idusuario integer DEFAULT NULL
);

--
-- Extraindo dados da tabela clientes
--

-- --------------------------------------------------------

--
-- Estrutura da tabela fabricantes
--

CREATE TABLE fabricantes (
  idfabricante integer NOT NULL,
  nome_curto varchar(50) NOT NULL,
  nome varchar(150) NOT NULL
);

--
-- Extraindo dados da tabela fabricantes
--

INSERT INTO fabricantes VALUES(1, 'Fiat', 'Fiat');
INSERT INTO fabricantes VALUES(2, 'VW', 'Volkswagen');
INSERT INTO fabricantes VALUES(3, 'GM', 'General Motors');
INSERT INTO fabricantes VALUES(4, 'Hyundai', 'Hyundai');
INSERT INTO fabricantes VALUES(5, 'Honda', 'Honda');

-- --------------------------------------------------------

--
-- Estrutura da tabela modelos
--

CREATE TABLE modelos (
  idmodelo integer NOT NULL,
  idfabricante integer NOT NULL,
  nome varchar(100) NOT NULL
);

--
-- Extraindo dados da tabela modelos
--

INSERT INTO modelos VALUES(1, 2, 'Fusca');

-- --------------------------------------------------------

--
-- Estrutura da tabela servicos
--

CREATE TABLE servicos (
  idservico integer NOT NULL,
  data date NOT NULL,
  idcliente integer NOT NULL,
  idveiculo integer NOT NULL,
  quilometragem integer NOT NULL,
  resumo text NOT NULL,
  valor decimal(10,0) NOT NULL
);

-- --------------------------------------------------------

--
-- Estrutura da tabela usuarios
--

CREATE TABLE usuarios (
  idusuario integer NOT NULL,
  nome varchar(250) NOT NULL,
  email varchar(250) NOT NULL,
  senha varchar(64) NOT NULL,
  admin integer NOT NULL DEFAULT 0
);

--
-- Extraindo dados da tabela usuarios
--

INSERT INTO usuarios VALUES(1, 'oficina', 'oficina@oficina.com.br', '0aec0b5b861e5c3185b91ac349c3348c076044bfff2f7f8a33a67b144d7f8f7e', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela veiculos
--

CREATE TABLE veiculos (
  idveiculo integer NOT NULL,
  idcliente integer NOT NULL,
  placa varchar(15) DEFAULT NULL,
  idfabricante integer NOT NULL,
  idmodelo integer NOT NULL,
  ano_fabricacao smallint DEFAULT NULL,
  descricao varchar(100) NOT NULL
) ;

--
-- Extraindo dados da tabela veiculos
--


do $$
declare tabela record;
declare ultimo integer;
begin
FOR tabela IN
        select i.table_name, c.column_name, i.table_name || '_' || c.column_name || '_seq' as seq_name from information_schema.tables i inner join information_schema.columns c on i.table_schema = c.table_schema and i.table_name = c.table_name where c.ordinal_position = 1 and i.table_schema = 'public'
    LOOP
        EXECUTE 'CREATE SEQUENCE IF NOT EXISTS ' || TABELA.seq_name || ';';
        EXECUTE 'alter table ' || TABELA.table_name || ' alter column ' || TABELA.column_name || ' set default nextval(''' || QUOTE_IDENT(TABELA.seq_name) || ''');';
        EXECUTE 'alter sequence ' || QUOTE_IDENT(TABELA.seq_name) || ' owned by ' || TABELA.table_name || '.' || TABELA.column_name || ';';
        EXECUTE format('select COALESCE(max(%I),1) from %I', TABELA.column_name, TABELA.table_name) into ultimo;
        EXECUTE 'select setval(''' || QUOTE_IDENT(TABELA.seq_name) || ''', ' || ultimo || ');';
    END LOOP;
end$$;

ALTER TABLE clientes
  ADD PRIMARY KEY (idcliente);

--
-- Indexes for table fabricantes
--
ALTER TABLE fabricantes
  ADD PRIMARY KEY (idfabricante);

--
-- Indexes for table modelos
--
ALTER TABLE modelos
  ADD PRIMARY KEY (idmodelo);

--
-- Indexes for table servicos
--
ALTER TABLE servicos
  ADD PRIMARY KEY (idservico);

--
-- Indexes for table usuarios
--
ALTER TABLE usuarios
  ADD PRIMARY KEY (idusuario);
create UNIQUE index uk_email_usuario on usuarios(email);

--
-- Indexes for table veiculos
--
ALTER TABLE veiculos
  ADD PRIMARY KEY (idveiculo);

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela clientes
--
ALTER TABLE clientes
  ADD CONSTRAINT fk_clientes_idusuario_usuarios FOREIGN KEY (idusuario) REFERENCES usuarios (idusuario);

--
-- Limitadores para a tabela modelos
--
ALTER TABLE modelos
  ADD CONSTRAINT fk_modelos_idfabricante_fabricantes FOREIGN KEY (idfabricante) REFERENCES fabricantes (idfabricante);

--
-- Limitadores para a tabela servicos
--
ALTER TABLE servicos
  ADD CONSTRAINT fk_servicos_idcliente_clientes FOREIGN KEY (idcliente) REFERENCES clientes (idcliente),
  ADD CONSTRAINT fk_servicos_idveiculo_veiculos FOREIGN KEY (idveiculo) REFERENCES veiculos (idveiculo);

--
-- Limitadores para a tabela veiculos
--
ALTER TABLE veiculos
  ADD CONSTRAINT fk_idcliente_clientes FOREIGN KEY (idcliente) REFERENCES clientes (idcliente),
  ADD CONSTRAINT fk_idfabricante_fabricantes FOREIGN KEY (idfabricante) REFERENCES fabricantes (idfabricante),
  ADD CONSTRAINT fk_idmodelo_modelos FOREIGN KEY (idmodelo) REFERENCES modelos (idmodelo);
