PROCEDURES

cancelrent(IN carid integer, IN userid integer)
DECLARE
rentalRow rentals%ROWTYPE;
	carRow cars%ROWTYPE;
BEGIN

SELECT * INTO rentalRow FROM rentals WHERE user_id = userid AND car_id = carid;
SELECT * INTO carRow FROM cars WHERE id=carid;

IF rentalRow IS NOT NULL AND carRow IS NOT NULL THEN
UPDATE rentals SET status='Completed' WHERE car_id = carid;
UPDATE cars SET status='Available' WHERE id = carid;
END IF;

COMMIT;
END;

delete_car(IN carid integer)
BEGIN
DELETE FROM cars WHERE cars.id = carid;
END;

delete_user(IN userid integer)
BEGIN
DELETE FROM users WHERE users.id = userId;
END;

rentcar(IN userid integer, IN carid integer, IN startdate character varying, IN enddate character varying, IN totalcost integer, IN status character varying)
DECLARE
carRow cars%ROWTYPE;
BEGIN

SELECT * INTO carRow FROM cars WHERE id=carid;

IF carRow IS NOT NULL THEN
INSERT INTO rentals (user_id, car_id, start_date,end_date,total_cost,status) VALUES (userid, carid, startdate::timestamp,enddate::timestamp,totalcost,status);
UPDATE cars SET status='Rented' WHERE id = carid;
END IF;

COMMIT;
END;

VIEWS

v_cars_cities
SELECT cars.id,
       cars.brand,
       cars.model,
       cars.price,
       cars.status,
       cars.image,
       cities.name AS city_name
FROM cars
         LEFT JOIN cars_cities ON cars.id = cars_cities.carid
         LEFT JOIN cities ON cars_cities.cityid = cities.id;

v_cars_rentals
SELECT cars.id,
       cars.brand,
       cars.model,
       cars.image,
       rentals.user_id,
       rentals.car_id,
       rentals.start_date,
       rentals.end_date,
       rentals.status
FROM cars
         LEFT JOIN rentals ON cars.id = rentals.car_id;

v_faqs
SELECT faq.id,
       faq.question,
       faq.answer
FROM faq;

v_user_rentals
SELECT rentals.rental_id,
       rentals.user_id,
       rentals.car_id,
       rentals.start_date,
       rentals.end_date,
       rentals.total_cost,
       rentals.status
FROM rentals
WHERE rentals.user_id = 17 AND rentals.status::text = 'Active'::text;

TABLES

CARS
CREATE TABLE IF NOT EXISTS public.cars
(
    id integer NOT NULL DEFAULT nextval('cars_id_seq'::regclass),
    brand character varying(63) COLLATE pg_catalog."default" NOT NULL,
    model character varying(63) COLLATE pg_catalog."default" NOT NULL,
    price integer NOT NULL,
    status character varying(20) COLLATE pg_catalog."default",
    image character varying(255) COLLATE pg_catalog."default",
    CONSTRAINT cars_pkey PRIMARY KEY (id)
    )

CARS_CITIES
CREATE TABLE IF NOT EXISTS public.cars_cities
(
    id integer NOT NULL DEFAULT nextval('cars_cities_id_seq'::regclass),
    carid integer NOT NULL DEFAULT nextval('cars_cities_carid_seq'::regclass),
    cityid integer NOT NULL DEFAULT nextval('cars_cities_cityid_seq'::regclass),
    CONSTRAINT cars_cities_pkey PRIMARY KEY (id),
    CONSTRAINT cars FOREIGN KEY (carid)
    REFERENCES public.cars (id) MATCH SIMPLE
    ON UPDATE NO ACTION
    ON DELETE CASCADE,
    CONSTRAINT cities FOREIGN KEY (cityid)
    REFERENCES public.cities (id) MATCH SIMPLE
    ON UPDATE NO ACTION
    ON DELETE NO ACTION
    )

CITIES
CREATE TABLE IF NOT EXISTS public.cities
(
    id integer NOT NULL DEFAULT nextval('cities_id_seq'::regclass),
    name character varying(63) COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT cities_pkey PRIMARY KEY (id)
    )

FAQ
CREATE TABLE IF NOT EXISTS public.faq
(
    id integer NOT NULL DEFAULT nextval('faq_id_seq'::regclass),
    question character varying(255) COLLATE pg_catalog."default",
    answer character varying(255) COLLATE pg_catalog."default",
    CONSTRAINT faq_pkey PRIMARY KEY (id)
    )

RENTALS
CREATE TABLE IF NOT EXISTS public.rentals
(
    rental_id integer NOT NULL DEFAULT nextval('rentals_rental_id_seq'::regclass),
    user_id integer NOT NULL DEFAULT nextval('rentals_user_id_seq'::regclass),
    car_id integer NOT NULL DEFAULT nextval('rentals_car_id_seq'::regclass),
    start_date date,
    end_date date,
    total_cost integer,
    status character varying(20) COLLATE pg_catalog."default",
    CONSTRAINT rentals_pkey PRIMARY KEY (rental_id),
    CONSTRAINT fk_car FOREIGN KEY (car_id)
    REFERENCES public.cars (id) MATCH SIMPLE
    ON UPDATE NO ACTION
    ON DELETE CASCADE,
    CONSTRAINT fk_user FOREIGN KEY (user_id)
    REFERENCES public.users (id) MATCH SIMPLE
    ON UPDATE NO ACTION
    ON DELETE CASCADE
    )

TESTIMONIALS
CREATE TABLE IF NOT EXISTS public.testimonials
(
    id integer NOT NULL DEFAULT nextval('testimonials_id_seq'::regclass),
    name character varying(63) COLLATE pg_catalog."default" NOT NULL,
    surname character varying(63) COLLATE pg_catalog."default" NOT NULL,
    place character varying(63) COLLATE pg_catalog."default" NOT NULL,
    opinion character varying(255) COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT testimonials_pkey PRIMARY KEY (id)
    )

USERS
CREATE TABLE IF NOT EXISTS public.users
(
    id integer NOT NULL DEFAULT nextval('users_id_seq'::regclass),
    username character varying(63) COLLATE pg_catalog."default" NOT NULL,
    email character varying(63) COLLATE pg_catalog."default" NOT NULL,
    password character varying(255) COLLATE pg_catalog."default" NOT NULL,
    user_role character varying(10) COLLATE pg_catalog."default",
    CONSTRAINT users_pkey PRIMARY KEY (id),
    CONSTRAINT users_email_key UNIQUE (email),
    CONSTRAINT users_username_key UNIQUE (username)
    )