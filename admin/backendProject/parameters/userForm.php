<?php
function userForm($showSecurity = false)
{
  $return = [
    [
      "position" => "left",
      "section_title" => "User Info",
      "section_elements" => [
        [
          "column" => "first_name",
          "description" => "First Name",
          "required" => true,
          "type" => "text",
          "class" => "col s12 m6"
        ], [
          "column" => "last_name",
          "description" => "Last Name",
          "required" => true,
          "type" => "text",
          "class" => "col s12 m6"
        ],
        [
          "column" => "username",
          "description" => "UserName",
          "required" => true,
          "disabled" => true,
          "type" => "text",
          "class" => "col s12 m6"
        ],
        [
          "column" => "country",
          "description" => "Country",
          "class" => "col s12 m6",
          "type" => "select",
          "source" => "countries",
        ],

      ]
    ],
    [
      "position" => "right",
      "section_title" => "Contact Info",
      "section_elements" => [
        [
          "column" => "phone",
          "description" => "Phone Number",
          "class" => "col s12",
          "type" => "text"
        ],
        [
          "column" => "from_admin",
          "value" => "1",
          "type" => "hidden",
          "class" => "hide",
        ],
        [
          "column" => "email",
          "description" => "Email",
          "class" => "col s12 m12",
          "type" => "text",
          "required" => true,
        ]
      ]
    ],

    [
      "position" => "middle",
      "section_title" => "Others",
      "section_elements" => [

        [
          "column" => "balance",
          "description" => "Main Wallet",
          "class" => "col s12 m3",
          "type" => "number",
          "required" => true,
        ],
        [
          "column" => "status",
          "description" => "Profile Status",
          "required" => true,
          "type" => "select",
          "source" => "approval",
          "class" => "col s12 m3"
        ],
        [
          "column" => "type",
          "description" => "Category",
          "class" => "col s12 m3",
          "type" => "select",
          "required" => true,
          "source" => "user-category",
          "value" => "****************",
        ],
        [
          "column" => "kyc_status",
          "description" => "KYC Status",
          "class" => "col s12 m3",
          "type" => "select",
          "required" => true,
          "source" => "approval",
        ],
      ]
    ],
  ];
  if ($showSecurity) {
    $return = array_merge($return, [
      [
        "position" => "left",
        "section_title" => "Security Settings",
        "section_elements" => [
          [
            "column" => "type",
            "description" => "Category",
            "class" => "col s12 m6",
            "type" => "select",
            "required" => true,
            "source" => "user-category",
            "value" => "****************",
          ],
          [
            "column" => "role",
            "description" => "Assign Admin Role",
            "type" => "select",
            "required" => true,
            "class" => "col s12 m6",
            "source" => "role",
          ],
          [
            "column" => "access_level",
            "description" => "Access Level",
            "type" => "select",
            "required" => true,
            "class" => "col s12 m6",
            "source" => "accessLevel",
          ],
          [
            "column" => "password",
            "description" => "Password",
            "type" => "password",
            "required" => true,
            "class" => "col s12 m6"
          ],
        ]
      ],
      [
        "position" => "right",
        "section_title" => "Photo",
        "section_elements" => [
          [
            "column" => "picture_ref",
            "description" => "Profile Photo",
            "class" => "col s12 h--100",
            "type" => "picture",
            "required" => true,
          ],
        ]
      ]
    ]);
  } else {
    $return = array_merge($return, [
      [
        "position" => "middle",
        "section_title" => "KYC",
        "section_elements" => [

          [
            "column" => "picture_ref",
            "description" => "Photo ID",
            "class" => "col s12 m6",
            "type" => "displayPicture",
          ],
          [
            "column" => "kyc_identity",
            "description" => "ID Image",
            "class" => "col s12 m6",
            "type" => "displayPicture",
          ],
        ]
      ]
    ]);
  }
  return $return;
}

function accountForm()
{
  return [
    [
      'position' => 'center',
      'section_title' => 'User Investments',
      'section_elements' => [
        [
          'column' => 'plan',
          'description' => 'Select Investment Plan',
          'class' => 'left col s12',
          'required' => true,
          'type' => 'select',
          'source' => 'plans',
          "event" => [
            "name" => "onchange",
            "function" => "attach_name(this)"
          ]
        ], [
          'column' => 'amount',
          'description' => 'Capital',
          'class' => 'left col s12',
          'required' => true,
          'type' => 'number'
        ], [
          'column' => 'name',
          'class' => 'hide m12',
          'required' => true,
          'type' => 'hidden'
        ],
        [
          'column' => 'status',
          'description' => 'Activation Status',
          'class' => 'left col s12 m12',
          'source' => 'active',
          'type' => 'select'
        ],
        [
          'column' => 'return_values',
          'type' => 'text',
          'value' => '1',
          'class' => 'hide'
        ]
      ]
    ]
  ];
}
