<?php
namespace App\Helpers;

use App\Models\Dashboard\Campaign;
use App\Models\Dashboard\Contact;
use Illuminate\Support\Facades\Auth;
use Gate;
use Illuminate\Support\Str;

class DashboardHelper
{
    static public function getMenuItems() : array
    {
        $_menuitems = [];
        // $user = Auth::user();
        $_menuitems = [
            [
                'label' => '<i class="flaticon-layers flat-mini pe-2"></i> ' . __('Dashbaord'),
                // 'url' => route('dashboard.home'),
                'route' => 'dashboard.home',
                'active' => request()->routeIs('dashboard.home'),
                'can' => 'public', //'home_access',
            ],
            [
                'label' => __('Property Listings'),
                'active' => request()->routeIs('dashboard.projects.*') || request()->routeIs('dashboard.developers.*') || request()->routeIs('dashboard.units.*') || request()->routeIs('dashboard.installments.*'),
                'can' => 'properties_access',
                'icon' => 'flaticon-home flat-mini',
                'items' => [
                    [
                        'label' => __('Developers'), 
                        'route' => 'dashboard.developers.index',
                        'active' => request()->routeIs('dashboard.developers.*'),
                        'can' => 'developer_access',
                    ],
                    [
                        'label' => __('Projects'), 
                        'route' => 'dashboard.projects.index',
                        'active' => request()->routeIs('dashboard.projects.*'),
                        'can' => 'project_access',
                    ],
                    // [
                    //     'label' => __('Submit Property'), 
                    //     'route' => 'dashboard.units.create',
                    //     'active' => request()->routeIs('dashboard.units.create'),
                    //     'can' => 'unit_access',
                    // ],
                    // [
                    //     'label' => __('Properties'), 
                    //     'route' => 'dashboard.units.index',
                    //     'active' => request()->routeIs('dashboard.units.*'),
                    //     'can' => 'unit_access',
                    // ],
              
                    // [
                    //     'label' => __('Financial Notes'), 
                    //     'route' => 'dashboard.installments.index',
                    //     'active' => request()->routeIs('dashboard.installments.*'),
                    //     'can' => 'installment_access',
                    // ],
                ],
            ],
            [
                'label' => __('Lead Management'),
                'active' => request()->routeIs('dashboard.contacts.*') || request()->routeIs('dashboard.leads.*') || request()->routeIs('dashboard.actions.*') || request()->routeIs('dashboard.agents.*') || request()->routeIs('dashboard.campaigns.*'),
                'can' => 'leads_access',
                'icon' => 'flaticon-network flat-mini',
                'items' => [
                    [
                        'label' => __('Campaigns'), 
                        'route' => 'dashboard.campaigns.index',
                        'active' => request()->routeIs('dashboard.campaigns.*'),
                        'can' => 'campaign_access',
                    ],
                    // [
                    //     'label' => __('Leads'), 
                    //     'route' => 'dashboard.leads.index',
                    //     'active' => request()->routeIs('dashboard.leads.*'),
                    //     'can' => 'lead_access',
                    // ],
                    [
                        'label' => __('Clients'), 
                        'route' => 'dashboard.contacts.index',
                        'active' => request()->routeIs('dashboard.contacts.*') || request()->routeIs('dashboard.leads-convert'),
                        'can' => 'contact_access',
                    ],
                    // [
                    //     'label' => __('Action Registery'), 
                    //     'route' => 'dashboard.actions.index',
                    //     'active' => request()->routeIs('dashboard.actions.*'),
                    //     'can' => 'call_access',
                    // ],
                    [
                        'label' => __('Agents'), 
                        'route' => 'dashboard.agents.index',
                        'active' => request()->routeIs('dashboard.agents.*'),
                        'can' => 'agent_access',
                    ]
                ],
            ],
            [
                'label' => __('Content Management'),
                'active' => request()->routeIs('dashboard.tags.*') || request()->routeIs('dashboard.blogs.*') || request()->routeIs('dashboard.careers.*'),
                'can' => 'content_access',
                'icon' => 'flaticon-survey flat-mini',
                'items' => [
                    // [
                    //     'label' => __('Blogs'), 
                    //     'route' => 'dashboard.blogs.index',
                    //     'active' => request()->routeIs('dashboard.blogs.*'),
                    //     'can' => 'blog_access',
                    // ],
                    // [
                    //     'label' => __('Careers'), 
                    //     'route' => 'dashboard.careers.index',
                    //     'active' => request()->routeIs('dashboard.careers.*'),
                    //     'can' => 'career_access'
                    // ],
                    [
                        'label' => __('Tags'), 
                        'route' => 'dashboard.tags.index',
                        'active' => request()->routeIs('dashboard.tags.*'),
                        'can' => 'tag_access',
                    ],
                ],
            ],
            [
                'label' => __('Advanced'), 
                //'route' => 'dashboard.audit-logs.index',
                'active' => false,
                'can' => 'advanced_access',
            ],
            [
                'label' => __('Users'),
                'active' => request()->routeIs('dashboard.users.*') || request()->routeIs('dashboard.roles.*') || request()->routeIs('dashboard.permissions.*'),
                'can' => 'users_access',
                'icon' => 'flaticon-user flat-mini',
                'items' => [
                    [
                        'label' => __('Users'), 
                        'route' => 'dashboard.users.index',
                        'active' => request()->routeIs('dashboard.users.*') || request()->routeIs('profile.*'),
                        'can' => 'user_access'
                    ],
                    [
                        'label' => __('Roles'), 
                        'route' => 'dashboard.roles.index',
                        'active' => request()->routeIs('dashboard.roles.*'),
                        'can' => 'role_access'
                    ],
                    [
                        'label' => __('Permissions'), 
                        'route' => 'dashboard.permissions.index',
                        'active' => request()->routeIs('dashboard.permissions.*'),
                        'can' => 'permission_access'
                    ],
                ],
            ],
            [
                'label' => __('Activity Logs'), 
                'route' => 'dashboard.audit-logs.index',
                'active' => request()->routeIs('dashboard.audit-logs.*'),
                'can' => 'audit_log_access',
                'icon' => 'flaticon-audit flat-mini',
            ],
            // [
            //     'label' => __('Change Logs'), 
            //     'route' => 'dashboard.change-log',
            //     'active' => request()->routeIs('dashboard.change-log'),
            //     'can' => 'change_log_access',
            //     'icon' => 'flaticon-clock-circular-outline flat-mini',
            // ],
            // [
            //     'label' => __('Mass Cache Clear'), 
            //     'route' => 'dashboard.clear-cache',
            //     'active' => request()->routeIs('dashboard.clear-cache'),
            //     'can' => 'clear_cache_access',
            //     'icon' => 'flaticon-arrow flat-mini',
            // ],
            // [
            //     'label' => '<i class="fa-solid fa-link pe-1"></i> ' . __('Website'),
            //     // 'url' => route('dashboard.home'),
            //     'route' => 'homepage',
            //     'active' => false,
            //     'can' => 'public', //'home_access',
            // ],
        ];
        return $_menuitems;
    }

    static public function getChangeLogs() : array
    {
        return [
            '1.14.0' => [
                'date' => '2024/03/10',
                'changes' => [
                    'Bug fixes',
                    'Updated project details page',
                    'Enabled download buttons and collect lead inforamtion'
                ],
            ],
            '1.13.0' => [
                'date' => '2024/03/08',
                'changes' => [
                    'Bug fixes',
                    'Project section new view',
                    'Blog Title and Breadcrumbs',
                    'Show alerts after submission',
                    'Generate lead from career updated'
                ],
            ],
            '1.12.0' => [
                'date' => '2024/03/05',
                'changes' => [
                    'Bug fixes',
                    'Live Chat - Brevo',
                    'Website menu updates',
                    'Added Google reCptcha to forms',
                    'Added remove files in Projects'
                ],
            ],
            '1.11.0' => [
                'date' => '2024/03/03',
                'changes' => [
                    'Bug fixes',
                    'Update Property Fields',
                    'Project Manager',
                    'Developer with City',
                    'Fix Upload CV'
                ],
            ],
            '1.10.0' => [
                'date' => '2024/02/29',
                'changes' => [
                    'Updated UI/UX',
                    'New Submit Property (wizard)',
                    'New projects',
                    'Get Help Form',
                    'Insert lead when register and get help submitted'
                ],
            ],
            '1.9.0' => [
                'date' => '2024/01/25',
                'changes' => [
                    'Updated UI/UX',
                    'Updated dashboard Tags search and type field',
                    'Updated website properties search'
                ],
            ],
            '1.8.0' => [
                'date' => '2024/01/22',
                'changes' => [
                    'Update UI/UX',
                    'Added spoken langauges to agent',
                    'Updated Properties manager and website pages'
                ],
            ],
            '1.7.0' => [
                'date' => '2024/01/15',
                'changes' => [
                    'Updated Floor plans and NearBy places in new property submission form',
                    'Update UI/UX'
                ],
            ],
            '1.6.0' => [
                'date' => '2024/01/09',
                'changes' => [
                    'Updated show/details page design to better display of related information'
                ],
            ],
            '1.5.1' => [
                'date' => '2024/01/07',
                'changes' => [
                    'Added Activities button to Lead',
                    'Updated Table view and search for Tags, Blogs, Users, Roles and Permissions',
                    'Updated Blogs image sizes'
                ],
            ],
            '1.5.0' => [
                'date' => '2024/01/05',
                'changes' => [
                    'Change lead details view',
                    'Changed call to action',
                    'Bug fixes'
                ],
            ],
            '1.4.0' => [
                'date' => '2023/12/30',
                'changes' => [
                    'Updated permissions for agent and other roles',
                    'Show lead details page updated',
                    'Bug fixes'
                ],
            ],
            '1.3.0' => [
                'date' => '2023/12/21',
                'changes' => [
                    'Changes in lead and client relation',
                    'Visual improvments',
                    'Bug fixes'
                ],
            ],
            '1.2.0' => [
                'date' => '2023/11/29',
                'changes' => [
                    'Lead Managment',
                ],
            ],
            '1.1.0' => [
                'date' => '2023/11/16',
                'changes' => [
                    'Property Listings: Projects',
                ],
            ],
            '1.0.2' => [
                'date' => '2023/10/23',
                'changes' => [
                    'Added New Template',
                    'Updated Activity Log style',
                ],
            ],
        ];
    }

    static public function createLead($data, $campaing = 'Website - Registration')
    {
        $contact = null;
        $camp = Campaign::firstOrCreate([
            'name'       => $campaing,
            'start_date' => date('Y-01-01'),
            'end_date'   => date('Y-12-31'),
        ]);

        if (isset($data['email']) && $data['email']){
            $contact = Contact::where('email', $data['email'])->first();

            if (!$contact){
                $contact = Contact::create([
                    'name' => isset($data['name']) ? $data['name'] : '',
                    'email' => isset($data['email']) ? $data['email'] : '',
                    'mobile' => isset($data['phone']) ? $data['phone'] : '',
                    'occupation' => isset($data['occupation']) ? $data['occupation'] : '',
                    'campaign_id' => $camp->id,
                    'priority' => (isset($data['phone']) && $data['phone']) && (isset($data['email']) && $data['email']) && (isset($data['name']) && $data['name']) ? 'high' : ((isset($data['email']) && $data['email']) || (isset($data['phone']) && $data['phone']) ? 'medium' : 'low'),
                    'lead_quality' => 'follow',
                    'is_lead' => 'yes',
                ]);
            }
        }
        
        if (isset($contact->id) && $contact->id){
            return true;
        }
        else{
            return false;
        }
    }

    static public function isOnline()
    {
        return Str::endsWith(env('APP_URL'), 'tagproperties.com');
    }

    static public function countries()
    {
        return [
            "AE" => "United Arab Emirates",
            "AF" => "Afghanistan",
            "AL" => "Albania",
            "DZ" => "Algeria",
            "AS" => "American Samoa",
            "AD" => "Andorra",
            "AO" => "Angola",
            "AI" => "Anguilla",
            "AQ" => "Antarctica",
            "AG" => "Antigua and Barbuda",
            "AR" => "Argentina",
            "AM" => "Armenia",
            "AW" => "Aruba",
            "AU" => "Australia",
            "AT" => "Austria",
            "AZ" => "Azerbaijan",
            "BS" => "Bahamas",
            "BH" => "Bahrain",
            "BD" => "Bangladesh",
            "BB" => "Barbados",
            "BY" => "Belarus",
            "BE" => "Belgium",
            "BZ" => "Belize",
            "BJ" => "Benin",
            "BM" => "Bermuda",
            "BT" => "Bhutan",
            "BO" => "Bolivia",
            "BA" => "Bosnia and Herzegovina",
            "BW" => "Botswana",
            "BV" => "Bouvet Island",
            "BR" => "Brazil",
            "BQ" => "British Antarctic Territory",
            "IO" => "British Indian Ocean Territory",
            "VG" => "British Virgin Islands",
            "BN" => "Brunei",
            "BG" => "Bulgaria",
            "BF" => "Burkina Faso",
            "BI" => "Burundi",
            "KH" => "Cambodia",
            "CM" => "Cameroon",
            "CA" => "Canada",
            "CT" => "Canton and Enderbury Islands",
            "CV" => "Cape Verde",
            "KY" => "Cayman Islands",
            "CF" => "Central African Republic",
            "TD" => "Chad",
            "CL" => "Chile",
            "CN" => "China",
            "CX" => "Christmas Island",
            "CC" => "Cocos [Keeling] Islands",
            "CO" => "Colombia",
            "KM" => "Comoros",
            "CG" => "Congo - Brazzaville",
            "CD" => "Congo - Kinshasa",
            "CK" => "Cook Islands",
            "CR" => "Costa Rica",
            "HR" => "Croatia",
            "CU" => "Cuba",
            "CY" => "Cyprus",
            "CZ" => "Czech Republic",
            "CI" => "Côte d’Ivoire",
            "DK" => "Denmark",
            "DJ" => "Djibouti",
            "DM" => "Dominica",
            "DO" => "Dominican Republic",
            "NQ" => "Dronning Maud Land",
            "DD" => "East Germany",
            "EC" => "Ecuador",
            "EG" => "Egypt",
            "SV" => "El Salvador",
            "GQ" => "Equatorial Guinea",
            "ER" => "Eritrea",
            "EE" => "Estonia",
            "ET" => "Ethiopia",
            "FK" => "Falkland Islands",
            "FO" => "Faroe Islands",
            "FJ" => "Fiji",
            "FI" => "Finland",
            "FR" => "France",
            "GF" => "French Guiana",
            "PF" => "French Polynesia",
            "TF" => "French Southern Territories",
            "FQ" => "French Southern and Antarctic Territories",
            "GA" => "Gabon",
            "GM" => "Gambia",
            "GE" => "Georgia",
            "DE" => "Germany",
            "GH" => "Ghana",
            "GI" => "Gibraltar",
            "GR" => "Greece",
            "GL" => "Greenland",
            "GD" => "Grenada",
            "GP" => "Guadeloupe",
            "GU" => "Guam",
            "GT" => "Guatemala",
            "GG" => "Guernsey",
            "GN" => "Guinea",
            "GW" => "Guinea-Bissau",
            "GY" => "Guyana",
            "HT" => "Haiti",
            "HM" => "Heard Island and McDonald Islands",
            "HN" => "Honduras",
            "HK" => "Hong Kong SAR China",
            "HU" => "Hungary",
            "IS" => "Iceland",
            "IN" => "India",
            "ID" => "Indonesia",
            "IR" => "Iran",
            "IQ" => "Iraq",
            "IE" => "Ireland",
            "IM" => "Isle of Man",
            "IL" => "Israel",
            "IT" => "Italy",
            "JM" => "Jamaica",
            "JP" => "Japan",
            "JE" => "Jersey",
            "JT" => "Johnston Island",
            "JO" => "Jordan",
            "KZ" => "Kazakhstan",
            "KE" => "Kenya",
            "KI" => "Kiribati",
            "KW" => "Kuwait",
            "KG" => "Kyrgyzstan",
            "LA" => "Laos",
            "LV" => "Latvia",
            "LB" => "Lebanon",
            "LS" => "Lesotho",
            "LR" => "Liberia",
            "LY" => "Libya",
            "LI" => "Liechtenstein",
            "LT" => "Lithuania",
            "LU" => "Luxembourg",
            "MO" => "Macau SAR China",
            "MK" => "Macedonia",
            "MG" => "Madagascar",
            "MW" => "Malawi",
            "MY" => "Malaysia",
            "MV" => "Maldives",
            "ML" => "Mali",
            "MT" => "Malta",
            "MH" => "Marshall Islands",
            "MQ" => "Martinique",
            "MR" => "Mauritania",
            "MU" => "Mauritius",
            "YT" => "Mayotte",
            "FX" => "Metropolitan France",
            "MX" => "Mexico",
            "FM" => "Micronesia",
            "MI" => "Midway Islands",
            "MD" => "Moldova",
            "MC" => "Monaco",
            "MN" => "Mongolia",
            "ME" => "Montenegro",
            "MS" => "Montserrat",
            "MA" => "Morocco",
            "MZ" => "Mozambique",
            "MM" => "Myanmar [Burma]",
            "NA" => "Namibia",
            "NR" => "Nauru",
            "NP" => "Nepal",
            "NL" => "Netherlands",
            "AN" => "Netherlands Antilles",
            "NT" => "Neutral Zone",
            "NC" => "New Caledonia",
            "NZ" => "New Zealand",
            "NI" => "Nicaragua",
            "NE" => "Niger",
            "NG" => "Nigeria",
            "NU" => "Niue",
            "NF" => "Norfolk Island",
            "KP" => "North Korea",
            "VD" => "North Vietnam",
            "MP" => "Northern Mariana Islands",
            "NO" => "Norway",
            "OM" => "Oman",
            "PC" => "Pacific Islands Trust Territory",
            "PK" => "Pakistan",
            "PW" => "Palau",
            "PS" => "Palestinian Territories",
            "PA" => "Panama",
            "PZ" => "Panama Canal Zone",
            "PG" => "Papua New Guinea",
            "PY" => "Paraguay",
            "YD" => "People's Democratic Republic of Yemen",
            "PE" => "Peru",
            "PH" => "Philippines",
            "PN" => "Pitcairn Islands",
            "PL" => "Poland",
            "PT" => "Portugal",
            "PR" => "Puerto Rico",
            "QA" => "Qatar",
            "RO" => "Romania",
            "RU" => "Russia",
            "RW" => "Rwanda",
            "RE" => "Réunion",
            "BL" => "Saint Barthélemy",
            "SH" => "Saint Helena",
            "KN" => "Saint Kitts and Nevis",
            "LC" => "Saint Lucia",
            "MF" => "Saint Martin",
            "PM" => "Saint Pierre and Miquelon",
            "VC" => "Saint Vincent and the Grenadines",
            "WS" => "Samoa",
            "SM" => "San Marino",
            "SA" => "Saudi Arabia",
            "SN" => "Senegal",
            "RS" => "Serbia",
            "CS" => "Serbia and Montenegro",
            "SC" => "Seychelles",
            "SL" => "Sierra Leone",
            "SG" => "Singapore",
            "SK" => "Slovakia",
            "SI" => "Slovenia",
            "SB" => "Solomon Islands",
            "SO" => "Somalia",
            "ZA" => "South Africa",
            "GS" => "South Georgia and the South Sandwich Islands",
            "KR" => "South Korea",
            "ES" => "Spain",
            "LK" => "Sri Lanka",
            "SD" => "Sudan",
            "SR" => "Suriname",
            "SJ" => "Svalbard and Jan Mayen",
            "SZ" => "Swaziland",
            "SE" => "Sweden",
            "CH" => "Switzerland",
            "SY" => "Syria",
            "ST" => "São Tomé and Príncipe",
            "TW" => "Taiwan",
            "TJ" => "Tajikistan",
            "TZ" => "Tanzania",
            "TH" => "Thailand",
            "TL" => "Timor-Leste",
            "TG" => "Togo",
            "TK" => "Tokelau",
            "TO" => "Tonga",
            "TT" => "Trinidad and Tobago",
            "TN" => "Tunisia",
            "TR" => "Turkey",
            "TM" => "Turkmenistan",
            "TC" => "Turks and Caicos Islands",
            "TV" => "Tuvalu",
            "UM" => "U.S. Minor Outlying Islands",
            "PU" => "U.S. Miscellaneous Pacific Islands",
            "VI" => "U.S. Virgin Islands",
            "UG" => "Uganda",
            "UA" => "Ukraine",
            "SU" => "Union of Soviet Socialist Republics",
            "GB" => "United Kingdom",
            "US" => "United States",
            "ZZ" => "Unknown or Invalid Region",
            "UY" => "Uruguay",
            "UZ" => "Uzbekistan",
            "VU" => "Vanuatu",
            "VA" => "Vatican City",
            "VE" => "Venezuela",
            "VN" => "Vietnam",
            "WK" => "Wake Island",
            "WF" => "Wallis and Futuna",
            "EH" => "Western Sahara",
            "YE" => "Yemen",
            "ZM" => "Zambia",
            "ZW" => "Zimbabwe",
            "AX" => "Åland Islands",
        ];
    }
}
?>