# sscsr
Staff Selection Commission Projects

$base_url = "10.163.2.160/projects/sscsr/site/"

cgle 2019 sample reg and dob:

10000863847
31-12-1991

# Data Entry Folder Changes

# functions.php

# change local path Variable

$GLOBALS['local_path']


# admitcard_preview.php

change current file path

<iframe id="forPostyouradd" height='200%' width="100%"
    data-src="http://localhost/sscsr/site/IndexController/admitcardpreview" src="about:blank"
    class="responsive-iframe" allowfullscreen style="background:#ffffff"></iframe>



Go to Python Folder:change log path:


#creating LOG file
root_logger= logging.getLogger()
root_logger.setLevel(logging.DEBUG)
handler = logging.FileHandler('C:/xampp/htdocs/projects/dataentry/log/sscsr_log.log', 'w', 'utf-8')

notify.show_toast("SSCSR Data Uploading...!", "👍 Started ", duration=10, threaded=True,
icon_path="C:/xampp/htdocs/projects/sscsr/dataentry/images/logo/logo.ico")


# Site

# functions.php

Change Variable Path

$GLOBALS['local_path'] = $base_url ."/rd/security_audit/dataentry/ftp/";

$GLOBALS['pdf_header_image_server_path'] = $base_url ."/rd/security_audit/site/exam_assets/";

//$GLOBALS['local_path'] = "C:\\xampp\htdocs\\rd\\\security_audit\\dataentry\\ftp//";

$GLOBALS['local_instructions_path'] = "C:\\xampp\htdocs\\rd\\\security_audit\\dataentry\\important_instructions\\";
//$GLOBALS['local_instructions_path'] = "C:\\xampp\htdocs\\rd\\\security_audit\\dataentry\\important_instructions\\";

$local_bulk_mail = "http://localhost/rd/\security_audit/dataentry/bulkemail";


# PdfHelper.php

$base_url = "http://" . $_SERVER['SERVER_NAME'];
$local_path = $base_url ."/rd/security_audit/site/";
$photo_path = $local_path."exam_assets/photo_not_exists.png";

# PdfHelperDMEExam.php

$base_url = "http://" . $_SERVER['SERVER_NAME'];
$local_path = $base_url ."/rd/security_audit/site/";
$photo_path = $local_path."exam_assets/photo_not_exists.png";


# PdfHelperDVExam.php

$base_url = "http://" . $_SERVER['SERVER_NAME'];
$local_path = $base_url ."/rd/security_audit/site/";
$photo_path = $local_path."exam_assets/photo_not_exists.png";

# PdfHelperPETExam.php

$base_url = "http://" . $_SERVER['SERVER_NAME'];
$local_path = $base_url ."/rd/security_audit/site/";
$photo_path = $local_path."exam_assets/photo_not_exists.png";


# PdfHelperSkillTestExam.php on 07 feb 23

$base_url = "http://" . $_SERVER['SERVER_NAME'];
$local_path = $base_url ."/rd/security_audit/site/";
$photo_path = $local_path."exam_assets/photo_not_exists.png";


# SQL Changes on 07 feb 23

Added 2 fields in exam_code and no_of_days
select * from sscsr_db_table_tier_master


-- Table: public.sscsr_db_table_tier_master

-- DROP TABLE IF EXISTS public.sscsr_db_table_tier_master;

CREATE TABLE IF NOT EXISTS public.sscsr_db_table_tier_master
(
id text COLLATE pg_catalog."default" NOT NULL,
table_name text COLLATE pg_catalog."default",
tier_id text COLLATE pg_catalog."default",
table_exam_year text COLLATE pg_catalog."default",
status character varying COLLATE pg_catalog."default",
created_on timestamp without time zone,
updated_on timestamp without time zone,
exam_code text COLLATE pg_catalog."default",
no_of_days integer,
CONSTRAINT sscsr_db_table_tier_master_pkey PRIMARY KEY (id)
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.sscsr_db_table_tier_master
OWNER to postgres;

# No of Days Query

select distinct(date1::date)- INTEGER '3' AS yesterday_date from cgle_2019_tier



05-april-2023



SELECT * FROM public.cgle_2019_dv where reg_no = '91000099938'

26-05-2001

SELECT * FROM public.cgle_2019_skill where reg_no = '91000099938'


SELECT * FROM public.cgle_2019_tier where reg_no = '91000099938'


SELECT * FROM public.sscsr_db_table_master

truncate table public.sscsr_db_table_master


SELECT * FROM public.sscsr_db_table_tier_master

truncate table public.sscsr_db_table_tier_master