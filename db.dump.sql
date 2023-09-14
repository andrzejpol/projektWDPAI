PGDMP     &    6    	            {            carrent    15.4 (Debian 15.4-1.pgdg120+1)    15.4 T    }           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            ~           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false                       0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            �           1262    16384    carrent    DATABASE     r   CREATE DATABASE carrent WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'en_US.utf8';
    DROP DATABASE carrent;
                admin    false            �            1255    16586    cancelrent(integer, integer) 	   PROCEDURE     �  CREATE PROCEDURE public.cancelrent(IN carid integer, IN userid integer)
    LANGUAGE plpgsql
    AS $$
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
END;$$;
 G   DROP PROCEDURE public.cancelrent(IN carid integer, IN userid integer);
       public          admin    false            �            1255    16475    delete_car(integer) 	   PROCEDURE     �   CREATE PROCEDURE public.delete_car(IN carid integer)
    LANGUAGE plpgsql
    AS $$BEGIN
	DELETE FROM cars WHERE cars.id = carid;
END;$$;
 4   DROP PROCEDURE public.delete_car(IN carid integer);
       public          admin    false            �            1255    16471    delete_user(integer) 	   PROCEDURE     �   CREATE PROCEDURE public.delete_user(IN userid integer)
    LANGUAGE plpgsql
    AS $$
BEGIN
	DELETE FROM users WHERE users.id = userId;
END;
$$;
 6   DROP PROCEDURE public.delete_user(IN userid integer);
       public          admin    false            �            1255    16588 [   rentcar(integer, integer, character varying, character varying, integer, character varying) 	   PROCEDURE     1  CREATE PROCEDURE public.rentcar(IN userid integer, IN carid integer, IN startdate character varying, IN enddate character varying, IN totalcost integer, IN status character varying)
    LANGUAGE plpgsql
    AS $$
DECLARE 
	carRow cars%ROWTYPE;
BEGIN

SELECT * INTO carRow FROM cars WHERE id=carid;

IF carRow IS NOT NULL THEN 
INSERT INTO rentals (user_id, car_id, start_date,end_date,total_cost,status) VALUES (userid, carid, startdate::timestamp,enddate::timestamp,totalcost,status);
UPDATE cars SET status='Rented' WHERE id = carid;
END IF;

COMMIT;
END;$$;
 �   DROP PROCEDURE public.rentcar(IN userid integer, IN carid integer, IN startdate character varying, IN enddate character varying, IN totalcost integer, IN status character varying);
       public          admin    false            �            1259    16413    cars    TABLE     �   CREATE TABLE public.cars (
    id integer NOT NULL,
    brand character varying(63) NOT NULL,
    model character varying(63) NOT NULL,
    price integer NOT NULL,
    status character varying(20),
    image character varying(255)
);
    DROP TABLE public.cars;
       public         heap    admin    false            �            1259    16507    cars_cities    TABLE     v   CREATE TABLE public.cars_cities (
    id integer NOT NULL,
    carid integer NOT NULL,
    cityid integer NOT NULL
);
    DROP TABLE public.cars_cities;
       public         heap    admin    false            �            1259    16505    cars_cities_carid_seq    SEQUENCE     �   CREATE SEQUENCE public.cars_cities_carid_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.cars_cities_carid_seq;
       public          admin    false    229            �           0    0    cars_cities_carid_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE public.cars_cities_carid_seq OWNED BY public.cars_cities.carid;
          public          admin    false    227            �            1259    16506    cars_cities_cityid_seq    SEQUENCE     �   CREATE SEQUENCE public.cars_cities_cityid_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 -   DROP SEQUENCE public.cars_cities_cityid_seq;
       public          admin    false    229            �           0    0    cars_cities_cityid_seq    SEQUENCE OWNED BY     Q   ALTER SEQUENCE public.cars_cities_cityid_seq OWNED BY public.cars_cities.cityid;
          public          admin    false    228            �            1259    16504    cars_cities_id_seq    SEQUENCE     �   CREATE SEQUENCE public.cars_cities_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.cars_cities_id_seq;
       public          admin    false    229            �           0    0    cars_cities_id_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.cars_cities_id_seq OWNED BY public.cars_cities.id;
          public          admin    false    226            �            1259    16412    cars_id_seq    SEQUENCE     �   CREATE SEQUENCE public.cars_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 "   DROP SEQUENCE public.cars_id_seq;
       public          admin    false    217            �           0    0    cars_id_seq    SEQUENCE OWNED BY     ;   ALTER SEQUENCE public.cars_id_seq OWNED BY public.cars.id;
          public          admin    false    216            �            1259    16427    cities    TABLE     a   CREATE TABLE public.cities (
    id integer NOT NULL,
    name character varying(63) NOT NULL
);
    DROP TABLE public.cities;
       public         heap    admin    false            �            1259    16426    cities_id_seq    SEQUENCE     �   CREATE SEQUENCE public.cities_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 $   DROP SEQUENCE public.cities_id_seq;
       public          admin    false    221            �           0    0    cities_id_seq    SEQUENCE OWNED BY     ?   ALTER SEQUENCE public.cities_id_seq OWNED BY public.cities.id;
          public          admin    false    220            �            1259    16530    faq    TABLE     }   CREATE TABLE public.faq (
    id integer NOT NULL,
    question character varying(255),
    answer character varying(255)
);
    DROP TABLE public.faq;
       public         heap    admin    false            �            1259    16529 
   faq_id_seq    SEQUENCE     �   CREATE SEQUENCE public.faq_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 !   DROP SEQUENCE public.faq_id_seq;
       public          admin    false    232            �           0    0 
   faq_id_seq    SEQUENCE OWNED BY     9   ALTER SEQUENCE public.faq_id_seq OWNED BY public.faq.id;
          public          admin    false    231            �            1259    16443    rentals    TABLE     �   CREATE TABLE public.rentals (
    rental_id integer NOT NULL,
    user_id integer NOT NULL,
    car_id integer NOT NULL,
    start_date date,
    end_date date,
    total_cost integer,
    status character varying(20)
);
    DROP TABLE public.rentals;
       public         heap    admin    false            �            1259    16442    rentals_car_id_seq    SEQUENCE     �   CREATE SEQUENCE public.rentals_car_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.rentals_car_id_seq;
       public          admin    false    225            �           0    0    rentals_car_id_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.rentals_car_id_seq OWNED BY public.rentals.car_id;
          public          admin    false    224            �            1259    16440    rentals_rental_id_seq    SEQUENCE     �   CREATE SEQUENCE public.rentals_rental_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.rentals_rental_id_seq;
       public          admin    false    225            �           0    0    rentals_rental_id_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE public.rentals_rental_id_seq OWNED BY public.rentals.rental_id;
          public          admin    false    222            �            1259    16441    rentals_user_id_seq    SEQUENCE     �   CREATE SEQUENCE public.rentals_user_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE public.rentals_user_id_seq;
       public          admin    false    225            �           0    0    rentals_user_id_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE public.rentals_user_id_seq OWNED BY public.rentals.user_id;
          public          admin    false    223            �            1259    16420    testimonials    TABLE     �   CREATE TABLE public.testimonials (
    id integer NOT NULL,
    name character varying(63) NOT NULL,
    surname character varying(63) NOT NULL,
    place character varying(63) NOT NULL,
    opinion character varying(255) NOT NULL
);
     DROP TABLE public.testimonials;
       public         heap    admin    false            �            1259    16419    testimonials_id_seq    SEQUENCE     �   CREATE SEQUENCE public.testimonials_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE public.testimonials_id_seq;
       public          admin    false    219            �           0    0    testimonials_id_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE public.testimonials_id_seq OWNED BY public.testimonials.id;
          public          admin    false    218            �            1259    16402    users    TABLE     �   CREATE TABLE public.users (
    id integer NOT NULL,
    username character varying(63) NOT NULL,
    email character varying(63) NOT NULL,
    password character varying(255) NOT NULL,
    user_role character varying(10)
);
    DROP TABLE public.users;
       public         heap    admin    false            �            1259    16401    users_id_seq    SEQUENCE     �   CREATE SEQUENCE public.users_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.users_id_seq;
       public          admin    false    215            �           0    0    users_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;
          public          admin    false    214            �            1259    16525    v_cars_cities    VIEW     D  CREATE VIEW public.v_cars_cities AS
 SELECT cars.id,
    cars.brand,
    cars.model,
    cars.price,
    cars.status,
    cars.image,
    cities.name AS city_name
   FROM ((public.cars
     LEFT JOIN public.cars_cities ON ((cars.id = cars_cities.carid)))
     LEFT JOIN public.cities ON ((cars_cities.cityid = cities.id)));
     DROP VIEW public.v_cars_cities;
       public          admin    false    221    229    229    221    217    217    217    217    217    217            �            1259    16577    v_cars_rentals    VIEW     %  CREATE VIEW public.v_cars_rentals AS
 SELECT cars.id,
    cars.brand,
    cars.model,
    cars.image,
    rentals.user_id,
    rentals.car_id,
    rentals.start_date,
    rentals.end_date,
    rentals.status
   FROM (public.cars
     LEFT JOIN public.rentals ON ((cars.id = rentals.car_id)));
 !   DROP VIEW public.v_cars_rentals;
       public          admin    false    217    217    217    217    225    225    225    225    225            �            1259    16538    v_faqs    VIEW     b   CREATE VIEW public.v_faqs AS
 SELECT faq.id,
    faq.question,
    faq.answer
   FROM public.faq;
    DROP VIEW public.v_faqs;
       public          admin    false    232    232    232            �            1259    16573    v_user_rentals    VIEW     )  CREATE VIEW public.v_user_rentals AS
 SELECT rentals.rental_id,
    rentals.user_id,
    rentals.car_id,
    rentals.start_date,
    rentals.end_date,
    rentals.total_cost,
    rentals.status
   FROM public.rentals
  WHERE ((rentals.user_id = 17) AND ((rentals.status)::text = 'Active'::text));
 !   DROP VIEW public.v_user_rentals;
       public          admin    false    225    225    225    225    225    225    225            �           2604    16416    cars id    DEFAULT     b   ALTER TABLE ONLY public.cars ALTER COLUMN id SET DEFAULT nextval('public.cars_id_seq'::regclass);
 6   ALTER TABLE public.cars ALTER COLUMN id DROP DEFAULT;
       public          admin    false    217    216    217            �           2604    16510    cars_cities id    DEFAULT     p   ALTER TABLE ONLY public.cars_cities ALTER COLUMN id SET DEFAULT nextval('public.cars_cities_id_seq'::regclass);
 =   ALTER TABLE public.cars_cities ALTER COLUMN id DROP DEFAULT;
       public          admin    false    226    229    229            �           2604    16511    cars_cities carid    DEFAULT     v   ALTER TABLE ONLY public.cars_cities ALTER COLUMN carid SET DEFAULT nextval('public.cars_cities_carid_seq'::regclass);
 @   ALTER TABLE public.cars_cities ALTER COLUMN carid DROP DEFAULT;
       public          admin    false    229    227    229            �           2604    16512    cars_cities cityid    DEFAULT     x   ALTER TABLE ONLY public.cars_cities ALTER COLUMN cityid SET DEFAULT nextval('public.cars_cities_cityid_seq'::regclass);
 A   ALTER TABLE public.cars_cities ALTER COLUMN cityid DROP DEFAULT;
       public          admin    false    228    229    229            �           2604    16430 	   cities id    DEFAULT     f   ALTER TABLE ONLY public.cities ALTER COLUMN id SET DEFAULT nextval('public.cities_id_seq'::regclass);
 8   ALTER TABLE public.cities ALTER COLUMN id DROP DEFAULT;
       public          admin    false    221    220    221            �           2604    16533    faq id    DEFAULT     `   ALTER TABLE ONLY public.faq ALTER COLUMN id SET DEFAULT nextval('public.faq_id_seq'::regclass);
 5   ALTER TABLE public.faq ALTER COLUMN id DROP DEFAULT;
       public          admin    false    232    231    232            �           2604    16446    rentals rental_id    DEFAULT     v   ALTER TABLE ONLY public.rentals ALTER COLUMN rental_id SET DEFAULT nextval('public.rentals_rental_id_seq'::regclass);
 @   ALTER TABLE public.rentals ALTER COLUMN rental_id DROP DEFAULT;
       public          admin    false    222    225    225            �           2604    16447    rentals user_id    DEFAULT     r   ALTER TABLE ONLY public.rentals ALTER COLUMN user_id SET DEFAULT nextval('public.rentals_user_id_seq'::regclass);
 >   ALTER TABLE public.rentals ALTER COLUMN user_id DROP DEFAULT;
       public          admin    false    225    223    225            �           2604    16448    rentals car_id    DEFAULT     p   ALTER TABLE ONLY public.rentals ALTER COLUMN car_id SET DEFAULT nextval('public.rentals_car_id_seq'::regclass);
 =   ALTER TABLE public.rentals ALTER COLUMN car_id DROP DEFAULT;
       public          admin    false    224    225    225            �           2604    16423    testimonials id    DEFAULT     r   ALTER TABLE ONLY public.testimonials ALTER COLUMN id SET DEFAULT nextval('public.testimonials_id_seq'::regclass);
 >   ALTER TABLE public.testimonials ALTER COLUMN id DROP DEFAULT;
       public          admin    false    219    218    219            �           2604    16405    users id    DEFAULT     d   ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);
 7   ALTER TABLE public.users ALTER COLUMN id DROP DEFAULT;
       public          admin    false    215    214    215            l          0    16413    cars 
   TABLE DATA           F   COPY public.cars (id, brand, model, price, status, image) FROM stdin;
    public          admin    false    217   �a       x          0    16507    cars_cities 
   TABLE DATA           8   COPY public.cars_cities (id, carid, cityid) FROM stdin;
    public          admin    false    229   �a       p          0    16427    cities 
   TABLE DATA           *   COPY public.cities (id, name) FROM stdin;
    public          admin    false    221   b       z          0    16530    faq 
   TABLE DATA           3   COPY public.faq (id, question, answer) FROM stdin;
    public          admin    false    232   1b       t          0    16443    rentals 
   TABLE DATA           g   COPY public.rentals (rental_id, user_id, car_id, start_date, end_date, total_cost, status) FROM stdin;
    public          admin    false    225   tf       n          0    16420    testimonials 
   TABLE DATA           I   COPY public.testimonials (id, name, surname, place, opinion) FROM stdin;
    public          admin    false    219   �f       j          0    16402    users 
   TABLE DATA           I   COPY public.users (id, username, email, password, user_role) FROM stdin;
    public          admin    false    215   �f       �           0    0    cars_cities_carid_seq    SEQUENCE SET     D   SELECT pg_catalog.setval('public.cars_cities_carid_seq', 1, false);
          public          admin    false    227            �           0    0    cars_cities_cityid_seq    SEQUENCE SET     E   SELECT pg_catalog.setval('public.cars_cities_cityid_seq', 1, false);
          public          admin    false    228            �           0    0    cars_cities_id_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public.cars_cities_id_seq', 3, true);
          public          admin    false    226            �           0    0    cars_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('public.cars_id_seq', 22, true);
          public          admin    false    216            �           0    0    cities_id_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('public.cities_id_seq', 4, true);
          public          admin    false    220            �           0    0 
   faq_id_seq    SEQUENCE SET     9   SELECT pg_catalog.setval('public.faq_id_seq', 10, true);
          public          admin    false    231            �           0    0    rentals_car_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.rentals_car_id_seq', 1, false);
          public          admin    false    224            �           0    0    rentals_rental_id_seq    SEQUENCE SET     D   SELECT pg_catalog.setval('public.rentals_rental_id_seq', 18, true);
          public          admin    false    222            �           0    0    rentals_user_id_seq    SEQUENCE SET     B   SELECT pg_catalog.setval('public.rentals_user_id_seq', 1, false);
          public          admin    false    223            �           0    0    testimonials_id_seq    SEQUENCE SET     B   SELECT pg_catalog.setval('public.testimonials_id_seq', 1, false);
          public          admin    false    218            �           0    0    users_id_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('public.users_id_seq', 19, true);
          public          admin    false    214            �           2606    16514    cars_cities cars_cities_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.cars_cities
    ADD CONSTRAINT cars_cities_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.cars_cities DROP CONSTRAINT cars_cities_pkey;
       public            admin    false    229            �           2606    16418    cars cars_pkey 
   CONSTRAINT     L   ALTER TABLE ONLY public.cars
    ADD CONSTRAINT cars_pkey PRIMARY KEY (id);
 8   ALTER TABLE ONLY public.cars DROP CONSTRAINT cars_pkey;
       public            admin    false    217            �           2606    16432    cities cities_pkey 
   CONSTRAINT     P   ALTER TABLE ONLY public.cities
    ADD CONSTRAINT cities_pkey PRIMARY KEY (id);
 <   ALTER TABLE ONLY public.cities DROP CONSTRAINT cities_pkey;
       public            admin    false    221            �           2606    16537    faq faq_pkey 
   CONSTRAINT     J   ALTER TABLE ONLY public.faq
    ADD CONSTRAINT faq_pkey PRIMARY KEY (id);
 6   ALTER TABLE ONLY public.faq DROP CONSTRAINT faq_pkey;
       public            admin    false    232            �           2606    16450    rentals rentals_pkey 
   CONSTRAINT     Y   ALTER TABLE ONLY public.rentals
    ADD CONSTRAINT rentals_pkey PRIMARY KEY (rental_id);
 >   ALTER TABLE ONLY public.rentals DROP CONSTRAINT rentals_pkey;
       public            admin    false    225            �           2606    16425    testimonials testimonials_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.testimonials
    ADD CONSTRAINT testimonials_pkey PRIMARY KEY (id);
 H   ALTER TABLE ONLY public.testimonials DROP CONSTRAINT testimonials_pkey;
       public            admin    false    219            �           2606    16411    users users_email_key 
   CONSTRAINT     Q   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_key UNIQUE (email);
 ?   ALTER TABLE ONLY public.users DROP CONSTRAINT users_email_key;
       public            admin    false    215            �           2606    16407    users users_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.users DROP CONSTRAINT users_pkey;
       public            admin    false    215            �           2606    16409    users users_username_key 
   CONSTRAINT     W   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_username_key UNIQUE (username);
 B   ALTER TABLE ONLY public.users DROP CONSTRAINT users_username_key;
       public            admin    false    215            �           1259    16547 	   fki_users    INDEX     @   CREATE INDEX fki_users ON public.rentals USING btree (user_id);
    DROP INDEX public.fki_users;
       public            admin    false    225            �           2606    16590    cars_cities cars    FK CONSTRAINT     ~   ALTER TABLE ONLY public.cars_cities
    ADD CONSTRAINT cars FOREIGN KEY (carid) REFERENCES public.cars(id) ON DELETE CASCADE;
 :   ALTER TABLE ONLY public.cars_cities DROP CONSTRAINT cars;
       public          admin    false    229    3271    217            �           2606    16520    cars_cities cities    FK CONSTRAINT     q   ALTER TABLE ONLY public.cars_cities
    ADD CONSTRAINT cities FOREIGN KEY (cityid) REFERENCES public.cities(id);
 <   ALTER TABLE ONLY public.cars_cities DROP CONSTRAINT cities;
       public          admin    false    3275    221    229            �           2606    16595    rentals fk_car    FK CONSTRAINT     }   ALTER TABLE ONLY public.rentals
    ADD CONSTRAINT fk_car FOREIGN KEY (car_id) REFERENCES public.cars(id) ON DELETE CASCADE;
 8   ALTER TABLE ONLY public.rentals DROP CONSTRAINT fk_car;
       public          admin    false    225    217    3271            �           2606    16600    rentals fk_user    FK CONSTRAINT     �   ALTER TABLE ONLY public.rentals
    ADD CONSTRAINT fk_user FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;
 9   ALTER TABLE ONLY public.rentals DROP CONSTRAINT fk_user;
       public          admin    false    215    3267    225            l   >   x�34�t�L,��,��420�t,K��IL�I�L����s@Ԕ��pcS���� {��      x      x������ � �      p      x�3�t.JL�/�2�O,*N,����� N�
      z   3  x��V�n�6<�����0���d{�!�r��zQ%�р�o0�3��m���jI�������h(��U]]������׏�}{�g��_r\���W䳨�O��9�fx���pˊkK���z�/7��"��]|%ʖ�����o5���\�"�X���K�ŀ��m��ƫ )�ۥ�����ˮ���w�<uH�5-#�4y��,Nϸ��Q���ܐ�KSQy-\��'l:-臇�x�K ��,RJAV����ú�~���h�rHY�M�{23gU��Um�jΫ>M��\q���";VG;d�x��-��6���y>U�|�|���	�#�-Zp\�Z���)���E=��[ʗĻ%8�v��T:���!;����)��;lPVqWX��9�4�a��Rkw";OMCê�=��P��x�t���F(�í������o*î#��v\|Ed��j�P�
���~x�1[��Z��LJg�3�*�TPrS���Q�¸ T\B�x(Z[�>M~<��Q�kN@sk}��(2�?i2jl�\��+�&��t\���4�R��^Q�ܝ)��׏��������c,��; ��p�c/U|��XC8M���+����o�����.��r�aL���3z���]cі���$d5�ƥ0r�ڮ���v�NT�3�e��(�G�r���4��H�v-}~�Ԧ�ϯ�-d �+񸬟w�������®i�I}f&���vѧ�y�9���|�曔� c.&G�]8U�T}����z,��z@K�_Vu;:��*TES�ӱ1n��?�!��n�6��a�4{zh+� �ElTh��B���.B�����lPp� ݒ]e��:e�I4�5�>�y��:VָNƓ�%��[H|Na)�S'~m�T���W�'���#�q�B�R&Tf��h�'A����^�
��*�C�������Nv�!��΢{�hs	9M�ix�=���pfLKk���w�<��F�����}v��o/�ܮZ����s��,ʩ�w`���!�\��y�:q���TʰbL�8�&e�@�@�\&$�?^�,�����R��3d��5'��9M�N�$��g�V      t   D   x�34�4��44�4202�5��54A0�8M8��srRKRS����"�CSlRld�U1��1z\\\ ��?      n      x������ � �      j   �   x�5̹�0 ��}�j��h���H\�]�0���5.߿��Df�1���+(�(�Pԗ��ʣ���:]8e�2�z@��˧���М7�.�8��w-Jv@�Y.;�@2�$�ݯ������擄_6�O�h�>��cZ�d��Z���-��p�H�4�S�{�+����<�     