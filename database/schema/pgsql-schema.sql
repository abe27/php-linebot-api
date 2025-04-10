--
-- PostgreSQL database dump
--

-- Dumped from database version 17.4
-- Dumped by pg_dump version 17.4 (Ubuntu 17.4-1.pgdg24.10+2)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: tbt_cache; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.tbt_cache (
    key character varying(255) NOT NULL,
    value text NOT NULL,
    expiration integer NOT NULL
);


--
-- Name: tbt_cache_locks; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.tbt_cache_locks (
    key character varying(255) NOT NULL,
    owner character varying(255) NOT NULL,
    expiration integer NOT NULL
);


--
-- Name: tbt_failed_jobs; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.tbt_failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);


--
-- Name: tbt_failed_jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.tbt_failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: tbt_failed_jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.tbt_failed_jobs_id_seq OWNED BY public.tbt_failed_jobs.id;


--
-- Name: tbt_job_batches; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.tbt_job_batches (
    id character varying(255) NOT NULL,
    name character varying(255) NOT NULL,
    total_jobs integer NOT NULL,
    pending_jobs integer NOT NULL,
    failed_jobs integer NOT NULL,
    failed_job_ids text NOT NULL,
    options text,
    cancelled_at integer,
    created_at integer NOT NULL,
    finished_at integer
);


--
-- Name: tbt_jobs; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.tbt_jobs (
    id bigint NOT NULL,
    queue character varying(255) NOT NULL,
    payload text NOT NULL,
    attempts smallint NOT NULL,
    reserved_at integer,
    available_at integer NOT NULL,
    created_at integer NOT NULL
);


--
-- Name: tbt_jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.tbt_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: tbt_jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.tbt_jobs_id_seq OWNED BY public.tbt_jobs.id;


--
-- Name: tbt_line_bots; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.tbt_line_bots (
    id character(26) NOT NULL,
    handle_date date DEFAULT '2025-04-10'::date,
    line_user_id character(26) NOT NULL,
    message_source character varying(255) NOT NULL,
    line_group_id character(26),
    message_type character varying(255) NOT NULL,
    message character varying(255) NOT NULL,
    reply_token character varying(255) NOT NULL,
    is_replyed boolean DEFAULT false,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


--
-- Name: tbt_line_groups; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.tbt_line_groups (
    id character(26) NOT NULL,
    group_id character varying(255) NOT NULL,
    name character varying(255) NOT NULL,
    description text,
    is_active boolean DEFAULT true,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


--
-- Name: tbt_line_replies; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.tbt_line_replies (
    id character(26) NOT NULL,
    name character varying(255) NOT NULL,
    reply character varying(255) NOT NULL,
    is_active boolean DEFAULT true,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


--
-- Name: tbt_line_users; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.tbt_line_users (
    id character(26) NOT NULL,
    emp_id character(26),
    display_name character varying(255) NOT NULL,
    user_id character varying(255) NOT NULL,
    picture_url character varying(255) NOT NULL,
    status_message character varying(255) NOT NULL,
    language character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


--
-- Name: tbt_migrations; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.tbt_migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


--
-- Name: tbt_migrations_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.tbt_migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: tbt_migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.tbt_migrations_id_seq OWNED BY public.tbt_migrations.id;


--
-- Name: tbt_password_reset_tokens; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.tbt_password_reset_tokens (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);


--
-- Name: tbt_sessions; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.tbt_sessions (
    id character varying(255) NOT NULL,
    user_id character(26),
    ip_address character varying(45),
    user_agent text,
    payload text NOT NULL,
    last_activity integer NOT NULL
);


--
-- Name: tbt_users; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.tbt_users (
    id character(26) NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    email_verified_at timestamp(0) without time zone,
    password character varying(255) NOT NULL,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


--
-- Name: tbt_failed_jobs id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tbt_failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.tbt_failed_jobs_id_seq'::regclass);


--
-- Name: tbt_jobs id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tbt_jobs ALTER COLUMN id SET DEFAULT nextval('public.tbt_jobs_id_seq'::regclass);


--
-- Name: tbt_migrations id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tbt_migrations ALTER COLUMN id SET DEFAULT nextval('public.tbt_migrations_id_seq'::regclass);


--
-- Name: tbt_cache_locks tbt_cache_locks_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tbt_cache_locks
    ADD CONSTRAINT tbt_cache_locks_pkey PRIMARY KEY (key);


--
-- Name: tbt_cache tbt_cache_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tbt_cache
    ADD CONSTRAINT tbt_cache_pkey PRIMARY KEY (key);


--
-- Name: tbt_failed_jobs tbt_failed_jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tbt_failed_jobs
    ADD CONSTRAINT tbt_failed_jobs_pkey PRIMARY KEY (id);


--
-- Name: tbt_failed_jobs tbt_failed_jobs_uuid_unique; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tbt_failed_jobs
    ADD CONSTRAINT tbt_failed_jobs_uuid_unique UNIQUE (uuid);


--
-- Name: tbt_job_batches tbt_job_batches_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tbt_job_batches
    ADD CONSTRAINT tbt_job_batches_pkey PRIMARY KEY (id);


--
-- Name: tbt_jobs tbt_jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tbt_jobs
    ADD CONSTRAINT tbt_jobs_pkey PRIMARY KEY (id);


--
-- Name: tbt_line_bots tbt_line_bots_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tbt_line_bots
    ADD CONSTRAINT tbt_line_bots_pkey PRIMARY KEY (id);


--
-- Name: tbt_line_groups tbt_line_groups_group_id_unique; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tbt_line_groups
    ADD CONSTRAINT tbt_line_groups_group_id_unique UNIQUE (group_id);


--
-- Name: tbt_line_groups tbt_line_groups_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tbt_line_groups
    ADD CONSTRAINT tbt_line_groups_pkey PRIMARY KEY (id);


--
-- Name: tbt_line_replies tbt_line_replies_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tbt_line_replies
    ADD CONSTRAINT tbt_line_replies_pkey PRIMARY KEY (id);


--
-- Name: tbt_line_users tbt_line_users_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tbt_line_users
    ADD CONSTRAINT tbt_line_users_pkey PRIMARY KEY (id);


--
-- Name: tbt_migrations tbt_migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tbt_migrations
    ADD CONSTRAINT tbt_migrations_pkey PRIMARY KEY (id);


--
-- Name: tbt_password_reset_tokens tbt_password_reset_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tbt_password_reset_tokens
    ADD CONSTRAINT tbt_password_reset_tokens_pkey PRIMARY KEY (email);


--
-- Name: tbt_sessions tbt_sessions_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tbt_sessions
    ADD CONSTRAINT tbt_sessions_pkey PRIMARY KEY (id);


--
-- Name: tbt_users tbt_users_email_unique; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tbt_users
    ADD CONSTRAINT tbt_users_email_unique UNIQUE (email);


--
-- Name: tbt_users tbt_users_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tbt_users
    ADD CONSTRAINT tbt_users_pkey PRIMARY KEY (id);


--
-- Name: tbt_jobs_queue_index; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX tbt_jobs_queue_index ON public.tbt_jobs USING btree (queue);


--
-- Name: tbt_sessions_last_activity_index; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX tbt_sessions_last_activity_index ON public.tbt_sessions USING btree (last_activity);


--
-- Name: tbt_sessions_user_id_index; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX tbt_sessions_user_id_index ON public.tbt_sessions USING btree (user_id);


--
-- Name: tbt_line_bots tbt_line_bots_line_group_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tbt_line_bots
    ADD CONSTRAINT tbt_line_bots_line_group_id_foreign FOREIGN KEY (line_group_id) REFERENCES public.tbt_line_groups(id);


--
-- Name: tbt_line_bots tbt_line_bots_line_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tbt_line_bots
    ADD CONSTRAINT tbt_line_bots_line_user_id_foreign FOREIGN KEY (line_user_id) REFERENCES public.tbt_line_users(id);


--
-- Name: tbt_line_users tbt_line_users_emp_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.tbt_line_users
    ADD CONSTRAINT tbt_line_users_emp_id_foreign FOREIGN KEY (emp_id) REFERENCES public.tbt_users(id);


--
-- PostgreSQL database dump complete
--

--
-- PostgreSQL database dump
--

-- Dumped from database version 17.4
-- Dumped by pg_dump version 17.4 (Ubuntu 17.4-1.pgdg24.10+2)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Data for Name: tbt_migrations; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.tbt_migrations (id, migration, batch) FROM stdin;
1	0001_01_01_000000_create_users_table	1
2	0001_01_01_000001_create_cache_table	1
3	0001_01_01_000002_create_jobs_table	1
4	2025_04_08_084011_create_line_users_table	1
5	2025_04_08_084113_create_line_groups_table	1
6	2025_04_08_085011_create_line_bots_table	1
7	2025_04_09_014144_create_line_replies_table	1
\.


--
-- Name: tbt_migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.tbt_migrations_id_seq', 7, true);


--
-- PostgreSQL database dump complete
--

