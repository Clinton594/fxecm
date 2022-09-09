<?php
require_once("userForm.php");
$user_id = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : 0;
$user_al = isset($_SESSION["accesslevel"]) ? $_SESSION["accesslevel"] : 1;
$actLog = $user_al >= 2 ? "" : ", user_id=$user_id";

$param = [
	"admin_signin" => [ //Signin Parameters
		"table" 			=> "users",
		"primary_key"	=> "id",
		"date_col"	=> "date",
		"page_title" => "Admin Profile",
		"username_col" => "username",
		"password_col" => "password",
		"password_hash" => "password_hash",
		"name_col"  	=> "first_name",
		"last_name_col"  	=> "last_name",
		"phone_col"  	=> "phone",
		"email_col" 	=> "email",
		"image_col"		=> "picture_ref",
		"form"		=> "users",
		"display_fields" => [
			[
				"column" => "date",
				"description" => "Registration Date",
				"action" => "datetime",
			],
			[
				"column" => "gender",
				"description" => "Gender",
				"action" => "select",
				"source" => "gender"
			],
			[
				"column" => "dob",
				"description" => "Date of Birth",
				"action" => "date"
			]
		],
		"retrieve_filter"	=> "type=1, status=1",
		"callback" 		=> "signin_log",
	],

	"organization" 	=> [ //The current organization using the code
		"table"				=> "company_info",
		"primary_key"	=> "id",
		"key"	=> 1,
		"page_title"	=> "Settings",
		"form" => [
			"sections" => [
				[
					"position" => "left",
					"section_title" => "Basic Company Info",
					"section_elements" => [
						[
							"column" => "name",
							"description" => "Business Name",
							"required" => true,
							"type" => "text",
							"class" => "col s12 m12"
						], [
							"column" => "email",
							"description" => "Email Address",
							"required" => true,
							"type" => "text",
							"class" => "col s12 m12"
						], [
							"column" => "website",
							"description" => "Website",
							"required" => false,
							"type" => "text",
							"class" => "col s12 m12"
						], [
							"column" => "address",
							"description" => "Address",
							"required" => false,
							"type" => "text",
							"class" => "col s12 m12"
						],
						[
							"column" => "phone",
							"description" => "Phone",
							"type" => "text",
							"required" => true,
							"class" => "col s12 m12",
						],
						[
							"column" => "other",
							"description" => "Set Minimum Withdrawal",
							"type" => "number",
							"required" => true,
							"class" => "col s12 m12",
						],
						[
							"column" => "divider",
							"type" => "divider",
							"class" => "col s12 m6",
						], [
							"column" => "useAPY",
							"description" => "Toggle APY | ROI",
							"type" => "switch",
							"source" => "apyRoi",
							"class" => "col s12 m6",
						], [
							"column" => "lock_site",
							"description" => "Disable the Website ?",
							"type" => "switch",
							"source" => "bool",
							"class" => "col s12 m12",
						],
						[
							"column" => "divider",
							"type" => "divider",
							"class" => "col s12 m6",
						], [
							"column" => "lock_withdrawals",
							"description" => "Disable All Withdrawals",
							"type" => "switch",
							"source" => "bool",
							"class" => "col s12 m6",
						], [
							"column" => "concurrent_withdrawal",
							"description" => "Allow While running",
							"type" => "switch",
							"source" => "bool",
							"class" => "col s12 m12",
						],
					]
				],
				[
					"position" => "right",
					"section_title" => "Company Logo",
					"section_elements" => [
						[
							"column" => "logo_ref",
							"description" => "Logo",
							"required" => true,
							"type" => "items",
							"value" => 4,
							"class" => "col s12 m12"
						]
					]
				],
				[
					"position" => "right",
					"section_title" => "Social Media",
					"section_elements" => [
						[
							"column" => "branches",
							"description" => "Media Links",
							// "required" => true,
							"type" => "description",
							"class" => "col s12 m12"
						]
					]
				]
			]
		]
	],

	"role" => [
		"table" => "roles",
		"primary_key" => "id",
		"page_title" => "Roles",
		"display_fields" => [
			[
				"column" => "rolename",
				"description" => "Role Name",
				"component" => "span",
			]
		],
		"form" => [
			"sections" => [
				[
					"position" => "center",
					"section_title" => "Role Info",
					"section_elements" => [
						[
							"column" => "rolename",
							"description" => "Role Name",
							"type" => "text",
							"required" => true,
							"class" => "col s12 m12"
						], [
							"column" => "roledesc",
							"description" => "Role Name",
							"required" => true,
							"type" => "roles",
							"class" => "col s12 m12"
						]
					]
				]
			]
		]
	],

	"log" => [
		"table" => "activitylog",
		"primary_key" => "id",
		"page_title" => "log",
		"listFAB" => false,
		"retrieve_filter" => "type='admin' $actLog",
		"sort_col" => "id DESC",
		"display_fields" => [
			[
				"column" => "action",
				"description" => "Action",
				"component" => "span"
			], [
				"column" => "description",
				"description" => "Description",
				"component" => "span"
			], [
				"column" => "date",
				"description" => "Time",
				"component" => "span",
				"action" => "datetime"
			]
		],
		"form" => [
			"form_view" => "modal",
			"sections" => [
				[
					"position" => "center",
					"section_title" => "Log Details",
					"section_elements" => [
						[
							"column" => "description",
							"description" => "Description",
							"type" => "textarea",
							"readonly" => true,
							"class" => "col s12"
						]
					]
				]
			]
		]
	],

	"users" => [
		"table" => "users",
		"primary_key" => "id",
		"page_title" => "Admin Users",
		"fixed_values" => "status=1",
		"retrieve_filter" => "status=1, type=1",
		"pre_submit_function" => "prepare_new_member",
		"post_delete_function" => "delete_referral_record",
		"listFAB" => ["refresh", "send-email", "delete"],
		"extension" => ["open_memeber", "referrals"],
		"display_fields" => [
			[
				"column" => "username",
				"description" => "UserName",
				"component" => "span",
			],
			[
				"column" => "balance",
				"description" => "Balance",
				"component" => "span",
				"action" => "myround",
			],
			[
				"column" => "terra",
				"description" => "Mentor",
				"component" => "span",
				"action" => "select",
				"source" => "users",
			],

			[
				"table" => "referral",
				"actioncol" => "referral_id",
				"column" => "referral_id",
				"description" => "Referrals",
				"component" => "span",
				"action" => "count",
			],
			[
				"table" => "accounts",
				"actioncol" => "user_id",
				"column" => "user_id",
				"description" => "Portfolio",
				"component" => "span",
				"action" => "count",
			],
			[
				"column" => "date",
				"action" => "datetime",
				"description" => "Date",
				"component" => "span",
			]
		],
		"form" => [
			"form_view" => "modal",
			"form_size" => "modal-lg",
			"sections" => userForm(true)
		]
	],

	"members" => [
		"table" => "users",
		"primary_key" => "id",
		"page_title" => "Verified Members",
		"fixed_values" => "status=1, type=2, kyc_status=1",
		"extension" => ["open_memeber", "referrals"],
		"listFAB" => ["refresh", "send-email", "delete"],
		"post_delete_function" => "delete_referral_record",
		"pre_submit_function" => "prepare_new_member",
		"retrieve_filter" => "status=1, type=2, kyc_status=1",
		"display_fields" => [
			[
				"column" => "username",
				"description" => "UserName",
				"component" => "span",
			],
			[
				"column" => "balance",
				"description" => "Balance",
				"component" => "span",
				"action" => "myround",
			],
			[
				"column" => "terra",
				"description" => "Mentor",
				"component" => "span",
				"action" => "select",
				"source" => "users",
			],

			[
				"table" => "referral",
				"actioncol" => "referral_id",
				"column" => "referral_id",
				"description" => "Referrals",
				"component" => "span",
				"action" => "count",
			],
			[
				"table" => "accounts",
				"actioncol" => "user_id",
				"column" => "user_id",
				"description" => "Portfolio",
				"component" => "span",
				"action" => "count",
			],
			[
				"column" => "date",
				"action" => "datetime",
				"description" => "Date",
				"component" => "span",
			]
		],
		"form" => [
			"form_view" => "modal",
			"form_size" => "modal-lg",
			"sections" => userForm()
		]
	],

	"other-members" => [
		"table" => "users",
		"primary_key" => "id",
		"page_title" => "Other Members",
		"fixed_values" => "type=2, status=0",
		"listFAB" => ["refresh", "add", "send-email", "delete"],
		"pre_submit_function" => "prepare_new_member",
		"post_delete_function" => "delete_referral_record",
		"retrieve_filter" => "type=2, kyc_status!=1",
		"sort" => "balance DESC",
		"display_fields" => [
			[
				"column" => "username",
				"description" => "UserName",
				"component" => "span",
			],
			[
				"column" => "balance",
				"description" => "Balance",
				"component" => "span",
				"action" => "myround",
			],
			[
				"column" => "terra",
				"description" => "Mentor",
				"component" => "span",
				"action" => "select",
				"source" => "users",
			],
			[
				"table" => "accounts",
				"column" => "user_id",
				"actioncol" => "user_id",
				"description" => "Portfolio",
				"component" => "span",
				"action" => "count",
			],
			[
				"column" => "date",
				"action" => "datetime",
				"description" => "Date",
				"component" => "span",
			]
		],
		"form" => [
			"form_view" => "modal",
			"form_size" => "modal-lg",
			"sections" => userForm()
		]
	],

	"subscribers" => [
		"table" => "subscribers",
		"primary_key" => "id",
		"page_title" => "Subscribers",
		"listFAB" => ["delete"],
		"display_fields" => [
			[
				"column" => "email",
				"description" => "Email",
				"component" => "span"
			]
		],
		"form" => [
			"form_view" => "modal",
			"sections" => [
				[
					"position" => "center",
					"section_title" => "Subscriber Info",
					"section_elements" => [
						[
							"column" => "name",
							"description" => "Subscriber Name",
							"type" => "text",
							"required" => true,
							"class" => "col s12 m12"
						], [
							"column" => "email",
							"description" => "Email",
							"type" => "email",
							"required" => true,
							"class" => "col s12 m12"
						]
					]
				]
			]
		]
	],

	'messages' => [
		'table' => 'conversation',
		'primary_key' => 'id',
		'page_title' => 'Comments',
		'retrieve_filter' => "type='comment'",
		'listFAB' => ['delete'],
		'display_fields' => [
			[
				'column' => 'user_name',
				'description' => 'Name',
				'component' => 'span'
			], [
				'column' => 'message',
				'description' => 'Comment',
				'component' => 'span'
			], [
				'column' => 'post_id',
				'description' => 'On Article',
				'component' => 'span',
				'action' => 'select',
				'source' => 'products'
			], [
				'column' => 'time',
				'description' => 'Time',
				'component' => 'span',
				'action' => 'datetime'
			]
		],
		'form' => [
			"form_view" => "modal",
			'sections' => [
				[
					'position' => 'center',
					'section_title' => 'wrote',
					'section_elements' => [
						[
							'column' => 'message',
							'description' => 'Message',
							'type' => 'textarea',
							'required' => true,
							'readonly' => true,
							'class' => 'col s12 m12'
						]
					]
				]
			]
		]
	],

	'added-coins' => [
		'table' => 'coins',
		'primary_key' => 'id',
		'unique_key' => 'symbol',
		"pre_submit_function" => "getCoinImage",
		'page_title' => 'Coins',
		'display_fields' => [
			[
				'column' => 'name',
				'description' => 'Name',
				'component' => 'span'
			],
			[
				'column' => 'logo',
				'description' => 'Logo',
				'component' => 'img',
				"class" => "left"
			],
			[
				'column' => 'symbol',
				'description' => 'symbol',
				'component' => 'span'
			],

			[
				'column' => 'date_created',
				'description' => 'Time',
				'component' => 'span',
				'action' => 'datetime'
			]
		],
		'form' => [
			"form_view" => "modal",
			"form_size" => "modal-lg",
			'sections' => [
				[
					'position' => 'left',
					'section_title' => 'Coin Details',
					'section_elements' => [
						[
							'column' => 'name',
							'description' => 'Coin Name',
							'type' => 'combo',
							'source' => "loadcoins",
							'value' => "name",
							'multiple' => "name, symbol",
							"event" => [
								"type" => "callback",
								"function" => "fillupcard"
							],
							'required' => true,
							'class' => 'col s12'
						],
						[
							'column' => 'symbol',
							'description' => 'Coin Symbol',
							'type' => 'text',
							'required' => true,
							'readonly' => true,
							'class' => 'col s12 m6'
						],


						[
							'column' => 'network',
							'description' => 'Coin Network',
							'type' => 'select',
							'required' => true,
							'source' => "coin_networks",
							'class' => 'col s12 m6'
						],
						[
							'column' => 'coin_id',
							'description' => 'Coin ID',
							'type' => 'hidden',
							'required' => true,
							'readonly' => true,
							'class' => 'col s12 m12 hide'
						],
						[
							'column' => 'logo',
							'type' => 'hidden',
							'class' => 'col s12 m12 hide'
						],
					]
				],
				[
					'position' => 'right',
					'section_title' => 'Wallet QR Code',
					'section_elements' => [
						[
							'column' => 'qr_code',
							'description' => 'QR Code',
							'type' => 'picture',
							'required' => true,
							'class' => 'col s12 m12'
						]
					]
				],
				[
					'position' => 'center',
					'section_title' => 'Wallet Address',
					'section_elements' => [
						[
							'column' => 'wallet',
							'description' => 'Wallet Address',
							'type' => 'text',
							'required' => true,
							'class' => 'col s12 m8'
						],
						[
							'column' => 'withdrawal',
							'description' => 'Add to User Withdrawal',
							'type' => 'switch',
							'source' => "bool",
							'class' => 'col s12 m4'
						]
					]
				]
			]
		]
	],

	'translogs' => [
		'table' => 'content',
		'primary_key' => 'id',
		'page_title' => 'Manual Transaction',
		'retrieve_filter' => "type='translogs'",
		'extra_values' => "date_updated=now()",
		'fixed_values' => "type='translogs',no_of_views='0', user_id='$user_id'",
		'sort_col' => "date_updated DESC",
		'display_fields' => [
			[
				'column' => 'title',
				'description' => 'Name',
				'component' => 'span',
				'class' => 'col s2',
			], [
				'column' => 'business',
				'description' => 'Amount',
				'component' => 'span',
				'class' => 'col s2',
			], [
				'column' => 'category',
				'description' => 'Type',
				'component' => 'span',
				'action' => 'select',
				'source' => 'translogs',
				'class' => 'col s2',
			], [
				'column' => 'date_updated',
				'description' => 'Time',
				'component' => 'span',
				'action' => 'datetime',
				'class' => 'col s2'
			], [
				'column' => 'status',
				'description' => 'Status',
				'component' => 'span',
				'action' => 'select',
				'source' => 'active',
				'class' => 'col s2',
			], [
				'column' => 'date_updated',
				'description' => 'Time',
				'component' => 'span',
				'action' => 'datetime',
				'class' => 'col s2',
			]
		],
		'form' => [
			"form_view" => "modal",
			'sections' => [
				[
					'position' => 'right',
					'section_title' => 'Picture',
					'section_elements' => [
						[
							'column' => 'view',
							'description' => 'Message',
							'type' => 'picture',
							'required' => true,
							'readonly' => true,
							'class' => 'col s12 m12'
						], [
							'column' => 'status',
							'description' => 'Activate ?',
							'type' => 'switch',
							'source' => 'active',
							'class' => 'col s12 m12'
						]
					]
				], [
					'position' => 'left',
					'section_title' => 'Reviewer Info',
					'section_elements' => [
						[
							'column' => 'title',
							'description' => 'Name',
							'type' => 'text',
							'required' => true,
							'class' => 'col s12 m6'
						], [
							'column' => 'label',
							'description' => 'Role',
							'type' => 'text',
							'required' => true,
							'value' => "Member",
							'class' => 'col s12 m6'
						], [
							'column' => 'body',
							'description' => 'Message',
							'type' => 'textarea',
							'required' => true,
							'class' => 'col s12 m12'
						]
					]
				]
			]
		]
	],

	'deposits' => [
		'table' => 'transaction',
		'primary_key' => 'id',
		'page_title' => 'Deposits',
		'post_submit_function' => 'manageAccount',
		'retrieve_filter' => "tx_type='deposit', tx_type=exchange",
		'listFAB' => ["refresh", "delete"],
		'sort' => 'date DESC',
		'display_fields' => [
			[
				'column' => 'user_id',
				'description' => 'Member',
				'component' => 'span',
				'action' => 'select',
				'source' => 'allusers'
			],
			[
				'column' => 'amount',
				'description' => 'Amount',
				'component' => 'span',
			],
			[
				'column' => 'description',
				'description' => 'Description',
				'component' => 'span',
				// 'action' => 'select',
				// 'source' => 'accounts',
			], [
				'column' => 'date',
				'description' => 'Date',
				'component' => 'span',
				'action' => 'datetime',
			], [
				'column' => 'status',
				'description' => 'Status',
				'component' => 'span',
				'action' => 'select',
				'source' => 'confirm',
			]
		],
		'form' => [
			"form_view" => "modal",
			'sections' => [
				[
					'position' => 'center',
					'section_title' => 'Transaction Details',
					'section_elements' => [
						[
							'column' => 'tx_no',
							'description' => 'Transaction Hash',
							'class' => 'left col s12 m12',
							'required' => true,
							'readonly' => true,
							'type' => 'text'
						], [
							'column' => 'amount',
							'description' => 'Amount',
							'class' => 'left col s12 m6',
							'required' => true,
							// 'readonly' => true,
							'type' => 'text'
						], [
							'column' => 'date',
							'description' => 'Time',
							'class' => 'left col s12 m6',
							'required' => true,
							'readonly' => true,
							'type' => 'text'
						], [
							'column' => 'paid_into',
							'description' => 'Payment Account',
							'class' => 'left col s12',
							'required' => true,
							'readonly' => true,
							'type' => 'text'
						], [
							'column' => 'status',
							'description' => 'Confirm ?',
							'class' => 'left col s12',
							'source' => 'confirm',
							'type' => 'switch'
						]
					]
				]
			]
		]
	],

	'invest' => [
		'table' => 'transaction',
		'primary_key' => 'id',
		'page_title' => 'Investment',
		'retrieve_filter' => "tx_type='invest'",
		'listFAB' => ["refresh", "delete"],
		'sort' => 'date DESC',
		'display_fields' => [
			[
				'column' => 'user_id',
				'description' => 'Member',
				'component' => 'span',
				'action' => 'select',
				'source' => 'allusers'
			], [
				'column' => 'amount',
				'description' => 'Amount',
				'component' => 'span',
			], [
				'column' => 'description',
				'description' => 'Description',
				'component' => 'span',
				// 'action' => 'select',
				// 'source' => 'accounts',
			], [
				'column' => 'date',
				'description' => 'Date',
				'component' => 'span',
				'action' => 'datetime',
			], [
				'column' => 'status',
				'description' => 'Status',
				'component' => 'span',
				'action' => 'select',
				'source' => 'confirm',
			]
		],
		'form' => [
			"form_view" => "modal",
			'sections' => [
				[
					'position' => 'left',
					'section_title' => 'Transaction Details',
					'section_elements' => [
						[
							'column' => 'tx_no',
							'description' => 'Reference Number',
							'class' => 'left col s12 m12',
							'required' => true,
							'readonly' => true,
							'type' => 'text'
						], [
							'column' => 'amount',
							'description' => 'Amount',
							'class' => 'left col s12 m6',
							'required' => true,
							'readonly' => true,
							'type' => 'text'
						], [
							'column' => 'date',
							'description' => 'Time',
							'class' => 'left col s12 m6',
							'required' => true,
							'readonly' => true,
							'type' => 'text'
						], [
							'column' => 'paid_into',
							'description' => 'Payment Account',
							'class' => 'left col s12',
							'required' => true,
							'readonly' => true,
							'type' => 'text'
						], [
							'column' => 'status',
							'description' => 'Confirm ?',
							'class' => 'left col s12',
							'source' => 'confirm',
							'type' => 'switch'
						]
					]
				], [
					'position' => 'right',
					'section_title' => 'Evidence',
					'section_elements' => [
						[
							'column' => 'snapshot',
							'description' => 'Snapshot',
							'class' => 'left col s12',
							'type' => 'displayPicture'
						]
					]
				]
			]
		]
	],

	"bonus" => [
		'table' => 'transaction',
		'primary_key' => 'id',
		'page_title' => 'Investment',
	],

	'interests' => [
		'table' => 'transaction',
		'primary_key' => 'id',
		'page_title' => 'Interest History',
		'retrieve_filter' => "tx_type='topup'",
		'fixed_values' => "tx_type='topup'",
		'listFAB' => ["refresh"],
		'sort' => 'date DESC',
		'display_fields' => [
			[
				'column' => 'user_id',
				'description' => 'Member',
				'component' => 'span',
				'action' => 'select',
				'source' => 'allusers'
			], [
				'column' => 'amount',
				'description' => 'Amount',
				'component' => 'span',
			], [
				'column' => 'account_id',
				'description' => 'Plan',
				'component' => 'span',
				'action' => 'select',
				'source' => 'accounts',
			], [
				'column' => 'date',
				'description' => 'Date',
				'component' => 'span',
				'action' => 'datetime',
			], [
				'column' => 'status',
				'description' => 'Status',
				'component' => 'span',
				'action' => 'select',
				'source' => 'confirm',
			]
		],
		'form' => [
			"form_view" => "modal",
			"form_submit" => false,
		]
	],

	'invoice' => [
		'table' => 'transaction',
		'primary_key' => 'id',
		'page_title' => 'Pending Deposits',
		'retrieve_filter' => "tx_type='invoice', tx_type='cancelled'",
		'fixed_values' => "tx_type='invoice'",
		'listFAB' => ["refresh", "delete"],
		'sort' => 'date DESC',
		'display_fields' => [
			[
				'column' => 'user_id',
				'description' => 'Member',
				'component' => 'span',
				'action' => 'select',
				'source' => 'allusers'
			], [
				'column' => 'amount',
				'description' => 'Amount',
				'component' => 'span',
			], [

				'column' => 'tx_type',
				'description' => 'Type',
				'component' => 'span',
			], [
				'column' => 'date',
				'description' => 'Date',
				'component' => 'span',
				'action' => 'datetime',
			], [
				'column' => 'status',
				'description' => 'Status',
				'component' => 'span',
				'action' => 'select',
				'source' => 'approval',
			]
		],
		'form' => [
			"form_view" => "modal",
			'sections' => [
				[
					'position' => 'center',
					'section_title' => 'Transaction Details',
					'section_elements' => [
						[
							'column' => 'amount',
							'description' => 'Amount',
							'class' => 'left col s12 m6',
							'required' => true,
							'readonly' => true,
							'type' => 'text'
						], [
							'column' => 'date',
							'description' => 'Time',
							'class' => 'left col s12 m6',
							'required' => true,
							'readonly' => true,
							'type' => 'text'
						], [
							'column' => 'tx_type',
							'description' => 'Action',
							'class' => 'left col s12',
							'required' => true,
							'empty' => false,
							'source' => "tx_type",
							'type' => 'select'
						], [
							'column' => 'status',
							'description' => 'Status',
							'class' => 'left col s12',
							'source' => 'approval',
							'type' => 'select',
							"disabled" => true
						]
					]
				]
			]
		]
	],

	'withdrawals' => [
		'table' => 'transaction',
		'primary_key' => 'id',
		'page_title' => 'Withdrawals',
		'retrieve_filter' => "tx_type='withdrawal'",
		'fixed_values' => "tx_type='withdrawal'",
		'post_submit_function' => "notifyUser",
		'listFAB' => ["refresh", "delete"],
		'sort' => 'id DESC',
		'display_fields' => [
			[
				'column' => 'user_id',
				'description' => 'Member',
				'component' => 'span',
				'action' => 'select',
				'source' => 'allusers'
			],
			[
				'column' => 'amount',
				'description' => 'Amount',
				'component' => 'span',
			],
			[
				'column' => 'date',
				'description' => 'Date',
				'component' => 'span',
				'action' => 'datetime',
			],
			[
				'column' => 'status',
				'description' => 'Status',
				'component' => 'span',
				'action' => 'select',
				'source' => 'confirm',
			]
		],
		'form' => [
			"form_view" => "modal",
			'sections' => [
				[
					'position' => 'center',
					'section_title' => 'Transaction Details',
					'section_elements' => [
						[
							'column' => 'tx_no',
							'description' => 'Reference Number',
							'class' => 'left col s12 m6',
							'required' => true,
							'readonly' => true,
							'type' => 'text'
						], [
							'column' => 'amount',
							'description' => 'Amount',
							'class' => 'left col s12 m6',
							'required' => true,
							// 'readonly' => true,
							'type' => 'text'
						], [
							'column' => 'paid_into',
							'description' => 'Wallet Name',
							'class' => 'left col s12 m6',
							'required' => true,
							'readonly' => true,
							'type' => 'text'
						], [
							'column' => 'account_details',
							'description' => 'Wallet Address',
							'class' => 'left col s12 m6',
							'required' => true,
							'readonly' => true,
							'type' => 'text'
						], [
							'column' => 'status',
							'description' => 'Confirm ?',
							'class' => 'left col s12',
							'source' => 'approval',
							'type' => 'select'
						],
						[
							'column' => 'tx_type',
							'class' => 'hide',
							'type' => 'hidden'
						],
						[
							'column' => 'return_values',
							'class' => 'hide',
							'value' => '1',
							'type' => 'hidden'
						],
						[
							'column' => 'user_id',
							'class' => 'hide',
							'type' => 'hidden'
						]
					]
				]
			]
		]
	],

	"plans" => [
		"table" => "content",
		"primary_key" => "id",
		"page_title" => "Plans",
		"fixed_values" => "type='investment',date_uploaded=now(),no_of_views='0', user_id='$user_id'",
		"extra_values" => "date_updated=now()",
		"retrieve_filter" => "type='investment'",
		"sort" => "business ASC",
		"listFAB" => ["add", "refresh"],
		"display_fields" => [
			[
				"column" => "title",
				"description" => "Investments",
				"component" => "span",
			],
			[
				"column" => "business",
				"description" => "Minimum",
				"component" => "span",
			],
			[
				"column" => "label",
				"description" => "Maximum",
				"component" => "span",
			],
			[
				"column" => "status",
				"description" => "Active",
				"action" => "select",
				"source" => "bool",
				"component" => "span",
			],
			[
				"column" => "date_uploaded",
				"description" => "Date",
				"action" => "datetime",
				"component" => "span",
			]
		],
		"form" => [
			"form_view" => "modal",
			"sections" => [
				[
					"position" => "center",
					"section_title" => "Plan Info",
					"section_elements" => [
						[
							"column" => "title",
							"description" => "Plan Name",
							"type" => "text",
							"required" => true,
							"class" => "col s12 m12"
						], [
							"column" => "business",
							"description" => "Minimum Price ($)",
							"type" => "number",
							"required" => true,
							"class" => "col s12 m6",
						], [
							"column" => "label",
							"required" => true,
							"description" => "Maximum Price ($)",
							"type" => "number",
							"class" => "col s12 m6"
						],
						[
							"column" => "auto",
							"required" => true,
							"description" => "ROI(%)",
							"type" => "text",
							"class" => "col s12 m4"
						],
						[
							"column" => "view",
							"required" => true,
							"description" => "Every (days)",
							"type" => "text",
							"class" => "col s12 m4"
						],
						[
							"column" => "product",
							"required" => true,
							"description" => "Duration",
							"type" => "text",
							"class" => "col s12 m4"
						],
						[
							"description" => "Can Re-Invest",
							"column" => "parent",
							"source" => "bool",
							"type" => "switch",
							"class" => "col s12 m6"
						],
						[
							"description" => "Activation",
							"column" => "status",
							"source" => "active",
							"type" => "switch",
							"class" => "col s12 m6"
						]
					]
				]
			]
		]
	],

	"testimony" => [
		"table" => "content",
		"primary_key" => "id",
		"page_title" => "Testimonial",
		"fixed_values" => "type='testimony',date_uploaded=now(),no_of_views='0', user_id='$user_id'",
		"extra_values" => "date_updated=now()",
		"retrieve_filter" => "type='testimony'",
		"sort" => "business ASC",
		"listFAB" => ["add", "refresh"],
		"display_fields" => [
			[
				"column" => "title",
				"description" => "Full Name",
				"component" => "span",
			],
			[
				"column" => "label",
				"description" => "Level",
				"component" => "span",
			],
			[
				"column" => "status",
				"description" => "Active",
				"action" => "select",
				"source" => "bool",
				"component" => "span",
			],
			[
				"column" => "date_uploaded",
				"description" => "Date",
				"action" => "datetime",
				"component" => "span",
			]
		],
		"form" => [
			"form_view" => "modal",
			"form_size" => "modal-md",
			"sections" => [
				[
					"position" => "center",
					"section_title" => "Testimonial Info",
					"section_elements" => [
						[
							"column" => "image",
							"description" => "Photo",
							"type" => "picture",
							"required" => true,
							"class" => "col s12 m12"
						],
						[
							"column" => "title",
							"description" => "Full Name",
							"type" => "text",
							"required" => true,
							"class" => "col s12 m12"
						],
						[
							"column" => "body",
							"required" => true,
							"description" => "Message",
							"type" => "textarea",
							"class" => "col s12"
						],
						[
							"column" => "label",
							"required" => true,
							"description" => "Level",
							"type" => "text",
							"class" => "col s12 m12"
						],
						[
							"description" => "Activation",
							"column" => "status",
							"source" => "active",
							"type" => "switch",
							"class" => "col s12 m6"
						]
					]
				]
			]
		]
	],

	'adminAccounts' => [
		'table' => 'accounts',
		'primary_key' => 'id',
		'page_title' => 'Admin Investments',
		'sort' => 'date_created DESC',
		"post_submit_function" => "create_transaction_record",
		'actions' => [],
		"extension" => ["account-updates"],
		'display_fields' => [
			[
				'column' => 'name',
				'description' => 'Account Name',
				'component' => 'span'
			], [
				'column' => 'amount',
				'description' => 'Capital',
				'component' => 'span'
			], [
				'column' => 'date_created',
				'description' => 'Opening Date',
				'component' => 'span',
				'action' => 'datetime'
			], [
				'column' => 'status',
				'description' => 'Status',
				'component' => 'span',
				'action' => 'select',
				'source' => 'status',
			]

		],
		'display_level' => [
			'source' => 'users',
			'column' => 'user_id',
			'loadform' => true
		],
		'form' => [
			"form_view" => "modal",
			'sections' => accountForm()
		]
	],

	'accounts' => [
		'table' => 'accounts',
		'primary_key' => 'id',
		'page_title' => 'Investments',
		'sort' => 'date_created DESC',
		"post_submit_function" => "create_transaction_record",
		'actions' => [],
		"extension" => ["account-updates"],
		'display_fields' => [
			[
				'column' => 'name',
				'description' => 'Account Name',
				'component' => 'span'
			], [
				'column' => 'amount',
				'description' => 'Capital',
				'component' => 'span'
			], [
				'column' => 'date_created',
				'description' => 'Opening Date',
				'component' => 'span',
				'action' => 'datetime'
			], [
				'column' => 'status',
				'description' => 'Status',
				'component' => 'span',
				'action' => 'select',
				'source' => 'status',
			]

		],
		'display_level' => [
			'source' => 'members',
			'column' => 'user_id',
			'loadform' => true
		],
		'form' => [
			"form_view" => "modal",
			'sections' => accountForm()
		]
	],

	'allusers' => [
		'table' => 'users',
		'primary_key' => 'id',
		'display_fields' => [
			[
				'column' => 'username',
				'description' => 'User Name',
				'component' => 'span'
			],
		]
	],

	'user-referrals' => [
		'table' => 'referral',
		'primary_key' => 'id',
		'sort' => 'date DESC',
		'page_title' => 'Referral List',
		'display_fields' => [
			[
				'column' => 'referral_id',
				'description' => 'Upline',
				'component' => 'span',
				'action' => 'select',
				'source' => [
					"pageType" => "allusers",
					"column" => ["username"]
				],
			],
			[
				'column' => 'referred_id',
				'description' => 'Downline',
				'component' => 'span',
				'action' => 'select',
				'source' => [
					"pageType" => "allusers",
					"column" => ["username"]
				],
			],
			[
				'column' => 'amount',
				'description' => 'Bonus',
				'component' => 'span'
			],
			[
				'column' => 'status',
				'description' => 'Deposited ?',
				'action' => 'select',
				'source' => 'bool',
				'component' => 'span'
			],
			[
				'column' => 'date',
				'description' => 'Date',
				'action' => 'date',
				'component' => 'span'
			],
		],
		"form" => [
			"form_view" => "modal",
			'sections' => [
				[
					'position' => 'center',
					'section_title' => 'Join Members Referral List',
					'section_elements' => [
						[
							'column' => 'referral_id',
							'description' => 'Select Upline',
							'class' => 'col s12 m12',
							'required' => true,
							'source' => [
								"pageType" => "allusers",
								"column" => ["username"]
							],
							'type' => 'select'
						],
						[
							'column' => 'referred_id',
							'description' => 'Select Downline',
							'class' => 'col s12 m12',
							'required' => true,
							'source' => [
								"pageType" => "allusers",
								"column" => ["username"]
							],
							'type' => 'select'
						],
						[
							'column' => 'date',
							'description' => 'Date Created',
							'class' => 'col s12 m6',
							'required' => true,
							'type' => 'date'
						],
						[
							'column' => 'amount',
							'description' => 'Bonus',
							'class' => 'col s12 m6',
							'required' => true,
							'type' => 'number'
						],
						[
							'column' => 'status',
							'description' => 'Approval',
							'class' => 'left col s12',
							'source' => 'approval',
							'type' => 'switch'
						]
					]
				]
			]
		]
	],

];
