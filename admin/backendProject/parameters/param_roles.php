<?php
$thisyear = date("Y");
$roles = [
  "Organization Setup" => [
    "icon"  => "home",
    "links" => [
      [
        "title" => "Dashboard",
        "url"   => "dashboard-view/dashboard-report"
      ],
      [
        "title" => "Settings",
        "url"   => "form-view/organization"
      ],
      [
        "title" => "Role",
        "url"   => "content-view/role"
      ],
    ]
  ],

  "Users" => [
    "icon"  => "user",
    "links" => [
      [
        "title" => "Administrators",
        "url"   => "level-view/adminAccounts"
      ],
      [
        "title" => "Members",
        "url"  => "level-view/accounts"
      ],
      [
        "title" => "Other Members",
        "url"  => "content-view/other-members"
      ],
      [
        "title" => "Referral List",
        "url"  => "content-view/user-referrals"
      ],
    ]
  ],

  "Business" => [
    "icon"  => "briefcase",
    "links" => [
      [
        "title" => "Coins",
        "url"  => "content-view/added-coins"
      ],
      [
        "title" => "Plans",
        "url"  => "content-view/plans"
      ],
      [
        "title" => "Testimony",
        "url"  => "content-view/testimony"
      ],
    ]
  ],

  "Transactions" => [
    "icon"  => "history",
    "links" => [
      [
        "title" => "Deposit Transactions",
        "url"  => "content-view/deposits"
      ],
      [
        "title" => "Withdrawal Transactions",
        "url"  => "content-view/withdrawals"
      ],
      [
        "title" => "Interest History",
        "url"  => "content-view/interests"
      ],
      [
        "title" => "Unpaid Transactions",
        "url"  => "content-view/invoice"
      ],
      [
        "title" => "Financial Accounts",
        "url"  => "custom-view/finance"
      ]
    ],
  ]
];
