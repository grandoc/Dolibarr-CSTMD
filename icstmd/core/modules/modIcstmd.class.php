﻿<?php
/* <one line to give the program's name and a brief idea of what it does.>
 * Copyright (C) <2017> SaaSprov.ma <saasprov@gmail.com>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

include_once DOL_DOCUMENT_ROOT . "/core/modules/DolibarrModules.class.php";

// The class name should start with a lower case mod for Dolibarr to pick it up
// so we ignore the Squiz.Classes.ValidClassName.NotCamelCaps rule.
// @codingStandardsIgnoreStart
/**
 * Description and activation class for module Icstmd
 */
class modIcstmd extends DolibarrModules
{
	/** @var DoliDB Database handler */
	public $db;

	/**
	 * @var int numero Module unique ID
	 * @see http://wiki.dolibarr.org/index.php/List_of_modules_id Available ranges
	 */
	public $numero = 5562333;

	/** @var string Text key to reference module (for permissions, menus, etc.) */
	public $rights_class = 'icstmd';

	/**
	 * @var string Module family.
	 * Used to group modules in module setup page.
	 * Can be one of 'crm', 'financial', 'hr', 'projects', 'products', 'ecm', 'technic', 'other'
	 */
	public $family = 'projects';

	/** @var int Module position in the family */
	public $module_position = 500;

	/** @var array Provide a custom family and options */
	public $familyinfo = array(
//        'myownfamily' => array(
//            'position' => '001',
//            'label' => 'MyOwnFamily'
//        )
	);

	/** @var string Module name */
	public $name = "ICSTMD";

	/** @var string Module short description */
	public $description = "Description of module Icstmd";

	/** @var string Module long description */
	public $descriptionlong = "A very long description. Can be a full HTML content";

	/**
	 * @var string Module editor name
	 * @since 4.0
	 */
	public $editor_name = "My Company";

	/**
	 * @var string Module editor website
	 * @since 4.0
	 */
	public $editor_url = "http://www.example.com";

	/**
	 * @var string Module version string
	 * Special values to hide the module behind MAIN_FEATURES_LEVEL: development, experimental
	 * @see https://semver.org
	 */
	public $version = 'development';

	/** @var string Key used in llx_const table to save module status enabled/disabled */
	public $const_name = 'MAIN_MODULE_ICSTMD';

	/**
	 * @var string Module logo
	 * Should be named object_icstmd.png and store under icstmd/img
	 */
	public $picto = 'icstmd@icstmd';

	/** @var array Define module parts */
	public $module_parts = array(
		/** @var bool Module ships triggers in icstmd/core/triggers */
		'triggers' => false,
		/**
		 * @var bool Module ships login in icstmd/core/login
		 * @todo: example
		 */
		'login' => false,
		/**
		 * @var bool Module ships substitution functions
		 * @todo example
		 */
		'substitutions' => false,
		/**
		 * @var bool Module ships menu handlers
		 * @todo example
		 */
		'menus' => false,
		/**
		 * @var bool Module ships theme in icstmd/theme
		 * @todo example
		 */
		'theme' => false,
		/**
		 * @var bool Module shipped templates in icstmd/core/tpl overload core ones
		 * @todo example
		 */
		'tpl' => false,
		/**
		 * @var bool Module ships barcode functions
		 * @todo example
		 */
		'barcode' => false,
		/**
		 * @var bool Module ships models
		 * @todo example
		 */
		'models' => false,
		/** @var string[] List of module shipped custom CSS relative file paths */
		'css' => array(
			"/icstmd/css/multi-select.css",
			"/icstmd/css/select2.css"
		),
		/** @var string[] List of module shipped custom JavaScript relative file paths */
		'js' => array(
		),
		/**
		 * @var string[] List of hook contexts managed by the module
		 * @ todo example
		 */
		'hooks' => array(),
		/**
		 * @var array List of default directory names to force
		 * @todo example
		 */
		'dir' => array(),
		/**
		 * @var array List of workflow contexts managed by the module
		 */
		'workflow' => array(),
	);

	/** @var string Data directories to create when module is enabled */
	public $dirs = array(
		'/icstmd/temp'
	);

	/** @var array Configuration page declaration */
	public $config_page_url = 'setup.php@icstmd';

	/** @var bool Control module visibility */
	public $hidden = false;

	/** @var string[] List of class names of modules to enable when this one is enabled */
	public $depends = array();

	/** @var string[] List of class names of modules to disable when this one is disabled */
	public $requiredby = array();

	/** @var string List of class names of modules this module conflicts with */
	public $conflictwith = array();

	/** @var int[] Minimum PHP version required by this module */
	public $phpmin = array(5, 3);

	/** @var int[] Minimum Dolibarr version required by this module */
	public $need_dolibarr_version = array(3, 2);

	/** @var string[] List of language files */
	public $langfiles = array('icstmd@icstmd');

	/** @var array Indexed list of constants options */
	public $const = array(
		0 => array(
			/** @var string Constant name */
			'MYMODULE_MYNEWCONST1',
			/**
			 * @var string Constant type
			 * @todo Are there other types than 'chaine'?
			 */
			'chaine',
			/** @var string Constant initial value */
			'myvalue',
			/** @var string Constant description */
			'This is a configuration constant',
			/** @var bool Constant visibility */
			true,
			/**
			 * @var string Multi-company entities
			 * 'current' or 'allentities'
			 */
			'current',
			/** @var bool Delete constant when module is disabled */
			true
		)
	);

	/**
	 * @var string List of pages to add as tab in a specific view
	 * @todo example
	 */
	public $tabs = array();

	/**
	 * @var array Dictionaries declared by the module
	 *@todo example
	 */
	public $dictionaries = array();

	/** @var array Indexed list of boxes options */
	public $boxes = array(
		0 => array(
			'file' => 'mybox@icstmd',
			'note' => '',
			'enabledbydefaulton' => 'Home'
		)
	);

	/**
	 * @var array Indexed list of cronjobs options
	 * @todo: example
	 */
	public $cronjobs = array();

	/**
	 * @var array Indexed list of permissions options
	 * @todo example
	 */
	public $rights = array();

	/**
	 * @var array Indexed list of menu options
	 * @todo example
	 */
	public $menu = array();

	/**
	 * @var array Indexed list of export IDs
	 * @todo example
	 */
	public $export_code = array();

	/**
	 * @var array Indexed list of export names
	 * @todo example
	 */
	public $export_label = array();

	/**
	 * @var array Indexed list of export enabling conditions
	 * @todo example
	 */
	public $export_enabled = array();

	/**
	 * @var array Indexed list of export required permissions
	 * @todo example
	 */
	public $export_permission = array();

	/**
	 * @var array Indexed list of export fields
	 * @todo example
	 */
	public $export_fields_array = array();

	/**
	 * @var array Indexed list of export entities
	 * @todo example
	 */
	public $export_entities_array = array();

	/**
	 * @var array Indexed list of export SQL queries start
	 * @todo example
	 */
	public $export_sql_start = array();

	/**
	 * @var array Indexed list of export SQL queries end
	 * @todo example
	 */
	public $export_sql_end = array();

	/** @var bool Module only enabled / disabled in main company when multi-company is in use */
	public $core_enabled = false;

	// @codingStandardsIgnoreEnd
	/**
	 * Constructor. Define names, constants, directories, boxes, permissions
	 *
	 * @param DoliDB $db Database handler
	 */
	public function __construct($db)
	{
		global $langs, $conf;

		// DolibarrModules is abstract in Dolibarr < 3.8
		if (is_callable('parent::__construct')) {
			parent::__construct($db);
		} else {
			global $db;
			$this->db = $db;
		}

		// Declare custom family with translated label
		//$this->familyinfo = array(
		//	'myownfamily' => array(
		//		'position' => '001',
		//		'label' => $langs->trans("MyOwnFamily")
		//	)
		//);

		// Lazy automatic module naming from class names
		//$this->name = preg_replace('/^mod/i', '', get_class($this));

		// Lazy automatic constant naming from module name
		//$this->const_name = 'MAIN_MODULE_' . strtoupper($this->name);

		// Examples for complex types
		//$this->module_parts = array(
			// Set here all hooks context managed by module
			// 'hooks' => array('hookcontext1','hookcontext2'),
			// To force the default directories names
			// 'dir' => array('output' => 'othermodulename'),
			// Set here all workflow context managed by module
			// Don't forget to depend on modWorkflow!
			// The description translation key will be descWORKFLOW_MODULE1_YOURACTIONTYPE_MODULE2
			// You will be able to check if it is enabled with the $conf->global->WORKFLOW_MODULE1_YOURACTIONTYPE_MODULE2 constant
			// Implementation is up to you and is usually done in a trigger.
			// 'workflow' => array(
			//     'WORKFLOW_MODULE1_YOURACTIONTYPE_MODULE2' => array(
			//         'enabled' => '! empty($conf->module1->enabled) && ! empty($conf->module2->enabled)',
			//         'picto' => 'yourpicto@icstmd',
			//         'warning' => 'WarningTextTranslationKey',
			//      ),
			// ),
		//);


		// Array to add new pages in new tabs
		// Example:
		$this->tabs = array(
							'thirdparty:+icstmdtiers:ICSTMD:$user->rights->icstmd->read:/icstmd/tiers_icstmd.php?id=__ID__',
							'thirdparty:+icstmdtiers:ICSTMD_PDF:$user->rights->icstmd->read:/icstmd/interv_icstmd.php?id=__ID__',
							'contact:+icstmdcontact:ICSTMD:$user->rights->icstmd->read:/icstmd/contact_icstmd.php?id=__ID__',
							'intervention:+icstmdficheinter:CSTMD:$user->rights->icstmd->read:/icstmd/interv_cstmd/index.php?id=__ID__',
							'intervention:+icstmdficheinter:CSTMD_PDF:$user->rights->icstmd->read:/icstmd/ticket_icstmd.php?id=__ID__');
		// 'categories_x'	  to add a tab in category view (replace 'x' by type of category (0=product, 1=supplier, 2=customer, 3=member)
		// 'contact'          to add a tab in contact view
		// 'contract'         to add a tab in contract view
		// 'group'            to add a tab in group view
		// 'intervention'     to add a tab in intervention view
		// 'invoice'          to add a tab in customer invoice view
		// 'invoice_supplier' to add a tab in supplier invoice view
		// 'member'           to add a tab in fundation member view
		// 'opensurveypoll'	  to add a tab in opensurvey poll view
		// 'order'            to add a tab in customer order view
		// 'order_supplier'   to add a tab in supplier order view
		// 'payment'		  to add a tab in payment view
		// 'payment_supplier' to add a tab in supplier payment view
		// 'product'          to add a tab in product view
		// 'propal'           to add a tab in propal view
		// 'project'          to add a tab in project view
		// 'stock'            to add a tab in stock view
		// 'thirdparty'       to add a tab in third party view
		// 'user'             to add a tab in user view

		// Dictionaries
		if (! isset($conf->icstmd->enabled)) {
			$conf->icstmd=new stdClass();
			$conf->icstmd->enabled = 0;
		}
		$this->dictionaries = array();
		// Example:
		  $this->dictionaries=array(
			  'langs'=>'icstmd@icstmd',
			  // List of tables we want to see into dictonary editor
			  'tabname'=>array(
				  MAIN_DB_PREFIX."c_cstmd_formations",
				  MAIN_DB_PREFIX."c_cstmd_type_vehicule",
				  MAIN_DB_PREFIX."c_cstmd_clases",
				  MAIN_DB_PREFIX."c_cstmd_ge_principaux",
				  MAIN_DB_PREFIX."c_cstmd_mdhr",
				  MAIN_DB_PREFIX."c_cstmd_act_mdt",
				  MAIN_DB_PREFIX."c_cstmd_act_mdr",
				  MAIN_DB_PREFIX."c_cstmd_act_mdc",
				  MAIN_DB_PREFIX."c_cstmd_act_mdd",
				  MAIN_DB_PREFIX."c_cstmd_act_mda",
				  MAIN_DB_PREFIX."c_cstmd_act_mdm",
				  MAIN_DB_PREFIX."c_cstmd_act_mde",
				  MAIN_DB_PREFIX."c_cstmd_icpe",
			  ),
			  // Label of tables
			  'tablib'=>array("Formations", "Types de véhicules", "Clases", "GE principaux", "MD à haut risques", "Activité marchandises dangereuses Transport", "Activité marchandises dangereuses Remplissage", "Activité marchandises dangereuses Chargement", "Activité marchandises dangereuses Déchargement", "Activité marchandises dangereuses Aérien", "Activité marchandises dangereuses Maritime", "Activité marchandises dangereuses Emballage", "ICPE"),
			  // Query to select fields
			  'tabsql'=>array(
				  'SELECT f.rowid as rowid, f.code, f.label, f.active'
				  . ' FROM ' . MAIN_DB_PREFIX . 'c_cstmd_formations as f',
				  'SELECT f.rowid as rowid, f.code, f.label, f.active'
				  . ' FROM ' . MAIN_DB_PREFIX . 'c_cstmd_type_vehicule as f',
				  'SELECT f.rowid as rowid, f.code, f.label, f.active'
				  . ' FROM ' . MAIN_DB_PREFIX . 'c_cstmd_clases as f',
				  'SELECT f.rowid as rowid, f.code, f.label, f.active'
				  . ' FROM ' . MAIN_DB_PREFIX . 'c_cstmd_ge_principaux as f',
				  'SELECT f.rowid as rowid, f.code, f.label, f.active'
				  . ' FROM ' . MAIN_DB_PREFIX . 'c_cstmd_mdhr as f',
				  'SELECT f.rowid as rowid, f.code, f.label, f.active'
				  . ' FROM ' . MAIN_DB_PREFIX . 'c_cstmd_act_mdt as f',
				  'SELECT f.rowid as rowid, f.code, f.label, f.active'
				  . ' FROM ' . MAIN_DB_PREFIX . 'c_cstmd_act_mdr as f',
				  'SELECT f.rowid as rowid, f.code, f.label, f.active'
				  . ' FROM ' . MAIN_DB_PREFIX . 'c_cstmd_act_mdc as f',
				  'SELECT f.rowid as rowid, f.code, f.label, f.active'
				  . ' FROM ' . MAIN_DB_PREFIX . 'c_cstmd_act_mdd as f',
				  'SELECT f.rowid as rowid, f.code, f.label, f.active'
				  . ' FROM ' . MAIN_DB_PREFIX . 'c_cstmd_act_mda as f',
				  'SELECT f.rowid as rowid, f.code, f.label, f.active'
				  . ' FROM ' . MAIN_DB_PREFIX . 'c_cstmd_act_mdm as f',
				  'SELECT f.rowid as rowid, f.code, f.label, f.active'
				  . ' FROM ' . MAIN_DB_PREFIX . 'c_cstmd_act_mde as f',
				  'SELECT f.rowid as rowid, f.code, f.label, f.active'
				  . ' FROM ' . MAIN_DB_PREFIX . 'c_cstmd_icpe as f',
				  
			  ),
			  // Sort order
			  'tabsqlsort'=>array("label ASC", "label ASC", "label ASC", "label ASC", "label ASC", "label ASC", "label ASC", "label ASC", "label ASC", "label ASC", "label ASC", "label ASC", "label ASC"),
			  // List of fields (result of select to show dictionary)
			  'tabfield'=>array("code,label", "code,label", "code,label", "code,label", "code,label", "code,label", "code,label", "code,label", "code,label", "code,label", "code,label", "code,label", "code,label"),
			  // List of fields (list of fields to edit a record)
			  'tabfieldvalue'=>array("code,label", "code,label", "code,label", "code,label", "code,label", "code,label", "code,label", "code,label", "code,label", "code,label", "code,label", "code,label", "code,label"),
			  // List of fields (list of fields for insert)
			  'tabfieldinsert'=>array("code,label", "code,label", "code,label", "code,label", "code,label", "code,label", "code,label", "code,label", "code,label", "code,label", "code,label", "code,label", "code,label"),
			  // Name of columns with primary key (try to always name it 'rowid')
			  'tabrowid'=>array("rowid", "rowid", "rowid", "rowid", "rowid", "rowid", "rowid", "rowid", "rowid", "rowid", "rowid", "rowid", "rowid", "rowid", "rowid"),
			  // Condition to show each dictionary
			  'tabcond'=>array(
				  $conf->icstmd->enabled,
				  $conf->icstmd->enabled,
				  $conf->icstmd->enabled,
				  $conf->icstmd->enabled,
				  $conf->icstmd->enabled,
				  $conf->icstmd->enabled,
				  $conf->icstmd->enabled,
				  $conf->icstmd->enabled,
				  $conf->icstmd->enabled,
				  $conf->icstmd->enabled,
				  $conf->icstmd->enabled,
				  $conf->icstmd->enabled,
				  $conf->icstmd->enabled,
			  )
		  );
		 

		// Cronjobs
		// List of cron jobs entries to add
		//$this->cronjobs = array();
		// Example:
		//		$this->cronjobs = array(
		//			0 => array(
		//				'label' => 'My label',
		//				'jobtype' => 'method',
		//				'class' => '/dir/class/file.class.php',
		//				'objectname' => 'MyClass',
		//				'method' => 'myMethod',
		//				'parameters' => '',
		//				'comment' => 'Comment',
		//				'frequency' => 2,
		//				'unitfrequency' => 3600,
		//				'test' => true
		//			),
		//			1 => array(
		//				'label' => 'My label',
		//				'jobtype' => 'command',
		//				'command' => '',
		//				'parameters' => '',
		//				'comment' => 'Comment',
		//				'frequency' => 1,
		//				'unitfrequency' => 3600 * 24,
		//				'test' => true
		//			)
		//		);

		// Permissions
		//$r = 0;
		// Add here list of permission defined by
		// an id, a label, a boolean and two constant strings.
		// Example:
		//// Permission id (must not be already used)
		//$this->rights[$r][0] = 2000;
		//// Permission label
		//$this->rights[$r][1] = 'Permision label';
		//// Permission by default for new user (0/1)
		//$this->rights[$r][3] = 1;
		//// In php code, permission will be checked by test
		//// if ($user->rights->permkey->level1->level2)
		//$this->rights[$r][4] = 'level1';
		//// In php code, permission will be checked by test
		//// if ($user->rights->permkey->level1->level2)
		//$this->rights[$r][5] = 'level2';
		//$r++;
		// Main menu entries
		$r=0;
		// Menu entries
		// Example to declare a new Top Menu entry and its Left menu entry:
		$this->menu[$r]=array(
			'fk_menu' => 0,
			'type' => 'top',
			'titre' => 'Icstmd',
			'mainmenu' => 'icstmd',
			'leftmenu' => '0',
			'url' => '/icstmd/index.php',
			'langs' => 'icstmd@icstmd',
			'position' => 100,
			// 'enabled' => '$user->rights->icstmd->lire',
			// 'perms' => '$user->rights->icstmd->lire',
			'enabled'=>'$conf->icstmd->enabled',
			'perms'=>'1',
			'target' => '',
			'user' => 2
		);
		$r++;
		$this->menu[$r]=array(
			'fk_menu' => 'fk_mainmenu=icstmd',
			'type' => 'left',
			'titre' => 'Import types formations',
			'leftmenu' => 'ImportTypesFormations',
			'url' => '/icstmd/imp_typ_form.php',
			'langs' => 'icstmd@icstmd',
			'position' => 101,
			// 'enabled' => '$user->rights->icstmd->lire',
			// 'perms' => '$user->rights->icstmd->lire',
			'enabled'=>'$conf->icstmd->enabled',
			'perms'=>'1',
			'target' => '',
			'user' => 0 
		);
		$r++;
		$this->menu[$r]=array(
			'fk_menu' => 'fk_mainmenu=icstmd',
			'type' => 'left',
			'titre' => 'Participants en contact',
			'leftmenu' => 'ParticipantsContact',
			'url' => '/icstmd/imp_part_form.php',
			'langs' => 'icstmd@icstmd',
			'position' => 102,
			// 'enabled' => '$user->rights->icstmd->lire',
			// 'perms' => '$user->rights->icstmd->lire',
			'enabled'=>'$conf->icstmd->enabled',
			'perms'=>'1',
			'target' => '',
			'user' => 0 
		);
		$r++;
		$this->menu[$r]=array(
			'fk_menu' => 'fk_mainmenu=icstmd',
			'type' => 'left',
			'titre' => 'Référentiel',
			'leftmenu' => 'Referentiel',
			'url'=>'/icstmd/referentiels/index_ref.php',
			'langs' => 'icstmd@icstmd',
			'position' => 103,
			// 'enabled' => '$user->rights->icstmd->lire',
			// 'perms' => '$user->rights->icstmd->lire',
			'enabled'=>'$conf->icstmd->enabled',
			'perms'=>'1',
			'target' => '',
			'user' => 0 
		);
		$r++;
		$this->menu[$r]=array(
			'fk_menu' => 'fk_mainmenu=icstmd,fk_leftmenu=Referentiel',
			'type' => 'left',
			'titre' => 'NewQuestions',
			'mainmenu' => 'icstmd',
			'url' => '/icstmd/questions/card.php?action=create',
			'langs' => 'icstmd@icstmd',
			'position' => 104,
			// 'enabled' => '$user->rights->icstmd->lire',
			// 'perms' => '$user->rights->icstmd->lire',
			'enabled'=>'$conf->icstmd->enabled',
			'perms'=>'1',
			'target' => '',
			'user' => 0 
		);
		//
		// Example to declare a Left Menu entry into an existing Top menu entry:
		//$this->menu[]=array(
		//	// Use 'fk_mainmenu=xxx' or 'fk_mainmenu=xxx,fk_leftmenu=yyy'
		//	'fk_menu'=>'fk_mainmenu=mainmenucode',
		//	// This is a Left menu entry
		//	'type'=>'left',
		// Menu's title. FIXME: use a translation key
		//	'titre'=>'Icstmd left menu',
		// This menu's mainmenu ID
		//	'mainmenu'=>'mainmenucode',
		// This menu's leftmenu ID
		//	'leftmenu'=>'icstmd',
		//	'url'=>'/icstmd/pagelevel2.php',
		//	// Lang file to use (without .lang) by module.
		//	// File must be in langs/code_CODE/ directory.
		//	'langs'=>'mylangfile',
		//	'position'=>100,
		//	// Define condition to show or hide menu entry.
		//	// Use '$conf->icstmd->enabled' if entry must be visible if module is enabled.
		//	// Use '$leftmenu==\'system\'' to show if leftmenu system is selected.
		//	'enabled'=>'$conf->icstmd->enabled',
		//	// Use 'perms'=>'$user->rights->icstmd->level1->level2'
		//	// if you want your menu with a permission rules
		//	'perms'=>'1',
		//	'target'=>'',
		//	// 0=Menu for internal users, 1=external users, 2=both
		//	'user'=>2
		//);

		// Exports
		//$r = 0;
		// Example:
		//$this->export_code[$r]=$this->rights_class.'_'.$r;
		//// Translation key (used only if key ExportDataset_xxx_z not found)
		//$this->export_label[$r]='CustomersInvoicesAndInvoiceLines';
		//// Condition to show export in list (ie: '$user->id==3').
		//// Set to 1 to always show when module is enabled.
		//$this->export_enabled[$r]='1';
		//$this->export_permission[$r]=array(array("facture","facture","export"));
		//$this->export_fields_array[$r]=array(
		//	's.rowid'=>"IdCompany",
		//	's.nom'=>'CompanyName',
		//	's.address'=>'Address',
		//	's.cp'=>'Zip',
		//	's.ville'=>'Town',
		//	's.fk_pays'=>'Country',
		//	's.tel'=>'Phone',
		//	's.siren'=>'ProfId1',
		//	's.siret'=>'ProfId2',
		//	's.ape'=>'ProfId3',
		//	's.idprof4'=>'ProfId4',
		//	's.code_compta'=>'CustomerAccountancyCode',
		//	's.code_compta_fournisseur'=>'SupplierAccountancyCode',
		//	'f.rowid'=>"InvoiceId",
		//	'f.facnumber'=>"InvoiceRef",
		//	'f.datec'=>"InvoiceDateCreation",
		//	'f.datef'=>"DateInvoice",
		//	'f.total'=>"TotalHT",
		//	'f.total_ttc'=>"TotalTTC",
		//	'f.tva'=>"TotalVAT",
		//	'f.paye'=>"InvoicePaid",
		//	'f.fk_statut'=>'InvoiceStatus',
		//	'f.note'=>"InvoiceNote",
		//	'fd.rowid'=>'LineId',
		//	'fd.description'=>"LineDescription",
		//	'fd.price'=>"LineUnitPrice",
		//	'fd.tva_tx'=>"LineVATRate",
		//	'fd.qty'=>"LineQty",
		//	'fd.total_ht'=>"LineTotalHT",
		//	'fd.total_tva'=>"LineTotalTVA",
		//	'fd.total_ttc'=>"LineTotalTTC",
		//	'fd.date_start'=>"DateStart",
		//	'fd.date_end'=>"DateEnd",
		//	'fd.fk_product'=>'ProductId',
		//	'p.ref'=>'ProductRef'
		//);
		//$this->export_entities_array[$r]=array('s.rowid'=>"company",
		//	's.nom'=>'company',
		//	's.address'=>'company',
		//	's.cp'=>'company',
		//	's.ville'=>'company',
		//	's.fk_pays'=>'company',
		//	's.tel'=>'company',
		//	's.siren'=>'company',
		//	's.siret'=>'company',
		//	's.ape'=>'company',
		//	's.idprof4'=>'company',
		//	's.code_compta'=>'company',
		//	's.code_compta_fournisseur'=>'company',
		//	'f.rowid'=>"invoice",
		//	'f.facnumber'=>"invoice",
		//	'f.datec'=>"invoice",
		//	'f.datef'=>"invoice",
		//	'f.total'=>"invoice",
		//	'f.total_ttc'=>"invoice",
		//	'f.tva'=>"invoice",
		//	'f.paye'=>"invoice",
		//	'f.fk_statut'=>'invoice',
		//	'f.note'=>"invoice",
		//	'fd.rowid'=>'invoice_line',
		//	'fd.description'=>"invoice_line",
		//	'fd.price'=>"invoice_line",
		//	'fd.total_ht'=>"invoice_line",
		//	'fd.total_tva'=>"invoice_line",
		//	'fd.total_ttc'=>"invoice_line",
		//	'fd.tva_tx'=>"invoice_line",
		//	'fd.qty'=>"invoice_line",
		//	'fd.date_start'=>"invoice_line",
		//	'fd.date_end'=>"invoice_line",
		//	'fd.fk_product'=>'product',
		//	'p.ref'=>'product'
		//);
		//$this->export_sql_start[$r] = 'SELECT DISTINCT ';
		//$this->export_sql_end[$r] = ' FROM (' . MAIN_DB_PREFIX . 'facture as f, '
		//	. MAIN_DB_PREFIX . 'facturedet as fd, ' . MAIN_DB_PREFIX . 'societe as s)';
		//$this->export_sql_end[$r] .= ' LEFT JOIN ' . MAIN_DB_PREFIX
		//	. 'product as p on (fd.fk_product = p.rowid)';
		//$this->export_sql_end[$r] .= ' WHERE f.fk_soc = s.rowid '
		//	. 'AND f.rowid = fd.fk_facture';
		//$r++;
	}

	/**
	 * Function called when module is enabled.
	 * The init function add constants, boxes, permissions and menus
	 * (defined in constructor) into Dolibarr database.
	 * It also creates data directories
	 *
	 * @param string $options Options when enabling module ('', 'noboxes')
	 * @return int 1 if OK, 0 if KO
	 */
	public function init($options = '')
	{
		$sql = array();

		$result = $this->loadTables();

		return $this->_init($sql, $options);
	}

	/**
	 * Create tables, keys and data required by module
	 * Files llx_table1.sql, llx_table1.key.sql llx_data.sql with create table, create keys
	 * and create data commands must be stored in directory /icstmd/sql/
	 * This function is called by this->init
	 *
	 * @return int <=0 if KO, >0 if OK
	 */
	private function loadTables()
	{
		return $this->_load_tables('/icstmd/sql/');
	}

	/**
	 * Function called when module is disabled.
	 * Remove from database constants, boxes and permissions from Dolibarr database.
	 * Data directories are not deleted
	 *
	 * @param string $options Options when enabling module ('', 'noboxes')
	 * @return int 1 if OK, 0 if KO
	 */
	public function remove($options = '')
	{
		$sql = array();

		return $this->_remove($sql, $options);
	}
}
