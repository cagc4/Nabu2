INSERT INTO `nb_pages_tbl` (`nb_enterprise_id_fld`, `nb_id_page_fld`, `nb_page_title_fld`, `nb_page_style_fld`, `nb_page_type_fld`, `nb_page_view_pa_fld`, `nb_page_data_fld`, `nb_type_page_fld`, `nb_audit_fld`, `nb_page_trace_fld`, `nb_postrender_fld`)
VALUES
	('nabu','login','Nabu','formsSimple','alpaca','bootstrap-edit',NULL,0,'false','false',NULL);


INSERT INTO `nb_schema_tbl` (`nb_enterprise_id_fld`, `nb_id_page_fld`, `nb_title_fld`, `nb_description_fld`, `nb_type_fld`)
VALUES
	('nabu','login','Bienvenidos',NULL,'object');
    


INSERT INTO `nb_option_tbl` (`nb_enterprise_id_fld`, `nb_id_page_fld`, `nb_typealpaca_fld`, `nb_renderform_fld`, `nb_action_path`, `nb_action_fld`, `nb_typeaccion_fld`, `nb_method_fld`, `nb_enctype_fld`, `nb_target_fld`)
VALUES
	('nabu','login','form','true','../Events/','ValidateUser','0','post',NULL,NULL);
    
    
INSERT INTO `nb_forms_tbl` (`nb_enterprise_id_fld`, `nb_id_page_fld`, `nb_id_pr_schema_fld`, `nb_config_frmwrk_id_fld`, `nb_schem_value_fld`)
VALUES
	('nabu','login','nb_a_user_fld',11,'true'),
	('nabu','login','nb_a_user_fld',13,'string'),
	('nabu','login','nb_a_user_fld',28,'Usuario'),
    
    ('nabu','login','nb_a_user_fld',6,'password'),
    ('nabu','login','nb_password_fld',9,'^[a-zA-Z0-9_]+$'),
	('nabu','login','nb_password_fld',11,'true'),
	('nabu','login','nb_password_fld',13,'string'),
	('nabu','login','nb_password_fld',28,'Password'),
    
INSERT INTO `nb_options_buttons_tbl` (`nb_enterprise_id_fld`, `nb_id_page_fld`, `nb_id_opt_form_fld`, `nb_value_fld`, `nb_title_fld`, `nb_click_fld`, `nb_styles_fld`)
VALUES
	('nabu','login','reset','Limpiar','Limpiar',NULL,'btn btn-primary'),
	('nabu','login','submit','Aceptar','Aceptar',NULL,'btn btn-primary'),
	('nabu','login','Olvido','Olvido su Password?','Olvido su Password?',"function() {window.location.href = 'nabu.php?p=nb_forget_pg';}",'btn btn-link'),
	('nabu','login','Crear','Crear Usuario','Crear Usuario',"function() {window.location.href = 'nabu.php?p=nb_user_create_pg';}",'btn btn-link');


