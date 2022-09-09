<?php
$year    = date("Y");
$reports = [
  "dashboard-report" => [
    "table" => "transaction",
    "primary_key" => "id",
    "sort" => "date desc",
    "page_title" => "Financial Report",
    "report_type" => "basics",
    "icon" => "chart-pie",
    "limit" => 10,
    "retrieve_filter" => "tx_type='deposit'",
    "listFAB" => ["dashboard-report"],
    "display_fields" => [
      [
        "column" => "sum(amount)",
        "name" => "this_week",
        "description" => "This Week",
        "filter" => getDateValue("This Week", "date") . " AND tx_type='deposit'",
        "class" => "col-lg-3 col-sm-6",
        "icon" => "calendar col-green",
        "action" => "myround",
      ],
      [
        "column" => "sum(amount)",
        "name" => "last_week",
        "description" => "Last Week",
        "filter" => getDateValue("Last Week", "date") . " AND tx_type='deposit'",
        "class" => "col-lg-3 col-sm-6",
        "action" => "myround",
        "icon" => "money-bill-wave col-orange",
      ],
      [
        "column" => "sum(amount)",
        "name" => "this_month",
        "description" => "This Month",
        "filter" => getDateValue("This Month", "date") . " AND tx_type='deposit'",
        "class" => "col-lg-3 col-sm-6",
        "action" => "myround",
        "icon" => "ruble-sign col-red",
      ],
      [
        "column" => "sum(amount)",
        "name" => "last_month",
        "description" => "Last Month",
        "filter" => getDateValue("Last Month", "date") . " AND tx_type='deposit'",
        "class" => "col-lg-3 col-sm-6",
        "action" => "myround",
        "icon" => "dollar-sign col-blue",
      ]
    ],
    "form" => [
      "sections" => [
        [
          "position" => "half",
          "section_title" => "General Monthly deposits",
          "section_elements" => [
            [
              "column" => "sum(amount)",
              "name" => "latest_graph",
              "type" => "line-graph",
              "source" => "months",
              "filter" => "YEAR(date)='$year' AND tx_type='deposit' GROUP BY MONTH(date)",
              "class" => "col s12"
            ],
          ],
        ],
        [
          "position" => "right-half",
          "section_title" => "Investment Perfomance",
          "section_elements" => [
            [
              "column" => "sum(amount)",
              "name" => "performance",
              "type" => "line-graph",
              "source" => "months",
              "filter" => "YEAR(date)='$year' AND tx_type='deposit' GROUP BY MONTH(date)",
              "class" => "col s12"
            ]
          ],
        ],
        [
          "position" => "center",
          "section_title" => "Latest Transactions",
          "section_elements" => [
            [
              "column" => "latest",
              "required" => true,
              "source" => [
                "pageType" => "dashboard-report",
                "column" => ["description", "date"]
              ],
              "type" => "table",
              "class" => "col s12"
            ],
          ]
        ],
        // [
        //   "position" => "middle",
        //   "section_title" => "Top 5 customers this month",
        //   "section_elements" => [
        //     [
        //       "column" => "top5",
        //       "required" => true,
        //       "source" => [
        //         "pageType" => "top5-customers",
        //         "column" => ["customer", "telephone", "concat('₦', sum(amount))"]
        //       ],
        //       "type" => "table",
        //       "class" => "col s12"
        //     ],
        //   ]
        // ],
        // [
        //   "position" => "right",
        //   "section_title" => "Top 5 customers this month",
        //   "section_elements" => [
        //     [
        //       "column" => "top5",
        //       "required" => true,
        //       "source" => [
        //         "pageType" => "top5-customers",
        //         "column" => ["customer", "telephone", "concat('₦', sum(amount))"]
        //       ],
        //       "type" => "table",
        //       "class" => "col s12"
        //     ],
        //   ]
        // ]
      ]
    ]
  ],

  "top5-customers" => [
    "table" => "transactions",
    "primary_key" => "tid",
    "retrieve_filter" => getDateValue("This Month", "date") . " AND tx_type='deposit' GROUP BY cid",
    "page_title" => "Top 5 Customers",
    "sort" => "amount DESC",
    "limit" => "5",
  ]
];
