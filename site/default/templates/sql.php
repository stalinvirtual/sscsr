CREATE TABLE IF NOT EXISTS public.importantlinks
(
    id serial,
    link_name character varying(255) COLLATE pg_catalog."default",
	menu_link character varying(255) COLLATE pg_catalog."default",
    creation_date timestamp without time zone,
    status integer DEFAULT 0
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.importantlinks
    OWNER to sscsr;
	
	
	
	select * from importantlinks   FETCH FIRST 4 ROW ONLY
	
	select * from importantlinks   OFFSET 4 ROWS FETCH FIRST 4 ROW ONLY
	
	DELETE FROM importantlinks WHERE id='8';
	
	ALTER TABLE customers 
ADD COLUMN phone VARCHAR;



---------------------------------------------------------

CREATE TABLE IF NOT EXISTS public.tier_master
(
    tier_id serial,
    tier_name  character varying(255) COLLATE pg_catalog."default"
	
	
   
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.tier_master
    OWNER to sscsr;
--------------------------------------------------	
	
	
	
	CREATE TABLE IF NOT EXISTS public.tier_exam_details
(
    tier_exam_details_id serial,
    role_no character varying(255) COLLATE pg_catalog."default",
    reg_no character varying(255) COLLATE pg_catalog."default",
	exam_code character varying(255) COLLATE pg_catalog."default",
	exam_tier character varying(255) COLLATE pg_catalog."default",
	exam_center character varying(255) COLLATE pg_catalog."default",
	scribe_opted_medium character varying(255) COLLATE pg_catalog."default"
	
	
   
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.tier_exam_details
    OWNER to sscsr;
	
--------------------------------------------------------------------------	
		
	CREATE TABLE IF NOT EXISTS public.kyas_details
(
    kyas_id serial,
    reg_no character varying(255) COLLATE pg_catalog."default",
	exam_code character varying(255) COLLATE pg_catalog."default",
	cand_name character varying(255) COLLATE pg_catalog."default",
	photo_id character varying(255) COLLATE pg_catalog."default",
	sign_id character varying(255) COLLATE pg_catalog."default"
	
   
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.kyas_details
    OWNER to sscsr;
	
	
DELETE FROM exam_details WHERE  exam_id IN (18,19,20,21);