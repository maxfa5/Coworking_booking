--
-- PostgreSQL database dump
--

\restrict VorK6ynMz8pRQYYy3vpCKQQWE4qQ9wXdyHY8O4YOFaRb6tRyvGsWjOdYKUpH1PE

-- Dumped from database version 15.14 (Debian 15.14-1.pgdg13+1)
-- Dumped by pg_dump version 15.14 (Debian 15.14-1.pgdg13+1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: booking_type; Type: TYPE; Schema: public; Owner: user
--

CREATE TYPE public.booking_type AS ENUM (
    'SINGLE',
    'WEEK',
    'PERMANENT'
);


ALTER TYPE public.booking_type OWNER TO "user";

--
-- Name: user_role; Type: TYPE; Schema: public; Owner: user
--

CREATE TYPE public.user_role AS ENUM (
    'SUPER',
    'USER'
);


ALTER TYPE public.user_role OWNER TO "user";

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: bookings; Type: TABLE; Schema: public; Owner: user
--

CREATE TABLE public.bookings (
    id integer NOT NULL,
    object_id integer,
    user_id integer,
    start_time timestamp with time zone,
    end_time timestamp with time zone,
    period_start_at timestamp with time zone,
    day_of_week integer,
    period_end_at timestamp with time zone,
    type public.booking_type,
    created_at timestamp with time zone DEFAULT now() NOT NULL
);


ALTER TABLE public.bookings OWNER TO "user";

--
-- Name: bookings_id_seq; Type: SEQUENCE; Schema: public; Owner: user
--

CREATE SEQUENCE public.bookings_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.bookings_id_seq OWNER TO "user";

--
-- Name: bookings_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: user
--

ALTER SEQUENCE public.bookings_id_seq OWNED BY public.bookings.id;


--
-- Name: buildings; Type: TABLE; Schema: public; Owner: user
--

CREATE TABLE public.buildings (
    id integer NOT NULL,
    city_id integer NOT NULL,
    name character varying(255) NOT NULL,
    count_floor integer,
    open_at time without time zone NOT NULL,
    close_at time without time zone NOT NULL,
    address text NOT NULL
);


ALTER TABLE public.buildings OWNER TO "user";

--
-- Name: buildings_id_seq; Type: SEQUENCE; Schema: public; Owner: user
--

CREATE SEQUENCE public.buildings_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.buildings_id_seq OWNER TO "user";

--
-- Name: buildings_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: user
--

ALTER SEQUENCE public.buildings_id_seq OWNED BY public.buildings.id;


--
-- Name: city; Type: TABLE; Schema: public; Owner: user
--

CREATE TABLE public.city (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    timezone character varying(50) DEFAULT 'Europe/Moscow'::character varying NOT NULL
);


ALTER TABLE public.city OWNER TO "user";

--
-- Name: city_id_seq; Type: SEQUENCE; Schema: public; Owner: user
--

CREATE SEQUENCE public.city_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.city_id_seq OWNER TO "user";

--
-- Name: city_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: user
--

ALTER SEQUENCE public.city_id_seq OWNED BY public.city.id;


--
-- Name: objects; Type: TABLE; Schema: public; Owner: user
--

CREATE TABLE public.objects (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    type_id integer,
    from_at time without time zone,
    to_at time without time zone,
    floor_number integer,
    metadata character varying(255),
    is_hidden boolean DEFAULT false NOT NULL,
    capacity integer DEFAULT 1 NOT NULL,
    building_id integer NOT NULL
);


ALTER TABLE public.objects OWNER TO "user";

--
-- Name: objects_id_seq; Type: SEQUENCE; Schema: public; Owner: user
--

CREATE SEQUENCE public.objects_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.objects_id_seq OWNER TO "user";

--
-- Name: objects_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: user
--

ALTER SEQUENCE public.objects_id_seq OWNED BY public.objects.id;


--
-- Name: objects_types; Type: TABLE; Schema: public; Owner: user
--

CREATE TABLE public.objects_types (
    id integer NOT NULL,
    name character varying(255),
    min_slot integer NOT NULL,
    max_slot integer NOT NULL,
    slot_step integer NOT NULL
);


ALTER TABLE public.objects_types OWNER TO "user";

--
-- Name: objects_types_id_seq; Type: SEQUENCE; Schema: public; Owner: user
--

CREATE SEQUENCE public.objects_types_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.objects_types_id_seq OWNER TO "user";

--
-- Name: objects_types_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: user
--

ALTER SEQUENCE public.objects_types_id_seq OWNED BY public.objects_types.id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: user
--

CREATE TABLE public.users (
    id integer NOT NULL,
    is_super boolean DEFAULT false NOT NULL,
    phone character varying(255),
    password character varying(255) NOT NULL,
    first_name character varying(255) NOT NULL,
    last_name character varying(255) NOT NULL,
    email character varying(255) NOT NULL
);


ALTER TABLE public.users OWNER TO "user";

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: user
--

CREATE SEQUENCE public.users_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.users_id_seq OWNER TO "user";

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: user
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- Name: bookings id; Type: DEFAULT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.bookings ALTER COLUMN id SET DEFAULT nextval('public.bookings_id_seq'::regclass);


--
-- Name: buildings id; Type: DEFAULT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.buildings ALTER COLUMN id SET DEFAULT nextval('public.buildings_id_seq'::regclass);


--
-- Name: city id; Type: DEFAULT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.city ALTER COLUMN id SET DEFAULT nextval('public.city_id_seq'::regclass);


--
-- Name: objects id; Type: DEFAULT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.objects ALTER COLUMN id SET DEFAULT nextval('public.objects_id_seq'::regclass);


--
-- Name: objects_types id; Type: DEFAULT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.objects_types ALTER COLUMN id SET DEFAULT nextval('public.objects_types_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Data for Name: bookings; Type: TABLE DATA; Schema: public; Owner: user
--

COPY public.bookings (id, object_id, user_id, start_time, end_time, period_start_at, day_of_week, period_end_at, type, created_at) FROM stdin;
\.


--
-- Data for Name: buildings; Type: TABLE DATA; Schema: public; Owner: user
--

COPY public.buildings (id, city_id, name, count_floor, open_at, close_at, address) FROM stdin;
\.


--
-- Data for Name: city; Type: TABLE DATA; Schema: public; Owner: user
--

COPY public.city (id, name, timezone) FROM stdin;
\.


--
-- Data for Name: objects; Type: TABLE DATA; Schema: public; Owner: user
--

COPY public.objects (id, name, type_id, from_at, to_at, floor_number, metadata, is_hidden, capacity, building_id) FROM stdin;
\.


--
-- Data for Name: objects_types; Type: TABLE DATA; Schema: public; Owner: user
--

COPY public.objects_types (id, name, min_slot, max_slot, slot_step) FROM stdin;
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: user
--

COPY public.users (id, is_super, phone, password, first_name, last_name, email) FROM stdin;
\.


--
-- Name: bookings_id_seq; Type: SEQUENCE SET; Schema: public; Owner: user
--

SELECT pg_catalog.setval('public.bookings_id_seq', 1, false);


--
-- Name: buildings_id_seq; Type: SEQUENCE SET; Schema: public; Owner: user
--

SELECT pg_catalog.setval('public.buildings_id_seq', 1, false);


--
-- Name: city_id_seq; Type: SEQUENCE SET; Schema: public; Owner: user
--

SELECT pg_catalog.setval('public.city_id_seq', 1, false);


--
-- Name: objects_id_seq; Type: SEQUENCE SET; Schema: public; Owner: user
--

SELECT pg_catalog.setval('public.objects_id_seq', 1, false);


--
-- Name: objects_types_id_seq; Type: SEQUENCE SET; Schema: public; Owner: user
--

SELECT pg_catalog.setval('public.objects_types_id_seq', 1, false);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: user
--

SELECT pg_catalog.setval('public.users_id_seq', 1, false);


--
-- Name: bookings bookings_pkey; Type: CONSTRAINT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.bookings
    ADD CONSTRAINT bookings_pkey PRIMARY KEY (id);


--
-- Name: buildings buildings_pkey; Type: CONSTRAINT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.buildings
    ADD CONSTRAINT buildings_pkey PRIMARY KEY (id);


--
-- Name: city city_pkey; Type: CONSTRAINT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.city
    ADD CONSTRAINT city_pkey PRIMARY KEY (id);


--
-- Name: objects objects_pkey; Type: CONSTRAINT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.objects
    ADD CONSTRAINT objects_pkey PRIMARY KEY (id);


--
-- Name: objects_types objects_types_pkey; Type: CONSTRAINT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.objects_types
    ADD CONSTRAINT objects_types_pkey PRIMARY KEY (id);


--
-- Name: users users_email_key; Type: CONSTRAINT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_key UNIQUE (email);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: bookings bookings_object_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.bookings
    ADD CONSTRAINT bookings_object_id_fkey FOREIGN KEY (object_id) REFERENCES public.objects(id) ON DELETE CASCADE;


--
-- Name: bookings bookings_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.bookings
    ADD CONSTRAINT bookings_user_id_fkey FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- Name: buildings buildings_city_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.buildings
    ADD CONSTRAINT buildings_city_id_fkey FOREIGN KEY (city_id) REFERENCES public.city(id) ON DELETE CASCADE;


--
-- Name: objects objects_building_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.objects
    ADD CONSTRAINT objects_building_id_fkey FOREIGN KEY (building_id) REFERENCES public.buildings(id) ON DELETE CASCADE;


--
-- Name: objects objects_type_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.objects
    ADD CONSTRAINT objects_type_id_fkey FOREIGN KEY (type_id) REFERENCES public.objects_types(id) ON DELETE SET NULL;


--
-- PostgreSQL database dump complete
--

\unrestrict VorK6ynMz8pRQYYy3vpCKQQWE4qQ9wXdyHY8O4YOFaRb6tRyvGsWjOdYKUpH1PE

