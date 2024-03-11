<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('short-name')->nullable();
            $table->string('flag_img')->nullable();
            $table->string('country_code')->nullable();
            $table->timestamps();
        });
        $userData = [
            ['name' => 'Afghanistan', 'short-name' => 'AF', 'flag_img' => 'wisdom_countrypkg/img/country_flags/AF.png', 'country_code' => '93',],
            ['name' => 'Albania', 'short-name' => 'AL',  'flag_img' => 'wisdom_countrypkg/img/country_flags/AL.png', 'country_code' => '355',],
            ['name' => 'Algeria', 'short-name' => 'DZ',  'flag_img' => 'wisdom_countrypkg/img/country_flags/DZ.png', 'country_code' => '213',],
            ['name' => 'American Samoa', 'short-name' => 'AS', 'flag_img' => 'wisdom_countrypkg/img/country_flags/AS.png', 'country_code' => '1684',],
            ['name' => 'Andorra', 'short-name' => 'AD',  'flag_img' => 'wisdom_countrypkg/img/country_flags/AD.png', 'country_code' => '376',],
            ['name' => 'Angola', 'short-name' => 'AO',  'flag_img' => 'wisdom_countrypkg/img/country_flags/AO.png', 'country_code' => '244',],
            ['name' => 'Anguilla', 'short-name' => 'AI',   'flag_img' => 'wisdom_countrypkg/img/country_flags/AI.png', 'country_code' => '1264',],
            ['name' => 'Antarctica', 'short-name' => 'AQ',  'flag_img' => 'wisdom_countrypkg/img/country_flags/AQ.png', 'country_code' => '0',],
            ['name' => 'Antigua And Barbuda', 'short-name' => 'AG', 'flag_img' => 'wisdom_countrypkg/img/country_flags/AG.png', 'country_code' => '1268',],
            ['name' =>  'Argentina', 'short-name' => 'AR', 'flag_img' => 'wisdom_countrypkg/img/country_flags/AR.png', 'country_code' => '54',],
            ['name' =>  'Armenia', 'short-name' =>  'AM', 'flag_img' => 'wisdom_countrypkg/img/country_flags/AM.png', 'country_code' => '374',],
            ['name' =>  'Aruba', 'short-name' =>  'AW', 'flag_img' => 'wisdom_countrypkg/img/country_flags/AW.png', 'country_code' => '297',],
            ['name' =>  'Australia', 'short-name' =>  'AU', 'flag_img' => 'wisdom_countrypkg/img/country_flags/AU.png', 'country_code' => '61',],
            ['name' =>  'Austria', 'short-name' =>  'AT', 'flag_img' => 'wisdom_countrypkg/img/country_flags/AT.png', 'country_code' => '43',],
            ['name' =>  'Azerbaijan', 'short-name' =>  'AZ', 'flag_img' => 'wisdom_countrypkg/img/country_flags/AZ.png', 'country_code' => '994',],
            ['name' =>  'Bahamas The', 'short-name' =>  'BS', 'flag_img' => 'wisdom_countrypkg/img/country_flags/BS.png', 'country_code' => '1242',],
            ['name' =>  'Bahrain', 'short-name' =>  'BH', 'flag_img' => 'wisdom_countrypkg/img/country_flags/BH.png', 'country_code' => '973',],
            ['name' =>  'Bangladesh', 'short-name' =>  'BD', 'flag_img' => 'wisdom_countrypkg/img/country_flags/BD.png', 'country_code' => '880',],
            ['name' =>  'Barbados', 'short-name' =>  'BB', 'flag_img' => 'wisdom_countrypkg/img/country_flags/BB.png', 'country_code' => '1246',],
            ['name' =>  'Belarus', 'short-name' =>  'BY', 'flag_img' => 'wisdom_countrypkg/img/country_flags/BY.png', 'country_code' => '375',],
            ['name' =>  'Belgium', 'short-name' =>  'BE', 'flag_img' => 'wisdom_countrypkg/img/country_flags/BE.png', 'country_code' => '32',],
            ['name' =>  'Belize', 'short-name' =>  'BZ', 'flag_img' => 'wisdom_countrypkg/img/country_flags/BZ.png', 'country_code' => '501',],
            ['name' =>  'Benin', 'short-name' =>  'BJ', 'flag_img' => 'wisdom_countrypkg/img/country_flags/BJ.png', 'country_code' => '229',],
            ['name' =>  'Bermuda', 'short-name' =>  'BM', 'flag_img' => 'wisdom_countrypkg/img/country_flags/BM.png', 'country_code' => '1441',],
            ['name' =>  'Bhutan', 'short-name' =>  'BT', 'flag_img' => 'wisdom_countrypkg/img/country_flags/BT.png', 'country_code' => '975',],
            ['name' =>  'Bolivia', 'short-name' =>  'BO', 'flag_img' => 'wisdom_countrypkg/img/country_flags/BO.png', 'country_code' => '591',],
            ['name' =>  'Bosnia and Herzegovina', 'short-name' =>  'BA', 'flag_img' => 'wisdom_countrypkg/img/country_flags/BA.png', 'country_code' => '387',],
            ['name' =>  'Botswana', 'short-name' =>  'BW', 'flag_img' => 'wisdom_countrypkg/img/country_flags/BW.png', 'country_code' => '267',],
            ['name' =>  'Bouvet Island', 'short-name' =>  'BV', 'flag_img' => 'wisdom_countrypkg/img/country_flags/BV.png', 'country_code' => '0',],
            ['name' =>  'Brazil', 'short-name' => 'BR', 'flag_img' => 'wisdom_countrypkg/img/country_flags/BR.png', 'country_code' => '55',],
            ['name' =>  'British Indian Ocean Territory', 'short-name' =>  'IO', 'flag_img' => 'wisdom_countrypkg/img/country_flags/IO.png', 'country_code' => '246',],
            ['name' =>  'Brunei', 'short-name' =>  'BN', 'flag_img' => 'wisdom_countrypkg/img/country_flags/BN.png', 'country_code' => '673',],
            ['name' =>  'Bulgaria', 'short-name' =>  'BG', 'flag_img' => 'wisdom_countrypkg/img/country_flags/BG.png', 'country_code' => '359',],
            ['name' =>  'Burkina Faso', 'short-name' =>  'BF', 'flag_img' => 'wisdom_countrypkg/img/country_flags/BF.png', 'country_code' => '226',],
            ['name' =>  'Burundi', 'short-name' =>  'BI', 'flag_img' => 'wisdom_countrypkg/img/country_flags/BI.png', 'country_code' => '257',],
            ['name' =>  'Cambodia', 'short-name' =>  'KH', 'flag_img' => 'wisdom_countrypkg/img/country_flags/KH.png', 'country_code' => '855',],
            ['name' =>  'Cameroon', 'short-name' =>  'CM', 'flag_img' => 'wisdom_countrypkg/img/country_flags/CM.png', 'country_code' => '237',],
            ['name' =>  'Canada', 'short-name' =>  'CA', 'flag_img' => 'wisdom_countrypkg/img/country_flags/CA.png', 'country_code' => '1',],
            ['name' =>  'Cape Verde', 'short-name' =>  'CV', 'flag_img' => 'wisdom_countrypkg/img/country_flags/CV.png', 'country_code' => '238',],
            ['name' =>  'Cayman Islands', 'short-name' =>  'KY', 'flag_img' => 'wisdom_countrypkg/img/country_flags/KY.png', 'country_code' => '1345',],
            ['name' =>  'Central African Republic', 'short-name' =>  'CF', 'flag_img' => 'wisdom_countrypkg/img/country_flags/CF.png', 'country_code' => '236',],
            ['name' =>  'Chad', 'short-name' =>  'TD', 'flag_img' => 'wisdom_countrypkg/img/country_flags/TD.png', 'country_code' => '235',],
            ['name' =>  'Chile', 'short-name' =>  'CL', 'flag_img' => 'wisdom_countrypkg/img/country_flags/CL.png', 'country_code' => '56',],
            ['name' =>  'China', 'short-name' =>  'CN', 'flag_img' => 'wisdom_countrypkg/img/country_flags/CN.png', 'country_code' => '86',],
            ['name' =>  'Christmas Island', 'short-name' =>  'CX', 'flag_img' => 'wisdom_countrypkg/img/country_flags/CX.png', 'country_code' => '61',],
            ['name' =>  'Cocos (Keeling) Islands', 'short-name' =>  'CC', 'flag_img' => 'wisdom_countrypkg/img/country_flags/CC.png', 'country_code' => '672',],
            ['name' =>  'Colombia', 'short-name' =>  'CO', 'flag_img' => 'wisdom_countrypkg/img/country_flags/CO.png', 'country_code' => '57',],
            ['name' =>  'Comoros', 'short-name' =>  'KM', 'flag_img' => 'wisdom_countrypkg/img/country_flags/KM.png', 'country_code' => '269',],
            ['name' =>  'Cook Islands', 'short-name' =>  'CK', 'flag_img' => 'wisdom_countrypkg/img/country_flags/CK.png', 'country_code' => '682',],
            ['name' =>  'Costa Rica', 'short-name' =>  'CR', 'flag_img' => 'wisdom_countrypkg/img/country_flags/CR.png', 'country_code' => '506',],
            ['name' =>  'Cote D\'Ivoire (Ivory Coast)', 'short-name' =>  'CI', 'flag_img' => 'wisdom_countrypkg/img/country_flags/CI.png', 'country_code' => '225',],
            ['name' =>  'Croatia (Hrvatska)', 'short-name' =>  'HR', 'flag_img' => 'wisdom_countrypkg/img/country_flags/HR.png', 'country_code' => '385',],
            ['name' =>  'Cuba', 'short-name' =>  'CU', 'flag_img' => 'wisdom_countrypkg/img/country_flags/CU.png', 'country_code' => '53',],
            ['name' =>  'Cyprus', 'short-name' =>  'CY', 'flag_img' => 'wisdom_countrypkg/img/country_flags/CY.png', 'country_code' => '357',],
            ['name' =>  'Czech Republic', 'short-name' =>  'CZ', 'flag_img' => 'wisdom_countrypkg/img/country_flags/CZ.png', 'country_code' => '420',],
            ['name' =>  'Democratic Republic Of The Congo', 'short-name' =>  'CD', 'flag_img' => 'wisdom_countrypkg/img/country_flags/CD.png', 'country_code' => '243',],
            ['name' =>  'Denmark', 'short-name' =>  'DK', 'flag_img' => 'wisdom_countrypkg/img/country_flags/DK.png', 'country_code' => '45',],
            ['name' =>  'Djibouti', 'short-name' =>  'DJ', 'flag_img' => 'wisdom_countrypkg/img/country_flags/DJ.png', 'country_code' => '253',],
            ['name' =>  'Dominica', 'short-name' =>  'DM', 'flag_img' => 'wisdom_countrypkg/img/country_flags/DM.png', 'country_code' => '1767',],
            ['name' =>  'Dominican Republic', 'short-name' =>  'DO', 'flag_img' => 'wisdom_countrypkg/img/country_flags/DO.png', 'country_code' => '1809',],
            ['name' =>  'East Timor', 'short-name' =>  'TP', 'flag_img' => 'wisdom_countrypkg/img/country_flags/TP.png', 'country_code' => '670',],
            ['name' =>  'Ecuador', 'short-name' =>  'EC', 'flag_img' => 'wisdom_countrypkg/img/country_flags/EC.png', 'country_code' => '593',],
            ['name' =>  'Egypt', 'short-name' =>  'EG', 'flag_img' => 'wisdom_countrypkg/img/country_flags/EG.png', 'country_code' => '20',],
            ['name' =>  'El Salvador', 'short-name' =>  'SV', 'flag_img' => 'wisdom_countrypkg/img/country_flags/SV.png', 'country_code' => '503',],
            ['name' =>  'Equatorial Guinea', 'short-name' =>  'GQ', 'flag_img' => 'wisdom_countrypkg/img/country_flags/GQ.png', 'country_code' => '240',],
            ['name' =>  'Eritrea', 'short-name' =>  'ER', 'flag_img' => 'wisdom_countrypkg/img/country_flags/ER.png', 'country_code' => '291',],
            ['name' =>  'Estonia', 'short-name' =>  'EE', 'flag_img' => 'wisdom_countrypkg/img/country_flags/EE.png', 'country_code' => '372',],
            ['name' =>  'Ethiopia', 'short-name' =>  'ET', 'flag_img' => 'wisdom_countrypkg/img/country_flags/ET.png', 'country_code' => '251',],
            ['name' =>  'Falkland Islands', 'short-name' =>  'FK', 'flag_img' => 'wisdom_countrypkg/img/country_flags/FK.png', 'country_code' => '500',],
            ['name' =>  'Faroe Islands', 'short-name' =>  'FO', 'flag_img' => 'wisdom_countrypkg/img/country_flags/FO.png', 'country_code' => '298',],
            ['name' =>  'Fiji Islands', 'short-name' =>  'FJ', 'flag_img' => 'wisdom_countrypkg/img/country_flags/FJ.png', 'country_code' => '679',],
            ['name' =>  'Finland', 'short-name' =>  'FI', 'flag_img' => 'wisdom_countrypkg/img/country_flags/FI.png', 'country_code' => '358',],
            ['name' =>  'France', 'short-name' =>  'FR', 'flag_img' => 'wisdom_countrypkg/img/country_flags/FR.png', 'country_code' => '33',],
            ['name' =>  'French Guiana', 'short-name' =>  'GF', 'flag_img' => 'wisdom_countrypkg/img/country_flags/GF.png', 'country_code' => '594',],
            ['name' =>  'French Polynesia', 'short-name' =>  'PF', 'flag_img' => 'wisdom_countrypkg/img/country_flags/PF.png', 'country_code' => '689',],
            ['name' =>  'French Southern Territories', 'short-name' =>  'TF', 'flag_img' => 'wisdom_countrypkg/img/country_flags/TF.png', 'country_code' => '0',],
            ['name' =>  'Gabon', 'short-name' =>  'GA', 'flag_img' => 'wisdom_countrypkg/img/country_flags/GA.png', 'country_code' => '241',],
            ['name' =>  'Gambia The', 'short-name' => 'GM', 'flag_img' => 'wisdom_countrypkg/img/country_flags/GM.png', 'country_code' => '220',],
            ['name' =>  'Georgia', 'short-name' =>  'GE', 'flag_img' => 'wisdom_countrypkg/img/country_flags/GE.png', 'country_code' => '995',],
            ['name' =>  'Germany', 'short-name' =>  'DE', 'flag_img' => 'wisdom_countrypkg/img/country_flags/DE.png', 'country_code' => '49',],
            ['name' =>  'Ghana', 'short-name' =>  'GH', 'flag_img' => 'wisdom_countrypkg/img/country_flags/GH.png', 'country_code' => '233',],
            ['name' =>  'Gibraltar', 'short-name' =>  'GI', 'flag_img' => 'wisdom_countrypkg/img/country_flags/GI.png', 'country_code' => '350',],
            ['name' =>  'Greece', 'short-name' =>  'GR', 'flag_img' => 'wisdom_countrypkg/img/country_flags/GR.png', 'country_code' => '30',],
            ['name' =>  'Greenland', 'short-name' =>  'GL', 'flag_img' => 'wisdom_countrypkg/img/country_flags/GL.png', 'country_code' => '299',],
            ['name' =>  'Grenada', 'short-name' =>  'GD', 'flag_img' => 'wisdom_countrypkg/img/country_flags/GD.png', 'country_code' => '1473',],
            ['name' =>  'Guadeloupe', 'short-name' =>   'GP', 'flag_img' => 'wisdom_countrypkg/img/country_flags/GP.png', 'country_code' => '590',],
            ['name' =>  'Guam', 'short-name' =>  'GU', 'flag_img' => 'wisdom_countrypkg/img/country_flags/GU.png', 'country_code' => '1671',],
            ['name' =>  'Guatemala', 'short-name' =>  'GT', 'flag_img' => 'wisdom_countrypkg/img/country_flags/GT.png', 'country_code' => '502',],
            ['name' =>  'Guernsey and Alderney', 'short-name' =>  'XU', 'flag_img' => 'wisdom_countrypkg/img/country_flags/XU.png', 'country_code' => '44',],
            ['name' =>  'Guinea', 'short-name' =>  'GN', 'flag_img' => 'wisdom_countrypkg/img/country_flags/GN.png', 'country_code' => '224',],
            ['name' =>  'Guinea-Bissau', 'short-name' =>  'GW', 'flag_img' => 'wisdom_countrypkg/img/country_flags/GW.png', 'country_code' => '245',],
            ['name' =>  'Guyana', 'short-name' =>  'GY', 'flag_img' => 'wisdom_countrypkg/img/country_flags/GY.png', 'country_code' => '592',],
            ['name' =>  'Haiti', 'short-name' =>  'HT', 'flag_img' => 'wisdom_countrypkg/img/country_flags/HT.png', 'country_code' => '509',],
            ['name' =>  'Heard and McDonald Islands', 'short-name' =>  'HM', 'flag_img' => 'wisdom_countrypkg/img/country_flags/HM.png', 'country_code' => '0',],
            ['name' =>  'Honduras', 'short-name' =>  'HN', 'flag_img' => 'wisdom_countrypkg/img/country_flags/HN.png', 'country_code' => '504',],
            ['name' =>  'Hong Kong S.A.R.', 'short-name' =>  'HK', 'flag_img' => 'wisdom_countrypkg/img/country_flags/HK.png', 'country_code' => '852',],
            ['name' =>  'Hungary', 'short-name' =>  'HU', 'flag_img' => 'wisdom_countrypkg/img/country_flags/HU.png', 'country_code' => '36',],
            ['name' =>  'Iceland', 'short-name' =>  'IS', 'flag_img' => 'wisdom_countrypkg/img/country_flags/IS.png', 'country_code' => '354',],
            ['name' =>  'India', 'short-name' =>  'IN', 'flag_img' => 'wisdom_countrypkg/img/country_flags/IN.png', 'country_code' => '91',],
            ['name' =>  'Indonesia', 'short-name' =>  'ID', 'flag_img' => 'wisdom_countrypkg/img/country_flags/ID.png', 'country_code' => '62',],
            ['name' =>  'Iran', 'short-name' =>  'IR', 'flag_img' => 'wisdom_countrypkg/img/country_flags/IR.png', 'country_code' => '98',],
            ['name' =>  'Iraq', 'short-name' =>  'IQ', 'flag_img' => 'wisdom_countrypkg/img/country_flags/IQ.png', 'country_code' => '964',],
            ['name' =>  'Ireland', 'short-name' =>  'IE', 'flag_img' => 'wisdom_countrypkg/img/country_flags/IE.png', 'country_code' => '353',],
            ['name' =>  'Israel', 'short-name' =>  'IL', 'flag_img' => 'wisdom_countrypkg/img/country_flags/IL.png', 'country_code' => '972',],
            ['name' =>  'Italy', 'short-name' =>  'IT', 'flag_img' => 'wisdom_countrypkg/img/country_flags/IT.png', 'country_code' => '39',],
            ['name' =>  'Jamaica', 'short-name' =>  'JM', 'flag_img' => 'wisdom_countrypkg/img/country_flags/JM.png', 'country_code' => '1876',],
            ['name' =>  'Japan', 'short-name' =>  'JP', 'flag_img' => 'wisdom_countrypkg/img/country_flags/JP.png', 'country_code' => '81',],
            ['name' =>  'Jersey', 'short-name' =>  'XJ', 'flag_img' => 'wisdom_countrypkg/img/country_flags/XJ.png', 'country_code' => '44',],
            ['name' =>  'Jordan', 'short-name' =>  'JO', 'flag_img' => 'wisdom_countrypkg/img/country_flags/JO.png', 'country_code' => '962',],
            ['name' =>  'Kazakhstan', 'short-name' =>  'KZ', 'flag_img' => 'wisdom_countrypkg/img/country_flags/KZ.png', 'country_code' => '7',],
            ['name' =>  'Kenya', 'short-name' =>  'KE', 'flag_img' => 'wisdom_countrypkg/img/country_flags/KE.png', 'country_code' => '254',],
            ['name' =>  'Kiribati', 'short-name' =>  'KI', 'flag_img' => 'wisdom_countrypkg/img/country_flags/KI.png', 'country_code' => '686',],
            ['name' =>  'Korea North', 'short-name' =>  'KP', 'flag_img' => 'wisdom_countrypkg/img/country_flags/KP.png', 'country_code' => '850',],
            ['name' =>  'Korea South', 'short-name' =>  'KR', 'flag_img' => 'wisdom_countrypkg/img/country_flags/KR.png', 'country_code' => '82',],
            ['name' =>  'Kuwait', 'short-name' =>  'KW', 'flag_img' => 'wisdom_countrypkg/img/country_flags/KW.png', 'country_code' => '965',],
            ['name' =>  'Kyrgyzstan', 'short-name' =>  'KG', 'flag_img' => 'wisdom_countrypkg/img/country_flags/KG.png', 'country_code' => '996',],
            ['name' =>  'Laos', 'short-name' =>  'LA', 'flag_img' => 'wisdom_countrypkg/img/country_flags/LA.png', 'country_code' => '856',],
            ['name' =>  'Latvia', 'short-name' =>  'LV', 'flag_img' => 'wisdom_countrypkg/img/country_flags/LV.png', 'country_code' => '371',],
            ['name' =>  'Lebanon', 'short-name' =>  'LB', 'flag_img' => 'wisdom_countrypkg/img/country_flags/LB.png', 'country_code' => '961',],
            ['name' =>  'Lesotho', 'short-name' =>  'LS', 'flag_img' => 'wisdom_countrypkg/img/country_flags/LS.png', 'country_code' => '266',],
            ['name' =>  'Liberia', 'short-name' =>  'LR', 'flag_img' => 'wisdom_countrypkg/img/country_flags/LR.png', 'country_code' => '231',],
            ['name' =>  'Libya', 'short-name' =>  'LY', 'flag_img' => 'wisdom_countrypkg/img/country_flags/LY.png', 'country_code' => '218',],
            ['name' =>  'Liechtenstein', 'short-name' =>  'LI', 'flag_img' => 'wisdom_countrypkg/img/country_flags/LI.png', 'country_code' => '423',],
            ['name' =>  'Lithuania', 'short-name' =>  'LT', 'flag_img' => 'wisdom_countrypkg/img/country_flags/LT.png', 'country_code' => '370',],
            ['name' =>  'Luxembourg', 'short-name' =>  'LU', 'flag_img' => 'wisdom_countrypkg/img/country_flags/LU.png', 'country_code' => '352',],
            ['name' =>  'Macau S.A.R.', 'short-name' =>  'MO', 'flag_img' => 'wisdom_countrypkg/img/country_flags/MO.png', 'country_code' => '853',],
            ['name' =>  'Macedonia', 'short-name' =>  'MK', 'flag_img' => 'wisdom_countrypkg/img/country_flags/MK.png', 'country_code' => '389',],
            ['name' =>  'Madagascar', 'short-name' =>  'MG', 'flag_img' => 'wisdom_countrypkg/img/country_flags/MG.png', 'country_code' => '261',],
            ['name' =>  'Malawi', 'short-name' =>  'MW', 'flag_img' => 'wisdom_countrypkg/img/country_flags/MW.png', 'country_code' => '265',],
            ['name' =>  'Malaysia', 'short-name' =>  'MY', 'flag_img' => 'wisdom_countrypkg/img/country_flags/MY.png', 'country_code' => '60',],
            ['name' =>  'Maldives', 'short-name' =>  'MV', 'flag_img' => 'wisdom_countrypkg/img/country_flags/MV.png', 'country_code' => '960',],
            ['name' =>  'Mali', 'short-name' =>  'ML', 'flag_img' => 'wisdom_countrypkg/img/country_flags/ML.png', 'country_code' => '223',],
            ['name' =>  'Malta', 'short-name' =>  'MT', 'flag_img' => 'wisdom_countrypkg/img/country_flags/MT.png', 'country_code' => '356',],
            ['name' =>  'Man (Isle of)', 'short-name' =>  'XM', 'flag_img' => 'wisdom_countrypkg/img/country_flags/XM.png', 'country_code' => '44',],
            ['name' =>  'Marshall Islands', 'short-name' =>  'MH', 'flag_img' => 'wisdom_countrypkg/img/country_flags/MH.png', 'country_code' => '692',],
            ['name' =>  'Martinique', 'short-name' =>  'MQ', 'flag_img' => 'wisdom_countrypkg/img/country_flags/MQ.png', 'country_code' => '596',],
            ['name' =>  'Mauritania', 'short-name' =>  'MR', 'flag_img' => 'wisdom_countrypkg/img/country_flags/MR.png', 'country_code' => '222',],
            ['name' =>  'Mauritius', 'short-name' =>  'MU', 'flag_img' => 'wisdom_countrypkg/img/country_flags/MU.png', 'country_code' => '230',],
            ['name' =>  'Mayotte', 'short-name' =>  'YT', 'flag_img' => 'wisdom_countrypkg/img/country_flags/YT.png', 'country_code' => '269',],
            ['name' =>  'Mexico', 'short-name' =>  'MX', 'flag_img' => 'wisdom_countrypkg/img/country_flags/MX.png', 'country_code' => '52',],
            ['name' =>  'Micronesia', 'short-name' =>  'FM', 'flag_img' => 'wisdom_countrypkg/img/country_flags/FM.png', 'country_code' => '691',],
            ['name' =>  'Moldova', 'short-name' =>  'MD', 'flag_img' => 'wisdom_countrypkg/img/country_flags/MD.png', 'country_code' => '373',],
            ['name' =>  'Monaco', 'short-name' =>  'MC', 'flag_img' => 'wisdom_countrypkg/img/country_flags/MC.png', 'country_code' => '377',],
            ['name' =>  'Mongolia', 'short-name' =>  'MN', 'flag_img' => 'wisdom_countrypkg/img/country_flags/MN.png', 'country_code' => '976',],
            ['name' =>  'Montserrat', 'short-name' =>  'MS', 'flag_img' => 'wisdom_countrypkg/img/country_flags/MS.png', 'country_code' => '1664',],
            ['name' =>  'Morocco', 'short-name' =>  'MA', 'flag_img' => 'wisdom_countrypkg/img/country_flags/MA.png', 'country_code' => '212',],
            ['name' =>  'Mozambique', 'short-name' =>  'MZ', 'flag_img' => 'wisdom_countrypkg/img/country_flags/MZ.png', 'country_code' => '258',],
            ['name' =>  'Myanmar', 'short-name' =>  'MM', 'flag_img' => 'wisdom_countrypkg/img/country_flags/MM.png', 'country_code' => '95',],
            ['name' =>  'Namibia', 'short-name' =>  'NA', 'flag_img' => 'wisdom_countrypkg/img/country_flags/NA.png', 'country_code' => '264',],
            ['name' =>  'Nauru', 'short-name' =>  'NR', 'flag_img' => 'wisdom_countrypkg/img/country_flags/NR.png', 'country_code' => '674',],
            ['name' =>  'Nepal', 'short-name' =>  'NP', 'flag_img' => 'wisdom_countrypkg/img/country_flags/NP.png', 'country_code' => '977',],
            ['name' =>  'Netherlands Antilles', 'short-name' =>  'AN', 'flag_img' => 'wisdom_countrypkg/img/country_flags/AN.png', 'country_code' => '599',],
            ['name' =>  'Netherlands The', 'short-name' =>  'NL', 'flag_img' => 'wisdom_countrypkg/img/country_flags/NL.png', 'country_code' => '31',],
            ['name' =>  'New Caledonia', 'short-name' =>  'NC', 'flag_img' => 'wisdom_countrypkg/img/country_flags/NC.png', 'country_code' => '687',],
            ['name' =>  'New Zealand', 'short-name' =>  'NZ', 'flag_img' => 'wisdom_countrypkg/img/country_flags/NZ.png', 'country_code' => '64',],
            ['name' =>  'Nicaragua', 'short-name' =>  'NI', 'flag_img' => 'wisdom_countrypkg/img/country_flags/NI.png', 'country_code' => '505',],
            ['name' =>  'Niger', 'short-name' =>  'NE', 'flag_img' => 'wisdom_countrypkg/img/country_flags/NE.png', 'country_code' => '227',],
            ['name' =>  'Nigeria', 'short-name' =>   'NG', 'flag_img' => 'wisdom_countrypkg/img/country_flags/NG.png', 'country_code' => '234',],
            ['name' =>  'Niue', 'short-name' =>   'NU', 'flag_img' => 'wisdom_countrypkg/img/country_flags/NU.png', 'country_code' => '683',],
            ['name' =>  'Norfolk Island', 'short-name' =>   'NF', 'flag_img' => 'wisdom_countrypkg/img/country_flags/NF.png', 'country_code' => '672',],
            ['name' =>  'Northern Mariana Islands', 'short-name' =>   'MP', 'flag_img' => 'wisdom_countrypkg/img/country_flags/MP.png', 'country_code' => '1670',],
            ['name' =>  'Norway', 'short-name' =>   'NO', 'flag_img' => 'wisdom_countrypkg/img/country_flags/NO.png', 'country_code' => '47',],
            ['name' =>  'Oman', 'short-name' =>   'OM', 'flag_img' => 'wisdom_countrypkg/img/country_flags/OM.png', 'country_code' => '968',],
            ['name' =>  'Pakistan', 'short-name' =>   'PK', 'flag_img' => 'wisdom_countrypkg/img/country_flags/PK.png', 'country_code' => '92',],
            ['name' =>  'Palau', 'short-name' =>   'PW', 'flag_img' => 'wisdom_countrypkg/img/country_flags/PW.png', 'country_code' => '680',],
            ['name' =>  'Palestinian Territory Occupied', 'short-name' =>   'PS', 'flag_img' => 'wisdom_countrypkg/img/country_flags/PS.png', 'country_code' => '970',],
            ['name' =>  'Panama', 'short-name' =>   'PA', 'flag_img' => 'wisdom_countrypkg/img/country_flags/PA.png', 'country_code' => '507',],
            ['name' =>  'Papua new Guinea', 'short-name' =>   'PG', 'flag_img' => 'wisdom_countrypkg/img/country_flags/PG.png', 'country_code' => '675',],
            ['name' =>  'Paraguay', 'short-name' =>   'PY', 'flag_img' => 'wisdom_countrypkg/img/country_flags/PY.png', 'country_code' => '595',],
            ['name' =>  'Peru', 'short-name' =>   'PE', 'flag_img' => 'wisdom_countrypkg/img/country_flags/PE.png', 'country_code' => '51',],
            ['name' =>  'Philippines', 'short-name' =>   'PH', 'flag_img' => 'wisdom_countrypkg/img/country_flags/PH.png', 'country_code' => '63',],
            ['name' =>  'Pitcairn Island', 'short-name' =>   'PN', 'flag_img' => 'wisdom_countrypkg/img/country_flags/PN.png', 'country_code' => '0',],
            ['name' =>  'Poland', 'short-name' =>   'PL', 'flag_img' => 'wisdom_countrypkg/img/country_flags/PL.png', 'country_code' => '48',],
            ['name' =>  'Portugal', 'short-name' =>   'PT', 'flag_img' => 'wisdom_countrypkg/img/country_flags/PT.png', 'country_code' => '351',],
            ['name' =>  'Puerto Rico', 'short-name' =>   'PR', 'flag_img' => 'wisdom_countrypkg/img/country_flags/PR.png', 'country_code' => '1787',],
            ['name' =>  'Qatar', 'short-name' =>   'QA', 'flag_img' => 'wisdom_countrypkg/img/country_flags/QA.png', 'country_code' => '974',],
            ['name' =>  'Republic Of The Congo', 'short-name' =>   'CG', 'flag_img' => 'wisdom_countrypkg/img/country_flags/CG.png', 'country_code' => '242',],
            ['name' =>  'Reunion', 'short-name' =>   'RE', 'flag_img' => 'wisdom_countrypkg/img/country_flags/RE.png', 'country_code' => '262',],
            ['name' =>  'Romania', 'short-name' =>   'RO', 'flag_img' => 'wisdom_countrypkg/img/country_flags/RO.png', 'country_code' => '40',],
            ['name' =>  'Russia', 'short-name' =>   'RU', 'flag_img' => 'wisdom_countrypkg/img/country_flags/RU.png', 'country_code' => '70',],
            ['name' =>  'Rwanda', 'short-name' =>   'RW', 'flag_img' => 'wisdom_countrypkg/img/country_flags/RW.png', 'country_code' => '250',],
            ['name' =>  'Saint Helena', 'short-name' =>   'SH', 'flag_img' => 'wisdom_countrypkg/img/country_flags/SH.png', 'country_code' => '290',],
            ['name' =>  'Saint Kitts And Nevis', 'short-name' =>   'KN', 'flag_img' => 'wisdom_countrypkg/img/country_flags/KN.png', 'country_code' => '1869',],
            ['name' =>  'Saint Lucia', 'short-name' =>   'LC', 'flag_img' => 'wisdom_countrypkg/img/country_flags/LC.png', 'country_code' => '1758',],
            ['name' =>  'Saint Pierre and Miquelon', 'short-name' =>   'PM', 'flag_img' => 'wisdom_countrypkg/img/country_flags/PM.png', 'country_code' => '508',],
            ['name' =>  'Saint Vincent And The Grenadines', 'short-name' =>   'VC', 'flag_img' => 'wisdom_countrypkg/img/country_flags/VC.png', 'country_code' => '1784',],
            ['name' =>  'Samoa', 'short-name' =>   'WS', 'flag_img' => 'wisdom_countrypkg/img/country_flags/WS.png', 'country_code' => '684',],
            ['name' =>  'San Marino', 'short-name' =>   'SM', 'flag_img' => 'wisdom_countrypkg/img/country_flags/SM.png', 'country_code' => '378',],
            ['name' =>  'Sao Tome and Principe', 'short-name' =>   'ST', 'flag_img' => 'wisdom_countrypkg/img/country_flags/ST.png', 'country_code' => '239',],
            ['name' =>  'Saudi Arabia', 'short-name' =>   'SA', 'flag_img' => 'wisdom_countrypkg/img/country_flags/SA.png', 'country_code' => '966',],
            ['name' =>  'Senegal', 'short-name' =>   'SN', 'flag_img' => 'wisdom_countrypkg/img/country_flags/SN.png', 'country_code' => '221',],
            ['name' =>  'Serbia', 'short-name' =>   'RS', 'flag_img' => 'wisdom_countrypkg/img/country_flags/RS.png', 'country_code' => '381',],
            ['name' =>  'Seychelles', 'short-name' =>   'SC', 'flag_img' => 'wisdom_countrypkg/img/country_flags/SC.png', 'country_code' => '248',],
            ['name' =>  'Sierra Leone', 'short-name' =>   'SL', 'flag_img' => 'wisdom_countrypkg/img/country_flags/SL.png', 'country_code' => '232',],
            ['name' =>  'Singapore', 'short-name' =>   'SG', 'flag_img' => 'wisdom_countrypkg/img/country_flags/SG.png', 'country_code' => '65',],
            ['name' =>  'Slovakia', 'short-name' =>   'SK', 'flag_img' => 'wisdom_countrypkg/img/country_flags/SK.png', 'country_code' => '421',],
            ['name' =>  'Slovenia', 'short-name' =>   'SI', 'flag_img' => 'wisdom_countrypkg/img/country_flags/SI.png', 'country_code' => '386',],
            ['name' =>  'Smaller Territories of the UK', 'short-name' =>   'XG', 'flag_img' => 'wisdom_countrypkg/img/country_flags/XG.png', 'country_code' => '44',],
            ['name' =>  'Solomon Islands', 'short-name' =>   'SB', 'flag_img' => 'wisdom_countrypkg/img/country_flags/SB.png', 'country_code' => '677',],
            ['name' =>  'Somalia', 'short-name' =>   'SO', 'flag_img' => 'wisdom_countrypkg/img/country_flags/SO.png', 'country_code' => '252',],
            ['name' =>  'South Africa', 'short-name' =>   'ZA', 'flag_img' => 'wisdom_countrypkg/img/country_flags/ZA.png', 'country_code' => '27',],
            ['name' =>  'South Georgia', 'short-name' =>   'GS', 'flag_img' => 'wisdom_countrypkg/img/country_flags/GS.png', 'country_code' => '0',],
            ['name' =>  'South Sudan', 'short-name' =>   'SS', 'flag_img' => 'wisdom_countrypkg/img/country_flags/SS.png', 'country_code' => '211',],
            ['name' =>  'Spain', 'short-name' =>   'ES', 'flag_img' => 'wisdom_countrypkg/img/country_flags/ES.png', 'country_code' => '34',],
            ['name' =>  'Sri Lanka', 'short-name' =>   'LK', 'flag_img' => 'wisdom_countrypkg/img/country_flags/LK.png', 'country_code' => '94',],
            ['name' =>  'Sudan', 'short-name' =>   'SD', 'flag_img' => 'wisdom_countrypkg/img/country_flags/SD.png', 'country_code' => '249',],
            ['name' =>  'Suriname', 'short-name' =>   'SR', 'flag_img' => 'wisdom_countrypkg/img/country_flags/SR.png', 'country_code' => '597',],
            ['name' =>  'Svalbard And Jan Mayen Islands', 'short-name' =>   'SJ', 'flag_img' => 'wisdom_countrypkg/img/country_flags/SJ.png', 'country_code' => '47',],
            ['name' =>  'Swaziland', 'short-name' =>   'SZ', 'flag_img' => 'wisdom_countrypkg/img/country_flags/SZ.png', 'country_code' => '268',],
            ['name' =>  'Sweden', 'short-name' =>   'SE', 'flag_img' => 'wisdom_countrypkg/img/country_flags/SE.png', 'country_code' => '46',],
            ['name' =>  'Switzerland', 'short-name' =>   'CH', 'flag_img' => 'wisdom_countrypkg/img/country_flags/CH.png', 'country_code' => '41',],
            ['name' =>  'Syria', 'short-name' =>   'SY', 'flag_img' => 'wisdom_countrypkg/img/country_flags/SY.png', 'country_code' => '963',],
            ['name' =>  'Taiwan', 'short-name' =>   'TW', 'flag_img' => 'wisdom_countrypkg/img/country_flags/TW.png', 'country_code' => '886',],
            ['name' =>  'Tajikistan', 'short-name' =>   'TJ', 'flag_img' => 'wisdom_countrypkg/img/country_flags/TJ.png', 'country_code' => '992',],
            ['name' =>  'Tanzania', 'short-name' =>   'TZ', 'flag_img' => 'wisdom_countrypkg/img/country_flags/TZ.png', 'country_code' => '255',],
            ['name' =>  'Thailand', 'short-name' =>   'TH', 'flag_img' => 'wisdom_countrypkg/img/country_flags/TH.png', 'country_code' => '66',],
            ['name' =>  'Togo', 'short-name' =>   'TG', 'flag_img' => 'wisdom_countrypkg/img/country_flags/TG.png', 'country_code' => '228',],
            ['name' =>  'Tokelau', 'short-name' =>   'TK', 'flag_img' => 'wisdom_countrypkg/img/country_flags/TK.png', 'country_code' => '690',],
            ['name' =>  'Tonga', 'short-name' =>   'TO', 'flag_img' => 'wisdom_countrypkg/img/country_flags/TO.png', 'country_code' => '676',],
            ['name' =>  'Trinidad And Tobago', 'short-name' =>   'TT', 'flag_img' => 'wisdom_countrypkg/img/country_flags/TT.png', 'country_code' => '1868',],
            ['name' =>  'Tunisia', 'short-name' =>   'TN', 'flag_img' => 'wisdom_countrypkg/img/country_flags/TN.png', 'country_code' => '216',],
            ['name' =>  'Turkey', 'short-name' =>   'TR', 'flag_img' => 'wisdom_countrypkg/img/country_flags/TR.png', 'country_code' => '90',],
            ['name' =>  'Turkmenistan', 'short-name' =>   'TM', 'flag_img' => 'wisdom_countrypkg/img/country_flags/TM.png', 'country_code' => '7370',],
            ['name' =>  'Turks And Caicos Islands', 'short-name' =>   'TC', 'flag_img' => 'wisdom_countrypkg/img/country_flags/TC.png', 'country_code' => '1649',],
            ['name' =>  'Tuvalu', 'short-name' =>   'TV', 'flag_img' => 'wisdom_countrypkg/img/country_flags/TV.png', 'country_code' => '688',],
            ['name' =>  'Uganda', 'short-name' =>   'UG', 'flag_img' => 'wisdom_countrypkg/img/country_flags/UG.png', 'country_code' => '256',],
            ['name' =>  'Ukraine', 'short-name' =>   'UA', 'flag_img' => 'wisdom_countrypkg/img/country_flags/UA.png', 'country_code' => '380',],
            ['name' =>  'United Arab Emirates', 'short-name' =>   'AE', 'flag_img' => 'wisdom_countrypkg/img/country_flags/AE.png', 'country_code' => '971',],
            ['name' =>  'United Kingdom', 'short-name' =>   'GB', 'flag_img' => 'wisdom_countrypkg/img/country_flags/GB.png', 'country_code' => '44',],
            ['name' =>  'United States', 'short-name' =>   'US', 'flag_img' => 'wisdom_countrypkg/img/country_flags/US.png', 'country_code' => '1',],
            ['name' =>  'United States Minor Outlying Islands', 'short-name' =>   'UM', 'flag_img' => 'wisdom_countrypkg/img/country_flags/UM.png', 'country_code' => '1',],
            ['name' =>  'Uruguay', 'short-name' =>   'UY', 'flag_img' => 'wisdom_countrypkg/img/country_flags/UY.png', 'country_code' => '598',],
            ['name' =>  'Uzbekistan', 'short-name' =>   'UZ', 'flag_img' => 'wisdom_countrypkg/img/country_flags/UZ.png', 'country_code' => '998',],
            ['name' =>  'Vanuatu', 'short-name' =>   'VU', 'flag_img' => 'wisdom_countrypkg/img/country_flags/VU.png', 'country_code' => '678',],
            ['name' =>  'Vatican City State (Holy See)', 'short-name' =>   'VA', 'flag_img' => 'wisdom_countrypkg/img/country_flags/VA.png', 'country_code' => '39',],
            ['name' =>  'Venezuela', 'short-name' =>   'VE', 'flag_img' => 'wisdom_countrypkg/img/country_flags/VE.png', 'country_code' => '58',],
            ['name' =>  'Vietnam', 'short-name' =>   'VN', 'flag_img' => 'wisdom_countrypkg/img/country_flags/VN.png', 'country_code' => '84',],
            ['name' =>  'Virgin Islands (British)', 'short-name' =>   'VG', 'flag_img' => 'wisdom_countrypkg/img/country_flags/VG.png', 'country_code' => '1284',],
            ['name' =>  'Virgin Islands (US)', 'short-name' =>   'VI', 'flag_img' => 'wisdom_countrypkg/img/country_flags/VI.png', 'country_code' => '1340',],
            ['name' =>  'Wallis And Futuna Islands', 'short-name' =>   'WF', 'flag_img' => 'wisdom_countrypkg/img/country_flags/WF.png', 'country_code' => '681',],
            ['name' =>  'Western Sahara', 'short-name' =>   'EH', 'flag_img' => 'wisdom_countrypkg/img/country_flags/EH.png', 'country_code' => '212',],
            ['name' =>  'Yemen', 'short-name' =>   'YE', 'flag_img' => 'wisdom_countrypkg/img/country_flags/YE.png', 'country_code' => '967',],
            ['name' =>  'Yugoslavia', 'short-name' =>   'YU', 'flag_img' => 'wisdom_countrypkg/img/country_flags/YU.png', 'country_code' => '38',],
            ['name' =>  'Zambia', 'short-name' =>   'ZM', 'flag_img' => 'wisdom_countrypkg/img/country_flags/ZM.png', 'country_code' => '260',],
            ['name' =>  'Zimbabwe', 'short-name' =>   'ZW', 'flag_img' => 'wisdom_countrypkg/img/country_flags/ZW.png', 'country_code' => '263',],
        ];

        DB::table('countries')->insert($userData);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};