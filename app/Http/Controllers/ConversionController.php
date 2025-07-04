<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ConversionController extends Controller
{
    public function index(Request $request)
    {
        $lang = $request->input('lang', 'en');
        App::setLocale($lang);

        $units = [
            'length'      => ['millimeters','centimeters','decimeters','meters','kilometers','inches','feet','yards','miles','nautical_miles','microns','angstroms','light_years','astronomical_units'],
            'area'        => ['mm2','cm2','m2','km2','in2','ft2','yd2','acres','hectares'],
            'volume'      => ['mm3','cm3','ml','l','m3','in3','ft3','us_gallons','us_quarts','us_pints','us_cups','us_fl_oz','barrel','bushel'],
            'weight'      => ['milligrams','grams','kilograms','metric_tons','ounces','pounds','stones','us_tons','uk_tons'],
            'temperature' => ['celsius','fahrenheit','kelvin','rankine','reaumur','delisle','romer'],
            'time'        => ['microseconds','milliseconds','seconds','minutes','hours','days','weeks','years'],
            'speed'       => ['m_s','km_h','ft_s','mph','knots','mach'],
            'pressure'    => ['pascal','bar','atm','psi','torr','millibar','inch_h2o','inch_hg'],
            'energy'      => ['joule','calorie','kwh','btu','ev','erg','therm','toe'],
            'power'       => ['watt','horsepower','kw','btuh'],
            'force'       => ['newton','dyne','pound_force'],
            'data'        => ['bits','bytes','kb','mb','gb','tb'],
            'frequency'   => ['hertz','rpm'],
            'angle'       => ['radian','degree','grad','arcmin','arcsec'],
        ];

        $categoryLabels = [
            'en' => [
                'length'=>'Length','area'=>'Area','volume'=>'Volume','weight'=>'Weight',
                'temperature'=>'Temperature','time'=>'Time','speed'=>'Speed','pressure'=>'Pressure',
                'energy'=>'Energy','power'=>'Power','force'=>'Force','data'=>'Data',
                'frequency'=>'Frequency','angle'=>'Angle'
            ],
            'sw' => [
                'length'=>'Urefu','area'=>'Eneo','volume'=>'Ujazo','weight'=>'Uzito',
                'temperature'=>'Joto','time'=>'Muda','speed'=>'Kasi','pressure'=>'Shinikizo',
                'energy'=>'Nishati','power'=>'Nguvu','force'=>'Msukumo','data'=>'Data',
                'frequency'=>'Marudio','angle'=>'Pembe'
            ],
        ];

        // define English unit names
        $unitNamesEn = [
            'millimeters'=>'Millimeters','centimeters'=>'Centimeters','decimeters'=>'Decimeters',
            'meters'=>'Meters','kilometers'=>'Kilometers','inches'=>'Inches','feet'=>'Feet',
            'yards'=>'Yards','miles'=>'Miles','nautical_miles'=>'Nautical Miles','microns'=>'Microns',
            'angstroms'=>'Ångströms','light_years'=>'Light-years','astronomical_units'=>'Astronomical Units',
            'mm2'=>'Square Millimeters','cm2'=>'Square Centimeters','m2'=>'Square Meters','km2'=>'Square Kilometers',
            'in2'=>'Square Inches','ft2'=>'Square Feet','yd2'=>'Square Yards','acres'=>'Acres','hectares'=>'Hectares',
            'mm3'=>'Cubic Millimeters','cm3'=>'Cubic Centimeters','ml'=>'Milliliters','l'=>'Liters','m3'=>'Cubic Meters',
            'in3'=>'Cubic Inches','ft3'=>'Cubic Feet','us_gallons'=>'US Gallons','us_quarts'=>'US Quarts',
            'us_pints'=>'US Pints','us_cups'=>'US Cups','us_fl_oz'=>'US fl oz','barrel'=>'Barrels','bushel'=>'Bushels',
            'milligrams'=>'Milligrams','grams'=>'Grams','kilograms'=>'Kilograms','metric_tons'=>'Metric Tons',
            'ounces'=>'Ounces','pounds'=>'Pounds','stones'=>'Stones','us_tons'=>'US Tons','uk_tons'=>'UK Tons',
            'celsius'=>'Celsius','fahrenheit'=>'Fahrenheit','kelvin'=>'Kelvin','rankine'=>'Rankine',
            'reaumur'=>'Réaumur','delisle'=>'Delisle','romer'=>'Rømer',
            'microseconds'=>'Microseconds','milliseconds'=>'Milliseconds','seconds'=>'Seconds','minutes'=>'Minutes',
            'hours'=>'Hours','days'=>'Days','weeks'=>'Weeks','years'=>'Years',
            'm_s'=>'Meters/Second','km_h'=>'Kilometers/Hour','ft_s'=>'Feet/Second','mph'=>'MPH','knots'=>'Knots','mach'=>'Mach',
            'pascal'=>'Pascal','bar'=>'Bar','atm'=>'Atmosphere','psi'=>'PSI','torr'=>'Torr','millibar'=>'Millibar',
            'inch_h2o'=>'Inch-H₂O','inch_hg'=>'Inch-Hg',
            'joule'=>'Joule','calorie'=>'Calorie','kwh'=>'Kilowatt-hour','btu'=>'BTU','ev'=>'eV','erg'=>'Erg','therm'=>'Therm','toe'=>'TOE',
            'watt'=>'Watt','horsepower'=>'Horsepower','kw'=>'Kilowatt','btuh'=>'BTU/h',
            'newton'=>'Newton','dyne'=>'Dyne','pound_force'=>'Pound-force',
            'bits'=>'Bits','bytes'=>'Bytes','kb'=>'Kilobits','mb'=>'Megabits','gb'=>'Gigabits','tb'=>'Terabits',
            'hertz'=>'Hertz','rpm'=>'RPM',
            'radian'=>'Radian','degree'=>'Degree','grad'=>'Grad','arcmin'=>'Arc-minute','arcsec'=>'Arc-second',
        ];

        // define Swahili unit names
        $unitNamesSw = [
            'millimeters'=>'Milimita','centimeters'=>'Sentimita','decimeters'=>'Desimita',
            'meters'=>'Mita','kilometers'=>'Kilomita','inches'=>'Inchi','feet'=>'Futi',
            'yards'=>'Yadi','miles'=>'Maili','nautical_miles'=>'Maili ya Bahari','microns'=>'Mikroni',
            'angstroms'=>'Ångström','light_years'=>'Miaka ya Mwanga','astronomical_units'=>'Vitengo vya Anga',
            'mm2'=>'Milimita za Mraba','cm2'=>'Sentimita za Mraba','m2'=>'Mita za Mraba','km2'=>'Kilomita za Mraba',
            'in2'=>'Inchi za Mraba','ft2'=>'Futi za Mraba','yd2'=>'Yadi za Mraba','acres'=>'Ekari','hectares'=>'Hekta',
            'mm3'=>'Milimita za Kubo','cm3'=>'Sentimita za Kubo','ml'=>'Mililita','l'=>'Lita','m3'=>'Mitri za Kubo',
            'in3'=>'Inchi za Kubo','ft3'=>'Futi za Kubo','us_gallons'=>'Galoni (US)','us_quarts'=>'Kvati (US)',
            'us_pints'=>'Pinti (US)','us_cups'=>'Kikombe (US)','us_fl_oz'=>'Aunsi Kioevu (US)','barrel'=>'Barel','bushel'=>'Bushili',
            'milligrams'=>'Miligramu','grams'=>'Gramu','kilograms'=>'Kilogramu','metric_tons'=>'Tani Metriki',
            'ounces'=>'Aunsi','pounds'=>'Pauni','stones'=>'Jiwe','us_tons'=>'Tani (US)','uk_tons'=>'Tani (UK)',
            'celsius'=>'Selisiasi','fahrenheit'=>'Farenhaiti','kelvin'=>'Kelvini','rankine'=>'Rangini',
            'reaumur'=>'Reomé','delisle'=>'Delisle','romer'=>'Romer',
            'microseconds'=>'Mikrosani','milliseconds'=>'Milisani','seconds'=>'Sekunde','minutes'=>'Dakika',
            'hours'=>'Saa','days'=>'Siku','weeks'=>'Wiki','years'=>'Mwaka',
            'm_s'=>'Mita/Sek','km_h'=>'Kilomita/Saa','ft_s'=>'Futi/Sek','mph'=>'Maili/Saa','knots'=>'Nodi','mach'=>'Machi',
            'pascal'=>'Paskali','bar'=>'Bara','atm'=>'Atm','psi'=>'PSI','torr'=>'Tori','millibar'=>'Milibara',
            'inch_h2o'=>'Inchi H₂O','inch_hg'=>'Inchi Hg',
            'joule'=>'Jul','calorie'=>'Kalori','kwh'=>'Kilowati-saa','btu'=>'BTU','ev'=>'eV','erg'=>'Erg','therm'=>'Thermi','toe'=>'TOE',
            'watt'=>'Wati','horsepower'=>'Farasi','kw'=>'Kilowati','btuh'=>'BTU/h',
            'newton'=>'Newtoni','dyne'=>'Daini','pound_force'=>'Pauni-nguvu',
            'bits'=>'Biti','bytes'=>'Baiti','kb'=>'Kilobiti','mb'=>'Megabiti','gb'=>'Gigabiti','tb'=>'Terabiti',
            'hertz'=>'Hati','rpm'=>'RPM',
            'radian'=>'Radiani','degree'=>'Digrii','grad'=>'Gradi','arcmin'=>'Dakika Pembe','arcsec'=>'Sekunde Pembe',
        ];

        $translations = [
            'en' => [
                'labelCategory'=>'Select Category:',
                'labelValue'=>'Value:',
                'labelFrom'=>'From Unit:',
                'labelTo'=>'To Unit:',
                'btnConvert'=>'Convert',
                'btnNewConversion'=>'New Conversion',
                'resultPrefix'=>'Result:',
                'units'=>$unitNamesEn,
            ],
            'sw' => [
                'labelCategory'=>'Chagua Kategoria:',
                'labelValue'=>'Thamani:',
                'labelFrom'=>'Kutoka Kitengo:',
                'labelTo'=>'Hadi Kitengo:',
                'btnConvert'=>'Badilisha',
                'btnNewConversion'=>'Ubadilishaji Mpya',
                'resultPrefix'=>'Jibu:',
                'units'=>$unitNamesSw,
            ],
        ];

        $result = session('result', null);

        return view('converter', compact('units','categoryLabels','translations','lang','result'));
    }

    public function convert(Request $request)
    {
        $lang = $request->input('lang','en');
        App::setLocale($lang);

        $request->validate([
            'category'=>'required',
            'value'=>'required|numeric',
            'from_unit'=>'required',
            'to_unit'=>'required',
        ]);

        $category = $request->input('category');
        $value    = $request->input('value');
        $from     = $request->input('from_unit');
        $to       = $request->input('to_unit');

        $result = $this->performConversion($category,$value,$from,$to);

        return redirect()
            ->route('converter',['lang'=>$lang])
            ->withInput($request->all())
            ->with('result',round($result,4));
    }

    private function performConversion(string $category, float $value, string $from, string $to): float
    {
        switch ($category) {
            case 'length':
                $f = ['millimeters'=>0.001,'centimeters'=>0.01,'decimeters'=>0.1,'meters'=>1,'kilometers'=>1000,'inches'=>0.0254,'feet'=>0.3048,'yards'=>0.9144,'miles'=>1609.34,'nautical_miles'=>1852,'microns'=>1e-6,'angstroms'=>1e-10,'light_years'=>9.461e15,'astronomical_units'=>1.496e11];
                break;
            case 'area':
                $f = ['mm2'=>1e-6,'cm2'=>1e-4,'m2'=>1,'km2'=>1e6,'in2'=>0.00064516,'ft2'=>0.092903,'yd2'=>0.836127,'acres'=>4046.86,'hectares'=>10000];
                break;
            case 'volume':
                $f = ['mm3'=>1e-9,'cm3'=>1e-6,'ml'=>1e-6,'l'=>0.001,'m3'=>1,'in3'=>1.6387e-5,'ft3'=>0.0283168,'us_gallons'=>0.00378541,'us_quarts'=>0.000946353,'us_pints'=>0.000473176,'us_cups'=>0.000236588,'us_fl_oz'=>2.9574e-5,'barrel'=>0.158987,'bushel'=>0.0352391];
                break;
            case 'weight':
                $f = ['milligrams'=>1e-6,'grams'=>0.001,'kilograms'=>1,'metric_tons'=>1000,'ounces'=>0.0283495,'pounds'=>0.453592,'stones'=>6.35029,'us_tons'=>907.18474,'uk_tons'=>1016.0469088];
                break;
            case 'temperature':
                return $this->convertTemperature($value, $from, $to);
            case 'time':
                $f = ['microseconds'=>1e-6,'milliseconds'=>0.001,'seconds'=>1,'minutes'=>60,'hours'=>3600,'days'=>86400,'weeks'=>604800,'years'=>31536000];
                break;
            case 'speed':
                $f = ['m_s'=>1,'km_h'=>0.277778,'ft_s'=>0.3048,'mph'=>0.44704,'knots'=>0.514444,'mach'=>340.29];
                break;
            case 'pressure':
                $f = ['pascal'=>1,'bar'=>1e5,'atm'=>101325,'psi'=>6894.76,'torr'=>133.322,'millibar'=>100,'inch_h2o'=>248.84,'inch_hg'=>3386.39];
                break;
            case 'energy':
                $f = ['joule'=>1,'calorie'=>4.184,'kwh'=>3.6e6,'btu'=>1055.06,'ev'=>1.60218e-19,'erg'=>1e-7,'therm'=>1.055e8,'toe'=>4.1868e10];
                break;
            case 'power':
                $f = ['watt'=>1,'kw'=>1000,'horsepower'=>745.7,'btuh'=>0.293071];
                break;
            case 'force':
                $f = ['newton'=>1,'dyne'=>1e-5,'pound_force'=>4.44822];
                break;
            case 'data':
                $f = ['bits'=>1,'bytes'=>8,'kb'=>8192,'mb'=>8.3886e6,'gb'=>8.59e9,'tb'=>8.796e12];
                break;
            case 'frequency':
                $f = ['hertz'=>1,'rpm'=>1/60];
                break;
            case 'angle':
                $f = ['radian'=>1,'degree'=>0.0174533,'grad'=>0.0157079,'arcmin'=>0.000290888,'arcsec'=>4.8481e-6];
                break;
            default:
                return $value;
        }

        return ($value * $f[$from]) / $f[$to];
    }

    private function convertTemperature(float $value, string $from, string $to): float
    {
        if ($from === $to) {
            return $value;
        }

        switch ($from) {
            case 'celsius':
                $c = $value;
                break;
            case 'fahrenheit':
                $c = ($value - 32) * 5/9;
                break;
            case 'kelvin':
                $c = $value - 273.15;
                break;
            case 'rankine':
                $c = ($value - 491.67) * 5/9;
                break;
            case 'reaumur':
                $c = $value * 1.25;
                break;
            case 'delisle':
                $c = 100 - ($value * 2/3);
                break;
            case 'romer':
                $c = ($value - 7.5) * 40/21;
                break;
            default:
                return $value;
        }

        switch ($to) {
            case 'celsius':
                return $c;
            case 'fahrenheit':
                return $c * 9/5 + 32;
            case 'kelvin':
                return $c + 273.15;
            case 'rankine':
                return ($c + 273.15) * 9/5;
            case 'reaumur':
                return $c * 0.8;
            case 'delisle':
                return (100 - $c) * 1.5;
            case 'romer':
                return $c * 21/40 + 7.5;
            default:
                return $value;
        }
    }
}
