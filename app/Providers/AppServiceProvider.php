<?php

namespace App\Providers;

use App\Models\AppSetting;
use App\Models\ConfigCompany;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('path.public', function() {
            return base_path('public_html');
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */

    public function boot()
    {
        if (get_config() == 1){
            $company = ConfigCompany::all();
            view()->share('comp', $company);
            $app_setting = AppSetting::where('id', 1)->first();
            view()->share('login_logo', $app_setting->login_logo);
            view()->share('dashboard_logo', $app_setting->dashboard_logo);
            view()->share('footer_tag', $app_setting->footer_tag);
        }


        $uom = array("kg", "unit", "buah", "meter", "pack", "roll", "ea", "buku", "inch", "lusin", "set", "rim", "gallon", "feet", "litre", "can", "lbs", "joint", "box", "bottle", "gram", "lembar", "drum", "lot");
        view()->share('uom', $uom);
        $list_currency = "{\"AED\": \"United Arab Emirates Dirham\",\"AFN\": \"Afghan Afghani\",\"ALL\": \"Albanian Lek\",\"AMD\": \"Armenian Dram\",\"ANG\": \"Netherlands Antillean Guilder\",\"AOA\": \"Angolan Kwanza\",\"ARS\": \"Argentine Peso\",\"AUD\": \"Australian Dollar\",\"AWG\": \"Aruban Florin\",\"AZN\": \"Azerbaijani Manat\",\"BAM\": \"Bosnia-Herzegovina Convertible Mark\",\"BBD\": \"Barbadian Dollar\",\"BDT\": \"Bangladeshi Taka\",\"BGN\": \"Bulgarian Lev\",\"BHD\": \"Bahraini Dinar\",\"BIF\": \"Burundian Franc\",\"BMD\": \"Bermudan Dollar\",\"BND\": \"Brunei Dollar\",\"BOB\": \"Bolivian Boliviano\",\"BRL\": \"Brazilian Real\",\"BSD\": \"Bahamian Dollar\",\"BTC\": \"Bitcoin\",\"BTN\": \"Bhutanese Ngultrum\",\"BWP\": \"Botswanan Pula\",\"BYN\": \"Belarusian Ruble\",\"BZD\": \"Belize Dollar\",\"CAD\": \"Canadian Dollar\",\"CDF\": \"Congolese Franc\",\"CHF\": \"Swiss Franc\",\"CLF\": \"Chilean Unit of Account (UF)\",\"CLP\": \"Chilean Peso\",\"CNH\": \"Chinese Yuan (Offshore)\",\"CNY\": \"Chinese Yuan\",\"COP\": \"Colombian Peso\",\"CRC\": \"Costa Rican Colón\",\"CUC\": \"Cuban Convertible Peso\",\"CUP\": \"Cuban Peso\",\"CVE\": \"Cape Verdean Escudo\",\"CZK\": \"Czech Republic Koruna\",\"DJF\": \"Djiboutian Franc\",\"DKK\": \"Danish Krone\",\"DOP\": \"Dominican Peso\",\"DZD\": \"Algerian Dinar\",\"EGP\": \"Egyptian Pound\",\"ERN\": \"Eritrean Nakfa\",\"ETB\": \"Ethiopian Birr\",\"EUR\": \"Euro\",\"FJD\": \"Fijian Dollar\",\"FKP\": \"Falkland Islands Pound\",\"GBP\": \"British Pound Sterling\",\"GEL\": \"Georgian Lari\",\"GGP\": \"Guernsey Pound\",\"GHS\": \"Ghanaian Cedi\",\"GIP\": \"Gibraltar Pound\",\"GMD\": \"Gambian Dalasi\",\"GNF\": \"Guinean Franc\",\"GTQ\": \"Guatemalan Quetzal\",\"GYD\": \"Guyanaese Dollar\",\"HKD\": \"Hong Kong Dollar\",\"HNL\": \"Honduran Lempira\",\"HRK\": \"Croatian Kuna\",\"HTG\": \"Haitian Gourde\",\"HUF\": \"Hungarian Forint\",\"IDR\": \"Indonesian Rupiah\",\"ILS\": \"Israeli New Sheqel\",\"IMP\": \"Manx pound\",\"INR\": \"Indian Rupee\",\"IQD\": \"Iraqi Dinar\",\"IRR\": \"Iranian Rial\",\"ISK\": \"Icelandic Króna\",\"JEP\": \"Jersey Pound\",\"JMD\": \"Jamaican Dollar\",\"JOD\": \"Jordanian Dinar\",\"JPY\": \"Japanese Yen\",\"KES\": \"Kenyan Shilling\",\"KGS\": \"Kyrgystani Som\",\"KHR\": \"Cambodian Riel\",\"KMF\": \"Comorian Franc\",\"KPW\": \"North Korean Won\",\"KRW\": \"South Korean Won\",\"KWD\": \"Kuwaiti Dinar\",\"KYD\": \"Cayman Islands Dollar\",\"KZT\": \"Kazakhstani Tenge\",\"LAK\": \"Laotian Kip\",\"LBP\": \"Lebanese Pound\",\"LKR\": \"Sri Lankan Rupee\",\"LRD\": \"Liberian Dollar\",\"LSL\": \"Lesotho Loti\",\"LYD\": \"Libyan Dinar\",\"MAD\": \"Moroccan Dirham\",\"MDL\": \"Moldovan Leu\",\"MGA\": \"Malagasy Ariary\",\"MKD\": \"Macedonian Denar\",\"MMK\": \"Myanma Kyat\",\"MNT\": \"Mongolian Tugrik\",\"MOP\": \"Macanese Pataca\",\"MRO\": \"Mauritanian Ouguiya (pre-2018)\",\"MRU\": \"Mauritanian Ouguiya\",\"MUR\": \"Mauritian Rupee\",\"MVR\": \"Maldivian Rufiyaa\",\"MWK\": \"Malawian Kwacha\",\"MXN\": \"Mexican Peso\",\"MYR\": \"Malaysian Ringgit\",\"MZN\": \"Mozambican Metical\",\"NAD\": \"Namibian Dollar\",\"NGN\": \"Nigerian Naira\",\"NIO\": \"Nicaraguan Córdoba\",\"NOK\": \"Norwegian Krone\",\"NPR\": \"Nepalese Rupee\",\"NZD\": \"New Zealand Dollar\",\"OMR\": \"Omani Rial\",\"PAB\": \"Panamanian Balboa\",\"PEN\": \"Peruvian Nuevo Sol\",\"PGK\": \"Papua New Guinean Kina\",\"PHP\": \"Philippine Peso\",\"PKR\": \"Pakistani Rupee\",\"PLN\": \"Polish Zloty\",\"PYG\": \"Paraguayan Guarani\",\"QAR\": \"Qatari Rial\",\"RON\": \"Romanian Leu\",\"RSD\": \"Serbian Dinar\",\"RUB\": \"Russian Ruble\",\"RWF\": \"Rwandan Franc\",\"SAR\": \"Saudi Riyal\",\"SBD\": \"Solomon Islands Dollar\",\"SCR\": \"Seychellois Rupee\",\"SDG\": \"Sudanese Pound\",\"SEK\": \"Swedish Krona\",\"SGD\": \"Singapore Dollar\",\"SHP\": \"Saint Helena Pound\",\"SLL\": \"Sierra Leonean Leone\",\"SOS\": \"Somali Shilling\",\"SRD\": \"Surinamese Dollar\",\"SSP\": \"South Sudanese Pound\",\"STD\": \"São Tomé and Príncipe Dobra (pre-2018)\",\"STN\": \"São Tomé and Príncipe Dobra\",\"SVC\": \"Salvadoran Colón\",\"SYP\": \"Syrian Pound\",\"SZL\": \"Swazi Lilangeni\",\"THB\": \"Thai Baht\",\"TJS\": \"Tajikistani Somoni\",\"TMT\": \"Turkmenistani Manat\",\"TND\": \"Tunisian Dinar\",\"TOP\": \"Tongan Pa'anga\",\"TRY\": \"Turkish Lira\",\"TTD\": \"Trinidad and Tobago Dollar\",\"TWD\": \"New Taiwan Dollar\",\"TZS\": \"Tanzanian Shilling\",\"UAH\": \"Ukrainian Hryvnia\",\"UGX\": \"Ugandan Shilling\",\"USD\": \"United States Dollar\",\"UYU\": \"Uruguayan Peso\",\"UZS\": \"Uzbekistan Som\",\"VEF\": \"Venezuelan Bolívar Fuerte\",\"VND\": \"Vietnamese Dong\",\"VUV\": \"Vanuatu Vatu\",\"WST\": \"Samoan Tala\",\"XAF\": \"CFA Franc BEAC\",\"XAG\": \"Silver Ounce\",\"XAU\": \"Gold Ounce\",\"XCD\": \"East Caribbean Dollar\",\"XDR\": \"Special Drawing Rights\",\"XOF\": \"CFA Franc BCEAO\",\"XPD\": \"Palladium Ounce\",\"XPF\": \"CFP Franc\",\"XPT\": \"Platinum Ounce\",\"YER\": \"Yemeni Rial\",\"ZAR\": \"South African Rand\",\"ZMW\": \"Zambian Kwacha\",\"ZWL\": \"Zimbabwean Dollar\"}";
        view()->share('list_currency', $list_currency);

        DB::connection()->enableQueryLog();

        $file_env = app_path('Config/.env', true);
        $env = explode("\n", file_get_contents($file_env));
        for ($i=0; $i < count($env); $i++){
            $content_env = explode("=", $env[$i]);
            if ($content_env[0] == "ACCOUNTING_MODE"){
                $accounting_mode = end($content_env);
            }
            if ($content_env[0] == "DEBUG"){
                $debug = end($content_env);
            }
        }

        $comp = ConfigCompany::all();
        $companies = array();
        foreach ($comp as $item) {
            $companies[$item->id] = $item;
        }

        view()->share('accounting_mode', $accounting_mode);
        view()->share('debug', $debug);
        view()->share('view_company', $companies);


//        DB::connection()->enableQueryLog();
//        $queries = DB::getQueryLog();
//        $last_query = end($queries);
//        activity("query")
//            ->log($last_query);

//        if (env('APP_DEBUG')){
//            DB::listen(function ($query){
//                activity("query")
//                    ->log($query->sql);
//            });
//        }
    }
}
