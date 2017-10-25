CREATE TABLE public.news (
                news_id SERIAL NOT NULL,
                title VARCHAR NOT NULL,
                description VARCHAR NOT NULL,
                CONSTRAINT news_pk PRIMARY KEY (news_id)
);


CREATE TABLE public.shifts (
                shift_id SERIAL NOT NULL,
                description VARCHAR NOT NULL,
                CONSTRAINT shifts_pk PRIMARY KEY (shift_id)
);


CREATE TABLE public.types (
                type_id SERIAL NOT NULL,
                description VARCHAR NOT NULL,
                CONSTRAINT types_pk PRIMARY KEY (type_id)
);


CREATE TABLE public.profiles (
                profile_id SERIAL NOT NULL,
                description VARCHAR NOT NULL,
                CONSTRAINT profiles_pk PRIMARY KEY (profile_id)
);


CREATE TABLE public.categories (
                category_id SERIAL NOT NULL,
                description VARCHAR NOT NULL,
                CONSTRAINT categories_pk PRIMARY KEY (category_id)
);


CREATE TABLE public.partners (
                partner_id SERIAL NOT NULL,
                name VARCHAR NOT NULL,
                cnpj VARCHAR NOT NULL,
                email VARCHAR NOT NULL,
                phone VARCHAR NOT NULL,
                status BOOLEAN NOT NULL,
                CONSTRAINT partners_pk PRIMARY KEY (partner_id)
);


CREATE TABLE public.users (
                user_id SERIAL NOT NULL,
                name VARCHAR NOT NULL,
                email VARCHAR NOT NULL,
                password VARCHAR NOT NULL,
                cpf VARCHAR,
                nis VARCHAR,
                bu VARCHAR,
                updated TIMESTAMP NOT NULL,
                created TIMESTAMP NOT NULL,
                date_of_birthday DATE,
                activate BOOLEAN NOT NULL,
                reset_password_code VARCHAR,
                reset_password_code_expiration timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,,
                partner_id INTEGER,
                CONSTRAINT users_pk PRIMARY KEY (user_id)
);


CREATE TABLE public.comments_news (
                comment_id SERIAL NOT NULL,
                description VARCHAR NOT NULL,
                news_id INTEGER NOT NULL,
                user_id INTEGER NOT NULL,
                CONSTRAINT comments_news_pk PRIMARY KEY (comment_id)
);


CREATE TABLE public.users_profiles (
                users_profiles_id SERIAL NOT NULL,
                user_id INTEGER NOT NULL,
                profile_id INTEGER NOT NULL,
                CONSTRAINT users_profiles_pk PRIMARY KEY (user_type_id)
);


CREATE TABLE public.access_tokens (
                access_token_id SERIAL NOT NULL,
                user_id INTEGER NOT NULL,
                value VARCHAR NOT NULL,
                refresh VARCHAR NOT NULL,
                created TIMESTAMP NOT NULL,
                CONSTRAINT access_tokens_pk PRIMARY KEY (access_token_id, user_id)
);


CREATE TABLE public.levels (
                level_id SERIAL NOT NULL,
                description VARCHAR NOT NULL,
                CONSTRAINT levels_pk PRIMARY KEY (level_id)
);


CREATE TABLE public.courses (
                course_id SERIAL NOT NULL,
                duration INTEGER NOT NULL,
                description VARCHAR NOT NULL,
                level_id INTEGER NOT NULL,
                partner_id INTEGER NOT NULL,
                category_id INTEGER NOT NULL,
                type_id INTEGER NOT NULL,
                begin_date DATE NOT NULL,
                end_date DATE NOT NULL,
                begin_hour TIME NOT NULL,
                end_hour TIME NOT NULL,
                program_content VARCHAR NOT NULL,
                local VARCHAR NOT NULL,
                status BOOLEAN NOT NULL,
                latitude REAL NOT NULL,
                longitude REAL NOT NULL,
                shift_id INTEGER NOT NULL,
                CONSTRAINT courses_pk PRIMARY KEY (course_id)
);
COMMENT ON COLUMN public.courses.duration IS 'Duração em horas do curso';
 CREATE TABLE public.comments_courses (
                comment_id SERIAL NOT NULL,
                course_id INTEGER NOT NULL,
                description VARCHAR NOT NULL,
                user_id INTEGER NOT NULL,
                CONSTRAINT comments_courses_pk PRIMARY KEY (comment_id)
);


CREATE TABLE public.users_courses (
                course_id SERIAL NOT NULL,
                user_id INTEGER NOT NULL,
                enroll_date DATE NOT NULL,
                CONSTRAINT users_courses_pk PRIMARY KEY (course_id, user_id)
);


ALTER TABLE public.comments_news ADD CONSTRAINT news_comments_news_fk
FOREIGN KEY (news_id)
REFERENCES public.news (news_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.courses ADD CONSTRAINT shifts_courses_fk
FOREIGN KEY (shift_id)
REFERENCES public.shifts (shift_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.courses ADD CONSTRAINT types_courses_fk
FOREIGN KEY (type_id)
REFERENCES public.types (type_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.users_profiles ADD CONSTRAINT profiles_users_profiles_fk
FOREIGN KEY (profile_id)
REFERENCES public.profiles (profile_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.courses ADD CONSTRAINT categories_courses_fk
FOREIGN KEY (category_id)
REFERENCES public.categories (category_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.courses ADD CONSTRAINT partners_courses_fk
FOREIGN KEY (partner_id)
REFERENCES public.partners (partner_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.users ADD CONSTRAINT partners_users_fk
FOREIGN KEY (partner_id)
REFERENCES public.partners (partner_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.users_courses ADD CONSTRAINT users_users_courses_fk
FOREIGN KEY (user_id)
REFERENCES public.users (user_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.access_tokens ADD CONSTRAINT users_access_tokens_fk
FOREIGN KEY (user_id)
REFERENCES public.users (user_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.users_profiles ADD CONSTRAINT users_users_profiles_fk
FOREIGN KEY (user_id)
REFERENCES public.users (user_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.comments_courses ADD CONSTRAINT users_comments_fk
FOREIGN KEY (user_id)
REFERENCES public.users (user_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.comments_news ADD CONSTRAINT users_comments_news_fk
FOREIGN KEY (user_id)
REFERENCES public.users (user_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.courses ADD CONSTRAINT levels_courses_fk
FOREIGN KEY (level_id)
REFERENCES public.levels (level_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.users_courses ADD CONSTRAINT courses_users_courses_fk
FOREIGN KEY (course_id)
REFERENCES public.courses (course_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.comments_courses ADD CONSTRAINT courses_comments_fk
FOREIGN KEY (course_id)
REFERENCES public.courses (course_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;