DROP TABLE IF EXISTS `nb_config_frmwrk_tbl`;

CREATE TABLE `nb_config_frmwrk_tbl` (
  `nb_config_frmwrk_id_fld` int(11) NOT NULL AUTO_INCREMENT,
  `nb_config_type_fld` varchar(255) COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  `nb_property_fld` varchar(255) COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  `nb_type_fld` varchar(255) COLLATE latin1_spanish_ci DEFAULT NULL,
  `nb_default_fld` varchar(255) COLLATE latin1_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`nb_config_frmwrk_id_fld`,`nb_config_type_fld`,`nb_property_fld`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

INSERT INTO `nb_htmlattribute_tbl` (`nb_id_attribute_fld`, `nb_posicion_fld`, `nb_attribute_fld`, `nb_url_fld`, `nb_type_fld`, `nb_rel_fld`, `nb_descripcion_fld`)
VALUES
	(1,'top','link','../Styles/nabu.css','text/css','stylesheet','Estilos Nabu'),
	(2,'top','link','../Images/logo.ico','image/x-icon','icon','Icono'),
	(3,'top','script','../Framework/alpaca/dist/lib/jquery/dist/jquery.min.js','text/javascript',NULL,'Libreria Jquery'),
	(4,'top','script','../Framework/alpaca/dist/lib/handlebars/handlebars.min.js','text/javascript',NULL,'Handlebars'),
	(5,'top','script','../Framework/alpaca/dist/lib/bootstrap/dist/js/bootstrap.js','text/javascript',NULL,'Bootstrap'),
	(6,'top','link','../Framework/alpaca/dist/lib/bootstrap/dist/css/bootstrap.css','text/css','stylesheet','Bootstrap'),
	(7,'top','link','../Framework/alpaca/dist/alpaca/bootstrap/alpaca.min.css','text/css','stylesheet','Alpaca'),
	(8,'top','script','../Framework/alpaca/dist/alpaca/bootstrap/alpaca.min.js','text/javascript',NULL,'Alpaca'),
	(13,'top','link','../Framework/font-awesome/css/font-awesome.min.css','text/css','stylesheet','Menu'),
	(16,'top','link','../Framework/Datagrid/lib/js/themes/cobo/jquery-ui.custom.css','text/css','stylesheet','Datagrid'),
	(17,'top','link','../Framework/Datagrid/lib/js/jqgrid/css/ui.jqgrid.css','text/css','stylesheet','Datagrid'),
	(18,'top','script','../Framework/Datagrid/lib/js/jqgrid/js/i18n/grid.locale-es.js','text/javascript',NULL,'Datagrid'),
	(19,'top','script','../Framework/Datagrid/lib/js/themes/jquery-ui.custom.min.js','text/javascript',NULL,'Datagrid'),
	(20,'top','script','../Framework/Datagrid/lib/js/jqgrid/js/jquery.jqGrid.min.js','text/javascript',NULL,'Datagrid'),
	(21,'top','script','../Framework/Chart.js/Chart.js','text/javascript',NULL,'Charts'),
	(23,'top','script','../Script/funciones.js','text/javascript',NULL,'Funciones Propias'),
	(24,'top','script','../Framework/alpaca/dist/lib/moment/min/moment-with-locales.min.js','text/javascript',NULL,'Fechas'),
	(25,'top','script','../Framework/alpaca/dist/lib/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js','text/javascript',NULL,'Fechas'),
	(26,'top','link','../Framework/alpaca/dist/lib/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css','text/css','stylesheet','Fechas'),
	(27,'top','script','../Framework/alpaca/dist/lib/jquery-price-format2/jquery.price_format.min.js','text/javascript',NULL,'Currency'),
	(28,'top','script','../Framework/bootbox/bootbox.min.js','text/javascript',NULL,'Ventanas Info'),
	(29,'top','script','../Framework/Idle/store.legacy.min.js','text/javascript',NULL,'Inactividad App'),
	(30,'top','script','../Framework/Idle/jquery-idleTimeout.min.js','text/javascript',NULL,'Inactividad App Pestañas'),
	(31,'top','link','../Framework/gentelella/vendors/bootstrap/dist/css/bootstrap.min.css','text/css','stylesheet',NULL),
	(32,'top','link','../Framework/gentelella/vendors/font-awesome/css/font-awesome.min.css','text/css','stylesheet',NULL),
	(33,'top','link','../Framework/gentelella/vendors/nprogress/nprogress.css','text/css','stylesheet',NULL),
	(34,'top','link','../Framework/gentelella/build/css/custom.min.css','text/css','stylesheet',NULL),
	(35,'top','script','../Framework/gentelella/vendors/jquery/dist/jquery.min.js','text/javascript',NULL,NULL),
	(36,'top','script','../Framework/gentelella/vendors/bootstrap/dist/js/bootstrap.min.js','text/javascript',NULL,NULL),
	(37,'top','script','../Framework/gentelella/vendors/fastclick/lib/fastclick.js','text/javascript',NULL,NULL),
	(38,'top','script','../Framework/gentelella/vendors/nprogress/nprogress.js','text/javascript',NULL,NULL),
	(39,'dow','script','../Framework/gentelella/build/js/custom.min.js','text/javascript',NULL,NULL),
	(40,'top','script','../Framework/notie/notie.js','text/javascript',NULL,NULL);

INSERT INTO `nb_config_frmwrk_tbl` (`nb_config_frmwrk_id_fld`, `nb_config_type_fld`, `nb_property_fld`, `nb_type_fld`, `nb_default_fld`)
VALUES
	(1,'schema','default','any',NULL),
	(2,'schema','dependencies','array',NULL),
	(3,'schema','description','string',NULL),
	(4,'schema','disallow','array',NULL),
	(5,'schema','enum','array',NULL),
	(6,'schema','format','string',NULL),
	(7,'schema','maxLength','number',NULL),
	(8,'schema','minLength','number',NULL),
	(9,'schema','pattern','string',NULL),
	(10,'schema','readonly','boolean',NULL),
	(11,'schema','required','boolean',NULL),
	(12,'schema','title','string',NULL),
	(13,'schema','type','string','string'),
	(14,'options','allowOptionalEmpty',NULL,NULL),
	(15,'options','data','object',NULL),
	(16,'options','disabled','boolean',NULL),
	(17,'options','fieldClass','string',NULL),
	(18,'options','focus','checkbox','true'),
	(19,'options','form','object',NULL),
	(20,'options','helper','hidden','boolean'),
	(21,'options','hideInitValidationError','boolean',NULL),
	(22,'options','id','string',NULL),
	(23,'options','inputType','string',NULL),
	(24,'options','label','string',NULL),
	(25,'options','maskString','string',NULL),
	(26,'options','name','string',NULL),
	(27,'options','optionLabels','array',NULL),
	(28,'options','placeholder','string',NULL),
	(29,'options','readonly','boolean',NULL),
	(30,'options','showMessages','boolean','true'),
	(31,'options','size','number','40'),
	(32,'options','type','string','text'),
	(33,'options','typeahead',NULL,NULL),
	(34,'options','validate','boolean','true'),
	(35,'options','view','string',NULL),
	(36,'options','hidden','boolean',NULL),
	(37,'gridoptions','caption','string',NULL),
	(38,'gridoptions','resizable','boolean',NULL),
	(39,'gridoptions','rowNum','number',NULL),
	(40,'gridoptions','autowidth','boolean',NULL),
	(41,'gridoptions','ignorecase','boolean',NULL),
	(42,'gridoptions','sortname','string',NULL),
	(43,'gridoptions','height','number',NULL),
	(44,'gridoptions','table','string',NULL),
	(45,'gridcoloptions','title','string',NULL),
	(46,'gridcoloptions','name','string',NULL),
	(47,'gridcoloptions','search','boolean',NULL),
	(48,'gridcoloptions','sorteable','boolean',NULL),
	(49,'gridcoloptions','autowidth','boolean',NULL),
	(50,'gridcoloptions','link','string',NULL),
	(51,'gridcoloptions','linkoptions','string',NULL),
	(52,'gridcoloptions','formatter','string',NULL),
	(53,'gridcoloptions','editable','boolean',NULL),
	(54,'gridcoloptions','align','string',NULL),
	(55,'options','dataSource','string',NULL),
	(56,'options','dateFormat','string',NULL),
	(57,'options','onFieldChange','string',NULL),
	(58,'options','noneLabel','string','none'),
	(59,'options','removeDefaultNone','boolean',NULL),
	(60,'options','dependencies','array',NULL),
	(61,'options','vertical','boolean',NULL),
	(62,'options','onFieldChange','string',NULL),
	(63,'gridoptions','multiselect','boolean',NULL),
	(64,'gridcoloptions','linkE','string',NULL),
	(65,'gridoptions','sql','string',NULL),
	(66,'gridcoloptions','hidden','boolean',NULL),
	(67,'options','manualEntry','boolean','false'),
	(68,'options','picker','array',NULL),
	(69,'options','centsSeparator','string',NULL),
	(70,'options','prefix','string',NULL),
	(71,'options','suffix','string',NULL),
	(72,'options','thousandsSeparator','string',NULL),
	(73,'options','centsLimit','number','2'),
	(74,'gridcoloptions','editrules','string',NULL),
	(75,'gridcoloptions','editoptions','string',NULL),
	(76,'options','validator','string',NULL),
	(77,'gridoptions','reloadedit','boolean',NULL),
	(78,'options','events','string',NULL),
	(79,'schema','minimum','number',NULL),
	(80,'gridoptions','sortorder','string',NULL),
	(81,'gridcoloptions','formatoptions','string',NULL),
	(82,'gridoptions','header','string',NULL),
	(83,'schema','maximum','number',NULL),
	(84,'options','numericEntry','boolean',NULL),
	(85,'gridcoloptions','edittype','string',NULL),
	(86,'gridoptions','sortorder','string',NULL),
	(87,'options','hideNone','boolean',NULL),
	(88,'options','anchorTitle','string',NULL);



DROP TABLE IF EXISTS `nb_enterprise_tbl`;

CREATE TABLE `nb_enterprise_tbl` (
  `nb_enterprise_id_fld` varchar(255) COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  `nb_host_fld` varchar(255) COLLATE latin1_spanish_ci DEFAULT NULL,
  `nb_db_fld` varchar(255) COLLATE latin1_spanish_ci DEFAULT NULL,
  `nb_user_fld` varchar(255) COLLATE latin1_spanish_ci DEFAULT NULL,
  `nb_pass_fld` varchar(255) COLLATE latin1_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`nb_enterprise_id_fld`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;



# Dump of table nb_pageattribute_tbl
# ------------------------------------------------------------

DROP TABLE IF EXISTS `nb_pageattribute_tbl`;

CREATE TABLE `nb_pageattribute_tbl` (
  `nb_type_page_fld` int(1) NOT NULL,
  `nb_id_attribute_fld` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`nb_type_page_fld`,`nb_id_attribute_fld`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

LOCK TABLES `nb_pageattribute_tbl` WRITE;
/*!40000 ALTER TABLE `nb_pageattribute_tbl` DISABLE KEYS */;

INSERT INTO `nb_pageattribute_tbl` (`nb_type_page_fld`, `nb_id_attribute_fld`)
VALUES
	(0,2),
	(0,3),
	(0,4),
	(0,6),
	(0,7),
	(0,8),
	(0,32),
	(0,33),
	(0,34),
	(0,36),
	(0,37),
	(0,38),
	(0,39),
	(0,40);



DROP TABLE IF EXISTS `nb_pages_tbl`;

CREATE TABLE `nb_pages_tbl` (
  `nb_enterprise_id_fld` varchar(255) COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  `nb_id_page_fld` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `nb_page_title_fld` varchar(255) COLLATE latin1_spanish_ci DEFAULT NULL,
  `nb_page_style_fld` varchar(255) COLLATE latin1_spanish_ci DEFAULT NULL,
  `nb_page_type_fld` varchar(255) COLLATE latin1_spanish_ci DEFAULT NULL,
  `nb_page_view_pa_fld` varchar(255) COLLATE latin1_spanish_ci DEFAULT NULL,
  `nb_page_data_fld` varchar(255) COLLATE latin1_spanish_ci DEFAULT NULL,
  `nb_type_page_fld` int(1) DEFAULT NULL,
  `nb_audit_fld` varchar(255) COLLATE latin1_spanish_ci DEFAULT 'false',
  `nb_page_trace_fld` varchar(255) COLLATE latin1_spanish_ci DEFAULT 'false',
  `nb_postrender_fld` blob,
  PRIMARY KEY (`nb_id_page_fld`,`nb_enterprise_id_fld`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;


INSERT INTO `nb_pages_tbl` (`nb_enterprise_id_fld`, `nb_id_page_fld`, `nb_page_title_fld`, `nb_page_style_fld`, `nb_page_type_fld`, `nb_page_view_pa_fld`, `nb_page_data_fld`, `nb_type_page_fld`, `nb_audit_fld`, `nb_page_trace_fld`, `nb_postrender_fld`)
VALUES
	('nabu','event','Nabu',NULL,'event','bootstrap-display',NULL,5,'false','false',NULL);


DROP TABLE IF EXISTS `nb_sqltext_tbl`;

CREATE TABLE `nb_sqltext_tbl` (
  `nb_enterprise_id_fld` varchar(255) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `nb_sql_id_fld` varchar(255) COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  `nb_trace_fld` varchar(255) COLLATE latin1_spanish_ci DEFAULT NULL,
  `nb_sql_fld` blob,
  PRIMARY KEY (`nb_enterprise_id_fld`,`nb_sql_id_fld`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;



INSERT INTO `nb_sqltext_tbl` (`nb_enterprise_id_fld`, `nb_sql_id_fld`, `nb_trace_fld`, `nb_sql_fld`)
VALUES
	('nabu','0001','false',X'53454C454354204E425F534C4F47414E5F464C442C6E625F76657273696F6E62645F666C642C6E625F76657273696F6E61705F666C642C6E625F746172636553716C5F666C64200A46524F4D206E6162752E4E425F434F4E4649475F54424C'),
	('nabu','0002','false',X'73656C656374206E625F686F73745F666C642C6E625F64625F666C642C6E625F757365725F666C642C6E625F706173735F666C6420200A66726F6D206E6162752E6E625F656E74657270726973655F74626C200A7768657265206E625F656E74657270726973655F69645F666C643D2762696E645B305D27'),
	('nabu','nabuconnect','false',X'73656C656374206E625F656E74657270726973655F69645F666C642C6E625F64625F666C642C6E625F757365725F666C642C6E625F706173735F666C642C6E625F686F73745F666C642066726F6D206E625F656E74657270726973655F74626C207768657265206E625F656E74657270726973655F69645F666C643D2762696E645B305D27'),
	('nabu','paraiso','false',X'73656C656374206E625F656E74657270726973655F69645F666C642C6E625F64625F666C642C6E625F757365725F666C642C6E625F706173735F666C642C6E625F686F73745F666C642066726F6D206E625F656E74657270726973655F74626C207768657265206E625F656E74657270726973655F69645F666C643D277061726169736F27');

