CREATE TABLE public.auth_rule
(
  name character varying(64) NOT NULL,
  data bytea,
  created_at integer,
  updated_at integer,
  CONSTRAINT auth_rule_pkey PRIMARY KEY (name)
);

CREATE TABLE public.auth_item
(
  name character varying(64) NOT NULL,
  type smallint NOT NULL,
  description text,
  rule_name character varying(64),
  data bytea,
  created_at integer,
  updated_at integer,
  CONSTRAINT auth_item_pkey PRIMARY KEY (name),
  CONSTRAINT auth_item_rule_name_fkey FOREIGN KEY (rule_name)
      REFERENCES public.auth_rule (name) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE SET NULL
);

CREATE TABLE public.auth_item_child
(
  parent character varying(64) NOT NULL,
  child character varying(64) NOT NULL,
  CONSTRAINT auth_item_child_pkey PRIMARY KEY (parent, child),
  CONSTRAINT auth_item_child_child_fkey FOREIGN KEY (child)
      REFERENCES public.auth_item (name) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT auth_item_child_parent_fkey FOREIGN KEY (parent)
      REFERENCES public.auth_item (name) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE public.auth_assignment
(
  item_name character varying(64) NOT NULL,
  user_id character varying(64) NOT NULL,
  created_at integer,
  CONSTRAINT auth_assignment_pkey PRIMARY KEY (item_name, user_id),
  CONSTRAINT auth_assignment_item_name_fkey FOREIGN KEY (item_name)
      REFERENCES public.auth_item (name) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE dirtelf.usuario
(
  iduser serial,
  username character varying(255) NOT NULL,
  auth_key character varying(32) NOT NULL,
  password character varying(255) NOT NULL,
  password_reset_token character varying(255),
  email character varying(255) NOT NULL,
  status smallint NOT NULL DEFAULT 1,
  created_at timestamp without time zone,
  updated_at timestamp without time zone,
  verification_token character varying(255) DEFAULT NULL::character varying,
  CONSTRAINT user_pkey PRIMARY KEY (iduser),
  CONSTRAINT user_email_key UNIQUE (email),
  CONSTRAINT user_password_reset_token_key UNIQUE (password_reset_token),
  CONSTRAINT user_username_key UNIQUE (username)
);

CREATE TABLE dirtelf.userextens
(
  iduserextens serial NOT NULL,
  nombuser character varying(255),
  fkuser integer,
  CONSTRAINT iduserextens PRIMARY KEY (iduserextens),
  CONSTRAINT fkuser FOREIGN KEY (fkuser)
      REFERENCES dirtelf.usuario (iduser) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE dirtelf.departamento
(
  iddepart serial NOT NULL,
  nombdepart character varying(255),
  fkuser integer,
  CONSTRAINT iddepart PRIMARY KEY (iddepart),
  CONSTRAINT fkuser FOREIGN KEY (fkuser)
      REFERENCES dirtelf.userextens (iduserextens) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE dirtelf.telfextension
(
  idtelfext serial NOT NULL,
  numextens character varying(255),
  ubicacion character varying(255),
  fkdepart integer,
  CONSTRAINT idtelfext PRIMARY KEY (idtelfext),
  CONSTRAINT fkdepart FOREIGN KEY (fkdepart)
      REFERENCES dirtelf.departamento (iddepart) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE dirtelf.catalogo
(
  idcata serial NOT NULL,
  idpadre integer,
  nombcata character varying(255),
  CONSTRAINT idcata PRIMARY KEY (idcata)
);
