/*
 Navicat Premium Data Transfer

 Source Server         : dbname
 Source Server Type    : PostgreSQL
 Source Server Version : 150001 (150001)
 Source Host           : localhost:5432
 Source Catalog        : dbname
 Source Schema         : public

 Target Server Type    : PostgreSQL
 Target Server Version : 150001 (150001)
 File Encoding         : 65001

 Date: 10/02/2023 14:52:52
*/


-- ----------------------------
-- Sequence structure for roles_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."roles_id_seq";
CREATE SEQUENCE "public"."roles_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Table structure for authors
-- ----------------------------
DROP TABLE IF EXISTS "public"."authors";
CREATE TABLE "public"."authors" (
  "id" int4 NOT NULL DEFAULT nextval('roles_id_seq'::regclass),
  "author" varchar(200) COLLATE "pg_catalog"."default" NOT NULL
)
;

-- ----------------------------
-- Records of authors
-- ----------------------------
INSERT INTO "public"."authors" VALUES (1, 'George R.R Martin');
INSERT INTO "public"."authors" VALUES (2, 'Andrzej Sapkowski');
INSERT INTO "public"."authors" VALUES (3, 'Jacek Dukaj');
INSERT INTO "public"."authors" VALUES (4, 'Daniel Keyes');
INSERT INTO "public"."authors" VALUES (5, 'Remigiusz Mróz');
INSERT INTO "public"."authors" VALUES (6, 'Katarzyna Bonda');
INSERT INTO "public"."authors" VALUES (7, 'Piotr Kościelny');
INSERT INTO "public"."authors" VALUES (8, 'John Ronald Reuel Tolkien');
INSERT INTO "public"."authors" VALUES (9, 'Stanisław Lem');

-- ----------------------------
-- Table structure for book_author
-- ----------------------------
DROP TABLE IF EXISTS "public"."book_author";
CREATE TABLE "public"."book_author" (
  "book_id" int4 NOT NULL,
  "author_id" int4 NOT NULL
)
;

-- ----------------------------
-- Records of book_author
-- ----------------------------
INSERT INTO "public"."book_author" VALUES (1, 1);
INSERT INTO "public"."book_author" VALUES (2, 3);
INSERT INTO "public"."book_author" VALUES (3, 5);
INSERT INTO "public"."book_author" VALUES (4, 6);
INSERT INTO "public"."book_author" VALUES (5, 7);
INSERT INTO "public"."book_author" VALUES (6, 2);
INSERT INTO "public"."book_author" VALUES (7, 8);
INSERT INTO "public"."book_author" VALUES (8, 9);
INSERT INTO "public"."book_author" VALUES (9, 4);

-- ----------------------------
-- Table structure for book_borrows
-- ----------------------------
DROP TABLE IF EXISTS "public"."book_borrows";
CREATE TABLE "public"."book_borrows" (
  "id" int4 NOT NULL DEFAULT nextval('roles_id_seq'::regclass),
  "start_time" timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  "end_time" timestamp(0),
  "return_time" timestamp(0),
  "user_id" int4 NOT NULL,
  "book_id" int4 NOT NULL
)
;

-- ----------------------------
-- Records of book_borrows
-- ----------------------------
INSERT INTO "public"."book_borrows" VALUES (43, '2023-02-10 12:44:30', '2023-03-10 12:44:30', '2023-02-10 12:44:34', 2, 1);
INSERT INTO "public"."book_borrows" VALUES (50, '2023-02-10 13:15:54', '2023-03-10 13:15:54', '2023-02-10 13:15:59', 2, 1);
INSERT INTO "public"."book_borrows" VALUES (51, '2023-02-10 13:47:44', '2023-03-10 13:47:44', '2023-02-10 13:47:59', 2, 6);
INSERT INTO "public"."book_borrows" VALUES (52, '2023-02-10 13:47:52', '2023-03-10 13:47:52', '2023-02-10 13:47:59', 2, 1);
INSERT INTO "public"."book_borrows" VALUES (53, '2023-02-10 13:49:17', '2023-03-10 13:49:17', '2023-02-10 13:49:23', 2, 5);
INSERT INTO "public"."book_borrows" VALUES (54, '2023-02-10 13:49:19', '2023-03-10 13:49:19', '2023-02-10 13:49:23', 2, 2);

-- ----------------------------
-- Table structure for books
-- ----------------------------
DROP TABLE IF EXISTS "public"."books";
CREATE TABLE "public"."books" (
  "id" int4 NOT NULL DEFAULT nextval('roles_id_seq'::regclass),
  "isbn" varchar(13) COLLATE "pg_catalog"."default" NOT NULL,
  "category_id" int4 NOT NULL,
  "title" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "description" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "free_books_number" int4 NOT NULL,
  "image" varchar(50) COLLATE "pg_catalog"."default" NOT NULL,
  "like" int4 NOT NULL DEFAULT 0,
  "dislike" int4 NOT NULL DEFAULT 0
)
;

-- ----------------------------
-- Records of books
-- ----------------------------
INSERT INTO "public"."books" VALUES (4, '1344377395', 2, 'Do cna', 'Spowite mrokiem miasto budzi zwierzęce instynkty. Bez śladu znika młody mężczyzna, a w parku porzucono reklamówki pełne ugotowanych ludzkich kości.', 40, 'docna.jpg', 1, 0);
INSERT INTO "public"."books" VALUES (3, '1355289449', 2, 'Kabalista', 'Półtora roku po tym, jak Małgorzata Rosa wyjechała do Warszawy, szefostwo stacji telewizyjnej chce, by dziennikarka wróciła do rodzinnego miasta. Ma przygotować materiał na temat ofiary gwałtu, której opolska prokuratura odmówiła pomocy.', 25, 'kabalista.jpg', 0, 0);
INSERT INTO "public"."books" VALUES (5, '1354802085', 2, 'Pokot', 'We Wrocławiu grasuje kolejny seryjny zabójca. Tym razem za cel bierze dzieci. Śledczy starają się złapać sprawcę, zanim w mieście wybuchnie panika, a media znów znajdą pożywkę. ', 27, 'pokot.jpg', 0, 0);
INSERT INTO "public"."books" VALUES (6, '1102239921', 1, 'Ostatnie życzenie', 'W pierwszym tomie sagi pod tytułem „Ostatnie życzenie” poznasz początek historii Geralta z Rivii i wraz z nim wyruszysz w świat przygód.', 50, 'ostatniezyczenie.jpg', 0, 0);
INSERT INTO "public"."books" VALUES (7, '1316777121', 1, 'Hobbit', 'Pasjonująca powieść fantastyczno-przygodowa, opowiadająca o wydarzeniach, które stają się udziałem tytułowego bohatera – Bilba Bagginsa.', 45, 'hobbit.jpg', 0, 0);
INSERT INTO "public"."books" VALUES (9, '1223076786', 3, 'Kwiaty dla Algernona', 'waj naukowcy z tej uczelni, doktor Nemur i doktor Strauss, prowadzą badania nad wzrostem inteligencji. Udało im się już za pomocą zabiegu chirurgicznego zwiększyć zdolności umysłowe myszy o imieniu Algernon.', 55, 'algernon.jpg', 0, 0);
INSERT INTO "public"."books" VALUES (1, '1312524451', 1, 'Ogień i krew', '300 lat przed wydarzeniami opisanymi w "Grze o tron", kiedy Westeros rządziły smoki…', 20, 'book.jpg', 100, 44);
INSERT INTO "public"."books" VALUES (8, '1047478199', 3, 'Solaris', 'W książce Stanisław Lem podejmuje jeden z najpopularniejszych tematów literatury fantastycznej - czyli kontaktu, z obcą cywilizacją, odmienną formą życia, i nieznanym.', 35, 'solaris.jpg', 1, 0);
INSERT INTO "public"."books" VALUES (2, '1179989037', 3, 'Katedra', 'Planetoidy w układzie gwiazdy Lévie. Wypadek zmusza holownik „Sagittarius” do schronienia się na jednej z nich. Zapasów tlenu nie starczy jednak dla wszystkich. Izmir Predú poświęca się, by reszta załogi holownika przeżyła.', 30, 'katedra.jpg', 0, 0);

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS "public"."categories";
CREATE TABLE "public"."categories" (
  "id" int4 NOT NULL,
  "category_name" varchar(50) COLLATE "pg_catalog"."default" NOT NULL
)
;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO "public"."categories" VALUES (1, 'Fantasy');
INSERT INTO "public"."categories" VALUES (2, 'Kryminal');
INSERT INTO "public"."categories" VALUES (3, 'Science-fiction');

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS "public"."roles";
CREATE TABLE "public"."roles" (
  "id" int4 NOT NULL DEFAULT nextval('roles_id_seq'::regclass),
  "role_name" varchar(50) COLLATE "pg_catalog"."default" NOT NULL
)
;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO "public"."roles" VALUES (1, 'admin');
INSERT INTO "public"."roles" VALUES (2, 'user');

-- ----------------------------
-- Table structure for sessions
-- ----------------------------
DROP TABLE IF EXISTS "public"."sessions";
CREATE TABLE "public"."sessions" (
  "id" varchar COLLATE "pg_catalog"."default" NOT NULL,
  "user_id" int4 NOT NULL,
  "created_at" timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  "expires" timestamp(6)
)
;

-- ----------------------------
-- Records of sessions
-- ----------------------------
INSERT INTO "public"."sessions" VALUES ('4f9d63c11339d7c7ca2d8c77c2ead56d', 2, '2023-02-10 12:56:18.555474', NULL);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS "public"."users";
CREATE TABLE "public"."users" (
  "id" int4 NOT NULL DEFAULT nextval('roles_id_seq'::regclass),
  "user_details_id" int4 NOT NULL,
  "email" varchar(100) COLLATE "pg_catalog"."default" NOT NULL,
  "password" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "created_at" timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  "role_id" int4
)
;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO "public"."users" VALUES (2, 2, 'jkowal@gmail.com', '$2y$10$01DM2o/vs3buiiVL92kOQuKI5lfeEYl.yIKwsFEfPjzOG3BxJxKnO', '2023-01-27 00:19:04.765896', 1);
INSERT INTO "public"."users" VALUES (4, 3, 'testuser@gmail.com', '$2y$10$fGbGRvZ/6Sj6slib0t7ndue4ctPCuSbQ7fCT52gr5nGm2HhkoYrdW', '2023-02-08 22:10:20.907427', 2);

-- ----------------------------
-- Table structure for users_details
-- ----------------------------
DROP TABLE IF EXISTS "public"."users_details";
CREATE TABLE "public"."users_details" (
  "id" int4 NOT NULL DEFAULT nextval('roles_id_seq'::regclass),
  "name" varchar(100) COLLATE "pg_catalog"."default" NOT NULL,
  "surname" varchar(100) COLLATE "pg_catalog"."default" NOT NULL,
  "phone" varchar(20) COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Records of users_details
-- ----------------------------
INSERT INTO "public"."users_details" VALUES (2, 'Jan', 'Kowal', '123123123');
INSERT INTO "public"."users_details" VALUES (3, 'Maciek', 'Nowak', '123456789');

-- ----------------------------
-- Function structure for set_end_time
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."set_end_time"();
CREATE OR REPLACE FUNCTION "public"."set_end_time"()
  RETURNS "pg_catalog"."trigger" AS $BODY$
 BEGIN
	NEW.end_time := NEW.start_time + INTERVAL '4 weeks';
	return NEW;
	
END; 
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;

-- ----------------------------
-- Function structure for uuid_generate_v1
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."uuid_generate_v1"();
CREATE OR REPLACE FUNCTION "public"."uuid_generate_v1"()
  RETURNS "pg_catalog"."uuid" AS '$libdir/uuid-ossp', 'uuid_generate_v1'
  LANGUAGE c VOLATILE STRICT
  COST 1;

-- ----------------------------
-- Function structure for uuid_generate_v1mc
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."uuid_generate_v1mc"();
CREATE OR REPLACE FUNCTION "public"."uuid_generate_v1mc"()
  RETURNS "pg_catalog"."uuid" AS '$libdir/uuid-ossp', 'uuid_generate_v1mc'
  LANGUAGE c VOLATILE STRICT
  COST 1;

-- ----------------------------
-- Function structure for uuid_generate_v3
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."uuid_generate_v3"("namespace" uuid, "name" text);
CREATE OR REPLACE FUNCTION "public"."uuid_generate_v3"("namespace" uuid, "name" text)
  RETURNS "pg_catalog"."uuid" AS '$libdir/uuid-ossp', 'uuid_generate_v3'
  LANGUAGE c IMMUTABLE STRICT
  COST 1;

-- ----------------------------
-- Function structure for uuid_generate_v4
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."uuid_generate_v4"();
CREATE OR REPLACE FUNCTION "public"."uuid_generate_v4"()
  RETURNS "pg_catalog"."uuid" AS '$libdir/uuid-ossp', 'uuid_generate_v4'
  LANGUAGE c VOLATILE STRICT
  COST 1;

-- ----------------------------
-- Function structure for uuid_generate_v5
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."uuid_generate_v5"("namespace" uuid, "name" text);
CREATE OR REPLACE FUNCTION "public"."uuid_generate_v5"("namespace" uuid, "name" text)
  RETURNS "pg_catalog"."uuid" AS '$libdir/uuid-ossp', 'uuid_generate_v5'
  LANGUAGE c IMMUTABLE STRICT
  COST 1;

-- ----------------------------
-- Function structure for uuid_nil
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."uuid_nil"();
CREATE OR REPLACE FUNCTION "public"."uuid_nil"()
  RETURNS "pg_catalog"."uuid" AS '$libdir/uuid-ossp', 'uuid_nil'
  LANGUAGE c IMMUTABLE STRICT
  COST 1;

-- ----------------------------
-- Function structure for uuid_ns_dns
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."uuid_ns_dns"();
CREATE OR REPLACE FUNCTION "public"."uuid_ns_dns"()
  RETURNS "pg_catalog"."uuid" AS '$libdir/uuid-ossp', 'uuid_ns_dns'
  LANGUAGE c IMMUTABLE STRICT
  COST 1;

-- ----------------------------
-- Function structure for uuid_ns_oid
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."uuid_ns_oid"();
CREATE OR REPLACE FUNCTION "public"."uuid_ns_oid"()
  RETURNS "pg_catalog"."uuid" AS '$libdir/uuid-ossp', 'uuid_ns_oid'
  LANGUAGE c IMMUTABLE STRICT
  COST 1;

-- ----------------------------
-- Function structure for uuid_ns_url
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."uuid_ns_url"();
CREATE OR REPLACE FUNCTION "public"."uuid_ns_url"()
  RETURNS "pg_catalog"."uuid" AS '$libdir/uuid-ossp', 'uuid_ns_url'
  LANGUAGE c IMMUTABLE STRICT
  COST 1;

-- ----------------------------
-- Function structure for uuid_ns_x500
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."uuid_ns_x500"();
CREATE OR REPLACE FUNCTION "public"."uuid_ns_x500"()
  RETURNS "pg_catalog"."uuid" AS '$libdir/uuid-ossp', 'uuid_ns_x500'
  LANGUAGE c IMMUTABLE STRICT
  COST 1;

-- ----------------------------
-- View structure for book_view
-- ----------------------------
DROP VIEW IF EXISTS "public"."book_view";
CREATE VIEW "public"."book_view" AS  SELECT books.id,
    books.isbn,
    books.title,
    books.description,
    books.free_books_number,
    books.image,
    books."like",
    books.dislike,
    categories.category_name
   FROM books
     LEFT JOIN categories ON books.category_id = categories.id
  ORDER BY books.id;

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."roles_id_seq"
OWNED BY "public"."roles"."id";
SELECT setval('"public"."roles_id_seq"', 54, true);

-- ----------------------------
-- Primary Key structure for table authors
-- ----------------------------
ALTER TABLE "public"."authors" ADD CONSTRAINT "authors_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table book_author
-- ----------------------------
ALTER TABLE "public"."book_author" ADD CONSTRAINT "book_author_pkey" PRIMARY KEY ("book_id", "author_id");

-- ----------------------------
-- Triggers structure for table book_borrows
-- ----------------------------
CREATE TRIGGER "add_end_time" BEFORE INSERT ON "public"."book_borrows"
FOR EACH ROW
EXECUTE PROCEDURE "public"."set_end_time"();

-- ----------------------------
-- Primary Key structure for table book_borrows
-- ----------------------------
ALTER TABLE "public"."book_borrows" ADD CONSTRAINT "book_borrows_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table books
-- ----------------------------
ALTER TABLE "public"."books" ADD CONSTRAINT "books_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table categories
-- ----------------------------
ALTER TABLE "public"."categories" ADD CONSTRAINT "categories_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table roles
-- ----------------------------
ALTER TABLE "public"."roles" ADD CONSTRAINT "roles_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table sessions
-- ----------------------------
ALTER TABLE "public"."sessions" ADD CONSTRAINT "sessions_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table users
-- ----------------------------
ALTER TABLE "public"."users" ADD CONSTRAINT "users_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table users_details
-- ----------------------------
ALTER TABLE "public"."users_details" ADD CONSTRAINT "users_details_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Foreign Keys structure for table book_author
-- ----------------------------
ALTER TABLE "public"."book_author" ADD CONSTRAINT "book_author_author_id_fkey" FOREIGN KEY ("author_id") REFERENCES "public"."authors" ("id") ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE "public"."book_author" ADD CONSTRAINT "book_author_book_id_fkey" FOREIGN KEY ("book_id") REFERENCES "public"."books" ("id") ON DELETE CASCADE ON UPDATE CASCADE;

-- ----------------------------
-- Foreign Keys structure for table book_borrows
-- ----------------------------
ALTER TABLE "public"."book_borrows" ADD CONSTRAINT "book_borrows_book_id_fkey" FOREIGN KEY ("book_id") REFERENCES "public"."books" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE "public"."book_borrows" ADD CONSTRAINT "book_borrows_user_id_fkey" FOREIGN KEY ("user_id") REFERENCES "public"."users" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION;

-- ----------------------------
-- Foreign Keys structure for table books
-- ----------------------------
ALTER TABLE "public"."books" ADD CONSTRAINT "books_category_id_fkey" FOREIGN KEY ("category_id") REFERENCES "public"."categories" ("id") ON DELETE CASCADE ON UPDATE CASCADE;

-- ----------------------------
-- Foreign Keys structure for table sessions
-- ----------------------------
ALTER TABLE "public"."sessions" ADD CONSTRAINT "sessions_user_id_fkey" FOREIGN KEY ("user_id") REFERENCES "public"."users" ("id") ON DELETE NO ACTION ON UPDATE NO ACTION;
