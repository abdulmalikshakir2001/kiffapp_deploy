<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        #Schema::dropIfExists('countries');
        Schema::create('countries', function (Blueprint $table) {
            $table->increments('country_id');
            $table->string('country', 100);
            $table->string('currency', 100);
            $table->string('currency_code', 25);
            $table->string('currency_symbol', 25);
            $table->string('thousand_separator', 10)->default(',');
            $table->string('decimal_separator', 10)->default('.');
            $table->softDeletes();
            $table->timestamps();
        });


        $data = [
            ["country" => "Afghanistan", "currency" => "Afghanis", "currency_code" => "AF", "currency_symbol" => "؋"],
            ["country" => "Albania", "currency" => "Leke", "currency_code" => "ALL", "currency_symbol" => "Lek"],
            ["country" => "America", "currency" => "Dollars", "currency_code" => "USD", "currency_symbol" => '$'],
            ["country" => "Argentina", "currency" => "Pesos", "currency_code" => "ARS", "currency_symbol" => '$'],
            ["country" => "Aruba", "currency" => "Guilders", "currency_code" => "AWG", "currency_symbol" => "ƒ"],
            ["country" => "Australia", "currency" => "Dollars", "currency_code" => "AUD", "currency_symbol" => '$'],
            ["country" => "Azerbaijan", "currency" => "New Manats", "currency_code" => "AZ", "currency_symbol" => "ман"],
            ["country" => "Bahamas", "currency" => "Dollars", "currency_code" => "BSD", "currency_symbol" => '$'],
            ["country" => "Barbados", "currency" => "Dollars", "currency_code" => "BBD", "currency_symbol" => '$'],
            ["country" => "Belarus", "currency" => "Rubles", "currency_code" => "BYR", "currency_symbol" => "p."],
            ["country" => "Belgium", "currency" => "Euro", "currency_code" => "EUR", "currency_symbol" => "€"],
            ["country" => "Beliz", "currency" => "Dollars", "currency_code" => "BZD", "currency_symbol" => "BZ$"],
            ["country" => "Bermuda", "currency" => "Dollars", "currency_code" => "BMD", "currency_symbol" => '$'],
            ["country" => "Bolivia", "currency" => "Bolivianos", "currency_code" => "BOB", "currency_symbol" => '$b'],
            ["country" => "Bosnia and Herzegovina", "currency" => "Convertible Marka", "currency_code" => "BAM", "currency_symbol" => "KM"],
            ["country" => "Botswana", "currency" => "Pula's", "currency_code" => "BWP", "currency_symbol" => "P"],
            ["country" => "Bulgaria", "currency" => "Leva", "currency_code" => "BG", "currency_symbol" => "лв"],
            ["country" => "Brazil", "currency" => "Reais", "currency_code" => "BRL", "currency_symbol" => "R$"],
            ["country" => "Britain [United Kingdom]", "currency" => "Pounds", "currency_code" => "GBP", "currency_symbol" => "£"],
            ["country" => "Brunei Darussalam", "currency" => "Dollars", "currency_code" => "BND", "currency_symbol" => '$'],
            ["country" => "Cambodia", "currency" => "Riels", "currency_code" => "KHR", "currency_symbol" => "៛"],
            ["country" => "Canada", "currency" => "Dollars", "currency_code" => "CAD", "currency_symbol" => '$'],
            ["country" => "Cayman Islands", "currency" => "Dollars", "currency_code" => "KYD", "currency_symbol" => '$'],
            ["country" => "Chile", "currency" => "Pesos", "currency_code" => "CLP", "currency_symbol" => '$'],
            ["country" => "China", "currency" => "Yuan Renminbi", "currency_code" => "CNY", "currency_symbol" => "¥"],
            ["country" => "Colombia", "currency" => "Pesos", "currency_code" => "COP", "currency_symbol" => '$'],
            ["country" => "Costa Rica", "currency" => "Colón", "currency_code" => "CRC", "currency_symbol" => "₡"],
            ["country" => "Croatia", "currency" => "Kuna", "currency_code" => "HRK", "currency_symbol" => "kn"],
            ["country" => "Cuba", "currency" => "Pesos", "currency_code" => "CUP", "currency_symbol" => "₱"],
            ["country" => "Czech Republic", "currency" => "Koruny", "currency_code" => "CZK", "currency_symbol" => "Kč"],
            ["country" => "Denmark", "currency" => "Kroner", "currency_code" => "DKK", "currency_symbol" => "kr"],
            ["country" => "Dominican Republic", "currency" => "Pesos", "currency_code" => "DOP ", "currency_symbol" => "RD$"],
            ["country" => "East Caribbean", "currency" => "Dollars", "currency_code" => "XCD", "currency_symbol" => '$'],
            ["country" => "Egypt", "currency" => "Pounds", "currency_code" => "EGP", "currency_symbol" => "£"],
            ["country" => "El Salvador", "currency" => "Colones", "currency_code" => "SVC", "currency_symbol" => '$'],
            ["country" => "England [United Kingdom]", "currency" => "Pounds", "currency_code" => "GBP", "currency_symbol" => "£"],
            ["country" => "Falkland Islands", "currency" => "Pounds", "currency_code" => "FKP", "currency_symbol" => "£"],
            ["country" => "Fiji", "currency" => "Dollars", "currency_code" => "FJD", "currency_symbol" => '$'],
            ["country" => "Ghana", "currency" => "Cedis", "currency_code" => "GHS", "currency_symbol" => "¢"],
            ["country" => "Gibraltar", "currency" => "Pounds", "currency_code" => "GIP", "currency_symbol" => "£"],
            ["country" => "Guatemala", "currency" => "Quetzales", "currency_code" => "GTQ", "currency_symbol" => "Q"],
            ["country" => "Guernsey", "currency" => "Pounds", "currency_code" => "GGP", "currency_symbol" => "£"],
            ["country" => "Guyana", "currency" => "Dollars", "currency_code" => "GYD", "currency_symbol" => '$'],
            ["country" => "Honduras", "currency" => "Lempiras", "currency_code" => "HNL", "currency_symbol" => "L"],
            ["country" => "Hong Kong", "currency" => "Dollars", "currency_code" => "HKD", "currency_symbol" => '$'],
            ["country" => "Hungary", "currency" => "Forint", "currency_code" => "HUF", "currency_symbol" => "Ft"],
            ["country" => "Iceland", "currency" => "Kronur", "currency_code" => "ISK", "currency_symbol" => "kr"],
            ["country" => "India", "currency" => "Rupees", "currency_code" => "INR", "currency_symbol" => "₹"],
            ["country" => "Indonesia", "currency" => "Rupiahs", "currency_code" => "IDR", "currency_symbol" => "Rp"],
            ["country" => "Iran", "currency" => "Rials", "currency_code" => "IRR", "currency_symbol" => "﷼"],
            ["country" => "Isle of Man", "currency" => "Pounds", "currency_code" => "IMP", "currency_symbol" => "£"],
            ["country" => "Israel", "currency" => "New Shekels", "currency_code" => "ILS", "currency_symbol" => "₪"],
            ["country" => "Jamaica", "currency" => "Dollars", "currency_code" => "JMD", "currency_symbol" => "J$"],
            ["country" => "Japan", "currency" => "Yen", "currency_code" => "JPY", "currency_symbol" => "¥"],
            ["country" => "Jersey", "currency" => "Pounds", "currency_code" => "JEP", "currency_symbol" => "£"],
            ["country" => "Kazakhstan", "currency" => "Tenge", "currency_code" => "KZT", "currency_symbol" => "лв"],
            ["country" => "Korea [North]", "currency" => "Won", "currency_code" => "KPW", "currency_symbol" => "₩"],
            ["country" => "Korea [South]", "currency" => "Won", "currency_code" => "KRW", "currency_symbol" => "₩"],
            ["country" => "Kyrgyzstan", "currency" => "Soms", "currency_code" => "KGS", "currency_symbol" => "лв"],
            ["country" => "Laos", "currency" => "Kips", "currency_code" => "LAK", "currency_symbol" => "₭"],
            ["country" => "Latvia", "currency" => "Lati", "currency_code" => "LVL", "currency_symbol" => "Ls"],
            ["country" => "Lebanon", "currency" => "Pounds", "currency_code" => "LBP", "currency_symbol" => "£"],
            ["country" => "Liberia", "currency" => "Dollars", "currency_code" => "LRD", "currency_symbol" => '$'],
            ["country" => "Liechtenstein", "currency" => "Switzerland Francs", "currency_code" => "CHF", "currency_symbol" => "CHF"],
            ["country" => "Lithuania", "currency" => "Litai", "currency_code" => "LTL", "currency_symbol" => "Lt"],
            ["country" => "Macedonia", "currency" => "Denars", "currency_code" => "MKD", "currency_symbol" => "ден"],
            ["country" => "Malaysia", "currency" => "Ringgits", "currency_code" => "MYR", "currency_symbol" => "RM"],
            ["country" => "Mauritius", "currency" => "Rupees", "currency_code" => "MUR", "currency_symbol" => "₨"],
            ["country" => "Mexico", "currency" => "Pesos", "currency_code" => "MXN", "currency_symbol" => '$'],
            ["country" => "Mongolia", "currency" => "Tugriks", "currency_code" => "MNT", "currency_symbol" => "₮"],
            ["country" => "Mozambique", "currency" => "Meticais", "currency_code" => "MZ", "currency_symbol" => "MT"],
            ["country" => "Namibia", "currency" => "Dollars", "currency_code" => "NAD", "currency_symbol" => '$'],
            ["country" => "Nepal", "currency" => "Rupees", "currency_code" => "NPR", "currency_symbol" => "₨"],
            ["country" => "Netherlands Antilles", "currency" => "Guilders", "currency_code" => "ANG", "currency_symbol" => "ƒ"],
            ["country" => "New Zealand", "currency" => "Dollars", "currency_code" => "NZD", "currency_symbol" => '$'],
            ["country" => "Nicaragua", "currency" => "Cordobas", "currency_code" => "NIO", "currency_symbol" => "C$"],
            ["country" => "Nigeria", "currency" => "Nairas", "currency_code" => "NGN", "currency_symbol" => "₦"],
            ["country" => "North Korea", "currency" => "Won", "currency_code" => "KPW", "currency_symbol" => "₩"],
            ["country" => "Norway", "currency" => "Krone", "currency_code" => "NOK", "currency_symbol" => "kr"],
            ["country" => "Oman", "currency" => "Rials", "currency_code" => "OMR", "currency_symbol" => "﷼"],
            ["country" => "Pakistan", "currency" => "Rupees", "currency_code" => "PKR", "currency_symbol" => "₨"],
            ["country" => "Panama", "currency" => "Balboa", "currency_code" => "PAB", "currency_symbol" => "B/."],
            ["country" => "Paraguay", "currency" => "Guarani", "currency_code" => "PYG", "currency_symbol" => "Gs"],
            ["country" => "Peru", "currency" => "Nuevos Soles", "currency_code" => "PE", "currency_symbol" => "S/."],
            ["country" => "Philippines", "currency" => "Pesos", "currency_code" => "PHP", "currency_symbol" => "Php"],
            ["country" => "Poland", "currency" => "Zlotych", "currency_code" => "PL", "currency_symbol" => "zł"],
            ["country" => "Qatar", "currency" => "Rials", "currency_code" => "QAR", "currency_symbol" => "﷼"],
            ["country" => "Romania", "currency" => "New Lei", "currency_code" => "RO", "currency_symbol" => "lei"],
            ["country" => "Russia", "currency" => "Rubles", "currency_code" => "RUB", "currency_symbol" => "руб"],
            ["country" => "Saint Helena", "currency" => "Pounds", "currency_code" => "SHP", "currency_symbol" => "£"],
            ["country" => "Saudi Arabia", "currency" => "Riyals", "currency_code" => "SAR", "currency_symbol" => "﷼"],
            ["country" => "Serbia", "currency" => "Dinars", "currency_code" => "RSD", "currency_symbol" => "Дин."],
            ["country" => "Seychelles", "currency" => "Rupees", "currency_code" => "SCR", "currency_symbol" => "₨"],
            ["country" => "Singapore", "currency" => "Dollars", "currency_code" => "SGD", "currency_symbol" => '$'],
            ["country" => "Solomon Islands", "currency" => "Dollars", "currency_code" => "SBD", "currency_symbol" => '$'],
            ["country" => "Somalia", "currency" => "Shillings", "currency_code" => "SOS", "currency_symbol" => "S"],
            ["country" => "South Africa", "currency" => "Rand", "currency_code" => "ZAR", "currency_symbol" => "R"],
            ["country" => "South Korea", "currency" => "Won", "currency_code" => "KRW", "currency_symbol" => "₩"],
            ["country" => "Sri Lanka", "currency" => "Rupees", "currency_code" => "LKR", "currency_symbol" => "₨"],
            ["country" => "Sweden", "currency" => "Kronor", "currency_code" => "SEK", "currency_symbol" => "kr"],
            ["country" => "Switzerland", "currency" => "Francs", "currency_code" => "CHF", "currency_symbol" => "CHF"],
            ["country" => "Suriname", "currency" => "Dollars", "currency_code" => "SRD", "currency_symbol" => '$'],
            ["country" => "Syria", "currency" => "Pounds", "currency_code" => "SYP", "currency_symbol" => "£"],
            ["country" => "Taiwan", "currency" => "New Dollars", "currency_code" => "TWD", "currency_symbol" => "NT$"],
            ["country" => "Thailand", "currency" => "Baht", "currency_code" => "THB", "currency_symbol" => "฿"],
            ["country" => "Trinidad and Tobago", "currency" => "Dollars", "currency_code" => "TTD", "currency_symbol" => "TT$"],
            ["country" => "Turkey", "currency" => "Lira", "currency_code" => "TRY", "currency_symbol" => "TL"],
            ["country" => "Turkey", "currency" => "Liras", "currency_code" => "TRL", "currency_symbol" => "£"],
            ["country" => "Tuvalu", "currency" => "Dollars", "currency_code" => "TVD", "currency_symbol" => '$'],
            ["country" => "Ukraine", "currency" => "Hryvnia", "currency_code" => "UAH", "currency_symbol" => "₴"],
            ["country" => "United Kingdom", "currency" => "Pounds", "currency_code" => "GBP", "currency_symbol" => "£"],
            ["country" => "United States of America", "currency" => "Dollars", "currency_code" => "USD", "currency_symbol" => '$'],
            ["country" => "Uruguay", "currency" => "Pesos", "currency_code" => "UYU", "currency_symbol" => '$U'],
            ["country" => "Uzbekistan", "currency" => "Sums", "currency_code" => "UZS", "currency_symbol" => "лв"],
            ["country" => "Venezuela", "currency" => "Bolivares Fuertes", "currency_code" => "VEF", "currency_symbol" => "Bs"],
            ["country" => "Vietnam", "currency" => "Dong", "currency_code" => "VND", "currency_symbol" => "₫"],
            ["country" => "Yemen", "currency" => "Rials", "currency_code" => "YER", "currency_symbol" => "﷼"],
            ["country" => "Zimbabwe", "currency" => "Zimbabwe Dollars", "currency_code" => "ZWD", "currency_symbol" => "Z$",],
            ["country" => "Iraq", "currency" => "Iraqi dinar", "currency_code" => "IQD", "currency_symbol" => "د.ع",],
            ["country" => "Kenya", "currency" => "Kenyan shilling", "currency_code" => "KES", "currency_symbol" => "KSh",],
            ["country" => "Bangladesh", "currency" => "Taka", "currency_code" => "BDT", "currency_symbol" => "৳",],
            ["country" => "United Arab Emirates", "currency" => "United Arab Emirates dirham", "currency_code" => "AED", "currency_symbol" => "د.إ",],
            ["country" => "Uganda", "currency" => "Uganda shillings", "currency_code" => "UGX", "currency_symbol" => "USh",],
            ["country" => "Tanzania", "currency" => "Tanzanian shilling", "currency_code" => "TZS", "currency_symbol" => "TSh",],
            ["country" => "Angola", "currency" => "Kwanza", "currency_code" => "AOA", "currency_symbol" => "Kz",],
            ["country" => "Kuwait", "currency" => "Kuwaiti dinar", "currency_code" => "KWD", "currency_symbol" => "KD",],
            ["country" => "Bahrain", "currency" => "Bahraini dinar", "currency_code" => "BHD", "currency_symbol" => "BD",]
        ];

        // Now countries with differen thousand and decimal separators
        DB::table('countries')->insert($data);
        $data = [
            [
                "country" => "Cyprus", "currency" => "Euro", "currency_code" => "EUR", "currency_symbol" => "€",
                "thousand_separator" => ".", "decimal_separator" => ","
            ],
            [
                "country" => "Euro", "currency" => "Euro", "currency_code" => "EUR", "currency_symbol" => "€",
                "thousand_separator" => ".", "decimal_separator" => ","
            ],
            [
                "country" => "France", "currency" => "Euro", "currency_code" => "EUR", "currency_symbol" => "€",
                "thousand_separator" => ".", "decimal_separator" => ","
            ],
            [
                "country" => "Greece", "currency" => "Euro", "currency_code" => "EUR", "currency_symbol" => "€",
                "thousand_separator" => ".", "decimal_separator" => ","
            ],
            [
                "country" => "Holland [Netherlands]", "currency" => "Euro", "currency_code" => "EUR", "currency_symbol" => "€",
                "thousand_separator" => ".", "decimal_separator" => ","
            ],
            [
                "country" => "Ireland", "currency" => "Euro", "currency_code" => "EUR", "currency_symbol" => "€",
                "thousand_separator" => ".", "decimal_separator" => ","
            ],
            [
                "country" => "Italy", "currency" => "Euro", "currency_code" => "EUR", "currency_symbol" => "€",
                "thousand_separator" => ".", "decimal_separator" => ","
            ],
            [
                "country" => "Luxembourg", "currency" => "Euro", "currency_code" => "EUR", "currency_symbol" => "€",
                "thousand_separator" => ".", "decimal_separator" => ","
            ],
            [
                "country" => "Malta", "currency" => "Euro", "currency_code" => "EUR", "currency_symbol" => "€",
                "thousand_separator" => ".", "decimal_separator" => ","
            ],
            [
                "country" => "Netherlands", "currency" => "Euro", "currency_code" => "EUR", "currency_symbol" => "€",
                "thousand_separator" => ".", "decimal_separator" => ","
            ],
            [
                "country" => "Slovenia", "currency" => "Euro", "currency_code" => "EUR", "currency_symbol" => "€",
                "thousand_separator" => ".", "decimal_separator" => ","
            ],
            [
                "country" => "Spain", "currency" => "Euro", "currency_code" => "EUR", "currency_symbol" => "€",
                "thousand_separator" => ".", "decimal_separator" => ","
            ],
            [
                "country" => "Vatican City", "currency" => "Euro", "currency_code" => "EUR", "currency_symbol" => "€",
                "thousand_separator" => ".", "decimal_separator" => ","
            ],
            [
                "country" => "Algerie", "currency" => "Algerian dinar", "currency_code" => "DZD", "currency_symbol" => "د.ج",
                "thousand_separator" => " ", "decimal_separator" => "."
            ]
        ];

        DB::table('countries')->insert($data);


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries');
    }
}
