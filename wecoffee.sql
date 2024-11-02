--sql para criação das tabelas

CREATE SEQUENCE IF NOT EXISTS produtos_id_seq;

CREATE TABLE IF NOT EXISTS public.produtos (
    id integer NOT NULL DEFAULT nextval('produtos_id_seq'::regclass),
    tipo character varying(45) NOT NULL,
    nome character varying(45) NOT NULL,
    descricao character varying(90) NOT NULL,
    imagem character varying(80) NOT NULL,
    preco numeric(5,2) NOT NULL,
    CONSTRAINT produtos_pkey PRIMARY KEY (id)
);


CREATE TABLE usuarios (
  id SERIAL PRIMARY KEY,
  usuario VARCHAR(50) NOT NULL,
  email VARCHAR(100) NOT NULL,
  senha VARCHAR(255) NOT NULL,
  data_nascimento DATE NOT NULL
);
